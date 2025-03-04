<?php
/*
Plugin Name: Beau Tags Cloud
Plugin URI: http://beautheme.com
Description: Tags cloud widget
Author: VNMilky
Version: 1.0
Author URI: http://google.com

*/
class citysoul_tags_cloud_widget extends WP_Widget {

	/**
	 * Sets up a new Tag Cloud widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'A cloud of your most used tags.','citysoul' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'citysoul_tags_cloud_widget', esc_html__( 'Beau Tags Cloud','citysoul'), $widget_ops );
	}

	/**
	 * Outputs the content for the current Tag Cloud widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Tag Cloud widget instance.
	 */
	public function widget( $args, $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = esc_html__('Tags','citysoul');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}

		/**
		 * Filters the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */
		$tag_cloud = wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy,
			'echo' => false
		) ) );
 
		if ( empty( $tag_cloud ) ) {
			return;
		}

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$title2 = (($title !=null)?$title:esc_html__('Tags','citysoul'));

		//echo $args['before_widget'];
		?>
		<div class="widget-sidebar">
                    <div class="widget-title text-title text-2x text-active"><?php echo $title2;?></div>
                    <div class="widget-content">
                        <div class="tags-list">
                          <?php echo $tag_cloud = str_replace("class='","class='text-more ",$tag_cloud);?>
                        </div>

                    </div><!--End .widget-content-->
                </div><!--End .widget-sidebar-->
		<?php
		//echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Tag Cloud widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		return $instance;
	}

	/**
	 * Outputs the Tag Cloud widget settings form.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		$title_id = $this->get_field_id( 'title' );
		$instance['title'] = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		echo '<p><label for="' . $title_id .'">' . esc_html__( 'Title:' ,'citysoul') . '</label>
			<input type="text" class="widefat" id="' . $title_id .'" name="' . $this->get_field_name( 'title' ) .'" value="' . $instance['title'] .'" />
		</p>';

		$taxonomies = get_taxonomies( array( 'show_tagcloud' => true ), 'object' );
		$id = $this->get_field_id( 'taxonomy' );
		$name = $this->get_field_name( 'taxonomy' );
		$input = '<input type="hidden" id="' . $id . '" name="' . $name . '" value="%s" />';

		switch ( count( $taxonomies ) ) {

		// No tag cloud supporting taxonomies found, display error message
		case 0:
			echo '<p>' . esc_html__( 'The tag cloud will not be displayed since there are no taxonomies that support the tag cloud widget.','citysoul' ) . '</p>';
			printf( $input, '' );
			break;

		// Just a single tag cloud supporting taxonomy found, no need to display options
		case 1:
			$keys = array_keys( $taxonomies );
			$taxonomy = reset( $keys );
			printf( $input, esc_attr( $taxonomy ) );
			break;

		// More than one tag cloud supporting taxonomy found, display options
		default:
			printf(
				'<p><label for="%1$s">%2$s</label>' .
				'<select class="widefat" id="%1$s" name="%3$s">',
				$id,
				esc_html__( 'Taxonomy:','citysoul'),
				$name
			);

			foreach ( $taxonomies as $taxonomy => $tax ) {
				printf(
					'<option value="%s"%s>%s</option>',
					esc_attr( $taxonomy ),
					selected( $taxonomy, $current_taxonomy, false ),
					$tax->labels->name
				);
			}

			echo '</select></p>';
		}
	}

	/**
	 * Retrieves the taxonomy for the current Tag cloud widget instance.
	 *
	 * @since 4.4.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 * @return string Name of the current taxonomy if set, otherwise 'post_tag'.
	 */
	public function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}
/*
 * Create widget item
 */
add_action( 'widgets_init', 'citysoul_reg_tags_cloud_widget' );
function citysoul_reg_tags_cloud_widget() {
    register_widget('citysoul_tags_cloud_widget');
}
