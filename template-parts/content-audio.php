<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class( 'moon-format-audio' ) ?>>

    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ) ?>
        <div class="entry-meta">
            <?php echo moon_posted_meta() ?>
        </div>
    </header> <!-- header -->

    <div class="entry-content">
      <?php echo moon_get_embeded_media( array( 'audio', 'iframe' ) ) ?>
    </div> <!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
