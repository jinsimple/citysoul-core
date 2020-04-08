<?php
$time_countdown = $images = $time_heading_color = $time_countdown_color = $time_countdown_bgcolor = $sh_link = $css = '';
extract(shortcode_atts(array(
        'time_countdown'                    =>  '',
        'images'                            =>  '',
        'sh_link'                           =>  '',
        'time_heading_color'                =>  '',
        'time_countdown_color'              =>  '',
        'time_countdown_bgcolor'            =>  '',
        'css'                               =>  '',
        ),
    $atts)
);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
//Get link image background
$img = shortcode_atts(array(
    'images' => 'images',
), $atts);
$images_link = wp_get_attachment_image_src($img["images"], "full");
$images_l = $images_link[0];
$sh_link    =  vc_build_link($sh_link);
    $sh_link_url = $sh_link['url'];
    $sh_link_title = $sh_link['title'];
    $sh_link_target = $sh_link['target'];
    $sh_link_rel = $sh_link['rel'];
    if($sh_link['target'] == ' _blank'){
        $sh_link_target = ' target="_blank"';
    }
    if($sh_link['rel'] == 'nofollow'){
        $sh_link_rel = ' rel="nofollow"';
    }
    if($sh_link['title'] == ''){
        $sh_link_title = esc_html__('buy ticket', 'citysoul');
    }
$id_ran = rand(1, 99999);
//Setup style for shortcode
$setup      = array(
    '.msb-coundown-section'                      =>    array(
        'background'        =>    'url('.$images_l.') no-repeat top center ',
        'background-size'   =>    'cover',
    ),
    '.msb-coundown-section:before'      => array(
        'background'         => $time_countdown_bgcolor,

    ),
    '.msb-coundown-section .citysoul-date' => array(
        'color'             =>  $time_heading_color,
        ),
    '.msb-coundown-section .coundown-item'              => array(
        'color'             =>  $time_countdown_color,
        ),

);
// Make css style for shortcode
echo citysoul_css_shortcode('countdown-'.$id_ran, $setup);
if($time_countdown == ''){
    $time_countdown = '01/01/1970';
}
?>
<section class="<?php echo esc_attr( $css_class ); ?>" id="countdown-<?php echo esc_attr($id_ran);?>">
    <div class="msb-coundown-section">
        <div class="container">
            <div class="msb-coundown text-center">
                <div class="citysoul-date text-white"><em class="text-more text-3x"><?php echo date_i18n(get_option('date_format'),strtotime($time_countdown) );?></em></div>
                <ul class="msb-coundown-text" id="msb-coundown-total-<?php echo esc_attr($id_ran);?>">
                    <li class="coundown-item text-white">
                       <div class="text-title text-8x text-number" id="msb-coundown-day-<?php echo esc_attr($id_ran);?>">00</div>
                       <div class="clearfix"></div>
                       <em class="text-16x text-more text-date"><?php echo esc_html__('Days','citysoul');?></em>
                    </li>
                    <li class="coundown-item text-white">
                        <div class="text-title text-8x text-number" id="msb-coundown-hrs-<?php echo esc_attr($id_ran);?>">00</div>
                        <div class="clearfix"></div>
                        <em class="text-16x text-more text-date"><?php echo esc_html__('Hrs','citysoul');?></em>
                    </li>
                    <li class="coundown-item text-white">
                        <div class="text-title text-8x text-number" id="msb-coundown-min-<?php echo esc_attr($id_ran);?>">00</div>
                        <div class="clearfix"></div>
                        <em class="text-16x text-more text-date"><?php echo esc_html__('Mins','citysoul');?></em>
                    </li>
                    <li class="coundown-item text-white">
                        <div class="text-title text-8x" id="msb-coundown-sec-<?php echo esc_attr($id_ran);?>">00</div>
                        <div class="clearfix"></div>
                        <em class="text-16x text-more text-date"><?php echo esc_html__('Sec','citysoul');?></em>
                    </li>
                </ul>
                <?php
                /*
                 * After loop
                 * citysoul_countdown_script_hook - 10
                 */
                    do_action( 'citysoul_countdown_script_hook',$id_ran, $time_countdown);
                    if($sh_link_url != NULL) :
                ?>
                <div class="info-ticket info-ticket--cdw">
                    <a class="citysoul-button citysoul-button-small text-title" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?><i class="fa fa-ticket"></i></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>