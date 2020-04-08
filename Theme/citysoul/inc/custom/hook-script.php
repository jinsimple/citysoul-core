<?php
add_action('citysoul_playlist_script_hook','citysoul_playlist_script',10, 2);
function citysoul_playlist_script($j, $url_mp3) {
?>
    <script>
        (function($){
            'use strict'
            //Setup and defined a playlist
            var citysoul_Play<?php echo esc_html($j);?> = new jPlayerPlaylist({
                jPlayer: "#citysoul_player_<?php echo esc_html($j);?>",
                cssSelectorAncestor: "#citysoul_container_<?php echo esc_html($j);?>",

            }, [
                {
                    mp3:"<?php echo esc_html($url_mp3);?>",
                },
            ], {
                supplied: "oga, mp3",
                wmode: "window",
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                remainingDuration: true,
                toggleDuration: true,
                keyEnabled: true
            });
        })(jQuery)
    </script>
<?php
}

add_action('citysoul_button_playlist_script_hook','citysoul_button_playlist_script',10);
function citysoul_button_playlist_script() {
?>
    <!-- Script for total -->
    <script>
        (function($){
            'use strict'
            // Js for play list
            $('.button-click-play').click(function(event) {
                var dataPlayer = $(this).attr('data-playlist');
                var dataPlayerNext = $(this).attr('data-play-next');
                var dataPlayerBack = $(this).attr('data-play-prev');
                $('.citysoul-play-container').removeClass('no-border');
                $('#'+dataPlayer).jPlayer("play");
                if (dataPlayerBack !='') {
                    $('#citysoul_container'+dataPlayerBack+' .citysoul-play-container').addClass('no-border');
                }
            });
            // Js for next back
            $('.jp-controls').click(function(e) {
                console.log(e)
                var clickClass = e.target.className;
                var playNext = $('.'+clickClass).attr('data-next');
                if (clickClass === 'jp-next' || clickClass ==='jp-previous') {
                    $('#citysoul_player'+playNext).jPlayer("play");
                }
            });

        })(jQuery)
    </script>
<?php
}

add_action('citysoul_button_playlist_ajax_script_hook','citysoul_button_playlist_ajax_script',10);
function citysoul_button_playlist_ajax_script($randomID) {
?>
    <script>
        (function($){
            "use strict";
            var id = '';
            $('.ajax-show').click(function(e) {
                id = $(this).attr('data-value');
                var data = {
                    'action': 'citysoul_get_list_song',
                    'album_id': id
                };
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                jQuery.post(ajaxurl, data, function(response) {
                    $('#<?php echo esc_html($randomID);?>').html(response);
                });
                $('html, body').animate({
                     scrollTop: $("#<?php echo esc_html($randomID);?>").offset().top
                }, 2000);
                return false;
            });
        })(jQuery)
    </script>
<?php
}


add_action('citysoul_block_post_slide_hook','citysoul_block_post_slide',10);
function citysoul_block_post_slide($id) {
?>
    <script>
        (function($){
            'use strict'
            var featurePostSlider = new Swiper('.citysoul-feature-post-<?php echo esc_html($id);?>', {
                speed: 800,
                slidesPerView: 1,
                loop: true,
                nextButton: '.blog-feature-next-<?php echo esc_html($id);?>',
                prevButton: '.blog-feature-back-<?php echo esc_html($id);?>',
                grabCursor: true,
                spaceBetween: 0,
            });
        })(jQuery)
    </script>
<?php
}

add_action('citysoul_card_script_hook','citysoul_card_script_member',10);
function citysoul_card_script_member() {
?>
    <script>
        (function($) {
            "use trict";
            var id = '';
            $('.item-info > .citysoul-button-o').click(function(e) {

                id = $(this).attr('data-value');
                var data = {
                    'action': 'citysoul_get_info_card',
                    'card_id': id
                };
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                jQuery.post(ajaxurl, data, function(response) {
                    $('.period').html(response);
                });


                $('html, body').animate({
                     scrollTop: $("#apply-form").offset().top
                }, 200);
                return false;
            });


            $('.checkout').submit(function(event) {
                var form_data = $(this).serialize();
                var data = {
                    'action': 'citysoul_create_membership',
                    'form_data': form_data
                };
                var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                jQuery.post(ajaxurl, data, function(response) {
                    alert('Success !');
                });

                return false;

            })

        })(jQuery)

    </script>
<?php
}

