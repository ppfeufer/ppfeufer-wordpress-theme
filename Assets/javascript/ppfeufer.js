/* global Masonry */

jQuery(document).ready(($) => {
    'use strict';

    // HTML elements used in the script
    const elements = {
        copyButton: {
            copyCode: '<svg style="width: 16px; height: 16px;"><use href="#copy-code"></use></svg>',
            codeCopied: '<svg style="width: 16px; height: 16px;"><use href="#code-copied"></use></svg>'
        }
    };

    /**
     * Extend links to external website.
     *
     * » add target="_blank"
     * » add referrerpolicy="no-referrer"
     * » add rel="noopener noreferrer"
     */
    const externalLinks = () => {
        // Get the current location hostname
        const internalHost = [location.hostname];

        // Regex pattern to match HTTP and HTTPS
        const protocolPattern = /^https?:\/\//i;

        // Walk through all links on the current page.
        $('a').each((index, element) => { // jshint ignore:line
            // Get the href attribute of the link
            const href = $(element).attr('href');

            // Check if it's an HTTP link
            if (protocolPattern.test(href)) {
                // Get the hostname of the link
                const hrefHostname = new URL(href).hostname;

                // Check if the hostname is not in the internalHost array or if the link has the class 'external-link',
                // and add the target and classes and attributes to the link element.
                if (
                    // Check if the hostname is not in the internalHost array
                    $.inArray(hrefHostname, internalHost) === -1
                    // Check if the link has the class 'external-link'
                    || $(element).hasClass('external-link') // jshint ignore:line
                    // Check if the parent <li> element has the class 'external-link'.
                    // This is useful for links in navigation menus that are marked as
                    // external links, as WordPress does not add the 'external-link'
                    // class to the <a> element, but to the parent <li> element.
                    || $(element).parent('li.menu-item').hasClass('external-link') // jshint ignore:line
                ) {
                    $(element).addClass('external-link');
                    $(element).attr('target', '_blank');
                    $(element).attr('rel', 'noopener noreferrer');
                    $(element).attr('referrerpolicy', 'no-referrer');
                }
            }
        });
    };

    /**
     * Copy code to clipboard.
     *
     * @param block
     * @param button
     * @returns {Promise<void>}
     */
    const copyCode = async (block, button) => {
        const code = block.querySelector('td.code div.container');

        try {
            await navigator.clipboard.writeText(code.innerText);

            // Visual feedback
            button.innerHTML = elements.copyButton.codeCopied;

            setTimeout(() => {
                button.innerHTML = elements.copyButton.copyCode;
            }, 5000);
        } catch (err) {
            console.error('Failed to copy code:', err);
        }
    };

    /**
     * Add copy buttons to code blocks.
     */
    const addCopyButtons = () => {
        // Only proceed if browser supports Clipboard API
        if (!navigator.clipboard) {
            return;
        }

        const blocks = document.querySelectorAll('div.wp-block-syntaxhighlighter-code');

        blocks.forEach((block) => {
            const button = document.createElement('span');

            button.innerHTML = elements.copyButton.copyCode;
            button.classList.add('copy-to-clipboard');
            button.addEventListener('click', () => {
                copyCode(block, button);
            });

            block.prepend(button);
        });
    };

    /**
     * Initialize Masonry layout for blog, search, and archive pages.
     */
    const initMasonry = () => {
        const grid = document.querySelector(
            'body.blog .site-main, body.search .site-main, body.archive .site-main'
        );
        const articles = grid ? grid.querySelectorAll('article') : [];

        // Only initialize Masonry if there are multiple articles to display
        if (grid && articles.length > 1) {
            articles.forEach(article => article.classList.add('masonry-item'));

            const msnry = new Masonry(grid, { // eslint-disable-line no-unused-vars
                columnWidth: '.masonry-item',
                gutter: 20,
                itemSelector: '.masonry-item',
                maxColumnHeightDifference: 1,
                percentPosition: true,
                stamp: '.site-main .page-header'
            });
        }
    };

    /**
     * Initialize sticky elements on the page.
     */
    // const initStickyElements = () => {
    //     const stickyElements = [
    //         // {
    //         //     selector: '.site-header',
    //         //     stickyOptions: {
    //         //         topSpacing: -20,
    //         //         zIndex: 9999
    //         //     },
    //         // },
    //         {
    //             selector: '.widget-area.sidebar > div',
    //             stickyOptions: {
    //                 getWidthFrom: '.widget-area.sidebar',
    //                 responsiveWidth: true,
    //                 // topSpacing: 165, // To accommodate the height of the header and any other fixed elements above the sidebar
    //             },
    //         }
    //     ];
    //
    //     stickyElements.forEach(element => {
    //         if ($(element.selector).length) {
    //             $(element.selector).sticky(element.stickyOptions);
    //         }
    //     });
    // };

    // Use setTimeout instead of custom sleep function
    // setTimeout(addCopyButtons, 2000);
    externalLinks();
    addCopyButtons();
    initMasonry();
    // initStickyElements();
});
