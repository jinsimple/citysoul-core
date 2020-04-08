<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop;

// if ( empty( $product ) || ! $product->exists() ) {
// 	return;
// }
//
// if ( ! $related = $product->get_related( $posts_per_page ) ) {
// 	return;
// }
//
// $args = apply_filters( 'woocommerce_related_products_args', array(
// 	'post_type'            => 'product',
// 	'ignore_sticky_posts'  => 1,
// 	'no_found_rows'        => 1,
// 	'posts_per_page'       => $posts_per_page,
// 	'orderby'              => $orderby,
// 	'post__in'             => $related,
// 	'post__not_in'         => array( $product->id )
// ) );
//
// $products                    = new WP_Query( $args );
// $woocommerce_loop['name']    = 'related';
// $woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

if ( $related_products ) : ?>
<section class="more-product">
	<div class="related products citysoul-more-product">
		<div class="citysoul-title-box-menu text-center">
            <div class="drink-title text-title citysoul-title text-7x">
            	<?php esc_html_e( 'More', 'citysoul' ); ?>
            </div>
            <a class="text-main-list view-all-link text-more text-16x" href="<?php echo esc_url($shop_page_url) ?>">
            	<?php esc_html_e( 'Goto store', 'citysoul' ); ?>
            </a>
        </div>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>
				<li <?php post_class('citysoul-product-item col-sm-3 col-xs-12'); ?> >
					<?php
					 	$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' ); ?>
				</li>
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
</section>
<?php endif;

wp_reset_postdata();
