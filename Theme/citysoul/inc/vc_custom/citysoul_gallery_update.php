<?php
/*
 * Shortcode gallery style
 * function - citysoul_gallery_style()
 * @update VNMilky
 * @version 1.2.0
 */

if (!class_exists('WPBakeryShortCode_citysoul_gallery_style')) {
    add_action( 'vc_before_init', 'citysoul_gallery_style', 999999);

    function citysoul_gallery_style() {
        $count_team = '';
        if (function_exists('citysoul_number_post')) {
            $count_team = intval(citysoul_number_post('gallery'));
        }

        $citysoul_perpage_arr = array();
        for($i=1; $i<=$count_team; $i++){
            $citysoul_perpage_arr[]= $i;
        }
        vc_map( array(
            "name" => esc_html__( "Gallery","citysoul" ),
            "base" => "citysoul_gallery_style",
            'weight' => 105,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'          =>  'vc_beautheme',
            "params" => array(
                    array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Option Gallery', 'citysoul'),
                    'param_name' => 'option',
                    'admin_label' => true,
                    'value' => array(
                        esc_html__('Select', 'citysoul')           => '',
                        esc_html__('Gallery Style 1', 'citysoul')  => 'gallery_style',
                        esc_html__('Gallery Style 2', 'citysoul')  => 'gallery_style2',
                        esc_html__('Gallery Full', 'citysoul')     => 'gallery_full',
                        ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title Element', 'citysoul' ),
                        'param_name' => 'title_element',
                        'value' => '',
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','gallery_style','gallery_style2'),
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea_rows',
                        'heading' => esc_html__( 'Description', 'citysoul' ),
                        'param_name' => 'title_desc',
                        'rows'  =>  3,
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','gallery_style','gallery_style2'),
                        ),
                        'admin_label' => true,
                        'value' => '',
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link All Gallery', 'citysoul' ),
                        'param_name' => 'links',
                        'value' => '',
                        'admin_label' => true,
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','gallery_style','gallery_style2'),
                        ),
                    ),
                    //Stype
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  esc_html__('Option Data','citysoul' ),
                        'param_name'    =>  'option_data',
                        'edit_field_class'  =>  'vc_col-xs-6',
                        'admin_label' => true,
                        'value'         =>  array(
                                esc_html__('Select...', 'citysoul' )        =>  '',
                                esc_html__( 'In Post ID', 'citysoul' )      =>  'inpostid',
                                esc_html__( 'In Category', 'citysoul' )     =>  'incategory'
                        ),
                        'group'       =>    esc_html__('Data Settings','citysoul'),

                    ),
                    array(
                        'type'          => 'number',
                        'heading'       => esc_html__('Max Items (Range -1->1000)', 'citysoul' ),
                        'param_name'    => 'max_items',
                        'edit_field_class'  =>  'vc_col-xs-6 vc_rs_pdt',
                        'value'         => '',
                        'min'           =>  -1,
                        'max'           =>  1000,
                        'group'         =>  esc_html__('Data Settings','citysoul'),
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array('','gallery_style','gallery_full'),
                        ),
                    ),
                    array(
                    'type'          =>  'textfield_disabled',
                    'heading'       =>  esc_html__('Max Items', 'citysoul'),
                    'param_name'    =>  'max_items_fake',
                    'value'         =>  '4',
                    'edit_field_class'  =>  'vc_col-xs-6 vc_rs_pdt',
                    'dependency'    => array(
                        'element'       => 'option',
                        'value'         => array('gallery_style2',),
                    ),
                    'group'          => esc_html__('Data Settings', 'citysoul'),
                    ),
                    //Data Option
                     array(
                        'type'          => 'autocomplete',
                        'heading'       => esc_html__( 'In ID', 'citysoul' ),
                        'param_name'    => 'inpost_id',
                        'settings'      => array(
                                'multiple'      => false,
                                'sortable'      => true,
                                'min_length'    => 1,
                                'no_hide'       => true, // In UI after select doesn't hide an select list
                                'groups'        => true, // In UI show results grouped by groups
                                'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                                'display_inline' => true, // In UI show results inline view
                                'values'        => citysoul_get_single_post('gallery')
                        ),
                        'description' => esc_html__( 'Type title single new to choose . Please type two char !', 'citysoul' ),
                        'group'       =>    esc_html__('Data Settings','citysoul'),
                        'dependency'  => array(
                            'element'   => 'option_data',
                            'value'     => array( 'inpostid' ),
                        ),
                    ),
                    array(
                        'type'          => 'autocomplete',
                        'heading'       => esc_html__( 'In Category', 'citysoul' ),
                        'param_name'    => 'id_category',
                        'group'         => esc_html__('Data Settings','citysoul'),
                        'settings'      => array(
                          'multiple'        => true,
                          'sortable'        => true,
                          'min_length'      => 1,
                          'no_hide'         => true, // In UI after select doesn't hide an select list
                          'groups'          => true, // In UI show results grouped by groups
                          'unique_values'   => true, // In UI show results except selected. NB! You should manually check values in backend
                          'display_inline'  => true, // In UI show results inline view
                          'values'          => citysoul_get_list_taxonomy_by_name('category_gallery'),
                        ),
                        'dependency' => array(
                          'element'         => 'option_data',
                           'value'          => array( 'incategory' ),
                        ),

                    ),


                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Title Element", "citysoul" ),
                        "param_name"    => "color_title",
                        "value"         => '',
                         'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( '','gallery_style','gallery_style2'),
                        ),
                        'group'         => esc_html__( 'Color Settings', 'citysoul' ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "All Gallery", "citysoul" ),
                        "param_name"    => "color_more",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                        'dependency'  => array(
                            'element'   => 'option',
                            'value'     => array( '','gallery_style','gallery_style2'),
                        ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Name ", "citysoul" ),
                        "param_name"    => "color_name",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', 'citysoul' ),
                    ),

                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Active", "citysoul" ),
                        "param_name"    => "color_active",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', 'citysoul' ),
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => esc_html__('Css', 'citysoul'),
                        'param_name' => 'css',
                        'group' => esc_html__('Design options', 'citysoul'),
                    ),
                ),
               )
            );
        }
    class WPBakeryShortCode_citysoul_gallery_style extends WPBakeryShortCode {}
}