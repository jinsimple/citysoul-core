<?php
define('CITY_BASE_URL', get_template_directory_uri());
define('CITY_BASE', get_parent_theme_file_path());
define('CITY_IMAGES', CITY_BASE_URL . '/asset/images');
define('CITY_JS', CITY_BASE_URL . '/asset/js');
define('CITY_CSS', CITY_BASE_URL . '/asset/css');
define('CITY_PLUGINS_PATH', esc_url('http://plugins.beautheme.com'));
define('CITY_PLUGINS_PATH_REQUIRE', CITY_BASE.'/includes/');
define('CITY_PLUGINS_PATH_LIBS', CITY_BASE.'/libs/');
define('CITY_PLUGIN_URL',untrailingslashit( plugins_url( '/') ));


//For multiple language
$language_folder = CITY_BASE .'/language';
load_theme_textdomain( 'citysoul', $language_folder );

require_once(get_parent_theme_file_path().'/core/includes/functions.php');

require_once(get_parent_theme_file_path().'/ajax_controller.php');

/**
 * Includes tgm plugin
 */
citysoul_get_template('inc/plugins/tgm/class-tgm-plugin-activation');
citysoul_get_template('inc/plugins/tgm/tgm-register-plugin');


if ( ! isset( $content_width ) ) $content_width = 900;
///Beautheme support


/*
 * Funcion citysoul_check_option_theme item
 * $option - string
 */


function citysoul_check_option_theme( $option = ''){
    global $citysoul_option;
    if((is_page() == true ) && citysoul_check_shop_page() != true) {
        $q = get_queried_object();
        $get_page_option_custom_field = citysoul_get_field($option,$q->ID);
    } else {
        $get_page_option_custom_field = citysoul_get_field($option);
    }
    $option_check = '';
    if (isset($citysoul_option[$option])) {
        $option_check =  $citysoul_option[$option];
    }
    $setting = '';
    if ($option_check != NULL) {
        $setting = $option_check;
    }
    if ($get_page_option_custom_field != NULL) {
        $setting = $get_page_option_custom_field;
    }
    return $setting;
}
/*
 * Funcion citysoul_GetOption item
 * $option - string
 */


function citysoul_GetOption($option){
    global $citysoul_option;
    if (isset($citysoul_option[$option])) {
        $option =  $citysoul_option[$option];
    }else{
        $option = NULL;
    }
    return $option;
}

// Add theme support for this theme
function citysoul_theme_support() {

    add_theme_support( "excerpt", array( "post" ) );
    add_theme_support( "automatic-feed-links" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "automatic-feed-links" );
    add_theme_support( 'title-tag' );
    add_theme_support( "custom-header", array());
    add_theme_support( "custom-background", array()) ;
    add_editor_style();

    // Theme support with nav menu
    add_theme_support( "nav-menus" );
    $nav_menus['main-menu'] = esc_html__( 'Main menu', 'citysoul');
    register_nav_menus( $nav_menus );
}
add_action( 'after_setup_theme', 'citysoul_theme_support' );


/**
 * Register fonts
 */
if ( ! function_exists( 'citysoul_fonts_url' ) ) :
function citysoul_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    /*
     * Translators: If there are characters in your language that are not supported
     * by Oswald, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'citysoul' ) ) {
        $fonts[] = 'Oswald:400,700,300';
    }

    /*
     * Translators: If there are characters in your language that are not supported
     * by Arapey, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Arapey font: on or off', 'citysoul' ) ) {
        $fonts[] = 'Arapey:400italic';
    }
    if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'citysoul' ) ) {
        $fonts[] = 'Roboto+Condensed:300i,700';
    }

    /*
     * Translators: If there are characters in your language that are not supported
     * by Arapey, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Arimo font: on or off', 'citysoul' ) ) {
        $fonts[] = 'Arimo:400,400italic,700';
    }

    /*
     * Translators: To add an additional character subset specific to your language,
     * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'citysoul' );

    if ( 'cyrillic' == $subset ) {
        $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ( 'greek' == $subset ) {
        $subsets .= ',greek,greek-ext';
    } elseif ( 'devanagari' == $subset ) {
        $subsets .= ',devanagari';
    } elseif ( 'vietnamese' == $subset ) {
        $subsets .= ',vietnamese';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
}
endif;

/**
 * Register scripts
 */
