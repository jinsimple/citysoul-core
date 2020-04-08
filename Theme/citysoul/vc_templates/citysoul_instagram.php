<?php
/**
 * SH Instagram for v1.2.0
 * @author VNMilky
 */
$sh_name =
$sh_user =
$color_title =
$color_active =
$css = '';
extract(shortcode_atts(array(
    'sh_name'                           =>  '',
    'sh_user'                           =>  '',
    'color_title'                       =>  '',
    'color_active'                      =>  '',
    'css'                               =>  '',
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'instagram_v1_2_0_'.$id_ran;
if($sh_user != NULL) :
    $color_op = array();
    if($color_active != NULL) {
        $color_op = array(
            'opacity'   =>  '0.5',
            );
    }
    $setup = array(
        '.instagram__element__title'        =>  array(
                'color'                     =>  $color_title,
            ),
        '[data-color="sh_active"]'          =>  array(
                'color'                     =>  $color_active,
            ),
        '[data-color="sh_active"]:hover'    => $color_op,
        );
    echo citysoul_css_shortcode($randomID, $setup);
?>
<div id="<?php echo esc_attr($randomID);?>" class="instagram <?php echo esc_attr( $css_class ); ?>">
    <div class="instagram__element">
        <span data-color="sh_active" class="instagram__element__user"><?php if($sh_name != NULL) : echo sprintf('%s /',$sh_name); endif;?></span>
        <span class="instagram__element__title"><?php esc_html_e('Instagram','citysoul');?></span>
        <?php if($sh_user != NULL) : echo sprintf('<a href="%s" title="%s" data-color="sh_active" target="_blank" class="instagram__element__follow">',esc_url('https://www.instagram.com/'.$sh_user),$sh_user); esc_html_e('/ Follow','citysoul');?></a><?php endif;?>
    </div>
    <div class="instagram__list" data-citysoul="<?php echo esc_attr($randomID)?>">
        <?php if(function_exists('beau_instagram_image')) :
                $instagram = array();
                $instagram = beau_instagram_image($sh_user,10);
                if(count($instagram) > 0 ) :
                    foreach($instagram as $x => $s) :
            ?>
            <div class="instagram__item" data-citysoul-masonry="<?php echo esc_attr($randomID)?>">
                <div class="instagram__image"><?php echo sprintf('<a href="%s" title="%s" target="_blank"><img src="%s" alt="%s"></a>',$s['link_to'],$sh_user,$s['link'],$sh_user);?></div>
            </div>
        <?php endforeach; endif; endif;?>
    </div>
</div>
<?php
do_action('citysoul_js_masonry_hook',$randomID);
endif;