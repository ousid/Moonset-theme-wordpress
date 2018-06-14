<?php 

/**
 * add custom post type is genrate from moonset > contact option settings in admin panel
 * this file is actually customize the admin contact section [messages] 
 * if the activate button is checked the message section is appear 
 * 
 * @package moonset
 * @version 1.0.0
 * @author osCode [ossama sid]
 * 
 */

 $option = get_option( 'contact_activate' );

 if ( @$option == 1 ):

    // add the contact section [message] settings
    add_action('init', 'add_contact_messages_section');

    /* add filters to the previous settings on add_contact_messages_section
     * and customize the settings
    */
    add_filter('manage_moon_contact_posts_columns', 'moonset_contact_columns');

    // add action for customize each column alone
    add_action('manage_moon_contact_posts_custom_column', 'moon_contact_custom_columns', 10, 2);

    // add meta boxes in messges section 
    add_action('add_meta_boxes', 'moon_contact_add_metabox');

    // add the action to save the updated value
    add_action('save_post', 'moon_save_email_data');
 endif;

function add_contact_messages_section() {
    $labels = [
        'name'             => 'Messages',
        'singular'         => 'Message',
        'menu_name'        => 'Messages',
        'name_admin_bar'   => 'Message',
    ];

    $contact = [
        'labels'            =>    $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_position'     => 26,
        'menu_icon'         => 'dashicons-awards',
        'supports'          => ['title', 'editor', 'author'],
    ];

    register_post_type('moon_contact', $contact);

}


/**
 * callback function from add filter to main function add the contact messages
 * this function is actually filter the settings in the messages menu in the admin panel
 * add and remove custom settings and supports paramter
 * 
 * @version 1.0.0
 * @param array  $columns
 * @return array
 */

 function moonset_contact_columns( $columns ) {
     $newColumns = array();
     $newColumns['title'] = 'Full Name';
     $newColumns['message'] = 'Message';
     $newColumns['email'] = 'Email';
     $newColumns['date'] = 'Date';
    return $newColumns;
 }
 

 /**
  * callback function for add action [manage_moon_contact_posts_custom_column]
  * this function is customize each column alone meaning .. 
  * every column is have already settings for it 
  * this function is add custom setting for every column and return the result 
  * in messages section in admin panel
  *
  * @version 1.0.0
  * @param string $column
  * @param integer @post_id
  * @return mixed
  */

  function moon_contact_custom_columns($column, $post_id) {

    switch( $column ):
        case 'message';
            echo get_the_excerpt();
            break;

        case 'email';
            $email = get_post_meta( $post_id , '_contact_email_value_key', true);
            echo $email;
            break;
    
    endswitch;
  }

  /**
   * function to add a metabox on messages section
   * you can with this metabox to add a custom email to show on post_type section
   * we use inside this function built in function in wordpress add_meta_box to create new metabox
   * 
   * @version 1.0.0
   * @return mixed
   * 
   */

   function moon_contact_add_metabox() {
       add_meta_box( 'contact_email', 'User Email', 'moon_contact_email', 'moon_contact', 'side');
   }

   /**
    * callback function for metabox 
    * this .. create a meta box for email to register email into 
    * @param array $post
    * @return mixed
    *
    */

    function moon_contact_email( $post ) {
        wp_nonce_field( 'moon_save_email_data', 'moon_contact_email_meta_box_nonce' );

        $value = get_post_meta( $post->ID , '_contact_email_value_key', true);

        // print the input field
        echo '<label for="em">User Email Address: </label>';
        echo '<input type="email" id="em" name="moon_contact_email" value="'. esc_attr($value) .'" size="25"/>';
    }
  
    /**
     * callback function from moon_contact_email 
     * this function saves the email value for the message
     * put some sanitize for security 
     * 
     * @param string @post_id
     * @return mixed
     */

     function moon_save_email_data($post_id) {
         
        if (! isset($_POST['moon_contact_email_meta_box_nonce']))   
            return;
        
        if (! wp_verify_nonce( $_POST['moon_contact_email_meta_box_nonce'], 'moon_save_email_data' ))
            return;
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (! current_user_can( 'edit_post', $post_id ))
            return;

        if (! isset($_POST['contact_email']))
            return;

        $my_data = sanitize_text_field( $_POST['contact_email'] );

        // update the post
        update_post_meta( $post_id, '_contact_email_value_key' , $my_data );
    }