function citysoul_scripts(){
    // Lib jquery
    if (!is_admin()) {
        wp_enqueue_style( 'citysoul-fonts', citysoul_fonts_url(), array(), null );


        if (!is_404()) {

            //Css calendar
            //Js calendar
            wp_enqueue_script('modernizr', CITY_JS .'/modernizr.custom.js', array('jquery'), '2.7.1', FALSE);
            wp_enqueue_script('menu', CITY_JS .'/menu.js', array('jquery'), '1.0.0', TRUE);
            wp_enqueue_script('mobile-menu', CITY_JS .'/classie.js', array('jquery'), '1.0.0', TRUE);
            wp_enqueue_script('idangerous', CITY_JS .'/swiper.min.js', array('jquery'), '3.2.0', FALSE);
            wp_enqueue_script('bootstrap',  CITY_JS .'/bootstrap.min.js', array('jquery'), '3.3.1', FALSE);
            wp_enqueue_script('masonry-pkgd',  CITY_JS .'/masonry.pkgd.min.js', array('jquery'), '4.1.1', FALSE);
            wp_enqueue_script('lazyload', CITY_JS .'/jquery.lazyload.min.js', array('jquery'), '1.9.7', FALSE);
            wp_enqueue_script('wow', CITY_JS .'/wow.min.js', array('jquery'), '1.1.3', TRUE);
            wp_enqueue_script('countdown', CITY_JS .'/jquery.countdown.min.js', array('jquery'), '1.1.0', FALSE);

            //Js calendar
            wp_enqueue_script('moment-calendar', CITY_JS .'/moment.min.js', array('jquery'), '2.17.1', FALSE);
            wp_enqueue_script('fullcalendar', CITY_JS .'/fullcalendar.min.js', array('jquery'), '3.0.1', FALSE);
            wp_enqueue_script('locale-all', CITY_JS .'/locale-all.js', array('jquery'), '3.0.1', FALSE);
            wp_enqueue_script('selectbox', CITY_JS .'/jquery.selectbox-0.2.min.js', array('jquery'), '0.2', FALSE);
            wp_enqueue_script('jplayer', CITY_JS .'/jquery.jplayer.js', array('jquery'), '3.2.0', FALSE);
            wp_enqueue_script('jplayer.playlist', CITY_JS .'/jplayer.playlist.min.js', array('jquery'), '3.2.0', FALSE);
            //check menu fix
            if (citysoul_check_option_theme('enable-fixed') == '1') {
                wp_enqueue_script('menufix',  CITY_JS .'/sticker-menu.js', array('jquery'), '1.0.0', TRUE);
            }

            //js scroll
            if (citysoul_check_option_theme('enable-smooth-scroll') == '1') {
                wp_enqueue_script('TweenMax', CITY_JS .'/TweenMax.min.js', array('jquery'), '1.0.0', TRUE);
                wp_enqueue_script('ScrollToPlugin', CITY_JS .'/ScrollToPlugin.min.js', array('jquery'), '1.0.0', TRUE);
                wp_enqueue_script('smoth-scroll', CITY_JS .'/smoth-scroll.js', array('jquery'), '1.0.0', TRUE);
            }
            //js site
            wp_enqueue_script('citysoul-app', CITY_JS .'/citysoul.js', array('jquery'), '1.0.1', TRUE);


            wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/asset/css/font-awesome.min.css', array(), '4.2.0', 'all' );
            wp_enqueue_style('idangerous', CITY_CSS .'/swiper.min.css', array(), '1.0.0');
            wp_enqueue_style('animate', CITY_CSS .'/animate.css', array(), '3.3.1');
            wp_enqueue_style('normalize', CITY_CSS .'/normalize.css', array(), '4.2.0');

        }

        wp_enqueue_style('bootstrap', CITY_CSS .'/bootstrap.css', array(), '3.3.1');
        wp_enqueue_style('jquery-ui', CITY_CSS .'/jquery-ui.min.css', array(), '1.12.1');

        wp_enqueue_style('citysoul-editstyle', CITY_CSS .'/citysoul.css', array(), '1.0.0');
        if (citysoul_check_option_theme('citysoul-style') == 'electronic') {
            wp_enqueue_style('electronic-style', CITY_CSS .'/electronic.css', array(), '1.0.0');
        }
        if (citysoul_check_option_theme('citysoul-style') == 'party') {
            wp_enqueue_style('party-style', CITY_CSS .'/party.css', array(), '1.0.0');
        }
        if (citysoul_check_option_theme('citysoul-style') == 'rock') {
            wp_enqueue_style('rock-style', CITY_CSS .'/rock.css', array(), '1.0.0');
        }
        if (citysoul_check_option_theme('citysoul-style') == 'broadway') {
            wp_enqueue_style('rock-style', CITY_CSS .'/broadway.css', array(), '1.0.0');
        }
        wp_enqueue_style('fullcalendar', CITY_CSS .'/fullcalendar.min.css', array(), '3.0.1');
        // wp_enqueue_style('fullcalendar-print', CITY_CSS .'/fullcalendar.print.css', array(), '3.0.1');
        wp_enqueue_style('citysoul-style',CITY_BASE_URL .'/style.css', array(), '1.0.0');


    }
}
add_action( 'wp_enqueue_scripts', 'citysoul_scripts' );

