<?php 

/**
 * this function is for register a navMneus in verious Location 
 *  is passed an array on register_nav_menu built in function from wordpress 
 *
 * @param void 
 * @return mix
 * @version 1.0.0
 */

 function moon_register_nav_menu() {
    register_nav_menus( array(
        'primary' 	=> __( 'Primary Menu', 'moonset' ),
        'footer'	=> __( 'Fotter Menu', 'mooonset' ),
        'mega'		=> __( 'Mega Menu', 'moonset' ),
    ));    
 }

 add_action('after_setup_theme', 'moon_register_nav_menu');
 