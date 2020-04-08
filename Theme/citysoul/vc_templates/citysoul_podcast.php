<?php
/**
 * SH Podcast for v1.2.0
 * @author VNMilky
 */
$sh_title =
$sh_link  =
$in_id =
//Color
$color_title =
$color_viewmore =
$color_name =
$color_active =
$color_control =
$color_time =
$css = '';

extract(shortcode_atts(array(
    'sh_title'                          =>  '',
    'sh_link'                           =>  '',
    'in_id'                             =>  '',
    'color_title'                       =>  '',
    'color_viewmore'                    =>  '',
    'color_name'                        =>  '',
    'color_active'                      =>  '',
    'color_control'                     =>  '',
    'color_time'                        =>  '',
    'css'                               =>  '',
), $atts));
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'podcast_v1_2_0_'.$id_ran;
if($in_id == '') {
    $args = array(
        'post_type' =>  'album',
        'posts_per_page'    =>  1,
        );
    $wp = new WP_Query($args);
    wp_reset_postdata();
    $in_id = $wp->posts[0]->ID;
}
if($in_id != NULL) :
    $url_sound = citysoul_get_field('item_url',$in_id);
    if($sh_title == '') {
        $sh_title =  esc_html__('Podcast','citysoul');
    }
    $sh_link    =  vc_build_link($sh_link);
    $sh_link_url = $sh_link['url'];
    $sh_link_title = $sh_link['title'];
    $sh_link_target = $sh_link['target'];
    $sh_link_rel = $sh_link['rel'];
    if($sh_link['target'] == ' _blank'){
        $sh_link_target = ' target="_blank"';
    }
    if($sh_link['rel'] == 'nofollow'){
        $sh_link_rel = ' rel="nofollow"';
    }
    if($sh_link['title'] == ''){
        $sh_link_title = esc_html__('All Podcast', 'citysoul');
    }
    $color_viewmore_hover = array();
    if($color_viewmore != NULL) {
        $color_viewmore_hover = array(
            'opacity'   =>  '0.5',
            );
    }
    $setup = array(
        '[data-color="sh_title"]'       =>  array(
                'color'                 =>  $color_title,
            ),
        '[data-color="sh_more"]'        =>  array(
                'color'                 =>  $color_viewmore,
            ),
        '.citysoul-song-name'        =>  array(
                'color'                 =>  $color_name,
            ),
        '.citysoul-article-name'        =>  array(
                'color'                 =>  $color_active,
            ),
        '.jp-duration'        =>  array(
                'color'                 =>  $color_time,
            ),
        '.button-click-play'        =>  array(
                'color'                 =>  $color_control,
            ),
        '.jp-gui button'        =>  array(
                'color'                 =>  $color_control,
            ),
        '.jp-play-bar'        =>  array(
                'background'                 =>  $color_active,
            ),

        '[data-color="sh_more"]:hover'  =>  $color_viewmore_hover,
        '.track-list--center__more:before' => array(
                'background'            =>  $color_active,
            ),
        );
    echo citysoul_css_shortcode($randomID, $setup);
?>
<div id="<?php echo esc_attr($randomID);?>" class="track-list track-list--center <?php echo esc_attr( $css_class ); ?>">
    <div class="citysoul-track-list">
        <div class="track-play-list col-xs-12">
            <div class="citysoul-list-play">
                <div class="title-track">
                    <span data-color="sh_title" class="track-list--center__element"><?php if($sh_title != NULL) :  print($sh_title);endif;?></span>
                    <span class="track-list--center__more"><?php if($sh_link_url != NULL) :?><a data-color="sh_more" href="<?php echo esc_url($sh_link_url)?>" title="<?php print($sh_link_title)?>" <?php print($sh_link_target.$sh_link_rel)?>><?php print($sh_link_title)?></a><?php endif;?></span>
                </div><!--End .title-track-->
                <div class="clearfix"></div>
                <!-- Play list one -->
                <?php if($url_sound != '') { ?>
                <?php $sc = wp_oembed_get($url_sound);
                $sc = str_replace('true', 'false', $sc);
                print($sc); ?>
                <?php }else{ ?>
                    <?php
                    $j=1;
                    while( have_rows('list_song', $in_id)) : the_row() ;
                    $url_mp3 = get_sub_field('item_file')['url'];
                     ?>
                <div id="citysoul_player_<?php echo esc_html($j);?>" class="jp-jplayer"></div>
                <div id="citysoul_container_<?php echo esc_html($j);?>" class="jp-audio" role="application" aria-label="media player">
                    <div class="jp-type-playlist">
                        <div class="jp-gui jp-interface">
                            <div class="jp-controls">
                                <button class="jp-previous" data-next="<?php print($j-1)?>" role="button" tabindex="0"></button>
                                <button class="jp-play" role="button" tabindex="0"></button>
                                <button class="jp-next" data-next="_<?php print($j+1)?>" role="button" tabindex="0"></button>
                            </div>
                            <div class="citysoul-play-container">
                                <div class="jp-current-song">
                                    <span class="citysoul-song-name text-title"><?php echo esc_html($j)?>.<?php echo get_sub_field('item_song');?></span>
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
                                <div class="jp-duration kilobite-text text-title"></div>
                                <div class="button-click-play" data-play-next="_<?php print($j+1)?>" data-play-prev="_<?php print($j-1)?>" data-playlist="citysoul_player_<?php echo esc_html($j);?>"><i class="fa fa-play"></i></div>
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
    </div>
</div>
<?php endif;