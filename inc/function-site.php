<?php

/** ==================================
 * Web site pages functions
 * @author OsCode
 * @package moonSet
 * =================================== */

/**
 * function posted meta for print the  time of the post and category
 * this function is print for the time the diffrence time between posted the article and time to watch it
 * by built in function of wordpress human_time_diff()
 * and also print the category if not empty seprated with comma (, )
 * both [time, category] are linked in with link to all the article are posted in this [time , category]
 *
 * @param void
 * @return mixed
 */

function moon_posted_meta() {

	$posted_on      = human_time_diff(get_the_time('U'), current_time('timestamp'));
	$categories     = get_the_category();
	$sep            = ', ';
	$output         = '';
	$count_category = 1;

	if (!empty($categories)):
	foreach ($categories as $category):
	if ($count_category > 1):
	$output .= $sep;
	endif;

	$output .= '<a href="'.esc_url(get_category_link($category->term_id)).'"
                           alt="'.esc_attr('View All Post in %s', $category->name).'">'
	.esc_html($category->name).
	'</a>';
	$count_category++;
	endforeach;
	endif;

	$posted_info = '<span class="posted-on">Posted <a href="'.get_permalink().'">'.$posted_on.'</a> ago</span> ';
	$posted_info .= '/<span class="posted-in">'.$output.'</span>';

	return $posted_info;
}

/**
 * function for footer display the comments and the tag list
 * this function is display the comments if open or alert for disabled comments if not
 * and display the list of tags sepreated with space
 *
 * @param void
 * @return mixed
 */

function moon_posted_footer() {

	if (comments_open()):// if the status of comments are enbaled
	$comment = get_comments_number();

	if ($comment == 0):
		$comment_status = '<span class="text-info">Be The first :)</span>';
 	elseif ($comment > 1):
		$comment_status = get_comments_number().' Comments';
	 else :
		$comment_status = 'One Comment';
	endif;
	 else :// if the status of comments are disabled
		$comment_status = '<span class="text-warning">Comments Are Disabled :(</span>';
	endif;

	$footer = '<div class="post-footer-container">';
	$footer .= '<div class="row">';
	$footer .= '<div class="col col-sm-6 col-xs-6">';
	$footer .= '<div class="text-left">';
	$footer .= has_tag()?get_the_tag_list('<div class="tags-list"><i class="fa fa-tags">', ' ', '</i></div>'):'<div class="tags-list">This Post Has No Tags</div>';
	$footer .= '</div>';
	$footer .= '</div>';
	$footer .= '<div class="col col-sm-6 col-xs-6">';
	$footer .= '<div class="text-right">';
	$footer .= '<a href="'.get_comments_link().'"> <i class="fa fa-comments"></i>  '.$comment_status.'</a>';
	$footer .= '</div>';
	$footer .= '</div>';
	$footer .= '</div>';
	$footer .= '</div>';

	return $footer;
}

/**
 * function for get the attachment if not exist
 * this function is display the attachment image if exist and if not get the first attachment url
 *
 *
 * @param integer $num the default is 1
 * @return mixed
 */

function moon_get_attachment($num = 1) {
	$output = '';
	if (has_post_thumbnail() && $num == 1):
	$output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	 else :
	$attachments = get_posts(array(
			'post_type'     => 'attachment',
			'post_per_page' => $num,
			'post_parent'   => get_the_ID(),
		));
	if ($attachments && $num == 1):
		foreach ($attachments as $attachment):
			$output = wp_get_attachment_url($attachment->ID);
		endforeach;
 	elseif ($attachments && $num > 1):
		$output = $attachments;
	endif;
		wp_reset_postdata();
	endif;

	return $output;
}

/**
 *
 *
 * @param array $type the type to specify the format of the
 */

function moon_get_embeded_media($type = array()) {

	$content = do_shortcode(apply_filters('the_content', get_the_content()));
	$embed   = get_media_embedded_in_content($content, $type);
	$output  = str_replace('?visual=true', '?visual=false', $embed[0]);

	return $output;
}

