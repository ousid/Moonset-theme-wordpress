      <footer class="footer">
		<div class="row">
			<div class="col col-md-4">
				<h4 class="text-center moon-widget-title">leatest Posts</h4>

				<?php 

					$arg = array(
						'posts_per_page'	=> 5,
					);

					$query = moon_get_queries( $arg );

					if ( $query->have_posts() ):
						while( $query->have_posts() ):

							$query->the_post();
						 	?><span class="cat_title"><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a></span><?php

						endwhile;
					endif;
				?>
			</div>
			
			<div class="col col-md-4">
				<h4 class="text-center moon-widget-title">Hot Topic</h4>

				<?php 

					// add and external option for the argument that was passed into wp_query class
					$arg['orderby'] = 'comments_count';

					$query = moon_get_queries( $arg );

					if ( $query->have_posts() ):
						while( $query->have_posts() ):

							$query->the_post();
						 	?><span class="cat_title"><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a></span><?php

						endwhile;
					endif;

				?>
			</div>

			<div class="col col-md-4 hidden-xs">
				<?php if (is_single() ): ?>
					<h4 class="text-center moon-widget-title">Tags</h4>
					<?php
						if ( is_tag() ):
					 		echo the_tags('<span class="tagcloud">', ' ', '</span>');
					 	else:
					 		echo '<span class="text text-danger">No Tags Selected For This topic!</span>';
					 	endif;
					 ?>
				<?php else: ?>
					<h4 class="text-center moon-widget-title">Navigation Links</h4>						
						<?php 
							$arg = array(
								'theme_location' => 'footer',
								'container'		 => false,
								'menu_class'	 => 'custom_nav_menu',
								'depth'			 => 1
							);

							wp_nav_menu( $arg );
						?>
				<?php endif ?>
			</div>
		<div class="col col-sm-12">
			<hr style="background: #FF0"/>
			<span class="text-center copyright">
	        	All <span class="text-warning">Copyright&copy;</span> to OsCode
	        </span>
	    </div>
      </footer>
        <?php wp_footer() ?>
    </body>
</html>
