<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer;

// phpcs:disable
require_once trailingslashit(value: __DIR__) . 'Libs/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
// phpcs:enable

use WordPress\Ppfeufer\Theme\Ppfeufer\Libs\YahnisElsts\PluginUpdateChecker\v5p4\PucFactory;

/**
 * Main Theme Class
 *
 * This class is responsible for the main functionality of the theme.
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer
 * @since 1.0.0
 */
class Main {
    /**
     * Initialize the theme
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function init(): void {
        $this->doUpdateCheck();

        // Load assets
        new AssetLoader();

        // Theme shortcodes
        new Plugins\Shortcodes();

        // DNS prefetch settings
        new Tweaks\DnsPrefetch();

        // Favicons
        new Tweaks\Favicon();

        // Image lazy loading
        new Tweaks\LazyLoading();

        // Open Graph
        new Tweaks\OpenGraph();

        // Search URL modifications
        new Tweaks\SearchUrl();

        // Theme Tweaks
        new Tweaks\Theme();
    }

    /**
     * Check GitHub for updates
     *
     * @return void
     * @since 1.1.0
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
