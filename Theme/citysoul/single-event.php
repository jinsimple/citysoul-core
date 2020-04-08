<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage citysoul
 * @since citysoul 1.0.0
 * @author Bichdn
 */
get_header();

if (!isset($_GET['data-modal'])) {
	    /**
		 * citysoul_details_event_before hook.
		 * @hooked citysoul_details_event - 10
		 */
		do_action( 'citysoul_details_event_before' );
	?>
	<section class="row">
		<?php 
		while ( have_posts() ) : the_post();
			the_content();
		    wp_link_pages( array(
		        'before'      => '<div class="page-links"><span class="page-links-title">' . get_post_type() . '</span>',
		        'after'       => '</div>',
		        'link_before' => '<span>',
		        'link_after'  => '</span>',
		    ) );

		    edit_post_link( esc_html__( 'Edit ', 'citysoul' ). get_post_type(), '<span class="edit-link">', '</span>' );
	 	endwhile;
		?>
	</section>
	 	<section class="booking-event">
		    <div class="container">
		        <?php 
		        	/**
					 * citysoul_details_event_after hook.
					 * @hooked citysoul_details_event - 10
					 */
					do_action( 'citysoul_details_event_after' );
		        ?>
		    </div>
		</section>
	<?php
}
else{
  	citysoul_get_template( 'booking-event');
}
get_footer();
