<?php
/*
 * Function citysoul core
 * Don't change anything here
 * Contact - Beautheme
 * Email: support@beautheme.com
 */
/*
 * Funcion citysoul_get_template
 * $template - string
 * $part - string
 * $reQuireOne - boolean
 */
function citysoul_get_template( $template, $part='', $requireOne = true ){
    if ($part != '') $template =  $template.'-'.$part;
    if (file_exists(get_theme_file_path().'/'.$template.'.php')) {
        include(get_theme_file_path().'/'.$template.'.php');
    }
    else {
        include(get_parent_theme_file_path().'/'.$template.'.php');
    }
    return false;
}


/*
 * Funcion citysoul_get_loop item
 * $template - string
 * $part - string
 */

function citysoul_get_loop( $citysoul_item = '', $part = '' ){
    if ($citysoul_item) {
        citysoul_get_template( 'loop-items/'.$citysoul_item, $part, false );
    }
}



/*
 * Funcion citysoul_the_excerpt
 * $charlength - int
 */
function citysoul_the_excerpt( $charlength ) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        }
        if ( !$excut < 0 ) {
            echo esc_html($subex);
        }
        echo '[...]';
    }
    if ( !mb_strlen( $excerpt ) > $charlength ) {
        echo esc_html($excerpt);
    }
}


/**
 * [core_get_post_id
 * @param  integer $post_id
 * @return   integer $post_id
 */
function citysoul_get_post_id( $post_id = 0 ) {
    if( !$post_id ) {
        $post_id = (int) get_the_ID();
        if( !$post_id ) {
            $post_id = get_queried_object();
        }
    }
    if( is_object($post_id) ) {
        // post
        if( isset($post_id->post_type, $post_id->ID) ) {
            $post_id = $post_id->ID;
        // user
        } elseif( isset($post_id->roles, $post_id->ID) ) {
            $post_id = 'user_' . $post_id->ID;
        // term
        } elseif( isset($post_id->taxonomy, $post_id->term_id) ) {
            $post_id = $post_id->taxonomy . '_' . $post_id->term_id;
        // comment
        } elseif( isset($post_id->comment_ID) ) {
            $post_id = 'comment_' . $post_id->comment_ID;
        // default
        } else {
            $post_id = 0;
        }
    }
    // return
    return $post_id;
}

/**
 * citysoul_get_field
 * @param string $selector
 * @param int $post_id
 * @param bolean $format_value
 * @return array
 */
if(!function_exists('citysoul_get_field')) {
    function citysoul_get_field($selector, $post_id = false, $format_value = true ) {
        $post_id = citysoul_get_post_id( $post_id );
        if($selector != NULL) {
            if(function_exists('get_field')){
                return get_field($selector, $post_id, $format_value);
            }
            return false;
        }
        return false;
    }
}


/**
 * Get list contact form 7
 *
 * @return array
 */
function citysoul_get_contact_form(){
    $list_contact['None'] = 'None';
    $args = array(
      'post_type'     => 'wpcf7_contact_form',
    );
    $loop = new WP_Query( $args);
    wp_reset_postdata();
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) {
            $loop ->the_post();
            $list_contact[ get_the_title() ] = get_the_ID();
        }
    }
    return $list_contact;
}

/**
 * Get post thumbnail url
 *
 * @param integer $post_id
 * @param type $size
 * @return string
 */
function citysoul_get_post_thumbnail_url( $post_id, $size = 'full' ) {
    return wp_get_attachment_url( get_post_thumbnail_id($post_id, $size) );
}


/**
 * Remove default image thumbnail sizes in wordpress
 *
 * @param string $sizes
 * @return string
 */
function citysoul_remove_default_image_sizes( $sizes ) {
    unset( $sizes['citysoul_featured_preview'] );
    unset( $sizes['thumbnail'] );
    unset( $sizes['medium'] );
    unset( $sizes['large'] );
    return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'citysoul_remove_default_image_sizes' );

/**
 * get list taxonomy in post type
 * @return array()
 */
function citysoul_get_list_taxonomy_by_name($taxonomy){
    $category_product = array();
    if (function_exists('beau_theme_plugin_init')) {
        $terms = get_terms($taxonomy, array('hide_empty' => 0,'orderby' => 'date','order' => 'DESC'));

        foreach ($terms as $term) {
              $category_product[] = array(
                'value' => $term->term_id,
                'label' => $term->name,
              );
        }
    }
    return $category_product;

}
/**
 * Get list category product
 *
 * @return array
 */


function citysoul_get_list_category_product(){
    $category_product = array();
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
          $terms = get_terms('product_cat', array('hide_empty' => 0,'orderby' => 'date','order' => 'DESC'));

          foreach ($terms as $term) {
              $category_product[] = array(
                'value' => $term->term_id,
                'label' => $term->name,
              );
          }
      return $category_product;
    }
}


/**
 * Get list category by taxonomy
 *
 * @return array
 */

function citysoul_get_category_by_taxonomy( $taxonomy ){
    $terms = get_terms($taxonomy);
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
 * Get list sidebar
 *
 * @return array
 */

function citysoul_get_sidebar(){
    $terms_list = wp_get_sidebars_widgets();
    $terms = $terms_list;
    $sidebar = "";
    foreach ($terms as $key => $value) {
        if ($key !='wp_inactive_widgets') {
            $sidebar[$key] = $key;
        }
    }
    //array_unshift($terms, "Select...");

    return $sidebar;
}


/**
 * Numbered Pagination
 *
 * @param string $loop
 * @return string
 */
if ( !function_exists( 'citysoul_pagination' ) ) {
    function citysoul_pagination( $loop='' ) {
        global $wp_query;
        if ($loop=="") {
            $loop = $wp_query;
        }
        $big = 999999999; // need an unlikely integer
        $pages = paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $loop->max_num_pages,
            'prev_next' => false,
            'type'      => 'array',
            'prev_next' => TRUE,
            'prev_text' => esc_html__('PREV','citysoul'),
            'next_text' => esc_html__('NEXT','citysoul'),
        ) );

        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="pagging"><ul>';
            foreach ( $pages as $page ) {
                echo "<li>$page</li>";
            }
           echo '</ul></div>';
        }
    }
}

