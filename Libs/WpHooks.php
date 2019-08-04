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

use \WordPress\Themes\Ppfeufer\Libs\ResourceLoader\CssLoader;
use \WordPress\Themes\Ppfeufer\Libs\ResourceLoader\JavascriptLoader;

\defined('ABSPATH') or die();

class WpHooks {
    /**
     * Constructor
     */
    public function __construct() {
        $this->init();
    }

    /**
     * Initialize all the needed hooks, filter, actions and so on
     */
    public function init() {
        $this->initHooks();
        $this->initActions();
        $this->initFilter();
    }

    /**
     * Initialize our hooks
     */
    public function initHooks() {
    }

    /**
     * Add our actions to WordPress
     */
    public function initActions() {
        // Theme Setup
        \add_action('after_setup_theme', [ThemeSetup::getInstance(), 'themeSetup']);

        \add_action('wp_enqueue_scripts', [CssLoader::getInstance(), 'enqueue'], 99);
        \add_action('wp_enqueue_scripts', [JavascriptLoader::getInstance(), 'enqueue'], 99);

        \add_action('init', [ThemeFunctions::getInstance(), 'initWidgets']);
    }

    /**
     * Initializing our filter
     */
    public function initFilter() {
        \add_filter('the_excerpt', [ThemeFunctions::getInstance(), 'addExcerptClass']);
    }
}
