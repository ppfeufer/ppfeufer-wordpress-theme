<?php

namespace Ppfeufer\Theme\Ppfeufer\Helper;

class Post {
    /**
     * Return an excerpt without running theme/plugin excerpt filters.
     *
     * @param object $post The current post object.
     * @return string|null
     */
    public static function getDefaultExcerptUnfiltered(object $post): ?string {
        $manualExcerpt = trim(($post->post_excerpt));

        if ('' !== $manualExcerpt) {
            return esc_html($manualExcerpt);
        }

        $content = preg_replace(
            '/\s+/',
            ' ',
            wp_strip_all_tags(strip_shortcodes((string) $post->post_content))
        );

        if (null === $content) {
            return null;
        }

        return wp_trim_words(trim(esc_html($content)));
    }
}
