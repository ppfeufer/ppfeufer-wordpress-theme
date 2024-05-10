<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer;

use WordPress\Ppfeufer\Theme\Ppfeufer\Libs\YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

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
     * Check GitHub for updates
     *
     * @return void
     * @access public
     */
    public function doUpdateCheck(): void {
        PucFactory::buildUpdateChecker(
            metadataUrl: 'https://github.com/ppfeufer/ppfeufer-wordpress-theme/',
            fullPath: get_stylesheet_directory(),
            slug: 'ppfeufer'
        )->getVcsApi()->enableReleaseAssets();
    }
}
