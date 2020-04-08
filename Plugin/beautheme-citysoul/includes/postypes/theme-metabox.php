<?php
if ( !class_exists( 'CMB2_Bootstrap_2231' ) ) {
    add_action( 'cmb2_admin_init', 'beau_theme_metaboxes' );
    /**
     * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
     */
    function beau_theme_metaboxes() {
    	$prefix = '_beautheme_';

    	$list_slide = array();
        if(function_exists('get_mastersliders')){
            $master_sliders = get_mastersliders();
            $count = count(get_masterslider_names());
            $list_slide[''] = 'Select...';
            for ($i=0; $i < $count; $i++) {
                $list_slide[($master_sliders[$i]['alias'])] = $master_sliders[$i]['title'];
            }
            if (count($master_sliders) == 0) {
                $list_slide = array(0=>__('No slider found','bebo'));
            }
        }else{
            $list_slide = array(__('No slider found','bebo'));
        }
        //Header array
        $custom_header = array(
            ''              => 'Default on Theme Option',
            'none-slide'    => 'None slide',
            'default'           => 'Default',
            'center'    => 'Center',
            'transfarent'    => 'Transfarent',
            'home-slide' => 'Home slide',
            'headerfull' => 'Header full'
        );

        //Footer array
        $custom_footer = array(
            ''                  => __('Default on Theme Option'),
            'default'           => __('Footer default','beautheme'),
            'onecolumn'       => __('Footer one column','beautheme'),
        );

        //Footer array
        $select_sidebar = array(
            ''              => __('None slidebar'),
            'left'     => __('Left slidebar','beautheme'),
            'right'     => __('Right slidebar','beautheme'),
        );

    	/**
    	 * Sample metabox to demonstrate each field type included
    	 */
    	$cmb_demo = new_cmb2_box( array(
    		'id'            => $prefix . 'header-footer',
    		'title'         => __( 'Your custom header & footer', 'cmb2' ),
    		'object_types'  => array( 'page', ), // Post type
    		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
    		 'context'    => 'normal',
    		 'priority'   => 'high',
    		 'show_names' => true, // Show field names on the left
    		// 'cmb_styles' => false, // false to disable the CMB stylesheet
    		// 'closed'     => true, // true to keep the metabox closed by default
    	) );
        $cmb_demo->add_field( array(
            'name'             => __( 'Style Footer', 'cmb2' ),
            'id'               => $prefix . 'footer-type',
            'type'             => 'select',
            'options'          => $custom_footer,
            'default' => 'default',
        ) );
        $cmb_demo->add_field( array(
            'name'             => __( 'Show breadcrumb?', 'cmb2' ),
            'desc'             => __( 'Choose Yes to show breadcrumb', 'cmb2' ),
            'id'               => $prefix . 'show_breadcrumb',
            'type'             => 'select',
            'options'          => array(
                '1' => __( 'Yes', 'cmb2' ),
                '0'   => __( 'No', 'cmb2' ),
            ),
            'default' => 'no',
        ) );

    	$cmb_demo->add_field( array(
    		'name'    => __('Select slide','nextop'),
            'desc'    => __('Chose your slider','nextop'),
            'id'      => $prefix . 'slide_custom',
            'type'    => 'select',
            'options' => $list_slide,
    	) );

    	$cmb_demo = new_cmb2_box( array(
    		'id'            => $prefix . 'sidebar',
    		'title'         => __( 'Custom sidebar', 'cmb2' ),
    		'object_types'  => array( 'page', ), // Post type
    		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
    		 'context'    => 'normal',
    		 'priority'   => 'high',
    		 'show_names' => true, // Show field names on the left
    		// 'cmb_styles' => false, // false to disable the CMB stylesheet
    		// 'closed'     => true, // true to keep the metabox closed by default
    	) );

    	$cmb_demo->add_field( array(
    		'name'    => __('Select style sidebar','nextop'),
            'desc'    => __('Chose style sidebar','nextop'),
            'id'      => $prefix . 'sidebar_custom',
            'type'    => 'select',
            'options' => $select_sidebar,
    	) );

    	$cmb_demo->add_field( array(
    		'name'    => __('Select sidebar show','nextop'),
            'desc'    => __('Chose sidebar show','nextop'),
            'id'      => $prefix . 'sidebar_show',
            'type'    => 'select',
            'options' => beau_get_sidebar(),
    	) );
    }
}
