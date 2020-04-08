<?php
/**
 * Core citysoul template function
 *
 * List function for hook
 * @author    Jinsimple
 * @category  Core
 * @package   Includes/Function
 * @version   0.0.1
 */

/*
 * Function citysoul_detail_artist_view Example action hook
 */
function citysoul_detail_artist_view() {
  ?>
<section class="detail-artist">
    <div class="container">
 <?php
}
/*
 * Function citysoul_detail_artist_view Example action hook
 */
function citysoul_after_detail_artist_view() {
  ?>
    </div>
</section><!--detail-artist-->
 <?php
}
/*
 * Funcion citysoul_main_view Example action hook
 */
function citysoul_main_view(){
?>
<section class="citysoul_main col-xs-12">
    <div class="container">
<?php
}


/*
 * Funcion citysoul_after_main_view Example action hook
 */
function citysoul_after_main_view(){
?>
    </div>
</section>
<?php
}


/*
 * Funcion citysoul_loop_before Example action hook
 */
function citysoul_loop_before(){
?>
  <ul class="citysoul-list-blog col-md-12 col-sm-12 col-xs-12">
<?php
}


/*
 * Funcion citysoul_loop_after Example action hook
 */
function citysoul_loop_after(){
?>
  </ul>
<?php
}

/*
 * Funcion citysoul_before_sidebar Example action hook
 */
function citysoul_before_sidebar(){
?>
  <aside class="citysoul-sidebar right-sidebar col-md-3 col-sm-3 col-xs-12">
<?php
    get_sidebar();
}


/*
 * Funcion citysoul_after_sidebar Example fillter hook
 * $text - string
 */
function citysoul_after_sidebar(){
?>
  </aside>
<?php
}


/*
 * Funcion citysoul_get_thumbnail_sticker Example fillter hook
 * $text - string
 */
function citysoul_get_sticker(){
?>
  <?php if (is_sticky()): ?>
    <span class="sticky-post text-more"><?php esc_html_e('Sticky','citysoul')?></span>
  <?php endif ?>

<?php
}

function citysoul_get_thumbnail(){
  if (citysoul_check_option_theme('enable-cover-image-single-blog') != '0'){
  ?>
    <div class="feature-single-image">
      <a href="<?php echo esc_url(the_permalink());?>" class="img-post-item">
          <?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?>
      </a>
    </div>
  <?php
  }
}

if ( ! function_exists( 'citysoul_get_thumbnail_archive' ) ) {
  function citysoul_get_thumbnail_archive(){
    if (citysoul_check_option_theme('enable-thumbnail-archive-blog') != '0'){
    ?>
      <a href="<?php echo esc_url(the_permalink());?>" class="img-post-item">
          <?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?>
      </a>
    <?php
    }
  }
}

if ( ! function_exists( 'citysoul_before_content' ) ) {

  /**
   * Output the end of content page index.
   *
   */
  function citysoul_before_content(){
  ?>
    <div class="title-desc-blog-item">
  <?php
  }
}


if ( ! function_exists( 'citysoul_date_time_content' ) ) {

  /**
   * Output the date time of content page index.
   *
   */
  function citysoul_date_time_content(){
  if (citysoul_check_option_theme('enable-date-archive-blog') != '0'): ?>

      <?php echo citysoul_time_link(); ?>

  <?php endif;
  }
}

if ( ! function_exists( 'citysoul_title_content' ) ) {

  /**
   * Output the title of content page index.
   *
   */
  function citysoul_title_content(){
    if (citysoul_check_option_theme('enable-title-archive-blog') != '0'): ?>
      <div class="title-post">
        <a class="text-title text-2x" href="<?php echo get_the_permalink() ?>"> <?php the_title();?></a>
      </div>
    <?php endif;
  }
}

if ( ! function_exists( 'citysoul_description_content' ) ) {

  /**
   * Output the description of content page index.
   *
   */
  function citysoul_description_content(){
  ?>
      <div class="desc-post">
        <?php if (citysoul_check_option_theme('enable-excerpt-archive-blog') != '0'): ?>
          <span class="text-desc">
            <?php echo get_the_excerpt(); ?>
          </span>
        <?php endif; ?>
      </div>
    <?php
  }
}

if ( ! function_exists( 'citysoul_tag_content' ) ) {

  /**
   * Output the description of content page index.
   *
   */
  function citysoul_tag_content(){
    $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'citysoul' ) );
    if (citysoul_check_option_theme('enable-tags-archive-blog') != '0'){
      if ( $tags_list ) {
        printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
          _x( 'Tags', 'Used before tag names.', 'citysoul' ),
          $tags_list
        );
      }
    }
  }
}


