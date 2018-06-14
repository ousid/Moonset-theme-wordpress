<?php

global $detect;
/**
 * content for display gallery Posts
 *
 * @author osCode [ossama sid]
 */
?>

<article id="post-<?php the_ID() ?>" <?php post_class( 'moon-gallery-format' ) ?>>

    <header class="entry-header text-center">
        <?php if (is_attachment() && ($detect->isMobile() || $detect->isTablet())): ?>
            <a class="standard-featured-link" href="<?php get_permalink() ?>" >
                <div class="standard-featured background-image" style="background-image: url(<?php echo moon_get_attachment() ?>)"></div>
            </a>
        <?php endif; ?>
        <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ) ?>
        <div class="entry-meta">
            <?php echo moon_posted_meta() ?>
        </div>
    </header> <!-- header -->

    <div class="entry-content">
      <?php
        if (moon_get_attachment() && ( !$detect->isMobile() || !$detect->isTablet() ) ):
          $attachments = get_posts([
            'post_type' =>'attachment',
            'posts_per_page'  => 3,
            'post_parent' => get_the_ID(),
          ]);
      ?>
          <div id="post-gallery-<?php the_ID() ?>" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <?php
                $i= 0;
                foreach ( $attachments as $attachment ):
                  $active = ($i == 0 ? 'active' : '');
              ?>
                  <div class=" item <?php echo $active ?> background-image standard-featured " style="background-image: url(<?php echo  wp_get_attachment_url( $attachment->ID ) ?>)"></div>
              <?php
                ++$i;
                endforeach;
              ?>
            </div>
            <a class="left carousel-control" href="#post-gallery-<?php the_ID() ?>" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class"sr-only">Previous</span>
            </a>
            <a class="left carousel-control" href="#post-gallery-<?php the_ID() ?>" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-next" aria-hidden="true"></span>
              <span class"sr-only">Next</span>
            </a>
          </div>
  <?php endif ?>
      <div class="entry-excerpt">
          <?php the_excerpt() ?>
      </div>
    </div> <!-- .entry-content -->

    <footer class="entry-footer">
        <?php echo moon_posted_footer() ?>
    </footer> <!-- footer -->

</article> <!-- article -->
