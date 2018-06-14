<?php


$options = get_option( 'post_formats' );
$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
$output = array();
foreach ( $formats as $format ) {// make loop through formats variable
    $output[] = (@$options[$format] == 1 ? $format : ''); // if the input status is checked add the formats options if not skip
}

if ( !empty( $options ) ) { // if the formats options is not empty add the theme support
    add_theme_support('post-formats', $output);
}

$header = get_option( 'custom_support_header' ); // bring the custom support header id

if ( @$header == 1 ) {// if there's checked status
    add_theme_support('custom-header');
}

// check if the background is active in the admin panel
$background = get_option( 'custom_support_background' );

if ( @$background == 1 ) {
    add_theme_support('custom-background');
}

// activate img thumbnail [by default is activated in our theme]

add_theme_support( 'post-thumbnails' );

// activate HTML5 features
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

// active navbar

function moon_sidebar_init() {
	$arg = array (
		'name'			=> esc_html__('Moonset Sidebar', 'moonset'),
		'id'			=> 'moonset-sidebar',
		'description'	=> 'Dynamic Right Sidebar',
		'before_widget'	=> '<section id="%1$s" class="moon-widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h2 class="moon-widget-title">',
		'after_title'	=> '</h2>',
	);
	register_sidebar( $arg );
}

add_action( 'widgets_init', 'moon_sidebar_init' );


// initialize global Mobile Detect 

function mobileDetectGlobal() {
	global $detect;

	$detect = new Mobile_Detect;
}

add_action( 'after_setup_theme', 'mobileDetectGlobal' );


/**
 *
 *
 *
 */

/*
function prefix_nav_description( $item_output, $item, $depth ,  $args ) {

	if ( !empty( $item->description ) ) {
		$item_output = $str_replace( $args->link_after . '</a>', '<span class="menu-item-description"' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}

add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description' );
*/