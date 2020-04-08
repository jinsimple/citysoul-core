<?php
/*
 * Shortcode detail artist
 * function - citysoul_content_detail_artist()
 */

if(!function_exists('citysoul_content_detail_artist')){
    function citysoul_content_detail_artist(){
        ?>
        <div class="citysoul-short-description citysoul-artist-detail">
            <div class="image-desc col-md-6 col-xs-12">
                <div class="image-fix">
                <?php echo get_the_post_thumbnail(); ?>
                </div>
                <div class="clearfix"></div>
            <div class="citysoul-social-div">
                <?php if (function_exists('get_field')): ?>
                    <ul class="citysoul-social social-round">
                        <?php
                            $fb = get_field('art_facebook')?:get_field('art_facebook');
                            if($fb != NULL) :
                        ?>
                        <li><a href="<?php echo esc_url($fb)?>" class="fa fa-facebook"></a></li>
                        <?php endif;
                            $tw = get_field('art_twitter')?:get_field('art_twitter');
                            if($tw != NULL) :
                        ?>
                        <li><a href="<?php echo esc_url($tw)?>" class="fa fa-twitter"></a></li>
                        <?php endif;
                            $yt = get_field('art_youtube')?:get_field('art_youtube');
                            if($yt != NULL) :
                        ?>
                        <li><a href="<?php echo esc_url($yt)?>" class="fa fa-youtube"></a></li>
                        <?php endif;
                            $sc = get_field('art_soundcloud')?:get_field('art_soundcloud');
                            if($sc != NULL) :
                        ?>
                        <li><a href="<?php echo esc_url($sc)?>" class="fa fa-soundcloud"></a></li>
                        <?php endif;?>
                    </ul>
                <?php endif ?>
        </div>
            </div><!--End .image-desc-->
            <div class="citysoul-text-desc col-md-6 col-xs-12">
                <div class="text-description">
                    <div class="citysoul-title text-title text-7x text-white"><?php echo esc_html(get_the_title())?></div>
                    <div class="citysoul-tags text-more text-active text-2x">
                       <?php if (function_exists('beau_theme_plugin_init')) {
                        echo citysoul_get_taxonomy_list_by_post_id('genres_artist',get_the_ID());
                        }?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="short-desc text-desc citysoul-text-description">
                       <p><?php the_field('art_description');?></p>
                    </div><!--End .short-desc-->
                </div>
            </div><!--End .text-desc-->
        </div><!--End .citysoul-short-description-->
        <div class="clearfix"></div>

        <?php
    }
}

/*
 * Shortcode header artist view
 * function - citysoul_header_artist_view()
 */

 if(!function_exists('citycoul_header_artist_view')){
	function citysoul_header_artist_view() {
        $image_cover = '';
        if (function_exists('get_field')) {
            $image_cover_get = get_field('art_profile_cover');
            if($image_cover_get != NULL) {
                $image_cover = $image_cover_get['url'];
            }
        }
        if($image_cover == NULL){
            $image_cover = get_the_post_thumbnail_url();
        }
		?>
            <section class="citysoul-cover-page">
                <div class="citysoul-banner-page">
                    <div class="citysoul-banner-image">
                        <img class="cover-page" src="<?php echo esc_url($image_cover)?>" alt="<?php ?>">
                    </div><!--End .citysoul-banner-image-->

                </div><!--End .banner-page-->
            </section>
		<?php
	}
}

/*
 * Shortcode artist podcast view
 * function - citysoul_artist_podcast_view()
 */

