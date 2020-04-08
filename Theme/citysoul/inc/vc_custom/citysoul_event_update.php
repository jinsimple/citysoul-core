<?php
/**
 * SH Event v1.2.0
 * @author VNMilky
 */
if(!class_exists('WPBakeryShortCode_citysoul_event_update')) {
add_action('vc_before_init','citysoul_event_update',999999);
    function citysoul_event_update(){
        $category_event_list = '';
        if (function_exists('citysoul_get_category_by_taxonomy')) {
            $category_event_list = citysoul_get_category_by_taxonomy('category_event');
        }
        vc_map(array(
            'name'          =>  esc_html__('Event Update' ,'citysoul'),
            'base'          =>  'citysoul_event_update',
            'weight'        =>  200,
            'category'      =>  esc_html__('Beau Theme','citysoul'),
            'icon'          =>  'vc_beautheme',
            'params'        =>  array(
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  esc_html__('Option','citysoul' ),
                        'param_name'    =>  'option',
                         'admin_label' => true,
                        'value'         =>  array(
                            esc_html__('Select ...','citysoul')     =>  '',
                            esc_html__('Big Single Image','citysoul')  =>  'big_image',
                            esc_html__('Slider','citysoul')  =>  'slider',
                            esc_html__('Slider Full Row','citysoul')  =>  'slider_row',
                        ),
                    ),

                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title Element', 'citysoul' ),
                        'param_name' => 'list_event_title',
                        'value' => '',
                         'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','big_image','slider'),
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea_rows',
                        'heading' => esc_html__( 'Description', 'citysoul' ),
                        'param_name' => 'list_event_desc',
                        'value' => '',
                        'rows'  =>  3,
                        'admin_label' => true,
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('slider'),
                        ),
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link View Calendar', 'citysoul' ),
                        'param_name' => 'list_event_link',
                        'value' => '',
                        'admin_label' => true,
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','big_image'),
                        ),
                    ),
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  esc_html__('Option Data', 'citysoul'),
                        'param_name'    =>  'option_data',
                        'edit_field_class'  =>  'vc_col-xs-8',
                        'value'         =>  array(
                            esc_html__('Seclect ...', 'citysoul')      =>  '',
                            esc_html__('InID', 'citysoul')             =>  'inid',
                            esc_html__('InCategory', 'citysoul')       =>  'incategory',
                            ),
                        'group'         => esc_html__('Data Settings', 'citysoul'),
                        'admin_label'   => true,

                    ),
                    array(
                        'type'          => 'number',
                        'heading'       => esc_html__('Max Items(Range 3->7)', 'citysoul' ),
                        'param_name'    => 'max_items_big',
                        'edit_field_class'  =>  'vc_col-xs-4 vc_rs_pdt',
                        'value'         => '',
                        'min'           =>  3,
                        'max'           =>  7,
                        'admin_label' => true,
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','big_image'),
                        ),
                        'group'         =>  esc_html__('Data Settings','citysoul'),
                    ),
                    array(
                        'type'          => 'number',
                        'heading'       => esc_html__('Max Items(Range 4->9999)', 'citysoul' ),
                        'param_name'    => 'max_items',
                        'edit_field_class'  =>  'vc_col-xs-4 vc_rs_pdt',
                        'value'         => '',
                        'min'           =>  4,
                        'admin_label' => true,
                        'max'           =>  9999,
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('slider','slider_row'),
                        ),
                        'group'         =>  esc_html__('Data Settings','citysoul'),
                    ),
                    array(
                        'type'          => 'autocomplete',
                        'heading'       => esc_html__( 'InID', 'citysoul' ),
                        'param_name'    => 'in_id',
                        'admin_label' => true,
                        'group'         => esc_html__('Option Settings','citysoul'),
                        'settings'      => array(
                                  'multiple'            => true,
                                  'sortable'            => true,
                                  'min_length'          => 1,
                                  'no_hide'             => true, // In UI after select doesn't hide an select list
                                  'groups'              => true, // In UI show results grouped by groups
                                  'unique_values'       => true, // In UI show results except selected. NB! You should manually check values in backend
                                  'display_inline'      => true, // In UI show results inline view
                                  'values'              => citysoul_get_single_post('event')
                            ),
                        'dependency'    => array(
                            'element'       =>  'option_data',
                            'value'         =>  array('','inid'),

                        ),
                        'description'   => esc_html__( 'Type title single event to choose', 'citysoul' ),
                        'group'         => esc_html__('Data Settings','citysoul'),
                    ),

                    array(
                      'type' => 'dropdown',
                      'heading' => esc_html__( 'InCategory', 'citysoul' ),
                      'param_name' => 'in_category',
                      'value' => $category_event_list,
                      'admin_label' => true,
                      'dependency'    => array(
                            'element'       =>  'option_data',
                            'value'         =>  array('incategory'),

                        ),
                      'group'           => esc_html__('Data Settings','citysoul'),
                    ),

                    //Custom style for shortcode
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Title Element", "citysoul" ),
                        "param_name"    => "color_title",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "View Calendar", "citysoul" ),
                        "param_name"    => "color_viewmore",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( '', 'big_image'),
                        ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Name Event", "citysoul" ),
                        "param_name"    => "color_name",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Number", "citysoul" ),
                        "param_name"    => "color_number",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( '', 'big_image'),
                        ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Active", "citysoul" ),
                        "param_name"    => "color_active",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "class"         => "",
                        "heading"       => esc_html__( "Jobs", "citysoul" ),
                        "param_name"    => "color_jobs",
                        "value"         => '',
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( '', 'big_image'),
                        ),
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Navigation", "citysoul" ),
                        "param_name"    => "color_nav",
                        "value"         => '',
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( 'slider','slider_row'),
                        ),
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Block Left", "citysoul" ),
                        "param_name"    => "color_block",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( '', 'big_image'),
                        ),
                    ),
                    array(
                      'type'            => 'css_editor',
                      'heading'         => esc_html__( 'Css', 'citysoul' ),
                      'param_name'      => 'css',
                      'group'           => esc_html__( 'Design options', 'citysoul' ),
                    ),

                ),
            )
        );
    }
    class WPBakeryShortCode_citysoul_event_update extends WPBakeryShortCode{}
}