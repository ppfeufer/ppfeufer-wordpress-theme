<?php

/*
 * Copyright (C) 2022 p.pfeufer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Themes\Ppfeufer\Plugins;

/**
 * Theme Shortcodes
 */

defined('ABSPATH') or die();

class Shortcodes {
    /**
     * Constructor
     */
    public function __construct() {
        $this->addShortcodesToWidgets();
        $this->registerShortcodes();
    }

    /**
     * Register all shortcodes
     */
    public function registerShortcodes(): void {
        add_shortcode('divider', [$this, 'shortcodeDivider']);
        add_shortcode('credits', [$this, 'shortcodeCredits']);
    }

    public function addShortcodesToWidgets(): void {
        add_filter('widget_text', 'do_shortcode');
    }

    public function removeAutopInShortcode($content) {
        $content = do_shortcode(shortcode_unautop($content));

        return preg_replace('#^</p>|^<br />|<p>$#', '', $content);
    }

    public function shortcodeDivider($atts): string {
        // Normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);

        // Override default attributes with user attributes
        $attributes = shortcode_atts(
            [
                'width' => '100%'
            ],
            $atts
        );

        return '<div class="divider clearfix" style="width: ' . $attributes['width'] . '"></div>';
    }

    public function shortcodeCredits($atts = [], $content = null, $tag = ''): string {
        // Normalize attribute keys, lowercase
        $atts = array_change_key_case((array) $atts, CASE_LOWER);

        // Override default attributes with user attributes
        $attributes = shortcode_atts(
            [
                'headline_tag' => 'h4',
                'width' => '85%'
            ],
            $atts,
            $tag
        );

        $shortcodeOutput = null;

        if(!is_null($content)) {
            $headlineOpen = '<' . $attributes['headline_tag'] . '>';
            $headlineClose = '</' . $attributes['headline_tag'] . '>';

            $shortcodeOutput = '<div class="ppfeufer-article-credits clearfix">';
            $shortcodeOutput .= '<header>' . $headlineOpen . __('Credits:', 'ppfeufer') . $headlineClose . '</header>';
            $shortcodeOutput .= wpautop(do_shortcode(apply_filters('the_content', $content)));
            $shortcodeOutput .= '</div>';
        }

        return $shortcodeOutput;
    }
}
