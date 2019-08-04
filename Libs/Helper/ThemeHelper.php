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

use \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton;
use \WP_Theme;

\defined('ABSPATH') or die();

/**
 * ThemeHelper
 *
 * @author ppfeufer
 */
class ThemeHelper extends AbstractSingleton {
    /**
     * themeObject
     *
     * @var WP_Theme
     */
    protected $themeObject = null;

    /**
     * The constructor
     */
    public function __construct() {
        parent::__construct();

        $this->setThemeObject();
    }

    /**
     * Setting the theme object
     */
    private function setThemeObject() {
        $this->themeObject = \wp_get_theme();
    }

    /**
     * Setting the theme object
     *
     * @return WP_Theme
     */
    public function getThemeObject() : WP_Object {
        return $this->themeObject;
    }

    /**
     * Returning some theme related data
     *
     *  array(
     *      Name        => ppfeufer
     *      ThemeURI    => https://github.com/ppfeufer/ppfeufer-wordpress-theme
     *      Description => WordPress theme for my own website
     *      Author      => H.-Peter Pfeufer
     *      AuthorURI   => http://ppfeufer.de
     *      Version     => 0.1
     *      Template
     *      Status
     *      Tags        => responsive
     *      TextDomain  => ppfeufer
     *      DomainPath  => /l10n
     *  )
     *
     * @param string $parameter
     * @return string
     *
     * @link https://developer.wordpress.org/reference/functions/wp_get_theme/
     */
    public function getThemeHeaderData(string $parameter) : string {
        return $this->getThemeObject()->get($parameter);
    }

    /**
     * Alias for is_active_sidebar()
     *
     * @param string $sidebarPosition
     * @return bool
     * @uses is_active_sidebar() Whether a sidebar is in use.
     */
    public function hasSidebar(string $sidebarPosition) : bool {
        return \is_active_sidebar($sidebarPosition);
    }

    /**
     * Getting the theme's name
     *
     * @return string
     */
    public function getThemeName() : string {
        return $this->getThemeHeaderData('Name');
    }

    /**
     * Getting the theme's version
     *
     * @return string
     */
    public function getThemeVersion() : string {
        return $this->getThemeHeaderData('Version');
    }
}
