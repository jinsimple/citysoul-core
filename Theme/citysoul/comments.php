<?php
if ( post_password_required() ) {
	return;
}
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

if (!class_exists('citysoul_walker_comment')) {
	class citysoul_walker_comment extends Walker_Comment {

		// init classwide variables
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
		function __construct() { ?>

			<!-- <h3 id="comments-title">Comments</h3> -->
		<div class="comment main-comment citysoul-comment-list">

		<?php }

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1; ?>
			<div class="sub-comment">
		<?php }

		/** END_LVL
		 * Ends the children list of after the elements are added. */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1; ?>
			</div>
		<?php }

		/** START_EL */
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0) {
			$depth++;
			$add_below ="";
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? 'main-comment' : '' );

			$reply_args = array(
				'add_below' => 'comment-content',
				'depth' => $depth,
				'max_depth' => $args['max_depth'] );
		?>
			<div class="title-comment">

				<span class="comment-avatar"><?php echo get_avatar( $comment, 40 ); ?></span>
				
				<div id="comment-body-<?php esc_attr(comment_ID())?>" class="comment-body">
					<span class="comment-posted-in">
						<span class="comment-name text-title"><?php echo get_comment_author_link(); ?>   / </span>
						<span class="time"><?php comment_date(); ?>, <?php comment_time(); ?>  &nbsp; <?php comment_reply_link( array_merge( $args, $reply_args ) );  ?></span>
					</span>

					<span class="comment-name"></span>
					<span class="comment-posted-in"></span>
					<span class="comment-message comment" id="comment-content-<?php esc_attr(comment_ID()); ?>">
						<?php if( !$comment->comment_approved ) : ?>
						<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.','citysoul')?></em>
						<?php else: ?>
						<div class="comment-body-content content"><?php comment_text();?></div><!--End comment-body-->
						<?php endif; ?>
					</span>
					<div class="clearfix"></div>
				</div><!-- /.comment-body -->
			</div>
			
		<?php }

		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
		<?php }

		/** DESTRUCTOR
		 * I just using this since we needed to use the constructor to reach the top
		 * of the comments list, just seems to balance out :) */
		function __destruct() { ?>

		</div><!-- /#comment-list -->

		<?php }
	}
}
?>
<?php if ( have_comments() ) : ?>
	<div class="comment-list comments-area no-border">
		<div class="text-title citysoul-title text-active text-2x title-comment-box">
			<span><?php esc_html_e(" Comment" ,'citysoul'); ?> (<?php echo get_comments_number();?>)</span>
		</div>
		<?php wp_list_comments( array(
	        'walker' 		=> new citysoul_walker_comment,
	        'callback' 		=> null,
	        'end-callback' 	=> null,
	        'type' 			=> 'all',
	        'page' 			=> null,
	        'avatar_size' 	=> 50
	    ) ); ?>
	</div><!--End comment-list-->
<?php endif; // have_comments() ?>

<div class="clearfix"></div>
<div class="citysoul-comment-form content-details">
	<ul class="list-input">
	<?php
	comment_form(
		array(
	        'label_submit'	=>esc_html__('Submit comment','citysoul'),
	        'title_reply'	=>esc_html__('Leave a comment','citysoul'),
	        'comment_notes_before' =>'<li class="text-more text-16x col-md-12 col-sm-12 col-xs-12">',
		    'fields' => array(
	            'author' => '
	            <li class="text-more text-16x col-md-6 col-sm-6 col-xs-12">
	            	<input id="email" placeholder="'.esc_html__('Email *','citysoul').'" class="required  txt-form" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />
	            </li>',
	            'email' => '
	            <li class="text-more text-16x col-md-6 col-sm-6 col-xs-12">
	            <input id="author" placeholder="'.esc_html__('Name *','citysoul').'" class="required txt-form" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />
	            </li>',
		    ),
		    'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="2" aria-required="true" class="required txt-form">' . esc_html__('Message *','citysoul') . '</textarea>',
		    'comment_notes_after' => '</li>'
		)
	);
	?>
	</ul>
	<?php
	paginate_comments_links();
	previous_comments_link();
	?>
	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
</div>