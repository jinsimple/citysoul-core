<?php
/**
 * Content before index title.
 *
 * @see citysoul_cover_page()
 * @see citysoul_main_view()
 */
add_action('citysoul_before_main_content','citysoul_cover_page', 10);
add_action('citysoul_before_main_content','citysoul_main_view', 20);

/**
 * Content before index title.
 *
 * @see citysoul_after_main_view()
 */
add_action('citysoul_after_main_content','citysoul_after_main_view', 20);

/**
 * Content before index title.
 *
 * @see citysoul_loop_before()
 */
add_action('citysoul_before_content','citysoul_loop_before', 20);


/**
 * Content before index title.
 *
 * @see citysoul_pagination()
 * @see citysoul_loop_after()
 */
//add_action('citysoul_after_content','citysoul_pagination', 10);
add_action('citysoul_after_content','citysoul_loop_after', 20);


/**
 * Content before index title.
 *
 * @see citysoul_before_sidebar()
 */
add_action('citysoul_sidebar','citysoul_before_sidebar', 10);


/**
 * Content before index title.
 *
 * @see citysoul_after_sidebar()
 */
add_action('citysoul_sidebar','citysoul_after_sidebar', 90);


/**
 * Content before index title.
 *
 * @see citysoul_get_sticker()
 * @see citysoul_get_thumbnail()
 */
add_action( 'citysoul_before_index_loop_item_title', 'citysoul_get_sticker', 10);
add_action( 'citysoul_before_index_loop_item_title', 'citysoul_get_thumbnail_archive', 20);


/**
 * Content before index content.
 *
 * @see citysoul_before_content()
 */
add_action( 'citysoul_before_index_content', 'citysoul_before_content', 10);

/**
 * Content index.
 *
 * @see citysoul_date_time_content()
 * @see citysoul_title_content()
 * @see citysoul_description_content()
 */
add_action( 'citysoul_index_content', 'citysoul_date_time_content', 10);
add_action( 'citysoul_index_content', 'citysoul_title_content', 20);
add_action( 'citysoul_index_content', 'citysoul_description_content', 30);
add_action( 'citysoul_index_content', 'citysoul_tag_content', 40);
add_action( 'citysoul_index_content', 'citysoul_category_content', 50);
add_action( 'citysoul_index_content', 'citysoul_category_readmore', 60);



/**
 * Content after index content.
 *
 * @see citysoul_after_content()
 */
add_action( 'citysoul_after_index_content', 'citysoul_after_content', 10);


/**
 * Content before index title.
 *
 * @see citysoul_before_main_content_details()
 * @see citysoul_breadcrumb()
 */
add_action('citysoul_before_main_content_details','citysoul_before_main_content_details', 20);
add_action('citysoul_before_main_content_details','citysoul_breadcrumb', 30);

/**
 * Content after index title.
 *
 * @see citysoul_after_main_content_details()
 */
add_action('citysoul_after_main_content_details','citysoul_after_main_content_details', 10);


/**
 * Content before index title.
 *
 * @see citysoul_before_content_single_div()
 */
add_action('citysoul_before_content_single','citysoul_before_content_single_div', 10);


/**
 * Content after index title.
 *
 * @see citysoul_next_prev_post()
 * @see citysoul_author_box_detail()
 * @see citysoul_comment_form()
 * @see citysoul_after_content_single_div()
 */

add_action('citysoul_after_content_single','citysoul_next_prev_post', 10);
add_action('citysoul_after_content_single','citysoul_author_box_detail', 20);
add_action('citysoul_after_content_single','citysoul_comment_form', 30);
add_action('citysoul_after_content_single','citysoul_after_content_single_div', 40);


/**
 * Content before index title.
 *
 * @see citysoul_get_thumbnail()
 * @see citysoul_get_sticker()
 * @see citysoul_title_single_content()
 * @see citysoul_info_single_content()
 */

add_action('citysoul_before_loop_content','citysoul_get_thumbnail', 10);
add_action('citysoul_before_loop_content','citysoul_get_sticker', 20);
add_action('citysoul_before_loop_content','citysoul_title_single_content', 30);
add_action('citysoul_before_loop_content','citysoul_info_single_content', 40);

/**
 * Content after index title.
 *
 * @see citysoul_next_prev_post()
 * @see citysoul_author_box_detail()
 * @see citysoul_comment_form()
 * @see citysoul_after_content_single_div()
 */

