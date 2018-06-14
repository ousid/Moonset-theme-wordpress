<?php

/** ==================================
 * The Enqueue Stylesheet admin Functions
 * @author OsCode
 * @package moonSet
 * =================================== */


/* ================================= ADMIN SECTION LOAD STYLES | SCRIPTS =================== */
    /**
     * Function to add an Custom stylesheet for our theme Moonset
    *
    * @version 1.0.0
    * @return String
    */

    function moon_load_admin_styles( $hook ) {

        // check if the style is only included in custom area of the admin [moonset settings]
        if ('toplevel_page_oscode_moonset' == $hook | 'moonset_page_oscode_moonset_contact' == $hook ):

            // register | Store a CSS file in custom Path
            wp_register_style( 'moonset_admin', get_template_directory_uri() . '/css/moonset.admin.css', [], '1.0.0', 'all');
            wp_enqueue_style( 'moonset_admin' );
        
            // load the bootstrap styles file
            wp_enqueue_style( 'fontawesom', get_template_directory_uri(  ) . '/css/fontawesome-all.min.css', array(), '', 'all' );

        endif;

        if ( 'moonset_page_oscode_moonset_theme' == $hook):

            // register css file
            wp_register_style('moonset_admin_support', get_template_directory_uri() . '/css/moonset.admin.support.css', [], '1.0.0', 'all');
            wp_enqueue_style('moonset_admin_support');
        endif;

        if ('moonset_page_oscode_moonset_css' == $hook):
            /* ====================== ACE STYLE ===================== */
            wp_enqueue_style( 'ace_style', get_template_directory_uri(  ) . '/css/moonset.admin.custom.ace.css', array(), '1.0.0', 'all');

        endif;

    }

    /**
     * Function to add Custom scripts files
     * @version 1.0.0
     * @return void
     */

     function moon_load_admin_scripts() {


        // register jquery | moonset.admin.js scripts
        wp_register_script('jquery-custom', get_template_directory_uri() . '/js/jquery.min.js', [], false, true );
        wp_register_script( 'moonset-admin-script', get_template_directory_uri() . '/js/moonset.admin.js', ['jquery-custom'], '1.0.0', true );

        // enqueue scripts
        wp_enqueue_script( 'jquery-custom' );
        wp_enqueue_script( 'moonset-admin-script' );

        /* ================================ ADD MEDIA UPLOADER ================================== */
        // enqueue the media uploader
        wp_enqueue_media();

        /* ======================= ACE SCRIPTS ====================== */

        wp_enqueue_script( 'ace', get_template_directory_uri(  ) . '/js/ace/ace.js', array('jquery'), false, true );
        wp_enqueue_script( 'ace_custom', get_template_directory_uri(  ) . '/js/moonset.admin.custom.js', array('jquery'), '1.0.0',  true );

     }

    // add the style files
    add_action('admin_enqueue_scripts', 'moon_load_admin_styles');

    // add the script files
    add_action('admin_enqueue_scripts', 'moon_load_admin_scripts');

/* ============================= SITE SECTION LOAD STYLES | SECTION ========================= */

/**
 *
 *
 *
 */

 function moon_load_site_styles() {
    // load the bootstrap styles file
    wp_enqueue_style( 'bootstrap', get_template_directory_uri(  ) . '/css/bootstrap.css', array(), '', 'all' );

    // load the bootstrap styles file
    wp_enqueue_style( 'fontawesom', get_template_directory_uri(  ) . '/css/fontawesome-all.min.css', array(), '', 'all' );

    // load the main style for the site
    wp_enqueue_style( 'main-style', get_template_directory_uri(  ) . '/css/moonset-site.css', array(), '1.0.0', 'all' );

    // load the raleway font from google
    // wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
 }

 /**
  *
  *
  *
  */

  function moon_load_site_scripts() {
    // deregister the jquery for put it in the footer [by default the jquery file is injected in header section]
    wp_deregister_script( 'jquery' );

    // register the jquery script
    wp_register_script('jquery', includes_url( '/js/jquery/jquery.js'), array(), false, true);

    // include bootstrap script
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'),  true );

    // include main scripts file
    wp_enqueue_script( 'main-js', get_template_directory_uri(  ) . '/js/moonset-site.js', array('jquery'), true );
  }

  // inject the style files
  add_action('wp_enqueue_scripts', 'moon_load_site_styles');

  // inject the script files
  add_action('wp_enqueue_scripts', 'moon_load_site_scripts');