if(!function_exists('citysoul_artist_podcast_view')){
	function citysoul_artist_podcast_view(){
		?>
		<section class="podcast">
            <div class="container">
                <div class="citysoul-podcast-shortcode">

                    <div class="citysoul-title-half title-opacity text-center">
                        <div class="citysoul-title text-opacity text-title text-7x text-white"><?php echo esc_html__('podcast','citysoul')?></div>
                        <div class="citysoul-tags main-text text-more text-16x"><?php echo esc_html__('All SoundCloud','citysoul')?></div>
                    </div><!--End .title-half-->

                    <div class="clearfix"></div>
                    <div class="track-list-shortcode  col-md-7 col-xs-12">
                        <div class="citysoul-list-play">

                            <div class="title-track text-active">
                                <span class="text-title text-2x"><?php echo esc_html__('track list','citysoul')?></span>
                                <span class="text-more">/ <?php echo esc_html__('SoundCloud','citysoul')?></span>
                            </div><!--End .title-track-->
                            <div class="clearfix"></div>
        					<?php
                            if (function_exists('get_field')) {
                                if(get_field('art_album') != '') {
                                   $album = get_field('art_album')[0]->ID;
                                } else $album = NULL;
                            }
        					if($album != NULL) :
        						$j = 1;
        					 while( have_rows('list_song', $album )) : the_row() ;?>
                        <div id="citysoul_player_<?php echo esc_html($j);?>" class="jp-jplayer"></div>
                        <div id="citysoul_container_<?php echo esc_html($j);?>" class="jp-audio" role="application" aria-label="media player">
                            <div class="jp-type-playlist">
                                <div class="jp-gui jp-interface">
                                    <div class="jp-controls">
                                        <button class="jp-previous playto" data-next="_<?php echo esc_attr($j-1);?>" role="button" tabindex="0"></button>
                                        <button class="jp-play" role="button" tabindex="0"></button>
                                        <button class="jp-next playto" data-next="_<?php echo esc_attr($j+1);?>" role="button" tabindex="0"></button>
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
                                        <div class="kilobite-text text-title"><?php echo get_sub_field('item_time');?></div>

                                        <div class="button-click-play" data-play-next="_<?php echo esc_attr($j+1);?>" data-play-prev="_<?php echo esc_attr($j-1);?>" data-playlist="citysoul_player_<?php echo esc_html($j);?>"><i class="fa fa-play"></i></div>
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
                        <script type="text/javascript">
                        //<![CDATA[
                        (function($){
                            'use strict'
                            //Setup and defined a playlist
                            var citysoul_Play<?php echo esc_html($j);?> = new jPlayerPlaylist({
                                jPlayer: "#citysoul_player_<?php echo esc_html($j);?>",
                                cssSelectorAncestor: "#citysoul_container_<?php echo esc_html($j);?>",

                            }, [
                                {
                                    title:"<?php echo get_sub_field('item_song');?>",
                                    artist: "<?php

                                            $item_artist = get_sub_field('item_artist');
                                            foreach ($item_artist as $key => $value) {
                                               echo esc_html($value->post_title);
                                            }
                                            ?>",
                                    mp3:"<?php echo get_sub_field('item_file')['url'];?>",
                                },
                            ], {
                                supplied: "oga, mp3",
                                wmode: "window",
                                useStateClassSkin: true,
                                autoBlur: false,
                                smoothPlayBar: true,
                                keyEnabled: true
                            });
                        })(jQuery)
                        //]]>
                        </script>
                        <?php $j++; endwhile; ?>

                            <?php endif;?>
                                <div class="clearfix"></div>

                        </div><!--End .citysoul-list-play-->

                        <?php
                        /*
                         * After loop
                         * citysoul_button_playlist_script - 10
                         */
                            do_action( 'citysoul_button_playlist_script_hook' );
                        ?>
                    </div><!--End .citysoul-podcast-shortcode-->
                    <div class="dj-soundcloud soundcloud-box col-md-5 col-xs-12">
                    <?php if(citysoul_get_field('art_sc_feature_track') != NULL) :?>
                        <div class="box-soundcloud">

                   <?php
                    if (function_exists('get_field')) {
                        echo wp_oembed_get(get_field('art_sc_feature_track')?:get_field('art_sc_feature_track'), array('height'=>450));
                    }
                   ?>

                        </div><!--End .box-soundcloud-->
                    </div><!--End .soundcloud-box-->
                <?php endif;?>
                </div><!--End .citysoul-podcast-shortcode-->
            </div>
        </section>
	<?php
	}
}


/*
 * Shortcode view dj one
 * function - citysoul_view_dj_one()
 */

