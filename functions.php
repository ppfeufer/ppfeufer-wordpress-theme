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

require_once(\trailingslashit(\dirname(__FILE__)) . 'inc/autoloader.php');

class Theme {
    public function init() {
        new Libs\WpHooks;
    }
}

$ppfeuferTheme = new Theme;
$ppfeuferTheme->init();
