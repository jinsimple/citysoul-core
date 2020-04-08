<?php 
    $j= 1;
    $loop = new WP_Query($args);
    wp_reset_postdata();
     while ($loop->have_posts())  : $loop->the_post() ;
     $url_sound = citysoul_get_field('item_url', get_the_ID());
?>
<section class="track-list one_track <?php echo esc_html($css_class);?>" id="<?php echo esc_html($randomID);?>">
    <div class="citysoul-track-list track-list-right">
        <div class="container position-track">
            <div class="title-box-track">
                <div class="citysoul-title-half title-playlist-right title-opacity">
                    <div class="citysoul-title text-opacity text-title text-7x text-white"><?php echo 
                    empty($title_element)?esc_html__('About','citysoul'):$title_element?></div>
                    <div class="link-main-text text-more text-16x"><a href="#"><?php echo esc_html__('All artist','citysoul'); ?></a></div>
                </div>
                <div class="title-track text-active">
                    <span class="text-title text-16x"><?php echo esc_html__('track list','citysoul')?></span>
                    <span class="text-more">/ <?php echo esc_html__('SoundCloud', 'citysoul'); ?></span>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="track-play-list col-md-6 col-sm-6 col-xs-12">
            <div class="citysoul-list-play">
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
        <div class="cover-text col-md-6 col-sm-6 col-xs-12">
        <?php 
        $artist = $art_facebook = $art_twitter = $art_youtube = $art_soundcloud = '';
        if (function_exists('get_field')) {
            $artist = get_field('album_artist'); 
            $art_facebook = get_field('art_facebook',$artist[0]->ID);
            $art_twitter = get_field('art_twitter',$artist[0]->ID);
            $art_youtube = get_field('art_youtube',$artist[0]->ID);
            $art_soundcloud = get_field('art_soundcloud',$artist[0]->ID);
        }
        
        if($artist != null ) {
        ?>
            <div class="images-podcast images-podcast-right visible-over">
                <div class="podcast-image"><?php echo get_the_post_thumbnail($artist[0]->ID);?></div>
                <div class="text-artist-detail">
                    <p class="text-title text-100x text-white text-white"><?php echo esc_html($artist[0]->post_title); ?></p>
                    <div class="text-tags-view">
                        <p class="text-3x text-active text-more">
                        <?php if (function_exists('beau_theme_plugin_init')) {
                                echo citysoul_get_taxonomy_list_by_post_id('genres_artist',$artist[0]->ID);
                        };?></p>
                        <p class="text-desc"><?php the_field('art_description',$artist[0]->ID)?></p>
                        <div class="clearfix"></div>
                        <ul class="citysoul-social social-round social-albums">
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
                    </div>
                </div>
            </div> <?php } ?>
        </div><!--End .cover-text-->
    </div><!--End .citysoul-track-list-->
</section>
<?php endwhile;