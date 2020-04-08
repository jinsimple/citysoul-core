<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
    if( !class_exists( 'ReduxFramework' ) ) {
        if (file_exists( WP_PLUGIN_DIR. '/beautheme-citysoul/libs/ReduxCore/framework.php')) {
            if(function_exists('beau_theme_plugin_init')){
                require_once( WP_PLUGIN_DIR. '/beautheme-citysoul/libs/ReduxCore/framework.php' );
            }
        }
    }
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $archive_page = $mailchimp_list  = $custom_footer ="";

    //Columns
    $beau_column = array();
    for($i=1; $i<=6; $i++){
        $beau_column[$i] = $i;
    }

    //Beau perpage
    $beau_perpage = array('-1'=>'Show all');
    for($i=1; $i<=50; $i++){
        $beau_perpage[$i] = $i;
    }

    $contact_id = '';
    if (function_exists('citysoul_get_contact_form_option')) {
        $contact_id = citysoul_get_contact_form_option();
    }

    //Get all page
    $allPage = array();
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'post_type' => 'page',
        'post_status' => 'publish'
    );
    $pages = get_pages($args);
    wp_reset_postdata();
    foreach ($pages as $page) {
        $allPage[$page->post_name] = $page->post_title;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "citysoul_option";


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'citysoul' ),
        'page_title'           => esc_html__( 'Theme Options', 'citysoul' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => esc_url('http://docs.beautheme.com/beautheme/'),
        'title' => esc_html__( 'Documentation','citysoul' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => esc_url('http://support.beautheme.com/'),
        'title' => esc_html__( 'Support Team','citysoul' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/beautheme',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/Beauthemes',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://behance.net/beautheme',
        'title' => 'Find us on behance',
        'icon'  => 'el el-behance'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://dribbble.com/beautheme',
        'title' => 'Find us on dribbble',
        'icon'  => 'el el-dribbble'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        //$args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>','citysoul' ), $v );
    } else {
        //$args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>','citysoul' );
    }

    // Add content after the form.
    $allowed_html_array = array(
        'a' => array(
            'href' => array(),
        ),
        'span' => array(
            'class' => array(),
        )
    );


    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'citysoul' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'citysoul' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'citysoul' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'citysoul' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'citysoul' );
    Redux::setHelpSidebar( $opt_name, $content );



    // -> START General option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Getting Started','citysoul' ),
        'id'               => 'getting-started',
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
          // 'subsection'       => true,
          'fields'           => array(
            array(
                'id' => 'font_awesome_info',
                'type' => 'info',
                'desc'     => '
                    <h3 style="color:#23282d; border-bottom: none;">Welcome to the Options panel of the '.wp_get_theme()->get( 'Name' ).' theme!</h3>
                    <h4 style="color:#23282d; font-size: 1.3em;">What does this mean to you?</h4><br>
                    <p style="">From here on you will be able to regulate the main options of all the elements of the theme. </p>
                    <p style="">Theme documentation you will find in the archive with the theme in the "Documentation" folder. </p>
                    <p style="">Theme documentation online is <a href="#" target="_blank" title="theme documentation">here</a>.</p>
                    <p style="">If you have some questions on the theme, you can send them to our PM on <a href="http://themeforest.net/user/beautheme">Themeforest.net</a>, you can send us email directly to <a href="mailto:support@beautheme.com">support@beautheme.com</a>.</p>',
            ),
        )
    ) );





    // -> START General setting
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General setting','citysoul' ),
        'id'               => 'general',
        'desc'             => esc_html__( 'These are something setting for all page!','citysoul' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
        'fields'           => array(
            array(
                'id'       => 'citysoul-style',
                'type'     => 'select',
                'title'    => esc_html__( 'Change website color', 'citysoul' ),
                'subtitle' => esc_html__( 'Select your color with our style defined.', 'citysoul' ),
                'options'  =>   array(
                                    'default'           => 'Default color',
                                    'broadway'          =>  'Broadway',
                                    'electronic'        => 'Electronic',
                                    'party'             => 'Party',
                                    'rock'              => 'Rock',
                                ),
                'default'  => '',
            ),
            array(
                'id'       => 'citysoul-logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload logo', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),
            array(
                'id'       => 'citysoul-logo-mobile',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload mobile logo', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),
            array(
                'id'       => 'citysoul-logo-fixed',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload fixed header logo', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),
              array(
                'id'       => 'enable-loader-wrapper',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Loader Wrapper ?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-smooth-scroll',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Smooth Scroll?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '0'

            ),
            array(
                'id'       => 'enable-go-top',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable go to top?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-main-nav',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Show main navigation?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'citysoul-image-cover-artis',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload image cover artis', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),
            array(
                'id'       => 'citysoul-image-cover-gallery',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload image cover gallery', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),
            array(
                'id'       => 'citysoul-image-cover-event',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload image cover event', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),
        )
    ) );


    // Your header and footer custom
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header & footer','citysoul' ),
        'id'               => 'headerfooter',
        'customizer_width' => '500px',
        'icon'             => 'el el-magic',
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Custom header','citysoul' ),
        'id'                => 'headerfooter-header',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'enable-fixed',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable header fixed','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'enable-search',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable search on header','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-link-language',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable link language on header','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '0'

            ),

            array(
                'id'       => 'enable-link-social',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable social on header','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '0'
            ),
            array(
                'id'       => 'enable-log-inout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable log in button','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '0'

            ),

            array(
                'id'        => 'header-text-color',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Header text color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '.top-header .top-bar-left','.top-header a', '.top-header'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-text-link-color-hover',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Header text color hover','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '.top-header a:hover'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-bg',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Header background Color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    'header','header .top-header','header .bottom-header'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-sticky-text-color',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Header text color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '.sticker .top-header .top-bar-left','.sticker .top-header a', '.sticker .top-header'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-sticky-text-link-color-hover',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Header text color hover','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '.sticker .top-header a:hover'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-sticky-bg',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Header sticky background Color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '.sticker .top-header','.sticker .bottom-header'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'       => 'phone-header',
                'type'     => 'editor',
                'title'    => esc_html__( 'Phone contact', 'citysoul' ),
                'default'  => '011 4444 7666 / +919971933554',
                'subtitle' => esc_html__( 'Phone number on header','citysoul' ),
            ),
        )
    ) );

    // -> START Custom footer option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Custom footer','citysoul' ),
        'id'                => 'headerfooter-footer',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(

            array(
                'id'        => 'footer-type',
                'type'      => 'image_select',
                'title'     => esc_html__( 'Content layout', 'citysoul' ),
                'options'   => array(
                    'default' => array( 'title' => esc_html__( 'Default', 'citysoul' ),       'img' => get_template_directory_uri().'/asset/images/admin/layout_fa1.png' ),
                    'onecolumn' => array( 'title' => esc_html__( 'One Column', 'citysoul' ),       'img' =>  get_template_directory_uri().'/asset/images/admin/layout_a.png' ),
                ),
                'default'   => 'default',
            ),

            array(
                'id'       => 'footer-widget-number',
                'type'     => 'select',
                 'required' => array(
                    array('footer-type','!=','onecolumn')
                ),
                'title'    => esc_html__( 'Chose footer columns','citysoul' ),
                'subtitle' => esc_html__( 'Chose your custom widget number you want to show','citysoul' ),
                'options'  => $beau_column,
            ),

            array(
                'id'       => 'footer-background-img',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload background footer', 'citysoul' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload any image using the WordPress native uploader', 'citysoul' ),
            ),

            array(
                'id'        => 'footer-text',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Footer Text Color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('footer'),
                'output'   => array(
                    'footer .copyright', 'footer .footer-widget .widget-title',
                ),
                'mode'      => 'color',
            ),
            array(
                'id'        => 'footer-bg',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Footer background Color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                'output'   => array( 'footer' ),
                'mode'      => 'background',
            ),
            array(
                'id'       => 'text-copyright',
                'type'     => 'editor',
                'title'    => esc_html__( 'Your copyright', 'citysoul' ),
                'default'  => 'citysoul. Ltd',
                'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your panel!','citysoul' ),
            ),
        )
    ) );

    // -> START Main menu option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Main menu setting','citysoul' ),
        'id'               => 'main-menu',
        'desc'             => esc_html__( 'These are something setting for main menu!','citysoul' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
        'fields'           => array(
            array(
                'id'       => 'title-menu-text',
                'type'     => 'typography',
                'title'    => esc_html__( 'Title menu typography','citysoul' ),
                // 'compiler' => array('body *'),
                'output' => array(
                    '.bottom-header .navigator .main-menu ul li','.bottom-header .navigator .main-menu ul li a',
                ),
                'subtitle' => esc_html__( 'Specify the body font properties.','citysoul' ),
                'google'   => true,
            ),

            array(
                'id'        => 'title-menu-text-hover',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Title menu hover color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('#main-navigation .menu-item .sub-menu .menu-item', '#main-navigation .menu-item .sub-menu .menu-item:hover', '#main-navigation .menu-item .sub-menu.current-menu-item'),
                'output' => array(
                    '.bottom-header .navigator .main-menu ul li a:hover',
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'main-navigation-sub-color',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Menu dropdowns BG Color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('#main-navigation .menu-item .sub-menu .menu-item', '#main-navigation .menu-item .sub-menu .menu-item:hover', '#main-navigation .menu-item .sub-menu.current-menu-item'),
                'output' => array(
                    '.navigator .main-menu li .children', '.navigator .main-menu li .children li'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'       => 'title-submenu-text',
                'type'     => 'typography',
                'title'    => esc_html__( 'Title submenu typography','citysoul' ),
                // 'compiler' => array('body *'),
                'output' => array(
                    '.navigator .main-menu li .children li a'
                ),
                'subtitle' => esc_html__( 'Specify the body font properties.','citysoul' ),
                'header .position-menu .main-menu ul li.menu-item-has-children .sub-menu li',
                'google'   => true,
            ),

            array(
                'id'        => 'title-submenu-text-hover',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Title submenu hover color','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('#main-navigation .menu-item .sub-menu .menu-item', '#main-navigation .menu-item .sub-menu .menu-item:hover', '#main-navigation .menu-item .sub-menu.current-menu-item'),
                'output' => array(
                    '.navigator .main-menu li .children li a:hover', '.navigator .main-menu li .children li:hover > a'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'main-navigation-sub-color-hover',
                'type'      => 'color_rgba',
                'title'     => esc_html__( 'Menu dropdowns BG Color hover','citysoul' ),
                'subtitle'  => esc_html__( 'Gives you the RGBA color.','citysoul' ),
                // 'compiler' => array('#main-navigation .menu-item .sub-menu .menu-item', '#main-navigation .menu-item .sub-menu .menu-item:hover', '#main-navigation .menu-item .sub-menu.current-menu-item'),
                'output' => array(
                    '.navigator .main-menu li .children li a:hover', '.navigator .main-menu li .children li:hover > a'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),
        )
    ) );

    // -> START Styling option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Styling options','citysoul' ),
        'id'               => 'styling',
        'desc'             => esc_html__( 'These are something setting for Styling options!','citysoul' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
        'fields'            => array(
            array(
                'id'       => 'background-body',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background body color','citysoul' ),
                'output'   => array('body'),
                'mode'      => 'background',
                'subtitle' => esc_html__( 'Specify the body color.','citysoul' ),
                'google'   => true,
                'default'   => 'f7f7f7',
            ),
        )
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Theme style setting','citysoul' ),
        'id'                => 'theme-color',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'text-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Text body setting','citysoul' ),
                // 'compiler' => array('body *'),
                'output'   => array('body'),
                'subtitle' => esc_html__( 'Specify the body font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'link-body-full',
                'type'     => 'typography',
                'title'    => esc_html__( 'Link body setting','citysoul' ),
                // 'compiler' => array('body *'),
                'output'   => array('a'),
                'subtitle' => esc_html__( 'Specify the body font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'link-body-full-hover',
                'type'     => 'typography',
                'title'    => esc_html__( 'Link body hover setting','citysoul' ),
                // 'compiler' => array('body *'),
                'output'   => array('a:hover'),
                'subtitle' => esc_html__( 'Specify the body font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'title-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Title body color','citysoul' ),
                // 'compiler' => array('body *'),
                'output'   => array('.citysoul-title'),
                'subtitle' => esc_html__( 'Specify the body font properties.','citysoul' ),
                'google'   => true,
            ),
        )
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Button color','citysoul' ),
        'id'                => 'button-color',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'text-button',
                'type'     => 'typography',
                'title'    => esc_html__( 'Text button color','citysoul' ),
                // 'compiler' => array('button *'),
                'output'   => array('.citysoul-button-o'),
                'subtitle' => esc_html__( 'Specify the button font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'text-button-hover',
                'type'     => 'typography',
                'title'    => esc_html__( 'Text button color hover','citysoul' ),
                // 'compiler' => array('button *'),
                'output'   => array('.citysoul-button-o:hover'),
                'subtitle' => esc_html__( 'Specify the button font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'background-button',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background button color','citysoul' ),
                // 'compiler' => array('button *'),
                'output'   => array('.citysoul-button-o'),
                'mode'      => 'background',
                'google'   => true,
            ),
            array(
                'id'       => 'background-button-hover',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background button color hover','citysoul' ),
                // 'compiler' => array('button *'),
                'output'   => array('.citysoul-button-o:hover'),
                'mode'      => 'background',
                'google'   => true,
            ),
            array(
                'id'       => 'border-button',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Border button color','citysoul' ),
                // 'compiler' => array('button *'),
                'output'   => array('.citysoul-button-o'),
                'google'   => true,
            ),
            array(
                'id'       => 'border-button-hover',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Border button color hover','citysoul' ),
                // 'compiler' => array('button *'),
                'output'   => array('.citysoul-button-o:hover'),
                'google'   => true,
            ),
        )
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Sidebar color','citysoul' ),
        'id'                => 'sidebar-color',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'text-sidebar',
                'type'     => 'typography',
                'title'    => esc_html__( 'Text sidebar color','citysoul' ),
                // 'compiler' => array('sidebar *'),
                'output'   => array('.citysoul-sidebar'),
                'subtitle' => esc_html__( 'Specify the sidebar font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'link-sidebar',
                'type'     => 'typography',
                'title'    => esc_html__( 'Link sidebar color','citysoul' ),
                // 'compiler' => array('sidebar *'),
                'output'   => array('.citysoul-sidebar a'),
                'subtitle' => esc_html__( 'Specify the sidebar font properties.','citysoul' ),
                'google'   => true,
            ),
            array(
                'id'       => 'background-sidebar',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Background sidebar color','citysoul' ),
                // 'compiler' => array('sidebar *'),
                'output'   => array('.citysoul-sidebar'),
                'mode'      => 'background',
                'google'   => true,
            ),
        )
    ) );

    // Your Typo setting
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography setting','citysoul' ),
        'id'               => 'typography',
        'customizer_width' => '500px',
        'icon'             => 'el el-font',
        'fields'           => array(
            array(
                'id'       => 'h1-element',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1 element','citysoul' ),
                'subtitle' => esc_html__( 'Specify the h1 font properties.','citysoul' ),
                'output'    => array('h1'),
                // 'compiler' => array('h1'),
                'google'   => true,
            ),
            array(
                'id'       => 'h2-element',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2 element','citysoul' ),
                'subtitle' => esc_html__( 'Specify the h2 font properties.','citysoul' ),
                'compiler' => array('h2'),
                'output' => array('h2'),
                'google'   => true,
            ),
            array(
                'id'       => 'h3-element',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3 element','citysoul' ),
                'subtitle' => esc_html__( 'Specify the h3 font properties.','citysoul' ),
                // 'compiler' => array('h3'),
                'output' => array('h3'),
                'google'   => true,
            ),
            array(
                'id'       => 'h4-element',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4 element','citysoul' ),
                'subtitle' => esc_html__( 'Specify the h4 font properties.','citysoul' ),
                // 'compiler' => array('h4'),
                'output'   => array('h4'),
                'google'   => true,
            ),
            array(
                'id'       => 'h5-element',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5 element','citysoul' ),
                'subtitle' => esc_html__( 'Specify the h5 font properties.','citysoul' ),
                // 'compiler' => array('h5'),
                'output'   => array('h5'),
                'google'   => true,
            ),
            array(
                'id'       => 'h6-element',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6 element','citysoul' ),
                'subtitle' => esc_html__( 'Specify the h6 font properties.','citysoul' ),
                // 'compiler' => array('h6'),
                'output' => array('h6'),
                'google'   => true,
            ),
        )
    ) );

    // -> START Blog option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog options','citysoul' ),
        'id'               => 'blog',
        'desc'             => esc_html__( 'These are something setting for Styling options!','citysoul' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Blog archive option','citysoul' ),
        'id'                => 'blog-archive',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'enable-date-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable date time?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-title-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable title?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-excerpt-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable excerpt?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'
            ),

            array(
                'id'       => 'enable-tags-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable tags?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-category-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable category time?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-readmore-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable readmore?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-thumbnail-archive-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable thumbnail?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
        )
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Blog single option','citysoul' ),
        'id'                => 'blog-single',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'enable-breadcrumb-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable breadcrumb?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-cover-image-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable cover image?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-title-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable title?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),


            array(
                'id'       => 'enable-date-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable datetime post?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-author-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable author?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-number-comment-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable number comment?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-tags-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable tags?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),

            array(
                'id'       => 'enable-social-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable social?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-next-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable next post?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
            array(
                'id'       => 'enable-profile-author-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable profile author?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'enable-comment-single-blog',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable comment?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'
            ),
        )
    ) );


    //Social setting
    // -> START social option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social setting','citysoul' ),
        'id'               => 'social',
        'customizer_width' => '500px',
        'icon'             => 'el el-thumbs-up',
        'fields'           => array(
            array(
                'id'       => 'beau-facebook',
                'type'     => 'text',
                'title'    => esc_html__( 'Your facebook url','citysoul' ),
            ),
            array(
                'id'       => 'beau-twitter',
                'type'     => 'text',
                'title'    => esc_html__( 'Your twitter url','citysoul' ),
            ),
            array(
                'id'       => 'beau-google-plus',
                'type'     => 'text',
                'title'    => esc_html__( 'Your google plus url','citysoul' ),
            ),
            array(
                'id'       => 'beau-youtube',
                'type'     => 'text',
                'title'    => esc_html__( 'Your youtube url','citysoul' ),
            ),
            array(
                'id'       => 'beau-pinterest',
                'type'     => 'text',
                'title'    => esc_html__( 'Your pinterest url','citysoul' ),
            ),
            array(
                'id'       => 'beau-linkedin',
                'type'     => 'text',
                'title'    => esc_html__( 'Your linkedin url','citysoul' ),
            ),
            array(
                'id'       => 'beau-instagram',
                'type'     => 'text',
                'title'    => esc_html__( 'Your instagram url','citysoul' ),
            ),
            array(
                'id'       => 'beau-behance',
                'type'     => 'text',
                'title'    => esc_html__( 'Your behance url','citysoul' ),
            ),
            array(
                'id'       => 'beau-soundcloud',
                'type'     => 'text',
                'title'    => esc_html__( 'Your soundcloud url','citysoul' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Config','citysoul' ),
        'id'               => 'social-link-show',
        'subsection'       => true,
        'icon'             => 'el el-cogs',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'show-social-link-header',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__( 'Social to show in Header','citysoul' ),
                'subtitle' => esc_html__( 'Select your social link you want to show','citysoul' ),
                'desc'     => esc_html__( 'Chose your social you want to show in your website.','citysoul' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'facebook'      => 'Facebook',
                    'twitter'       => 'Twitter',
                    'google-plus'   => 'Google Plus',
                    'youtube'       => 'Youtube',
                    'pinterest'     => 'Pinterest',
                    'linkedin'      => 'Linked in',
                    'instagram'     => 'Instagram',
                    'behance'       => 'Behance',
                    'soundcloud'    => 'Sound cloud',
                ),
                'default'  => array( 'facebook', 'twitter','google-plus' )
            ),
            array(
                'id'       => 'show-social-link-footer',
                'type'     => 'select',
                'multi'    => true,
                'title'    => esc_html__( 'Social to show in Footer','citysoul' ),
                'subtitle' => esc_html__( 'Select your social link you want to show','citysoul' ),
                'desc'     => esc_html__( 'Chose your social you want to show in your website.','citysoul' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'facebook'      => 'Facebook',
                    'twitter'       => 'Twitter',
                    'google-plus'   => 'Google Plus',
                    'youtube'       => 'Youtube',
                    'pinterest'     => 'Pinterest',
                    'linkedin'      => 'Linked in',
                    'instagram'     => 'Instagram',
                    'behance'       => 'Behance',
                    'soundcloud'    => 'Sound cloud',
                ),
                'default'  => array( 'facebook', 'twitter','google-plus' )
            ),
            array(
                'id'       => 'mailchimp-api',
                'type'     => 'text',
                'title'    => esc_html__( 'Your mailchimp API', 'citysoul' ),
                'subtitle' => esc_html__( 'Grab an API Key from http://admin.mailchimp.com/account/api/', 'citysoul' ),
            ),

             array(
                'id'        => 'mailchimp-groupid',
                'type'      => 'text',
                'title'     => esc_html__( 'Your group id', 'citysoul' ),
                'subtitle'  => esc_html__( 'Grab your List\'s Unique Id by going http://admin.mailchimp.com/lists/<br> Click the "settings" link for the list - the Unique Id is at the bottom of that page.', 'citysoul' ),
            ),

        )
    ) );



    // -> START Advanced option
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Advanced options','citysoul' ),
        'id'               => 'advanced',
        'desc'             => esc_html__( 'These are something setting for Styling options!','citysoul' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
        'fields'           => array(
            array(
                'id'       => 'enable-responsive',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable responsive?','citysoul' ),
                'options'  => array(
                    '1'    => 'Yes',
                    '0'    => 'No',
                ),
                'default'  => '1'

            ),
        )
    ) );