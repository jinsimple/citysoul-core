<?php 

     $option = $option_data = $option_nav = $title_heading = $text_store = $link_store = $product_id = $id_category = $per_page = '';
     $title_color = $border_color_item = $title_heading_color = $text_store_color = $title_product_color = $text_info_color = $bg_item_color = $text_date_color = $text_day_color = $text_price_color = $text_star_color = $css = '';

    extract(shortcode_atts(array(
                'option'            =>  '',
                'option_data'       =>  '',
                'option_nav'        =>  '',
                'title_heading'     =>  '',
                'text_store'        =>  '', 
                'link_store'        =>  '',
                'product_id'        =>  '',
                'id_category'       =>  '',
                'per_page'          =>  '',
                'title_heading_color'=>  '',
                'text_store_color'  =>  '',
                'title_product_color'=>  '',
                'text_info_color'   =>  '',
                'bg_item_color'     =>  '',               
                'title_color'       =>  '',
                'text_date_color'   =>  '',
                'text_day_color'   =>  '',
                'text_star_color'   =>  '',
                'text_price_color'  =>  '',
                'border_color_item' =>  '',
                'css'               =>  '',
                ),
        $atts)
    );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$id_ran = rand(1, 99999);
$randomID   =  'product_slider_'.$id_ran;
$list_category_id = '';
$id_product = '';
if($per_page == ''){
    $per_page = '3';
}
if ($product_id != NULL) {
  $id_product = explode(',', $product_id);
}

