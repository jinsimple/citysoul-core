<?php
/*
 * Shortcode album
 * function - citysoul_album()
 */

if (!class_exists('WPBakeryShortCode_citysoul_album')) {
    add_action( 'vc_before_init', 'citysoul_album', 999999);

    function citysoul_album() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('album'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

        vc_map( array(
            "name" => esc_html__( "Album","citysoul" ),
            "base" => "citysoul_album",
            'weight' => 200,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Option', 'citysoul' ),
              'param_name' => 'option',
              'admin_label' => true,
              'value' => array(
                  esc_html__('Select','citysoul')   =>  '',
                  esc_html__('Cover Left','citysoul') =>  'left',
                  esc_html__('Cover Right','citysoul')  =>  'right'
                ),
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title', 'citysoul' ),
              'param_name' => 'title_element',
              'value' => '',
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Description', 'citysoul' ),
              'param_name' => 'desc_element',
              'value' => '',
            ),

            array(
              'type'        => 'autocomplete',
              'heading'     => esc_html__( 'Select Album show list', 'citysoul' ),
              'param_name'  => 'album_id',
              'settings'    => array(
                'multiple' => true,
                'sortable' => true,
                'max_length' => 1,
                'no_hide' => true, // In UI after select doesn't hide an select list
                'groups' => true, // In UI show results grouped by groups
                'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                'display_inline' => true, // In UI show results inline view
                'values'   => citysoul_get_post_by_postype('album')
              ),
              'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
            ),

            array(
            'type'      => 'textfield',
            'heading'     => esc_html__('Total items', 'citysoul' ),
            'param_name'  => 'pages',
            'value'     => '',
             'admin_label' => true,
            'description'   => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).','citysoul' ),
            'dependency'  => array(
              'element'   => 'option',
              'value'   => array( '','left' ),
            ),
          ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Color border text", "citysoul" ),
                "param_name"    => "colorborder",
                "value"         => '',
                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "bgcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color", "citysoul" ),
                "param_name"    => "linkcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color hover", "citysoul" ),
                "param_name"    => "linkhover",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            //CSS
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
    class WPBakeryShortCode_citysoul_album extends WPBakeryShortCode {}
}

/*
 * Shortcode artist
 * function - citysoul_artist()
 */

if(!class_exists('WPBakeryShortCode_citysoul_artist')) {
	add_action('vc_before_init','citysoul_artist',999999);
	function citysoul_artist(){
		vc_map(array(
			'name'			=>	esc_html__('Artist' ,'citysoul'),
			'base'			=>	'citysoul_artist',
			'weight'		=>	200,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title Heading','citysoul' ),
						'param_name'	=> 	'title_artist_box',
						'value'			=>	'',
						'description'	=> 	esc_html__('This title heading', 'citysoul' )
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title Heading Caption','citysoul' ),
						'param_name'	=> 'title_artist_boxcaption',
						'value'			=>	'',
						'description'	=> 	esc_html__('Title heading caption', 'citysoul' )
					),
					//Data Settings
					array(
                		'type'        	=> 'autocomplete',
                		'heading'     	=> esc_html__( 'Select Artist', 'citysoul' ),
                		'param_name'  	=> 'artist_id',
						'group'			=> esc_html__('Data Settings','citysoul'),
              			'settings'    	=> array(
				                  'multiple' 			=> false,
				                  'sortable' 			=> true,
				                  'max_length' 			=> 1,
				                  'no_hide' 			=> true, // In UI after select doesn't hide an select list
				                  'groups' 				=> true, // In UI show results grouped by groups
				                  'unique_values' 		=> true, // In UI show results except selected. NB! You should manually check values in backend
				                  'display_inline'		=> true, // In UI show results inline view
				                  'values'   			=> citysoul_get_single_post('artist'),
                			),
                		'description' 	=> esc_html__( 'Type title artist to choose', 'citysoul' ),
            		),
            		//Style Settings
            		array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title Heading", "citysoul" ),
		                "param_name"    => "title_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title heading", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title Caption", "citysoul" ),
		                "param_name"    => "title_caption_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title caption", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Name's Artist", "citysoul" ),
		                "param_name"    => "name_artist_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for name's artist ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Genres ", "citysoul" ),
		                "param_name"    => "genres_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for genres", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Description", "citysoul" ),
		                "param_name"    => "description_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for description", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
 					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Active Button", "citysoul" ),
		                "param_name"    => "active_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for active button", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Border Image ", "citysoul" ),
		                "param_name"    => "boderimg_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for border image", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_artist extends WPBakeryShortCode{}
}

/*
 * Shortcode blog list post
 * function - citysoul_blog_list_post()
 */

if (!class_exists('WPBakeryShortCode_citysoul_blog_list_post')) {
    add_action( 'vc_before_init', 'citysoul_blog_list_post', 999999);


    function citysoul_blog_list_post() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('post'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

	    vc_map( array(
	    	"name" => esc_html__( "List Post","citysoul" ),
            "base" => "citysoul_blog_list_post",
            'weight' => 100,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(

            		array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title element', 'citysoul' ),
						'param_name' => 'title_element',
						'value' => '',
						'description' => esc_html__( 'The title of Blog.', 'citysoul' ),
					),
					array(
		              	'type'        => 'autocomplete',
		              	'heading'     => esc_html__( 'Select post show', 'citysoul' ),
		              	'param_name'  => 'list_post_id',
		              	'settings'    => array(
		                	'multiple' => true,
		                	'sortable' => true,
		                	'min_length' => 1,
		                	'no_hide' => true, // In UI after select doesn't hide an select list
		               	 	'groups' => true, // In UI show results grouped by groups
		                	'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
		                	'display_inline' => true, // In UI show results inline view
		                	'values'   => citysoul_get_post_by_postype('post')
		              	),
		              'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
		            ),

		            array(
		              'type' => 'dropdown',
		              'heading' => esc_html__( 'Pages', 'citysoul' ),
		              'param_name' => 'pages',
		              'value' => $citysoul_perpage_arr,
		              'std' => 6,
		              'admin_label' => true,
		              'description' => esc_html__( 'Select columns count.', 'citysoul' ),
		            ),


		            array(
		            	'type' => 'dropdown',
		            	'heading' => esc_html__('Show Readmore/ Pagination', 'citysoul'),
		            	'param_name' => 'option',
		            	'admin_label' => true,
		            	'value' => array(
		            		'Select' => '',
		            		'Show Readmore' => 1,
		            		'Show Pagination' => 2,
		            	),
		            ),
		            // custom color
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Title color", "citysoul" ),
		                "param_name"    => "textcolor",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
		                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
		            ),

		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color border text", "citysoul" ),
		                "param_name"    => "colorborder",
		                "value"         => '',
		                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
		                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
		            ),

		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Background color", "citysoul" ),
		                "param_name"    => "bgcolor",
		                "value"         => '',
		                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
		            ),

		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Link color", "citysoul" ),
		                "param_name"    => "linkcolor",
		                "value"         => '',
		                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
		            ),

		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Link color hover", "citysoul" ),
		                "param_name"    => "linkhover",
		                "value"         => '',
		                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
		            ),

		            //CSS
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
	class WPBakeryShortCode_citysoul_blog_list_post extends WPBakeryShortCode {}
}

/*
 * Shortcode blog post slide
 * function - citysoul_blog_post_slide()
 */

