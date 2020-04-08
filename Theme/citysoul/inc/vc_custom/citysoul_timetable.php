<?php
/**
 * SH Event v1.2.0
 * @author VNMilky
 */
if(!class_exists('WPBakeryShortCode_citysoul_timetable')) {
add_action('vc_before_init','citysoul_timetable',999999);
    function citysoul_timetable(){
        vc_map(array(
            'name'          =>  esc_html__('Event Timetable' ,'citysoul'),
            'base'          =>  'citysoul_timetable',
            'weight'        =>  200,
            'category'      =>  esc_html__('Beau Theme','citysoul'),
            'icon'          =>  'vc_beautheme',
            'params'        =>  array(
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  esc_html__('Options','citysoul' ),
                        'param_name'    =>  'sh_disable_fillter',
                        'admin_label' => true,
                        'edit_field_class'  => 'vc_col-xs-3',
                        'value'         =>  array(
                            esc_html__('Select','citysoul')   =>  '',
                            esc_html__('With Title','citysoul')   =>  'no',
                            esc_html__('No Title','citysoul')     =>  'yes',

                        ),
                    ),
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  esc_html__('Locale','citysoul' ),
                        'param_name'    =>  'sh_locale',
                        'admin_label' => true,
                        'edit_field_class'  => 'vc_col-xs-2 vc_rs_pdt',
                        'value'         =>  array(
                            esc_html__('Select','citysoul')   =>  '',
                            esc_html__('No','citysoul')   =>  'no',
                            esc_html__('Yes','citysoul')     =>  'yes',

                        ),
                        'std'       =>  'no',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title Element', 'citysoul' ),
                        'param_name' => 'sh_title',
                        'value' => '',
                        'edit_field_class'  => 'vc_col-xs-7 vc_rs_pdt',
                        'dependency'  => array(
                            'element'   => 'sh_disable_fillter',
                            'value'     => array('no'),
                        ),
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textarea_rows',
                        'heading' => esc_html__( 'Description', 'citysoul' ),
                        'param_name' => 'sh_desc',
                        'value' => '',
                        'rows'  =>  3,
                        'admin_label' => true,
                        'dependency'  => array(
                            'element'   => 'sh_disable_fillter',
                            'value'     => array('no'),
                        ),
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link View', 'citysoul' ),
                        'param_name' => 'sh_link',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    //Custom style for shortcode
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Title Element", "citysoul" ),
                        "param_name"    => "color_title",
                        "value"         => '',
                        'dependency'  => array(
                            'element'   => 'sh_disable_fillter',
                            'value'     => array('no'),
                        ),
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Description", "citysoul" ),
                        "param_name"    => "color_desc",
                        "value"         => '',
                        'dependency'  => array(
                            'element'   => 'sh_disable_fillter',
                            'value'     => array('no'),
                        ),
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Fillter", "citysoul" ),
                        "param_name"    => "color_fillter",
                        "value"         => '',
                        'dependency'  => array(
                            'element'   => 'sh_disable_fillter',
                            'value'     => array('no'),
                        ),
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
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
                        "heading"       => esc_html__( "Artist", "citysoul" ),
                        "param_name"    => "color_artist",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Tags Item", "citysoul" ),
                        "param_name"    => "color_tag",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                     array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Tags Item Bg", "citysoul" ),
                        "param_name"    => "color_tag_bg",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
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
    class WPBakeryShortCode_citysoul_timetable extends WPBakeryShortCode{}
}