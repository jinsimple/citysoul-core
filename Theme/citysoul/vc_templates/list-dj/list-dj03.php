<section class="other-artist <?php echo esc_html($css_class);?>">
    <div class="container">
        <div class="citysoul-artist-list">
            <div class="citysoul-title-half title-opacity text-center">
                <div class="citysoul-title text-opacity text-title text-7x text-white"><?php echo esc_html($title_element);?></div>
                <div class="citysoul-tags main-text text-more text-16x"><?php echo esc_html($desc_element); ?></div>
            </div><!--End .title-half-->
            <div class="clearfix"></div>
            <div class="other-artist-list">
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
            ?>
                <div class="artist-item col-md-3 col-sm-3 col-xs-12 all-list">
                    <div class="img-artist">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="artist-name text-active text-title text-16x"><a href="<?php the_permalink()  ?>"><?php the_title(); ?></a></div>
                </div><!--End .artist-item-->  
                <?php endwhile; ?>              
            </div><!--End .other-artist-slider-->
        </div><!--End .citysoul-artist-slide-->
    </div>
</section>