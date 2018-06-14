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
          <?php // if ( is_paged() ): ?>
          <!--
            <div class="container text-center load-prev">
              <a class="btn-load-prev" id="btn-load" data-prev="1" data-page="<?php // echo moon_check_paged( 1 ) ?>" data-url="<?php // echo admin_url( 'admin-ajax.php' ) ?>">
                <i class="fa fa-sync-alt" aria-hidden="true"></i>
                <span class="text">Load Previous</span>
              </a>
            </div>
            -->
          <?php // endif; ?>
          </div>
            <div class="container moon-posts-container">
                <?php
                    if ( have_posts() ):
                      ?><div class="page-limit" data-page="<?php // echo  moon_check_paged() ?>"><?php
                      while( have_posts() ):
                          the_post();
                          get_template_part( 'template-parts/content', get_post_format() );
                      endwhile;
                      ?></div><?php
                    endif;
                ?>
            </div>  <!-- .container -->
            <!--
            <div class="container text-center load-more">
              <a class="btn-load" id="btn-load" data-page="<?php // echo moon_check_paged( 1 ) ?>" data-url="<?php  // echo admin_url( 'admin-ajax.php' ) ?>">
                <i class="fa fa-sync-alt" aria-hidden="true"></i>
                <span class="text">Load More</span>
              </a>
            </div>
            -->
        </main>
        <div class="pagination-style text-center">
          <?php echo moon_pagination() ?>

        </div>

    </div>

<?php get_footer() ?>
