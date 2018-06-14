<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class() ?>>

    <header class="entry-header text-center">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ) ?>
        <div class="entry-meta">
            <?php echo moon_posted_meta() ?>
        </div>
    </header> <!-- header -->

    <div class="entry-content clearfix">
        <?php the_content() ?>
    </div> <!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