if ( ! function_exists( 'citysoul_category_content' ) ) {

  /**
   * Output the description of content page index.
   *
   */
  function citysoul_category_content(){
    $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'citysoul' ) );
    if (citysoul_check_option_theme('enable-category-archive-blog') != '0'){
      if ( $categories_list) {
        printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
          _x( 'Categories', 'Used before category names.', 'citysoul' ),
          $categories_list
        );
      }
    }
  }
}


if ( ! function_exists( 'citysoul_category_readmore' ) ) {

  /**
   * Output the description of content page index.
   *
   */
  function citysoul_category_readmore(){
  if (citysoul_check_option_theme('enable-readmore-archive-blog') != '0'): ?>
    <div class="readmore text-active">
      <a href="<?php echo get_the_permalink() ?>"><?php echo esc_html_e('Read more...', 'citysoul') ?></a>
    </div>
  <?php endif;
  }
}


if ( ! function_exists( 'citysoul_after_content' ) ) {

  /**
   * Output the end of content page index.
   *
   */
  function citysoul_after_content(){
  ?>
    </div>
  <?php
  }
}

if ( ! function_exists( 'citysoul_before_main_content_details' ) ) {

  /**
   * Output the end of content page index.
   *
   */
  function citysoul_before_main_content_details(){
  ?>
    <section class="citysoul-cover-page">
      <?php if ( has_post_thumbnail()): ?>
        <div class="citysoul-banner-page single-page">
        </div><!--End .banner-page-->
      <?php endif ?>
    </section>
    <section class="citysoul-blog-page">
      <div class="container">
          <div class="citysoul-blog">
  <?php
  }
}

if ( ! function_exists( 'citysoul_before_content_single_div' ) ) {

  /**
   * Output the start of content single.
   *
   */
  function citysoul_before_content_single_div(){
  ?>
    <div class="content-blog left-content col-md-9 col-sm-9 col-xs-12">
  <?php
  }
}

if ( ! function_exists( 'citysoul_after_content_single_div' ) ) {

  /**
   * Output the start of content single.
   *
   */
  function citysoul_after_content_single_div(){
  ?>
    </div>
  <?php
  }
}

if ( ! function_exists( 'citysoul_after_main_content_details' ) ) {

  /**
   * Output the end of content single.
   *
   */
  function citysoul_after_main_content_details(){
  ?>
        </div>
      </div>
    </section>
  <?php
  }
}

if ( ! function_exists( 'citysoul_next_prev_post' ) ) {

  /**
   * Output next prev post of content single.
   *
   */
  function citysoul_next_prev_post(){
    if (citysoul_check_option_theme('enable-next-single-blog') != '0'){
      citysoul_get_template('core/layout/next-prev-post');
    }
  }
}

if ( ! function_exists( 'citysoul_author_box_detail' ) ) {

  /**
   * Output the author box of content single.
   *
   */
  function citysoul_author_box_detail(){
    if (citysoul_check_option_theme('enable-profile-author-single-blog') != '0'){
      citysoul_get_template('core/layout/author-box-detail-post');
    }
  }
}

if ( ! function_exists( 'citysoul_comment_form' ) ) {

  /**
   * Output the comment of content single.
   *
   */
  function citysoul_comment_form(){
    if (citysoul_check_option_theme('enable-comment-single-blog') != '0'){
      citysoul_get_template('core/layout/comment-form');
    }
  }
}

if ( ! function_exists( 'citysoul_title_single_content' ) ) {

  /**
   * Output the title content single.
   *
   */
  function citysoul_title_single_content(){
    ?>
      <div class="clearfix"></div>
      <?php if (citysoul_check_option_theme('enable-title-single-blog') != '0'): ?>
        <h1 class="text-title text-3x title-post text-white">
            <?php the_title();?>
        </h1>
      <?php endif ?>
    <?php
  }
}

if ( ! function_exists( 'citysoul_info_single_content' ) ) {

  /**
   * Output the info of content single.
   *
   */
  function citysoul_info_single_content(){
    $number_comment = get_comments_number();
    ?>
      <div class="clearfix"></div>
      <div class="info-single-post">
        <?php if (citysoul_check_option_theme('enable-date-single-blog') != '0'): ?>

              <?php echo citysoul_time_link(); ?>

        <?php endif ?>
        <div class="by-auth citysoul-date text-active">
          <?php if (citysoul_check_option_theme('enable-author-single-blog') != '0'): ?>
            <em class="text-more"><?php esc_html_e('By','citysoul')?> /</em>
            <span class="text-ara"><?php the_author(); ?></span>
          <?php endif ?>
          <?php if (citysoul_check_option_theme('enable-number-comment-single-blog') != '0'): ?>
            <span class="comment"><i class="fa fa-comment-o"></i> / <?php echo esc_html($number_comment) ?></span>
          <?php endif ?>
        </div>
      </div><!--End .info-single-post-->
    <?php
  }
}

