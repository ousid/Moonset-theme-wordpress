<?php
/**
 * content for display Images Article
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class('moon-format-image') ?>>
    <header class="entry-header text-center background-image" style="background-image: url(<?php echo moon_get_attachment() ?>)">
      <div class="bc-color">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ) ?>
        <div class="entry-meta">
            <?php echo moon_posted_meta() ?>
        </div>

        <div class="entry-excerpt image-caption">
            <?php the_excerpt() ?>
        </div>
      </div>
    </header> <!-- header -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
