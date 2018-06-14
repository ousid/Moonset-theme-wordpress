<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class() ?>>

    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ) ?>
    </header> <!-- header -->

    <div class="entry-content text-center">
        <div class="entry-excerpt">
            <?php the_content() ?>
        </div>
    </div> <!-- .entry-content -->

</article> <!-- article -->
