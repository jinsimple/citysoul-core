<section class="dj-page">
    <div class="container">
        <div class="citysoul-artis <?php echo esc_attr($css_class); ?>">
            <ul class="citysoul-dj-list hight">
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
                $i = 1;
                while ($loop->have_posts())  : $loop->the_post() ;
                if($i == 1) $class = '6 big-img';
                else $class = '3 small-dj';
            ?>
                <li class="citysoul-item-dj col-sm-<?php echo esc_html($class);?> col-xs-12">
                    <div class="dj-avatar">
                        <a href="<?php the_permalink()  ?>"><?php the_post_thumbnail() ?></a>
                    </div><!--End .dj-avatar-->
                    <div class="dj-information text-center">
                        <div class="dj-name-inner text-4x text-white text-title"><a href="<?php the_permalink()  ?>" class="text-white"><?php the_title(); ?></a></div>
                        <div class="dj-tags text-16x text-active text-more">
                        <?php if (function_exists('beau_theme_plugin_init')) {
                            echo citysoul_get_taxonomy_list_by_post_id('genres_artist',get_the_ID());
                        }?>
                        </div>
                        <div class="dj-description text-desc"><?php the_field('art_description');?></div>
                    </div><!--End .dj-information-->
                    <div class="dj-name text-active text-title"><?php the_title(); ?></div>
                </li>  
            <?php 
            $i++;
            endwhile; ?>
            </ul>
        </div><!--End .citysoul-artis-->
    </div>
</section>
