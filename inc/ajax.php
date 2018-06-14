<?php
/**
 *
 *
 *
 * @author osCode [ossama sid]
 */

// add action with no privleges [for the normal users]
// add_action( 'wp_ajax_nopriv_moon_load_more', 'moon_load_more' );
// add_action( 'wp_ajax_moon_load_more', 'moon_load_more' );

// add action with no privleges [for the normal users]
add_action( 'wp_ajax_nopriv_moon_save_user_contact_form', 'moon_save_contact' );
add_action( 'wp_ajax_moon_save_user_contact_form', 'moon_save_contact' );


/**
 * moon_load_more function for load the posts depend on the recent page [default began with the page number 1]
 * if have posts the load the number of the posts that we edited before in the admin area [settings > reading > Blog posts show at most]
 *
 * @param void
 * @return string
 */

 function  moon_load_more() {
    $paged    = $_POST["page"] + 1;
    $prev     = $_POST['prev'];
    $archive  = $_POST['archive'];

    if ($prev === 1 && $_POST['page'] != 1 ) {
      $page = $_POST['page'] -1;
    }

    $args =  array(
        'post_type'   => 'post',
        'post_status' => 'publish',
        'paged'       => $page,
    );
    if ( $archive != '0' ) {

      $archVal = explode( '/',  $archive );

/*      $flipped = array_flip( $archVal );

      switch (isset($flipped)) {

        case $flipped['category']:
             $type = 'category_name';
             $key  = 'category';
             break;

       case $flipped['author']:
            $type = 'author';
            $key  = $type;
            break;

      case $flipped['tag']:
          $type = 'tag';
          $key  = $type;
          break;

      }

      $currKey = array_keys( $archVal, $key );
      $nextKey = $currKey[0] + 1;
      $value   = $archVal[ $nextKey ];

      $args[ $type ] = $value;

      //check page trail

      if ( isset( $flipped['page'] ) ) {
        $pageVal    = explode( 'page', $archive );
        $page_trail = $pageVal[0];
      } else {
        $page_trail = $archive;
      }
*/
     if ( in_array('category', $archVal) ) {
       $type    = "category_name";
       $currKey = array_keys( $archVal, "category" );
       $nexKey = $currKey[0] + 1;
       $value = $archVal[ $nextKey ];
       $args[ $type ] = $value;

     }

     if ( in_array('tag', $archVal) ) {
       $type    = "tag";
       $currKey = array_keys( $archVal, "category" );
       $nexKey = $currKey[0] + 1;
       $value = $archVal[ $nextKey ];
       $args[ $type ] = $value;

     }

     if ( in_array('author', $archVal) ) {
       $type    = "author";
       $currKey = array_keys( $archVal, "category" );
       $nexKey = $currKey[0] + 1;
       $value = $archVal[ $nextKey ];
       $args[ $type ] = $value;

     }

     if ( in_array( "page", $archVal ) ) {
       $archVal = explode( 'page', $archive );

       $page_trail = $pageVal[0];
     }else {
       $page_trail = $archive;
     }
     $page_trail = $archive;
    } else {
      $page_trail = '/';
    }


    $query = new  WP_Query( $args );

    if ( $query->have_posts() ):
      echo '<div class="page-limit" data-page="/wordpress' . $page_trail .  'page/' . $paged .'/">';
        while( $query->have_posts() ):

            $query->the_post();
            get_template_part( 'template-parts/content', get_post_format() );

        endwhile;
      echo '</div>';
    else:
      echo 0;
    endif;

    die();
 }

/**
 * [moon_check_paged description]
 * @param  integer|null $attr [description]
 * @return mixed       [description]
 */
 function moon_check_paged( $attr = null ) {
   $output = '';

   if (is_paged()) {
       $output = 'page/'.get_query_var('paged');
   }

   if ($attr == 1) {
       $paged = get_query_var('paged') == 0 ? 1 : get_query_var('paged');

       return $paged;
   } else {
       return $output;
   }

 }

/**
 *
 *
 *
 */

function moon_save_contact() {
  $title    = wp_strip_all_tags( $_POST['name'] );
  $email    = wp_strip_all_tags( $_POST['email'] );
  $message  = wp_strip_all_tags( $_POST['message'] );

  $args = array(
    'post_title'    => $title,
    'post_content'  => $message,
    'post_author'   => 1,
    'post_status'   => 'publish',
    'post_type'     => 'moon_contact',
    'meta_input'    => array(
      '_contact_email_value_key' => $email
    ),
  );

  $post_ID = wp_insert_post( $args, true );

  if ( $post_ID !== 0 ) {

    $to       = get_bloginfo( 'admin_email' );
    $subject  = 'Moonset Contact Form - ' . $title;

    
    $headers[] = 'From: ' . get_bloginfo( 'name' ) . '<' . $to . '>';
    $headers[] = 'Reply-To: ' . $title . '<' . $email . '>';
    $headers[] = 'Content-Type: text/html: charset=UTF-8';
    
    wp_mail( $to, $subject, $message, $headers );

    echo $post_ID;
  }else {
    echo 0;
  }

  die();
}
