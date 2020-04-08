<?php
/**
 * Set front, blog page , menu
 */
function setting_page(){
	// remove widget
    $widgets = get_option('sidebars_widgets');
    foreach ($widgets as $key => $value) {
        $widgets[$key] = array();
    }
    update_option('sidebars_widgets', $widgets, true);
	
    $page_setting = array(
        'front' => 'Home',
        'blog' => ''
    );
    // menu array : menu_location => menu name
    $menu_setting = array(
        'main-menu'     => 'Main Menu',
		'mobile-menu'	=> 'Main Menu'
       
    );
    return array(
        'page_setting' => $page_setting,
        'menu_setting' => $menu_setting
    );
}
/**
* After setting page, do what you want
* For me, I want to set megamenu for main-menu
*/
function after_setting_page(){
   
}

function setup_megamenu_parent($menu_id , $is_forced = true, $panel_columns = 5){
	if(empty($menu_id)) {
		return;
	}
	$submitted_setting = array();
	$submitted_setting['type'] = 'megamenu';
	if($is_forced) $submitted_setting['submenu_ordering'] = 'forced';
	$submitted_setting['panel_columns'] = $panel_columns;
    update_post_meta( $menu_id, '_megamenu', $submitted_setting );
}

function setup_megamenu_child($menu_id , $menu_parent_id , $sort_order){
	$submitted_setting = array(
		'mega_menu_order' => array(
			$menu_parent_id => $sort_order
		),		
	);
	update_post_meta($menu_id , '_megamenu' , $submitted_setting);
}