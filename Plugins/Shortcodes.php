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

defined(constant_name: 'ABSPATH') or die();

/**
 * Class Shortcodes
 */
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
        add_shortcode(tag: 'divider', callback: [$this, 'shortcodeDivider']);
        add_shortcode(tag: 'credits', callback: [$this, 'shortcodeCredits']);
    }

    /**
     * Add shortcode to widgets
     *
     * @return void
     */
    public function addShortcodesToWidgets(): void {
        add_filter(hook_name: 'widget_text', callback: 'do_shortcode');
    }

    /**
     * Remove the `<p>` tag that WP automatically adds
     *
     * @param string $content
     * @return string
     */
    public function removeAutopInShortcode(string $content): string {
        $content = do_shortcode(shortcode_unautop($content));

        return preg_replace(
            pattern: '#^</p>|^<br />|<p>$#', replacement: '', subject: $content
        );
    }

    /**
     * Shortcode: Divider
     *
     * Usage:
     *      [divider width="85%"]
     *
     * Attributes:
     *      width => Width of the divider. (Default: 100%)
     *
     * @param array|string $atts Attributes for the shortcode
     * @return string
     */
    public function shortcodeDivider(array|string $atts = []): string {
        // Normalize attribute keys, lowercase
        $atts = array_change_key_case(array: (array) $atts);

        // Override default attributes with user attributes
        $attributes = shortcode_atts(
            pairs: [
                'width' => '100%'
            ],
            atts: $atts,
            shortcode: 'divider'
        );

        return '<div class="divider clearfix" style="width: ' . $attributes['width'] . '"></div>';
    }

    /**
     * Shortcode: Credits box
     *
     * Draws a credit area
     *
     * Usage:
     *      [credits width="85%" headline_tag="h4"]Content[/credits]
     *
     * Attributes:
     *      width => Width of the credit box (Default: 85%)
     *      headline_tag => Headline tag (Default: h4)
     *
     * @param array|string $atts Attributes for the shortcode
     * @param string|null $content Shortcode content
     * @return string|null
     */
    public function shortcodeCredits(array|string $atts = [], string $content = null): ?string {
        // Normalize attribute keys, lowercase
        $atts = array_change_key_case(array: (array) $atts);

        // Override default attributes with user attributes
        $attributes = shortcode_atts(
            pairs: [
                'headline_tag' => 'h4',
                'width' => '85%'
            ],
            atts: $atts,
            shortcode: 'credits'
        );

        $shortcodeOutput = null;

        if($content !== null) {
            $headlineOpen = '<' . $attributes['headline_tag'] . '>';
            $headlineClose = '</' . $attributes['headline_tag'] . '>';

            $shortcodeOutput = '<div class="ppfeufer-article-credits clearfix">';
            $shortcodeOutput .= '<header>' . $headlineOpen . __(text: 'Credits:', domain: 'ppfeufer') . $headlineClose . '</header>';
            $shortcodeOutput .= wpautop(text: do_shortcode(
                content: apply_filters(hook_name: 'the_content', value: $content)
            ));
            $shortcodeOutput .= '</div>';
        }

        return $shortcodeOutput;
    }
}
