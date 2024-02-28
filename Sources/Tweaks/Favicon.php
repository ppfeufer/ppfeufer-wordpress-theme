<?php

namespace WordPress\Themes\Ppfeufer\Tweaks;

use WordPress\Themes\Ppfeufer\Helper\Metatags;

/**
 * Favicon
 *
 * This class is responsible for adding the favicon to the theme.
 *
 * @package WordPress\Themes\Ppfeufer\Tweaks
 * @since 1.0.0
 */
class Favicon {
    /**
     * Constructor
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        add_action(
            hook_name: 'wp_head',
            callback: [$this, 'addFavicons']
        );
        add_action(
            hook_name: 'do_faviconico',
            callback: [$this, 'redirectFavicon']
        );
    }

    /**
     * Add favicons to the theme
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function addFavicons(): void {
        echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/apple-touch-icon.png">' . "\n";
        echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/favicon-32x32.png">' . "\n";
        echo '<link rel="icon" type="image/png" sizes="192x192" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/android-chrome-192x192.png">' . "\n";
        echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/favicon-16x16.png">' . "\n";
        echo '<link rel="manifest" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/site.webmanifest">' . "\n";
        echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/favicon.ico">' . "\n";

        echo Metatags::createMetaTag(
            property: 'msapplication-TileColor',
            content: '#da532c',
            type: 'name'
        ) . "\n";
        echo Metatags::createMetaTag(
            property: 'msapplication-TileImage',
            content: get_stylesheet_directory_uri() . '/Assets/favicons/mstile-144x144.png',
            type: 'name'
        ) . "\n";
        echo Metatags::createMetaTag(
            property: 'msapplication-config',
            content: get_stylesheet_directory_uri() . '/Assets/favicons/browserconfig.xml',
            type: 'name'
        ) . "\n";
        echo Metatags::createMetaTag(
            property: 'theme-color',
            content: '#ffffff',
            type: 'name'
        ) . "\n";
    }

    /**
     * Redirect to the right favicon.ico
     *
     * WordPress redirects to a default favicon (admin_url('images/w-logo-blue.png')) since v5.5, which is not what I want,
     * so I have to do it myself here ...
     *
     * `//ppfeufer.de/favicon.ico` will be redirected to get_theme_file_uri('/Assets/favicons/favicon.ico')
     *
     * @see https://make.wordpress.org/core/2020/02/19/enhancements-to-favicon-handling-in-wordpress-5-4/
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function redirectFavicon(): void {
        wp_redirect(location: get_site_icon_url(
            size: 32,
            url: get_theme_file_uri('/Assets/favicons/favicon.ico')
        ));

        exit;
    }
}
