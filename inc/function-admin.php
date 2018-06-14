<?php

/** ==================================
 * The Admin Page Functions
 * @author OsCode
 * @package moonSet
 * =================================== */



    /**
    * Function to add an Custom admin page for our theme Moonset
    * Add into it a  Custom Submenu page
    *
    * @version 1.0.0
    * @return void
    */


  function moon_add_admin_page() {

    /* ------------------------------ ADD THE MAIN MENU ---------------------------- */
    // add the menu page
     add_menu_page('moonset Theme Options', 'moonset', 'manage_options', 'oscode_moonset', 'moon_theme_create_page', get_template_directory_uri(  ) . '/inc/img/icons/moon-icon.png', 110 );

     /* ------------------- ADD SUBMENUS ------------------------------- */
     // add the submenu for sidbar Options
     add_submenu_page( 'oscode_moonset', 'moonset Sidebar Options', 'Sidebar', 'manage_options', 'oscode_moonset', 'moon_theme_create_page');

     // add the submenu for the theme options support
     add_submenu_page( 'oscode_moonset', 'moonset Theme Options', 'Theme Options', 'manage_options','oscode_moonset_theme', 'moon_theme_support_page' );

     // add the submenu for the contact for options
     add_submenu_page( 'oscode_moonset', 'moonset Theme Contactt', 'Contact Options', 'manage_options', 'oscode_moonset_contact', 'moon_theme_contact' );

     // add the submenu for the added css options
     add_submenu_page( 'oscode_moonset', 'moonset CSS Options', 'Custom CSS', 'manage_options', 'oscode_moonset_css', 'moon_theme_settings_page' );

     /* ---------------------- ADD ACTIONS FOR THE SUBMENUS ------------------- */
     /* ---- Trigger the Custom sidebar page [main settings page] ---- */
     add_action( 'admin_init', 'moon_custom_sidebar_settings');

     // Trigger the Custom theme Support page
     add_action('admin_init', 'moon_custom_theme_support_settings');

     // Trigger the Custom contact form
     add_action('admin_init', 'moon_custom_contact_settings');

     // Trigger the custom css area
     add_action('admin_init', 'moon_customize_css_settings');
    }

    // trigger the function [moon_add_admin_page] into the admin page
    add_action('admin_menu', 'moon_add_admin_page');

    /* ====================================================================================================
                                                SIDEBAR SETTINGS
       ====================================================================================================*/
   /**
    * add the main options by callback function into the page
    *
    * @return void
    */

    function moon_theme_create_page() {
      // include the  file for the theme settings
      require_once get_template_directory() . '/inc/template/moonset-admin.php';
    }

    /**
     *
     * add custom settings function
     * reigter the form of data
     * add the section of the inputs
     * add input feild [first name]
     * add input feild [Last name]
     * add input feild [Social Media facebook | Twitter | Google+]
     *
     * @return void
     */


    function moon_custom_sidebar_settings() {
      /*================================ REGISTER SETTINGS ================================================*/
        // register settings option for media uploader
        register_setting( 'moonset-settings-group', 'media_uploader');

        // register settings option firstName
        register_setting( 'moonset-settings-group', 'first_name');

        // register settings option lastName
        register_setting( 'moonset-settings-group', 'last_name');

        // register settings option for description
        register_setting( 'moonset-settings-group', 'user_description' );

        // register setting of facebook link
        register_setting( 'moonset-settings-group', 'facebook_handler');

        // register settings of twitter link
        register_setting( 'moonset-settings-group', 'twitter_handler');

        // register settings of google+ link
        register_setting('moonset-settings-group', 'google_handler');

      /*-------------------------- add the settings section --------------------------------------*/
        add_settings_section( 'moonset-sidebar-options', 'Sidebar Options', 'moonset_sidebar_options', 'oscode_moonset' );
      /*------------------------------------------------------------------------------------------*/

      /* ==================================== ADD  SETTINGS FIELD ==========================================*/

        // add the sidebar Picture Section
        add_settings_field( 'sidebar-picture-upload', 'Your Picture', 'moon_sidebar_profile', 'oscode_moonset', 'moonset-sidebar-options');

        // add the sidebar First Name Section
        add_settings_field( 'sidebar-firstname', 'First Name', 'moon_sidebar_firstname', 'oscode_moonset', 'moonset-sidebar-options');

        // add the sidebar Last Name Section
        add_settings_field( 'sidebar-lastname', 'Last Name', 'moon_sidebar_lastname', 'oscode_moonset', 'moonset-sidebar-options');

        // add the sidebar description
        add_settings_field( 'sidebar-desc', 'Your Description', 'moon_sidebar_description', 'oscode_moonset', 'moonset-sidebar-options');

        // add  twitter settings secction
        add_settings_field('sidebar-twitter', 'Your Twitter Link', 'moon_sidebar_twitter', 'oscode_moonset', 'moonset-sidebar-options');

        // add facebook settings section
        add_settings_field( 'sidebar-facebook', 'Your Facebook Link', 'moon_sidebar_facebook', 'oscode_moonset', 'moonset-sidebar-options');

        // add google+ settings section
        add_settings_field('sidebar-google', 'Your Google+ Link', 'moon_sidebar_google', 'oscode_moonset', 'moonset-sidebar-options');
   }

    /**
     * callback function for add_settings_section
     *
     * @return String
     */

   function moonset_sidebar_options() {
      // code
   }

    /**
     * callback function for add_settings_field Profile Picture hanler
     *
     * @return String
     */

   function moon_sidebar_profile() {
       $Profile = esc_attr(get_option('media_uploader')); // put the value

       // revise this in the video | don't forgot the media uploder func in enqueue.php
       echo '<button type="submit" id="upload-button" class="button button-secondary" id="media-button">Upload Your Image</button>';
       echo '<input type="hidden" id="profile-pic" name="media_uploader" value="' . $Profile . '"/>';
       echo !empty($Profile) ? '<a href="#" id="rm-pic" class="remove-pic">Remove Profile Pic</a>' : '';
   }

    /**
     * callback function for add_settings_field FirstName hanler
     *
     * @return String
     */

   function moon_sidebar_firstname() {
       $firstName = esc_attr(get_option('first_name')); // put the value

       echo '<input type="text" name="first_name" value="' . $firstName . '" placeholder="your firstName"/>';
   }

    /**
     * callback function for add_settings_field lastName hanler
     *
     * @return String
     */

   function moon_sidebar_lastname() {
       $lastName = esc_attr(get_option('last_name')); // put the value

       echo '<input type="text" name="last_name" value="' . $lastName . '" placeholder="your last Name"/>';
   }

    /**
     * callback function for add_settings_field User Description
     *
     * @return String
     */

   function moon_sidebar_description() {
       $description = esc_attr(get_option('user_description')); // put the value

       echo '<input type="text" id="desc_pro" name="user_description" value="' . $description . '" placeholder="Describe Your Self"/>';
       echo '<p>Write something Smart!</p>';
   }

    /**
     * callback function for add_settings_field Twitter handler
     *
     * @return String
     */

   function moon_sidebar_twitter() {
       $twitter_handler = esc_attr(get_option('twitter_handler'));

       echo '<input type="text" name="twitter_handler" value="' . $twitter_handler . '" placeholder="Put Your Twitter Link @twitter"/>';
   }

    /**
     * callback function for add_settings_field Facebook handler
     *
     * @return String
     */

   function moon_sidebar_facebook() {
       $facebook_handler = esc_attr(get_option('facebook_handler'));

       echo '<input type="text" name="facebook_handler" value="' . $facebook_handler . '" placeholder="Put Your facebook Link"/>';
   }
    /**
     * callback function for add_settings_field Google+ handler
     *
     * @return String
     */

   function moon_sidebar_google() {
       $google_handler = esc_attr(get_option('google_handler'));

       echo '<input type="text" name="google_handler" value="' . $google_handler . '" placeholder="Put Your Google+ Link"/>';
   }

        /* ====================================================================================================
                                                SUPPORT THEME SETTINGS
       ====================================================================================================*/

    /**
     * add the settings options page by callback function came from the submenu function [Theme Support Options]
     *
     * @return String
     */

    function moon_theme_support_page() {

        require_once get_template_directory(  ) . '/inc/template/moonset-admin-support.php';

    }

    /**
     *
     *
     */

     function moon_custom_theme_support_settings() {

      /*================================ REGISTER SETTINGS ================================================*/
        // register settings option for media uploader
        register_setting( 'moonset-support-settings', 'post_formats');

        // register settings options for custom header
        register_setting( 'moonset-support-settings', 'custom_support_header');

        // register settings options for custom background
        register_setting( 'moonset-support-settings', 'custom_support_background' );

      /*-------------------------- add the settings section --------------------------------------*/
        add_settings_section( 'moonset-support-options', 'Theme Options', 'moon_theme_options', 'moon_theme_support_page' );
      /*------------------------------------------------------------------------------------------*/

      /* ==================================== ADD  SETTINGS FIELD ==========================================*/

        // add the support theme for post formats Picture Section
        add_settings_field( 'post-formats', 'Post Formats', 'moon_theme_post_formats', 'moon_theme_support_page', 'moonset-support-options');

        // added the support theme for custom header
        add_settings_field( 'custom-support-header', 'Custom Header', 'moon_theme_custom_header', 'moon_theme_support_page', 'moonset-support-options' );

        // added the support theme for custom background
        add_settings_field( 'custom-support-background', 'Custom Background', 'moon_theme_custom_background', 'moon_theme_support_page', 'moonset-support-options' );
     }

     /**
      * callback function for moonset support page section
      *
      * @version 1.0.0
      * @return String
      */

      function moon_theme_options(  ) {

        echo 'Activate and Deactivate Theme Options';

      }

     /**
      * function to add custom post formats options
      *
      * @version 1.0.0
      * @return String
      */

      function moon_theme_post_formats() {
        $options = get_option( 'post_formats' );
        $formats = ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'];
        $output = '';
        foreach ($formats as $format) {

          $checked = (@$options[$format] == 1 ? 'checked' : '');

          $output .=
            '<div class="container-formats">'.
              '<input type="checkbox"  name="post_formats['. $format .']" class="post-format" id="'. $format .'" value="1" '. $checked . '/>'.
              '<label for="'. $format .'" class="label-format">' . $format . '</label>'.
            '</div>';
        }
            echo $output;
      }

      /**
       * function for add custom header in appearance section
       *
       * @version 1.0.0
       * @return String
       */


       function moon_theme_custom_header() {
         $option = get_option('custom_support_header');
         $checked       = @$option == 1 ? 'checked' : '';

        echo '<input type="checkbox" name="custom_support_header" id="custom_support_header" value="1"' . $checked . '/>';
         echo '<label for="custom_support_header">Acitvate Your Custom Header</label>';
       }

      /**
      * function to add custom background in appearance section
      *
      *
      */

      function moon_theme_custom_background() {
        $option   = get_option( 'custom_support_background' );
        $checked  = @$option == 1 ? 'checked' : ''; // check if the output of custom_support_background option is 1
        echo '<input type="checkbox" name="custom_support_background" id="custom_support_background" value="1"' . $checked . '/>';
        echo '<label for="custom_support_background"> Activate Your Custom Background</label>';
      }


    /* ====================================================================================================
                                                CONTACT SETTINGS
       ====================================================================================================*/

    /**
     * callback funtion for submenu page contact form
     * include contact file and retrive the data from it
     *
     * @version 1.0.0
     * @return mixed
     */

     function moon_theme_contact() {
        require_once get_template_directory( ) . '/inc/template/moonset-admin-contact.php';
     }

    /**
     * callback function for add_action in admin_init
     * register new settings in new section for contact form with new feilds for data
     *
     * @version 1.0.0
     * @return mixed
     */

     function moon_custom_contact_settings() {


        // add setting for activate | desactivate contact form
        register_setting( 'moonset-contact-settings', 'contact_activate' );

        // add section of setting
        add_settings_section( 'contact-form-settings-options', 'Contact Options', 'register_contact_settings', 'moon_contact_settings_section' );

        // add field for activate contact form
        add_settings_field( 'contact-active-form','activate Contact Form','moon_theme_active_contact','moon_contact_settings_section','contact-form-settings-options' );

     }


     /**
      * callback function for add_settings_section
      *
      * @version 1.0.0
      * @return String
      */

      function register_contact_settings() {
        echo '<small>Activate | Desactivate Bultin contact form</small>';
      }

     /**
      * callback function for add_setting_field
      * output the input form and return value 1 or null to contact_activate option
      *
      * @version 1.0.0
      * @return mixed
      */

      function moon_theme_active_contact() {
        $option  = get_option( 'contact_activate' );
        $checked = (@$option == 1 ? 'checked' : '');

        echo '<input type="checkbox" name="contact_activate" id="contact_activate" value="1"' . $checked . '/>';

      }





    /* ====================================================================================================
                                                CSS SETTINGS
       ====================================================================================================*/

    /**
     * add the settings options page by callback function came from the submenu function [General Options]
     *
     * @return String
     */

    function moon_theme_settings_page() {
        // include the css admin template
        require_once get_template_directory(  ) . '/inc/template/moonset-admin-custom-css.php';

    }

    /**
     * function for register a new data for the section css style
     * this funciton is for register new setting with new section id for customize the css style
     *
     * @version 1.0.0
     * @return mixed
     *
     */

     function moon_customize_css_settings() {

      // register a new setting for custom css
      register_setting( 'custom-css-settings', 'custom_css_area', 'custom_css_sanitize' );

      // add the setting section
      add_settings_section( 'custom_css', 'Customize Your Site', 'moon_custom_css_settings', 'oscode_moonset_css' );

      // add new field for customize the css
      add_settings_field( 'customize_css', 'Customize Site', 'moon_custom_css_area', 'oscode_moonset_css', 'custom_css' );

     }

     /**
      * callback function for register setting
      * sanitize the data their comming from the user
      * use esc_textarea to avoid any harm data
      *
      * @version 1.0.0
      * @param string $input
      * @return string
      */

      function custom_css_sanitize($input) {
        esc_textarea( $input );
        return $input;
      }

     /**
      * callback function for add settings section
      *
      * @version 1.0.0
      * @return string
      */

      function moon_custom_css_settings() {
        echo '<small>Customize the Site With Your CSS Style</small>';
      }

      /**
       * callback function for the css section feild
       * this function is print a simple comment in the editor section if the stylesheet is empty
       * and if the user is put some CSS code inside the editor it will show to him the code
       *
       * @version 1.0.0
       * @return mixed
       */

       function moon_custom_css_area() {
          $css = get_option('custom_css_area');
          $content = empty($css) ? '/* Put Your Css Here*/' : $css;

          echo '<div class="custom-css" id="custom_ace">'. $content .'</div>';
          echo '<textarea id="custom_css_area" name="custom_css_area" style="display:none; visiblity: hidden">'. $content .'</textarea>';
       }