if( !function_exists('citysoul_view_dj_one') ) {

	function citysoul_view_dj_one() { ?>

		<section class="dj-page">
		    <div class="container">
		        <div class="citysoul-artis">
		            <ul class="citysoul-dj-list">

					<?php
					if( have_rows('team') ):
						while ( have_rows('team') ) : the_row();
						$titles = get_sub_field('titles');
						$image = get_sub_field('image');
						$url = get_sub_field('url');
						$desc = get_sub_field('desc');
						$sound = get_sub_field('soundcloud');
					?>

		                <li class="citysoul-item-dj col-md-3 col-sm-3 col-xs-12">
		                    <div class="dj-avatar">
		                        <a href="<?php echo esc_html($url); ?>"><img src="<?php echo esc_html($image); ?>" alt="DJ avatar"></a>
		                    </div><!--End .dj-avatar-->
		                    <div class="dj-information text-center">
		                        <div class="dj-name-inner text-4x text-white text-title"><a href="#" class="text-white"><?php echo esc_html($titles); ?></a></div>
		                        <div class="dj-tags text-16x">
		                            <a href="#" class="text-active text-more">Electro</a>, <a href="#" class="text-active text-more">Techno</a>
		                        </div>
		                        <div class="dj-description text-desc"><?php echo esc_html($desc); ?></div>
		                    </div><!--End .dj-information-->
		                    <div class="dj-name text-active text-title"><?php $sound; ?></div>
		                </li>

					<?php
					endwhile;
					endif;
					 ?>
		            </ul>
		        </div><!--End .citysoul-artis-->
		    </div>
		</section>
	<?php }
}

/*
 * Shortcode details event
 * function - citysoul_details_event()
 */

 if( !function_exists('citysoul_details_event') ) {

    function citysoul_details_event() {
    ?>
        <?php
            $facebook = $twitter = $youtube = $soundcloud = $unixtimestamp ='';
            if (function_exists('get_field')) {
                $facebook = get_field('user_facebook');
                $twitter = get_field('user_twitter');
                $youtube = get_field('user_youtube');
                $soundcloud = get_field('user_soundcloud');
                $unixtimestamp = strtotime(get_field('date_event'));
            }


            $id_event = get_the_ID();
            $cover_event = citysoul_GetOption('citysoul-image-cover-event');
        ?>
        <div class="citysoul-detail-event">
            <?php if($cover_event['url'] != NULL) :?>
            <div class="cover-event">
                <img src="<?php echo esc_url($cover_event['url'])?>" alt="<?php echo get_the_title()?>">
            </div>
            <?php endif;?>

            <div class="container">
                <div class="detail-cover-item">
                    <div class="detail-image pull-left">
                        <?php
                          if( has_post_thumbnail() ) {
                            echo citysoul_get_the_post_lazyload_thumbnail(get_the_ID(), 'full');
                          }
                        ?>
                    </div>
                    <div class="detail-event-info pull-right">
                        <p class="citysoul-date text-active">
                            <em class="text-more"><?php echo date_i18n(( get_option('date_format') ), $unixtimestamp) ; ?></em>
                        </p>
                        <?php if (get_the_title() != ''): ?>
                            <div class="text-title title-event text-white text-6x"><?php the_title() ?></div>
                        <?php endif ?>

                        <div class="clearfix"></div>
                        <?php if( have_rows('tags_list') ): ?>
                            <div class="tags-list-detail tags-list text-more">
                                <?php while ( have_rows('tags_list') ) : the_row();
                                    $tags = get_sub_field('tags');
                                ?>
                                    <a><?php echo esc_html($tags) ?></a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                        <div class="msb-start-date-dj">
                            <?php
                            $start_date = $end_date = $choose_artis = $location = '';
                            if (function_exists('get_field')) {
                                $start_date = get_field('start_date');
                                $end_date = get_field('end_date');
                                $choose_artis = get_field('choose_artis');
                                $location = get_field('location');
                            }


                            if ( $start_date != ''): ?>
                                <span class="text-title"><?php echo esc_html_e('Start', 'citysoul') ?> :</span>  <em class="text-more"><?php echo esc_html($start_date) ?></em>
                            <?php endif; ?>

                            <div class="clearfix"></div>

                            <?php if ( $end_date != ''): ?>
                                <span class="text-title"><?php echo esc_html_e('End', 'citysoul') ?> :</span>  <em class="text-more"><?php echo esc_html($end_date) ?></em>
                            <?php endif; ?>
                            <div class="clearfix"></div>

                            <?php if ( $location != ''): ?>
                                <span class="text-title"><?php echo esc_html_e('Location', 'citysoul') ?> :</span>  <em class="text-active text-more"><?php echo esc_html($location) ?></em>
                            <?php endif; ?>
                            <div class="clearfix"></div>

                            <?php
                            if($choose_artis != '') {
                            ?>
                                <span class="text-title"><?php echo esc_html_e('Artist', 'citysoul') ?> :</span>
                            <?php
                                $args = array(
                                    'post_type' => 'artist',
                                    'post__in' => $choose_artis,
                                );

                                $loop = new WP_Query( $args );
                                wp_reset_postdata();
                                while ($loop->have_posts())  : $loop->the_post() ; ?>
                                    <em class="text-active text-more">
                                        <?php echo get_the_title(); ?>
                                    </em>
                                <?php endwhile;
                            }
                            ?>

                        </div>
                        <div class="clearfix"></div>
                        <ul class="citysoul-social social-round">

                            <?php if ($facebook != ''): ?>
                                <li><a href="<?php echo esc_html($facebook) ?>" class="fa fa-facebook"></a></li>
                            <?php endif ?>
                            <?php if ($twitter != ''): ?>
                                <li><a href="<?php echo esc_html($twitter) ?>" class="fa fa-twitter"></a></li>
                            <?php endif ?>
                            <?php if ($youtube != ''): ?>
                                <li><a href="<?php echo esc_html($youtube) ?>" class="fa fa-youtube"></a></li>
                            <?php endif ?>
                            <?php if ($soundcloud != ''): ?>
                                <li><a href="<?php echo esc_html($soundcloud) ?>" class="fa fa-soundcloud"></a></li>
                            <?php endif ?>
                        </ul>
                        <div class="clearfix"></div>
                        <?php echo citysoul_details_event_button($id_event); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
           </div>
        </div>
        <div class="clearfix"></div>
    <?php }
}


