<?php
/**
 * The archive template file
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
     * citysoul_main_view - 20
     */
    do_action( 'citysoul_before_main_content' );


    /*
     *  Hook using variable for function do title page
     *  citysoul_get_title ($string)
     */
    ?>

    <article class="content-blog left-content col-md-9 col-sm-9 col-xs-12">
    	<h3 class="title">
            <?php esc_html_e('Search results for: ','citysoul')?>
            <?php echo esc_html( get_search_query() ); ?>
        </h3>
        <?php
        if ( have_posts() ) {
            /*
             * Before loop
             *  citysoul_loop_before - 20
             */
            do_action( 'citysoul_before_content' );

                while ( have_posts() ) : the_post();

                    citysoul_get_loop( 'items','post' );

                endwhile; // end of the loop.

            /*
             * After loop
             * citysoul_loop_after - 20
             */
            do_action( 'citysoul_after_content' );
        }
        
        if (!have_posts() ) {

            citysoul_get_template( 'content','none' );

        }
        ?>
    </article>

    <?php
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
    do_action( 'citysoul_after_main_content' );


get_footer();
