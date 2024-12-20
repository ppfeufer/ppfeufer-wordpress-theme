<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer;

use WordPress\Ppfeufer\Theme\Ppfeufer\Libs\YahnisElsts\PluginUpdateChecker\v5p5\PucFactory;

/**
 * Main Theme Class
 *
 * This class is responsible for the main functionality of the theme.
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer
 */
class Main {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        $this->doUpdateCheck();

        add_action(
            hook_name: 'after_setup_theme',
            callback: [$this, 'loadTextDomain']
        );
    }

    /**
     * Check GitHub for updates
     *
     * @return void
     * @access public
     */
    public function doUpdateCheck(): void {
        PucFactory::buildUpdateChecker(
            metadataUrl: THEME_GITHUB_URI,
            fullPath: THEME_DIRECTORY,
            slug: THEME_SLUG
        )->getVcsApi()->enableReleaseAssets();
    }

    /**
     * Load text domain
     *
     * @return void
     * @access public
     */
    public function loadTextDomain(): void {
        load_child_theme_textdomain(
            domain: THEME_SLUG,
            path: THEME_DIRECTORY . '/l10n'
        );
    }

    /**
     * Initialize the theme
     *
     * @return void
     * @access public
     */
    public function init(): void {
        foreach ($this->getClassesToLoad() as $class) {
            new $class();
        }
    }

    /**
     * Get classes to load
     *
     * @return array
     * @access private
     */
    private function getClassesToLoad(): array {
        return [
            AssetLoader::class, // Load assets
            Plugins\Shortcodes::class, // Theme shortcodes
            Tweaks\DnsPrefetch::class, // Disable DNS prefetch
            Tweaks\Favicon::class, // Favicons
            Tweaks\LazyLoading::class, // Image lazy loading
            Tweaks\OpenGraph::class, // Open Graph
            Tweaks\SearchUrl::class, // Search URL modifications
            Tweaks\Theme::class // Theme Tweaks
        ];
    }
}
