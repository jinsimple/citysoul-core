<?php
/**
 * @option Slider
 */
$list_id ='';
if($max_items == ''){
    $max_items = '4';
}
if($max_items < 4 ){
    $max_items = '4';
}
if($in_id != NULL) {
    $list_id = explode(',', $in_id);
}
if($list_id == NULL && $in_category == NULL) {
    $args = array(
      'post_type'           => 'event',
      'posts_per_page'      => $max_items,
      'order'               => 'ASC',
      'orderby'             => 'meta_value_num',
      'meta_key'            => 'date_event',
    );
} else {
    if($in_category != NULL) {
        $args = array(
            'post_type'           => 'event',
            'posts_per_page'      =>  $max_items,
            'order'               => 'ASC',
            'orderby'             => 'meta_value_num',
            'meta_key'            => 'date_event',
            'tax_query'           => array(
                array(
                    'taxonomy'      => 'category_event',
                    'field'         => 'slug',
                    'terms'         => $in_category,
                ),
            ),
        );
    }
    else {
         $args = array(
            'post_type'           => 'event',
            'posts_per_page'      => $max_items,
            'post__in'            => $list_id,
            'order'               => 'ASC',
            'orderby'             => 'meta_value_num',
            'meta_key'            => 'date_event',
        );
    }
}
$loop = new WP_Query( $args );
wp_reset_postdata();
if($loop->have_posts()):
$element = 'slider_'.$randomID;
    $color_hover =  array();
    $color_op = '';
    if($color_nav != NULL) {
        $color_hover = array(
            'opacity'   =>  '1',
            );
        $color_op = '0.5';
    }
    $setup = array(
        '.btn-next-back'                =>  array(
                'border-color'          =>  $color_nav,
                'color'                 =>  $color_nav,
                'opacity'               =>  $color_op,
            ),
        '.btn-next-back:hover'                =>  $color_hover,
        );
    echo citysoul_css_shortcode($randomID, $setup);
?>
<div id="<?php echo esc_attr($randomID);?>" class="upcomming-slider-top <?php echo esc_attr( $css_class ); ?>">
    <div class="swiper-container citysoul-upcomming-top" data-citysoul="<?php echo esc_attr($element)?>">
        <div class="swiper-wrapper">
            <?php while ($loop->have_posts())  : $loop->the_post() ; ?>
            <div class="swiper-slide upcomming-item">
                <div class="slider-image">
                   <a href="<?php echo get_permalink()?>" title="<?php echo get_the_title()?>" target="_blank"><?php
                                  if( has_post_thumbnail() ) {
                                    echo citysoul_get_the_post_lazyload_thumbnail(get_the_ID(),'full');
                                  } ?></a>
                </div><!--End .slider-image-->
            </div>
            <?php endwhile;?>
        </div>
        <div class="btn-next-back btn-next" data-citysoul-btn="next-<?php echo esc_attr($element)?>"></div>
        <div class="btn-next-back btn-back" data-citysoul-btn="prev-<?php echo esc_attr($element)?>"></div>
    </div><!--End .upcomming-slider-top-->
</div><!--End upcomming-slider-->
<?php
do_action('citysoul_js_slider_event_hook',$element);
endif;