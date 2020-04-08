<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage citysoul
 * @since citysoul 0.0.1
 */
get_header();

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
$store_cover = get_template_directory_uri().'/asset/images/checkout-cover.jpg';
?>
<section class="citysoul-cover-page">
    <div class="citysoul-banner-page">
        <div class="citysoul-banner-image">
            <img class="lazy" data-original="<?php echo esc_url($store_cover);?>" alt="<?php echo esc_attr(get_bloginfo('name'));?>">
        </div><!--End .citysoul-banner-image-->
        <div class="title-page-text text-center">
            <span class="text-title citysoul-title text-white text-5x"><?php esc_html_e( 'Booking', 'citysoul' ); ?></span>
        </div><!--End .title-page-->
    </div><!--End .banner-page-->
</section>
<span class="clearfix"></span>
<section class="contact-page">
    <div class="citysoul-contact">
        <div class="container">
            <div class="citysoul-form-contact">
                <div class="title-form-contact col-md-6 col-sm-6 col-xs-12 pull-right">
                    <div class="citysoul-title text-title text-active text-3x">Write to us</div>
                    <div class="text-desc desc-contact">It is a long established fact that a reader will be distracted by the readable content of a page when looking </div>
                    <div class="form-contact">
                        <form action="#" method="POST">
                            <ul class="list-form-text">
                                <li>
                                    <input class="text-16x citysoul-input-text text-more" type="text" name="txt-name" placeholder="Name">
                                </li>
                                <li>
                                    <input class="text-16x citysoul-input-text text-more" type="text" name="txt-email" placeholder="Email">
                                </li>
                                <li>
                                    <input class="text-16x citysoul-input-text text-more" type="text" name="txt-phone" placeholder="Phone">
                                </li>
                                <li>
                                    <textarea class="text-16x citysoul-input-text text-more" name="txt-Mess" placeholder="Mess"></textarea>
                                </li>
                                <li>
                                    <button class="citysoul-button citysoul-button-o btn-contact text-title">Send</button>
                                </li>
                            </ul>
                        </form>
                    </div><!--End form-contact-->
                </div><!--End .title-form-->
            </div>
        </div>
    </div><!--End .citysoul-contact-->
</section><!--End .contact-page-->
<?php
get_footer();
