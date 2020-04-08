<section class="snack-list <?php echo esc_html($css_class);?>" id="<?php echo esc_attr($randomID);?>">
    <div class="citysoul-snack-list">
        <div class="container">
            <div class="citysoul-title-box-menu text-center">
            <?php if($title_element != ''): ?>
                <div class="snack-title text-title citysoul-title text-7x"><?php echo esc_html($title_element); ?></div>
            <?php endif; ?>
            <?php if($title_desc != ''): ?>
                <div class="text-main-list view-all-link text-more"><?php echo esc_html($title_desc); ?></div>
            <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <ul class="list-snack-view">
            <?php 
            $args = array(
                'post_type' => 'fooddrink',
                'post_category' => $show_cat,
                'posts_per_page' => $max_items,
            );

             $loop = new WP_Query( $args ); 
             wp_reset_postdata();
             while ($loop->have_posts())  : $loop->the_post() ;
             ?>
                <li>
                    <span class="title-snack text-title text-white"><?php the_title(); ?></span><em class="text-more"> <?php echo esc_html('/', 'citysoul') ?> <?php the_field('fooddrink_description')?> </em>
                    <?php 
                    if (function_exists('get_field')) {
                        if(!empty(get_field('fooddrink_price'))) { ?>
                        <span class="snack-price text-title text-active pull-right"><?php echo esc_html('$', 'citysoul') ?><?php the_field('fooddrink_price')?></span>
                        <?php }else{ ?>
                        <span class="snack-price text-title text-active pull-right"><?php echo esc_html('N/A', 'citysoul'); ?></span>
                        <?php } 
                    }
                    ?>
                </li>
                <?php endwhile; ?>

            </ul>

        </div>
    </div><!--End .citysoul-snack-list-->
</section>
