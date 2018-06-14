<?php
/**
 * index file for load the header, Navigation Menu
 * Load Posts, get the footer
 * include the scripts and stylesheet
 *
 * @package Moonset
 * @author osCode [ossama Sid]
 */
?>

<?php get_header() ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
          </div>
            <div class="container">
                <?php
                    if ( have_posts() ):
                      while( have_posts() ):
                          the_post();
                          get_template_part( 'template-parts/content', 'page' );
                      endwhile;
                      ?></div><?php
                    endif;
                ?>
            </div>  <!-- .container -->
        </main>
    </div>

<?php get_footer() ?>
