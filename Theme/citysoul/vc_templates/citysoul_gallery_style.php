<?php
$title_element =
$gallery_id =
$option =
$title_desc =
$links =
$option_data =
$inpost_id =
$id_category =
$max_items =
$color_title =
$color_more =
$color_name =
$color_active =
$color_block =
$css = '';


extract(shortcode_atts(array(
    'title_element' => '',
    'max_items'     => '',
    'option'        => '',
    'gallery_id'    => '',
    'color_title'   => '',
    'color_more'    => '',
    'color_name'    => '',
    'color_active'  => '',
    'color_block'   => '',
    'css'           => '',
    'links'         => '',
    'title_desc'    => '',
    'option_data'   => '',
    'inpost_id'     => '',
    'id_category'   => '',
), $atts));

if($option == '') {
    $option = 'gallery_style';
}
if($option_data == '') {
    $option_data = 'inpostid';
}
$id_post = '';
if ($inpost_id != NULL) {
  $id_post = explode(',', $inpost_id);
}
$list_category_id = '';
if ($id_category != NULL) {
    $list_category_id = explode(',', $id_category);
}
if($max_items == ''){
    if($option == 'gallery_style'){
        $max_items = '3';
    }
    if($option == 'gallery_full'){
        $max_items = '9';
    }
}
if($option == 'gallery_style2'){
    $max_items = '4';
}
$css_class = apply_filters(
    VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'gallery_list'.$id_ran;
$color_hover = array();
$color_op = '';
    if($color_name != NULL) {
        $color_hover = array(
            'opacity'   =>  '1',
            );
        $color_op = '0.7';
    }
$color_viewmore_hover = array();
    if($color_more != NULL) {
        $color_viewmore_hover = array(
            'opacity'   =>  '0.5',
            );
    }
//Setup style for shortcode
$setup      = array(
    '[data-color="sh_title"]'   => array(
        'color'                 => $color_title,
    ),
    '[data-color="sh_name"] a'  => array(
        'color'                 => $color_name,
        'opacity'               => $color_op,
    ),
    '[data-color="sh_more"]'        =>  array(
        'color'                 =>  $color_more,
    ),
    '.view-all-link:before'        =>  array(
        'background'                 =>  $color_active,
    ),
    '.galleryh3__item--element__more:before'        =>  array(
        'background'                 =>  $color_active,
    ),
    '[data-color="sh_desc"]'        =>  array(
        'color'                 =>  $color_active,
    ),
    '[data-color="sh_more"]:hover'  =>  $color_viewmore_hover,
    'time'  => array(
        'color'                 => $color_active,
    ),
    '[data-color="sh_date"]'  => array(
        'color'                 => $color_active,
    ),
    '[data-color="sh_name"] a:hover'   => $color_hover,
);
$sh_link    =  vc_build_link($links);
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
    $sh_link_title = esc_html__('All gallery', 'citysoul');
}
if ($id_category != NULL) {
    $args = array(
        'post_type' => 'gallery',
        'posts_per_page' => $max_items,
        'post__in'        => $id_post ,
        'tax_query'         => array(
            array(
                'taxonomy'  => 'category_gallery',
                'field'     => 'id',
                'terms'     => $list_category_id,
            ),
        ),
    );
}
else{
    $args = array(
      'post_type' => 'gallery',
      'posts_per_page' => $max_items,
      'post__in'        => $id_post,
    );
}


// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);

include(get_parent_theme_file_path().'/vc_templates/gallery/'.$option.'.php');
?>

