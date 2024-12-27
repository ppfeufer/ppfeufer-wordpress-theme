<?php

namespace Ppfeufer\Theme\Ppfeufer\Tweaks;

use WP_Post;

/**
 * Lazy Loading
 *
 * This class is responsible for adding lazy loading to images.
 *
 * @package Ppfeufer\Theme\Ppfeufer\Tweaks
 */
class LazyLoading {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        add_filter(
            hook_name: 'wp_get_attachment_image_attributes',
            callback: [$this, 'addLazyLoading'],
            accepted_args: 3
        );
    }

    /**
     * Add general native lazy-loading support to images
     *
     * @param array $attr Attributes for the image markup
     * @param WP_Post $attachment Image attachment post
     * @param string|array $size Requested size
     * @return array
     * @access public
     */
    public function addLazyLoading(
        array $attr,
        WP_Post $attachment,
        string|array $size
    ): array {
        if (!is_admin()) {
            if ($attachment->post_mime_type === 'image/svg+xml') {
                unset($attr['loading']);
            } else {
                $attr['loading'] = 'lazy';
            }
        }

        return $attr;
    }
}
