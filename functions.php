<?php
/**
 * Enqueue the child themes CSS
 *
 * @return void
 */
function ppfeufer_enqueue_styles() {
    wp_enqueue_style('ppfeufer-theme-style', get_theme_file_uri('/css/ppfeufer.min.css'), ['wp-moose-style']);
}

add_action('wp_enqueue_scripts', 'ppfeufer_enqueue_styles');


/**
 * Redirect to the right favicon.ico
 *
 * WordPress redirects to a default favicon (admin_url('images/w-logo-blue.png')) since v5.5, which is not what I want
 * so I have to do it myself here ...
 *
 * https://ppfeufer.de/favicon.ico will be redirected to get_theme_file_uri('/favicons/favicon.ico')
 *
 * @see https://make.wordpress.org/core/2020/02/19/enhancements-to-favicon-handling-in-wordpress-5-4/
 *
 * @return void
 */
function ppfeufer_favicon_ico() {
    wp_redirect(get_site_icon_url(32, get_theme_file_uri('/favicons/favicon.ico')));

    exit;
}

add_action('do_faviconico', 'ppfeufer_favicon_ico');


/**
 * Adding favicons
 *
 * @return void
 */
function ppfeufer_favicons() {
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
 * @return void
 */
function wp_moose_footer_credits() {
    if (is_child_theme()) {
        return;
    }
}

add_action('wp_moose_action_footer', 'wp_moose_footer_copyright', 20);
