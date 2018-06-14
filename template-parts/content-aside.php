<?php
/**
 * content for display articles
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class( 'moon-aside-format' ) ?>>

    <header class="entry-header text-center">
        <div class="entry-meta">
            <?php echo moon_posted_meta() ?>
        </div>
    </header> <!-- header -->

    <div class="entry-content">
      <div class="row">
        <div class="col col-md-2 col-sm-3">
          <div class="aside-featured background-image" style="background-image: url(<?php echo moon_get_attachment() ?>)"></div>
        </div>
        <div class="col col-md-10 col-sm-9">
          <div class="entry-excerpt">
            <?php the_content() ?>
          </div>
        </div>

      </div>
    </div> <!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
