<?php
/**
 * SH Instagram v1.2.0
 * @author VNMilky
 */
if(!class_exists('WPBakeryShortCode_citysoul_instagram')) {
add_action('vc_before_init','citysoul_instagram',999999);
    function citysoul_instagram(){
        vc_map(array(
            'name'          =>  esc_html__('Instagram' ,'citysoul'),
            'base'          =>  'citysoul_instagram',
            'weight'        =>  200,
            'category'      =>  esc_html__('Beau Theme','citysoul'),
            'icon'          =>  'vc_beautheme',
            'params'        =>  array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Display Name', 'citysoul' ),
                        'param_name' => 'sh_name',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'User Instagram', 'citysoul' ),
                        'param_name' => 'sh_user',
                        'value' => '',
                        'admin_label' => true,
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
                        "heading"       => esc_html__( "Active", "citysoul" ),
                        "param_name"    => "color_active",
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
    class WPBakeryShortCode_citysoul_instagram extends WPBakeryShortCode{}
}