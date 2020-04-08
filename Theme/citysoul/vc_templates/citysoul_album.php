<?php
$option = $title_element = $desc_element = $album_id = $pages=  $textcolor = $css = $colorborder = $bgcolor = $linkcolor = $linkhover = '';
extract(shortcode_atts(array(
    'pages'         => '',
    'option'        =>  '',
    'title_element' => '',
    'desc_element'  => '',
    'album_id'      => '',
    'textcolor'     => '',
    'colorborder'   => '',
    'bgcolor'       => '',
    'linkcolor'     => '',
    'linkhover'     => '',
    'css'           => '',
), $atts));
if(!empty($album_id)) {
    $album_id_list = explode(',', $album_id);
}
if($pages == '') {
    $pages = -1;
}
$css_class = apply_filters(
    VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);
// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'podcast_'.$id_ran;
//Setup style for shortcode
$setup      = array(
    '.text-title ' => array(
        'background'                 => $bgcolor,
    ),
    '#posc, .text-name h1.text-white' => array(
        'color'                 => $textcolor,
    ),
    '.text-more ' => array(
        'color'   => $linkhover,
    ),
    '.jp-current-song' => array(
        'color' => $linkhover,
    )
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);


$args = array(
    'post_type' => 'album',
    'posts_per_page' => 1,
);
if( isset($album_id_list)) {
    $args['post__in'] = $album_id_list;
}
if($option == ''){
    $option = 'left';
}


include(get_parent_theme_file_path().'/vc_templates/album/'.$option.'.php');