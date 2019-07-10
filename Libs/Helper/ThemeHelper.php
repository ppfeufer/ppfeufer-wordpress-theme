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

namespace WordPress\Themes\Ppfeufer\Libs\Helper;

\defined('ABSPATH') or die();

/**
 * ThemeHelper
 *
 * @author ppfeufer
 */
class ThemeHelper extends \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton {
    /**
     * Returning some theme related data
     *
     * @param string $parameter
     * @return string
     *
     * @link https://developer.wordpress.org/reference/functions/wp_get_theme/
     */
    public function getThemeData($parameter) {
        $themeData = \wp_get_theme();

        return $themeData->get($parameter);
    }

    /**
     * Alias for is_active_sidebar()
     *
     * @param string $sidebarPosition
     * @return boolean
     * @uses is_active_sidebar() Whether a sidebar is in use.
     */
    public function hasSidebar($sidebarPosition) {
        return \is_active_sidebar($sidebarPosition);
    }

    public function getThemeName() {
        return 'ppfeufer';
    }
}