if (!class_exists('WPBakeryShortCode_citysoul_blog_post_slide')) {
    add_action( 'vc_before_init', 'citysoul_blog_post_slide', 999999);


    function citysoul_blog_post_slide() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('post'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

	    vc_map( array(
	    	"name" => esc_html__( "Post Slide","citysoul" ),
            "base" => "citysoul_blog_post_slide",
            'weight' => 105,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(
            	array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title element', 'citysoul' ),
					'param_name' => 'title_element',
					'value' => '',
					'description' => esc_html__( 'The title of Blog.', 'citysoul' ),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__('Number Show', 'citysoul'),
					'param_name' => 'number_show',
					'value' => '',
					'description' => esc_html__('The number slide show', 'citysoul'),
				),
				 array(
	                "type"          => "colorpicker",
	                "class"         => "",
	                "heading"       => esc_html__( "Title color", "citysoul" ),
	                "param_name"    => "textcolor",
	                "value"         => '',
	                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
	                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
	            ),

	            array(
	                "type"          => "colorpicker",
	                "class"         => "",
	                "heading"       => esc_html__( "Color border text", "citysoul" ),
	                "param_name"    => "colorborder",
	                "value"         => '',
	                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
	                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
	            ),

	            array(
	                "type"          => "colorpicker",
	                "class"         => "",
	                "heading"       => esc_html__( "Background color", "citysoul" ),
	                "param_name"    => "bgcolor",
	                "value"         => '',
	                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
	            ),

	            array(
	                "type"          => "colorpicker",
	                "class"         => "",
	                "heading"       => esc_html__( "Link color", "citysoul" ),
	                "param_name"    => "linkcolor",
	                "value"         => '',
	                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
	            ),

	            array(
	                "type"          => "colorpicker",
	                "class"         => "",
	                "heading"       => esc_html__( "Link color hover", "citysoul" ),
	                "param_name"    => "linkhover",
	                "value"         => '',
	                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
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
	class WPBakeryShortCode_citysoul_blog_post_slide extends WPBakeryShortCode {}
}

/*
 * Shortcode card
 * function - citysoul_card()
 */

if (!class_exists('WPBakeryShortCode_citysoul_card')) {
    add_action( 'vc_before_init', 'citysoul_card', 999999);
    function citysoul_card() {

        $contact_id = '';
        if (function_exists('citysoul_get_contact_form')) {
            $contact_id = citysoul_get_contact_form();
        }
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('cards'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

        vc_map( array(
            "name" => esc_html__( "Card","citysoul" ),
            "base" => "citysoul_card",
            'weight' => 200,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(


            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title element', 'citysoul' ),
              'param_name' => 'title_element',
              'value' => '',
              'description' => esc_html__( 'The title of element.', 'citysoul' ),
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Desc element', 'citysoul' ),
              'param_name' => 'desc_element',
              'value' => '',
              'description' => esc_html__( 'The title of element.', 'citysoul' ),
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title Apply', 'citysoul' ),
              'param_name' => 'title_apply',
              'value' => '',
              'description' => esc_html__( 'The title of element.', 'citysoul' ),
            ),

              array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Desc Apply', 'citysoul' ),
              'param_name' => 'desc_apply',
              'value' => '',
              'description' => esc_html__( 'The title of element.', 'citysoul' ),
            ),


            array(
              'type'        => 'autocomplete',
              'heading'     => esc_html__( 'Select card show', 'citysoul' ),
              'param_name'  => 'card_id',
              'settings'    => array(
                'multiple' => true,
                'sortable' => true,
                'min_length' => 1,
                'no_hide' => true, // In UI after select doesn't hide an select list
                'groups' => true, // In UI show results grouped by groups
                'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                'display_inline' => true, // In UI show results inline view
                'values'   => citysoul_get_post_by_postype('cards')
              ),
              'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
            ),

             array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Select form contact form 7', 'citysoul' ),
                'param_name' => 'id_contact_form',
                'value' => $contact_id,
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Color border text", "citysoul" ),
                "param_name"    => "colorborder",
                "value"         => '',
                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "bgcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color", "citysoul" ),
                "param_name"    => "linkcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color hover", "citysoul" ),
                "param_name"    => "linkhover",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            //CSS
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
    class WPBakeryShortCode_citysoul_card extends WPBakeryShortCode {}
}

/*
 * Shortcode contact
 * function - citysoul_contact()
 */

if(!class_exists('WPBakeryShortCode_citysoul_contact')) {
add_action('vc_before_init','citysoul_contact',999999);
	function citysoul_contact(){
		 $contact_id = '';
	      if (function_exists('citysoul_get_contact_form')) {
	         $contact_id = citysoul_get_contact_form();
	      }
		vc_map(array(
			'name'			=>	esc_html__('Contact' ,'citysoul'),
			'base'			=>	'citysoul_contact',
			'weight'		=>	50,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Title contact', 'citysoul' ),
		              'param_name' => 'contact_title',
		              'value' => '',
		              'description' => esc_html__( 'The title of content.', 'citysoul' ),
		            ),
		            array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Description contact', 'citysoul' ),
		              'param_name' => 'contact_description',
		              'value' => '',
		              'description' => esc_html__( 'The description of content only for style left.', 'citysoul' ),
		            ),
		            array(
		              'type' => 'dropdown',
		              'heading' => esc_html__( 'Select form contact form 7', 'citysoul' ),
		              'param_name' => 'id_contact_form',
		              'value' => $contact_id,
		              'admin_label' => true,
		            ),

		            //Custom style for shortcode
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color title form", "citysoul" ),
		                "param_name"    => "title_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color description form", "citysoul" ),
		                "param_name"    => "description_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color border input", "citysoul" ),
		                "param_name"    => "border_input_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color text input", "citysoul" ),
		                "param_name"    => "text_input_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		             array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color border submit", "citysoul" ),
		                "param_name"    => "border_submit_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		             array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color text submit", "citysoul" ),
		                "param_name"    => "text_submit_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
					array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_contact extends WPBakeryShortCode{}
}

/*
 * Shortcode countdown
 * function - citysoul_countdown()
 */

if(!class_exists('WPBakeryShortCode_citysoul_countdown')) {
	add_action('vc_before_init','citysoul_countdown',999999);
	function citysoul_countdown(){
		vc_map(array(
			'name'			=>	esc_html__('Countdown Time' ,'citysoul'),
			'base'			=>	'citysoul_countdown',
			'weight'		=>	60,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=>  'vc_beautheme',
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Time Countdown','citysoul' ),
						'param_name'	=> 'time_countdown',
						'value'			=>	'',
						'admin_label' => true,
						'description'	=> 	esc_html__('This time coutdown like month/day/year ', 'citysoul' )
					),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link Ticket', 'citysoul' ),
                        'param_name' => 'sh_link',
                        'value' => '',
                        'admin_label' => true,
                    ),
					array(
						'type'			=>	'attach_image',
						'heading'		=>	esc_html__('Image Background','citysoul' ),
						'param_name'	=> 	'images',
						'value'			=>	'',
						'description'	=> 	esc_html__('This background imgage', 'citysoul' )
					),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Time heading color ", "citysoul" ),
		                "param_name"    => "time_heading_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for time heading ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Time coutdown color ", "citysoul" ),
		                "param_name"    => "time_countdown_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for time countdown ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Background color ", "citysoul" ),
		                "param_name"    => "time_countdown_bgcolor",
		                "value"         => '',
		                "description"   => esc_html__( "Color for background ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_countdown extends WPBakeryShortCode{}
}

/*
 * Shortcode dj
 * function - citysoul_dj()
 */

if (!class_exists('WPBakeryShortCode_citysoul_dj')) {
    add_action( 'vc_before_init', 'citysoul_dj', 999999);

	function citysoul_get_post_by_postype( $post_type = '' ) {
      $posts = get_posts( array(
        'posts_per_page'  => -1,
        'post_type'     => $post_type,
      ));
      $result = array();
      foreach ( $posts as $post ) {
        $result[] = array(
          'value' => $post->ID,
          'label' => $post->post_title,
        );
      }
      return $result;
    }

    function citysoul_dj() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('artist'));
	    }

	    $citysoul_perpage_arr = array();
        $citysoul_perpage_arr['Select'] = '';
    	    for($i=1; $i<=$count_team; $i++){
    	        $citysoul_perpage_arr[]= $i;
    	    }

        vc_map( array(
            "name" => esc_html__( "List Artist","citysoul" ),
            "base" => "citysoul_dj",
            'weight' => 125,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(
            array(
              'type' => 'dropdown',
              'heading' => esc_html__('Option', 'citysoul'),
              'param_name' => 'option',
              'admin_label' => true,
              'value' => array(
                'Select' => '',
                'Style DJ List' => 'list-dj01',
                'Style DJ Hight list' => 'list-dj02',
                'Style DJ All' => 'list-dj03',
                'Style DJ Slide' => 'list-dj04',

              ),
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title ', 'citysoul' ),
              'param_name' => 'title_element',
              'value' => '',
              'description' => esc_html__( 'The title.', 'citysoul' ),
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Description ', 'citysoul' ),
              'param_name' => 'desc_element',
              'value' => '',
            ),

            //Stype
              array(
                'type'      =>  'dropdown',
                'heading'   =>  esc_html__('Option Data','citysoul' ),
                'param_name'  =>  'option_data',
                'value'     =>  array(
                    'Select...'           =>  '',
                    'In Post ID'          =>  'inpostid',
                    'In Category'         =>  'incategory'
                ),
                'group'     =>  esc_html__('Data Settings','citysoul'),

            ),
          //Data Option
           array(
                'type'          => 'autocomplete',
                'heading'       => esc_html__( 'Select Artist show', 'citysoul' ),
                'param_name'    => 'inpost_id',
                'settings'      => array(
                      'multiple'    => false,
                      'sortable'    => true,
                      'min_length'  => 1,
                      'no_hide'     => true, // In UI after select doesn't hide an select list
                      'groups'    => true, // In UI show results grouped by groups
                      'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                      'display_inline' => true, // In UI show results inline view
                      'values'      => citysoul_get_single_post('artist')
                ),
                'description' => esc_html__( 'Type title single new to choose . Please type two char !', 'citysoul' ),
                'group'     =>  esc_html__('Data Settings','citysoul'),
                'dependency'  => array(
          'element'   => 'option_data',
          'value'   => array( 'inpostid' ),
            ),
                ),
            array(
                    'type'          => 'autocomplete',
                    'heading'       => esc_html__( 'Select category product show', 'citysoul' ),
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
                      'values'          => citysoul_get_list_taxonomy_by_name('genres_artist'),
                    ),
                    'dependency' => array(
                      'element'         => 'option_data',
                       'value'          => array( 'incategory' ),
                    ),

                ),

            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Total items', 'citysoul' ),
                'param_name'    => 'max_items',
                'value'         => '',
                'description'   => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).','citysoul' ),
                'group'         =>  esc_html__('Data Settings','citysoul'),
                'dependency'  => array(
                    'element'   => 'option_data',
                    'value'     => array( 'incategory' ),
                ),
            ),


            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Color border text", "citysoul" ),
                "param_name"    => "colorborder",
                "value"         => '',
                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "bgcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color", "citysoul" ),
                "param_name"    => "linkcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color hover", "citysoul" ),
                "param_name"    => "linkhover",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            //CSS
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
    class WPBakeryShortCode_citysoul_dj extends WPBakeryShortCode {}
}

