<?php
/**
 * @option Style 2
 */
$loop = new WP_Query($args);
wp_reset_postdata();
if($loop->have_posts()):
    $arr = array();
    while($loop-> have_posts()) : $loop->the_post();
            $arr[] = get_the_ID();
    endwhile;

?><div id="<?php echo esc_attr($randomID);?>" class="galleryh3 <?php echo esc_html($css_class);?>">
    <div class="galleryh3__content">
        <div class="galleryh3__item col-md-3 col-xs-12">
            <div class="galleryh3__item__image"><a href="<?php echo get_permalink($arr[0])?>" title="<?php echo get_the_title($arr[0])?>" target="_blank"><?php
                                  if( has_post_thumbnail() ) {
                                    echo citysoul_get_the_post_lazyload_thumbnail($arr[0], 'full');
                                  } ?></a></div>
            <div data-color="sh_name" class="galleryh3__item__title"><a href="<?php echo get_permalink($arr[0])?>" title="<?php echo get_the_title($arr[0])?>" target="_blank"><?php echo get_the_title($arr[0])?></a></div>
            <div data-color="sh_date" class="galleryh3__item__date"><?php echo date_i18n((get_option('date_format')),strtotime(citysoul_get_field('date_event',$arr[0]))); ?></div>
        </div>
        <div class="galleryh3__item galleryh3__item--element col-md-3 col-xs-12">
            <div class="galleryh3__item--element__title"><?php echo empty($title_element)?esc_html__('gallery','citysoul'):esc_html($title_element); ?></div>
            <div data-color="sh_desc" class="galleryh3__item--element__desc"><?php echo empty($title_desc)?esc_html__('we have painted the picture','citysoul'):esc_html($title_desc); ?></div>
            <div class="galleryh3__item--element__more"><?php if($sh_link_url != NULL) :?><a data-color="sh_more" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?></a><?php endif;?></div>
        </div>
        <div class="galleryh3__item  galleryh3__item--big col-md-6 col-xs-12">
            <div class="galleryh3__item__image galleryh3__item__image--big"><a href="<?php echo get_permalink($arr[0])?>" title="<?php echo get_the_title($arr[1])?>" target="_blank"><?php
                                  if( has_post_thumbnail() ) {
                                    echo citysoul_get_the_post_lazyload_thumbnail($arr[1], 'full');
                                  } ?></a></div>
            <div data-color="sh_name" class="galleryh3__item__title galleryh3__item__title--big"><a href="<?php echo get_permalink($arr[1])?>" title="<?php echo get_the_title($arr[1])?>" target="_blank"><?php echo get_the_title($arr[1])?></a></div>
            <div data-color="sh_date" class="galleryh3__item__date galleryh3__item__date--big"><?php echo date_i18n((get_option('date_format')),strtotime(citysoul_get_field('date_event',$arr[1]))); ?></div>
        </div>
         <?php
             unset($arr[0],$arr[1]);
             foreach ($arr as $x => $s) :
        ?>
        <div class="galleryh3__item col-md-3 col-xs-12">
            <div class="galleryh3__item__image"><a href="<?php echo get_permalink($s)?>" title="<?php echo get_the_title($s)?>" target="_blank"><?php
                                  if( has_post_thumbnail() ) {
                                    echo citysoul_get_the_post_lazyload_thumbnail($s, 'full');
                                  } ?></a></div>
            <div data-color="sh_name" class="galleryh3__item__title"><a href="<?php echo get_permalink($s)?>" title="<?php echo get_the_title($s)?>" target="_blank"><?php echo get_the_title($s)?></a></div>
            <div data-color="sh_date" class="galleryh3__item__date"><?php echo date_i18n((get_option('date_format')),strtotime(citysoul_get_field('date_event',$s))); ?></div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<?php endif;