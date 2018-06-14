<?php

require get_template_directory( ) . '/inc/vendor/Mobile_detect.php';

// call cleanup file
require get_template_directory(  ) . '/inc/clean.php';

// call function-admin file
require get_template_directory(  ) . '/inc/function-admin.php';

// call enqueue file
require get_template_directory(  ) . '/inc/enqueue.php';

// call theme-support file
require get_template_directory(  ) . '/inc/theme-support.php';

// call nav-support file
require get_template_directory(  ) . '/inc/menu-support.php';

// call post type file
require get_template_directory(  ) . '/inc/custom-post-type.php';

// call walker file for menus

require get_template_directory(  ) . '/inc/walker.php';

// call function-site file

require get_template_directory( ) . '/inc/function-site.php';

// call shortcode file 
require get_template_directory( ) . '/inc/shortcode.php';

// call widget file 
require get_template_directory( ) . '/inc/widgets.php';

// call widget function file 
require get_template_directory( ) . '/inc/widget_functions.php';

// call ajax file
require get_template_directory( ) . '/inc/ajax.php';

