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

//namespace WordPress\Themes\Ppfeufer;

use JetBrains\PhpStorm\NoReturn;
use WordPress\Themes\Ppfeufer\Plugins\Shortcodes;

require_once(get_theme_file_path(file: 'inc/autoloader.php'));

// Load Libraries
new Shortcodes;

/**
 * Create HTML meta-tags
 *
 * @param string $property
 * @param string $content
 * @param string $type
 *
 * @return string|null
 */
function __create_meta_tag(
    string $property,
    string $content,
    string $type = 'property'
): ?string {
    $allowed_types = ['property', 'name'];

    if (empty($property)
        || empty($content)
        || !in_array(needle: $type, haystack: $allowed_types)
    ) {
        return null;
    }

    return '<meta ' . $type . '="' . $property . '" content="' . $content . '">';
}

/**
 * Enqueue the child themes CSS
 *
 * @return void
 */
function ppfeufer_enqueue_styles(): void {
    wp_enqueue_style(
        handle: 'fira-code',
        src: get_theme_file_uri(
            file: '/Assets/css/libs/fira-code/6.2.0/fira_code.min.css'
        ),
        ver: wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        handle: 'ppfeufer-theme-style-defaults',
        src: get_theme_file_uri(file: '/Assets/css/ppfeufer-defaults.min.css'),
        deps: ['fira-code', 'wp-moose-style'],
        ver: wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        handle: 'ppfeufer-theme-style',
        src: get_theme_file_uri(file: '/Assets/css/ppfeufer.min.css'),
        deps: ['ppfeufer-theme-style-defaults'],
        ver: wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        handle: 'ppfeufer-plugin-styles',
        src: get_theme_file_uri(file: '/Assets/css/plugin-styles.min.css'),
        deps: ['ppfeufer-theme-style'],
        ver: wp_get_theme()->get('Version')
    );
}

add_action(hook_name: 'wp_enqueue_scripts', callback: 'ppfeufer_enqueue_styles');

/**
 * Enqueue admin CSS
 *
 * @return void
 */
function ppfeufer_enqueue_admin_styles(): void {
    wp_enqueue_style(
        handle: 'fira-code',
        src: get_theme_file_uri(
            file: '/Assets/css/libs/fira-code/6.2.0/fira_code.min.css'
        ),
        ver: wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        handle: 'ppfeufer-admin-style',
        src: get_theme_file_uri(file: '/Assets/css/ppfeufer-admin-style.min.css'),
        deps: ['fira-code'],
        ver: wp_get_theme()->get('Version')
    );
}

add_action(
    hook_name: 'admin_enqueue_scripts', callback: 'ppfeufer_enqueue_admin_styles'
);

/**
 * Enqueue the child themes JS
 *
 * @return void
 */
function ppfeufer_enqueue_javascript(): void {
    wp_enqueue_script(
        handle: 'ppfeufer',
        src: get_theme_file_uri(file: '/Assets/javascript/ppfeufer.min.js'),
        ver: wp_get_theme()->get('Version'),
        args: [
            'in_footer' => true,
            'strategy' => 'async'
        ]
    );
}

add_action(
    hook_name: 'wp_enqueue_scripts',
    callback: 'ppfeufer_enqueue_javascript',
    priority: 9999
);

/**
 * Redirect to the right favicon.ico
 *
 * WordPress redirects to a default favicon (admin_url('images/w-logo-blue.png')) since v5.5, which is not what I want,
 * so I have to do it myself here ...
 *
 * https://ppfeufer.de/favicon.ico will be redirected to get_theme_file_uri('/Assets/favicons/favicon.ico')
 *
 * @see https://make.wordpress.org/core/2020/02/19/enhancements-to-favicon-handling-in-wordpress-5-4/
 *
 * @return void
 */
#[NoReturn] function ppfeufer_favicon_ico(): void {
    wp_redirect(location: get_site_icon_url(
        size: 32, url: get_theme_file_uri('/Assets/favicons/favicon.ico')
    ));

    exit;
}

