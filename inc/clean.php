<?php 

/**
 * function for remove current version of wordpress
 * this function is actually to remove the version of wordpress from the url [ver=X.X.X]
 * remover only the version if equal to wordpress version 
 * 
 * @param string $src
 * @return string $src
 */

 function moon_remove_current_version($src) {

    global $wp_version;

    parse_str( parse_url($src, PHP_URL_QUERY), $query );

    if ( !empty($query['ver']) && $query['ver'] === $wp_version)
        $src = remove_query_arg( 'ver', $src );
    return $src;
 }

 // add filter for remove the version query for both scripts and styles sources
 add_filter('script_loader_src', 'moon_remove_current_version');
 add_filter('style_loader_src', 'moon_remove_current_version');

 /**
  * function for remover the meta tag of wordpress name | content
  * this function is to remove the meta tag of wordpress version for security 
  * removed and return empty string for print nothing 
  *
  * @param void
  * @return string
  */

  function moon_remove_meta_version() {
      return '';
  }

  // add filter for remove the meta version
  add_filter('the_generator', 'moon_remove_meta_version');
  