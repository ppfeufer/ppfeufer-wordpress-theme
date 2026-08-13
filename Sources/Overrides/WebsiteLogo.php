<?php

namespace Ppfeufer\Theme\Ppfeufer\Overrides;

class WebsiteLogo {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        $this->overrideWebsiteLogo();
    }

    /**
     * Override the website logo
     *
     * @return void
     * @access private
     */
    private function overrideWebsiteLogo(): void {
        // Override the website logo title
        add_filter('generate_logo_title', static function (string $title): string {
            return esc_html__(
                'H. Peter Pfeufer - Web developer and WordPress enthusiast',
                'ppfeufer'
            );
        });

        // Override the website logo URL
        add_filter('generate_logo', static function (string $logo_url): string {
            return get_stylesheet_directory_uri() . '/Assets/images/ppfeufer-128x128.jpg';
        });

        // Override the website retina logo URL
        add_filter('generate_retina_logo', static function (string $retina_url): string {
            return get_stylesheet_directory_uri() . '/Assets/images/ppfeufer-256x256.jpg';
        });

        // Override the website logo output
        add_filter('generate_logo_output', static function (string $html, string $logo_url, string $html_attr): string {
            $attr = [
                'class' => 'header-image is-logo-image',
                'src' => esc_url($logo_url),
                'alt' => esc_attr(apply_filters(
                    'generate_logo_title',
                    get_bloginfo('name', 'display')
                )),
                'title' => esc_attr(apply_filters(
                    'generate_logo_title',
                    get_bloginfo('name', 'display')
                )),
                'loading' => 'lazy',
                'width' => '128',
                'height' => '128',
            ];

            $retina_logo_url = esc_url(apply_filters('generate_retina_logo', ''));

            if ('' !== $retina_logo_url) {
                $attr['srcset'] = esc_url($logo_url) . ' 1x, ' . $retina_logo_url . ' 2x';
            }

            $img_attr = '';
            foreach ($attr as $name => $value) {
                $img_attr .= ' ' . $name . '="' . $value . '"';
            }

            return sprintf(
                '<div class="site-logo">
                    <a href="%1$s" rel="home" aria-label="%2$s">
                        <img%3$s>
                    </a>
                </div>',
                esc_url(home_url('/')),
                esc_attr(get_bloginfo('name')),
                $img_attr
            );
        }, 10, 3);
    }
}
