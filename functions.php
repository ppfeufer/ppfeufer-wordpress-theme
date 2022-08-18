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

use WordPress\Themes\Ppfeufer\Plugins\Shortcodes;

require_once(get_theme_file_path('inc/autoloader.php'));

// Load Libraries
new Shortcodes;

/**
 * Enqueue the child themes CSS
 *
 * @return void
 */
function ppfeufer_enqueue_styles(): void {
    wp_enqueue_style(
        'fira-code',
        get_theme_file_uri('/css/libs/fira-code/6.2.0/fira_code.min.css'),
        [],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'ppfeufer-theme-style-defaults',
        get_theme_file_uri('/css/ppfeufer-defaults.min.css'),
        ['fira-code', 'wp-moose-style'],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'ppfeufer-theme-style',
        get_theme_file_uri('/css/ppfeufer.min.css'),
        ['ppfeufer-theme-style-defaults'],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'ppfeufer-plugin-styles',
        get_theme_file_uri('/css/plugin-styles.min.css'),
        ['ppfeufer-theme-style'],
        wp_get_theme()->get('Version')
    );
}

add_action('wp_enqueue_scripts', 'ppfeufer_enqueue_styles');

/**
 * Enqueue admin CSS
 *
 * @return void
 */
function ppfeufer_enqueue_admin_styles(): void {
    wp_enqueue_style(
        'fira-code',
        get_theme_file_uri('/css/libs/fira-code/6.2.0/fira_code.min.css'),
        [],
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
        'ppfeufer-admin-style',
        get_theme_file_uri('/css/ppfeufer-admin-style.min.css'),
        ['fira-code'],
        wp_get_theme()->get('Version')
    );
}

add_action('admin_enqueue_scripts', 'ppfeufer_enqueue_admin_styles');

/**
 * Redirect to the right favicon.ico
 *
 * WordPress redirects to a default favicon (admin_url('images/w-logo-blue.png')) since v5.5, which is not what I want,
 * so I have to do it myself here ...
 *
 * https://ppfeufer.de/favicon.ico will be redirected to get_theme_file_uri('/favicons/favicon.ico')
 *
 * @see https://make.wordpress.org/core/2020/02/19/enhancements-to-favicon-handling-in-wordpress-5-4/
 *
 * @return void
 */
function ppfeufer_favicon_ico(): void {
    wp_redirect(get_site_icon_url(32, get_theme_file_uri('/favicons/favicon.ico')));

    exit;
}

add_action('do_faviconico', 'ppfeufer_favicon_ico');

/**
 * Adding favicons
 *
 * @return void
 */
function ppfeufer_favicons(): void {
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . get_stylesheet_directory_uri() . '/favicons/apple-touch-icon.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_stylesheet_directory_uri() . '/favicons/favicon-32x32.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="192x192" href="' . get_stylesheet_directory_uri() . '/favicons/android-chrome-192x192.png">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . get_stylesheet_directory_uri() . '/favicons/favicon-16x16.png">' . "\n";
    echo '<link rel="manifest" href="' . get_stylesheet_directory_uri() . '/favicons/site.webmanifest">' . "\n";
    echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/favicons/favicon.ico">' . "\n";
    echo '<meta name="msapplication-TileColor" content="#da532c">' . "\n";
    echo '<meta name="msapplication-TileImage" content="' . get_stylesheet_directory_uri() . '/favicons/mstile-144x144.png">' . "\n";
    echo '<meta name="msapplication-config" content="' . get_stylesheet_directory_uri() . '/favicons/browserconfig.xml">' . "\n";
    echo '<meta name="theme-color" content="#ffffff">' . "\n";
}

add_action('wp_head', 'ppfeufer_favicons');

/**
 * Disable footer credits
 *
 * @return string
 */
function wp_moose_footer_credits(): string {
    return '';
}

add_action('wp_moose_action_footer', 'wp_moose_footer_credits', 30);

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

add_filter('comment_form_default_fields', 'remove_website_field_from_comment_form');

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
        $consentText = __('Save my name and email in this browser for the next time I comment.', 'ppfeufer');
        $fields['cookies'] = '<p class="comment-form-cookies-consent">
                                <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . '>
                                <label for="wp-comment-cookies-consent">' . $consentText . '</label>
                            </p>';
    }

    return $fields;
}

add_filter('comment_form_default_fields', 'comment_form_change_cookie_consent_checkbox_label');

/**
 * Set the title separator
 *
 * @return string
 */
function ppfeufer_title_separator(): string {
    return '»';
}

add_filter('document_title_separator', 'ppfeufer_title_separator');

/**
 * Remove the protocol from a given URL
 *
 * @param string $url
 * @return string
 */
function remove_protocol_from_url(string $url): string {
    $disallowed = ['http://', 'https://'];

    foreach ($disallowed as $d) {
        if (strpos($url, $d) === 0) {
            return str_replace($d, '', $url);
        }
    }

    return $url;
}

/**
 * Use article image as og:image meta tag
 *
 * @return void
 */
function ppfeufer_og_tags(): void {
    // WP info
    $wpSiteUrl = get_bloginfo('url', 'display');
    $wpSiteDescription = get_bloginfo('description', 'display');
    $wpSiteName = get_bloginfo('name');

    // OG info
    $ogType = 'website';
    $ogDescription = $wpSiteDescription;
    $ogSiteName = $wpSiteName . ' / ' . remove_protocol_from_url($wpSiteUrl);
    $ogTitle = $wpSiteName;
    $ogUrl = home_url(add_query_arg(null, null));

    // On every singular page except home page
    if (is_singular()) {
        $ogTitle = get_the_title();
        $ogDescription = get_the_excerpt();
    }

    // On blog articles
    if (is_single()) {
        $ogType = 'article';
        $ogArticleImage = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');

        if ($ogArticleImage) {
            echo '<meta property="og:image" content="' . $ogArticleImage['0'] . '">';
            echo '<meta property="og:image:url" content="' . $ogArticleImage['0'] . '">';
            echo '<meta property="og:image:width" content="' . $ogArticleImage['1'] . '">';
            echo '<meta property="og:image:height" content="' . $ogArticleImage['2'] . '">';
            echo '<meta property="twitter:image" content="' . $ogArticleImage['0'] . '">';
        }
    }

    echo '<meta property="og:type" content="' . $ogType . '">';
    echo '<meta property="og:site_name" content="' . $ogSiteName . '">';
    echo '<meta property="og:url" content="' . $ogUrl . '">';
    echo '<meta property="og:title" content="' . $ogTitle . '">';
    echo '<meta property="og:description" content="' . $ogDescription . '">';
}

add_action('wp_head', 'ppfeufer_og_tags');