add_action('citysoul_countdown_script_hook','citysoul_countdown_script',10, 2);
function citysoul_countdown_script($id_ran, $time_countdown) {
?>
    <script type="text/javascript">
        (function($) {
            "use strict";
            $('#msb-coundown-total-<?php echo esc_attr($id_ran);?>').countdown('<?php echo esc_js($time_countdown)?>', function(event) { //mm/dd/yyy
            $('#msb-coundown-day-<?php echo esc_attr($id_ran);?>').html(event.strftime('%D')); //Day
            $('#msb-coundown-hrs-<?php echo esc_attr($id_ran);?>').html(event.strftime('%H')); //Hours
            $('#msb-coundown-min-<?php echo esc_attr($id_ran);?>').html(event.strftime('%M')); //Month
            $('#msb-coundown-sec-<?php echo esc_attr($id_ran);?>').html(event.strftime('%S')); //Seconds
        });
      })(jQuery);
    </script>
<?php
}


add_action('citysoul_list_video_hook','citysoul_list_video_function_hook',10);
function citysoul_list_video_function_hook() {
?>
    <script>
        (function($) {
            "use strict";
            $('.video-control').click(function() {
                var iframe = $(this).siblings('input').val();


                $('#modalvideo').modal();
                $('#modalvideo').on('shown.bs.modal', function(){
                    $('.video-content').html(iframe);
                });

                $('#modalvideo').on('hide.bs.modal', function(){
                    $('.video-content').html(iframe);
                })
            });

        })(jQuery)
    </script>
<?php
}

