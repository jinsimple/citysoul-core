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

    /*
     * Hook before main container page
     * citysoul_cover_details_gallery - 10

     */
    do_action( 'citysoul_cover_header_gallery' );

     /*
     * Hook before main container page
     * citysoul_view_gallery - 10

     */
    do_action( 'citysoul_view_content_gallery_image' );


   

get_footer();
