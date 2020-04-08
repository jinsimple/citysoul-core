<?php
/*
Plugin Name: Beau Recent Comments
Plugin URI: http://beautheme.com
Description: Recent Comments widget
Author: VNMilky
Version: 1.0
Author URI: http://google.com

*/
class citysoul_recent_comment_widget extends WP_Widget {

	/**
	 * Sets up a new Recent Comments widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_recent_comments',
			'description' => esc_html__( 'Your site&#8217;s most recent comments.','citysoul' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'citysoul_recent_comment_widget', esc_html__( 'Beau Recent Comments' ,'citysoul'), $widget_ops );
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action( 'wp_head', array( $this, 'recent_comments_style' ) );
		}
	}

 	/**
	 * Outputs the default styles for the Recent Comments widget.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function recent_comments_style() {
		/**
		 * Filters the Recent Comments default widget styles.
		 *
		 * @since 3.1.0
		 *
		 * @param bool   $active  Whether the widget is active. Default true.
		 * @param string $id_base The widget ID.
		 */
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
		<?php
	}

	/**
	 * Outputs the content for the current Recent Comments widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Comments widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Comments' ,'citysoul');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;

		/**
		 * Filters the arguments for the Recent Comments widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Comment_Query::query() for information on accepted arguments.
		 *
		 * @param array $comment_args An array of arguments used to retrieve the recent comments.
		 */
		$comments = get_comments( apply_filters( 'widget_comments_args', array(
			'number'      => $number,
			'status'      => 'approve',
			'post_status' => 'publish'
		) ) );

		//$output .= $args['before_widget'];
		?>
		<div class="widget-sidebar">
                    <div class="widget-title text-title text-2x text-active"><?php echo $title;?></div>
                    <div class="widget-content">
                        <ul class="list-recent-comment">
                        <?php 
                        if ( is_array( $comments ) && $comments ) :
                        // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
                        $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
                        _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

                        foreach ( (array) $comments as $comment ) :
                            $email = explode('@',$comment->comment_author_email);
                            ?>
                             <li>
                                <span class="name-comment"><a href="<?php echo esc_url(get_comment_link($comment));?>""><strong class="text-active text-title"><?php echo $comment->comment_author;?></strong><span class="name-follow">@<?php echo $email[0];?></span></a><span>- <?php echo date_i18n('F d,Y h:i a',strtotime($comment->comment_date));?></span></span>
                                <div class="clearfix"></div>
                                <p class="comment-text text-more"><?php echo $comment->comment_content;?></p>
                            </li>
                            <?php
                            endforeach;
                            endif;
                            ?>
                        </ul>
                    </div><!--End .widget-content-->
                </div><!--End .widget-sidebar-->
		<?php
		//$output .= $args['after_widget'];

		//echo $output;
	}

	/**
	 * Handles updating settings for the current Recent Comments widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = absint( $new_instance['number'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Comments widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html__( 'Title:' ,'citysoul'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html__( 'Number of comments to show:' ,'citysoul'); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>
		<?php
	}

	/**
	 * Flushes the Recent Comments widget cache.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @deprecated 4.4.0 Fragment caching was removed in favor of split queries.
	 */
	public function flush_widget_cache() {
		_deprecated_function( __METHOD__, '4.4.0' );
	}
}
add_action( 'widgets_init', 'citysoul_reg_recent_comment_widget' );
function citysoul_reg_recent_comment_widget() {
    register_widget('citysoul_recent_comment_widget');
}
