<?php
/*
Plugin Name: Beau Recent Posts
Plugin URI: http://beautheme.com
Description: Recent Posts widget
Author: VNMilky
Version: 1.0
Author URI: http://google.com

*/
class citysoul_recent_posts_widget extends WP_Widget {

	/**
	 * Sets up a new Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_recent_entries',
			'description' => esc_html__( 'Your site&#8217;s most recent Posts.' ,'citysoul'),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'citysoul_recent_posts_widget', esc_html__( 'Beau Recent Posts' ,'citysoul'), $widget_ops );
		$this->alt_option_name = 'widget_recent_entries';
	}

	/**
	 * Outputs the content for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' ,'citysoul');

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
		?>
		<?php //echo $args['before_widget']; ?>

<div class="widget-sidebar">
	<div class="widget-title text-title text-2x text-active"><?php echo $title;?></div>
    	<div class="widget-content">
        	<ul class="list-post">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
				<li>
            		<a href="<?php the_permalink(); ?>"><div class="images"><?php echo get_the_post_thumbnail();?></div></a>
            		<?php if ( $show_date ) : ?>
                    <span class="citysoul-date text-active"><em class="text-more"><?php echo date_i18n('D',strtotime(get_the_date('Y-m-d')) );?>  /</em> <strong class="text-title"><?php echo date_i18n('d.m',strtotime(get_the_date('Y-m-d')) );?> </strong></span>
                    <?php endif; ?>
                    <a href="<?php the_permalink(); ?>" class="text-title title-post-sidebar"><?php echo get_the_title(); ?></a>
                </li>
		<?php endwhile; ?>
			</ul>
		</div><!--End .widget-content-->
</div><!--End .widget-sidebar-->

		<?php //echo $args['after_widget']; ?>
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}

	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
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
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html__( 'Title:' ,'citysoul'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html__( 'Number of posts to show:','citysoul' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php esc_html__( 'Display post date?' ,'citysoul'); ?></label></p>
<?php
	}
}
/*
 * Create widget item
 */
add_action( 'widgets_init', 'citysoul_reg_recent_posts_widget' );
function citysoul_reg_recent_posts_widget() {
    register_widget('citysoul_recent_posts_widget');
}

