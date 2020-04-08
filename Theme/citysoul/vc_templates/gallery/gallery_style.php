<section class="gallery <?php echo esc_html($css_class);?> " id="<?php echo esc_attr($randomID);?>">
    <div class="container no-padding">
        <div class="box-gallery">
            <div class="title-gallery gallery-item col-md-3 col-sm-3 col-xs-12">
                <div data-color="sh_title" class="citysoul-title text-title text-white"><?php echo empty($title_element)?esc_html__('gallery','citysoul'):esc_html($title_element); ?></div>
                <div data-color="sh_desc" class="citysoul-desc text-active text-title"><?php echo empty($title_desc)?esc_html__('we have painted the picture','citysoul'):esc_html($title_desc); ?></div>
                <div class="text-more view-all-link"><?php if($sh_link_url != NULL) :?><a data-color="sh_more" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?></a><?php endif;?></div>
            </div>

            <?php
            $loop = new WP_Query($args);
            wp_reset_postdata();
            $i = 1;
            $style = $abc = '';
            while ($loop->have_posts())  : $loop->the_post() ;
                if ($i== 1) {
                    $style = 'gallery-small pull-left ';
                    $abc = 3;
                } elseif ($i == 2) {
                    $style = 'gallery-small-wide gal-item-big pull-right';
                    $abc = 6;
                } elseif ($i == 3) {
                    $style = 'gallery-small-wide  gal-item pull-left';
                    $abc = 6;
                } else{
                    $style = 'hidden';
                }

             ?>
            <div class="<?php echo esc_html($style);?> gallery-item col-sm-<?php echo esc_html($abc);?> col-xs-12"><div class="gal-image"><a href="<?php echo get_permalink();?>" target="_blank" title="<?php echo get_the_title(get_the_ID()); ?>"><?php echo get_the_post_thumbnail(get_the_ID()); ?></a></div>
                    <div data-color="sh_name" class="gal-info text-center">
                        <?php echo citysoul_time_link(); ?>
                       <a href="<?php echo get_permalink();?>" target="_blank" class="text-title title-gallery-item text-white" title="<?php echo get_the_title(get_the_ID()); ?>"><?php echo get_the_title(get_the_ID()); ?></a></p>
                    </div>

            </div><!--End .gallery-item-->

            <?php

            if($i == 3) {
                break;
            }
            $i++;
            endwhile;

             ?>

        </div><!--End .box-gallery-->
    </div>
</section>
