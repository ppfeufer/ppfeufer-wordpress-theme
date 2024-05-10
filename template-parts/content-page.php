<?php

/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

$is_woo_page = WP_MOOSE_WOOCOMMERCE_ACTIVE && (is_cart() || is_account_page() || is_checkout());
$classes = [
    'entry-content mx-auto',
    'form-controls form-default form-primary' => $is_woo_page,
    'prose prose-moose' => !$is_woo_page,
];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (!$is_woo_page && !is_front_page()) {
        ?>
        <header class="not-prose post-header mb-gutter text-center">
            <div class="mb-half-gutter max-w-prose mx-auto">
                <?php the_title(before: '<h1 class="mt-10 mb-6 text-3xl font-bold">', after: '</h1>'); ?>

                <div class="text-xs entry-meta">
                    <span class="link text-xs">
                        <?php edit_post_link(esc_html__('Edit', 'ppfeufer')); ?>
                    </span>
                </div>
            </div>
        </header>
        <?php
    }
    ?>

    <div class="<?php wp_moose_clsx_echo($classes); ?>">
        <?php
        the_content();

        wp_link_pages(args: [
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'ppfeufer'),
            'after'  => '</div>',
        ]);
        ?>
    </div>
</article>
