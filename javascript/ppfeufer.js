jQuery(document).ready(function ($) { // eslint-disable-line no-unused-vars
    'use strict';

    const copyButtonLabel = 'Copy Code';
    const sleep = ms => new Promise(r => setTimeout(r, ms));

    const addHeaderToCodeBlocks = async () => {
        await sleep(2000);

        const blocks = document.querySelectorAll('div.wp-block-syntaxhighlighter-code ');
        blocks.forEach((block) => {
            const header = document.createElement('header');
            const span = document.createElement('span');

            block.insertBefore(header, block.childNodes[0]);
            header.appendChild(span);

            // only add button if the browser supports Clipboard API
            if (navigator.clipboard) {
                const button = document.createElement('button');
                button.innerText = copyButtonLabel;
                button.classList.add('copy-to-clipboard');

                button.addEventListener('click', async () => {
                    await copyCode(block, button);
                });

                // block.appendChild(button);
                header.appendChild(button);
            }
        });
    };

    const copyCode = async (block, button) => {
        let code = block.querySelector('td.code div.container');
        let text = code.innerText;

        await navigator.clipboard.writeText(text);

        // visual feedback that task is completed
        button.innerText = 'Code Copied';

        setTimeout(() => {
            button.innerText = copyButtonLabel;
        }, 700);
    };

    addHeaderToCodeBlocks();
});
