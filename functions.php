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

/**
 * Our Theme's namespace to keep the global namespace clear
 *
 * WordPress\Themes\Ppfeufer
 */

namespace WordPress\Themes\Ppfeufer;

use \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton;
use \WordPress\Themes\Ppfeufer\Libs\WpHooks;

require_once(\trailingslashit(\dirname(__FILE__)) . 'inc/autoloader.php');

/**
 * Maximal content width
 */
if(!isset($content_width)) {
    $content_width = 1680;
}

/**
 * Theme main class
 */
class Theme extends AbstractSingleton {
    /**
     * Initialize all the important stuff
     */
    public function init() {
        new WpHooks;
    }
}

/**
 * Start the show
 */
$ppfeuferTheme = \WordPress\Themes\Ppfeufer\Theme::getInstance();
$ppfeuferTheme->init();
