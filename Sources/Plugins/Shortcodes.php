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
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Ppfeufer\Theme\Ppfeufer\Plugins;

/**
 * Theme Shortcodes
 */

// Exit if accessed directly
// phpcs:disable
defined(constant_name: 'ABSPATH') or die();
// phpcs:enable

/**
 * Class Shortcodes
 *
 * This class is responsible for handling shortcodes.
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer\Plugins
 */
class Shortcodes {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        $this->addShortcodesToWidgets();
        $this->registerShortcodes();
    }

    /**
     * Add shortcode to widgets
     *
     * @return void
     * @access public
     */
    public function addShortcodesToWidgets(): void {
        add_filter(hook_name: 'widget_text', callback: 'do_shortcode');
    }

    /**
     * Register all shortcodes
     *
     * @return void
     * @access public
     */
    public function registerShortcodes(): void {
        add_shortcode(tag: 'divider', callback: [$this, 'shortcodeDivider']);
        add_shortcode(tag: 'credits', callback: [$this, 'shortcodeCredits']);
    }

    /**
     * Remove the `<p>` tag that WP automatically adds.
     *
     * @param string $content
     * @return string
     * @access public
     */
    public function removeAutopInShortcode(string $content): string {
        $content = do_shortcode(shortcode_unautop($content));

        return preg_replace(
            pattern: '#^</p>|^<br />|<p>$#',
            replacement: '',
            subject: $content
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
     * @access public
     */
    public function shortcodeDivider(array|string $atts = []): string {
        // Normalize attribute keys, lowercase
        $atts = array_change_key_case(array: (array)$atts);

        // Override default attributes with user attributes
        $attributes = shortcode_atts(
            pairs: [
                'width' => '100%'
            ],
            atts: $atts,
            shortcode: 'divider'
        );

        return sprintf(
            '<div class="divider clearfix" style="width: %1$s"></div>',
            $attributes['width']
        );
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
     * @access public
     */
    public function shortcodeCredits(array|string $atts = [], string $content = null): ?string {
        // Normalize attribute keys, lowercase
        $atts = array_change_key_case(array: (array)$atts);

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

        if ($content !== null) {
            $shortcodeOutput = sprintf(
                '<div class="ppfeufer-article-credits clearfix">
                    <header>
                        <%1$s>%2$s:</%1$s>
                    </header>
                    %3$s
                </div>',
                $attributes['headline_tag'],
                __('Credits', 'ppfeufer'),
                wpautop(text: do_shortcode(
                    content: apply_filters(hook_name: 'the_content', value: $content)
                ))
            );
        }

        return $shortcodeOutput;
    }
}