add_action(hook_name: 'do_faviconico', callback: 'ppfeufer_favicon_ico');

/**
 * Adding favicons
 *
 * @return void
 */
function ppfeufer_favicons(): void {
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/apple-touch-icon.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/favicon-32x32.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="192x192" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/android-chrome-192x192.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/favicon-16x16.png">' . "\n";
    echo '<link rel="manifest" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/site.webmanifest">' . "\n";
    echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/Assets/favicons/favicon.ico">' . "\n";

    echo __create_meta_tag(
            property: 'msapplication-TileColor', content: '#da532c', type: 'name'
        ) . "\n";
    echo __create_meta_tag(
            property: 'msapplication-TileImage',
            content: get_stylesheet_directory_uri() . '/Assets/favicons/mstile-144x144.png',
            type: 'name'
        ) . "\n";
    echo __create_meta_tag(
            property: 'msapplication-config',
            content: get_stylesheet_directory_uri() . '/Assets/favicons/browserconfig.xml',
            type: 'name'
        ) . "\n";
    echo __create_meta_tag(
            property: 'theme-color', content: '#ffffff', type: 'name'
        ) . "\n";
}

add_action(hook_name: 'wp_head', callback: 'ppfeufer_favicons');

/**
 * Disable footer credits
 *
 * @return string
 */
function wp_moose_footer_credits(): string {
    return '';
}

add_action(
    hook_name: 'wp_moose_action_footer',
    callback: 'wp_moose_footer_credits',
    priority: 30
);

/**
 * Remove website field from comment form to prevent backlink spam
 *
 * @param array $fields All form fields used in the comment form
 * @return array Our form fields we use in the comment form
 */
function remove_website_field_from_comment_form(array $fields): array {
    if (isset($fields['url'])) {
        unset($fields['url']);
    }

    return $fields;
}

add_filter(
    hook_name: 'comment_form_default_fields',
    callback: 'remove_website_field_from_comment_form'
);

/**
 * Change the label text for the cookie consent checkbox in comment form
 *
 * @param array $fields All form fields used in the comment form
 * @return array Our form fields we use in the comment form
 */
function comment_form_change_cookie_consent_checkbox_label(array $fields): array {
    if (!is_admin()) {
        $commenter = wp_get_current_commenter();
        $consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
        $consentText = __(
            text: 'Save my name and email in this browser for the next time I comment.',
            domain: 'ppfeufer'
        );
        $fields['cookies'] = '<p class="comment-form-cookies-consent">
                                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . '>
                                <label for="wp-comment-cookies-consent">' . $consentText . '</label>
                            </p>';
    }

    return $fields;
}

add_filter(
    hook_name: 'comment_form_default_fields',
    callback: 'comment_form_change_cookie_consent_checkbox_label'
);

/**
 * Set the title separator
 *
 * @return string
 */
function ppfeufer_title_separator(): string {
    return '»';
}

add_filter(hook_name: 'document_title_separator', callback: 'ppfeufer_title_separator');

/**
 * Remove the protocol from a given URL
 *
 * @param string $url
 * @return string
 */
function remove_protocol_from_url(string $url): string {
    return preg_replace(pattern: '#^https?://#', replacement: '', subject: $url);
}

/**
 * Use article image as og:image meta tag
 *
 * @return void
 */
