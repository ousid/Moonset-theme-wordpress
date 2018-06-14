<?php
/**
 *
 *
 *
 */

 ?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php bloginfo('description') ?>"/>

    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if(is_singular() && pings_open(get_queried_object())): ?>
        <link rel="pingbacck" href="<?php bloginfo('pingback_url') ?>">
    <?php endif; ?>
    
    <title>
        <?php wp_title( '|', true, 'right' ) ?>
        <?php bloginfo('name') ?>
    </title>
    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
    <div class="moon-sidebar sidebar-closed">
        <div class="moon-sidebar-contianer">
            <a class="js-toggleSidebar sidebar-close">
                <i class="fa fa-window-close"></i>
            </a>
            <div class="sidebar-scroll">
                <?php get_sidebar('moonset-sideba') ?> 
            </div>
        </div> <!-- .moon-sidebar-contianer -->
    </div> <!-- .moon-sidebar -->

    <div class="sidebar-overlay js-toggleSidebar"></div>
    
    <div class="cotnainer-fluid">
        <div class="row">
            <header class="container-section background-image" style="background-image: url(<?php header_image(  ) ?>); ">               
                <div class="bc-color">
                    <a class="js-toggleSidebar sidebar-open">
                        <i class="fa fa-bars"></i>
                    </a> 
                    <div class="table">
                        <div class="table-cell text-center">
                            <h1 class="site-title"><a href="<?php bloginfo( 'url' ) ?>"><?php bloginfo('name') ?></a></h1>
                            <h2 class="site-desc "><?php  bloginfo('description')?></h2>
                        </div>
                    </div>
                </div> <!-- .bc-color -->
                <div class="nav-container hidden-xs">
                    <nav class="navbar container-nav text-center">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'nav navbar-nav',
                            'depth'          => 2,
                            'walker'         => new WP_Bootstrap_Navwalker(),
                        )) ?>
                    </nav> <!-- .container-nav -->
                </div>

            </header> <!-- .container-seciton -->
        </div> <!-- .row -->
            <nav id="site-navigation" class="main-navigation mega-menu navbar text-center navbar-default" role="navigation">

                <?php 
                    if (has_nav_menu( 'mega' )):
                        $args = array(

                            'theme_location'    => 'mega',
                            'container'         => false,
                            'menu_class'        => 'nav navbar-nav',
                            'depth'             => 2,
                            'walker'            =>  new WP_Bootstrap_Navwalker,
                        );
                        wp_nav_menu($args);
                    endif;
                ?>
            </nav>
    </div><!-- .container-fluid -->
