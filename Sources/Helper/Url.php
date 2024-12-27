<?php

namespace Ppfeufer\Theme\Ppfeufer\Helper;

/**
 * URL Helper Functions
 *
 * @package Ppfeufer\Theme\Ppfeufer\Helper
 */
class Url {
    /**
     * Remove protocol from URL
     *
     * @param string $url
     * @return string
     * @access public
     */
    public static function removeProtocolFromUrl(string $url): string {
        return preg_replace(
            pattern: '/^https?:\/\//',
            replacement: '',
            subject: $url
        );
    }
}
