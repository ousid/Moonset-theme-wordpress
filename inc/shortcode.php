<?php

/*
 *
 *
 *
 */

 add_shortcode(	'tooltip', 'moon_tooltip' );

/**
 *
 *
 *
*/


function moon_tooltip( $atts, $content = null ) {
	// get the arrtibutes
	$arg = array(
		'placement' => 'top',
		'title'		=> '',
	);
	$atts 	= shortcode_atts($arg, $atts, 'tooltip');
	$title 	= ( empty($atts['title']) ? $content : $atts['title'] );
	// return html
	return '<span class="moon-tooltip" data-toggle="tooltip" data-placement="' . $atts['placement'] . '" title="' . $title . '">' . $content .'</span>';

}

function moon_popover( $atts, $content = null ) {
	/**
	 *  [popover title="popover" placement
	 */
	 // continue this stuff

}

/**
 *
 *
 */

function moon_contact_form( $atts, $content = null ) {

	// [contact_form]

	// get the attributes 
	$atts = shortcode_atts( array(), $atts, 'contact_form' );

	// return html 
	ob_start();

	include 'template/contact-form.php';


	return ob_get_clean();
}

// trigger the shortcode 

add_shortcode( 'contact_form', 'moon_contact_form' );
