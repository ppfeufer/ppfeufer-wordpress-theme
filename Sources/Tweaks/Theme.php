<?php

namespace WordPress\Themes\Ppfeufer\Tweaks;

/**
 * Theme
 *
 * This class is responsible for adding general tweaks to the theme.
 *
 * @package WordPress\Themes\Ppfeufer\Tweaks
 * @since 1.0.0
 */
class Theme {
    /**
     * Constructor
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function __construct() {
        add_action(
            hook_name: 'init',
            callback: [$this, 'disableFooterCredits'],
            priority: 30
        );
        add_action(
            hook_name: 'comment_form_default_fields',
            callback: [$this, 'removeUrlField']
        );
        add_action(
            hook_name: 'comment_form_default_fields',
            callback: [$this, 'cookieConsentCheckbox']
        );
        add_action(
            hook_name: 'document_title_separator',
            callback: [$this, 'documentTitleSeparator']
        );
    }

    /**
     * Disable footer credits
     *
     * @return void
     * @since 1.0.0
     * @access public
     */
    public function disableFooterCredits(): void {
        remove_action(
            hook_name: 'wp_moose_action_footer',
            callback: 'wp_moose_footer_credits',
            priority: 30
        );
    }

    /**
     * Remove website field from comment form to prevent backlink spam
     *
     * @param array $fields
     *
     * @return array
     * @since 1.0.0
     * @access public
     */
    public function removeUrlField(array $fields): array {
        if (isset($fields['url'])) {
            unset($fields['url']);
        }

        return $fields;
    }

    /**
     * Change the label text for the cookie consent checkbox in comment form
     *
     * @param array $fields
     *
     * @return array
     * @since 1.0.0
     * @access public
     */
    public function cookieConsentCheckbox(array $fields): array {
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

    /**
     * Change the document title separator
     *
     * @return string
     * @since 1.0.0
     * @access public
     */
    public function documentTitleSeparator(): string {
        return '»';
    }
}