add_action('citysoul_map_script_hook','citysoul_map_function_hook',10, 5);
function citysoul_map_function_hook($enable_scroll,$latitude,$longitude,$color_water,$map_marker) {
?>
    <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?v=3.exp&#038;signed_in=true&#038;ver=3'></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', init);
        function init() {
            var mapOptions = {
                zoom: 10,
                scrollwheel: <?php echo esc_js($enable_scroll);?>,
                // mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: new google.maps.LatLng(<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>),
                styles:
                [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"geometry","stylers":[{"visibility":"off"},{"color":"<?php echo esc_html($color_water);?>"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#7f642d"},{"weight":.1}]},{"featureType":"landscape.natural.landcover","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"<?php echo esc_html($color_water);?>"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"on"},{"color":"#7f642d"}]},{"featureType":"poi.attraction","elementType":"geometry","stylers":[{"visibility":"off"},{"color":"#cfb665"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"color":"#e9d9a6"},{"visibility":"on"}]},{"featureType":"poi.government","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.school","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.sports_complex","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#e9d9a6"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"},{"weight":1},{"color":"#e9d9a6"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#e9d9a6"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"<?php echo esc_html($color_water);?>"}]},{"featureType":"road.arterial","elementType":"labels.text.stroke","stylers":[{"color":"#cfb665"},{"visibility":"off"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"color":"<?php echo esc_html($color_water);?>"},{"visibility":"on"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"visibility":"off"},{"color":"<?php echo esc_html($color_water);?>"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#021019"}]}]
            };
            var mapElement = document.getElementById('citysoul-contact-map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>),
                map: map,
                icon: "<?php echo esc_url($map_marker);?>",
                title: 'Map title'
            });
        }
    </script>
<?php
}

add_action('citysoul_shop_slide_view_hook','citysoul_shop_slide_view',10);
function citysoul_shop_slide_view($id_ran) {
?>
    <script>
        (function($) {
        "use strict";
            var testiMonialHalf = new Swiper('.shop-slider-view-<?php echo esc_attr($id_ran);?>', {
                slidesPerView: 1,
                speed: 800,
                grabCursor:true,
                auto:true,
                loop: true,
                paginationClickable: true,
                pagination: '.shop-pagging-<?php echo esc_attr($id_ran);?>',
            });
        })(jQuery);
    </script>
<?php
}


add_action('citysoul_shop_slide_list_hook','citysoul_shop_slide_list',10);
function citysoul_shop_slide_list($id_ran) {
?>
    <script>
        (function($) {
        "use strict";
            var shopListSwiper = new Swiper('.shop-slider-list-<?php echo esc_attr($id_ran);?>', {
                speed: 800,
                slidesPerView: 4,
                slidesPerGroup: 2,
                loop: true,
                nextButton: '.btn-morepro-next-<?php echo esc_attr($id_ran);?>',
                prevButton: '.btn-morepro-back-<?php echo esc_attr($id_ran);?>',
                grabCursor: true,
                spaceBetween: 10,
                breakpoints: {
                    // when window width is <= 640px
                    768: {
                      slidesPerView: 1,
                      slidesPerGroup: 1,
                      spaceBetweenSlides: 30
                    },
                    1024: {
                      slidesPerView: 2,
                      slidesPerGroup: 1,
                      spaceBetweenSlides: 30
                    },
                    1200: {
                      slidesPerView: 3,
                      slidesPerGroup: 2,
                      spaceBetweenSlides: 30
                    }
                }
            });
        })(jQuery);
    </script>
<?php
}

add_action('citysoul_testimonial_script_hook','citysoul_testimonial_script',10);
function citysoul_testimonial_script($id_ran) {
?>
    <script>
        (function($) {
        "use strict";
            var testiMonialHalf = new Swiper('.citysoul-testimonial-<?php echo esc_html($id_ran) ?>', {
                slidesPerView: 1,
                grabCursor:true,
                speed: 800,
                auto:true,
                paginationClickable: true,
                pagination: '.testi-pagging-<?php echo esc_html($id_ran) ?>',
                loop:true,
                autoHeight:true,
                grabCursor: true,
            });
        })(jQuery);
    </script>
<?php
}

add_action('citysoul_video_sc_script_hook','citysoul_video_sc_script',10);
function citysoul_video_sc_script($id_ran) {
?>
    <script type="text/javascript">
        (function($){
            "use strict";
            var yutubeUrl = $("#youtube-video-<?php echo esc_attr($id_ran)?>").attr('src')
            var i = null;
            $(".citysoul-playvideo-<?php echo esc_attr($id_ran)?>").mousemove(function() {
                clearTimeout(i);
                $(".btn-control").show();
                i = setTimeout(function () {
                    $(".btn-pause .btn-pause-<?php echo esc_attr($id_ran)?>").hide();
                }, 2000);
            }).mouseleave(function() {
                clearTimeout(i);
                $(".btn-pause .btn-pause-<?php echo esc_attr($id_ran)?>").hide();
            })
            //Click to play
            $('.btn-control').click(function(event) {
                if ($(this).hasClass('btn-play-<?php echo esc_attr($id_ran)?>')) {
                    $(this).removeClass('btn-play-<?php echo esc_attr($id_ran)?>').addClass('btn-pause btn-pause-<?php echo esc_attr($id_ran)?>')
                    $('.citysoul-playvideo-<?php echo esc_attr($id_ran)?>').addClass('active-video')
                    $("#youtube-video-<?php echo esc_attr($id_ran)?>").attr('src',yutubeUrl +'?autoplay=1')
                    // Vimeo and MP4 play
                    $("#vimeo-video").attr('src', vimeoUrl + '?autoplay=1');
                    $("#video-mp4").trigger('play');
                    return false;
                }
                if ($(this).hasClass('btn-pause btn-pause-<?php echo esc_attr($id_ran)?>')) {
                    //For show hide pause button
                    $(this).removeClass('btn-pause btn-pause-<?php echo esc_attr($id_ran)?>').addClass('btn-play-<?php echo esc_attr($id_ran)?>')
                    $('.citysoul-playvideo-<?php echo esc_attr($id_ran)?>').removeClass('active-video')
                    $("#youtube-video-<?php echo esc_attr($id_ran)?>").attr('src', yutubeUrl)
                    // Vimeo and MP4 play
                    $("#vimeo-video").attr('src', vimeoUrl);
                    $("#video-mp4").trigger('pause')
                    return false;
                }
                return false;
            })


        })(jQuery)

     </script>
<?php
}

add_action('citysoul_upcomming_script_hook','citysoul_upcomming_script',10);
function citysoul_upcomming_script($id_ran) {
?>
    <script>
        (function($){
            'use strict'
            var upCommingSlider = new Swiper('.citysoul-upcomming-<?php echo esc_html($id_ran) ?>', {
                speed: 800,
                slidesPerView: 4,
                slidesPerGroup: 4,
                nextButton: '.btn-comming-next-<?php echo esc_html($id_ran) ?>',
                prevButton: '.btn-comming-back-<?php echo esc_html($id_ran) ?>',
                grabCursor: true,
                spaceBetween: 20,

                breakpoints: {
                    // when window width is <= 320px
                    500: {
                      slidesPerView: 1,
                      slidesPerGroup: 1,
                      spaceBetweenSlides: 10
                    },
                    // when window width is <= 480px
                    768: {
                      slidesPerView: 2,
                      slidesPerGroup: 2,
                      spaceBetweenSlides: 20
                    },
                    // when window width is <= 640px
                    1024: {
                      slidesPerView: 3,
                      slidesPerGroup: 3,
                      spaceBetweenSlides: 20
                    }
                }
            });
        })(jQuery)
    </script>
<?php
}

add_action('citysoul_upcomming_small_script_hook','citysoul_upcomming_small_script',10);
function citysoul_upcomming_small_script($id_ran) {
?>
    <script>
        (function($){
            'use strict'
            var upCommingSlider = new Swiper('.citysoul-upcomming-<?php echo esc_html($id_ran) ?>', {
                speed: 800,
                slidesPerView: 4,
                slidesPerGroup: 2,
                loop: true,
                nextButton: '.btn-comming-next-<?php echo esc_html($id_ran) ?>',
                prevButton: '.btn-comming-back-<?php echo esc_html($id_ran) ?>',
                grabCursor: true,
                spaceBetween: 0,

                breakpoints: {
                    // when window width is <= 320px
                    500: {
                      slidesPerView: 1,
                      slidesPerGroup: 1,
                      spaceBetweenSlides: 10
                    },
                    // when window width is <= 480px
                    768: {
                      slidesPerView: 2,
                      slidesPerGroup: 2,
                      spaceBetweenSlides: 20
                    },
                    // when window width is <= 640px
                    1200: {
                      slidesPerView: 3,
                      slidesPerGroup: 3,
                      spaceBetweenSlides: 30
                    }
                }
            });
        })(jQuery)
    </script>
<?php
}

add_action('citysoul_list_dj_script_hook','citysoul_list_dj_script',10);
function citysoul_list_dj_script($randomID) {
?>
    <script>
        (function($){
            'use strict'
            var memBerSlider = new Swiper('.citysoul-team-slider-<?php echo esc_attr($randomID);?>', {
                // speed: 800,
                slidesPerView: 3,
                // slidesPerGroup: 1,
                loop: true,
                nextButton: '.btn-team-next-<?php echo esc_attr($randomID);?>',
                prevButton: '.btn-team-back-<?php echo esc_attr($randomID);?>',
                grabCursor: true,
                spaceBetween: 0,

                breakpoints: {
                    // when window width is <= 320px
                    320: {
                      slidesPerView: 1,
                      // slidesPerGroup: 1,
                      spaceBetweenSlides: 0
                    },
                    // when window width is <= 480px
                    480: {
                      slidesPerView: 1,
                      // slidesPerGroup: 1,
                      spaceBetweenSlides: 0
                    },
                    // when window width is <= 640px
                    600: {
                      slidesPerView: 1,
                      // slidesPerGroup: 1,
                      spaceBetweenSlides: 0
                    },
                    900: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 0
                    }
                }
            });
        })(jQuery)
    </script>
<?php
}

add_action('citysoul_product_thumbnail_script_hook','citysoul_product_thumbnail_script',10);
function citysoul_product_thumbnail_script() {
?>
    <script>
    (function($){
        "use strict";
        $('.list-thumbnails-city-soul .img-thumb').click(function(event) {
            var bigImg = $(this).attr('data-bigimg');
            $('.list-thumb-view li img-thumb').removeClass('active');
            $(this).addClass('active');
            $('.woocommerce-main-image img').attr({src:bigImg,srcset:bigImg});
            $('.woocommerce-main-image').attr('href', bigImg);
            return false;
        });
    })(jQuery)
    </script>
<?php
}
add_action('citysoul_js_slider_event_hook','citysoul_js_slider_event',10);
if(!function_exists('citysoul_js_slider_event')){
    function citysoul_js_slider_event($element) {
        ?>
         <script>
            (function($) {
            "use strict";
                var shopListSwiper = new Swiper('[data-citysoul="<?php echo esc_attr($element)?>"]', {
                    speed: 800,
                    slidesPerView: 4,
                    slidesPerGroup: 2,
                    loop: true,
                    nextButton: '[data-citysoul-btn="next-<?php echo esc_attr($element)?>"]',
                    prevButton: '[data-citysoul-btn="prev-<?php echo esc_attr($element)?>"]',
                    grabCursor: true,
                    // spaceBetween: 10,
                    breakpoints: {
                        // when window width is <= 320px
                        320: {
                          slidesPerView: 1,
                          slidesPerGroup: 1,
                          spaceBetweenSlides: 10
                        },
                        // when window width is <= 480px
                        480: {
                          slidesPerView: 1,
                          slidesPerGroup: 1,
                          spaceBetweenSlides: 20
                        },
                        // when window width is <= 640px
                        640: {
                          slidesPerView: 2,
                          slidesPerGroup: 2,
                          spaceBetweenSlides: 30
                        },
                        1024: {
                          slidesPerView: 3,
                          slidesPerGroup: 2,
                          spaceBetweenSlides: 30
                        }
                    }
                });
            })(jQuery);
        </script>
        <?php
    }
}
add_action('citysoul_js_masonry_hook','citysoul_js_masonry',10);
if(!function_exists('citysoul_js_masonry')) {
    function citysoul_js_masonry($element){
        ?>
         <script type="text/javascript">
            //<![CDATA[
            (function($){
                'use strict'
                $('[data-citysoul="<?php echo esc_attr($element)?>"]').masonry({
                    itemSelector:'[data-citysoul-masonry="<?php echo esc_attr($element)?>"]',
                    percentPosition: true
                });
            })(jQuery)
            //]]>
        </script>
        <?php
    }
}