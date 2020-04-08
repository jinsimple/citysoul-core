<?php
if ( function_exists('add_theme_support') ) {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'nav_menus' );
    add_theme_support( 'excerpt', array( 'post' ) );
}

if (function_exists('add_action')) {
    // post_type
    add_action('init', 'citysoul_artist_post_type');
    add_action('init', 'citysoul_album_post_type');
    add_action('init', 'citysoul_shedule_post_type');
    add_action('init', 'citysoul_fooddrink_post_type');
    add_action('init', 'citysoul_card_post_type');
    add_action('init', 'citysoul_membership_post_type');

    add_action('init', 'citysoul_videos_post_type');
    add_action('init', 'citysoul_gallery_post_type');
    add_action('init', 'citysoul_testimonial_post_type');
    add_action('init', 'citysoul_partner_post_type');
    add_action('init', 'citysoul_event_post_type');
    add_action('init', 'citysoul_page_menu_post_type');  
    
    // taxonomy
    add_action( 'init', 'profile_taxonomy', 0 );
    add_action( 'init', 'gallery_taxonomy', 0 );
    add_action( 'init', 'album_taxonomy', 0 );
    add_action('init', 'Fooddrink_taxonomy', 0);
    add_action( 'init', 'genres_artist_taxonomy',0 );
    add_action( 'init', 'event_taxonomy', 0 );

}
// postype card
function citysoul_card_post_type() {
    $labels = array(
        'name' => _x('Cards', 'post type general name', 'citysoul'),
        'singular_name' => _x('Cards', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Cards', 'citysoul'),
        'add_new_item' => __('Add new Cards', 'citysoul'),
        'edit_item' => __('Edit Cards', 'citysoul'),
        'new_item' => __('New Cards', 'citysoul'),
        'all_items' => __('All Cards', 'citysoul'),
        'view_item' => __('View Cards', 'citysoul'),
        'search_items' => __('Search Cards', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Cards Found in Trash', 'citysoul'),
        'parent_item_colon' => '',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-index-card',
        'query_var' => true,
        'show_in_nav_menus' => false,
        'supports' => array('title','page-attributes','thumbnail'),
    );

    register_post_type('cards', $args);
}

// postype schedule
function citysoul_shedule_post_type() {
    $labels = array(
        'name' => _x('Shedule', 'post type general name', 'citysoul'),
        'singular_name' => _x('Shedule', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Shedule', 'citysoul'),
        'add_new_item' => __('Add New Shedule', 'citysoul'),
        'edit_item' => __('Edit Shedule', 'citysoul'),
        'new_item' => __('New Shedule', 'citysoul'),
        'all_items' => __('All Shedule', 'citysoul'),
        'view_item' => __('View Shedule', 'citysoul'),
        'search_items' => __('Search Shedule', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Shedule Found in Trash', 'citysoul'),
        'parent_item_colon' => '',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-carrot',
        'query_var' => true,
        'show_in_nav_menus' => false,
        'supports' => array('title','page-attributes','thumbnail'),
    );

    register_post_type('shedule', $args);
}

// postype album
function citysoul_album_post_type() {
    $labels = array(
        'name' => _x('Album', 'post type general name', 'citysoul'),
        'singular_name' => _x('Album', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Album', 'citysoul'),
        'add_new_item' => __('Add New Album', 'citysoul'),
        'edit_item' => __('Edit Album', 'citysoul'),
        'new_item' => __('New Album', 'citysoul'),
        'all_items' => __('All Album', 'citysoul'),
        'view_item' => __('View Album', 'citysoul'),
        'search_items' => __('Search Album', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Album Found in Trash', 'citysoul'),
        'parent_item_colon' => '',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-album',
        'query_var' => true,
        'show_in_nav_menus' => false,
        'supports' => array('title','page-attributes','thumbnail'),
    );

    register_post_type('Album', $args);
}

// postype Fooddrink
function citysoul_fooddrink_post_type() {
    $labels = array(
        'name' => _x('Fooddrink', 'post type general name', 'citysoul'),
        'singular_name' => _x('Fooddrink', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Fooddrink', 'citysoul'),
        'add_new_item' => __('Add New Fooddrink', 'citysoul'),
        'edit_item' => __('Edit Fooddrink', 'citysoul'),
        'new_item' => __('New Fooddrink', 'citysoul'),
        'all_items' => __('All Fooddrink', 'citysoul'),
        'view_item' => __('View Fooddrink', 'citysoul'),
        'search_items' => __('Search Fooddrink', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Fooddrink Found in Trash', 'citysoul'),
        'parent_item_colon' => '',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-carrot',
        'query_var' => true,
        'show_in_nav_menus' => false,
        'supports' => array('title','page-attributes','thumbnail'),
    );

    register_post_type('Fooddrink', $args);
}




// postype PageMenu
function citysoul_page_menu_post_type() {
    $labels = array(
        'name' => _x('Page Menu', 'post type general name', 'citysoul'),
        'singular_name' => _x('Page Menu', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Page Menu', 'citysoul'),
        'add_new_item' => __('Add New Page Menu', 'citysoul'),
        'edit_item' => __('Edit Page Menu', 'citysoul'),
        'new_item' => __('New Page Menu', 'citysoul'),
        'all_items' => __('All Page Menu', 'citysoul'),
        'view_item' => __('View Page Menu', 'citysoul'),
        'search_items' => __('Search Page Menu', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Page Menu Found in Trash', 'citysoul'),
        'parent_item_colon' => '',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-welcome-widgets-menus',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail'),
    );
    register_post_type('page menu', $args);

}


//postype Membership
function citysoul_membership_post_type() {
    $labels = array(
        'name' => _x('Membership', 'post type general name', 'citysoul'),
        'singular_name' => _x('Membership', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Membership', 'citysoul'),
        'add_new_item' => __('Add New Membership', 'citysoul'),
        'edit_item' => __('Edit Membership', 'citysoul'),
        'new_item' => __('New Membership', 'citysoul'),
        'all_items' => __('All Membership', 'citysoul'),
        'view_item' => __('View Membership', 'citysoul'),
        'search_items' => __('Search Membership', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Membership Found in Trash', 'citysoul'),
        'parent_item_colon' => '',
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-share-alt',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail'),
    );
    register_post_type('membership', $args);
}


// postype Artist
function citysoul_artist_post_type() {
    $labels = array(
        'name' => _x('Artist', 'post type general name', 'citysoul'),
        'singular_name' => _x('Artist', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Artist', 'citysoul'),
        'add_new_item' => __('Add New Artist', 'citysoul'),
        'edit_item' => __('Edit Artist', 'citysoul'),
        'new_item' => __('New Artist', 'citysoul'),
        'all_items' => __('All Artist', 'citysoul'),
        'view_item' => __('View Artist', 'citysoul'),
        'search_items' => __('Search Artist', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Artist tFound in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-admin-appearance',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail','editor'),
    );
    register_post_type('artist', $args);
}

// Postype videos
function citysoul_videos_post_type() {
    $labels = array(
        'name' => _x('Videos', 'post type general name', 'citysoul'),
        'singular_name' => _x('Videos', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Videos', 'citysoul'),
        'add_new_item' => __('Add New Videos', 'citysoul'),
        'edit_item' => __('Edit Videos', 'citysoul'),
        'new_item' => __('New Videos', 'citysoul'),
        'all_items' => __('All Videos', 'citysoul'),
        'view_item' => __('View Videos', 'citysoul'),
        'search_items' => __('Search Videos', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Videos Found in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-video-alt3',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail'),
    );
    register_post_type('videos', $args);
}



// Posttype gallery
function citysoul_gallery_post_type()
{
    $labels = array(
        'name' => _x('Gallery', 'post type general name', 'citysoul'),
        'singular_name' => _x('Gallery', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Gallery', 'citysoul'),
        'add_new_item' => __('Add New Gallery', 'citysoul'),
        'edit_item' => __('Edit Gallery', 'citysoul'),
        'new_item' => __('New Gallery', 'citysoul'),
        'all_items' => __('All Gallery', 'citysoul'),
        'view_item' => __('View Gallery', 'citysoul'),
        'search_items' => __('Search Gallery', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Gallery Found in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-images-alt2',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail'),
    );
    register_post_type( 'gallery' , $args );
}

// Posttype testimonial
function citysoul_testimonial_post_type()
{
    $labels = array(
        'name' => _x('Testimonial', 'post type general name', 'citysoul'),
        'singular_name' => _x('Testimonial', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Testimonial', 'citysoul'),
        'add_new_item' => __('Add New Testimonial', 'citysoul'),
        'edit_item' => __('Edit Testimonial', 'citysoul'),
        'new_item' => __('New Testimonial', 'citysoul'),
        'all_items' => __('All Testimonial', 'citysoul'),
        'view_item' => __('View Testimonial', 'citysoul'),
        'search_items' => __('Search Testimonial', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Testimonial Found in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-chart-line',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','editor')
    );
    register_post_type( 'testimonial' , $args );
}


// Posttype partner
function citysoul_partner_post_type()
{
    $labels = array(
        'name' => _x('Partner', 'post type general name', 'citysoul'),
        'singular_name' => _x('Partner', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'partner', 'citysoul'),
        'add_new_item' => __('Add new partner', 'citysoul'),
        'edit_item' => __('Edit partner', 'citysoul'),
        'new_item' => __('New partner', 'citysoul'),
        'all_items' => __('All partner', 'citysoul'),
        'view_item' => __('View partner', 'citysoul'),
        'search_items' => __('Search partner', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No partner Found in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-image-filter',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail')
    );
    register_post_type( 'partner' , $args );
}

// Posttype event
function citysoul_event_post_type()
{
    $labels = array(
        'name' => _x('Event', 'post type general name', 'citysoul'),
        'singular_name' => _x('Event', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'event', 'citysoul'),
        'add_new_item' => __('Add new event', 'citysoul'),
        'edit_item' => __('Edit event', 'citysoul'),
        'new_item' => __('New event', 'citysoul'),
        'all_items' => __('All event', 'citysoul'),
        'view_item' => __('View event', 'citysoul'),
        'search_items' => __('Search event', 'citysoul'),
        'not_found' =>  __('No event Found', 'citysoul'),
        'not_found_in_trash' => __('No event Found in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-awards',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail','editor','excerpt')
    );
    register_post_type( 'event' , $args );
}
// // Register event Taxonomy
function event_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Category event', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Category event', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Category event', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'category_event', array( 'event' ), $args );

}

// Register Custom Taxonomy
function gallery_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Gallery', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Category Gallery', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Category Gallery', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'category_gallery', array( 'gallery' ), $args );

}

function profile_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Profile', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Category profile', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Category profile', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'category_profile', array( 'profile' ), $args );

}


// Posttype album
function album_post_type()
{
    $labels = array(
        'name' => _x('Album', 'post type general name', 'citysoul'),
        'singular_name' => _x('Album', 'post type singular name', 'citysoul'),
        'add_new' => _x('Add New', 'Album', 'citysoul'),
        'add_new_item' => __('Add New Album', 'citysoul'),
        'edit_item' => __('Edit Dlbum', 'citysoul'),
        'new_item' => __('New Album', 'citysoul'),
        'all_items' => __('All Album', 'citysoul'),
        'view_item' => __('View Album', 'citysoul'),
        'search_items' => __('Search Album', 'citysoul'),
        'not_found' =>  __('No partner Found', 'citysoul'),
        'not_found_in_trash' => __('No Album Found in Trash', 'citysoul'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-album',
        'query_var' => true,
        'show_in_nav_menus'=> false,
        'supports' => array('title','page-attributes','thumbnail')
    );
    register_post_type( 'album' , $args );
}

function album_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Album', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Category album', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Category album', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'category_album', array( 'album' ), $args );
}

function Fooddrink_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Fooddrink', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Category Fooddrink', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Category Fooddrink', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'category_Fooddrink', array( 'fooddrink' ), $args );
}

/**
 * Create a genres artist taxonomy 
 */
function genres_artist_taxonomy() {

    $labels = array(
        'name'                    => _x( 'Genre Name', 'Taxonomy Genre name', 'text-domain' ),
        'singular_name'            => _x( 'Genres Name', 'Taxonomy Genres name', 'text-domain' ),
        'search_items'            => __( 'Search Genre Name', 'text-domain' ),
        'popular_items'            => __( 'Popular Genre Name', 'text-domain' ),
        'all_items'                => __( 'All Genre Name', 'text-domain' ),
        'parent_item'            => __( 'Parent Genres Name', 'text-domain' ),
        'parent_item_colon'        => __( 'Parent Genres Name', 'text-domain' ),
        'edit_item'                => __( 'Edit Genres Name', 'text-domain' ),
        'update_item'            => __( 'Update Genres Name', 'text-domain' ),
        'add_new_item'            => __( 'Add New Genres Name', 'text-domain' ),
        'new_item_name'            => __( 'New Genres Name Name', 'text-domain' ),
        'add_or_remove_items'    => __( 'Add or remove Genre Name', 'text-domain' ),
        'choose_from_most_used'    => __( 'Choose from most used text-domain', 'text-domain' ),
        'menu_name'                => __( 'Genres Name', 'text-domain' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => false,
        'hierarchical'      => true,
        'show_tagcloud'     => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => true,
        'query_var'         => true,
        'capabilities'      => array(),
    );

    register_taxonomy( 'genres_artist', array( 'artist' ), $args );
}
?>