function ppfeufer_og_tags(): void {
    // WP info
    $wpSiteUrl = get_bloginfo(show: 'url', filter: 'display');
    $wpSiteDescription = get_bloginfo(show: 'description', filter: 'display');
    $wpSiteName = get_bloginfo(show: 'name');

    // OG info
    $ogType = 'website';
    $ogDescription = $wpSiteDescription;
    $ogSiteName = $wpSiteName . ' / ' . remove_protocol_from_url(url: $wpSiteUrl);
    $ogTitle = $wpSiteName;
    $ogUrl = home_url(path: add_query_arg(null, null));

    // On every singular page except home page
    if (is_singular()) {
        $ogTitle = get_the_title();
        $ogDescription = get_the_excerpt();
    }

    // On blog articles
    if (is_single()) {
        $ogType = 'article';
        $ogArticleImage = wp_get_attachment_image_src(
            attachment_id: get_post_thumbnail_id(), size: 'full'
        );

        if ($ogArticleImage) {
            echo __create_meta_tag(
                    property: 'og:image', content: $ogArticleImage['0']
                ) . "\n";
            echo __create_meta_tag(
                    property: 'og:image:url', content: $ogArticleImage['0']
                ) . "\n";
            echo __create_meta_tag(
                    property: 'og:image:width', content: $ogArticleImage['1']
                ) . "\n";
            echo __create_meta_tag(
                    property: 'og:image:height', content: $ogArticleImage['2']
                ) . "\n";
            echo __create_meta_tag(
                    property: 'og:image:alt', content: $ogDescription
                ) . "\n";

            // Twitter cards
            echo __create_meta_tag(
                    property: 'twitter:image:src',
                    content: $ogArticleImage['0'],
                    type: 'name'
                ) . "\n";

            if ($ogArticleImage['1'] > 1000) {
                echo __create_meta_tag(
                        property: 'twitter:card',
                        content: 'summary_large_image',
                        type: 'name'
                    ) . "\n";
            }
        }
    }

    echo __create_meta_tag(property: 'og:type', content: $ogType) . "\n";
    echo __create_meta_tag(property: 'og:site_name', content: $ogSiteName) . "\n";
    echo __create_meta_tag(property: 'og:url', content: $ogUrl) . "\n";
    echo __create_meta_tag(property: 'og:title', content: $ogTitle) . "\n";
    echo __create_meta_tag(property: 'og:description', content: $ogDescription) . "\n";

    // Twitter cards
    echo __create_meta_tag(
            property: 'twitter:title', content: $ogTitle, type: 'name'
        ) . "\n";
    echo __create_meta_tag(
            property: 'twitter:site', content: '@ppfeufer', type: 'name'
        ) . "\n";
    echo __create_meta_tag(
            property: 'twitter:description', content: $ogDescription, type: 'name'
        ) . "\n";
}

add_action(hook_name: 'wp_head', callback: 'ppfeufer_og_tags');

/**
 * Remove DNS prefetch
 *
 * @return void
 */
function remove_dns_prefetch(): void {
    remove_action(hook_name: 'wp_head', callback: 'wp_resource_hints', priority: 2);
}

add_action(hook_name: 'init', callback: 'remove_dns_prefetch');

/**
 * Add SVG-Sprite to footer hook
 *
 * @return void
 */
function ppfeufer_svg_sprite(): void {
    include 'Assets/images/sprite.svg';
}

add_action(hook_name: 'wp_footer', callback: 'ppfeufer_svg_sprite');

/**
 * Add general native lazy-loading support
 *
 * @param array $attr
 * @param WP_Post $attachment
 * @param string|array $size
 * @return array
 */
function ppfeufer_add_lazy_loading(
    array $attr, WP_Post $attachment, string|array $size
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

add_filter(
    hook_name: 'wp_get_attachment_image_attributes',
    callback: 'ppfeufer_add_lazy_loading',
    accepted_args: 3
);

/**
 * Change the search URL
 *
 * @return void
 */
#[NoReturn] function ppfeufer_change_search_url(): void {
    if (isset($_GET['s']) && is_search()) {
        wp_redirect(
            location: home_url(
                path: "/search/"
            ) . strtolower(urlencode(get_query_var(query_var: 's')) . '/')
        );

        exit();
    }
}

add_action(hook_name: 'template_redirect', callback: 'ppfeufer_change_search_url');
