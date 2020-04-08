<section class="team-list <?php echo esc_html($css_class);?>">
    <div class="container">
        <div class="citysoul-team-list">
            <div class="title-team col-md-3 col-sm-3 col-xs-12">
                <div class="title-section">
                    <div class="citysoul-title text-title text-white text-5x"><?php echo esc_html($title_element) ?></div>
                    <div class="citysoul-desc text-title text-active"><?php echo esc_html($desc_element) ?></div>
                </div>
                <div class="clearfix"></div>
                <div class="next-back-team">
                     <div class="btn-next-back btn-next btn-team-next btn-team-next-<?php echo esc_attr($randomID);?>"></div>
                     <div class="btn-next-back btn-back btn-team-back btn-team-back-<?php echo esc_attr($randomID);?>"></div>
                </div><!--End .next-back-team-->
            </div><!--End .title-team-->
            <div class="team-slider col-md-9 col-sm-9 col-xs-12">
                <div class="swiper-container citysoul-team-slider citysoul-team-slider-<?php echo esc_attr($randomID);?>">
                    <div class="swiper-wrapper">

                    <?php 
                       if ($id_category != NULL) {
                            $args = array(
                                'post_type' => 'artist',
                                'posts_per_page' => $max_items,
                                'post__in'        => $inpost_id_list ,
                                'tax_query'         => array(
                                    array(
                                        'taxonomy'  => 'genres_artist',
                                        'field'     => 'id',
                                        'terms'     => $list_category_id,
                                    ),
                                ),
                            );
                        }
                        else{
                            $args = array(
                              'post_type' => 'artist',
                              'posts_per_page' => $max_items,
                              'post__in'        => $inpost_id_list,
                            );
                        }

                        $loop = new WP_Query( $args ); 
                        wp_reset_postdata();
                        while ($loop->have_posts())  : $loop->the_post() ;
                        $art_facebook = $art_twitter = $art_youtube = $art_soundcloud = '';
                        if (function_exists('get_field')) {
                            $art_facebook = get_field('art_facebook');
                            $art_twitter = get_field('art_twitter');
                            $art_youtube = get_field('art_youtube');
                            $art_soundcloud = get_field('art_soundcloud');
                        }
                    ?>

                        <div class="swiper-slide team-item">
                            <div class="slider-image">
                               <?php the_post_thumbnail(); ?>

                            </div><!--End .slider-image-->
                            <div class="info-slide">
                                <div class="info-member">
                                    <div class="text-title text-white text-3x click"><a href="<?php the_permalink();?>" ><?php the_title(); ?></a></div>
                                    <div class="text-more text-active text-16x">                            
                                    <?php if (function_exists('beau_theme_plugin_init')) {
                                        echo citysoul_get_taxonomy_list_by_post_id('genres_artist',get_the_ID());
                                    }?>
                                    </div>
                                    <div class="text-desc"><?php the_field('art_description');?></div>
                                    <div class="clearfix"></div>
                                    <ul class="citysoul-social social-round">
                                        <?php if($art_facebook != null) : ?>
                                        <li><a href="<?php echo esc_url($art_facebook);?>" class="fa fa-facebook"></a></li>
                                        <?php endif;?>
                                        <?php if($art_twitter !=null) : ?>
                                        <li><a href="<?php echo esc_url($art_twitter);?>" class="fa fa-twitter"></a></li>
                                        <?php endif;?>
                                        <?php if($art_youtube !=null) : ?>
                                        <li><a href="<?php echo esc_url($art_youtube);?>" class="fa fa-youtube"></a></li>
                                        <?php endif;?>
                                        <?php if($art_soundcloud !=null) : ?>
                                        <li><a href="<?php echo esc_url($art_soundcloud);?>" class="fa fa-soundcloud"></a></li>
                                        <?php endif;?>
                                    </ul>
                                </div><!--End .info-member-->
                            </div><!--End .info-slide-->
                        </div><!--End .team-item-->
                        
                    <?php endwhile; ?>
                    </div>

                </div>
            </div><!--End .team-slider-->
            <?php 
            /*
             * citysoul_list_dj_script - 10
             */
                do_action( 'citysoul_list_dj_script_hook', $randomID);
            ?>
        </div><!--End .citysoul-team-list-->
    </div>
</section><!--End .team-list-->