<?php 
/*
Plugin Name: Beau Contact Widget
Plugin URI: http://beautheme.com
Description: Contact widget
Author: VNMilky
Version: 1.0
Author URI: http://google.com

*/
/**
* 
*/
class citysoul_contact_widget extends WP_Widget
{
    
     /**
     * Setup widget: Name, base ID
     */
    function __construct() {
        $tpwidget_options = array(
            'classname' => 'Beau Contact Widget', //ID widget
            'description' => esc_html__('This widget show your contact ','citysoul')
        );
        parent::__construct('citysoul_contact_widget', 'Beau Contact Widget', $tpwidget_options);
    }
    /**
     * Create option for widget
     */
    function form( $instance ) {

        $default = array(
            'title' => esc_html__('Contact','citysoul'),
            'address'   =>  '',
            'phone'     =>  '',
            'email'     =>  '',
            'latitude'  =>  '',
            'longitude' =>  '',
            'scroll'    =>  '',
        );

        $instance = wp_parse_args( (array) $instance, $default);

        $title      =   esc_attr( $instance['title'] );
        $address    =   esc_attr($instance['address']);
        $phone      =   esc_attr($instance['phone']);
        $email      =   esc_attr($instance['email']);
        $latitude   =   esc_attr($instance['latitude']);
        $longitude   =   esc_attr($instance['longitude']);
        $scroll   =   esc_attr($instance['scroll']);

?> 

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo esc_html__('Title','citysoul'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('address'); ?>"><?php echo esc_html__('Address','citysoul'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo esc_attr($address); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php echo esc_html__('Phone','citysoul'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('email'); ?>"><?php echo esc_html__('Email','citysoul'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>
        <p> Location Maps </p>
        <p><label for="<?php echo $this->get_field_id('latitude'); ?>"></label> <input class="widefat" id="<?php echo $this->get_field_id('latitude'); ?>" name="<?php echo $this->get_field_name('latitude'); ?>" placeholder="<?php echo esc_html__('Latitude','citysoul'); ?>" type="text" value="<?php echo esc_attr($latitude); ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('longitude'); ?>"></label> <input class="widefat" id="<?php echo $this->get_field_id('longitude'); ?>" name="<?php echo $this->get_field_name('longitude'); ?>" placeholder="<?php echo esc_html__('Longitude','citysoul'); ?>" type="text" value="<?php echo esc_attr($longitude); ?>" /></p>
        <p>
            
            <input class="checkbox" type="checkbox"<?php checked( $instance['scroll'] ); ?> id="<?php echo $this->get_field_id('scroll'); ?>" name="<?php echo $this->get_field_name('scroll'); ?>" /> <label for="<?php echo $this->get_field_id('scroll'); ?>"><?php echo esc_html__('Enable Scroll','citysoul'); ?></label>
        </p>
        
<?php 
    }

    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['address'] = strip_tags($new_instance['address']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['email'] = strip_tags($new_instance['email']);
        $instance['longitude'] = strip_tags($new_instance['longitude']);
        $instance['latitude'] = strip_tags($new_instance['latitude']);
        $instance['scroll'] = $new_instance['scroll'] ? 1 : 0;
        return $instance;
    }
/**
     * Show widget
     */

    function widget( $args, $instance ) {

        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( 'Contact','citysoul' ) : $instance['title'], $instance, $this->id_base );
        $address    = $instance['address'] ;
        $phone      = $instance['phone'] ;
        $email      = $instance['email'] ;
        $s = ! empty( $instance['scroll'] ) ? '1' : '0';
        $height = '600px';
        $latitude = empty($instance['latitude']) ? '37.4029937' : $instance['latitude'];
        $longitude = empty($instance['longitude']) ? '-122.181181' : $instance['longitude'];
?><div class="footer-widget">
        <div class="title-widget text-16x citysoul-title  text-title citysoul-title-20 text-active"><?php echo esc_html($title);?></div>
        <div class="content-widget widget-address">
            <ul class="address-widget">
                <li class="text-more    "><strong class="text-title">Add</strong> : <span><?php echo esc_html($address);?></span></li>
                <li class="text-more    "><strong class="text-title">phone</strong> :<span><?php echo esc_html($phone);?></span></li>
                <li class="text-more    "><strong class="text-title">email</strong> : <span><?php echo esc_html($email);?></span></li>
            </ul>
            <div class="clearfix"></div>
            <ul class="citysoul-social social-round">
                <?php if(citysoul_GetOption('beau-facebook') != NULL) : ?>
                <li><a href="<?php print(citysoul_GetOption('beau-facebook'))?>" class="fa fa-facebook"></a></li>
                <?php endif; ?>
                <?php if(citysoul_GetOption('beau-twitter') != NULL) : ?>
                <li><a href="<?php print(citysoul_GetOption('beau-twitter'))?>" class="fa fa-twitter"></a></li>
                <?php endif; ?>
                <?php if(citysoul_GetOption('beau-youtube') != NULL) : ?>
                <li><a href="<?php print(citysoul_GetOption('beau-youtube'))?>" class="fa fa-youtube"></a></li>
                <?php endif; ?>
                <?php if(citysoul_GetOption('beau-souncloud') != NULL) : ?>
                <li><a href="<?php print(citysoul_GetOption('beau-souncloud'))?>" class="fa fa-souncloud"></a></li>
                <?php endif; ?>
            </ul>
            <div class="clearfix"></div>
            <?php if(!empty($instance['latitude']) && !empty($instance['longitude'])): ?>
            <div  id="show-map-footer" data="close" class="btn-border citysoul-button text-active citysoul-button-o" data-action="show-map">
                <i class="fa fa-map-marker"></i>
                <span class="text-title text-active"><?php echo esc_html__( 'show map','citysoul' );?></span> 
            </div>
            <?php endif; ?>

   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOeGmyX-gl-BqGDrCvYd1qeEWstO9553Y&sensor=false&libraries=places,geometry&v=3.18"></script>
    <script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        var mapOptions = {
            zoom: 10,
            scrollwheel: true,
            // mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: new google.maps.LatLng(<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>),
            styles: [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#03a9f4"},{"visibility":"on"}]}]
        };
        var mapElement = document.getElementById('map-for-page');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>),
            map: map,
            icon: "",
            title: 'Map title'
        });
    }
