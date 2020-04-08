<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
$store_cover = get_template_directory_uri().'/asset/images/checkout-cover.jpg';
?>
<section class="citysoul-cover-page">
    <div class="citysoul-banner-page">
        <div class="citysoul-banner-image">
        	<img class="lazy" data-original="<?php echo esc_url($store_cover);?>" alt="<?php echo esc_attr(get_bloginfo('name'));?>">
        </div><!--End .citysoul-banner-image-->
        <div class="title-page-text text-center">
            <span class="text-title citysoul-title text-white text-5x"><?php esc_html_e( 'Check out', 'citysoul' ); ?></span>
        </div><!--End .title-page-->
    </div><!--End .banner-page-->
</section>
<span class="clearfix"></span>
<div class="container">
	<?php wc_print_notices();

	do_action( 'woocommerce_before_checkout_form', $checkout );
	?>
</div>

<?php

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'citysoul' ) );
	return;
}

?>
<div class="container">
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col2-set" id="customer_details">
				<div class="col-1">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>

				<div class="col-2">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>

		<h3 id="order_review_heading"><?php _e( 'Your order', 'citysoul' ); ?></h3>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	</form>
</div>
<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
