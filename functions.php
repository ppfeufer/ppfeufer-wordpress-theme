<?php

/*
 * Copyright (C) 2022 p.pfeufer
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
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Ppfeufer\Theme\Ppfeufer;

// Register the autoloader.
require_once trailingslashit(value: __DIR__) . 'Sources/autoloader.php';
require_once trailingslashit(value: __DIR__) . 'Sources/Libs/autoload.php';

// Define a couple of constants we might need.
// phpcs:disable
define(constant_name: 'THEME_VERSION', value: wp_get_theme()->get('Version'));
define(constant_name: 'THEME_DIRECTORY', value: get_stylesheet_directory());
define(constant_name: 'THEME_DIRECTORY_URI', value: get_stylesheet_directory_uri());
// phpcs:enable

// Load the themes' main class.
(new Main())->init();
