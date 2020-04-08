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
     * citysoul_main_view - 20
     */
    do_action( 'citysoul_before_main_content' );


    /*
     *  Hook using variable for function do title page
     *  citysoul_get_title ($string)
     */
    ?>
    <article class="content-blog left-content col-md-9 col-sm-9 col-xs-9">
    <?php
    if ( have_posts() ) {
        /*
         * Before loop
         *  citysoul_loop_before - 20
         */
        do_action( 'citysoul_before_content' );
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $per_page = get_option( 'posts_per_page' );
            $args = array(
              'post_type'     => 'post',
              'paged' => $paged,
              'posts_per_page'  => $per_page,
            );
            $loop = new WP_Query( $args );
            wp_reset_postdata();
            while ($loop->have_posts()) {
                $loop ->the_post();
                citysoul_get_loop( 'items-post' );

            } // end of the loop.
        
        /*
         * After loop
         * citysoul_loop_after - 20
         */
        do_action( 'citysoul_after_content' );
        ?>
        <div class="clearfix"></div>
        <div class="loadmore-button text-center">
        <?php
            if(function_exists('citysoul_pagination')) {
                echo citysoul_pagination($loop);
            }
        ?>
        </div>
        <?php
    }else{
        citysoul_get_template( 'content','none' );
    }
    ?>
    </article>

    <div class="sidebar-default">
        <?php
        /*
         *  Get sidebar hook
         *  citysoul_before_sidebar - 10
         *  citysoul_after_sidebar - 90
         *
         */
        do_action( 'citysoul_sidebar' );
        ?>
    </div>
    <?php
    /*
     *  Hook after main container page
     *  citysoul_after_main_view - 20
     */
    do_action( 'citysoul_after_main_content' );


get_footer();
