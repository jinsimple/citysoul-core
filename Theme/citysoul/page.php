<?php
get_header(); 

/*
 * Hook before main container page
 * citysoul_cover_page - 10
 * citysoul_breadcrumb - 20
 */
do_action( 'citysoul_cover_info' );

?>
<section>
    <div class="container">
        <div class="entry-header">
            <?php the_title( '<h1 class="entry-title text-title text-3x title-post">', '</h1>' ); ?>
        </div><!-- .entry-header -->
        <div class="content-page">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            // Include the page content template.
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class("section-blog-detail blogs-detail-full"); ?>>
                <div id="post-detail-<?php the_ID();?>" <?php post_class("page-blogs-grid section-landing-view blogs-detail");?>>
                    <div class="entry-content">
                        <?php
                            the_content();
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . get_post_type() . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );

                            edit_post_link( esc_html__( 'Edit ', 'citysoul' ). get_post_type(), '<span class="edit-link">', '</span>' );
                        ?>
                    </div><!-- .entry-content -->
                </div><!--End blogs-detail-->
            </article><!-- #post-## -->

            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        endwhile;
        ?>
    </div>
    </div>
</section>
<?php 
get_footer();
