<?php
/*
Plugin Name: Beau Newsletter Widget
Plugin URI: http://beautheme.com
Description: Newsletter widget
Author: VNMilky
Version: 1.0
Author URI: http://google.com

*/
/**
*
*/
class citysoul_newsletter_widget extends WP_Widget
{

	 /**
     * Setup widget: Name, base ID
     */
    function __construct() {
        $tpwidget_options = array(
            'classname' => 'Beau Newsletter Widget', //ID widget
            'description' => ''
        );
        parent::__construct('citysoul_newsletter_widget', 'Beau Newsletter Widget', $tpwidget_options);
    }
    /**
     * Create option for widget
     */
    function form( $instance ) {

        $default = array(
            'title' => esc_html__('Newsletter','citysoul'),
            'description'	=>	'',
            'center'        =>  0,

        );
        $instance = wp_parse_args( (array) $instance, $default);

        $title 		= 	esc_attr( $instance['title'] );
        $description    =   esc_attr($instance['description']);
        $center 	= 	esc_attr($instance['center']);


        //Show options for admin panel
        ?>

        <p>
            <input class="checkbox" type="checkbox"<?php checked($instance['center'])?> id="<?php echo $this->get_field_id('center')?>" name="<?php echo $this->get_field_name('center')?>" /> <label for="<?php echo $this->get_field_id('center')?>"><?php esc_html_e('Center','citysoul')?></label>
        </p>
        <p><?php esc_html_e('Title','citysoul')?><input type="text" class="widefat" name="<?php echo $this->get_field_name('title')?>" value="<?php print($title)?>">
        </p>
        <p><?php esc_html_e('Description','citysoul')?><textarea  rows="4" cols="50" class="widefat" name="<?php echo $this->get_field_name('description')?>"><?php print($description)?></textarea> </p>


        <?php
    }

    /**
     * save widget form
     */

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '', 'center' => 0, 'description' => '') );
        $instance['center'] = $new_instance['center'] ? 1 : 0;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['description'] = strip_tags($new_instance['description']);
        return $instance;
    }
/**
     * Show widget
     */

    function widget( $args, $instance ) {

        extract( $args );
        $title      = apply_filters( 'widget_title', $instance['title'] );
        $description      = $instance['description'];
        $center = ! empty( $instance['center'] ) ? '1' : '0';
        $class = '';
        if($center != 0) {
            $class = ' newsletterh3';
        }

?>            <div class="footer-widget<?php echo esc_attr($class)?>">
                <div class="citysoul-title citysoul-subcribe-title text-title citysoul-title-20 text-white  text-7x"><?php echo esc_html($title) ?></div>
                <div class="content-widget">

                    <div class="citysoul-subcribe-widget">
                        <div class="citysoul-title title-widget  text-16x text-title text-active title-subcribe">
                            <?php echo esc_html($description);?>
                        </div>

                        <form action="#" id="form-subcribe" class="form-newsletter">
                            <input class="citysoul-subcribe-input-text citysoul-input-text text-more" id="email" type="text" name="email" placeholder="<?php echo esc_html__('Enter Email','citysoul')?>">
                            <button class="citysoul-button citysoul-button-o btn-subcribe text-title"><?php echo esc_html__('subcribe','citysoul')?></button>
                            <div class="success-form-message text-more"></div>
                        </form>
                    </div><!--End .subcribe-widget-->

                </div><!--End .content-widget-->
            </div><!--End .footer-widget-->
            <script>
                (function($){
                    // Subcribe mailchimp
                    $('#form-subcribe').submit(function() {
                        // update user interface
                        $('.success-form-message').html('<?php esc_html_e('Adding email address...','citysoul');?>');
                        $('.success-form-message').removeClass('error');
                        $('.success-form-message').removeClass('success');
                        // Prepare query string and send AJAX request
                        $.ajax({

                            url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
                            data: 'mailchimp-ajax=true&email=' + escape($('#email').val()),
                            success: function(msg) {
                                //console.log(msg);
                                var message = jQuery.parseJSON( msg );
                                console.log(message)
                                if(message.type == 'success') {
                                    $('.success-form-message').addClass('success');
                                    $('.success-form-message').removeClass('error');
                                    $('.success-form-message').html(message.txt);
                                }
                                else {
                                    $('.success-form-message').addClass('error');
                                    $('.success-form-message').removeClass('success');
                                    $('.success-form-message').html(message.txt);
                                }



                            }
                        });

                        return false;
                    });
                })(jQuery)
            </script>

<?php
        //printf('%s',$after_widget);
    }
}

/*
 * Create widget item
 */
add_action( 'widgets_init', 'citysoul_reg_newletter_widget' );
function citysoul_reg_newletter_widget() {
    register_widget('citysoul_newsletter_widget');
}