/*
 * Shortcode event
 * function - citysoul_event()
 */

if(!class_exists('WPBakeryShortCode_citysoul_event')) {
add_action('vc_before_init','citysoul_event',999999);
	function citysoul_event(){
		$category_event_list = '';
	    if (function_exists('citysoul_get_category_by_taxonomy')) {
	        $category_event_list = citysoul_get_category_by_taxonomy('category_event');
	    }
		vc_map(array(
			'name'			=>	esc_html__('List event' ,'citysoul'),
			'base'			=>	'citysoul_event',
			'weight'		=>	200,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
						'type'			=> 	'dropdown',
						'heading'		=>	esc_html__('Option','citysoul' ),
						'param_name'	=>	'option',
						 'admin_label' => true,
						'value'			=>	array(
							esc_html__('Select ...','citysoul') 	=>	'',
							esc_html__('Slide Big','citysoul')	=>	'slide',
							esc_html__('Slide Small','citysoul')	=>	'slidesmall',
							esc_html__('Grid style','citysoul')		=>	'grid',
							esc_html__('List style','citysoul')		=>	'list',
							esc_html__('Calendar event','citysoul')	=>	'calendar',
							// __('Single event','citysoul')	=>	'single'
						),
					),

					array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Title list event', 'citysoul' ),
		              'param_name' => 'list_event_title',
		              'value' => '',
		            ),
		            array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Description list event', 'citysoul' ),
		              'param_name' => 'list_event_description',
		              'value' => '',
		            ),
		            array(
		            	'type'		=> 'dropdown',
		            	'heading'	=> esc_html__('Enable Buy Link', 'citysoul' ),
		            	'param_name'=> 'enable_link',
		            	'value'		=> array(
		            		esc_html__('Select ...', 'citysoul') => '',
		            		esc_html__('Enable', 'citysoul') => 'enable',
		            		esc_html__('Disable', 'citysoul') => 'disable',
		            	),
		            ),
		            array(
		            	'type'			=> 'dropdown',
		            	'heading'		=> esc_html__('Option title', 'citysoul'),
		            	'param_name'	=> 'text_option',
		            	'value'			=> array(
		            		esc_html__('Select ...', 'citysoul') => '',
		            		esc_html__('Text Left', 'citysoul')  => 'left',
		            		esc_html__('Text Center', 'citysoul') => 'center',
		            	),
		            ),
		            array(
		              'type' => 'vc_link',
		              'heading' => esc_html__( 'Link view Calendar', 'citysoul' ),
		              'param_name' => 'list_event_link',
		              'value' => '',
		              'dependency'  => array(
							'element' 	=> 'option',
							'value' 	=> array( 'slidesmall','slide', '' ),
						),
		            ),
		            array(
                		'type'        	=> 'autocomplete',
                		'heading'     	=> esc_html__( 'Select event show', 'citysoul' ),
                		'param_name'  	=> 'event_id',
						'group'			=> esc_html__('Option Settings','citysoul'),
                		'settings'    	=> array(
				                  'multiple' 			=> true,
				                  'sortable' 			=> true,
				                  'min_length' 			=> 1,
				                  'no_hide' 			=> true, // In UI after select doesn't hide an select list
				                  'groups' 				=> true, // In UI show results grouped by groups
				                  'unique_values' 		=> true, // In UI show results except selected. NB! You should manually check values in backend
				                  'display_inline'		=> true, // In UI show results inline view
				                  'values'   			=> citysoul_get_single_post('event')
                			),
                		'description' 	=> esc_html__( 'Type title single event to choose', 'citysoul' ),
                		'group'			=> esc_html__('Data Settings','citysoul'),
            		),

            		array(
		              'type' => 'dropdown',
		              'heading' => esc_html__( 'Category', 'citysoul' ),
		              'param_name' => 'id_category',
		              'value' => $category_event_list,
		              'group'			=> esc_html__('Data Settings','citysoul'),
		            ),

		            array(
						'type' 			=> 'textfield',
						'heading' 		=> esc_html__('Total items', 'citysoul' ),
						'param_name' 	=> 'max_items',
						'value' 		=> '',
						'description' 	=> esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).','citysoul' ),
						'group'			=>	esc_html__('Data Settings','citysoul'),
					),

		            //Custom style for shortcode
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color title", "citysoul" ),
		                "param_name"    => "title_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color description", "citysoul" ),
		                "param_name"    => "description_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color date", "citysoul" ),
		                "param_name"    => "date_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color border event hover", "citysoul" ),
		                "param_name"    => "border_event_hover_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		                'dependency'  => array(
							'element' 	=> 'option',
							'value' 	=> array( 'slide', '' ,'list'),
						),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color title event", "citysoul" ),
		                "param_name"    => "title_event_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color description event", "citysoul" ),
		                "param_name"    => "description_event_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color artist event", "citysoul" ),
		                "param_name"    => "artist_event_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		                'dependency'  => array(
							'element' 	=> 'option',
							'value' 	=> array( 'list', 'grid' ),
						),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color button ticket", "citysoul" ),
		                "param_name"    => "button_ticket_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color icon button ticket", "citysoul" ),
		                "param_name"    => "icon_button_ticket_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Background button ticket", "citysoul" ),
		                "param_name"    => "button_ticket_background",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Background today ticket", "citysoul" ),
		                "param_name"    => "button_today_ticket_background",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', "citysoul" ),
		            ),
					array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_event extends WPBakeryShortCode{}
}
/*
 * Add more option for Visualcomposer icon
 * function - citysoul_icon()
 */

