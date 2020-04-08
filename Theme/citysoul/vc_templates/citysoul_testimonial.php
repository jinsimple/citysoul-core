<?php
$title_element = $textcolor = $album_id = $css = $colorborder = $bgcolor = $linkcolor = $linkhover = '';


extract(shortcode_atts(array(
	'title_element' => '',
	'album_id' 		=> '',
	'textcolor'		=> '',
	'colorborder'	=> '',
	'bgcolor'		=> '',
	'linkcolor'		=> '',
	'linkhover'		=> '',
	'css' 			=> '',
	'album_id'		=> ''
), $atts));


$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);


// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'tes_'.$id_ran;

//Setup style for shortcode
$setup      = array(
    ' .container, .auth-testimonial:after ' => array(
        'background'                 => $bgcolor,
    ),
    '.testi-message' => array(
        'color'                 => $textcolor,

    ),
    '' => array(
    	'color'					=>$linkhover,
    	)
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);

?>

<section class="testimonial <?php echo esc_html($css_class);?>" id="<?php echo esc_html($randomID) ?>">
    <div class="container">
        <div class="testimonial-list text-center">
            <div class="testimonial-title">
                <div class="citysoul-title text-title text-title text-7x"><?php echo esc_html($title_element)?esc_html($title_element):esc_html__('Testimonial','citysoul'); ?></div>
            </div>
            <div class="swiper-container citysoul-testimonial citysoul-testimonial-<?php echo esc_html($id_ran) ?>">
                <div class="swiper-wrapper">
                 <?php 
	                $args = array(
	                    'post_type'     => 'testimonial',
	                  );

		                $loop = new WP_Query( $args );  
                        wp_reset_postdata();
		                while ($loop->have_posts())  : $loop->the_post() ;
		            ?>
	                <div class="swiper-slide testimonial-item">
                        <div class="auth-testimonial text-more"><?php echo get_the_title(); ?></div><!--End .auth-testimonial-->
                        <div class="testi-message text-title"><?php echo get_the_content(); ?></div><!--End .testi-mesage-->
                    </div>
                    <?php endwhile; ?>

                </div>
                <div class="swiper-pagination testi-pagging testi-pagging-<?php echo esc_html($id_ran) ?>"></div>
            </div>
        </div><!--End .testimonia-list-->
        <?php 
        /*
         * After loop
         * citysoul_testimonial_script - 10
         */
            do_action( 'citysoul_testimonial_script_hook', $id_ran);
        ?>
    </div>
</section>