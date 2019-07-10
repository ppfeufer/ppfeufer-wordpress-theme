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

namespace WordPress\Themes\Ppfeufer\Libs\Addons;

use WordPress\Themes\Ppfeufer;

/**
 * Yulai Federation Theme back compat functionality
 *
 * Prevents Yulai Federation Theme from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Eve_Online
 * @since Yulai Federation Theme 0.1-r20170324
 */
if(\version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    \add_action('after_switch_theme', '\\WordPress\Themes\Ppfeufer\Addons\yf_switch_theme');
    \add_action('load-customize.php', '\\WordPress\Themes\Ppfeufer\Addons\yf_customize');
    \add_action('template_redirect', '\\WordPress\Themes\Ppfeufer\Addons\yf_preview');

    return false;
}

/**
 * Prevent switching to Yulai Federation Theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Yulai Federation Theme 0.1-r20170324
 */
function yf_switch_theme() {
    \switch_theme(\WP_DEFAULT_THEME);

    unset($_GET['activated']);

    \add_action('admin_notices', '\\WordPress\Themes\Ppfeufer\Addons\yf_upgrade_notice');
}

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Yulai Federation Theme on WordPress versions prior to 4.7.
 *
 * @since Yulai Federation Theme 0.1-r20170324
 *
 * @global string $wp_version WordPress version.
 */
function yf_upgrade_notice() {
    $message = \sprintf(\__('Yulai Federation Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'yulai-federation'), \get_bloginfo('version'));

    \printf('<div class="error"><p>%s</p></div>', $message);
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Yulai Federation Theme 0.1-r20170324
 *
 * @global string $wp_version WordPress version.
 */
function yf_customize() {
    \wp_die(\sprintf(\__('Yulai Federation Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'yulai-federation'), \get_bloginfo('version')), '', [
        'back_link' => true,
    ]);
}

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Yulai Federation Theme 0.1-r20170324
 *
 * @global string $wp_version WordPress version.
 */
function yf_preview() {
    $preview = \filter_input('get', 'preview');

    if(!empty($preview)) {
        \wp_die(\sprintf(\__('Yulai Federation Theme requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'yulai-federation'), \get_bloginfo('version')));
    }
}
