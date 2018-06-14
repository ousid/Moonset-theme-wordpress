<?php 

// default wordpress widgets


/**
 *
 *
 *
 */

function moon_tagCloud_default_font( $args ) {

	$args['smallest'] 	= 8;
	$args['largest'] 	= 8;

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'moon_tagCloud_default_font' );

// save posts views 

/**
 *
 *
 *
 */

function moon_save_post_views( $postID ) {

	$metaKey = 'moon_post_views';
	$views 	 = get_post_meta( $postID, $metaKey, true );

	$count 	 = ( empty( $views ) ? 0 : $views );

	// increase the views count
	++$count;

	// update post meta 
	update_post_meta( $postID, $metaKey, $count );

	return $views;

}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
