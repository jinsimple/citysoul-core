<?php
/**
 * SH Event Update for v1.2.0
 * @author VNMilky
 */
$option =
$list_event_title =
$list_event_link =
$list_event_desc =
$max_items_big =
$max_items =
$in_id =
$in_category =
$color_title =
$color_viewmore =
$color_name =
$color_number =
$color_active =
$color_jobs =
$color_nav =
$color_block =
$css = '';
extract(shortcode_atts(array(
    'option'                            =>  '',
    'list_event_title'                  =>  '',
    'list_event_link'                   =>  '',
    'list_event_desc'                   =>  '',
    'in_category'                       =>  '',
    'in_id'                             =>  '',
    'max_items'                         =>  '',
    'max_items_big'                     =>  '',
    'color_title'                       =>  '',
    'color_viewmore'                    =>  '',
    'color_name'                        =>  '',
    'color_number'                      =>  '',
    'color_active'                      =>  '',
    'color_jobs'                        =>  '',
    'color_nav'                         =>  '',
    'color_block'                       =>  '',
    'text_option'                       =>  '',
    'css'                               =>  '',
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'event_v1_2_0_'.$id_ran;

if($option == ''){
    $option = 'big_image';
}
if($option != NULL) {
    include(get_parent_theme_file_path().'/vc_templates/event_update/'.$option.'.php');
}