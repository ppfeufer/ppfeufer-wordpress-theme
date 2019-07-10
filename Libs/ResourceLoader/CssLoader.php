<?php

namespace WordPress\Themes\Ppfeufer\ResourceLoader;

/**
 * CSS Loader
 */
class CssLoader implements \WordPress\Themes\Ppfeufer\Interfaces\AssetsInterface {
    /**
     * Initialize the loader
     */
    public function init() {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue'], 99);
    }

    /**
     * Load the styles
     */
    public function enqueue() {
        /**
         * Only in Frontend
         */
        if(!\is_admin()) {
            /**
             * load only when needed
             */
            if(\is_page(\WordPress\Plugin\EveOnlineFittingManager\Libs\PostType::getPosttypeSlug('fittings')) || \get_post_type() === 'fitting') {
                \wp_enqueue_style('bootstrap', \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('bootstrap/css/bootstrap.min.css'));
                \wp_enqueue_style('eve-online-fitting-manager', \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('css/eve-online-fitting-manager.min.css'));
            }
        }
    }
}