if ( ! function_exists( 'citysoul_before_content_single' ) ) {

  /**
   * Output the start of content single.
   *
   */
  function citysoul_before_content_single(){
    ?>
      <div class="content-post citysoul-content-single">
    <?php
  }
}

if ( ! function_exists( 'citysoul_content_single' ) ) {

  /**
   * Output the content single.
   *
   */
  function citysoul_content_single(){
    the_content();
    wp_link_pages( array(
        'before'      => '<div class="page-links"><span class="page-links-title">' . get_post_type() . '</span>',
        'after'       => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );

    edit_post_link( esc_html__( 'Edit ', 'citysoul' ). get_post_type(), '<span class="edit-link">', '</span>' );
  }
}

if ( ! function_exists( 'citysoul_tag_share_content_single' ) ) {

  /**
   * Output tag and share of content single.
   *
   */
  function citysoul_tag_share_content_single(){
    ?>
    <div class="tags-share">
        <div class="col-sm-9 col-xs-12 tags-list-detail tags-list">
          <?php if (citysoul_check_option_theme('enable-tags-single-blog') != '0'):
            the_tags(' ');
          endif; ?>
        </div>
        <div class="col-sm-3 col-xs-12 share-social">
          <?php if (citysoul_check_option_theme('enable-social-single-blog') != '0'): ?>
            <ul class="citysoul-social social-round pull-right">
            <?php
                citysoul_get_template('core/layout/social-share');
            ?>
            </ul>
          <?php endif ?>
        </div>
    </div>
    <?php
  }
}

if ( ! function_exists( 'citysoul_after_content_single' ) ) {

  /**
   * Output the end of content single.
   *
   */
  function citysoul_after_content_single(){
    ?>
      </div>
    <?php
  }
}

if ( ! function_exists( 'citysoul_social_link' ) ) {

  /**
   * Output the end of content single.
   *
   */
  function citysoul_social_link($type='header'){
    if (citysoul_check_option_theme('show-social-link-'.$type)) {
      foreach(citysoul_check_option_theme('show-social-link-'.$type) as $key=> $social){
          if(citysoul_check_option_theme('beau-'.$social)){
              if (citysoul_check_option_theme('beau-'.$social) != '') {
                 echo '<li><a href="'.esc_url(citysoul_check_option_theme('beau-'.$social)).'" target="_blank"><i class="fa fa-'.esc_attr($social).'"></i></a></li>';
              }
          }
      }
    }
  }
}

if ( ! function_exists( 'citysoul_cover_page' ) ) {

  /**
   * Output the comment of content single.
   *
   */
  function citysoul_cover_page(){
    $description_header = $title_header = $show_cover_title_description = '';
    if (function_exists('get_field')) {
      $description_header = get_field('description_header');
      $title_header = get_field('title_header');
      $show_cover_title_description = get_field('show_cover_title_description');
    }
    $class = '';
    if(citysoul_get_field('header_remove_padding') != false) {
        $class = ' remove_h';
    }
    ?>
    <section class="citysoul-cover-page<?php echo esc_attr($class)?>">
      <?php
      if ( $show_cover_title_description != false && has_post_thumbnail() && is_page()): ?>
        <div class="citysoul-banner-page">
          <?php if( has_post_thumbnail() ) { ?>
            <div class="citysoul-banner-image">
              <?php echo get_the_post_thumbnail(); ?>
            </div>
          <?php } ?>
        <?php

        if (is_page()) {
          if ($show_cover_title_description != false) { ?>
                <div class="title-page-text text-center">
                  <?php if (get_the_title() != ''): ?>
                    <span class="text-title citysoul-title text-white text-5x"><?php echo esc_html($title_header)?></span>
                  <?php endif ?>
                  <div class="clearfix"></div>
                  <?php if ($description_header!= ''): ?>
                    <span class="text-title text-active text-1x">
                      <?php echo esc_html($description_header)?>
                    </span>
                  <?php endif ?>
                </div><!--End .title-page-->
          <?php }
        }
        ?>
        </div><!--End .banner-page-->
      <?php endif ?>
    </section>
    <?php
  }
}

if ( ! function_exists( 'citysoul_cover_page_shop' ) ) {

  /**
   * Output the comment of content single.
   *
   */
  function citysoul_cover_page_shop(){
    $show_cover_title_description = '';
    $page_id = get_option( 'woocommerce_shop_page_id' );
    $description_page = get_post_meta( $page_id, '_beautheme_description', TRUE );
    $show_cover_title_description = get_post_meta( $page_id, '_beautheme_show_cover_title_description', TRUE );

    if ($show_cover_title_description != 0 || $show_cover_title_description == '') { ?>
    <section class="citysoul-cover-page">
      <div class="citysoul-banner-page">
          <?php
            if( is_shop() ) {

              if( has_post_thumbnail( $page_id ) ) {
              ?>
                <div class="citysoul-banner-image">
                  <?php echo get_the_post_thumbnail( $page_id ); ?>
                </div>
              <?php
              }
            }
          ?>
          <div class="title-page-text text-center">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
              <span class="text-title citysoul-title text-white text-5x">
                <?php woocommerce_page_title(); ?>
              </span>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php if ($description_page!= ''): ?>
              <span class="text-title text-active text-1x">
               <?php echo esc_html($description_page)?>
              </span>
            <?php endif ?>
          </div><!--End .title-page-->
      </div><!--End .banner-page-->
    </section>
    <?php }
  }
}

if ( ! function_exists( 'citysoul_breadcrumb' ) ) {

  /**
   * Output the end of content single.
   *
   */
  function citysoul_breadcrumb(){
    $show_breadcrumb = citysoul_get_field('show_breadcrumb');
    $show_breadcrumb_single = citysoul_check_option_theme('enable-breadcrumb-single-blog');
    if (is_single()) {
      if ($show_breadcrumb_single != 0) {
        ?>
        <div class="breadcrumb">
          <div class="container">
              <?php if (function_exists('citysoul_the_breadcrumb')) citysoul_the_breadcrumb(); ?>
           </div>
        </div>
        <?php
      }
    }
    if (!is_single()) {
      if ($show_breadcrumb != 0){
      ?>
        <div class="breadcrumb">
          <div class="container">
              <?php if (function_exists('citysoul_the_breadcrumb')) citysoul_the_breadcrumb(); ?>
           </div>
        </div>
      <?php
      }
    }
  }
}

if ( ! function_exists( 'citysoul_get_product_title_product' ) ) {

  /**
   * Output the end of content single.
   *
   */
  function citysoul_get_product_title_product(){
    ?>
      <div class="product-title text-title">
        <a href="<?php echo get_the_permalink() ?>">
          <?php echo get_the_title() ?>
        </a>
      </div>
    <?php
  }
}

if ( ! function_exists( 'citysoul_get_tag_woocommerce' ) ) {

  /**
   * Output the end of content single.
   *
   */
  if (class_exists('WooCommerce')) {
      function citysoul_get_tag_woocommerce(){
        global $post, $product;
        $tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

        echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'citysoul' ) . ' ', '</span>' );
      }
  }
}

