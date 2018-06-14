<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class( 'moon-format-link' ) ?>>

    <header class="entry-header text-center">
        <?php
          $link = moon_grab_url();
          the_title( '<h1 class="entry-title"><a href="' . $link .  '" target="_blank">', '<div class="link-icon"><span class="glyphicon gliphicon-link"></span></div></a></h1>' )
         ?>
    </header> <!-- header -->
    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->
</article> <!-- article -->
