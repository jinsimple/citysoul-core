<section id="<?php echo esc_attr($randomID);?>" class="gallery-page <?php echo esc_html($css_class);?>">
    <div class="container">
        <div class="citysoul-gallery">
            <ul class="citysoul-gallery-list">

            <?php
            $loop = new WP_Query($args);
            wp_reset_postdata();
            while ($loop->have_posts())  : $loop->the_post() ;
            $style = $text = '';
            if (function_exists('get_field')) {
                if( get_field('itemgl_check_box') != NULL) {
                    $style = 'big-item col-md-6 col-sm-6';
                    $text = 'text-4x';
                } else{
                    $style = 'col-md-3 col-sm-3';
                    $text = 'text-16x text-center';
                }
            }
            ?>
                <li class="citysoul-item-gallery <?php echo esc_attr($style);?> col-xs-12">
                    <div class="items-gallery">
                        <a href="<?php echo get_permalink(); ?>">
                            <div class="feature-gallery-image">
                                <?php echo get_the_post_thumbnail(); ?>
                            </div><!--End .feature-gallery-image-->
                        </a>
                        <div data-color="sh_name" class="info-item">
                            <a href="<?php the_permalink(); ?>" class="title-gal text-white text-title <?php echo esc_attr($text);?>"><?php the_title(); ?></a>
                            <?php echo citysoul_time_link(); ?>
                        </div><!--End .info-item-->
                    </div><!--End .items-gallery-->
                </li>
            <?php endwhile; ?>
            </ul>
        </div><!--End .citysoul-artis-->
    </div>
</section>