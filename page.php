<?php

/*
 * Copyright (C) 2019 ppfeufer
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace WordPress\Themes\Ppfeufer;

\defined('ABSPATH') or die();

/**
 * Template Name: Default Page (With Sidebar)
 */

\get_header();
?>

    <div class="container main">
        <?php
        $breadcrumbNavigation = \WordPress\Themes\EveOnline\Helper\NavigationHelper::getBreadcrumbNavigation();
        if(!empty($breadcrumbNavigation)) {
            ?>
            <!--
            // Breadcrumb Navigation
            -->
            <!--<div class="row">-->
            <div class="clearfix">
                <div class="col-md-12 breadcrumb-wrapper">
                    <?php echo $breadcrumbNavigation; ?>
                </div><!--/.col -->
            </div><!--/.row -->
            <?php
        } // END if(!empty($breadcrumbNavigation))
        ?>

        <?php
        if(\have_posts()) {
            while(\have_posts()) {
                \the_post();
                ?>
                <!--<div class="row main-content">-->
                <div class="main-content clearfix">
                    <div class="<?php echo \WordPress\Themes\EveOnline\Helper\PostHelper::getMainContentColClasses(); ?> content-wrapper">
                        <div class="content content-inner content-page">
                            <header>
                                <?php
                                if(\is_front_page()) {
                                    ?>
                                    <h1><?php echo \get_bloginfo('name'); ?></h1>
                                    <?php
                                } else {
                                    ?>
                                    <h1><?php \the_title(); ?></h1>
                                    <?php
                                } // END if(\is_front_page())
                                ?>
                            </header>
                            <article class="post clearfix" id="post-<?php \the_ID(); ?>">
                                <?php
                                /**
                                 * Let's see if we are by any chance in a Video Page
                                 */
                                $isVideoGalleryPage = \get_post_meta($post->ID, 'eve_page_is_video_gallery_page', true);
                                if($isVideoGalleryPage) {
                                    $videoUrl = \get_post_meta($post->ID, 'eve_page_video_url', true);
                                    $oEmbed = \wp_oembed_get($videoUrl);

                                    echo $oEmbed;
                                } // END if($isVideoGalleryPage)

                                /**
                                 * Let's see if we are by any chance in a Corp Page
                                 */
                                $isCorpPage = \get_post_meta($post->ID, 'eve_page_is_corp_page', true);
                                $showCorpLogo = \get_post_meta($post->ID, 'eve_page_show_corp_logo', true);
                                if($isCorpPage && $showCorpLogo) {
                                    echo \WordPress\Themes\EveOnline\Plugins\Corppage::getCorprationLogo(\get_the_ID());
                                } // END if($isCorpPage && $showCorpLogo)

                                echo the_content();
                                ?>
                            </article>
                        </div> <!-- /.content -->
                    </div> <!-- /.col -->
                <?php
            } // END while(have_posts())
        } // END if(have_posts())

        if(\WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-page') || \WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-general')) {
            ?>
            <div class="col-lg-3 col-md-3 col-sm-3 col-3 sidebar-wrapper">
                <?php
                if(\WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-page')) {
                    \get_sidebar('page');
                } // END if(\WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-page'))

                if(\WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-general')) {
                    \get_sidebar('general');
                } // END if(\WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-general'))
                ?>
            </div><!--/.col -->
            <?php
        } // END if(\WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-page') || \WordPress\Themes\EveOnline\Helper\ThemeHelper::hasSidebar('sidebar-general'))
        ?>
    </div> <!--/.row .main-content -->
</div><!-- container -->

<?php
\get_footer();
