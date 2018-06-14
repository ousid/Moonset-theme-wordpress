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
			<div class="container-fluid">
				<div class"row">
					<div class="col-xs-12 col-md-10 col-lg-8 col-lg-offset-2 col-md-offset-1">
						<?php
							if ( have_posts() ):
							  while( have_posts() ):
								the_post();

								moon_save_post_views( get_the_ID() );
								get_template_part( 'template-parts/single/content', get_post_format() );

								moon_post_nav();
								
								if ( comments_open() ) {
								  comments_template();
								}
							  endwhile;
							endif;
						?>
					</div> <!-- .col-xs-12 -->
                </div> <!-- .row -->
            </div>  <!-- .container -->
		</main>
	</div>

<?php get_footer() ?>