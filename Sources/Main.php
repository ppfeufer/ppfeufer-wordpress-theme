<?php

namespace WordPress\Themes\Ppfeufer;

/**
 * Main Theme Class
 *
 * This class is responsible for the main functionality of the theme.
 *
 * @package WordPress\Themes\Ppfeufer
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
}
