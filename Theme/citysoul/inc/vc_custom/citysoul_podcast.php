<?php
/**
 * SH Podcast v1.2.0
 * @author VNMilky
 */
if(!class_exists('WPBakeryShortCode_citysoul_podcast')) {
add_action('vc_before_init','citysoul_podcast',999999);
    function citysoul_podcast(){
        vc_map(array(
            'name'          =>  esc_html__('Podcast' ,'citysoul'),
            'base'          =>  'citysoul_podcast',
            'weight'        =>  200,
            'category'      =>  esc_html__('Beau Theme','citysoul'),
            'icon'          =>  'vc_beautheme',
            'params'        =>  array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Title Element', 'citysoul' ),
                        'param_name' => 'sh_title',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link View', 'citysoul' ),
                        'param_name' => 'sh_link',
                        'value' => '',
                        'admin_label' => true,
                    ),
                    array(
                        'type'          => 'autocomplete',
                        'heading'       => esc_html__( 'InID', 'citysoul' ),
                        'param_name'    => 'in_id',
                        'admin_label' => true,
                        'settings'      => array(
                                  'multiple'            => true,
                                  'sortable'            => true,
                                  'max_length'          => 1,
                                  'no_hide'             => true, // In UI after select doesn't hide an select list
                                  'groups'              => true, // In UI show results grouped by groups
                                  'unique_values'       => true, // In UI show results except selected. NB! You should manually check values in backend
                                  'display_inline'      => true, // In UI show results inline view
                                  'values'              => citysoul_get_single_post('album')
                            ),
                        'description'   => esc_html__( 'Type title single album to choose', 'citysoul' ),
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
                        "heading"       => esc_html__( "View ", "citysoul" ),
                        "param_name"    => "color_viewmore",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Song Name", "citysoul" ),
                        "param_name"    => "color_name",
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
                        "heading"       => esc_html__( "Control", "citysoul" ),
                        "param_name"    => "color_control",
                        "value"         => '',
                        'group'         => esc_html__( 'Color Settings', "citysoul" ),
                    ),
                    array(
                        "type"          => "colorpicker",
                        "heading"       => esc_html__( "Time", "citysoul" ),
                        "param_name"    => "color_time",
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
    class WPBakeryShortCode_citysoul_podcast extends WPBakeryShortCode{}
}