/*
 * Shortcode details event button
 * function - citysoul_details_event_button()
 */


if( !function_exists('citysoul_details_event_button') ) {
    function citysoul_details_event_button($id_event) {
        $link = get_field('field_buy_link',$id_event);
        if($link != '') {
            $buy_link = $link;
        } else{
            $buy_link = get_the_permalink($id_event);
        }
        ?>
            <?php if (citysoul_check_option_theme('enable-buy-ticket-event') != '0'): ?>
                <div class="link-buy">
                    <a href="<?php echo esc_url($buy_link);?>" class="text-title text-active citysoul-button citysoul-button-o"><?php echo esc_html_e(
                    'Buy ticket', 'citysoul') ?></a>
                </div><!--End .link-buy-->
            <?php endif ?>
        <?php
    }
}

/*
 * Shortcode view gallery
 * function - citysoul_view_gallery()
 */

if( ! function_exists('citysoul_view_gallery') ) {

	function citysoul_view_gallery() { ?>

		<section class="gallery-page">
		    <div class="container">
		        <div class="citysoul-gallery">
		            <ul class="citysoul-gallery-list">
					<?php
					$id = 1;
					if( have_rows('gallery_image') ):
						while ( have_rows('gallery_image') ) : the_row();
						$image = get_sub_field('itemgl_image');
					?>
		                <li class="citysoul-item-gallery col-md-3 col-sm-6 col-xs-12">
		                    <div class="items-gallery">
		                        <a href="#" data-toggle="modal" data-target="#gallery-modal<?php echo esc_html($id) ?>">
		                            <div class="feature-gallery-image">
		                                <img src="<?php echo esc_html($image); ?>">
		                            </div>
		                        </a><!--End .feature-gallery-image-->
		                    </div><!--End .items-gallery-->
		                    <!-- Modal demo -->
				            <div id="gallery-modal<?php echo esc_attr($id) ?>" class="modal fade main-gallery-modal" role="dialog" tabindex="-1" >
				              <div class="modal-dialog modal-lg">

				                <!-- Modal content-->
				                <div class="modal-content">
				                  <div class="modal-header"></div>
				                  <div class="modal-body">
				                    <div class="close close-modal" data-dismiss="modal"></div>
				                    <img src="<?php echo esc_html($image); ?>">
				                    <div class="btn-next-back btn-next btn-gallery-next" data-current="gallery-modal<?php echo intval($id)?>" data-next="gallery-modal<?php echo intval($id+1)?>"></div>
				                    <div class="btn-next-back btn-back btn-gallery-back" data-current="gallery-modal<?php echo intval($id)?>" data-next="gallery-modal<?php echo intval($id-1)?>"></div>
				                  </div>
				                  <div class="modal-footer"></div>
				                </div>

				              </div>
				            </div>
		                </li>
		                <?php
		                $id++;
		                	endwhile;
		                	endif;
		                 ?>


		            </ul>

		        </div><!--End .citysoul-artis-->
		    </div>
		</section>
		<script>
			(function($){
				"use strict";
				$('.btn-next-back').click(function(){
					var dataNextPop = $(this).attr('data-next');
					var currentId = $(this).attr('data-current');

					$('.modal-backdrop').remove();
			        $('#'+currentId).modal('hide');
			        $('#'+dataNextPop).modal('show');

				});

				$('#gallery-modal').on('show', function () {
			       $(this).find('.modal-body').css({
			            width:'auto', //probably not needed
			            height:'auto', //probably not needed
			            'max-height':'100%'
			       });
			});
			})(jQuery)


		</script>

	<?php }
}

