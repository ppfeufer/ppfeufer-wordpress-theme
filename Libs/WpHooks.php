<?php

/**
 * Copyright (C) 2017 Rounon Dax
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
        \add_action('wp_enqueue_scripts', [\WordPress\Themes\Ppfeufer\Libs\ResourceLoader\CssLoader::getInstance(), 'enqueue'], 99);
    }

    /**
     * Initializing our filter
     */
    public function initFilter() {
    }
}
