<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer\Tweaks;

/**
 * Search URL
 *
 * This class is responsible for modifying the search URL.
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer\Tweaks
 * @since 1.0.0
 */
class SearchUrl {
    /**
     * Constructor
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        add_filter(
            hook_name: 'template_redirect',
            callback: [$this, 'searchUrl']
        );
    }

    /**
     * Search URL
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function searchUrl(): void {
        if (isset($_GET['s']) && is_search()) {
            wp_redirect(
                location: home_url(
                    path: "/search/"
                ) . strtolower(urlencode(get_query_var(query_var: 's')) . '/')
            );

            exit();
        }
    }
}
