<?php

namespace WordPress\Themes\Ppfeufer\Libs\Interfaces;

/**
 * Defines a common set of functions that any class responsible for loading
 * stylesheets, JavaScript, or other assets should implement.
 */
interface AssetsInterface {
    public function enqueue();
}