add_action( 'vc_before_init', 'citysoul_icon', 999999);
function citysoul_icon(){
  if(function_exists('vc_add_param')){
    vc_add_param('vc_icon',
    	array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Title icon', 'citysoul' ),
          'param_name' => 'icon_title',
          'value' => '',
          'description' => esc_html__( 'The title of icon.', 'citysoul' ),
          'group'         => esc_html__( 'Title and description', 'citysoul' ),
        )
    );

    vc_add_param('vc_icon',
        array(
          'type' => 'textfield',
          'heading' => esc_html__( 'Description icon', 'citysoul' ),
          'param_name' => 'icon_description',
          'value' => '',
          'description' => esc_html__( 'The description of icon.', 'citysoul' ),
          'group'         => esc_html__( 'Title and description', 'citysoul' ),
        )
    );
  }
}

/*
 * Shortcode list videos
 * function - citysoul_list_videos()
 */

if (!class_exists('WPBakeryShortCode_citysoul_list_videos')) {
    add_action( 'vc_before_init', 'citysoul_list_videos', 999999);

    function citysoul_list_videos() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('videos'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

	    vc_map( array(
			"name" => esc_html__( "List Video","citysoul" ),
			"base" => "citysoul_list_videos",
			'weight' => 95,
			'category' => esc_html__( 'Beau Theme', 'citysoul' ),
			'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
			"params" => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title element', 'citysoul' ),
					'param_name' => 'title_element',
					'value' => '',
					'description' => esc_html__( 'The title of element.', 'citysoul' ),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Desc element', 'citysoul' ),
					'param_name' => 'desc_element',
					'value' => '',
					'description' => esc_html__( 'The title of element.', 'citysoul' ),
				),
				array(
					'type'        => 'autocomplete',
					'heading'     => esc_html__( 'Select video show', 'citysoul' ),
					'param_name'  => 'video_id',
					'settings'    => array(
						'multiple' => true,
						'sortable' => true,
						'min_length' => 1,
						'no_hide' => true, // In UI after select doesn't hide an select list
						'groups' => true, // In UI show results grouped by groups
						'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
						'display_inline' => true, // In UI show results inline view
						'values'   => citysoul_get_post_by_postype('videos')
						),
					'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Total Item', 'citysoul' ),
					'param_name' => 'pages',
					'value' => $citysoul_perpage_arr,
					//'std' => 6,
					'admin_label' => true,
					'description' => esc_html__( 'Select columns count.', 'citysoul' ),
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Remame read more', 'citysoul' ),
					'param_name' => 'rename',
					'value' => '',
					'description' => esc_html__( 'Remame read more.', 'citysoul' ),
				),

				array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Color border text", "citysoul" ),
                "param_name"    => "colorborder",
                "value"         => '',
                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "bgcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color", "citysoul" ),
                "param_name"    => "linkcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color hover", "citysoul" ),
                "param_name"    => "linkhover",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
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
    class WPBakeryShortCode_citysoul_list_videos extends WPBakeryShortCode {}
}

/*
 * Shortcode map
 * function - citysoul_map()
 */

