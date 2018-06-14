<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class( 'moon-formt-video' ) ?>>

    <header class="entry-header text-center">
      <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ) ?>
      <div class="entry-meta">
          <?php echo moon_posted_meta() ?>
      </div>
      <div class="embed-responsive embed-responsive-16by9">
        <?php echo  moon_get_embeded_media( array('video', 'iframe') ) ?>
        <div>
    </header> <!-- header -->

    <div class="entry-content">
        <div class="entry-excerpt">
            <?php the_excerpt() ?>
        </div>
    </div> <!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
