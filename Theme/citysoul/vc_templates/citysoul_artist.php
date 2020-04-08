<?php 
$title_artist_box = $title_artist_boxcaption = $artist_id = $title_color = $title_caption_color = $name_artist_color = $genres_color = $description_color = $active_color = $boderimg_color = $css = '';
    extract(shortcode_atts(array(
                'title_artist_box'              =>  '',
                'title_artist_boxcaption'       =>  '',
                'artist_id'                     =>  '',
                'title_color'                   =>  '',
                'title_caption_color'           =>  '', 
                'name_artist_color'             =>  '',
                'genres_color'                  =>  '',
                'description_color'             =>  '',
                'active_color'                  =>  '',
                'boderimg_color'                =>  '',
                'css'                           =>  '',
                ),
        $atts)
    );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$randID = rand(1, 99999);
$setup = array(
    '.dj-infomation .text-change'   => array(
        'color'                     =>  $title_color,
        ),
    '.dj-infomation .text-cap'      => array(
        'color'                     =>  $title_caption_color,
        ),  
    '.maindj-info .citysoul-title'  => array(
        'color'                     =>  $name_artist_color,
        ),  
    '.citysoul-tags'   => array(
        'color'                     =>  $genres_color,
        ),
    '.citysoul-tags *'   => array(
        'color'                     =>  $genres_color,
        ),
    '.maindj-info .text-description '=> array(
        'color'                     =>  $description_color,
        ),
    '.citysoul-social li a:hover'   =>  array(
        'background'                => $active_color,   
        ),
    '.cover-soundcloud .dj-image:after'     =>  array(
        'border-color'                      => $boderimg_color,   
        ),
       
    );
// Make css style for shortcode
echo citysoul_css_shortcode('artist-'.$randID, $setup);
if($title_artist_box == ''){
    $title_artist_box = esc_html__('djs','citysoul');
}
if($title_artist_boxcaption == ''){
    $title_artist_boxcaption = esc_html__('we have some amazing !','citysoul');
}
if($artist_id == '') {
    $args = array(
        'post_type' =>  'artist',
        'posts_per_page'    =>  1,
        );

    $wp = new WP_Query($args);
    wp_reset_postdata();
    $artist_id = $wp->posts[0]->ID;

} 
?>
<section class="single-dj <?php echo esc_attr( $css_class ); ?>" id="artist-<?php echo esc_attr( $randID );?>">
    <div class="container">
        <div class="dj-infomation col-md-5 col-sm-12 col-xs-12">
            <div class="title-dj text-right">
                <div class="citysoul-title text-title text-white text-change"><?php echo esc_html($title_artist_box);?></div>
                <div class="citysoul-desc text-title text-active text-cap"><?php echo esc_html($title_artist_boxcaption);?></div>
            </div><!--End .dj-infomation-->
            <div class="maindj-info text-right">
                <div class="citysoul-title text-title text-6x text-white"><?php echo get_the_title($artist_id);?></div>
                <div class="citysoul-tags text-more text-active">
                <?php if (function_exists('beau_theme_plugin_init')) {
                        echo citysoul_get_taxonomy_list_by_post_id('genres_artist',$artist_id);
                }?>
                </div>
                <div class="clearfix"></div>
                <div class="desc-small text-desc text-description">
                <?php 
                    if (function_exists('the_field')) {
                        the_field('art_description',$artist_id);
                    }
                ?>
                </div>
                <div class="clearfix"></div>
                <ul class="citysoul-social social-round">
                    <?php 
                        $fb = $tw = $yt = $sc = '';
                        if (function_exists('get_field')) {
                            $fb = get_field('art_facebook',$artist_id)?:get_field('art_facebook',$artist_id);
                            $tw = get_field('art_twitter',$artist_id)?:get_field('art_twitter',$artist_id);
                            $yt = get_field('art_youtube',$artist_id)?:get_field('art_youtube',$artist_id);
                            $sc = get_field('art_soundcloud',$artist_id)?:get_field('art_soundcloud',$artist_id);
                        }
                        if($fb != NULL) :
                    ?>
                    <li><a href="<?php echo esc_url($fb)?>" class="fa fa-facebook"></a></li>
                    <?php endif;

                        if($tw != NULL) :
                    ?>
                    <li><a href="<?php echo esc_url($tw)?>" class="fa fa-twitter"></a></li>
                    <?php endif;

                        if($yt != NULL) :
                    ?>
                    <li><a href="<?php echo esc_url($yt)?>" class="fa fa-youtube"></a></li>
                    <?php endif;
                        if($sc != NULL) :
                    ?>
                    <li><a href="<?php echo esc_url($sc)?>" class="fa fa-soundcloud"></a></li>
                    <?php endif;?>
                </ul>
            </div><!--End .maindj-info-->
        </div><!--End .dj-infomation-->
        <div class="dj-cover col-md-7 col-sm-12 col-xs-12">
            <div class="cover-soundcloud">
                <div class="dj-image">
                    <div class="img-border">                        
                        <?php echo get_the_post_thumbnail($artist_id); ?>                   
                    </div>
                </div>
                <div class="dj-soundcloud">
                <?php 
                if (function_exists('get_field')) {
                    echo wp_oembed_get(get_field('art_sc_feature_track',$artist_id)?:get_field('art_sc_feature_track',$artist_id), array('height'=>450));
                }
                ?>
                </div>
            </div><!--End .cover-soundcloud-->
        </div><!--End .dj-cover-->

    </div>
</section><!--End .single-dj-->