if(!class_exists('WPBakeryShortCode_citysoul_map')) {
add_action('vc_before_init','citysoul_map',999999);
	function citysoul_map(){
		 $contact_id = '';
	      if (function_exists('citysoul_get_contact_form')) {
	         $contact_id = citysoul_get_contact_form();
	      }
		vc_map(array(
			'name'			=>	esc_html__('Google Map' ,'citysoul'),
			'base'			=>	'citysoul_map',
			'weight'		=>	50,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Latitude', 'citysoul' ),
		              'param_name' => 'latitude',
		              'admin_label' => true,
		              'value' => '',
		              'description' => esc_html__( 'You can find your latitude from http://latlong.net', 'citysoul' ),
		            ),
		            array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Longitude', 'citysoul' ),
		              'param_name' => 'longitude',
		              'admin_label' => true,
		              'value' => '',
		              'description' => esc_html__( 'You can find your longitude from http://latlong.net', 'citysoul' ),
		            ),
					array(
						'type'			=>	'attach_image',
						'heading'		=>	esc_html__('Map marker','citysoul' ),
						'param_name'	=> 	'map_maker',
						'value'			=>	'',
                		'description' => esc_html__( 'Select a small image from media library.', 'citysoul' ),
					),
					//Style
		            array(
		              'type' => 'textfield',
		              'heading' => esc_html__( 'Height', 'citysoul' ),
		              'param_name' => 'map_height',
		              'admin_label' => true,
		              'value' => '',
		              'group' => esc_html__( 'Style', 'citysoul' ),
		              'description' => esc_html__( 'Example : 450px ', 'citysoul' ),

		            ),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color for Water , Ocean, Lake ,River", "citysoul" ),
		                "param_name"    => "color_water",
		                "value"         => '',
		                'group' => esc_html__( 'Style', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_map extends WPBakeryShortCode{}
}


/*
 * Shortcode menu
 * function - citysoul_menu()
 */

if (!class_exists('WPBakeryShortCode_citysoul_menu')) {
    add_action( 'vc_before_init', 'citysoul_menu', 999999);

    function citysoul_menu() {

        vc_map( array(
            "name" => esc_html__( "Menu Custom","citysoul" ),
            "base" => "citysoul_menu",
            'weight' => 110,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Option', 'citysoul' ),
                    'param_name' => 'show_cat',
                    'value' => array(
                        'Select' => '...',
                        'Show Menu List' => 'snack',
                        'Show Menu Images' => 'drink'
                    ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title element', 'citysoul' ),
                    'param_name' => 'title_element',
                    'value' => '',
                    'description' => esc_html__( 'The title of element.', 'citysoul' ),
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title description', 'citysoul' ),
                    'param_name' => 'title_desc',
                    'value' => '',
                    'description' => esc_html__( 'The title of element.', 'citysoul' ),
                ),


                array(
                    'type'        => 'autocomplete',
                    'heading'     => esc_html__( 'Select menu show', 'citysoul' ),
                    'param_name'  => 'menu_id',
                    'settings'    => array(
                        'multiple' => true,
                        'sortable' => true,
                        'min_length' => 1,
                        'no_hide' => true, // In UI after select doesn't hide an select list
                        'groups' => true, // In UI show results grouped by groups
                        'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                        'display_inline' => true, // In UI show results inline view
                        'values'   => citysoul_get_post_by_postype('fooddrink')
                        ),
                    'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
                ),

                array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__('Total items', 'citysoul' ),
                        'param_name'    => 'max_items',
                        'value'         => '',
                        'description'   => esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).','citysoul' ),
                    ),

                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'View category', 'citysoul' ),
                    'param_name' => 'view_cat',
                    'value' => citysoul_get_category_by_taxonomy('category_Fooddrink'),
                    'std' => 6,
                    'admin_label' => true,
                    'description' => esc_html__( 'Select columns count.', 'citysoul' ),
                ),

                array(
                    "type"          => "colorpicker",
                    "class"         => "",
                    "heading"       => esc_html__( "Title color", "citysoul" ),
                    "param_name"    => "textcolor",
                    "value"         => '',
                    'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
                ),

                array(
                	'type'			=> 'colorpicker',
                	'class'			=> '',
                	'heading'		=> esc_html__("Description color", 'citysoul'),
                	'param_name'	=> 'desc_color',
                	'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
                ),

        		array(
        			'type'			=> 'colorpicker',
                	'class'			=> '',
                	'heading'		=> esc_html__("Name color", 'citysoul'),
                	'param_name'	=> 'name_color',
                	'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
        		),

        		array(
        			'type'			=> 'colorpicker',
                	'class'			=> '',
                	'heading'		=> esc_html__("Content color", 'citysoul'),
                	'param_name'	=> 'content_color',
                	'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
        		),

        		array(
        			'type'			=> 'colorpicker',
                	'class'			=> '',
                	'heading'		=> esc_html__("Price color", 'citysoul'),
                	'param_name'	=> 'price_color',
                	'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
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
    class WPBakeryShortCode_citysoul_menu extends WPBakeryShortCode {}
}

/*
 * Shortcode news
 * function - citysoul_news()
 */

if(!class_exists('WPBakeryShortCode_citysoul_news')) {
	add_action('vc_before_init','citysoul_news',999999);
	function citysoul_news(){
		vc_map(array(
			'name'			=>	esc_html__('News' ,'citysoul'),
			'base'			=>	'citysoul_news',
			'weight'		=>	200,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
						'type'			=> 	'dropdown',
						'heading'		=>	esc_html__('Option','citysoul' ),
						'param_name'	=>	'option',
						'admin_label' => true,
						'value'			=>	array(
								'Select ...'							=>	'',
								'Normal'								=>	'normal',
								'Hot News'								=>	'hot-news',
								'New3Posts'								=>	'newthreeposts',
							),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title','citysoul' ),
						'param_name'	=> 'title',
						'value'			=>	'',
						'description'	=> 	esc_html__('This title', 'citysoul' )
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Text More','citysoul' ),
						'param_name'	=>	'text_more',
						'value'			=>	'',
						'description'	=>	esc_html__('This text more ','citysoul' )
					),
					array(
						'type'			=>	'vc_link',
						'heading'		=>	esc_html__('Link Text More','citysoul'),
						'param_name'	=>	'link_more',
						'value'			=>	'',
						'description'	=>	esc_html__('This link more','citysoul')
					),
					//Stype
					array(
						'type'			=>	'dropdown',
						'heading'		=>	esc_html__('Option Data','citysoul' ),
						'param_name'	=>	'option_data',
						'value'			=>	array(
								'Select...'						=>	'',
								'In Post ID'					=>	'inpostid',
								'In Category'					=>	'incategory'
						),
					 	'group'		  =>	esc_html__('Data Settings','citysoul'),

					),
					//Data Option
					 array(
		                'type'        	=> 'autocomplete',
		                'heading'     	=> esc_html__( 'Select news show', 'citysoul' ),
		                'param_name'  	=> 'inpost_id',
		                'settings'    	=> array(
			                  	'multiple' 		=> false,
			                  	'sortable' 		=> true,
			                  	'min_length' 	=> 1,
			                  	'no_hide' 		=> true, // In UI after select doesn't hide an select list
			                  	'groups' 		=> true, // In UI show results grouped by groups
			                  	'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
			                  	'display_inline' => true, // In UI show results inline view
			                  	'values'   		=> citysoul_get_single_post('post')
		                ),
		                'description' => esc_html__( 'Type title single new to choose . Please type two char !', 'citysoul' ),
		                'group'		  =>	esc_html__('Data Settings','citysoul'),
		                'dependency'  => array(
							'element' 	=> 'option_data',
							'value' 	=> array( 'inpostid' ),
						),
		            ),
					array(
						'type'			=>	'dropdown',
						'heading'		=>	esc_html__('Catagory','citysoul' ),
						'param_name'	=>	'category',
						'value'			=>	 citysoul_get_category_blog(),
						'group'			=>	esc_html__('Data Settings','citysoul'),
						'dependency'  => array(
							'element' 	=> 'option_data',
							'value' 	=> array( 'incategory' ),
						),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Order by', 'citysoul' ),
						'param_name' 	=> 'orderby',
						'value' 		=> array(
									'Select ...'						=>	'',
							esc_html__( 'Date', 'citysoul' ) 					=> 'date',
							esc_html__( 'Order by post ID', 'citysoul' ) 		=> 'ID',
							esc_html__( 'Random order', 'citysoul' ) 			=> 'rand',
						),
					'description' 		=> esc_html__( 'Select order type. ', 'citysoul' ),
					'group' 			=> esc_html__( 'Data Settings', 'citysoul' ),
					'dependency'  => array(
							'element' 	=> 'option_data',
							'value' 	=> array( 'incategory' ),
						),
					),
					array(
						'type' 			=> 'dropdown',
						'heading' 		=> esc_html__( 'Sort order', 'citysoul' ),
						'param_name' 	=> 'order',
						'group' 		=> esc_html__( 'Data Settings', 'citysoul' ),
						'value' 		=> array(
							   'Select ...'								=>	'',
							esc_html__( 'Descending', 'citysoul' ) 				=> 'DESC',
							esc_html__( 'Ascending', 'citysoul' ) 				=> 'ASC',
						),
						'description' 	=> esc_html__( 'Select sorting order.', 'citysoul' ),
						'dependency'  => array(
							'element' 	=> 'option_data',
							'value' 	=> array( 'incategory' ),
						),
					),
					array(
						'type' 			=> 'textfield',
						'heading' 		=> esc_html__('Total items', 'citysoul' ),
						'param_name' 	=> 'max_items',
						'value' 		=> '',
						'description' 	=> esc_html__( 'Set max limit for items in grid or enter -1 to display all (limited to 1000).','citysoul' ),
						'group'			=>	esc_html__('Data Settings','citysoul'),
						'dependency'  => array(
							'element' 	=> 'option_data',
							'value' 	=> array( 'incategory' ),
						),
					),
					//Style for Title
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title", "citysoul" ),
		                "param_name"    => "title_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					// Style for  link
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Text More", "citysoul" ),
		                "param_name"    => "text_more_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for text more ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Link ", "citysoul" ),
		                "param_name"    => "text_url_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for link  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Link Active ", "citysoul" ),
		                "param_name"    => "text_url_active",
		                "value"         => '',
		                "description"   => esc_html__( "Color for link active ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		                'dependency' 	=> array(
							'element' 	=> 'option',
							'value' 	=> array( 'newthreeposts' ),
						),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Day ", "citysoul" ),
		                "param_name"    => "text_day_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for day  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Date ", "citysoul" ),
		                "param_name"    => "text_date_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for date ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Hot New  ", "citysoul" ),
		                "param_name"    => "text_hotnew_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for text hot new ", "citysoul" ),
		                'dependency' 	=> array(
							'element' 	=> 'option',
							'value' 	=> array( 'hot-news' ),
						),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		             array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Hot New Background ", "citysoul" ),
		                "param_name"    => "bghotnew_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for background hot new ", "citysoul" ),
		                'dependency' 	=> array(
							'element' 	=> 'option',
							'value' 	=> array( 'hot-news' ),
						),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		             array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Background Color ", "citysoul" ),
		                "param_name"    => "news_bg_color",
		                "value"         => '',
		                "description"   => esc_html__( "Background Color ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		             array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_news extends WPBakeryShortCode{}
}


/*
 * Shortcode partner
 * function - citysoul_partner()
 */

if (!class_exists('WPBakeryShortCode_citysoul_partner')) {
    add_action( 'vc_before_init', 'citysoul_partner', 999999);

    function citysoul_partner() {

    $count_post = '';
    if (function_exists('citysoul_number_post')) {
      $count_post = intval(citysoul_number_post('partner'));
    }

    $citysoul_perpage_arr = '';
    for($i=1; $i<=$count_post; $i++){
      $citysoul_perpage_arr[$i] = $i;
    }

    vc_map( array(
          "name" => esc_html__( "List Partner","citysoul" ),
          "base" => "citysoul_partner",
          'weight' => 95,
          'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
          'category' => esc_html__( 'Beau Theme', 'citysoul' ),
          'description' => esc_html__( 'This section allow you show ', 'citysoul' ),
          "params" => array(
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title element', 'citysoul' ),
              'param_name' => 'element_title',
              'value' => '',
              'description' => esc_html__( 'The title of content.', 'citysoul' ),
            ),
            array(
				'type'        => 'autocomplete',
				'heading'     => esc_html__( 'Select partner show', 'citysoul' ),
				'param_name'  => 'partner_id',
				'settings'    => array(
					'multiple' => true,
					'sortable' => true,
					'min_length' => 1,
					'no_hide' => true, // In UI after select doesn't hide an select list
					'groups' => true, // In UI show results grouped by groups
					'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
					'display_inline' => true, // In UI show results inline view
					'values'   => citysoul_get_single_post('partner')
					),
				'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
			),
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Number post show', 'citysoul' ),
              'param_name' => 'number_partner',
              'value' => $citysoul_perpage_arr,
              'std' => 6,
              'admin_label' => true,
              'description' => esc_html__( 'Select columns count.', 'citysoul' ),
            ),

            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Order by', 'citysoul' ),
              'param_name' => 'order_by',
              'value' => array(
                  esc_html__( 'Select...', 'citysoul' )         =>  '',
                  esc_html__( 'Descending', 'citysoul' )        => 'DESC',
                  esc_html__( 'Ascending', 'citysoul' )         => 'ASC',
              ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "colorbackground",
                "value"         => '',
                "description"   => esc_html__( "Background color", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
              'type' => 'css_editor',
              'heading' => esc_html__( 'Css', 'citysoul' ),
              'param_name' => 'css',
              'group' => esc_html__( 'Design options', 'citysoul' ),
            ),

          ),
       )
      );
    }
    class WPBakeryShortCode_citysoul_partner extends WPBakeryShortCode {}
}