/**
 * Show id post in postype admin
 */
add_filter( 'manage_posts_columns', 'citysoul_add_id_column', 5 );
add_action( 'manage_posts_custom_column', 'citysoul_id_column_content', 5, 2 );


function citysoul_add_id_column( $columns ) {
   $columns['citysoul_id'] = 'ID';
   return $columns;
}

function citysoul_id_column_content( $column, $id ) {
  if( 'citysoul_id' == $column ) {
    echo esc_html($id);
  }
}


/**
 * Get all category in post
 *
 * @param string $id
 * @param array $classExtra
 * @return array
 */


function citysoul_getAllcategory_inPost( $id = '', $classExtra = ''){
    if ($id == '') { $id = get_the_ID();}
    $category = get_the_terms($id,'category_gallery');

    if (!is_wp_error($category)) {
        for($k=0; $k < count($category); $k++) {
            if ($category[$k] != NULL) {
                $classExtra .= ' '.$category[$k]->slug;
            }
        }
    }
    return $classExtra;
}

/**
 * Get excerpt by id
 *
 * @param int $post_id
 * @return array
 */


function citysoul_get_excerpt_by_id ( $post_id ){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '...');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}


/*
 * Funcion citysoul_the_breadcrumb
 */
function citysoul_the_breadcrumb() {

    echo '<ul id="crumbs" class="text-title text-active">';
    if (!is_home()) {
        echo '<li><a href="';
        echo home_url('/');
        echo '">';
        echo 'Home';
        echo "</a></li>";
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');

        } elseif (is_page()) {
            echo '<li>';
            echo the_title();
            echo '</li>';
        }
    }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
    elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
    echo '</ul>';
}

/**
 * Show column feature images on admin postype
 *
 * @param int $post_ID
 * @return array
 */

add_image_size( 'citysoul_featured_preview', 55, 55, true );
function citysoul_get_featured_image( $post_ID ) {
    $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
    if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'citysoul_featured_preview' );
        return $post_thumbnail_img[0];
    }
}

// ADD NEW COLUMN
function citysoul_columns_head( $defaults ) {
    $defaults['featured_image'] = __('Images','citysoul');
    return $defaults;
}

// SHOW THE FEATURED IMAGE

function citysoul_columns_content( $column_name, $post_ID ) {
    if ($column_name == 'featured_image') {
        $post_featured_image = citysoul_get_featured_image($post_ID);
        if ($post_featured_image) {
            echo '<img src="' . $post_featured_image . '" />';
        }
    }
}

add_filter( 'manage_posts_columns', 'citysoul_columns_head' );
add_action( 'manage_posts_custom_column', 'citysoul_columns_content', 10, 2 );


/**
 * Generate css for shortcode
 *
 * @param String $shortcodeID
 * @param String $style
 * @return array
 */
function citysoul_css_shortcode( $shortcodeID, $style ){
    $css = $tmp_css = '';
    foreach ($style as $key => $value) {
        $atribute = '';
        if ($key!= '') {$atribute = ' '.$key;}
        if ($atribute == ' :hover') { $atribute = ":hover";}
        $tmp_css  .= '#'.$shortcodeID.$atribute.'{';
        foreach ($value as $attr => $code) {
            if ($code !='') {
                $tmp_css  .= $attr.':'.$code.'!important;';
            }
        }
        $tmp_css  .= '}';
        if (strlen($tmp_css) != strlen('#'.$shortcodeID.$atribute.'{}')) {$css .= $tmp_css;}
        $tmp_css = '';
    }
    if ($css =='') { return false;}
    return '<style id="custom_css_'.$shortcodeID.'">'.$css.'</style>';
}


/**
 * Return Attactment ID
 *
 * @param String $attachment_url
 * @return array
 */
 function citysoul_get_attachment_id_from_url( $attachment_url = '' ) {
    global $wpdb;
    $attachment_id = false;
    if ( '' == $attachment_url )
        return;
    $upload_dir_paths = wp_upload_dir();
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
    }
    return $attachment_id;
}


// //Include theme options
citysoul_get_template('inc/theme-option');

//Get template function
citysoul_get_template('core/includes/core-template-funtion');

//Get template hook
citysoul_get_template('core/includes/core-template-hook');

//Include visual composer custom
if (class_exists('WPBakeryShortCode')) {
    if(file_exists(get_template_directory().'/inc/vc_custom/citysoul_field_shortcode.php')){
        citysoul_get_template('inc/vc_custom/citysoul_field_shortcode');
    }
    if(file_exists(get_template_directory().'/inc/vc_custom/citysoul_init.php')){
        citysoul_get_template('inc/vc_custom/citysoul_init');
    }
}

//Include function custom
citysoul_get_template('inc/custom/function-custom');

//Include hook script
citysoul_get_template('inc/custom/hook-script');

// //Create dashbroard
// citysoul_get_template('core/admin/dashbroard');

//Loadmore function
citysoul_get_template('core/includes/ajax-loadmore');