/**
 * Register nav menus
 */
register_nav_menus(array(
    'main-menu'     => esc_html__('Main menu', 'citysoul'),
    'mobile-menu'    => esc_html__('Mobile Menu', 'citysoul'),
));

/**
 * Register WIDGETS
 *
 */
function citysoul_register_sidebar() {

    $col = $sidebarWidgets = "";

    //Register sidebar for sidebar widget
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar widget','citysoul'),
            'id'            => 'sidebar-widget',
            'description'   => esc_html__('Sidebar widget position.','citysoul'),
            'before_widget' => '<div id="%1$s" class="sidebar-widget widget-sidebar">',
            'after_widget'  => '</div>',
            // 'before_title'  => '<div class="title-sidebar-widget widget-title text-title text-2x text-active">',
            // 'after_title'   => '</div>'
        )
    );
    register_sidebar(
            array(  // 1
                'name' => esc_html__( 'Footer OneColumn', 'citysoul' ),
                'id' => 'sidebar-footer-onecolumn',
                'before_widget' => '<div class="footer-column col-md-12 col-sm-12 col-xs-12"><div class="footer-widget">',
                'after_widget' => '</div></div></div>',
                'before_title' => '<div class="title-widget text-16x citysoul-title  text-title citysoul-title-20"><span>',
                'after_title' => '</span></div><div class="content-widget">'
            )
        );
    //Register to show sidebar on footer
    if (citysoul_GetOption('footer-widget-number')!= NULL) {
        $col    = intval(citysoul_GetOption('footer-widget-number'));
    }
    if($col==0){
        $col  = 3;
    }
    $columns = intval(12/$col);
    if($columns==1){
        register_sidebar(
            array(  // 1
                'name' => esc_html__( 'Footer sidebar', 'citysoul' ),
                'description' => esc_html__( 'This is footer sidebar ', 'citysoul' ),
                'id' => 'sidebar-footer-1',
                'before_widget' => '<div class="footer-column col-md-12 col-sm-12 col-xs-12"><div class="footer-widget">',
                'after_widget' => '</div></div></div>',
                'before_title' => '<div class="title-widget text-16x citysoul-title  text-title citysoul-title-20"><span>',
                'after_title' => '</span></div><div class="content-widget">'
            )
        );
    }else{
        for ($i=1; $i <= $col; $i++) {
            register_sidebar(
                array(
                    'name' => 'Footer sidebar '.$i,
                    'id' => 'sidebar-footer-'.$i,

                    'before_title' => '<div class="title-widget text-16x citysoul-title  text-title citysoul-title-20"><span>',
                    'after_title' => '</span></div><div class="content-widget">'
                )
            );
        }
    }
}
add_action( 'widgets_init', 'citysoul_register_sidebar' );

//Support Woocommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Show menu by theme location
 *
 */
