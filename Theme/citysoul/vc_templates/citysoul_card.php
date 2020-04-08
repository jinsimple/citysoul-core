<?php 

$title_element = $desc_element = $card_id = $pages = $id_contact_form = $textcolor = $colorborder = $bgcolor = $linkcolor = $linkhover = $css = $title_apply = $desc_apply = '';

extract(shortcode_atts(array(
	'title_element' 		=> '',
	'desc_element' 			=> '',
	'card_id'				=> '',
	'pages' 				=> '',
	'id_contact_form'		=> '',
	'textcolor'				=> '',
	'colorborder'			=> '',
	'bgcolor'				=> '',
	'linkcolor'				=> '',
	'linkhover'				=> '',
	'title_apply'			=> '',
	'desc_apply'			=> '',
	'css' 					=> '',
), $atts));
if($id_contact_form =='') {
	return false;
}
if(!empty($card_id)) {
	$card_id_list = explode(',', $card_id);
}
if($pages == '') {
	$pages = -1;
}

$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);


// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'card_'.$id_ran;

//Setup style for shortcode
$setup      = array(
    ' .pagkage-current ' => array(
        'background'            => $bgcolor,
    ),
    ' .text-active, ' => array(
        'color'                 => $textcolor,
    ),
    '.list-feature' => array(
    	'color'   				=> $linkhover,
    ),

    ' .title-opacity .text-opacity' => array(
        'color'                 => $linkhover,
    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);
?>

<section class="pagkage-list <?php echo esc_html($css_class);?>">
    <div class="container">
        <div class="citysoul-pagkage-list">
		<?php 
			$args = array(
	            'post_type'     => 'cards',
                'posts_per_page' => $pages,
	          );
            if( isset($card_id_list)) {
                $args['post__in'] = $card_id_list;
            }
            
            $style = $text = '';
	        $loop = new WP_Query( $args );
	        wp_reset_postdata();
	        $default_card = array(); 
	        while ($loop->have_posts())  : $loop->the_post() ;
	      	if (function_exists('get_field')) {
		        if(!empty(get_field('card_vip'))) {
		        	$style = 'pagkage-current';
		        	$text = 'text-white';
		        	$default_card = get_the_ID();
		        } else {
		        	 $style = '';
		        	 $text = 'text-active';
		        }
	        }
			?>
            <div class="pagkage-item col-md-3 col-sm-6 col-xs-12">
                <div class="pagkage-item-info <?php echo esc_html($style);?>">
                    <div class="item-info text-active title-pagkage text-16x text-more"><?php the_title(); ?></div>
                    <div class="item-info image-card">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="item-info title-card">
                        <span class="text-title text-2x <?php echo esc_html($text);?>"><?php the_field('card_name')?></span>
                        <div class="clearfix"></div>
                        <span class="card-price text-title text-2x <?php echo esc_html($text);?>"><?php the_field('card_value') ?></span>
                    </div>
                    <div class="item-info">
                        <ul class="list-feature">
                        	<?php while (have_rows('card_feature', get_the_ID())) : the_row() ;?>
                            <li><?php the_sub_field('card_feature_txt') ?></li>                
                        	<?php endwhile;?>
                        </ul>
                    </div>
                    <div class="item-info">
                        <a href="#" class="citysoul-button text-title  text-active citysoul-button-o" data-value="<?php echo get_the_ID();?>"><?php the_field('card_submit') ?></a>
                    </div>
                </div><!--End .pagkage-item-info-->
            </div><!--End .pagkage-item-->
            

            <?php endwhile; ?>
        </div><!--End .citysoul-pagkage-list-->
    </div>
</section>
<section class="apply-form" id="apply-form" >
    <div class="container" >
        <div class="citysoul-apply-form" >
        <?php if(!empty($title_apply)) { ?>
            <div class="title-apply-form title-opacity col-md-6 col-sm-6 col-xs-12">
                <span class="text-opacity text-title text-7x citysoul-title"><?php echo esc_html($title_apply); ?></span>
                <span class="main-text text-title text-active citysoul-title text-16x"><?php echo esc_html($desc_apply); ?></span>
            </div><!--End .title-apply-form-->
        <?php }else { ?>
        	<div class="title-apply-form title-opacity col-md-6 col-sm-6 col-xs-12">
                <span class="text-opacity text-title text-7x citysoul-title"><?php echo esc_html($title_apply); ?></span>
                <span class="main-text text-title text-active citysoul-title text-16x"><?php echo esc_html($desc_apply); ?></span>
            </div>
        <?php } ?>
            <form action="#" class="checkout">
                <div class="box-check-out">
                <?php 

					echo do_shortcode('[contact-form-7 id="'. $id_contact_form .'"]');

					if(have_rows('card_limitation', $default_card));
					if( have_rows('card_contacts', $default_card) );
				 ?>
					<div class="pull-right apply-chose col-md-4 col-sm-4 col-xs-12 period">
						<div class="title-box text-title text-active citysoul-title text-16x"><?php the_field('card_name'); ?></div>
						<ul class="text-title list-view-member list-pagkage-register">
						<?php while( have_rows('card_limitation', $default_card)) : the_row() ; ?>
						    <li data-pagkage="3">
						    	<i class="fa fa-circle"></i><?php echo get_sub_field('card_lm_times')." : ".get_sub_field('card_lm_values'); ?>
						    </li>
						<?php endwhile; ?>
						</ul>
						<div class="clearfix"></div>
						<div class="title-box text-title text-active citysoul-title text-16x"><?php _e('Membership Period','citysoul'); ?></div>
						<ul class="list-address list-view-member">
						<?php while( have_rows('card_contacts', $default_card) ) : the_row(); ?>
					    <li><strong class="text-title"><?php the_sub_field('card_ct_title'); ?></strong> : <em class="text-more text-16x"><?php the_sub_field('card_ct_value'); ?></em></li>
						<?php endwhile; ?>
						</ul>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</section>
<?php 
/*
 * After loop
 * citysoul_card_script_member - 10
 */
    do_action( 'citysoul_card_script_hook');
?>