</script>
<style type="text/css"> #map-for-page{ width: 100%; height: <?php echo esc_attr($height);?>!important;display: none;}
</style> <?php 
add_action( 'wp_footer', 'map_for_page' );
function map_for_page(){
?>
        <div id="map-for-page"></div><!--End #map-for-page--><?php } ?>
        <script type="text/javascript">
            (function($){
                'use strict';
                $("#show-map-footer").click(function(event) {
                    var gdata = $(this).attr('data');
                    if (gdata == null || gdata == 'close') {
                        $('#map-for-page').show();
                        $('#show-map-footer .text-title').text('<?php echo esc_html__( 'hide map','citysoul' );?>');
                        $(this).attr('data','open');
                    }
                    else if (gdata == 'open' ){
                        $('#map-for-page').hide()
                        $('#show-map-footer .text-title').text('<?php echo esc_html__( 'show map','citysoul' );?>');
                        $(this).attr('data','close');
                    }
                    else {
                        $('#map-for-page').show()
                        $('#show-map-footer .text-title').text('<?php echo esc_html__( 'show map','citysoul' );?>');
                        $(this).attr('data','close');
                    }

                    $('html, body').animate({
                    scrollTop: $("#map-for-page").offset().top}, 40);
                      
                return false;
                });
             })(jQuery)
        </script>

    </div><!--End .content-widget-->
</div><!--End .footer-widget-->
<?php
        //printf('%s',$after_widget);
    }
}

/*
 * Create widget item
 */
add_action( 'widgets_init', 'citysoul_reg_contact_widget' );
function citysoul_reg_contact_widget() {
    register_widget('citysoul_contact_widget');
}