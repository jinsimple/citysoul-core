<?php

$title_element = $desc_element = $video_id = $pages = $textcolor = $css = $colorborder = $bgcolor = $linkcolor = $linkhover = $rename = '';

extract(shortcode_atts(array(
	'pages' 		=> '',
	'title_element' => '',
	'desc_element'	=> '',
	'video_id' 		=> '',
	'textcolor'		=> '',
	'colorborder'	=> '',
	'bgcolor'		=> '',
	'linkcolor'		=> '',
	'linkhover'		=> '',
	'rename'		=> '',
	'css' 			=> '',
), $atts));
if( !empty($video_id)) {
	$video_id_list = explode(',', $video_id);
}

if($pages == '') {
	$pages = -1;
}

if($rename == '') {
	$rename = 'Read More...';
}


$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'list_videos_'.$id_ran;

//Setup style for shortcode
$setup      = array(
    '.cover-page ' => array(
        'background'                 => $bgcolor,
    ),
    '.text-title .text-more .txt-title' => array(
        'color'                 => $textcolor,

    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);


?>
<section class="section-video <?php echo esc_attr( $css_class ); ?>">
    <div class="container">
        <div class="citysoul-video">
            <ul class="citysoul-list-videos">
			
			<?php 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $per_page = get_option( 'posts_per_page' );

				$args = array(
		            'post_type'     => 'videos',
		            // 'posts_per_page' => $pages,
		            'paged' => $paged,
              		'posts_per_page'  => $per_page,
		          );
				if(isset($video_id_list)) {
					$args['post__in'] = $video_id_list;
				}

		        $loop = new WP_Query( $args );	
		        wp_reset_postdata();
		        while ($loop->have_posts())  : $loop->the_post() ;
                 citysoul_get_loop( 'items','videos' );
            	endwhile; ?>
			</ul>

			<div class="clearfix"></div>
	        <div class="loadmore-button text-center">
	        <?php
	            if (function_exists('citysoul_jqueryLoadmore')) {
	                $setting = array(
	                    'container'     => '.citysoul-list-videos', // <ul class="citysoul-list-videos">
	                    'template'      => 'items-videos',
	                    'loadmore'      => $pages,
	                    'button_text'   => $rename,
	                );
	                citysoul_jqueryLoadmore($setting , $args);
	            }
	        ?>
	        </div>

			<div class="modal fade" id="modalvideo" role="dialog">
			    <div class="modal-dialog video-youtube">
			    
			      <!-- Modal content-->
			        <div class="modal-content">					        
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="modal-body video-content">
							
						</div>
			        </div>					    
			      
			    </div>
			</div>
			<?php 
			/*
			 * After loop
			 * citysoul_list_video_function_hook - 10
			 */
			    do_action( 'citysoul_list_video_hook');
			?>
		</div>
	</div>
</section>