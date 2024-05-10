<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer\Helper;

/**
 * Metatags Helper Functions
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer\Helper
 */
class Metatags {
    /**
     * Create HTML meta-tags
     *
     * @param string $property
     * @param string $content
     * @param string $type
     * @return string|null
     * @access public
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

        return sprintf(
            '<meta %1$s="%2$s" content="%3$s">',
            $type,
            $property,
            $content
        );
    }
}
