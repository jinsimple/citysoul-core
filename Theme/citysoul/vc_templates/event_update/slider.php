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
        '[data-color="sh_title"]'       =>  array(
                'color'                 =>  $color_title,
            ),
        '[data-color="sh_desc"]'        =>  array(
                'color'                 =>  $color_active,
            ),
        '[data-color="sh_name"] a'      =>  array(
                'color'                 =>  $color_name,
            ),
        '[data-color="sh_date"]'        =>  array(
                'color'                 =>  $color_active,
            ),
        '.btn-next-back'                =>  array(
                'border-color'          =>  $color_nav,
                'color'                 =>  $color_nav,
                'opacity'               =>  $color_op,
            ),
        '.btn-next-back:hover'                =>  $color_hover,
        );
    echo citysoul_css_shortcode($randomID, $setup);
?><div id="<?php echo esc_attr($randomID);?>" class="event event--slide <?php echo esc_attr( $css_class ); ?>">
        <div class="event__element event__element--slide">
            <div data-color="sh_title" class="event__element__title event__element__title--slide"><?php if($list_event_title != NULL) : print($list_event_title); endif;?></div>
            <div data-color="sh_desc" class="event__element__desc event__element__desc--slide"><?php if($list_event_desc != NULL) : print($list_event_desc); endif;?></div>
        </div>
    <div class="swiper-container event__content event__content--slide" data-citysoul="<?php echo esc_attr($element)?>">
        <div class="swiper-wrapper">
            <?php while ($loop->have_posts())  : $loop->the_post() ; ?>
            <div class="swiper-slide event__item event__item--slide">
                <div class="event__image event__image--slide"><a href="<?php echo get_permalink()?>" title="<?php echo get_the_title()?>" target="_blank"><?php
                                  if( has_post_thumbnail() ) {
                                    echo citysoul_get_the_post_lazyload_thumbnail(get_the_ID(),'full');
                                  } ?></a></div>
                <div data-color="sh_date" class="event__date event__date--slide"><?php echo date_i18n((get_option('date_format')),strtotime(citysoul_get_field('date_event'))); ?></div>
                <div data-color="sh_name" class="event__title event__title--slide"><a href="<?php echo get_permalink()?>" title="<?php echo get_the_title()?>" target="_blank"><?php echo get_the_title()?></a></div>
            </div>
            <?php endwhile;?>
        </div>
    </div>
    <div class="btn-next-back btn-next" data-citysoul-btn="next-<?php echo esc_attr($element)?>"></div>
    <div class="btn-next-back btn-back" data-citysoul-btn="prev-<?php echo esc_attr($element)?>"></div>
</div>
<?php
do_action('citysoul_js_slider_event_hook',$element);
endif;