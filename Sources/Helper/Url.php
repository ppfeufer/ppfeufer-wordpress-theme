<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer\Helper;

/**
 * URL Helper Functions
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer\Helper
 * @since 1.0.0
 */
class Url {
    /**
     * Remove protocol from URL
     *
     * @param string $url
     *
     * @return string
     */
    public static function removeProtocolFromUrl(string $url): string {
        return preg_replace(
            pattern: '/^https?:\/\//',
            replacement: '',
            subject: $url
        );
    }
}