if ( ! function_exists( 'citysoul_get_categories_woocommerce' ) ) {

  /**
   * Output the end of content single.
   *
   */
  if (class_exists('WooCommerce')) {
      function citysoul_get_categories_woocommerce(){
        global $post, $product;
        $cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );

        echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'citysoul' ) . ' ', '</span>' );
      }
  }
}

if ( ! function_exists( 'citysoul_get_description_single_woocommerce' ) ) {

  /**
   * Output the end of content single.
   *
   */
  if (class_exists('WooCommerce')) {
      function citysoul_get_description_single_woocommerce(){
        ?>
        <div class="citysoul-product-description">
          <div class="title-box text-title text-active text-2x"><?php esc_html_e('Product description', 'citysoul') ?></div>
          <div class="product-description-text text-desc">
            <?php woocommerce_template_single_excerpt(); ?>
          </div>
        </div>
        <?php
      }
  }
}

if ( ! function_exists( 'citysoul_get_review_single_woocommerce' ) ) {

  /**
   * Output the end of content single.
   *
   */
  if (class_exists('WooCommerce')) {
      function citysoul_get_review_single_woocommerce(){
        echo comments_template( 'woocommerce/single-product-reviews' );
      }
  }
}

if ( ! function_exists( 'citysoul_get_link_view_product' ) ) {

  /**
   * Output the end of content single.
   *
   */
  if (class_exists('WooCommerce')) {
      function citysoul_get_link_view_product(){
        ?>
          <span class="view-product">
            <a href="<?php echo get_the_permalink() ?>">
              <?php echo esc_html_e('View detail', 'citysoul') ?>
            </a>
          </span>
        <?php
      }
  }
}
