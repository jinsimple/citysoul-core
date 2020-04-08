<?php 
$description_title = $description_option = $description_title_box = $description_title_tags = '';
$description_fb = $description_tw = $description_yt = $description_sc = $images = '';
$description_title_color = $description_content_color = $description_title_boxcolor =  $description_active_color = $description_box_tagcolor = $description_bgcolor = $css = '';
    extract(shortcode_atts(array(
                'description_title'            =>  '',
                'description_option'        =>  '',
                'description_title_box'     =>  '',
                'description_title_tags'        =>  '', 
                'description_fb'		=>	'',
                'description_tw'        =>  '',
                'description_yt'        =>  '',
                'description_sc'       =>  '',
                'images'          =>  '',
                'description_title_color'=>  '',
                'description_content_color'  =>  '',
                'description_title_boxcolor'=>  '',
                'description_box_tagcolor'   =>  '',
                'description_bgcolor'     =>  '', 
                'description_active_color'	=>	'',              
                'css'               =>  '',
                ),
        $atts)
    );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$randID = rand(1,9999);
$setup  = array(
	array(
		'background'						=>	$description_bgcolor,
		),
	'.text-description .text-title'			=>	array(
		'color'								=>	$description_title_color,
		),
	'.main-text-about p'	=>	array(
		'color'								=>	$description_title_color,
		),
	'.citysoul-text-description p'			=>	array(
		'color'								=>	$description_content_color,
		),
	'.detail-text-about p'=>	array(
		'color'								=>	$description_content_color,
		),
	'.citysoul-social li a:hover'			=>	array(
		'background'						=> $description_active_color,	
		),
	'.citysoul-title-half .citysoul-title'  => array(
		'color'						=> $description_title_boxcolor,	
		),
	'.citysoul-title-half .citysoul-tags'  => array(
		'color'						=> $description_box_tagcolor,	
		),
	);
echo citysoul_css_shortcode('short-desc-'.$randID, $setup);
if($description_title =='') return false;
if($description_title_box != null && $images == ''){
	$description_option = 'noimage';
}
if($description_option == 'withimage'){
	$img = shortcode_atts(array(
    	'images' => 'images',), $atts);
	$images_link = wp_get_attachment_image_src($img["images"], "full");
	$images_l = $images_link[0];
?>
<section class="about-text" id="short-desc-<?php echo esc_attr($randID);?>">
    <div class="container">
        <div class="citysoul-short-description">
            <div class="image-desc col-md-6 col-xs-12">
               <div class="full-image-desc">
                    <img src="<?php echo esc_html($images_l); ?>">
                </div>
            </div><!--End .image-desc-->
            <div class="citysoul-text-desc col-md-6 col-xs-12">
                <div class="text-description">
                    <div class="text-title text-white text-3x citysoul-title"><?php echo esc_html($description_title);?></div>
                    <div class="clearfix"></div>
                    <div class="short-desc text-desc citysoul-text-description">
                      <p><?php echo esc_html($content);?></p>
                    </div><!--End .short-desc-->
                    <div class="clearfix"></div>
                    <ul class="citysoul-social social-round">
                        <?php if ($description_fb != NULL) :?>
                        <li><a href="<?php echo esc_url($description_fb);?>" class="fa fa-facebook"></a></li>
                        <?php endif;?>
                        <?php if ($description_tw != NULL) :?>
                        <li><a href="<?php echo esc_url($description_tw);?>" class="fa fa-twitter"></a></li>
                        <?php endif;?>
                        <?php if ($description_yt != NULL) :?>
                        <li><a href="<?php echo esc_url($description_yt);?>" class="fa fa-youtube"></a></li>
                        <?php endif;?>
                        <?php if ($description_sc != NULL) :?>
                        <li><a href="<?php echo esc_url($description_sc);?>" class="fa fa-soundcloud"></a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div><!--End .text-desc-->
        </div><!--End .citysoul-short-description-->
    </div>
</section><!--End .about-text-->
<?php	
} elseif($description_option == 'noimage'){
	if($description_title_box == '') {
		$description_title_box = esc_html('About','citysoul');
	}
	if($description_title_tags == ''){
		$description_title_tags = esc_html('we have some amazing !','citysoul');
	}

?>
<section class="citysoul-about-event" id="short-desc-<?php echo esc_attr($randID);?>">
    <div class="container">
        <div class="citysoul-title-half title-about-event title-opacity text-center">
            <div class="citysoul-title text-opacity text-title text-5x text-white"><?php echo esc_html($description_title_box); ?></div>
            <div class="citysoul-tags main-text text-title text-active"><?php echo esc_html($description_title_tags); ?></div>
        </div>
        <div class="clearfix"></div>
        <div class="main-text-about col-md-6 col-sm-6 col-xs-12">
            <p class="text-title text-active text-2x">
             <?php echo esc_html($description_title);?>
            </p>
            <div class="clearfix"></div>
            <ul class="citysoul-social social-round">
                <?php if ($description_fb != NULL) :?>
                <li><a href="<?php echo esc_url($description_fb);?>" class="fa fa-facebook"></a></li>
            	<?php endif;?>
            	<?php if ($description_tw != NULL) :?>
                <li><a href="<?php echo esc_url($description_tw);?>" class="fa fa-twitter"></a></li>
                <?php endif;?>
                <?php if ($description_yt != NULL) :?>
                <li><a href="<?php echo esc_url($description_yt);?>" class="fa fa-youtube"></a></li>
                <?php endif;?>
                <?php if ($description_sc != NULL) :?>
                <li><a href="<?php echo esc_url($description_sc);?>" class="fa fa-soundcloud"></a></li>
                <?php endif;?>
            </ul>
        </div><!--End .main-text-about-->
        <div class="detail-text-about col-md-6 col-sm-6 col-xs-12 text-desc">
            <p><?php echo esc_html($content);?></p>
        </div><!--End .detail-text-about-->
    </div>
</section>
<?php
}
