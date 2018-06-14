<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class() ?>>

    <header class="entry-header text-center">
        <?php if (is_attachment()): ?>
            <a class="standard-featured-link" href="<?php get_permalink() ?>" >
                <div class="standard-featured background-image" style="background-image: url(<?php echo moon_get_attachment() ?>)"></div>
            </a>
        <?php endif; ?>
        <div class="entry-meta">
            <?php echo moon_posted_meta() ?>
        </div>
    </header> <!-- header -->

    <div class="entry-content">
            <a class="standard-featured-link" href="<?php get_permalink() ?>" >
                <div class="standard-featured background-image" style="background-image: url(<?php echo moon_get_attachment() ?>)"></div>
            </a>
        <div class="entry-excerpt">
            <?php the_excerpt() ?>
        </div>
        <div class="button-container text-center">
            <a href="<?php the_permalink() ?>" class="btn btn-custom"><?php _e( 'Read More' ) ?></a>
        </div>
    </div> <!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
