<?php

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
