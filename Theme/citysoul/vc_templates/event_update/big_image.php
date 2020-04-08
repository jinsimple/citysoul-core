<?php
/**
 * @option Big Single Image
 */
$sh_link    =  vc_build_link($list_event_link);
$sh_link_url = $sh_link['url'];
$sh_link_title = $sh_link['title'];
$sh_link_target = $sh_link['target'];
$sh_link_rel = $sh_link['rel'];
if($sh_link['target'] == ' _blank'){
    $sh_link_target = ' target="_blank"';
}
if($sh_link['rel'] == 'nofollow'){
    $sh_link_rel = ' rel="nofollow"';
}
if($sh_link['title'] == ''){
    $sh_link_title = esc_html__('View Calendar', 'citysoul');
}
$list_id ='';
if($max_items_big == ''){
    $max_items_big = '3';
}
if($max_items_big < 3 ){
    $max_items_big = '3';
}
if($max_items_big > 7 ){
    $max_items_big = '7';
}
if($in_id != NULL) {
    $list_id = explode(',', $in_id);
}
if($list_id == NULL && $in_category == NULL) {
    $args = array(
      'post_type'           => 'event',
      'posts_per_page'      => $max_items_big,
      'order'               => 'ASC',
      'orderby'             => 'meta_value_num',
      'meta_key'            => 'date_event',
    );
} else {
    if($in_category != NULL) {
        $args = array(
            'post_type'           => 'event',
            'posts_per_page'      =>  $max_items_big,
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
            'posts_per_page'      => $max_items_big,
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
    $color_viewmore_hover = array();
    if($color_viewmore != NULL) {
        $color_viewmore_hover = array(
            'opacity'   =>  '0.5',
            );
    }
    $setup = array(
        '[data-color="sh_title"]'       =>  array(
                'color'                 =>  $color_title,
            ),
        '[data-color="sh_more"]'        =>  array(
                'color'                 =>  $color_viewmore,
            ),
        '[data-color="sh_more"]:hover'  =>  $color_viewmore_hover,
        '[data-color="sh_name"] a'      =>  array(
                'color'                 =>  $color_name,
            ),
        '[data-color="sh_number"]'      =>  array(
                'color'                 =>  $color_number,
            ),
        '[data-color="sh_date"]'        =>  array(
                'color'                 =>  $color_active,
            ),
        '.event__by__name'              =>  array(
                'color'                 =>  $color_active,
            ),
        '.event__by__job'               =>  array(
                'color'                 =>  $color_jobs,
            ),
        '.event__element__more:before'  =>  array(
                'background'            =>  $color_active,
            ),
        '.event__content--left'         =>  array(
                'background'            =>  $color_block,
            ),
        );
    echo citysoul_css_shortcode($randomID, $setup);
    $arr = array();
    while($loop-> have_posts()) : $loop->the_post();
            $arr[] = get_the_ID();
    endwhile;
?>
<div id="<?php echo esc_attr($randomID);?>" class="event <?php echo esc_attr( $css_class ); ?>">
        <div class="event__element">
            <div data-color="sh_title" class="event__element__title"><?php if($list_event_title != NULL) : print($list_event_title); endif;?></div>
            <div class="event__element__more"><?php if($sh_link_url != NULL) :?><a data-color="sh_more" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?></a><?php endif;?></div>
        </div>
        <div class="event__content event__content--left col-md-6 col-xs-12">
            <div class="event__item event__item--left col-xs-12">
                <div class="event__image"><?php
                                  if( has_post_thumbnail() ) {
                                    echo citysoul_get_the_post_lazyload_thumbnail($arr[0], 'full');
                                  } ?></div>
                <div data-color="sh_number" class="event__number event__number--left"><?php esc_html_e('01','citysoul')?></div>
                <div data-color="sh_name" class="event__title event__title--left"><a href="<?php echo get_permalink($arr[0])?>" title="<?php echo get_the_title($arr[0])?>" target="_blank"><?php echo get_the_title($arr[0])?></a></div>
                <div data-color="sh_date" class="event__date event__date--left"><?php echo date_i18n((get_option('date_format')),strtotime(citysoul_get_field('date_event',$arr[0]))); ?></div>
            </div>
        </div>
        <div class="event__content event__content--right col-md-6 col-xs-12">
            <?php unset($arr[0]);
                $i=2;
                foreach ($arr as $x => $s) :
                    $i = ($i <= 9)?'0'.$i:$i;
                    $artist = citysoul_get_field('choose_artis',$s);
            ?>
            <div class="event__item col-md-6 col-xs-12">
                 <div data-color="sh_number" class="event__number"><?php print($i)?></div>
                 <div data-color="sh_date"  class="event__date"><?php echo date_i18n((get_option('date_format')),strtotime(citysoul_get_field('date_event',$s))); ?></div>
                 <div data-color="sh_name" class="event__title"><a href="<?php echo get_permalink($s)?>" title="<?php echo get_the_title($s)?>" target="_blank"><?php echo get_the_title($s)?></a></div>
                 <div class="event__by"><?php if($artist != NULL) : $job = citysoul_get_field('art_job',$artist[0]); ?><?php if($job != NULL ){ ?><span class="event__by__job"><?php print($job);?> /</span><?php } ?><span class="event__by__name"><?php echo get_the_title($artist[0]);?></span><?php endif;?></div>
             </div>
            <?php $i++;endforeach;?>
         </div>
</div>
<?php
endif;