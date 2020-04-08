<?php
$pages = $title_element = $desc_element = $team_id = $option = $textcolor = $css = $colorborder = $bgcolor = $linkcolor = $linkhover = $option_data = $inpost_id = $id_category = $max_items = '';


extract(shortcode_atts(array(
	'pages' 		=> '',
	'title_element' => '',
	'desc_element'	=> '',
	'team_id' 		=> '',
	'option'		=> '',
	'textcolor'		=> '',
	'colorborder'	=> '',
	'bgcolor'		=> '',
	'linkcolor'		=> '',
	'linkhover'		=> '',
	'css' 			=> '',
	'option_data'	=> '',
	'inpost_id'		=> '',
	'id_category'		=> '',
	'max_items' 	=> ''
), $atts));
$inpost_id_list = '';
if(!empty($inpost_id)) {
	$inpost_id_list = explode(',', $inpost_id);
}

if($option_data == '') {
    $option_data = 'inpostid';
}

if($option == '') {
	$option = 'list-dj01';
}

if($max_items == '') {
	$max_items = -1;
}
$list_category_id = '';
if ($id_category != NULL) {
    $list_category_id = explode(',', $id_category);
}

$css_class = apply_filters(
	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ' ), $this->settings['base'], $atts);


// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'dj_'.$id_ran;

//Setup style for shortcode
$setup      = array(
    '.text-title ' => array(
        'background'                 => $bgcolor,
    ),
    '.text-title .dj-name-inner .dj-tags .dj-name' => array(
        'color'                 => $textcolor,

    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);


include(get_parent_theme_file_path().'/vc_templates/list-dj/'.$option.'.php');
?>