add_action('citysoul_after_loop_content','citysoul_before_content_single', 10);
add_action('citysoul_after_loop_content','citysoul_content_single', 20);
add_action('citysoul_after_loop_content','citysoul_tag_share_content_single', 30);
add_action('citysoul_after_loop_content','citysoul_after_content_single', 40);


/**
 * Cover info of page.
 *
 * @see citysoul_cover_page()
 * @see citysoul_breadcrumb()
 */

add_action('citysoul_cover_info','citysoul_cover_page', 10);
add_action('citysoul_cover_info','citysoul_breadcrumb', 20);



/* ------------------------ */

/* Hook custom Woocommerce Page Archiver */

/**
 * woocommerce_before_main_content hook.
 *
 * @hooked citysoul_cover_page_shop - 9
 * @hooked woocommerce_output_content_wrapper - 10
 */
add_action('woocommerce_before_main_content','citysoul_cover_page_shop', 9);

remove_action('woocommerce_before_main_content','woocommerce_breadcrumb', 20);

/**
 * woocommerce_after_shop_loop_item_title hook.
 *
 * @hooked woocommerce_template_loop_rating - 5
 */
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10);

add_action('woocommerce_after_shop_loop_item','citysoul_get_link_view_product', 5);


/**
 * woocommerce_shop_loop_item_title hook.
 *
 * @hooked citysoul_get_product_title_product - 10
 * @hooked woocommerce_template_loop_price - 20
 */

add_action('woocommerce_shop_loop_item_title','citysoul_get_product_title_product', 10);
add_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_price', 20);

remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10);



/* ------------------------ */

/* Hook custom Woocommerce Page Single */

/**
 * woocommerce_single_product_summary hook.
 *
 * @hooked woocommerce_template_single_rating - 4
 * @hooked citysoul_get_categories_woocommerce - 30
 * @hooked citysoul_get_tag_woocommerce - 30
 * @hooked citysoul_get_description_single_woocommerce - 60
 */
add_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 4);
add_action('woocommerce_single_product_summary','citysoul_get_categories_woocommerce', 30);
add_action('woocommerce_single_product_summary','citysoul_get_tag_woocommerce', 30);
add_action('woocommerce_single_product_summary','citysoul_get_description_single_woocommerce', 60);
add_action('woocommerce_single_product_summary','citysoul_get_review_single_woocommerce', 65);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);


/**
 * woocommerce_after_single_product_summary hook.
 *
 * @hooked citysoul_get_product_title_product - 10
 * @hooked woocommerce_template_loop_price - 20
 */

remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display', 15);


/**
 * view_content_gallery_image hook.
 *
 * @hooked citysoul_cover_details_gallery - 10
 */
add_action( 'citysoul_cover_header_gallery', 'citysoul_cover_details_gallery', 10);


/**
 * view_content_gallery_image hook.
 *
 * @hooked citysoul_view_gallery - 10
 */
add_action( 'citysoul_view_content_gallery_image', 'citysoul_view_gallery', 10);


/**
 * Content before detail artist
 * @see citysoul_header_artist_view() - 5
 * @see citysoul_detail_artist_view() - 10
 * @see citysoul_after_detail_artist_view() - 50
 */
add_action('citysoul_before_detail_artist','citysoul_header_artist_view',5);
add_action('citysoul_before_detail_artist','citysoul_detail_artist_view',10);

/**
 * Content detail artist
 * @see citysoul_content_detail_artist() - 10
 */
add_action('citysoul_content_single_artist','citysoul_content_detail_artist',10);
/**
 * Content detail artist
 * @see citysoul_artist_podcast_view() - 10
 */
add_action('citysoul_podcast_single_artist','citysoul_artist_podcast_view',10);

/**
 * Content after detail artist
 * @see citysoul_after_detail_artist_view() - 50
 */
add_action('citysoul_after_detail_artist','citysoul_after_detail_artist_view',20);
/**
 * citysoul_details_event_before hook.
 * @hooked citysoul_details_event - 10
 * @hooked citysoul_details_event_button - 20
 */
add_action('citysoul_details_event', 'citysoul_details_event', 10);
add_action('citysoul_details_event_before', 'citysoul_details_event', 10);

/**
 * citysoul_details_event_after hook.
 * @hooked citysoul_details_event_button - 10
 */
add_action('citysoul_details_event_after', 'citysoul_details_event_button', 10);