/**
 *
 *
 * [moon_grab_url description]
 * @return [type] [description]
 */

function moon_grab_url() {
	if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)) {
		return false;
	}
	return esc_url_raw($links[1]);
}

/**
 *
 *
 *
 * @return [type] [description]
 */

function moon_grab_current_uri() {
	$https       = isset($_SERVER['HTTPS'])?'https://':'http://';
	$referer     = $https.$_SERVER['HTTP_HOST'];
	$archive_uri = $referer.$_SERVER['REQUEST_URI'];

	return $archive_uri;
}

/**
 *
 *
 *
 *
 *
 *
 */
function moon_pagination() {
	global $wp_query;

	$all_pages = $wp_query->max_num_pages;

	$current_page = max(1, get_query_var('paged'));

	if ($all_pages > 1):
	$args = array(
		'base'      => get_pagenum_link().'%_%',
		'current'   => $current_page,
		'prev_text' => '« New',
		'next_text' => 'Old »',
		'min_size'  => 1,
		'end'       => 1,
	);
	$paginate = paginate_links($args);
	return $paginate;
	endif;
}

/**
 *
 *
 *
 *
 *
 *
 *
 */

function moon_post_nav() {

	$nav = '<div class="row">';
	$nav .= 	'<div class="col-xs-12 col-sm-6">';
	$nav .= 	get_previous_post_link('<div class="moon-post-nav text-left"><i class="fa fa-chevron-left"></i>  %link</div>', '%title');
	$nav .= 	'</div>';
	
	$nav .= 	'<div class="col-xs-12 col-sm-6">';
	$nav .= 	get_next_post_link('<div class="moon-post-nav text-right">%link  <i class="fa fa-chevron-right"></i></div>', '%title');
	$nav .= 	'</div>';
	$nav .= '</div>';

	return $nav;
}

/**
 * is function is for share the main content of the blog post in the socila media [twitter, facebook, google plus ]
 * it use no api just basic uri method for the last social media
 * it's working also if the post is single meaning [if the post in the readin status]
 * if not return the main content without the share option like if you are browse the posts
 * and it's use the the_content filter for void the repeation of the function
 * and dynamiclly append the share content in the single post
 * @param  integer $content
 * @return integer $content
 *
 */

function moon_share_it($content) {
	if (is_single()):
	$title          = get_the_title();
	$permalink      = get_the_permalink();
	$twitterHandler = (get_option('twitter_handler')?'&amp;via='.esc_attr(get_option('twitter_handler')):'');
	$twiiter        = 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$permalink.$twitterHandler;
	$facebook       = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
	$google         = 'https://plus.google.com/share?url='.$permalink;

	$content = '<div class="moon-share">';
	$content .= '  <h4>Share This!</h4>';

	$content .= '<ul>';
	$content .= '<li>';
	$content .= '<a href="<?php echo $twitter ?>" target="_blank" rel="nofollow"><i class="fab fa-twitter" aria-hidden="true"></i></a>';
	$content .= '<a href="<?php echo $facebook ?>"  target="_blank" rel="nofollow"><i class="fab fa-facebook" aria-hidden="true"></i></a>';
	$content .= '<a href="<?php echo $google ?>"  target="_blank" rel="nofollow"><i class="fab fa-google-plus-g"></i></a>';
	$content .= '</li>';
	$content .= '</ul>';

	$content .= '</div>';
	return $content;
	 else :
	return $content;
	endif;

}

add_filter('the_content', 'moon_share_it');

/**
 *
 *
 *
 *
 */

function moon_add_pagination_comments() {
	if (get_comment_pages_count() > 1 && get_option('page_comments')):
	require get_template_direcotry().'inc/template/moon-pagination.php';
	endif;
}


/**
 * sample function to retrive the wp_query class
 * without repeat  declare of the class each time when you call it
 *
 * @param $args string
 * @return mixed
 */

function moon_get_queries( $args ) {
	$query = new WP_Query( $args );

	return $query;
}