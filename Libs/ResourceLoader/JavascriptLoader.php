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

namespace WordPress\Themes\Ppfeufer\Libs\ResourceLoader;

/**
 * JavaScript Loader
 */
class JavascriptLoader extends \WordPress\Themes\Ppfeufer\Libs\Singletons\AbstractSingleton implements \WordPress\Themes\Ppfeufer\Libs\Interfaces\AssetsInterface {
    /**
     * Load the JavaScript
     */
    public function enqueue() {
        /**
         * Only in Frontend
         */
        if(!\is_admin()) {
            // deregister certain js we have our own of
            \wp_deregister_script('bootstrap');
            \wp_deregister_script('bootstrap-js');
            \wp_deregister_script('font-awesome');

            // register our own js
            \wp_enqueue_script('bootstrap-4-js', '//static.ppfeufer.de/libraries/bootstrap/4.3.1/js/bootstrap.min.js', ['jquery'], false, true);
            \wp_enqueue_script('font-awesome-5-js', '//static.ppfeufer.de/libraries/font-awesome/5.9.0/js/all.min.js', [], false, true);
//            if(\is_page(\WordPress\Plugin\EveOnlineFittingManager\Libs\PostType::getPosttypeSlug('fittings')) || \get_post_type() === 'fitting') {
//                \wp_enqueue_script('bootstrap-toolkit-js', \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('bootstrap/bootstrap-toolkit/bootstrap-toolkit.min.js'), ['jquery', 'bootstrap-js'], '', true);
//                \wp_enqueue_script('bootstrap-gallery-js', \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('js/jquery.bootstrap-gallery.min.js'), ['jquery', 'bootstrap-js'], '', true);
//                \wp_enqueue_script('copy-to-clipboard-js', \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('js/copy-to-clipboard.min.js'), ['jquery'], '', true);
//                \wp_enqueue_script('eve-online-fitting-manager-js', \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('js/eve-online-fitting-manager.min.js'), ['jquery'], '', true);
//                \wp_localize_script('eve-online-fitting-manager-js', 'fittingManagerL10n', $this->getJavaScriptTranslations());
//            }
        }
    }

    /**
     * Getting the translation array to translate strings in JavaScript
     *
     * @return array
     */
//    private function getJavaScriptTranslations() {
//        return [
//            'copyToClipboard' => [
//                'eft' => [
//                    'text' => [
//                        'success' => \__('EFT data successfully copied', 'eve-online-fitting-manager'),
//                        'error' => \__('Something went wrong. Nothing copied. Maybe your browser doesn\'t support this function.', 'eve-online-fitting-manager')
//                    ]
//                ],
//                'permalink' => [
//                    'text' => [
//                        'success' => \__('Permalink successfully copied', 'eve-online-fitting-manager'),
//                        'error' => \__('Something went wrong. Nothing copied. Maybe your browser doesn\'t support this function.', 'eve-online-fitting-manager')
//                    ]
//                ]
//            ],
//            'ajax' => [
//                'url' => \admin_url('admin-ajax.php'),
//                'loaderImage' => \WordPress\Plugin\EveOnlineFittingManager\Helper\PluginHelper::getPluginUri('images/loader-sprite.gif'),
//                'eveFittingMarketData' => [
//                    'nonce' => \wp_create_nonce('ajax-nonce-eve-market-data-for-fitting')
//                ]
//            ]
//        ];
//    }
}
