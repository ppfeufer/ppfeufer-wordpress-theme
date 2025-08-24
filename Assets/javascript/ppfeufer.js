jQuery(document).ready(() => {
    'use strict';

    // const copyButtonLabel = 'Copy Code';
    const copyButtonLabel = `<svg style="width: 16px; height: 16px;"><use href="#copy-code"></use></svg>`;
    const sleep = ms => new Promise(r => setTimeout(r, ms));


    /**
     * Copy code to clipboard
     *
     * @param block
     * @param button
     * @returns {Promise<void>}
     * @see https://developer.mozilla.org/en-US/docs/Web/API/Clipboard/writeText
     */
    const copyCode = async (block, button) => {
        const code = block.querySelector('td.code div.container');
        const text = code.innerText;

        await navigator.clipboard.writeText(text);

        // Visual feedback that task is completed
        // button.innerText = 'Code Copied';
        button.innerHTML = `<svg style="width: 16px; height: 16px;"><use href="#code-copied"></use></svg>`;

        setTimeout(() => {
            button.innerHTML = copyButtonLabel;
        }, 5000);
    };


    /**
     * Add header to code blocks
     *
     * @returns {Promise<void>}
     */
    const addHeaderToCodeBlocks = async () => {
        await sleep(2000);

        const blocks = document.querySelectorAll('div.wp-block-syntaxhighlighter-code');

        blocks.forEach((block) => {
            // Only add button if the browser supports Clipboard API
            if (navigator.clipboard) {
                const button = document.createElement('span');

                button.innerHTML = copyButtonLabel;
                button.classList.add('copy-to-clipboard');

                button.addEventListener('click', async () => {
                    await copyCode(block, button);
                });

                block.prepend(button);
            }
        });
    };

    addHeaderToCodeBlocks();
});
