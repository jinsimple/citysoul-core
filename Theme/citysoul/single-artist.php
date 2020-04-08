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
 * @since citysoul 0.0.1
 */
get_header();
     /**
     * Hook detail artist 
     * @see citysoul_detail_artist_view() - 10
     */
    do_action('citysoul_before_detail_artist');

    /**
     * Hook detail artist 
      * @see citysoul_detail_artist() - 10
     */
    do_action('citysoul_content_single_artist');
        /*
     * Hook detail artist 
     * @see citysoul_after_detail_artist_view() - 20
     */
    do_action('citysoul_after_detail_artist');
    /**
     * @see citysoul_podcast_single_artist
     */
    do_action('citysoul_podcast_single_artist');
    /**
     * ShortCode 
     */
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


get_footer();