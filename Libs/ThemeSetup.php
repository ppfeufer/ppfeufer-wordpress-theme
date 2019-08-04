<?php

/*
 * Copyright (C) 2019 ppfeufer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Themes\Ppfeufer\Libs;

use \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton;

/**
 * ThemeSetup
 *
 * @author ppfeufer
 */
class ThemeSetup extends AbstractSingleton {
    /**
     * Theme Setup
     */
    public function themeSetup() {
        /* @var $themeFunctions ThemeFunctions */
        $themeFunctions = ThemeFunctions::getInstance();

        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Twenty Nineteen, use a find and replace
         * to change 'ppfeufer' to the name of your theme in all the template files.
         */
        \load_theme_textdomain('ppfeufer', \get_template_directory() . '/l10n');

        // Add default posts and comments RSS feed links to head.
        \add_theme_support('automatic-feed-links');

        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        \add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        \add_theme_support('post-thumbnails');
//        \set_post_thumbnail_size(1680, 1050); // Full HD thumbnail
        \set_post_thumbnail_size(1920, 1080);

        // This theme uses wp_nav_menu() in two locations.
        \register_nav_menus(
            [
                'header-menu' => \__('Header Menu', 'ppfeufer'),
                'main-menu' => \__('Main Menu', 'ppfeufer'),
                'footer-menu' => \__('Footer Menu', 'ppfeufer'),
            ]
        );

        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        \add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        \add_theme_support(
            'custom-logo',
            [
                'height' => 190,
                'width' => 190,
                'flex-width' => false,
                'flex-height' => false,
            ]
        );

        // Add theme support for selective refresh for widgets.
        \add_theme_support('customize-selective-refresh-widgets');

        // Add support for Block Styles.
        \add_theme_support('wp-block-styles');

        // Add support for full and wide align images.
        \add_theme_support('align-wide');

        // Add support for editor styles.
        \add_theme_support('editor-styles');

        // Enqueue editor styles.
        \add_editor_style('style-editor.css');

        // Add custom editor font sizes.
        \add_theme_support(
            'editor-font-sizes',
            [
                [
                    'name' => \__('Small', 'ppfeufer'),
                    'shortName' => \__('S', 'ppfeufer'),
                    'size' => 19.5,
                    'slug' => 'small',
                ],
                [
                    'name' => \__('Normal', 'ppfeufer'),
                    'shortName' => \__('M', 'ppfeufer'),
                    'size' => 22,
                    'slug' => 'normal',
                ],
                [
                    'name' => \__('Large', 'ppfeufer'),
                    'shortName' => \__('L', 'ppfeufer'),
                    'size' => 36.5,
                    'slug' => 'large',
                ],
                [
                    'name' => \__('Huge', 'ppfeufer'),
                    'shortName' => \__('XL', 'ppfeufer'),
                    'size' => 49.5,
                    'slug' => 'huge',
                ],
            ]
        );

        // Editor color palette.
        \add_theme_support(
            'editor-color-palette',
            [
                [
                    'name' => \__('Primary', 'ppfeufer'),
                    'slug' => 'primary',
                    'color' => $themeFunctions->convertHslToHexColors('default' === \get_theme_mod('primary_color') ? 199 : \get_theme_mod('primary_color_hue', 199), 100, 33),
                ],
                [
                    'name' => \__('Secondary', 'ppfeufer'),
                    'slug' => 'secondary',
                    'color' => $themeFunctions->convertHslToHexColors('default' === \get_theme_mod('primary_color') ? 199 : \get_theme_mod('primary_color_hue', 199), 100, 23),
                ],
                [
                    'name' => \__('Dark Gray', 'ppfeufer'),
                    'slug' => 'dark-gray',
                    'color' => '#111',
                ],
                [
                    'name' => \__('Light Gray', 'ppfeufer'),
                    'slug' => 'light-gray',
                    'color' => '#767676',
                ],
                [
                    'name' => \__('White', 'ppfeufer'),
                    'slug' => 'white',
                    'color' => '#FFF',
                ],
            ]
        );

        // Add support for responsive embedded content.
        \add_theme_support('responsive-embeds');
    }
}
