<?php

namespace WordPress\Themes\Ppfeufer\Helper;

/**
 * Metatags Helper Functions
 *
 * @package WordPress\Themes\Ppfeufer\Helper
 * @since 1.0.0
 */
class Metatags {
    /**
     * Create HTML meta-tags
     *
     * @param string $property
     * @param string $content
     * @param string $type
     *
     * @return string|null
     */
    public static function createMetaTag(
        string $property,
        string $content,
        string $type = 'property'
    ): ?string {
        $allowed_types = ['property', 'name'];

        if (empty($property)
            || empty($content)
            || !in_array($type, $allowed_types)
        ) {
            return null;
        }

        return '<meta ' . $type . '="' . $property . '" content="' . $content . '">';
    }
}
