<?php
/**
 *
 *
 *
 *
 */

if (post_password_required()):
return;
endif;

?>
<div id="comments" class="commnets-area">
<?php
if (have_comments()):// if we have any comments

$args = array(
	'walker'            => null,
	'max_depth'         => 3,
	'style'             => 'ol',
	'callback'          => null,
	'end-callbacck'     => null,
	'type'              => 'all',
	'reply_text'        => 'Reply',
	'page_link'         => '',
	'per_page'          => '',
	'avatar_size'       => 40,
	'reverse_top_level' => true,
	'rever_children'    => null,
	'format'            => 'html5',
	'short_ping'        => false,
	'echo'              => false,
);
?>
<h2 class=" comment-title">
<?php
printf(
	esc_html(_nx('One Comment On: &ldquo; %2$s &rdquo;', '%1$s Comment On: &ldquo; %2$s &rdquo;', get_comments_number(), 'comments title', 'moonset')),
	number_format_i18n(get_comments_number()),
	'<span class="text-info">'.get_the_title().'</span>'
);
?>
</h2>

<?php moon_add_pagination_comments()?>
<ol class="comment-list">
<?php echo wp_list_comments($args)?>
</ol>

<?php moon_add_pagination_comments()?>
  <?php
if (!comments_open() && get_comments_number()):
echo '<div class="alert alert-info"><p class="lead">';
esc_html_e('Comments Are Closed :(', 'moonset');
echo '</p></div>';
endif;
endif;
?>
  <?php

$fields = array(
	'author' => '
							<div class="form-group">
								<label for="author">'.__('Name', 'moonset').'</label>
								<span class="required">*</span>
								<input type="text" name="author" id="author" class="form-control" value="'.esc_attr($commenter['comment_author']).'" required="required" />
							</div>
						',
	'email' => '
    							<div class="form-group">
    								<label for="email">'.__('Email', 'moonset').'</label>
    								<input type="email" name="email" id="email" class="form-control" value="'.esc_attr($commenter['comment_author_email']).'" required="required" />
    							</div>
						',
	'url' => '
                  <div class="form-group">
                    <label for="url">'.__('Web Site', 'moonset').'</label>
                    <input type="text" name="url" id="url" class="form-control" value="'.esc_attr($commenter['comment_author_url']).'" required="required" />
                  </div>
                 ',
);
$args = array(
	'class_submit'        => 'btn btn-block btn-lg btn-warning',
	'label_submit'        => __('Add Comment'),
	'title_reply_before'  => '<h2 class="text-warning">',
	'title_reply'         => __('Leave a Comment'),
	'title_reply_after'   => '</h2>',
	'title_reply_to'      => __('Reply to %s'),
	'cancel_reply_before' => ' <small class="text-warning">',
	'cancel_reply_after'  => '</small>',
	'comment_field'       => '
                          <div class="form-group">
                            <label for="comment">'._x('Comment', 'moonset').'</label>
                            <textarea type="text" name="comment" id="comment" class="form-control" value="'.esc_attr($commenter['comment_author_url']).'" required="required"></textarea>
                          </div>
                        ',
	'fields' => apply_filters('comment_form_default_fields', $fields),

);

echo comment_form($args);
?>
</div>
