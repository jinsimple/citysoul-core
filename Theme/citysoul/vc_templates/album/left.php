<?php
    $j= 1;
    $loop = new WP_Query($args);
    wp_reset_postdata();
    while ($loop->have_posts())  : $loop->the_post() ;
    $id[] = get_the_ID();
    $url_sound = citysoul_get_field('item_url', get_the_ID());
?>
<section class="track-list full_track <?php echo esc_html($css_class);?>" id="<?php echo esc_html($randomID);?>">
    <div class="citysoul-track-list">
        <div class="cover-text col-md-6 col-sm-6 col-xs-12">
            <div class="images-podcast">
                <?php echo get_the_post_thumbnail(get_the_ID()); ?>
                <span class="text-name text-title">                
                    <strong class="text-title text-bg"><?php echo esc_html__('01', 'citysoul'); ?></strong>
                    <h1 id="posc" class="text-white text-over text-7x"><?php the_title(); ?></h1>
                </span>
            </div>
        </div><!--End .cover-text-->
        <div class="track-play-list col-md-6 col-sm-6 col-xs-12">
            <div class="citysoul-list-play">
                <div class="title-track text-active">
                    <span class="text-title text-2x"><?php echo esc_html__('track list','citysoul');?></span>
                    <span class="text-more">/ <?php echo esc_html__('SoundCloud','citysoul');?></span>
                </div><!--End .title-track-->
                <div class="clearfix"></div>
                <!-- Play list one -->
                <?php if($url_sound != '') { ?>
                <?php $sc = wp_oembed_get($url_sound);
                $sc = str_replace('true', 'false', $sc);
                print($sc); ?>
                <?php }else{ ?>
                    <?php 
                   
                    while( have_rows('list_song', get_the_ID())) : the_row() ;
                    $url_mp3 = get_sub_field('item_file')['url'];
                     ?>
                <div id="citysoul_player_<?php echo esc_html($j);?>" class="jp-jplayer"></div>
                <div id="citysoul_container_<?php echo esc_html($j);?>" class="jp-audio" role="application" aria-label="media player">
                    <div class="jp-type-playlist">
                        <div class="jp-gui jp-interface">
                            <div class="jp-controls">
                                <button class="jp-previous" data-next="" role="button" tabindex="0"></button>
                                <button class="jp-play" role="button" tabindex="0"></button>
                                <button class="jp-next" data-next="_02" role="button" tabindex="0"></button>
                            </div>
                            <div class="citysoul-play-container">
                                <div class="jp-current-song">
                                    <span class="citysoul-song-name text-title" rel="songname"><?php echo esc_html($j)?>.<?php echo get_sub_field('item_song');?></span>
                                    <span class="citysoul-article-name text-active text-more text-16x">- <?php 
                                    $item_artist = get_sub_field('item_artist');
                                    foreach ($item_artist as $key => $value) {
                                       echo esc_html($value->post_title);
                                    }
                                    ?></span>
                                </div>
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar"></div>
                                    </div>
                                </div>
                                <div class="jp-volume-controls">
                                    <button class="jp-mute" role="button" tabindex="0"></button>
                                    <button class="jp-volume-max" role="button" tabindex="0"></button>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                    </div>
                                </div>
                                <div class="kilobite-text text-title"><?php echo get_sub_field('item_time'); ?></div>
                                <div class="button-click-play" data-play-next="_02" data-play-prev="" data-playlist="citysoul_player_<?php echo esc_html($j);?>"><i class="fa fa-play"></i></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="jp-playlist">
                            <div class="contain-playlist">
                                <ul>
                                    <li>&nbsp;</li>
                                </ul>
                            </div>
                        </div>
                        <div class="jp-no-solution">
                            <span><?php echo esc_html__('Update Required','citysoul')?></span>
                            <?php echo esc_html__('To play the media you will need to either update your browser to a recent version or update your','citysoul')?> <a href="<?php echo esc_url('http://get.adobe.com/flashplayer/')?>" target="_blank"><?php echo esc_html__('Flash plugin','citysoul')?></a>.
                        </div>
                    
                    </div>
                </div>
                <?php 
                /*
                 * After loop
                 * citysoul_playlist_script - 10
                 */
                    do_action( 'citysoul_playlist_script_hook', $j, $url_mp3);
                ?>
                <?php $j++; endwhile; ?>
                <?php } ?>
                <div class="clearfix"></div>     
            </div><!--End .citysoul-list-play-->
            <?php 
            /*
             * After loop
             * citysoul_button_playlist_script - 10
             */
                do_action( 'citysoul_button_playlist_script_hook' );
            ?>
        </div><!--End .track-play-list-->
    </div><!--End .citysoul-track-list-->
</section>
<?php
 endwhile;
?>
<section class="all-albums ">
    <div class="container">
        <div class="citysoul-all-album">
            <div class="citysoul-title citysoul-all-album-title text-active text-title text-3x"><?php echo esc_html($title_element)?esc_html($title_element):esc_html__('All Album','citysoul'); ?></div>
            <div class="clearfix"></div>
            <ul class="citysoul-album-list">
            <?php 
            
                $args = array(
                    'post_type' => 'album',
                    'posts_per_page' => $pages,
                );
                if( isset($album_id_list)) {
                    $args['post__not_in'] = $album_id_list;
                } elseif(isset($id)) {
                    $args['post__not_in'] = $id;
                }
                $loop = new WP_Query($args);
                wp_reset_postdata();
                while ($loop->have_posts())  : $loop->the_post() ;
             ?>
                <li class="album-item col-md-3 col-sm-3 col-xs-12">
                    <div class="album-view">
                        <a class="album-cover ajax-show" href="#" data-value="<?php echo get_the_ID();?>"><?php echo get_the_post_thumbnail(); ?></a>
                        <div class="title-album">
                            <a href="text-active" class="text-title text-white text-16px"><?php the_title(); ?></a>
                            <span class="text-more text-active text-16x ajax-show" data-value="<?php echo get_the_ID();?>">
                                <?php 
                                    $item = $album_artist = '';
                                    if (function_exists('get_field')) {
                                        $album_artist = get_field('album_artist');
                                    }
                                    
                                    if($album_artist != NULL) {
                                        foreach ($album_artist as $key => $value) {
                                            $item .= esc_html($value->post_title).',';
                                            
                                        }
                                        echo substr($item,0,-2);
                                    }
                                 ?>
                             </span>
                        </div>
                    </div><!--End album-view-->
                </li>
                <?php endwhile; ?>
            </ul>
        </div><!--End .citysoul-all-album-->
    </div>
</section>
<?php 
/*
 * After loop
 * citysoul_button_playlist_ajax_script - 10
 */
    do_action( 'citysoul_button_playlist_ajax_script_hook', $randomID );
?>