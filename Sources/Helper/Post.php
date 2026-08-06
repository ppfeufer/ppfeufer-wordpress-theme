<?php

namespace Ppfeufer\Theme\Ppfeufer\Helper;

class Post {
    /**
     * Return an excerpt without running theme/plugin excerpt filters.
     *
     * @param object $post The current post object.
     * @return string
     */
    public static function getDefaultExcerptUnfiltered(object $post): string {
        $manualExcerpt = trim((string) $post->post_excerpt);

        if ('' !== $manualExcerpt) {
            return $manualExcerpt;
        }

        $content = (string) $post->post_content;
        $content = strip_shortcodes($content);
        $content = wp_strip_all_tags($content);
        $content = preg_replace('/\s+/', ' ', $content);

        if (null === $content) {
            return '';
        }

        return wp_trim_words(trim($content));
    }
}
