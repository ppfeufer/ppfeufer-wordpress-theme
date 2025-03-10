<?php

namespace Ppfeufer\Theme\Ppfeufer;

/**
 * Asset Loader
 *
 * This class is responsible for loading all assets for the theme.
 *
 * @package Ppfeufer\Theme\Ppfeufer
 */
class AssetLoader {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        add_action(hook_name: 'wp_enqueue_scripts', callback: [$this, 'loadStyles']);
        add_action(
            hook_name: 'wp_enqueue_scripts',
            callback: [$this, 'loadScripts'],
            priority: 9999
        );
        add_action(
            hook_name: 'admin_enqueue_scripts',
            callback: [$this, 'loadAdminStyles']
        );
        add_action(hook_name: 'wp_footer', callback: [$this, 'loadSvgSprite']);
    }

    /**
     * Load styles
     *
     * @return void
     * @access public
     */
    public function loadStyles(): void {
        wp_enqueue_style(
            handle: 'fira-code',
            src: get_theme_file_uri(
                file: '/Assets/css/libs/fira-code/6.2.0/fira_code.min.css'
            ),
            ver: THEME_VERSION
        );
        wp_enqueue_style(
            handle: 'ppfeufer-theme-style-defaults',
            src: get_theme_file_uri(file: '/Assets/css/ppfeufer-defaults.min.css'),
            deps: ['fira-code', 'wp-moose-style'],
            ver: THEME_VERSION
        );
        wp_enqueue_style(
            handle: 'ppfeufer-theme-style',
            src: get_theme_file_uri(file: '/Assets/css/ppfeufer.min.css'),
            deps: ['ppfeufer-theme-style-defaults'],
            ver: THEME_VERSION
        );
        wp_enqueue_style(
            handle: 'ppfeufer-plugin-styles',
            src: get_theme_file_uri(file: '/Assets/css/plugin-styles.min.css'),
            deps: ['ppfeufer-theme-style'],
            ver: THEME_VERSION
        );
    }

    /**
     * Load scripts
     *
     * @return void
     * @access public
     */
    public function loadScripts(): void {
        wp_enqueue_script(
            handle: 'ppfeufer',
            src: get_theme_file_uri(file: '/Assets/javascript/ppfeufer.min.js'),
            ver: THEME_VERSION,
            args: [
                'in_footer' => true,
                'strategy' => 'async'
            ]
        );
    }

    /**
     * Load admin styles
     *
     * @return void
     * @access public
     */
    public function loadAdminStyles(): void {
        wp_enqueue_style(
            handle: 'fira-code',
            src: get_theme_file_uri(
                file: '/Assets/css/libs/fira-code/6.2.0/fira_code.min.css'
            ),
            ver: THEME_VERSION
        );
        wp_enqueue_style(
            handle: 'ppfeufer-admin-style',
            src: get_theme_file_uri(file: '/Assets/css/ppfeufer-admin-style.min.css'),
            deps: ['fira-code'],
            ver: THEME_VERSION
        );
    }

    /**
     * Add SVG-Sprite to footer hook
     *
     * @return void
     * @access public
     */
    public function loadSvgSprite(): void {
        $svg_sprite = file_get_contents(
            filename: get_theme_file_path(file: 'Assets/images/sprite.svg')
        );

        echo '<div class="svg-sprite">' . $svg_sprite . '</div>';
    }
}