/*
 * Shortcode product
 * function - citysoul_product()
 */

if(!class_exists('WPBakeryShortCode_citysoul_product')) {
	add_action('vc_before_init','citysoul_product',999999);
	function citysoul_product(){
		vc_map(array(
			'name'			=>	esc_html__('Product' ,'citysoul'),
			'base'			=>	'citysoul_product',
			'weight'		=>	200,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
						'type'			=> 	'dropdown',
						'heading'		=>	esc_html__('Option','citysoul' ),
						'param_name'	=>	'option',
						'admin_label' => true,
						'value'			=>	array(
								esc_html__('Select ...','citysoul')	=>	'',
								esc_html__('Single Slider','citysoul')	=>	'single',
								esc_html__('Mutil Slider','citysoul')	=>	'mutil'
							),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title Heading','citysoul' ),
						'param_name'	=> 'title_heading',
						'value'			=>	'',
						'description'	=> 	esc_html__('This title heading', 'citysoul' )
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Text Go to Store','citysoul' ),
						'param_name'	=>	'text_store',
						'value'			=>	'',
						'description'	=>	esc_html__('This text for Go to Store ','citysoul' )
					),
					array(
						'type'			=>	'vc_link',
						'heading'		=>	esc_html__('Link Go to Store','citysoul'),
						'param_name'	=>	'link_store',
						'value'			=>	'',
						'description'	=>	esc_html__('This link for Go to Store','citysoul')
					),


					//Data Option
					array(
						'type'			=> 	'dropdown',
						'heading'		=>	esc_html__('Option Data','citysoul' ),
						'param_name'	=>	'option_data',
						'group'			=> esc_html__('Data Settings','citysoul'),
						'value'			=>	array(
								esc_html__('Select ...','citysoul') =>	'',
								esc_html__('InProduct','citysoul')	=>	'inproduct',
								esc_html__('InCategory','citysoul')	=>	'incategory'
							),
					),
					array(
                		'type'        	=> 'autocomplete',
                		'heading'     	=> esc_html__( 'Select product show', 'citysoul' ),
                		'param_name'  	=> 'product_id',
						'group'			=> esc_html__('Data Settings','citysoul'),
						'dependency' => array(
		                  'element' 		=> 'option_data',
		                   'value' 			=> array( 'inproduct' ),
		                ),
                		'settings'    	=> array(
				                  'multiple' 			=> true,
				                  'sortable' 			=> true,
				                  'min_length' 			=> 1,
				                  'no_hide' 			=> true, // In UI after select doesn't hide an select list
				                  'groups' 				=> true, // In UI show results grouped by groups
				                  'unique_values' 		=> true, // In UI show results except selected. NB! You should manually check values in backend
				                  'display_inline'		=> true, // In UI show results inline view
				                  'values'   			=> citysoul_get_single_post('product')
                			),
                		'description' 	=> esc_html__( 'Type title single product to choose', 'citysoul' ),
                		'group'			=> esc_html__('Data Settings','citysoul'),
            		),
            		  array(
		                'type'        	=> 'autocomplete',
		                'heading'     	=> esc_html__( 'Select category product show', 'citysoul' ),
		                'param_name'  	=> 'id_category',
		                'group'			=> esc_html__('Data Settings','citysoul'),
		                'settings'    	=> array(
		                  'multiple' 		=> true,
		                  'sortable' 		=> true,
		                  'min_length' 		=> 1,
		                  'no_hide' 		=> true, // In UI after select doesn't hide an select list
		                  'groups' 			=> true, // In UI show results grouped by groups
		                  'unique_values' 	=> true, // In UI show results except selected. NB! You should manually check values in backend
		                  'display_inline' 	=> true, // In UI show results inline view
		                  'values'   		=> citysoul_get_list_category_product(),
		                ),
		                'dependency' => array(
		                  'element' 		=> 'option_data',
		                   'value' 			=> array( 'incategory' ),
		                ),
		            ),
            		array(
		              	'type' 			=> 'textfield',
		              	'heading' 		=> esc_html__( 'Number product show', 'citysoul' ),
		              	'param_name' 	=> 'per_page',
		              	'value' 		=> '',
		              	'group'			=> esc_html__('Data Settings','citysoul'),
		              	'description' 	=> esc_html__( 'Number product show', 'citysoul' ),
		               	'dependency' 	=> array(
		                  'element' 		=> 'option_data',
		                   'value' 			=> array( 'incategory' ),
		                ),
		            ),
		            array(
						'type'			=> 	'dropdown',
						'heading'		=>	esc_html__('Navigation','citysoul' ),
						'param_name'	=>	'option_nav',
						'group'			=> esc_html__('Style','citysoul'),
						'value'			=>	array(
								esc_html__('Select ...','citysoul') =>	'',
								esc_html__('Enable','citysoul')		=>	'enable',
								esc_html__('Disable','citysoul')	=>	'disable'
							),
						'dependency' 	=> array(
		                  'element' 		=> 'option',
		                   'value' 			=> array( 'mutil' ),
		                ),
					),
					//Style for Title
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title", "citysoul" ),
		                "param_name"    => "title_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					// Style for  link
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Border Item ", "citysoul" ),
		                "param_name"    => "border_color_item",
		                "value"         => '',
		                "description"   => esc_html__( "Color for item border ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title Heading ", "citysoul" ),
		                "param_name"    => "title_heading_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title heading  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Go to Store ", "citysoul" ),
		                "param_name"    => "text_store_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for text go to store  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color title product ", "citysoul" ),
		                "param_name"    => "title_product_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title product", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color info product  ", "citysoul" ),
		                "param_name"    => "text_info_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for infomation product ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Day ", "citysoul" ),
		                "param_name"    => "text_day_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for day  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		                'dependency' 	=> array(
		                  'element' 		=> 'option',
		                   'value' 			=> array( 'single' ),
		                ),
		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Date ", "citysoul" ),
		                "param_name"    => "text_date_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for date ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		                'dependency' 	=> array(
		                  'element' 		=> 'option',
		                   'value' 			=> array( 'single' ),
		                ),
		            ),
		             array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Star ", "citysoul" ),
		                "param_name"    => "text_star_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for star ratting  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),
		                'dependency' 	=> array(
		                  'element' 		=> 'option',
		                   'value' 			=> array( 'mutil' ),
		                ),
		            ),
		               array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Text Price ", "citysoul" ),
		                "param_name"    => "text_price_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for text price  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		             array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color  Background ", "citysoul" ),
		                "param_name"    => "bg_item_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for background  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		             array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_product extends WPBakeryShortCode{}
}


/*
 * Shortcode product schedule list
 * function - citysoul_schedule_list()
 */

