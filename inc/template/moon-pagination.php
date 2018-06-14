      <nav id="comment-nav-top" class="comment-navigation" role="navigation">
        <h3><?php esc_html_e( 'Comments Navigation', 'moonset' ) ?></h3>
        <div class="row">
          <div class="col-xs-12 col-sm-6">
            <div class="post-link-nav">
              <i class="fa fa-chevron-left"></i>
              <?php
                previous_comments_link( esc_html__( 'Older Comments' ) )
              ?>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6">
            <div class="post-link-nav">
              <i class="fa fa-chevron-right"></i>
              <?php
                next_comments_link( esc_html__( 'Newer Comments' ) )
              ?>
            </div>
          </div>
        </div>
      </nav>
