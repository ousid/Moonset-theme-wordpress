<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class( 'moon-quote-format' ) ?>>

    <header class="entry-header text-center">
      <div class="row">
        <div class="col col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
          <h1 class="quote-content"><a href="<?php get_the_permalink() ?>"><?php echo get_the_content() ?></a></h1>
          <?php the_title( '<h2 class="quote-author">', '</h2>' ) ?>
        </div>
      </div>
    </header> <!-- header -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
