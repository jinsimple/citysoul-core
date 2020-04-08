<?php
/*
Plugin Name: Beau Archive Widget
Plugin URI: http://beautheme.com
Description: Archive widget
Author: VNMilky
Version: 1.0
Author URI: http://google.com

*/
/**
*
*/
class citysoul_archive_widget extends WP_Widget
{

	/**
	 * Sets up a new Archives widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_archive',
			'description' => esc_html__( 'A monthly archive of your site&#8217;s Posts.' ,'citysoul'),
			'customize_selective_refresh' => true,
		);
		parent::__construct('citysoul_archive_widget', esc_html__('Beau Archives','citysoul'), $widget_ops);
	}

	/**
	 * Outputs the content for the current Archives widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
	public function widget( $args, $instance ) {
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Archives' ,'citysoul') : $instance['title'], $instance, $this->id_base );

		//echo $args['before_widget'];
		// if ( $title ) {
		// 	echo $args['before_title'] . $title . $args['after_title'];
		// }

		?>
		 <div class="widget-sidebar">
                    <div class="widget-title text-title text-2x text-active"><?php echo esc_html($title)?></div>
                   <div class="widget-content">
                        <ul class="list-archive text-title">
                           <?php
		/**
		 * Filters the arguments for the Archives widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_get_archives()
		 *
		 * @param array $args An array of Archives option arguments.
		 */
		wp_get_archives( apply_filters( 'widget_archives_args', array(
			'type'            => 'monthly',
			'show_post_count' => $c
		) ) );
		?>
                        </ul>
                   </div>
                </div><!--End .widget-sidebar-->
		<?php


		//echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Archives widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget_Archives::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['count'] = $new_instance['count'] ? 1 : 0;
		$instance['dropdown'] = $new_instance['dropdown'] ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the settings form for the Archives widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => 0, 'dropdown' => '') );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html__('Title:','citysoul'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p>

			<input class="checkbox" type="checkbox"<?php checked( $instance['count'] ); ?> id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" /> <label for="<?php echo $this->get_field_id('count'); ?>"><?php esc_html__('Show post counts','citysoul'); ?></label>
		</p>
		<?php
	}
}
/*
 * Create widget item
 */
add_action( 'widgets_init', 'citysoul_reg_archive_widget' );
function citysoul_reg_archive_widget() {
    register_widget('citysoul_archive_widget');
}
