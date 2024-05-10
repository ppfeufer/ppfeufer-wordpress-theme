<?php

namespace WordPress\Ppfeufer\Theme\Ppfeufer\Tweaks;

use WordPress\Ppfeufer\Theme\Ppfeufer\Helper\Metatags;
use WordPress\Ppfeufer\Theme\Ppfeufer\Helper\Url;

/**
 * Open Graph
 *
 * This class is responsible for adding Open Graph tags to the theme.
 *
 * @package WordPress\Ppfeufer\Theme\Ppfeufer\Tweaks
 */
class OpenGraph {
    /**
     * Constructor
     *
     * @return void
     * @access public
     */
    public function __construct() {
        add_action(
            hook_name: 'wp_head',
            callback: [$this, 'addOpenGraphTags']
        );
    }

    /**
     * Add Open Graph tags to the theme
     *
     * @return void
     * @access public
     */
    public function addOpenGraphTags(): void {
        // WP info
        $wpSiteUrl = get_bloginfo(show: 'url', filter: 'display');
        $wpSiteDescription = get_bloginfo(show: 'description', filter: 'display');
        $wpSiteName = get_bloginfo(show: 'name');

        // OG info
        $ogType = 'website';
        $ogDescription = $wpSiteDescription;
        $ogSiteName = $wpSiteName . ' / ' . Url::removeProtocolFromUrl(url: $wpSiteUrl);
        $ogTitle = $wpSiteName;
        $ogUrl = home_url(path: add_query_arg(null, null));

        // On every singular page except home page
        if (is_singular()) {
            $ogTitle = get_the_title();
            $ogDescription = get_the_excerpt();
        }

        // On blog articles
        if (is_single()) {
            $ogType = 'article';
            $ogArticleImage = wp_get_attachment_image_src(
                attachment_id: get_post_thumbnail_id(),
                size: 'full'
            );

            if ($ogArticleImage) {
                echo Metatags::createMetaTag(
                    property: 'og:image',
                    content: $ogArticleImage['0']
                ) . "\n";
                echo Metatags::createMetaTag(
                    property: 'og:image:url',
                    content: $ogArticleImage['0']
                ) . "\n";
                echo Metatags::createMetaTag(
                    property: 'og:image:width',
                    content: $ogArticleImage['1']
                ) . "\n";
                echo Metatags::createMetaTag(
                    property: 'og:image:height',
                    content: $ogArticleImage['2']
                ) . "\n";
                echo Metatags::createMetaTag(
                    property: 'og:image:alt',
                    content: $ogDescription
                ) . "\n";

                // Twitter cards
                echo Metatags::createMetaTag(
                    property: 'twitter:image:src',
                    content: $ogArticleImage['0'],
                    type: 'name'
                ) . "\n";

                if ($ogArticleImage['1'] > 1000) {
                    echo Metatags::createMetaTag(
                        property: 'twitter:card',
                        content: 'summary_large_image',
                        type: 'name'
                    ) . "\n";
                }
            }
        }

        echo Metatags::createMetaTag(
            property: 'description',
            content: $ogDescription,
            type: 'name'
        ) . "\n";

        echo Metatags::createMetaTag(property: 'og:type', content: $ogType) . "\n";
        echo Metatags::createMetaTag(
            property: 'og:site_name',
            content: $ogSiteName
        ) . "\n";
        echo Metatags::createMetaTag(property: 'og:url', content: $ogUrl) . "\n";
        echo Metatags::createMetaTag(property: 'og:title', content: $ogTitle) . "\n";
        echo Metatags::createMetaTag(
            property: 'og:description',
            content: $ogDescription
        ) . "\n";

        // Twitter cards
        echo Metatags::createMetaTag(
            property: 'twitter:title',
            content: $ogTitle,
            type: 'name'
        ) . "\n";
        echo Metatags::createMetaTag(
            property: 'twitter:site',
            content: '@ppfeufer',
            type: 'name'
        ) . "\n";
        echo Metatags::createMetaTag(
            property: 'twitter:description',
            content: $ogDescription,
            type: 'name'
        ) . "\n";
    }
}