if ( ! function_exists( 'citysoul_main_menu' ) ) {
  function citysoul_main_menu( $slug ) {
    $menu = array(
      'theme_location' => $slug,
      'menu_class'    => 'main-menu',
      'menu_id'       => '',
      'container' => 'nav',
      'container_class' => $slug,
    );
    wp_nav_menu( $menu );
  }
}

/**
 * Get Single Post by Post Type
 * @param  string $post_type
 * @return  array
 */
function citysoul_get_single_post( $post_type = '' ) {
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

/**
*  Rewrite of "get_the_post_thumbnail" for compatibility with jQuery LazyLoad plugin
*
* @param boolean $post_id
* @param string $size
* @return string
*/
function citysoul_get_the_post_lazyload_thumbnail( $post_id = false, $size = 'full' ) {
    if ( $post_id ) {
        // Get the id of the attachment
        $attachment_id = get_post_thumbnail_id( $post_id );
        if ( $attachment_id ) {
            $src = wp_get_attachment_image_src( $attachment_id, $size );
            if ($src) {
                $img = get_the_post_thumbnail( $post_id, $size, array(
                    'class' => 'lazy',
                    'data-original' => $src[0],
                    'src' => get_stylesheet_directory_uri() . '/asset/images/loading_icon.gif'
                ) );
                return $img; // returns image tag string or '' (empty string)
            }
        }
    }
    return false; // missing either: post_id, attachment_id, or src
}

/**
*  Short logo
*
* @param string $logoTYpe
* @return string
*/
add_action('citysoul_main_logo','citysoul_main_logo');
function citysoul_main_logo($logoTYpe='main_logo'){
    $store_logo = $themeOptionLogo = $enable_customLogo = $store_logo = '';
    switch ($logoTYpe) {
        case 'main_logo':
            $themeOptionLogo = 'citysoul-logo';
            break;
        case 'header_fixed_logo':
            $themeOptionLogo = 'citysoul-logo-fixed';
            break;
            case 'main_logo':
            $themeOptionLogo = 'main_logo';
            break;
        case 'mobile_logo':
            $themeOptionLogo = 'citysoul-logo-mobile';
            break;

        default:
            $themeOptionLogo = 'citysoul-logo';
            break;
    }
    if (citysoul_GetOption($themeOptionLogo)!= NULL) {
        $store_logo_img = citysoul_GetOption($themeOptionLogo);
        $store_logo = $store_logo_img['url'];
    }
    if (function_exists('get_field')) {
        $enable_customLogo = get_field('main_logo', get_the_ID());
        if ($enable_customLogo) {
            $store_logo = get_field($logoTYpe, get_the_ID());
        }
    }
    if ($store_logo=='') {
        $store_logo = get_template_directory_uri().'/asset/images/logo.png';
    }
?>
    <a href="<?php echo esc_url(home_url( '/' ));?>"><img class="lazy" src="<?php echo esc_url($store_logo);?>" data-original="<?php echo esc_url($store_logo);?>" alt="<?php echo esc_attr(get_bloginfo('name'));?>"></a>
<?php
}


/**
 *  Get list Taxonomy by postid
 * @param  [string] $taxonomy
 * @param  [int] $id
 * @return [string]
 */
function citysoul_get_taxonomy_list_by_post_id($taxonomy,$id) {
    // get post type by post
    $out = '';
        $terms = get_the_terms( $id, $taxonomy );
        if ( !empty( $terms ) ) {
            foreach ( $terms as $term )
                $out .= '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a> , ';
        }
    return substr($out,0,-2);
}

/**
 * Get list Catalog
 * @param None
 * @return string
 */
function citysoul_get_category_blog(){
    $terms = get_terms('category');
    $category_blog['Select...'] = '';
    $category_blog['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_blog[$term->name] = $term->slug;
        }
    }
    return $category_blog;
}
/**
 * Get list category gallery
 * @param none
 * @return string
 */

function citysoul_get_category_gal(){
    $terms = get_terms('category_gallery');
    $category_gal['Select...'] = '';
    $category_gal['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_gal[$term->name] = $term->slug;
        }
    }
    return $category_gal;
}
/**
 * genres_artist
 * get list artist
 */