if ($id_category != NULL) {
    $list_category_id = explode(',', $id_category);
}
//Setup style for shortcode
$setup      = array(
    '.text-7x'              =>  array(
            'color'         =>  $title_heading_color,
        ),
    '.citysoul-title' =>  array(
            'color'         =>  $title_heading_color,
        ),
    '.citysoul-title-shop' =>  array(
            'color'         =>  $title_heading_color,
        ),
    
    '.border-image:before ' =>  array(
            'border-color'  =>  $border_color_item,
        ), 
    array(
            'background'    =>  $bg_item_color,
        ),
    '.citysoul-buy-over'    =>  array(
            'background'    =>  $bg_item_color,
        ),
    '.shop-date em'         =>  array(
        'color'             =>  $text_day_color,
        ),
    '.shop-date stong'      =>  array(
        'color'             =>  $text_date_color,
        ),
    '.title-shop'           => array(
        'color'             => $title_product_color,
        ),
     '.product-title'       => array(
        'color'             => $title_product_color,
        ),
    '.desc-product'         => array(
        'color'             => $text_info_color,
        ),
    '.shop-more a'          =>  array(
        'color'             =>  $text_store_color,
        ),
    '.product-ratting '      =>  array(
        'color'             =>  $text_star_color,
        ),
    '.product-price *'        =>  array(
        'color'             =>  $text_price_color,
        ),
    
    '.citysoul-desc a'      =>  array(
        'color'             =>  $text_store_color,
        ),

);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);
if ($id_category != NULL) {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $per_page,
        'post__in'        => $id_product,
        'tax_query'         => array(
            array(
                'taxonomy'  => 'product_cat',
                'field'     => 'id',
                'terms'     => $list_category_id,
            ),
        ),
    );
}
else{
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => $per_page,
      'post__in'        => $id_product,
    );
}
$loop = new WP_Query( $args );
wp_reset_postdata();
if($option_nav == ''){
    $option_nav == 'enable';
}
if($title_heading == "") {
    $title_heading = esc_html__('Shop','citysoul');
}
if($text_store == "") {
    $text_store = esc_html__('Go to Store','citysoul');
} 
if($option == '') {
    $option = 'single';
}
if($option == 'single'){
?>
<section class="shop-slider <?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr($randomID);?>">
    <div class="container">
        <div class="citysoul-shop-slider">
            <div class="citysoul-title-shop">
                <div class="citysoul-title text-title title-7x text-title-shop"><?php echo esc_html($title_heading);?></div>
            </div>
            <div class="swiper-container shop-slider-view shop-slider-view-<?php echo esc_attr($id_ran);?>">
                <div class="swiper-wrapper">
                <?php while ($loop->have_posts()) : $loop->the_post();
                global $product;
                $price = $product->get_price_html();
                ?>
                    <div class="swiper-slide citysoul-shop-item">
                        <div class="shop-item-text">
                            <div class="border-image">
                                <div class="item-shop-image">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank"><?php echo get_the_post_thumbnail(get_the_ID());?></a>
                                </div>
                            </div><!--End .item-shop-image-->
                            <div class="item-shop-info">
                                <?php echo citysoul_time_link(); ?>
                                <div class="citysoul-title text-2x text-title text-dark title-shop"><?php the_title() ?></div><!--End .citysoul-title-->
                                <div class="desc-small desc-product text-desc"><?php the_content();?></div>
                                <div class="shop-price text-title os-font bold text-active text-4x"><?php print($price);?></div>
                                <div class="shop-more view-all-link"><a class="text-more" href="<?php echo esc_html($link_store);?>"><?php echo esc_html($text_store);?></a></div>
                            </div><!--End .item-shop-info-->
                        </div><!--End .shop-item-text-->
                    </div><!--End .citysoul-shop-item-->
                <?php endwhile;?>
                </div>
                <div class="swiper-pagination shop-pagging shop-pagging-<?php echo esc_attr($id_ran);?>"></div>
            </div>
            <?php 
            /*
             * citysoul_shop_slide_view - 10
             */
                do_action( 'citysoul_shop_slide_view_hook', $id_ran);
            ?>
        </div>
    </div>
</section><!--End .shop-slider-->
<?php } 
else {

?>

<section class="more-product" id="<?php echo esc_attr($randomID);?>">
    <div class="container">
        <div class="citysoul-more-product">
            <div class="title-section text-center">
                <div class="citysoul-title text-title text-white"><?php echo esc_html($title_heading);?></div>
                <div class="citysoul-desc text-title text-active"><a href="<?php echo esc_html($link_store);?>"><?php echo esc_html($text_store);?></a></div>
            </div>
            <div class="clearfix"></div>
            <div class="citysoul-more-product-slide">
                <div class="shop-slider-list shop-slider-list-<?php echo esc_attr($id_ran);?> swiper-container">
                    <ul class="more-product-list citysoul-product-list swiper-wrapper">
                    <?php   
                        while ($loop->have_posts()) : $loop->the_post();
                        global $product;
                        $price  = $product->get_price_html();
                        $cart   =  $product->add_to_cart_url();  

                    ?>       
                        <li class="citysoul-product-item swiper-slide">
                            <div class="product-item-info">
                                <div class="citysoul-buy-over">
                                    <span class="view-product">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html__('View detail','citysoul');?></a></span>
                                    <a href="<?php echo esc_url($cart);?>" class="citysoul-button citysoul-button-o text-white text-title"><?php echo esc_html__('Add to cart','citysoul');?></a>

                                </div>
                                <div class="product-ratting">
                                <?php 
                                    global $woocommerce, $product;
                                    $html = $product->get_rating_html();
                                    if($html ==''){
                                        $html = '<div class="star-rating" title="Rated 0 out of 5"><span style="width:0%"><strong class="rating">0</strong> out of 5</span></div>';
                                    }
                                    print($html);
                                ?>  
                                </div>
                                <div class="product-img">
                                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_post_thumbnail(get_the_ID());?></a>
                                </div>
                                <div class="product-info">
                                    <div class="product-title text-title"><?php the_title() ?></div>
                                    <div class="product-price text-title text-2x text-active"><?php print($price);?></div>
                                </div>
                            </div><!--End .product-item-info-->
                        </li>
                    <?php endwhile;?>
                    </ul><!--End .slider shop-->
                </div><!--End .shop-slider-list-->
                <?php if($option_nav == 'enable' || $option_nav == '') :?>
                <div class="btn-next-back btn-next btn-morepro-next btn-morepro-next-<?php echo esc_attr($id_ran);?>"></div>
                <div class="btn-next-back btn-back btn-morepro-back btn-morepro-back-<?php echo esc_attr($id_ran);?>"></div>
                <?php endif;?>
            </div><!--End .citysoul-more-product-slide-->
            <?php 
            /*
             * citysoul_shop_slide_list - 10
             */
                do_action( 'citysoul_shop_slide_list_hook', $id_ran);
            ?>
        </div><!--End .citysoul-more-product-->
    </div>
</section>
<?php }