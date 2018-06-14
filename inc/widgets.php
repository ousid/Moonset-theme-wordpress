<?php 

/**
 *
 * @package moonset
 */



class Moonset_Profile_Widget extends WP_Widget {

	// setup the widget name, desc, etc ..

	public function __construct(  ) {

		$widget_ops = array(
			'classname'		=> 'moonset-profile-widget',
			'description'	=> 'Custom Moonset Profle Widget',
		);

		// call the widget options
		parent::__construct( 'mooonset_profile', 'Moonset Profile', $widget_ops );
	}

	// dispaly backend widget

	public function form( $instance ) {

		echo '<p><b>No Options for this Widget</b></p>';
		echo '<p> You Can Manage This In <a href="admin.php?page=oscode_moonset">this Page</a> </p>';
	}

	// display frontend widget
	public function widget( $args, $instance ) {
       $profile     = esc_attr(get_option( 'media_uploader'));
       $Firstname   = esc_attr(get_option('first_name')); // get the firstname
       $Lastname    = esc_attr(get_option('last_name'));  // get the lastname
       $description = esc_attr(get_option('user_description'));  // get the description
       $twitter     = esc_attr(get_option('twitter_handler'));  // get the twitter link
       $facebook    = esc_attr(get_option('facebook_handler'));  // get the facebook link
       $google      = esc_attr(get_option('google_handler'));  // get the google link

		echo $args['before_widget'];
?>
				<div id="pic-preview" class="moon-picture"
			        style="background-image: url(<?php echo !empty($profile) ? $profile :  get_template_directory_uri() . '/inc/img/avatar.png' ?>)" alt="<?php bloginfo('name') ?>">
			    </div>
			    <!-- Full name Section  -->
			    <div class="moon-fullname">
			        <p>
			            <!-- if the name or the last namme is empty put the default paragraph -->
			            <?php echo !empty($Firstname) || !empty($Lastname) ? $Firstname . ' ' . $Lastname : 'Your firstname and Lastname'?>
			        </p>
			    </div>
			    <!-- Description Section -->
			    <div class="moon-desc">
			        <p>
			            <!-- if the description is empty put the default description -->
			            <?php echo !empty($description) ? $description : 'Write Something About Your Self' ?>
			        </p>
			    </div>
			    <!-- Social Media Section -->
			    <div class="moon-social">
		        <p>

	            <?php if (!empty($facebook)): // if there's facebook link ?> 
		            <span class="social"><a target="_blank" href="<?php echo 'https:://facebook.com/' . $facebook ?>" ><i class="fab fa-facebook"></i></a></span>
		        <?php endif; ?>

	            <?php if (!empty($twitter)): // if there's twitter link ?> 
		            <span class="social"><a target="_blank" href="<?php echo  'https::/twitter.com/' . $twitter  ?>" ><i class="fab fa-twitter"></i></a></span>
		        <?php endif; ?>

	            <?php if (!empty($google)): // if there's googleplus link ?> 
		            <a target="_blank" href="<?php echo 'https:://plus.google.com/u/0/+' . $google ?>" ><span class="social"><i class="fab fa-google-plus-g"></i></span></a>
		        <?php endif; ?>
		        </p>

			    </div>
				
<?php

		echo $args['after_widget'];

	}

}


// Trigger the profile  widget
add_action( 'widgets_init', function () {

	// register the profile widget
	register_widget( 'Moonset_Profile_Widget' );
} );


/**
 *
 *
 *
 *
*/

class Moon_Popular_Posts_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname'    	=> 'moon-popular-posts-widget',
			'description' 	=> 'Popular Posts Widget',
		);

		parent::__construct( 'moon_popular_posts', 'Moon Popular Posts', $widget_ops );
	}

	// backend display widget 

	public function form( $instance ) {

		$title 	= ( !empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Popular Posts' );
		$tot 	= ( !empty( $instance[ 'tot' ] ? absint( $instance[ 'tot' ] ) : 4 ) );

		$output  = '<p>';
		$output .=  '</label for="' . esc_attr( $this->get_field_id( 'title' ) ) . '">Title: </label>';
		$output .=  '<input type="text" class"widefat" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) )  . '" value="' .  esc_attr( $title ) .'">';
		$output .= '</p>';

		$output .= '<p>';
		$output .=  '</label for="' . esc_attr( $this->get_field_id( 'tot' ) ) . '">Number of Posts: </label>';
		$output .=  '<input type="number" class"widefat" id="' . esc_attr( $this->get_field_id( 'tot' ) ) . '" name="' . esc_attr( $this->get_field_name( 'tot' ) )  . '" value="' .  esc_attr( $tot ) .'">';
		$output .= '</p>';
	
		echo $output;
	}

	// update widget 

	public function update( $new_instance, $old_instannce ) {

		$instance = array();

		$instance[ 'title' ]	= ( !empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '' );
		$instance[ 'tot' ]		= ( !empty( $new_instance['title'] ) ? absint( $new_instance['tot'] ) : 0 );
	
		return $instance;
	}

	// frontend display widget 

	public function widget( $args, $instance ) {

		$tot 		= absint( $instance[ 'tot' ] );
		$posts_args = array(
			'post_type'		=> 'post',
			'post_per_page'	=> $tot,
			'meta_key'		=> 'moon_post_views',
			'orderby'		=> 'meta_value_num',
			'order'			=> 'DESC',
		);

		$posts_query = new WP_Query( $posts_args );

		echo $args[ 'before_widget' ];

		if ( !empty( $instance['title'] ) ):
			echo $args[ 'before_title' ];
				echo apply_filters( 'widget_title', $instance[ 'title' ] );
			echo $args[ 'after_title' ];
		endif;

		// comments status of each number of comments
		$zero_comment 	= '<i class="fa fa-comments"></i> <span class="">No Comment</span>';
		$one_comment 	= '<i class="fa fa-comments"></i> <span class="">One Comment</span>';
		$more_comments 	= '<i class="fa fa-comments"></i> <span class="">% Comments</span>';



		if( $posts_query->have_posts() ):
				while( $posts_query->have_posts() ):
					$posts_query->the_post();

					// grab the source of the related image
					$src = get_template_directory_uri() . '/img/post-' . ( get_post_format() ? get_post_format() : 'standard' ) . '.png';
					?>
					<div class="media">
						<div class="media-left"><img src="<?php echo $src ?>" class="media-object" alt="<?php echo get_the_title() ?>" /></div>
						<div class="media-body">
							<a href="<?php echo get_the_permalink() ?>"><?php echo the_title() ?> </a>
							<a href="<?php comments_link() ?>"><?php ( comments_open() ) ? comments_number( $zero_comment, $one_comment, $more_comments ) : 'comments are Closed' ?></a>
						</div>							
					</div>
					<?php
				endwhile;
		endif;

		echo $args[ 'after_widget' ];
	}
}


// trigger the most popular posts widget
add_action( 'widgets_init', function () {
	// register the widget
	register_widget( 'Moon_Popular_Posts_Widget' );
} );
