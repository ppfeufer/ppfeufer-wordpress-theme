<?php

namespace Ppfeufer\Theme\Ppfeufer\Libs\YahnisElsts\PluginUpdateChecker\v5p6\Vcs;

use Parsedown;
use PucReadmeParser;

if ( !class_exists(Api::class, false) ):

	abstract class Api {
		const STRATEGY_LATEST_RELEASE = 'latest_release';
		const STRATEGY_LATEST_TAG = 'latest_tag';
		const STRATEGY_STABLE_TAG = 'stable_tag';
		const STRATEGY_BRANCH = 'branch';

		/**
		 * Consider all releases regardless of their version number or prerelease/upcoming
		 * release status.
		 */
		const RELEASE_FILTER_ALL = 3;

		/**
		 * Exclude releases that have the "prerelease" or "upcoming release" flag.
		 *
		 * This does *not* look for prerelease keywords like "beta" in the version number.
		 * It only uses the data provided by the API. For example, on GitHub, you can
		 * manually mark a release as a prerelease.
		 */
		const RELEASE_FILTER_SKIP_PRERELEASE = 1;

		/**
		 * If there are no release assets or none of them match the configured filter,
		 * fall back to the automatically generated source code archive.
		 */
		const PREFER_RELEASE_ASSETS = 1;
		/**
		 * Skip releases that don't have any matching release assets.
		 */
		const REQUIRE_RELEASE_ASSETS = 2;

		protected $tagNameProperty = 'name';
		protected $slug = '';

		/**
		 * @var string
		 */
		protected $repositoryUrl = '';

		/**
		 * @var mixed Authentication details for private repositories. Format depends on service.
		 */
		protected $credentials = null;

		/**
		 * @var string The filter tag that's used to filter options passed to wp_remote_get.
		 * For example, "puc_request_info_options-slug" or "puc_request_update_options_theme-slug".
		 */
		protected $httpFilterName = '';

		/**
		 * @var string The filter applied to the list of update detection strategies that
		 * are used to find the latest version.
		 */
		protected $strategyFilterName = '';

		/**
		 * @var string|null
		 */
		protected $localDirectory = null;

		/**
		 * Api constructor.
		 *
		 * @param string $repositoryUrl
		 * @param array|string|null $credentials
		 */
		public function __construct($repositoryUrl, $credentials = null) {
			$this->repositoryUrl = $repositoryUrl;
			$this->setAuthentication($credentials);
		}

		/**
		 * @return string
		 */
		public function getRepositoryUrl() {
			return $this->repositoryUrl;
		}

		/**
		 * Figure out which reference (i.e. tag or branch) contains the latest version.
		 *
		 * @param string $configBranch Start looking in this branch.
		 * @return null|Reference
		 */
		public function chooseReference($configBranch) {
			$strategies = $this->getUpdateDetectionStrategies($configBranch);

			if ( !empty($this->strategyFilterName) ) {
				$strategies = apply_filters(
					$this->strategyFilterName,
					$strategies,
					$this->slug
				);
			}

			foreach ($strategies as $strategy) {
				$reference = call_user_func($strategy);
				if ( !empty($reference) ) {
					return $reference;
				}
			}
			return null;
		}

		/**
		 * Get an ordered list of strategies that can be used to find the latest version.
		 *
		 * The update checker will try each strategy in order until one of them
		 * returns a valid reference.
		 *
		 * @param string $configBranch
		 * @return array<callable> Array of callables that return Vcs_Reference objects.
		 */
		abstract protected function getUpdateDetectionStrategies($configBranch);

		/**
		 * Get the readme.txt file from the remote repository and parse it
		 * according to the plugin readme standard.
		 *
		 * @param string $ref Tag or branch name.
		 * @return array Parsed readme.
		 */
		public function getRemoteReadme($ref = 'master') {
			$fileContents = $this->getRemoteFile($this->getLocalReadmeName(), $ref);
			if ( empty($fileContents) ) {
				return array();
			}

			$parser = new PucReadmeParser();
			return $parser->parse_readme_contents($fileContents);
		}

		/**
		 * Get the case-sensitive name of the local readme.txt file.
		 *
		 * In most cases it should just be called "readme.txt", but some plugins call it "README.txt",
		 * "README.TXT", or even "Readme.txt". Most VCS are case-sensitive so we need to know the correct
		 * capitalization.
		 *
		 * Defaults to "readme.txt" (all lowercase).
		 *
		 * @return string
		 */
		public function getLocalReadmeName() {
			static $fileName = null;
			if ( $fileName !== null ) {
				return $fileName;
			}

			$fileName = 'readme.txt';
			if ( isset($this->localDirectory) ) {
				$files = scandir($this->localDirectory);
				if ( !empty($files) ) {
					foreach ($files as $possibleFileName) {
						if ( strcasecmp($possibleFileName, 'readme.txt') === 0 ) {
							$fileName = $possibleFileName;
							break;
						}
					}
				}
			}
			return $fileName;
		}

		/**
		 * Get a branch.
		 *
		 * @param string $branchName
		 * @return Reference|null
		 */
		abstract public function getBranch($branchName);

		/**
		 * Get a specific tag.
		 *
		 * @param string $tagName
		 * @return Reference|null
		 */
		abstract public function getTag($tagName);

		/**
		 * Get the tag that looks like the highest version number.
		 * (Implementations should skip pre-release versions if possible.)
		 *
		 * @return Reference|null
		 */
		abstract public function getLatestTag();

		/**
		 * Check if a tag name string looks like a version number.
		 *
		 * @param string $name
		 * @return bool
		 */
		protected function looksLikeVersion($name) {
			//Tag names may be prefixed with "v", e.g. "v1.2.3".
			$name = ltrim($name, 'v');

			//The version string must start with a number.
			if ( !is_numeric(substr($name, 0, 1)) ) {
				return false;
			}

			//The goal is to accept any SemVer-compatible or "PHP-standardized" version number.
			return (preg_match('@^(\d{1,5}?)(\.\d{1,10}?){0,4}?($|[abrdp+_\-]|\s)@i', $name) === 1);
		}

		/**
		 * Check if a tag appears to be named like a version number.
		 *
		 * @param \stdClass $tag
		 * @return bool
		 */
		protected function isVersionTag($tag) {
			$property = $this->tagNameProperty;
			return isset($tag->$property) && $this->looksLikeVersion($tag->$property);
		}

		/**
		 * Sort a list of tags as if they were version numbers.
		 * Tags that don't look like version number will be removed.
		 *
		 * @param \stdClass[] $tags Array of tag objects.
		 * @return \stdClass[] Filtered array of tags sorted in descending order.
		 */
		protected function sortTagsByVersion($tags) {
			//Keep only those tags that look like version numbers.
			$versionTags = array_filter($tags, array($this, 'isVersionTag'));
			//Sort them in descending order.
			usort($versionTags, array($this, 'compareTagNames'));

			return $versionTags;
		}

		/**
		 * Compare two tags as if they were version number.
		 *
		 * @param \stdClass $tag1 Tag object.
		 * @param \stdClass $tag2 Another tag object.
		 * @return int
		 */
		protected function compareTagNames($tag1, $tag2) {
			$property = $this->tagNameProperty;
			if ( !isset($tag1->$property) ) {
				return 1;
			}
			if ( !isset($tag2->$property) ) {
				return -1;
			}
			return -version_compare(ltrim($tag1->$property, 'v'), ltrim($tag2->$property, 'v'));
		}

		/**
		 * Get the contents of a file from a specific branch or tag.
		 *
		 * @param string $path File name.
		 * @param string $ref
		 * @return null|string Either the contents of the file, or null if the file doesn't exist or there's an error.
		 */
		abstract public function getRemoteFile($path, $ref = 'master');

		/**
		 * Get the timestamp of the latest commit that changed the specified branch or tag.
		 *
		 * @param string $ref Reference name (e.g. branch or tag).
		 * @return string|null
		 */
		abstract public function getLatestCommitTime($ref);

		/**
		 * Get the contents of the changelog file from the repository.
		 *
		 * @param string $ref
		 * @param string $localDirectory Full path to the local plugin or theme directory.
		 * @return null|string The HTML contents of the changelog.
		 */
		public function getRemoteChangelog($ref, $localDirectory) {
			$filename = $this->findChangelogName($localDirectory);
			if ( empty($filename) ) {
				return null;
			}

			$changelog = $this->getRemoteFile($filename, $ref);
			if ( $changelog === null ) {
				return null;
			}

			return Parsedown::instance()->text($changelog);
		}

		/**
		 * Guess the name of the changelog file.
		 *
		 * @param string $directory
		 * @return string|null
		 */
		protected function findChangelogName($directory = null) {
			if ( !isset($directory) ) {
				$directory = $this->localDirectory;
			}
			if ( empty($directory) || !is_dir($directory) || ($directory === '.') ) {
				return null;
			}

			$possibleNames = array('CHANGES.md', 'CHANGELOG.md', 'changes.md', 'changelog.md');
			$files = scandir($directory);
			$foundNames = array_intersect($possibleNames, $files);

			if ( !empty($foundNames) ) {
				return reset($foundNames);
			}
			return null;
		}

		/**
		 * Set authentication credentials.
		 *
		 * @param $credentials
		 */
		public function setAuthentication($credentials) {
			$this->credentials = $credentials;
		}

		public function isAuthenticationEnabled() {
			return !empty($this->credentials);
		}

		/**
		 * @param string $url
		 * @return string
		 */
		public function signDownloadUrl($url) {
			return $url;
		}

		/**
		 * @param string $filterName
		 */
		public function setHttpFilterName($filterName) {
			$this->httpFilterName = $filterName;
		}

		/**
		 * @param string $filterName
		 */
		public function setStrategyFilterName($filterName) {
			$this->strategyFilterName = $filterName;
		}

		/**
		 * @param string $directory
		 */
		public function setLocalDirectory($directory) {
			if ( empty($directory) || !is_dir($directory) || ($directory === '.') ) {
				$this->localDirectory = null;
			} else {
				$this->localDirectory = $directory;
			}
		}

		/**
		 * @param string $slug
		 */
		public function setSlug($slug) {
			$this->slug = $slug;
		}
	}

endif;
