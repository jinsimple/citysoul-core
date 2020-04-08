<?php


/**
 * wp_ajax_citysoul_get_info_card hook.
 * ajax citysoul_get_info_card 10
 */
add_action( 'wp_ajax_citysoul_get_info_card', 'citysoul_get_info_card' );
function citysoul_get_info_card() {
    $card_id = isset($_REQUEST['card_id']) ? $_REQUEST['card_id'] : 0;
    if( have_rows('card_contacts', $card_id) );
    if(have_rows('card_limitation', $card_id));
?>

    <div class="title-box text-title text-active citysoul-title text-16x"><?php the_field('card_name',$card_id); ?></div>
    <ul class="text-title list-view-member list-pagkage-register">
    <?php while( have_rows('card_limitation', $card_id)) : the_row() ; ?>
        <li data-pagkage="3"><i class="fa fa-circle"></i><?php echo get_sub_field('card_lm_times')." : ".get_sub_field('card_lm_values'); ?></li>
    <?php endwhile; ?>
    </ul>
    <div class="clearfix"></div>
    <div class="title-box text-title text-active citysoul-title text-16x"><?php esc_html_e('Membership Period','citysoul'); ?></div>
    <ul class="list-address list-view-member">
    <?php while( have_rows('card_contacts', $card_id) ) : the_row(); ?>
    <li><strong class="text-title"><?php the_sub_field('card_ct_title'); ?></strong> : <em class="text-more text-16x"><?php the_sub_field('card_ct_value'); ?></em></li>
    <?php endwhile; ?>
    </ul>
<?php
//die();
}


/**
 * create membership postype
 * citysoul_create_membership
 */

add_action('wp_ajax_citysoul_create_membership', 'citysoul_create_membership');

function citysoul_create_membership() {
    $data = !empty($_REQUEST['form_data']) ? $_REQUEST['form_data'] : 0 ;
    $tt = array();
    $da = explode('&', $data);
    $un = array(0,1,2,3,4);
    foreach ($un as $key => $value) {
        unset($da[$value]);
    }

    foreach ($da as $key => $value) {
        $d[] = explode('=', $value);
    }

    foreach ($d as $v) {
        $tt[$v[0]] = $v[1];

    }
    $post_id = citysoul_insert_member();
    foreach ($tt as $key => $value) {
        update_post_meta($post_id, $key, $value);
    }

}

function citysoul_insert_member() {
    $count = wp_count_posts('membership', '');
    $post_id = wp_insert_post(array(
            'post_type' => 'membership',
            'post_title' => 'membership #'. (intval($count->publish)+1),
            'post_status' =>  'Publish',
        )
    );

    return $post_id;
}

/**
 * ajax view track submit album
 * citysoul_get_list_song
 */
add_action( 'wp_ajax_citysoul_get_list_song', 'citysoul_get_list_song' );
function citysoul_get_list_song() {
    $album_id[] = isset($_REQUEST['album_id']) ? $_REQUEST['album_id'] : '';

    $args = array(
        'post_type' => 'album',
        'posts_per_page' => 1,
        'post__in' => $album_id,
    );

    $loop = new WP_Query($args);
    wp_reset_postdata();
    while($loop->have_posts()) : $loop->the_post() ;
    ?>
    <div class="citysoul-track-list">
        <div class="cover-text col-md-6 col-sm-6 col-xs-12">
            <div class="images-podcast">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                <span class="text-name text-title">
                    <strong class="text-title text-bg">01</strong>
                    <h1 class="text-white text-over text-7x"><?php the_title(); ?></h1>
                </span>
            </div>
        </div><!--End .cover-text-->
        <div class="track-play-list col-md-6 col-sm-6 col-xs-12">

            <div class="citysoul-list-play">

                <div class="title-track text-active">
                    <span class="text-title text-2x"><?php echo esc_html__('Track list','citysoul')?></span>
                    <span class="text-more">/ <?php echo esc_html__('SoundCloud','citysoul')?></span>
                </div><!--End .title-track-->
                <div class="clearfix"></div>

                <!-- Play list one -->

                    <?php

                    while( have_rows('list_song', get_the_ID())) : the_row() ;
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
                                    <span class="citysoul-song-name text-title"><?php echo esc_html($j)?>. <?php echo get_sub_field('song');?></span>
                                    <span class="citysoul-article-name text-active text-more text-16x">- <?php echo get_sub_field('singer');?></span>
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
                                <div class="kilobite-text text-title"><?php echo get_sub_field('time'); ?></div>
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
                <?php do_action( 'citysoul_playlist_script_hook', $j ); ?>
                <?php $j++; endwhile; ?>
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
    <?php
    endwhile;
}
add_action('wp_ajax_nopriv_citysoul_timetable_change_event', 'citysoul_timetable_change_event');
add_action('wp_ajax_citysoul_timetable_change_event', 'citysoul_timetable_change_event');
if(!function_exists('citysoul_timetable_change_event')) {
    function citysoul_timetable_change_event() {
        $year = isset($_POST['year']) ? $_POST['year'] : 0 ;
        $month = isset($_POST['month']) ? $_POST['month'] : 0 ;
        if($year != 0) {
            if($month != 0) {
                $data = citysoul_timetable_get_event_by_year($year,$month);
                if($data != NULL) {
                    $events = json_decode(citysoul_timetable_get_event($data));
                    $data_e_m = array(
                            'month'     =>  '',
                            'event'     =>  $events,
                        );
                    print(json_encode($data_e_m));
                    die();
                }
            }
            else {
                $data = citysoul_timetable_get_event_by_year($year);
                if($data != NULL) {
                    $m_e = get_posts(
                        array(
                            'post_type'     => 'event',
                            'meta_key'      => 'date_event',
                            'orderby'       => 'meta_value',
                            'order'         => 'DESC',
                            'post__in'      =>  $data,
                            'posts_per_page' => -1,
                        )
                    );
                    $m_e_x = array();
                    if($m_e != NULL) :
                        foreach( $m_e as $s ) :
                            $m_e_x =  citysoul_get_field('date_event', $s->ID);
                            $m[] = date_i18n('m',strtotime($m_e_x));
                        endforeach;
                        $m = array_unique($m);
                    endif;
                    $events = json_decode(citysoul_timetable_get_event($data));
                    $data_e_m = array(
                            'month'     =>  $m,
                            'event'     =>  $events,
                        );
                    print(json_encode($data_e_m));
                    die();
                }
            }
        }
        die();
    }
}
