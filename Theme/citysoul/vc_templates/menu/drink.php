
<section class="drink-list <?php echo esc_html($css_class);?>" id="<?php echo esc_attr($randomID); ?>">
    <div class="citysoul-drink-list">
        <div class="container">
            <div class="citysoul-title-box-menu text-center">
            <?php if($title_element != ''): ?>
                <div class="drink-title text-title citysoul-title text-7x"><?php echo esc_html($title_element); ?></div>
            <?php endif; ?>
            <?php if($title_desc != ''): ?>
                <div class="text-main-list view-all-link text-more"><?php echo esc_html($title_desc); ?></div>
            <?php endif; ?>
            </div>
            <div class="clearfix"></div>
            <ul class="list-drink">
            
            <?php 
                $args = array(
                    'post_type' => 'fooddrink',
                    'post_category' => $show_cat,
                    'posts_per_page' => $max_items,
                );

                 $loop = new WP_Query( $args );
                 wp_reset_postdata();
                    $i = 1;
                    $style = $text = ''; 
                    
                    while ($loop->have_posts())  : $loop->the_post() ;
                    if($i == 1 ) {
                        $style = 'big-drink drink-item col-sm-5';
                        $text = 'text-5x';
                    } else{
                        $style = 'small-drink drink-item col-sm-2';
                        $text = 'text-16x';
                    }
                
            ?>
                <li class="<?php echo esc_html($style);?> col-xs-12">
                    <div class="iamage-drink"><?php the_post_thumbnail(); ?></div>
                    <div class="title-drink">
                        <span class="text-title <?php echo esc_html($text);?>"><?php the_title(); ?></span>
                        <?php 
                        if (function_exists('get_field')) {
                            if(!empty(get_field('fooddrink_price'))) { ?>
                            <p class="citysoul-date text-active"><em class="text-more"><?php the_field('fooddrink_units'); ?> <?php echo esc_html(' /','citysoul'); ?></em> <strong class="text-title"><?php echo esc_html('$', 'citysoul'); ?><?php the_field('fooddrink_price') ?></strong></p>
                            <?php }else{ ?>
                            <p class="citysoul-date text-active"><strong class="text-title"><?php echo esc_html('N/A', 'citysoul') ?></strong></p>
                            <?php } 
                        }
                        ?>
                    </div>
                </li>
            <?php 
            $i++;
            endwhile; ?>

            </ul>
        </div>
    </div><!--End .citysoul-drink-list-->
</section>