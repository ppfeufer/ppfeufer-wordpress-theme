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
        $extension = '.min.js';
        if(\WP_DEBUG === true) {
            $extension = '.js';
        }

        /**
         * Only in Frontend
         */
        if(!\is_admin()) {
            // deregister certain js we have our own of
            \wp_deregister_script('bootstrap');
            \wp_deregister_script('bootstrap-js');
            \wp_deregister_script('font-awesome');

            // register our own js
            \wp_enqueue_script('bootstrap-js', '//static.ppfeufer.de/libraries/bootstrap/4.3.1/js/bootstrap' . $extension, ['jquery'], false, true);
            \wp_enqueue_script('font-awesome-js', '//static.ppfeufer.de/libraries/font-awesome/5.9.0/js/all' . $extension, [], false, true);
            \wp_enqueue_script('ppfeufer-main', \get_theme_file_uri('/Assets/JavaScript/main' . $extension), ['jquery'], false, true);
//            \wp_localize_script('eve-online-fitting-manager-js', 'fittingManagerL10n', $this->getJavaScriptTranslations());
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
//                        'success' => \__('EFT data successfully copied', 'ppfeufer'),
//                        'error' => \__('Something went wrong. Nothing copied. Maybe your browser doesn\'t support this function.', 'ppfeufer')
//                    ]
//                ],
//                'permalink' => [
//                    'text' => [
//                        'success' => \__('Permalink successfully copied', 'ppfeufer'),
//                        'error' => \__('Something went wrong. Nothing copied. Maybe your browser doesn\'t support this function.', 'ppfeufer')
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
