/* global Masonry */

// jQuery(document).ready(($) => {
jQuery(document).ready(() => {
    'use strict';

    const copyButton = {
        copyCode: `<svg style="width: 16px; height: 16px;"><use href="#copy-code"></use></svg>`,
        codeCopied: `<svg style="width: 16px; height: 16px;"><use href="#code-copied"></use></svg>`
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
            button.innerHTML = copyButton.codeCopied;

            setTimeout(() => {
                button.innerHTML = copyButton.copyCode;
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

            button.innerHTML = copyButton.copyCode;
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
    addCopyButtons();
    initMasonry();
    // initStickyElements();
});
