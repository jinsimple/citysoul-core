<?php 
extract(shortcode_atts(array(
    'latitude'                  =>  '',
    'longitude'                 =>  '',
    'map_maker'                 =>  '',
    'color_water'               =>  '',
    'map_height'                    =>  '',
    'enable_scroll'             =>  'true',
), $atts));
$map_marker = wp_get_attachment_image_src($map_maker);
$map_marker  =$map_marker[0];

if($color_water == ''){
    $color_water = '#000';
}
if($map_height == ''){
    $map_height = '800px';
}
if($latitude == '' ) {
    $latitude = '37.4029937';
}
if($longitude == ''){
    $longitude = '-122.181181';
}
//$api_google = citysoul_check_option_theme('google-api');
?>
<section class="contact-page">
    <div class="citysoul-map-view">
    <?php 
    /*
     * After loop
     * citysoul_map_function_hook - 10
     */
        do_action( 'citysoul_map_script_hook', $enable_scroll, $latitude, $longitude, $color_water, $map_marker);
    ?>
<style type="text/css"> 
    #citysoul-contact-map{ 
        height: <?php echo esc_attr($map_height) ?>;
        width: 100%;
    }
    .citysoul-map-view{
        min-height: <?php echo esc_attr($map_height) ?>;
    }
</style>
        <div id="citysoul-contact-map"></div><!--End #citysoul-contact-map-->
    </div>
</section><!--End .contact-page-->