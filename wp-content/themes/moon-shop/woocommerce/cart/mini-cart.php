<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
//enqueue inline style css
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$moon_shop_custom_inline_style = '';
if (isset($moon_shop_optionsValue['moon-shop-cart-color']) && !empty($moon_shop_optionsValue['moon-shop-cart-color'])) {
	$moon_shop_custom_inline_style .= '.header-cart .cart-btn i { color: '.$moon_shop_optionsValue['moon-shop-cart-color'].'; }';
}
if (isset($moon_shop_optionsValue['moon-shop-cart-number-color']) && !empty($moon_shop_optionsValue['moon-shop-cart-number-color'])) {
	$moon_shop_custom_inline_style .= '.header-cart .cart-btn .cart-number { color: '.$moon_shop_optionsValue['moon-shop-cart-number-color'].'; }';
}
if (isset($moon_shop_optionsValue['moon-shop-cart-number-bg-color']) && !empty($moon_shop_optionsValue['moon-shop-cart-number-bg-color'])) {
	$moon_shop_custom_inline_style .= '.header-cart .cart-btn .cart-number { background-color: '.$moon_shop_optionsValue['moon-shop-cart-number-bg-color'].'; }';
}
wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );

do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="woocommerce header-cart dropdown">

    <button id="menu1" class="cart-btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i><span class="cart-number"><?php echo WC()->cart->get_cart_contents_count(); ?></span></button>

    <div class="headercart-wrapper dropdown-menu" role="menu" aria-labelledby="menu1">

        <h2><?php esc_html_e( 'Shopping Cart' , 'moon-shop' ); ?></h2>

		<ul class="woocommerce-mini-cart products cart_list product_list_widget">
			<?php if ( ! WC()->cart->is_empty() ) : ?>
				<?php
				do_action( 'woocommerce_before_mini_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php if ( ! $_product->is_visible() ) : ?>
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $product_permalink ); ?>">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
								</a>
							<?php endif; ?>
							<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $product_price, $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
							<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times-circle-o"></i></a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'moon-shop' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
							?>
						</li>
						<?php
					}
				}

				do_action( 'woocommerce_mini_cart_contents' );
			?>
			<?php else : ?>

				<div class="order-complete-mgs text-center">
		            <p class="text-center"><?php echo esc_html__( 'Your cart is currently empty. ' , 'moon-shop' ) ?></p>
		        </div>

			<?php endif; ?>
		</ul>

		<div class="total-price text-center fix">
			<p class="woocommerce-mini-cart__total total"><?php esc_html_e( 'Total' , 'moon-shop' ); ?></p>
			<p class="price"><?php echo WC()->cart->get_cart_subtotal(); ?></p>
		</div>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<div class="text-center fix">
			<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
