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

namespace WordPress\Themes\Ppfeufer\Libs\ResourceLoader;

/**
 * CSS Loader
 */
class CssLoader extends \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton implements \WordPress\Themes\Ppfeufer\Libs\Interfaces\AssetsInterface {
    /**
     * Initialize the loader
     */
//    public function init() {
//        \add_action('wp_enqueue_scripts', [$this, 'enqueue'], 99);
//    }

    /**
     * Load the styles
     */
    public function enqueue() {
        /**
         * only in frontend
         */
        if(!\is_admin()) {
            // deregister certain styles we have our own of
            \wp_deregister_style('font-awesome');
            \wp_deregister_style('bootstrap');

            // register our own css
            \wp_enqueue_style('bootstrap-4', '//static.ppfeufer.de/libraries/bootstrap/4.3.1/css/bootstrap.min.css', [], false);
            \wp_enqueue_style('ppfeufer-main', \get_theme_file_uri('/Assets/Css/main.css'), [], false);
            \wp_enqueue_style('ppfeufer-responsive', \get_theme_file_uri('/Assets/Css/responsive.css'), ['ppfeufer-main'], false);
            \wp_enqueue_style('ppfeufer-plugin-accommodations', \get_theme_file_uri('/Assets/Css/plugin-accommodations.css'), ['ppfeufer-main'], null);
        }

        /**
         * only in backend
         */
        if(\is_admin()) {
            // backend styles
        }
    }
}
