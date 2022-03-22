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
