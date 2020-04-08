<?php
//Remove comment field url email
if(!function_exists('remove_comment_fields')){
    function remove_comment_fields($fields) {
        unset($fields['url']);
        return $fields;
    }
    add_filter('comment_form_default_fields','remove_comment_fields');
}

function bleute_font_backend() {
    wp_enqueue_style('css-font-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900', array(), '1.0.0');
}
add_action('admin_head', 'bleute_font_backend');



//Check extension
function findExtension ($filename)
{
    $filename = strtolower($filename) ;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // var_dump($ext);
    return $ext;
}

 //Return Attactment ID
 function beau_get_attachment_id_from_url( $attachment_url = '' ) {
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


function beau_get_category_product(){
    $terms = get_terms('product_cat', array('hide_empty' => 0,'orderby' => 'date','order' => 'DESC'));
    $category_product['Select...'] = 'Select';
    $category_product['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_product[$term->name] = $term->name;
        }
    }
    return $category_product;
}

function beau_get_category_blog(){
    $terms = get_terms('category');
    $category_blog['Select...'] = '';
    $category_blog['All'] = 'All';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_blog[$term->name] = $term->name;
        }
    }
    return $category_blog;
}

function beau_get_member_post(){
    $args = array(
      'post_type'     => 'member',
    );
    $member_post = array();
    $loop = new WP_Query( $args);
    while ($loop->have_posts()) {
        $loop->the_post();
        $member_post[]['label'] = get_the_title();
        $member_post[]['value'] = get_the_ID();
    }
    return $member_post;
}

function beau_get_album_post(){
    $args = array(
      'post_type'     => 'album',
    );
    $album_post = array();
    $loop = new WP_Query( $args);
    $album_post['Select...'] = 'Select';
    while ($loop->have_posts()) {
        $loop->the_post();
        $album_post[get_the_title()] = 'id'.get_the_ID();
    }
    return $album_post;
}

function beau_get_sidebar(){
    $terms_list = wp_get_sidebars_widgets();
    $terms = $terms_list;
    $abc = array();
    foreach ($terms as $key => $value) {
        if ($key !='wp_inactive_widgets') {
            $abc[$key] = $key;
        }
    }
    //array_unshift($terms, "Select...");

    return $abc;
}

// breadcrumb
function beau_the_breadcrumb() {
    echo '<ul id="crumbs">';
    if (!is_home()) {
        echo '<li><a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo "</a></li>";
        if (is_category() || is_single()) {
            echo '<li>';
            the_category(' </li><li> ');
            if (is_single()) {
                echo "</li><li>";
                the_title();
                echo '</li>';
            }
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
function beau_jquery_version() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery',
'//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'beau_jquery_version');
?>
