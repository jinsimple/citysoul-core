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
 */


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$style_post = 'citysoul-post-item ';
if (! class_exists('beau_ThemePlugin')) {
	$style_post = $style_post.'post-uni';
}
?>
<li class="<?php echo esc_html($style_post) ?>">
	<?php
		/**
		 * citysoul_before_index_loop_item_title hook.
		 *
		 * @hooked citysoul_get_sticker - 10
		 * @hooked citysoul_get_thumbnail - 20
		 */
		do_action( 'citysoul_before_index_loop_item_title' );

		/**
		 * citysoul_before_index_loop_item_title hook.
		 *
		 * @hooked citysoul_before_content - 10
		 */
		do_action( 'citysoul_before_index_content' );

		/**
		 * citysoul_index_content hook.
		 *
		 * @hooked citysoul_date_time_content - 10
		 * @hooked citysoul_title_content - 20
		 * @hooked citysoul_description_content - 30
		 
		 */
		do_action( 'citysoul_index_content' );

		/**
		 * citysoul_after_index_loop_item_title hook.
		 *
		 * @hooked citysoul_after_content - 5
		 */
		do_action( 'citysoul_after_index_content' );
	?>
</li>