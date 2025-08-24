jQuery(document).ready(() => {
    'use strict';

    const copyButton = {
        copyCode: `<svg style="width: 16px; height: 16px;"><use href="#copy-code"></use></svg>`,
        codeCopied: `<svg style="width: 16px; height: 16px;"><use href="#code-copied"></use></svg>`
    };

    /**
     * Copy code to clipboard
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
     * Add copy buttons to code blocks
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

    // Use setTimeout instead of custom sleep function
    // setTimeout(addCopyButtons, 2000);
    addCopyButtons();
});