function citysoul_get_category_art(){
    $terms = get_terms('genres_artist');
    $category_art['Select...'] = '';
    $category_art['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_art[$term->name] = $term->slug;
        }
    }
    return $category_art;
}
/**
 *  Get number post number of postype
 * @param  [string] $post_type
 * @return [array]
 */
function citysoul_number_post($post_type){
    $args = array(
      'post_type' => $post_type
    );
    $the_query = new WP_Query( $args );
    wp_reset_postdata();
    return $the_query->found_posts;
}

add_action( 'register_form', 'citysoul_register_form' );
function citysoul_register_form() {

    $email = ( ! empty( $_POST['email'] ) ) ? trim( $_POST['email'] ) : '';
    $username = ( ! empty( $_POST['username'] ) ) ? trim( $_POST['username'] ) : '';
        ?>
        <form method="post" class="register">
        <p>
                <label for="email"><?php esc_html_e('Email','citysoul');?></label>
                <input type="text" name="email" id="email" class="input" value="<?php echo esc_attr( wp_unslash( $email ) ); ?>" size="20" autocomplete="off">
        </p>
        <p>
                <label for="username"><?php esc_html_e('Username','citysoul');?></label>
                <input type="text" name="username" id="username" class="input" value="<?php echo esc_attr( wp_unslash( $username ) ); ?>" size="20" autocomplete="off">
        </p>
        <p>
                <label for="password"><?php esc_html_e('Password','citysoul');?></label>
                <input type="password" name="password" id="password" class="input" value="<?php echo esc_attr( wp_unslash( $password ) ); ?>" size="20" autocomplete="off">
        </p>
        <p>
            <input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_html_e('Register','citysoul');?>">
            <input type="hidden" name="redirect_to" value="<?php the_permalink();?>">

            </p>
        </form>
        <?php
    }

    //2. Add validation. In this case, we make sure first_name is required.
    add_filter( 'registration_errors', 'citysoul_registration_errors', 10, 3 );
    function citysoul_registration_errors( $errors, $sanitized_user_login, $user_email ) {

        if ( empty( $_POST['email'] ) || ! empty( $_POST['email'] ) && trim( $_POST['email'] ) == '' ) {
            $errors->add( 'email_error', __( '<strong>ERROR</strong>: You must include a email.', 'citysoul' ) );
        }
        if ( empty( $_POST['username'] ) || ! empty( $_POST['username'] ) && trim( $_POST['username'] ) == '' ) {
            $errors->add( 'username_error', __( '<strong>ERROR</strong>: You must include a username.', 'citysoul' ) );
        }
        return $errors;
    }

    //3. Finally, save our extra registration user meta.
    add_action( 'user_register', 'citysoul_user_register' );
    function citysoul_user_register( $user_id ) {
        if ( ! empty( $_POST['username'] ) ) {
            update_user_meta( $user_id, 'user_login', trim( $_POST['username'] ) );

        }
    }
/**
 * Limit string excerpt
 * @param  [string] $length
 * @return [array]
 */
function citysoul_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'citysoul_excerpt_length', 999 );

function citysoul_excerpt_more( $excerpt ) {
    return str_replace( '[...]', '...', $excerpt );
}
add_filter( 'wp_trim_excerpt', 'citysoul_excerpt_more' );



function citysoul_get_mastersliders() {
    $list_slide = '';
    if(function_exists('get_mastersliders')){
        $master_sliders = get_mastersliders();
        $count = count(get_masterslider_names());
        $list_slide[''] = 'Select...';
        for ($i=0; $i < $count; $i++) {
            $list_slide[($master_sliders[$i]['alias'])] = $master_sliders[$i]['title'];
        }
        if (count($master_sliders) == 0) {
            $list_slide = array(0=>__('No slider found','citysoul'));
        }
    }else{
        $list_slide = array(__('No slider found','citysoul'));
    }
    return $list_slide;
}

