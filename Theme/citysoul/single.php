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
     * citysoul_cover_page - 10
     * citysoul_main_content_details - 20
     * citysoul_breadcrumb - 30

     */
    do_action( 'citysoul_before_main_content_details' );


    /*
     *  Hook using variable for function do title page
     *  citysoul_get_title ($string)
     */

    if ( have_posts() ) {
        /*
         * Before loop
         *  citysoul_before_content_single_div - 10
         */
        do_action( 'citysoul_before_content_single' );

            while ( have_posts() ) : the_post();

                citysoul_get_loop( 'items','details' );

            endwhile; // end of the loop.

        /*
         * After loop
         * citysoul_after_content_single_div - 10
         */
        do_action( 'citysoul_after_content_single' );
    }else{

        citysoul_get_template( 'content','none' );

    }
    /*
     *  Get sidebar hook
     *  citysoul_before_sidebar - 10
     *  citysoul_after_sidebar - 90
     *
     */
    do_action( 'citysoul_sidebar' );

    /*
     *  Hook after main container page
     *  citysoul_after_main_view - 20
     */
    do_action( 'citysoul_after_main_content_details' );


get_footer();
