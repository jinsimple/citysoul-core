<section class="dj-page <?php echo esc_attr($css_class); ?>" id="<?php echo esc_html($randomID);?>">
    <div class="container">
        <div class="citysoul-artis ">
            <ul class="citysoul-dj-list">
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
                <li class="citysoul-item-dj col-md-3 col-sm-3 col-xs-12 list-dj">
                    <div class="dj-avatar">
                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail() ?></a>
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
			<?php endwhile; ?>
            </ul>
        </div><!--End .citysoul-artis-->
    </div>
</section>