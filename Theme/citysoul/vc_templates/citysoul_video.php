<?php
$option = $img_video = $url_video = $title_element = $link_button = '';

$textcolor = $colorborder = $bgcolor = $linkcolor = $linkhover = $css = $titles = $google_fonts = $test_element ='';
extract(shortcode_atts(array(
    'option'            => '',
    'img_video'         => '',
    'url_video'         => '',
    'title_element'     => '',
    'text_button'       => '',
    'link_button'       => '',
    'colorborder'       => '',
    'bgcolor'           => '',
    'linkcolor'         => '',
    'linkhover'         => '',
    'css'               => '',
    'titles'            => '',
    'google_fonts'      => '',
    'test_element'      => '',
), $atts));


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
//Get link image background
$img_video_link = wp_get_attachment_image_src($img_video, "full");
$img_video = $img_video_link[0];
// Make a random ID for shortcode
$id_ran = rand(1, 99999);
$randomID   =  'play_video_'.$id_ran;

$href = vc_build_link( $link_button );
if ($href['title'] == '') {
    $href['title'] = $href['url'];
}
if ($href['url'] == '') {
    $href['url'] = '#';
}
//Setup style for shortcode
$setup      = array(
    '.citysoul-playvideo .img-video' => array(
        'background'                 => $bgcolor,
    ),
    '.citysoul-playvideo .text-button .video-title' => array(
        'color'                 => $textcolor,
    ),
    '.citysoul-playvideo .text-button .all-video-link a' => array(
        'color'                 => $linkcolor,
    ),
    '.citysoul-playvideo .text-button .all-video-link a:hover' => array(
        'color'                 => $linkhover,
    ),
    '.citysoul-playvideo .text-button .all-video-link:before' => array(
        'background'                 => $colorborder,
    ),
);
// Make css style for shortcode
echo citysoul_css_shortcode($randomID, $setup);
$url_video =  str_replace('watch?v=','embed/',$url_video);
?>
<div class="<?php echo esc_attr( $css_class ); ?>">
    <section class="play-video" id="<?php echo esc_html($randomID) ?>">
        <div class="citysoul-playvideo citysoul-playvideo-<?php echo esc_attr($id_ran)?>">
            <div class="video-play">
                <iframe id="youtube-video-<?php echo esc_attr($id_ran)?>" width="560" height="315" src="<?php echo esc_url($url_video) ?>" frameborder="0" allowfullscreen='false'></iframe>
            </div>
            <?php if ($img_video != ''): ?>
                <div class="img-video player-preview"><img src="<?php echo esc_url($img_video); ?>" alt="video-image"></div>
            <?php endif ?>
            <div class="text-button text-center desc-book-player">
                <div class="container">
                    <div class="btn-control btn-play btn-play-<?php echo esc_attr($id_ran)?>" id="click-to-play" style="display: block;"><span class="play-icon"></span></div>
                    <?php if ($title_element != ''): ?>
                        <div class="citysoul-title text-title text-white text-6x video-title">
                            <?php echo esc_html($title_element) ?>
                        </div>
                    <?php endif ?>

                    <?php if ($href['title'] != ''): ?>
                        <div class="all-video-link text-more">
                            <a href="<?php echo esc_html($href['url']) ?>" target="$href['target']">
                                <?php echo esc_html($href['title']) ?>
                            </a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div><!--End .citysoul-playvideo-->
        <?php 
        /*
        * citysoul_video_sc_script - 10
        */
            do_action( 'citysoul_video_sc_script_hook', $id_ran );
        ?>
    </section>
</div>