if (!class_exists('WPBakeryShortCode_citysoul_schedule_list')) {
    add_action( 'vc_before_init', 'citysoul_schedule_list', 999999);

    function citysoul_schedule_list() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('shedule_list'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

        vc_map( array(
            "name" => esc_html__( "Shedule List","citysoul" ),
            "base" => "citysoul_schedule_list",
            'weight' => 110,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title element', 'citysoul' ),
                    'param_name' => 'title_element',
                    'value' => '',
                    'description' => esc_html__( 'The title of element.', 'citysoul' ),
                ),

                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Title description', 'citysoul' ),
                    'param_name' => 'title_desc',
                    'value' => '',
                    'description' => esc_html__( 'The title of element.', 'citysoul' ),
                ),


                array(
                    'type'        => 'autocomplete',
                    'heading'     => esc_html__( 'Select schedule show', 'citysoul' ),
                    'param_name'  => 'shedule_list_id',
                    'settings'    => array(
                        'multiple' => true,
                        'sortable' => true,
                        'min_length' => 1,
                        'no_hide' => true, // In UI after select doesn't hide an select list
                        'groups' => true, // In UI show results grouped by groups
                        'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                        'display_inline' => true, // In UI show results inline view
                        'values'   => citysoul_get_post_by_postype('shedule_list')
                        ),
                    'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
                ),

                array(
                    "type"          => "colorpicker",
                    "class"         => "",
                    "heading"       => esc_html__( "Title color", "citysoul" ),
                    "param_name"    => "textcolor",
                    "value"         => '',
                    "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                    'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
                ),

                array(
                    "type"          => "colorpicker",
                    "class"         => "",
                    "heading"       => esc_html__( "Color border text", "citysoul" ),
                    "param_name"    => "colorborder",
                    "value"         => '',
                    "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                    'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
                ),

                array(
                    "type"          => "colorpicker",
                    "class"         => "",
                    "heading"       => esc_html__( "Background color", "citysoul" ),
                    "param_name"    => "bgcolor",
                    "value"         => '',
                    'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
                ),

                array(
                    "type"          => "colorpicker",
                    "class"         => "",
                    "heading"       => esc_html__( "Link color", "citysoul" ),
                    "param_name"    => "linkcolor",
                    "value"         => '',
                    'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
                ),

                array(
                    "type"          => "colorpicker",
                    "class"         => "",
                    "heading"       => esc_html__( "Link color hover", "citysoul" ),
                    "param_name"    => "linkhover",
                    "value"         => '',
                    'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
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
    class WPBakeryShortCode_citysoul_schedule_list extends WPBakeryShortCode {}
}

/*
 * Shortcode shortdescription
 * function - citysoul_shortdescription()
 */

if(!class_exists('WPBakeryShortCode_citysoul_shortdescription')) {
	add_action('vc_before_init','citysoul_shortdescription',999999);
	function citysoul_shortdescription(){
		vc_map(array(
			'name'			=>	esc_html__('ShortDescription' ,'citysoul'),
			'base'			=>	'citysoul_shortdescription',
			'weight'		=>	65,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title Heading','citysoul' ),
						'param_name'	=> 'description_title',
						'value'			=>	'',
						'description'	=> 	esc_html__('This title heading', 'citysoul' )
					),
					array(
						'type'			=>	'textarea_html',
						'heading'		=>	esc_html__('Description Content','citysoul' ),
						'param_name'	=> 'content',
						'value'			=>	'',
						'description'	=> 	esc_html__('Description Content', 'citysoul' )
					),

					array(
						'type'			=>	'dropdown',
						'heading'		=>	esc_html__('Option','citysoul' ),
						'param_name'	=> 'description_option',
						'admin_label' => true,
						'value'			=>	array(
							esc_html__('Select...','citysoul')			=>	'',
							esc_html__('No Image','citysoul')			=>	'noimage',
							esc_html__('With Image','citysoul')			=>	'withimage'

							),
						'description'	=> 	esc_html__('Chose option style ', 'citysoul' )
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title Box Description','citysoul' ),
						'param_name'	=> 'description_title_box',
						'value'			=>	'',
						'description'	=> 	esc_html__('Title Box Description', 'citysoul' ),
						'group'			=>	esc_html__('Orther Settings','citysoul'),
						'dependency' 	=> array(
		                  'element' 		=> 'description_option',
		                   'value' 			=> array( 'noimage' ),
		                ),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Title Box Tags','citysoul' ),
						'param_name'	=> 'description_title_tags',
						'value'			=>	'',
						'description'	=> 	esc_html__('Title Box Tags', 'citysoul' ),
						'group'			=>	esc_html__('Orther Settings','citysoul'),

						'dependency' 	=> array(
		                  'element' 		=> 'description_option',
		                   'value' 			=> array( 'noimage' ),
		                ),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Facebook','citysoul' ),
						'param_name'	=> 'description_fb',
						'value'			=>	'',
						'description'	=> 	esc_html__('Facebook Link', 'citysoul' ),
		              	'group' 		=> esc_html__( 'Social options', 'citysoul' ),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('Twitter','citysoul' ),
						'param_name'	=> 'description_tw',
						'value'			=>	'',
						'description'	=> 	esc_html__('Twitter Link', 'citysoul' ),
		              	'group' 		=> esc_html__( 'Social options', 'citysoul' ),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('YouTube','citysoul' ),
						'param_name'	=> 'description_yt',
						'value'			=>	'',
						'description'	=> 	esc_html__('YouTube Link', 'citysoul' ),
		              	'group' 		=> esc_html__( 'Social options', 'citysoul' ),
					),
					array(
						'type'			=>	'textfield',
						'heading'		=>	esc_html__('SoundCloud','citysoul' ),
						'param_name'	=> 'description_sc',
						'value'			=>	'',
						'description'	=> 	esc_html__('SoundCloud Link', 'citysoul' ),
		              	'group' 		=> esc_html__( 'Social options', 'citysoul' ),
					),
					array(
						'type'			=>	'attach_image',
						'heading'		=>	esc_html__('Image Description','citysoul' ),
						'param_name'	=> 	'images',
						'value'			=>	'',
						'dependency' 	=> array(
		                  'element' 		=> 'description_option',
		                   'value' 			=> array( 'withimage' ),
		                ),
						'description'	=> 	esc_html__('This image description', 'citysoul' )
					),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title Heading", "citysoul" ),
		                "param_name"    => "description_title_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title heading ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Description Content", "citysoul" ),
		                "param_name"    => "description_content_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for description content ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title Box Description", "citysoul" ),
		                "param_name"    => "description_title_boxcolor",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title box description  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Title Box Tags", "citysoul" ),
		                "param_name"    => "description_box_tagcolor",
		                "value"         => '',
		                "description"   => esc_html__( "Color for title box tags  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color  Active Button", "citysoul" ),
		                "param_name"    => "description_active_color",
		                "value"         => '',
		                "description"   => esc_html__( "Color for active button  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
 					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color  Background ", "citysoul" ),
		                "param_name"    => "description_bgcolor",
		                "value"         => '',
		                "description"   => esc_html__( "Color for background  ", "citysoul" ),
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
					array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),

				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_shortdescription extends WPBakeryShortCode{}
}

/*
 * Shortcode testimonial
 * function - citysoul_testimonial()
 */

if (!class_exists('WPBakeryShortCode_citysoul_testimonial')) {
    add_action( 'vc_before_init', 'citysoul_testimonial', 999999);



    function citysoul_testimonial() {
    	$count_team = '';
	    if (function_exists('citysoul_number_post')) {
	        $count_team = intval(citysoul_number_post('testimonial'));
	    }

	    $citysoul_perpage_arr = array();
	    for($i=1; $i<=$count_team; $i++){
	        $citysoul_perpage_arr[]= $i;
	    }

        vc_map( array(
            "name" => esc_html__( "Testimonial","citysoul" ),
            "base" => "citysoul_testimonial",
            'weight' => 95,
            'category' => esc_html__( 'Beau Theme', 'citysoul' ),
            'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
            'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
            "params" => array(


            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title element', 'citysoul' ),
                'param_name' => 'title_element',
                'value' => '',
                'description' => esc_html__( 'The title of element.', 'citysoul' ),
            ),

              array(
              'type'        => 'autocomplete',
              'heading'     => esc_html__( 'Select testimonial show', 'citysoul' ),
              'param_name'  => 'album_id',
              'settings'    => array(
                'multiple' => true,
                'sortable' => true,
                'min_length' => 1,
                'no_hide' => true, // In UI after select doesn't hide an select list
                'groups' => true, // In UI show results grouped by groups
                'unique_values' => true, // In UI show results except selected. NB! You should manually check values in backend
                'display_inline' => true, // In UI show results inline view
                'values'   => citysoul_get_post_by_postype('testimonial')
              ),
              'description' => esc_html__( 'Type title post to choose', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Color border text", "citysoul" ),
                "param_name"    => "colorborder",
                "value"         => '',
                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "bgcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color", "citysoul" ),
                "param_name"    => "linkcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color hover", "citysoul" ),
                "param_name"    => "linkhover",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            //CSS
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
    class WPBakeryShortCode_citysoul_testimonial extends WPBakeryShortCode {}
}

/*
 * Shortcode title
 * function - citysoul_title()
 */

if (!class_exists('WPBakeryShortCode_citysoul_title')) {
    add_action( 'vc_before_init', 'citysoul_title', 999999);
    function citysoul_title() {
      $layout_style = array(
        'Select...'           =>'',
        'Title normal'        =>'normal',
        'Title rotate right'  =>'title-right',
        'Title rotate left'   =>'title-left',
      );
      vc_map( array(
          "name" => esc_html__( "Show Title And Description","citysoul" ),
          "base" => "citysoul_title",
          'weight' => 95,
          'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
          'category' => esc_html__( 'Beau Theme', 'citysoul' ),
          'description' => esc_html__( 'This section allow you show title and description', 'citysoul' ),
          "params" => array(
            array(
              'type' => 'dropdown',
              'heading' => esc_html__( 'Option', 'citysoul' ),
              'param_name' => 'option',
              'value' => $layout_style,
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Description element', 'citysoul' ),
              'param_name' => 'element_description',
              'value' => '',
              'description' => esc_html__( 'The description of content only for style left.', 'citysoul' ),
            ),

            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title element', 'citysoul' ),
              'param_name' => 'element_title',
              'value' => '',
              'description' => esc_html__( 'The title of content.', 'citysoul' ),
            ),

            //Custom style for shortcode
            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Description color", "citysoul" ),
                "param_name"    => "descriptioncolor",
                "value"         => '',
                "description"   => esc_html__( "Color for description on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "titlecolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
              'type' => 'css_editor',
              'heading' => esc_html__( 'Css', 'citysoul' ),
              'param_name' => 'css',
              'group' => esc_html__( 'Design options', 'citysoul' ),
            ),
          ),
       )
      );
    }
    class WPBakeryShortCode_citysoul_title extends WPBakeryShortCode {}
}

/*
 * Shortcode twitter
 * function - citysoul_twitter()
 */

if(!class_exists('WPBakeryShortCode_citysoul_twitter')) {
	add_action('vc_before_init','citysoul_twitter',999999);
	function citysoul_twitter(){
		vc_map(array(
			'name'			=>	esc_html__('Twitter' ,'citysoul'),
			'base'			=>	'citysoul_twitter',
			'weight'		=>	55,
			'category'		=>	esc_html__('Beau Theme','citysoul'),
			'icon' 			=> 	get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
			'description'	=>	esc_html__('This section allow you show map', 'citysoul' ),
			'params'		=>	array(

					array(
			            'type' => 'textfield',
			            'heading' => esc_html__( 'Twitter Nick Name', 'citysoul' ),
			            'param_name' => 'twitter_nick',
			            'value' => '',
			            'admin_label' => true,
			        ),
			        array(
			            'type' => 'textfield',
			            'heading' => esc_html__( 'Total Tweet', 'citysoul' ),
			            'param_name' => 'max_items',
			            'value' => '',
			            'admin_label' => true,
			        ),

			        //Style
			        array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Twitter ", "citysoul" ),
		                "param_name"    => "twitter_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Screen Name ", "citysoul" ),
		                "param_name"    => "twitter_screenname_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
			        array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Nick Name", "citysoul" ),
		                "param_name"    => "twitter_nickname_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Time Tweet", "citysoul" ),
		                "param_name"    => "twitter_tweet_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Detail ", "citysoul" ),
		                "param_name"    => "twitter_detail_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
					array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Button Follow ", "citysoul" ),
		                "param_name"    => "twitter_active_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		                "type"          => "colorpicker",
		                "class"         => "",
		                "heading"       => esc_html__( "Color Button Text Follow ", "citysoul" ),
		                "param_name"    => "twitter_follow_color",
		                "value"         => '',
		                'group'         => esc_html__( 'Style', 'citysoul' ),

		            ),
		            array(
		              'type' 			=> 'css_editor',
		              'heading' 		=> esc_html__( 'Css', 'citysoul' ),
		              'param_name' 		=> 'css',
		              'group' 			=> esc_html__( 'Design options', 'citysoul' ),
		            ),
				),
			)
		);
	}
	class WPBakeryShortCode_citysoul_twitter extends WPBakeryShortCode{}
}

