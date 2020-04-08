<?php
$title_element = $shedule_list_id = $title_desc = $view_cat = $show_cat = $sche_id = $textcolor = $css = $colorborder = $bgcolor = $linkcolor = $linkhover = $img_menu = $max_items = $desc_color = $name_color = $content_color = $price_color = '';


extract(shortcode_atts(array(
	'pages' 			=> '',
	'title_element' 	=> '',
	'shedule_list_id' 	=> '',
	'textcolor'			=> '',
	'colorborder'		=> '',
	'bgcolor'			=> '',
	'linkcolor'			=> '',
	'linkhover'			=> '',
	'css' 				=> '',
	'title_desc'		=> '',
	'sche_id'			=> '',
    'view_cat'          => '',
    'show_cat'          => '',
    'max_items'         => '',
    'desc_color'        => '',
    'name_color'        => '',
    'content_color'     => '',
    'price_color'       => '',
), $atts));

if($show_cat == '') {
    $show_cat = 'snack';
}

$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);


// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'menu-list'.$id_ran;

//Setup style for shortcode
$setup      = array(
    '.citysoul-snack-list, .drink-list' => array(
        'background'                 => $bgcolor,
    ),
    '.snack-title, .drink-title'  => array(
        'color'     => $textcolor,
    ),
    '.text-main-list'   => array(
        'color'     => $desc_color,
    ),
    '.title-snack, span.text-title'  => array(
        'color'     => $name_color,
    ),
    'em.text-more'  => array(
        'color'     => $content_color,
    ),
    '.snack-price, strong.text-title'  => array(
        'color'     => $price_color,
    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);

include(get_parent_theme_file_path().'/vc_templates/menu/'.$show_cat.'.php');
?>


