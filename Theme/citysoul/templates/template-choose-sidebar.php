<?php
/*
* Template Name: Template choose sidebar
*/
get_header();

/*
 * Hook before main container page
 * citysoul_cover_page - 10
 * citysoul_breadcrumb - 20
 */

do_action( 'citysoul_cover_info' );
?>
	<div class="row padding-top-page-sidebar">
		<div class="container">
		<?php 
			$sidebar = citysoul_get_field('select_style_sidebar');
			$sidebar_show = citysoul_get_field('select_sidebar_show');
			
    		switch ($sidebar) {
			    case 'right':
			       ?>
			       <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			        	<?php 
			        		while ( have_posts() ) : the_post();
								the_content();
							endwhile;
			        	?>
			        </div>
			        <div class="sidebar-blog right-sidebar col-lg-3 col-md-3 col-sm-3 col-xs-12">
			        	<?php if ( is_active_sidebar( $sidebar_show ) ) : ?>
			    			<div id="widget-area" class="widget-area" role="complementary">
			    				<?php dynamic_sidebar( $sidebar_show ); ?>
			   				</div><!-- .widget-area -->
			    		<?php endif; ?>
			        </div>
			       <?php
			       break;
			    case 'left':
			        ?>
			        <div class="sidebar-blog left-sidebar col-lg-3 col-md-3 col-sm-3 col-xs-12">
			        	<?php if ( is_active_sidebar( $sidebar_show ) ) : ?>
			    			<div id="widget-area" class="widget-area" role="complementary">
			    				<?php dynamic_sidebar( $sidebar_show ); ?>
			   				</div><!-- .widget-area -->
			    		<?php endif; ?>
			        </div>
			        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
			        	<?php 
			        		while ( have_posts() ) : the_post();
								the_content();
							endwhile;
			        	?>
			        </div>
			       <?php
			        break;
			    case '':
			        while ( have_posts() ) : the_post();
						the_content();
					endwhile;
			    break;
			    
			}
		?>
    	</div>
	</div>
<?php
get_footer();