/*
 * Shortcode video
 * function - citysoul_video()
 */

if (!class_exists('WPBakeryShortCode_citysoul_video')) {
    add_action( 'vc_before_init', 'citysoul_video', 999999);
    function citysoul_video() {
      vc_map( array(
          "name" => esc_html__( "Video","citysoul" ),
          "base" => "citysoul_video",
          'weight' => 95,
          'category' => esc_html__( 'Beau Theme', 'citysoul' ),
          'icon'      => get_template_directory_uri() . "/inc/vc_custom/vc_icon/beau.png",
          'description' => esc_html__( 'This section allow you show map', 'citysoul' ),
          "params" => array(
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Title element', 'citysoul' ),
              'param_name' => 'title_element',
              'value' => '',
              'admin_label' => true,
              'description' => esc_html__( 'The title of element.', 'citysoul' ),
            ),

            array(
              'type' => 'google_fonts',
              'param_name' => 'google_fonts',
              'value' => '',
              // Not recommended, this will override 'settings'. 'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900 bold italic:900:italic'),
              'settings' => array(
                'fields' => array(
                  // Default font style. Name:weight:style, example: "800 bold regular:800:normal"
                  'font_family_description' => esc_html__( 'Select font family.', 'citysoul' ),
                  'font_style_description' => esc_html__( 'Select font styling.', 'citysoul' ),
                ),
              ),
              'group' => esc_html__( 'Custom fonts', 'citysoul' ),
              'dependency' => array(
                'element' => 'use_theme_fonts',
                'value_not_equal_to' => 'yes',
              ),
            ),

            array(
              'type' => 'vc_link',
              'heading' => esc_html__( 'Link button', 'citysoul' ),
              'param_name' => 'link_button',
              'value' => '',
              'description' => esc_html__( 'Link button of banner.', 'citysoul' ),
            ),
            array(
              'type' => 'attach_image',
              'heading' => esc_html__( 'Images video', 'citysoul' ),
              'param_name' => 'img_video',
              'value' => '',
            ),
            array(
              'type' => 'textfield',
              'heading' => esc_html__( 'Url video youtube or vimeo', 'citysoul' ),
              'param_name' => 'url_video',
              'value' => '',
              'admin_label' => true,
              'description' => esc_html__( 'Ex: https://www.youtube.com/embed/ZCg81dvVM3U or https://player.vimeo.com/video/180222262', 'citysoul' ),
            ),
            array(
              'type' => 'iconpicker',
              'heading' => esc_html__( 'Icon', 'citysoul' ),
              'param_name' => 'icon_openiconic',
              'settings' => array(
                'emptyIcon' => false, // default true, display an "EMPTY" icon?
                'type' => 'openiconic',
                'iconsPerPage' => 200, // default 100, how many icons per/page to display
              ),
              'dependency' => array(
              'element' => 'icon_type',
              'value' => 'openiconic',
              ),
            ),



            //Custom style for shortcode
            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Title color", "citysoul" ),
                "param_name"    => "textcolor",
                "value"         => '',
                "description"   => esc_html__( "Color for title on shortcode", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Color border text", "citysoul" ),
                "param_name"    => "colorborder",
                "value"         => '',
                "description"   => esc_html__( "Color border on the top of text", "citysoul" ),
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Background color", "citysoul" ),
                "param_name"    => "bgcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color", "citysoul" ),
                "param_name"    => "linkcolor",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            array(
                "type"          => "colorpicker",
                "class"         => "",
                "heading"       => esc_html__( "Link color hover", "citysoul" ),
                "param_name"    => "linkhover",
                "value"         => '',
                'group'         => esc_html__( 'Style for shortcode', 'citysoul' ),
            ),

            //Example make css editor for shortcode

            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Css', 'citysoul' ),
                'param_name' => 'css',
                'group' => esc_html__( 'Design options', 'citysoul' ),
            ),

          ),
       )
      );
    }
    class WPBakeryShortCode_citysoul_video extends WPBakeryShortCode {}
}