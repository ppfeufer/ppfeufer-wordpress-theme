<?php

namespace Ppfeufer\Theme\Ppfeufer\Tweaks;

/**
 * DNS Prefetch
 *
 * This class is responsible for handling DNS prefetch.
 *
 * @package Ppfeufer\Theme\Ppfeufer\Tweaks
 */
class DnsPrefetch {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        add_action(hook_name: 'init', callback: [$this, 'removeDnsPrefetch']);
    }

    /**
     * Remove DNS prefetch
     *
     * @return void
     * @access public
     */
    public function removeDnsPrefetch(): void {
        remove_action(hook_name: 'wp_head', callback: 'wp_resource_hints', priority: 2);
    }
}
