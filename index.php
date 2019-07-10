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

\get_header();
?>

<div class="container container-main">
    <!--<div class="row main-content">-->
    <div class="main-content clearfix">
        <div class="content-wrapper">
            <div class="content content-inner content-index content-loop">
                <?php
                if(\have_posts()) {
                    while(\have_posts()) {
                        \the_post();

                        \get_template_part('template-parts/content/content', \get_post_format());
                    }
                } else {
                    \get_template_part( 'template-parts/content/content', 'none' );
                }

                if(\function_exists('\wp_pagenavi')) {
                    \wp_pagenavi();
                } else {
//                    \WordPress\Themes\YulaiFederation\Helper\NavigationHelper::getInstance()->getContentNav('nav-below');
                }
                ?>
            </div>
        </div><!--/.col -->
    </div> <!--/.row -->
</div><!-- container -->

<?php
\get_footer();