//remove rsd_link
remove_action ('wp_head', 'rsd_link');
if ( ! function_exists( 'citysoul_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function citysoul_time_link() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    }

    $time_string = sprintf( $time_string,
        get_the_date( DATE_W3C ),
        get_the_date(),
        get_the_modified_date( DATE_W3C ),
        get_the_modified_date()
    );

    // Wrap the time string in a link, and preface it with 'Posted on'.
    return sprintf(
        /* translators: %s: post date */
        '<div class="citysoul-date text-active">
            <em class="text-more">' . $time_string . '</em>
        </div>'
    );
}
endif;
if(!function_exists('citysoul_timetable_get_event_by_year')) {
    function citysoul_timetable_get_event_by_year($year='',$month=''){
        $data = '';
        if($year != NULL) {
            $data = $year;
            if($month != NULL) {
                $data = $year.$month;
            }
        }
        $arr =  array();
        $loop = new WP_Query(
            array(
                'post_type'     => 'event',
                'meta_query' => array(
                    array(
                        'key' => 'date_event',
                        'value' => $data,
                        'compare' => 'LIKE'
                    )
                ),
                'orderby'       => 'meta_value',
                'order'             => 'DESC',
                'posts_per_page' => -1,
            )
        );
        wp_reset_postdata();
        if($loop->have_posts()):
            $arr = array();
            while($loop-> have_posts()) : $loop->the_post();
                    $arr[] = get_the_ID();
            endwhile;
        endif;
        return $arr;
    }
}
if(!function_exists('citysoul_timetable_get_event')) {
    function citysoul_timetable_get_event($arr=array()){
        $data_event_js = '';
        if(($arr != NULL)):
            $data_event = array();
        foreach ($arr as $x => $s) :
            $unixtimestamp = strtotime(citysoul_get_field('date_event',$s));
            $artist = $job = $image = '';
            $tags =  array();
            $image =  get_the_post_thumbnail_url($s);
            if( have_rows('tags_list',$s) ):
                while ( have_rows('tags_list',$s) ) : the_row();
                    $tags[] = sprintf("%s",get_sub_field('tags'));
                endwhile;

            endif;
            if($image != NULL) :
                $image = $image;
            endif;
            $artist = citysoul_get_field('choose_artis',$s);
            if($artist != NULL) :
                $job = citysoul_get_field('art_job',$artist[0]);
                if($job != NULL ) :
                    $job = $job.' '.esc_html__(':','citysoul');
                endif;
                $artist =  get_the_title($artist[0]);
            endif;
            $data_event[] = array(
                    'title'     =>  get_the_title($s),
                    'start'     =>  date_i18n(('Y-m-d'), $unixtimestamp),
                    'jobs'      =>  $job,
                    'artist'    =>  $artist,
                    'cover'     =>  esc_url($image),
                    'tags'      =>  $tags,
                    'link'      =>  get_permalink($s)
                );
            endforeach;
        endif;
        $data_event_js = json_encode($data_event);
        return $data_event_js;
    }
}
/**
 * check shop
 */
if(!function_exists('citysoul_check_shop_page')){
    if(class_exists('woocommerce')){
        function citysoul_check_shop_page(){
            if((is_shop() != true) && (is_singular('product') != true) && (is_tax('product_cat') != true)){
                return false;
            }
            else {
                return true;
            }
        }
    } else {
       function citysoul_check_shop_page() {
        return false;
       }
    }

}
if(!function_exists('citysoul_timetable_get_event_default')) {
    function citysoul_timetable_get_event_default($arr=array()) {
        if(count($arr) > 0){
            $default = $arr[0];
            if($default != NULL) {
                return date_i18n(('Y-m-d'),strtotime(citysoul_get_field('date_event',$default)));
            }
        }
    }
}
// Function change background footer theme option and page option
if (!function_exists('citysoul_bg_footer')) {
    function citysoul_bg_footer($field){
        $link_theme_option = $link_page_option = '';
        if (function_exists('citysoul_GetOption')) {
            $link_theme_option = citysoul_GetOption($field)['url'];
        }
        if (function_exists('get_field')) {
            $link_page_option = get_field($field, get_the_ID());
        }
        $url_bg = $link_theme_option;
        if ($link_page_option != '') {
            $url_bg = $link_page_option;
        }
        ?>
        <style type="text/css"> 
            footer{ 
                background-image: url("<?php echo esc_attr($url_bg) ?>");
                background-repeat: no-repeat;
            }
        </style>
        <?php
    }
}
