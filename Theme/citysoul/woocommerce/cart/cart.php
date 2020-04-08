<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
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
            <span class="text-title citysoul-title text-white text-5x"><?php esc_html_e( 'Shopping cart', 'citysoul' ); ?></span>
        </div><!--End .title-page-->
        <div class="citysoul-button-banner">
            <div class="container">
                <a href="<?php echo esc_url($shop_page_url) ?>" class="citysoul-button citysoul-button-more citysoul-button-o text-active text-title"><?php esc_html_e( 'Goto store', 'citysoul' ); ?></a>
            </div>
        </div>
    </div><!--End .banner-page-->
</section>
<span class="clearfix"></span>
<div class="container">
	<?php wc_print_notices();

	do_action( 'woocommerce_before_cart' );
	?>
</div>
<section class="shop-page">
	<div class="container">
		<div class="shopping-cart box-check-out">

		<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<div class="main-cart  col-md-8 col-sm-9 col-xs-12">
				<table class="shop_table cart" cellspacing="0">
					<thead class="text-more text-16x">
						<tr>
							<th class="product-name col-sm-6 col-md-6 hidden-xs"><?php esc_html_e( 'Product name', 'citysoul' ); ?></th>
							<th class="product-price col-sm-2 col-md-2 col-xs-4"><?php esc_html_e( 'Price', 'citysoul' ); ?></th>
							<th class="product-quantity col-sm-2 col-md-2 col-xs-4"><?php esc_html_e( 'Quantity', 'citysoul' ); ?></th>
							<th class="product-subtotal col-sm-2 col-md-2 col-xs-4"><?php esc_html_e( 'Total', 'citysoul' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

						<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

									<td class="product-thumbnail">
										<div class="product-item">
											<div class="product-image">
											<?php
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

												if ( ! $_product->is_visible() ) {
													print ($thumbnail);
												} else {
													printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
												}
											?>
											</div>
											<div class="product-info-name ">
												<span class="text-title title-product">
												<?php
													if ( ! $_product->is_visible() ) {
														echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
													} else {
														echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" classs="text-title title-product">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
													}
												?>
												<?php
													// Meta data
													echo WC()->cart->get_item_data( $cart_item );

													// Backorder notification
													if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
														echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'citysoul' ) . '</p>';
													}
													$excerpt = apply_filters('get_the_excerpt', get_post_field('post_excerpt', $product_id));
												?>
												</span>
												<span class="clearfix"></span>
												<span class="text-desc"><?php echo esc_html($excerpt) ?></span>
											</div>
										</div>
									</td>

									<td class="product-price col-sm-2 col-md-2 col-xs-4">
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</td>

									<td class="product-quantity col-sm-2 col-md-2 col-xs-4">
										<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
													'min_value'   => '0'
												), $_product, false );
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
										?>

										<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="remove text-more" title="%s" data-product_id="%s" data-product_sku="%s">'.__('Remove', 'citysoul').'</a>',
												esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
												__( 'Remove this item', 'citysoul' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
										?>

									</td>

									<td class="product-subtotal col-sm-2 col-md-2 col-xs-4">
										<?php
											echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
										?>
									</td>
								</tr>
								<?php
							}
						}

						?>
					</tbody>
					<tfoot>
						<tr class="text-title text-active total">
							<td class="amount-total-text col-md-10 col-sm-10 hidden-xs pull-left" colspan="3"><?php esc_html_e('Grand total', 'citysoul') ;?></td>
							<td class="amount amount-center col-md-2 col-sm-2 col-xs-12 pull-left"><?php echo WC()->cart->get_cart_total(); ?></td>
						</tr>
						<tr>
							<td colspan="4">
								<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
								<input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'citysoul' ); ?>" />
								<?php do_action( 'woocommerce_cart_actions' ); ?>

								<?php wp_nonce_field( 'woocommerce-cart' ); ?>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="shipping-method box-total pull-right col-md-4 col-sm-3 col-xs-12">
				<div class="content-box-checkout">
					<div class="title-box-checkout coupon-form text-title title-white-form">
						<?php $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) ); ?>
						<a href="<?php print ($shop_page_url); ?>"><?php esc_html_e('Keep shopping', 'citysoul'); ?></a>
					</div>
					<div class="content-box-cart box-half">
						<?php
						do_action( 'woocommerce_cart_collaterals' );

						?>
					</div>

					<div class="footer-box-cart box-half">
						<?php if (  empty( WC()->cart->applied_coupons ) ) { ?>
							<div class="coupon-cart">

								<label class="title-box-checkout coupon-form text-title title-white-form"  for="coupon_code"><?php esc_html_e( 'Have a coupon ? Click here to enter your code', 'citysoul' ); ?>:</label> </div>
								<ul class="input-coup-on checkout-list-input">
									<li class="coupon-text">
										<input type="text" name="coupon_code" class="input-text text-more input-coupon" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'citysoul' ); ?>" />
										<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'citysoul' ); ?>" />
									</li>
								</ul>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>

						<?php } ?>
					</div>
				</div>
			</div>
		</form>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</div>
</div>
</section>
<?php do_action( 'woocommerce_after_cart' ); ?>
