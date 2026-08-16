<?php

namespace Ppfeufer\Theme\Ppfeufer\Overrides;

class WebsiteFooter {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        $this->overrideFooter();
    }

    /**
     * Override the website footer
     *
     * @return void
     * @access private
     */
    private function overrideFooter(): void {
        // Override the website footer copyright
        add_filter('generate_copyright', [$this, 'generateCopyright']);
    }

    /**
     * Generate the website footer copyright
     *
     * @return string
     * @access public
     */
    public function generateCopyright(): string {
        return sprintf(
            '<span class="copyright">&copy; %1$s %2$s</span>',
            date('Y'),
            esc_html(get_bloginfo('name')),
        );
    }
}
