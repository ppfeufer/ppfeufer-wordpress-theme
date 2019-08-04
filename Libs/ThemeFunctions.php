<?php

/*
 * Copyright (C) 2019 ppfeufer
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

namespace WordPress\Themes\Ppfeufer\Libs;

use \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton;

/**
 * TemplateFunctions
 *
 * @author ppfeufer
 */
class ThemeFunctions extends AbstractSingleton {
    /**
     * Convert HSL to HEX colors
     *
     * @param int $h
     * @param int $s
     * @param int $l
     * @param bool $toHex
     * @return string
     */
    function convertHslToHexColors(int $h, int $s, int $l, bool $toHex = true): string {
        $h /= 360;
        $s /= 100;
        $l /= 100;

        $r = $l;
        $g = $l;
        $b = $l;
        $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);

        if($v > 0) {
            $m;
            $sv;
            $sextant;
            $fract;
            $vsf;
            $mid1;
            $mid2;

            $m = $l + $l - $v;
            $sv = ($v - $m) / $v;
            $h *= 6.0;
            $sextant = \floor($h);
            $fract = $h - $sextant;
            $vsf = $v * $sv * $fract;
            $mid1 = $m + $vsf;
            $mid2 = $v - $vsf;

            switch($sextant) {
                case 0:
                    $r = $v;
                    $g = $mid1;
                    $b = $m;
                    break;

                case 1:
                    $r = $mid2;
                    $g = $v;
                    $b = $m;
                    break;

                case 2:
                    $r = $m;
                    $g = $v;
                    $b = $mid1;
                    break;

                case 3:
                    $r = $m;
                    $g = $mid2;
                    $b = $v;
                    break;

                case 4:
                    $r = $mid1;
                    $g = $m;
                    $b = $v;
                    break;

                case 5:
                    $r = $v;
                    $g = $m;
                    $b = $mid2;
                    break;
            }
        }

        $r = \round($r * 255, 0);
        $g = \round($g * 255, 0);
        $b = \round($b * 255, 0);

        if($toHex) {
            $r = ($r < 15) ? '0' . \dechex($r) : \dechex($r);
            $g = ($g < 15) ? '0' . \dechex($g) : \dechex($g);
            $b = ($b < 15) ? '0' . \dechex($b) : \dechex($b);

            return "#$r$g$b";
        }

        return "rgb($r, $g, $b)";
    }

    /**
     * Adding a clearfix to every paragraph
     *
     * @param string $content
     * @return string
     */
    function paragraphClearfix(string $content) : string {
        return \preg_replace('/<p([^>]+)?>/', '<p$1 class="clearfix">', $content);
    }

    /**
     * Picking up teh first paragraph from the_content
     *
     * @param string $content
     * @return string
     */
    public function addIntroClassToFirstParagraph(string $content): string {
        return \preg_replace('/<p([^>]+)?>/', '<p$1 class="intro">', $content, 1);
    }

    /**
     * Adding a CSS class to the excerpt
     *
     * @param string $excerpt
     * @return string
     */
    public function addExcerptClass(string $excerpt): string {
        return \str_replace('<p', '<p class="excerpt"', $excerpt);
    }

    /**
     * Define theme's widget areas.
     */
    function initWidgets() {
        \register_sidebar([
            'name' => \__('Page Sidebar', 'ppfeufer'),
            'description' => \__('This sidebar will be displayed if the current is a page or your blog index.', 'ppfeufer'),
            'id' => 'sidebar-page',
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => "</div></aside>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ]);

        \register_sidebar([
            'name' => \__('Post Sidebar', 'ppfeufer'),
            'description' => \__('This sidebar will always be displayed if teh current is a post / blog article.', 'ppfeufer'),
            'id' => 'sidebar-post',
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => "</div></aside>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ]);

        \register_sidebar([
            'name' => \__('General Sidebar', 'ppfeufer'),
            'id' => 'sidebar-general',
            'description' => \__('General sidebar that is always right from the topic, below the side specific sidebars', 'ppfeufer'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => "</div></aside>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ]);

        \register_sidebar([
            'name' => \__('Home Column 1', 'ppfeufer'),
            'id' => 'home-column-1',
            'description' => \__('Home Column 1', 'ppfeufer'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ]);

        \register_sidebar([
            'name' => \__('Home Column 2', 'ppfeufer'),
            'id' => 'home-column-2',
            'description' => \__('Home Column 2', 'ppfeufer'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ]);

        \register_sidebar([
            'name' => \__('Home Column 3', 'ppfeufer'),
            'id' => 'home-column-3',
            'description' => \__('Home Column 3', 'ppfeufer'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ]);

        \register_sidebar([
            'name' => \__('Home Column 4', 'ppfeufer'),
            'id' => 'home-column-4',
            'description' => \__('Home Column 4', 'ppfeufer'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2>',
            'after_title' => '</h2>'
        ]);

        \register_sidebar([
            'name' => \__('Footer Column 1', 'ppfeufer'),
            'id' => 'footer-column-1',
            'description' => \__('Footer Column 1', 'ppfeufer'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ]);

        \register_sidebar([
            'name' => \__('Footer Column 2', 'ppfeufer'),
            'id' => 'footer-column-2',
            'description' => \__('Footer Column 2', 'ppfeufer'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ]);

        \register_sidebar([
            'name' => \__('Footer Column 3', 'ppfeufer'),
            'id' => 'footer-column-3',
            'description' => \__('Footer Column 3', 'ppfeufer'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ]);

        \register_sidebar([
            'name' => \__('Footer Column 4', 'ppfeufer'),
            'id' => 'footer-column-4',
            'description' => \__('Footer Column 4', 'ppfeufer'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ]);

        // header widget sidebar
        \register_sidebar([
            'name' => \__('Header Widget Area', 'ppfeufer'),
            'id' => 'header-widget-area',
            'description' => \__('Header Widget Area', 'ppfeufer'),
            'before_widget' => '<aside><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></aside>',
            'before_title' => '<h4>',
            'after_title' => '</h4>'
        ]);
    }
}
