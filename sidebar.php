<?php

/**
 *
 *
 */

if ( ! is_active_sidebar( 'moonset-sidebar' ) ):
	return;
endif;

?>

<aside id="secondary" class="widget-area" role="compolementary">
	<div class="visible-xs">

	    <?php wp_nav_menu(array(
	        'theme_location' => 'primary',
	        'container'      => false,
	        'menu_class'     => 'nav navbar-nav navbar-collapse',
	        'depth'          => 2,
	        'walker'         => new WP_Bootstrap_Navwalker(),
	    )) ?>
	</div>

	<?php 
		dynamic_sidebar( 'moonset-sidebar ' );
	?>
</aside>