/*
 * Shortcode cover details gallery
 * function - citysoul_cover_details_gallery()
 */


if( ! function_exists('citysoul_cover_details_gallery') ) {

	function citysoul_cover_details_gallery() {
	?>
		<section class="citysoul-cover-page single-page">
		    <div class="citysoul-banner-page citysoul-cover-image-gallery">
		        <div class="title-page-text text-center">
		            <?php echo citysoul_time_link(); ?>
		            <span class="text-title citysoul-title text-white text-3x"><?php the_title() ?></span>
		            <div class="clearfix"></div>
		            <div class="citysoul-social-detail">
		                <ul class="citysoul-social social-round">
		                    <?php
				                citysoul_get_template('core/layout/social-share');
				            ?>
		                </ul>
		            </div><!--End .citysoul-social-detail-->
		        </div><!--End .title-page-->
		    </div><!--End .banner-page-->
		</section>
	<?php }
}

/*
 * Shortcode title dj
 * function - citysoul_title_dj()
 */

if( !function_exists('citysoul_title_dj') ) {

	function citysoul_title_dj() {
		if(have_posts()) {
			$title = get_post_title();
			$desc = get_post_meta(get_the_ID(), 'desc', true);
		}
		?>

		<section class="citysoul-cover-page">
		    <div class="citysoul-banner-page">
		        <div class="title-page-text text-center">
		            <span class="text-title citysoul-title text-white text-4x"><?php echo esc_html($title); ?></span>
		            <div class="clearfix"></div>
		            <span class="text-title text-active text-1x"><?php echo esc_html($desc); ?></span>
		        </div><!--End .title-page-->
		    </div><!--End .banner-page-->
		</section>

	<?php }
}
add_action('citysoul_timetable_script_hook','citysoul_timetable_script',10,2);
if(!function_exists('citysoul_timetable_script')) {
    function citysoul_timetable_script($element,$arr=array()){
        ?>
        <script>
            $(document).ready(function() {
                "use strict";
                var $calendar = jQuery("#<?php echo esc_attr($element);?>");
                var $select_year = jQuery("#select_year_<?php echo esc_attr($element);?>");
                var $select_month = jQuery("#select_month_<?php echo esc_attr($element);?>");
                var $select_month_m = jQuery("#select_month_<?php echo esc_attr($element);?>_m");
                var $select_locale = jQuery("#select_locale_<?php echo esc_attr($element);?>");
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                var initialLocaleCode = 'en';
                $select_month_m.hide();
                $select_year.selectbox();
                $select_year.change(function() {
                    var year = this.value;
                    if (year) {
                        var data = {
                            action: 'citysoul_timetable_change_event',
                            year : year,
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                            if(response.isEmptyObject != true) {
                                data = JSON.parse(response);
                                $calendar.fullCalendar('gotoDate', data.event[0].start);
                                $calendar.fullCalendar('removeEvents');
                                $calendar.fullCalendar('addEventSource' ,data.event);
                                $calendar.fullCalendar('rerenderEvents');
                                if(data.month.isEmptyObject != true) {
                                    $select_month.empty();
                                    $select_month_m.show();
                                    $select_month_m.attr('year',year);
                                    $.each(data.month, function(key, value) {
                                         $select_month
                                                .append($('<option>', { value : value })
                                                .text(value));
                                    });
                                    $select_month.selectbox();
                                }
                            }
                        });
                    }
                });

                //Month before change
                var currentTime = new Date();
                var year        = currentTime.getFullYear();
                if (year) {
                    var data = {
                        action: 'citysoul_timetable_change_event',
                        year : year,
                    };
                    jQuery.post(ajaxurl, data, function(response) {
                        if(response.isEmptyObject != true) {
                            data = JSON.parse(response);
                            $calendar.fullCalendar('gotoDate', data.event[0].start);
                            $calendar.fullCalendar('removeEvents');
                            $calendar.fullCalendar('addEventSource' ,data.event);
                            $calendar.fullCalendar('rerenderEvents');
                            if(data.month.isEmptyObject != true) {
                                $select_month.empty();
                                $select_month_m.show();
                                $select_month_m.attr('year',year);
                                $.each(data.month, function(key, value) {
                                     $select_month
                                            .append($('<option>', { value : value })
                                            .text(value));
                                });
                                $select_month.selectbox();
                            }
                        }
                    });
                }

                $select_month.change(function() {
                    var month = this.value;
                    if (month) {
                        var year =  $select_month_m.attr('year');
                        var data_m = {
                            action : 'citysoul_timetable_change_event',
                            year : year,
                            month : month,
                        };
                        jQuery.post(ajaxurl, data_m, function(response) {
                            if(response.isEmptyObject != true) {
                                data_m = JSON.parse(response);
                                $calendar.fullCalendar('gotoDate', data_m.event[0].start);
                                $calendar.fullCalendar('removeEvents');
                                $calendar.fullCalendar('addEventSource' ,data_m.event);
                                $calendar.fullCalendar('rerenderEvents');
                            }
                        });
                    }
                });
                $calendar.fullCalendar({
                    theme: true,
                    locale: initialLocaleCode,
                    header: {left: '',center: '',right: ''},
                    windowResize: function(view) {
                    if ($(window).width() < 1280){
                        $calendar.fullCalendar( 'changeView', 'listMonth' );
                    }
                    else {
                        $calendar.fullCalendar( 'changeView', 'month' );
                      }
                    },
                    editable: false,
                    selectable: true,
                    defaultDate: '<?php print(citysoul_timetable_get_event_default($arr));?>',
                    selectHelper: true,
                    defaultView: "month",
                    isRTL : false,
                    events : <?php print(citysoul_timetable_get_event($arr));?>,
                    displayEventEnd: {
                        month: true,
                        basicWeek: true,
                        "default": true
                    },
                    eventRender: function(event, element) {
                         element.find('.fc-content').append('<div class="ev"><div class="ev__cover"><div class="ev__cover_image"><img src="'+event.cover+'" alt="'+event.title+'"></div><div class="ev__cover_buy"><a href="'+event.link+'" title="<?php esc_html_e('Buy Ticket','citysoul')?>" target="_blank"><?php esc_html_e('Buy Ticket','citysoul')?></a></div></div><div class="ev__title"><a href="'+event.link+'" title="'+event.title+'" target="_blank">'+event.title+'</a><a href="'+event.link+'" title="'+event.title+'" target="_blank" class="ev__title_buy fa fa-ticket"></a></div><div class="ev__by"><span class="ev__by_job">'+event.jobs+'</span><span class="ev__by_name">'+event.artist+'</span></div><div class="ev__tags"><span>'+event.tags.join('</span> <span>')+'</span></div></div>');
                        element.find('.fc-list-item-title').append('<div class="ev"><div class="ev__title"><a href="'+event.link+'" title="'+event.title+'" target="_blank">'+event.title+'</a><a href="'+event.link+'" title="<?php esc_html_e('Buy Ticket','citysoul')?>" target="_blank" class="ev__title_buy fa fa-ticket"></a></div><div class="ev__by"><span class="ev__by_job">'+event.jobs+'</span><span class="ev__by_name">'+event.artist+'</span></div></div>');
                        element.find('.fc-content .fc-title').remove();
                    },
                });
                $.each($.fullCalendar.locales, function(localeCode) {
                    $select_locale.append(
                        $('<option/>')
                            .attr('value', localeCode)
                            .text(localeCode)
                    );
                });
                $select_locale.selectbox();
                $select_locale.change(function() {
                    if (this.value) {
                        $calendar.fullCalendar('option', 'locale', this.value);
                    }
                });
            });
        </script>
        <?php
    }
}
