<?php 

$title_element = $number_show = $textcolor = $colorborder = $bgcolor = $linkcolor = $linkhover = $css = '';

extract(shortcode_atts(array( 
	'title_element' 	=> '',
	'number_show' 		=> '',
	'textcolor'			=> '',
	'colorborder'		=> '',
	'bgcolor'			=> '',
	'linkcolor'			=> '',
	'linkhover'			=> '',
	'css'				=> '',
), $atts));

if($number_show == '') {
	$number_show = 4;
}

$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);
$id = rand(1,9999999);

$randomID   =  'post_slide'.$id;

//Setup style for shortcode
$setup      = array(
   
    '.text-title' => array(
        'color'                 => $textcolor,

    ),
    '.text-active .text-more ' => array(
    	'color'					=> $linkcolor,
    ),
    '.text-active .text-title'  => array(
    	'color' => $bgcolor,
    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);
?>
    <div class="citysoul-blog <?php echo esc_html($css_class);?>" id="<?php echo esc_html($randomID);?>">
		<div class="content-blog left-content col-xs-12">
			<div class="feature-post feature-slider ">
			    <div class="swiper-container citysoul-feature-post citysoul-feature-post-<?php echo esc_html($id);?>">
			        <!-- Additional required wrapper -->
			        <div class="swiper-wrapper">
			            <!-- Slides -->
			            <?php 
				
							$args =array(
								'post_type'     => 'post',
						        'posts_per_page' => $number_show,

							);
							$loop = new WP_Query( $args );	
							wp_reset_postdata();
						        while ($loop->have_posts())  : $loop->the_post() ;
						        // $id = 1;
						?>
			            <div class="swiper-slide blog-feature-item">
			                <span class="feature-image">
			                    <a href="<?php the_permalink(); ?>" ><?php echo get_the_post_thumbnail(get_the_ID(), 'full');?></a>
			                </span>
			                <div class="feature-info">
			                    <?php echo citysoul_time_link(); ?>
			                    <div class="title-blog title-feature-blog">
			                        <a href="<?php the_permalink(); ?>" class="citysoul-title text-white text-3x text-title"><?php the_title(); ?></a>
			                    </div>
			                </div>
			            </div>
			        <?php endwhile; ?>
			            
			        </div>
			        <!-- If we need navigation buttons -->
			        <div class="btn-next-back btn-next blog-feature-next blog-feature-next-<?php echo esc_html($id);?>"></div>
			        <div class="btn-next-back btn-back blog-feature-back blog-feature-back-<?php echo esc_html($id);?>"></div>
			    </div>
			</div><!--End .feature-post feature-slider-->
		</div>
	</div>
<?php 
/*
 * After loop
 * citysoul_block_post_slide - 10
 */
    do_action( 'citysoul_block_post_slide_hook', $id );
?>