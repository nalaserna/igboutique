<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce;
?>

<div class="cart-page-container fix">
    <div class="cart-page-tablist text-center">
        <ul>
            <li>
                <a class="<?php echo ( is_cart() || is_checkout() ) ? 'active' : ''; ?>"
                   href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
                    <span class="number"><?php _e( '1' , 'moon-shop' ); ?></span>
                    <p><?php _e( 'Carrito de compras' , 'moon-shop' ); ?></p>
                </a>
            </li>
            <li>
                <a class="<?php echo ( is_checkout() ) ? 'active' : ''; ?>"
                   href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>">
                    <span class="number"><?php _e( '2' , 'moon-shop' ); ?></span>
                    <p><?php _e( 'Finalizar compra' , 'moon-shop' ); ?></p>
                </a>
            </li>
            <li>
                <a class="<?php echo ( is_wc_endpoint_url( 'order-received' ) ) ? 'active' : ''; ?>"
                   href="#order-complete">
                    <span class="number"><?php _e( '3' , 'moon-shop' ); ?></span>
                    <p><?php _e( 'Orden Completa' , 'moon-shop' ); ?></p>
                </a>
            </li>
        </ul>
    </div>
    <div class="order-complete-mgs text-center">
        <?php 
        /**
        * @hooked wc_empty_cart_message - 10
        */
        do_action( 'woocommerce_cart_is_empty' ); 
        ?>
    </div>

    <?php if( wc_get_page_id( 'shop' ) > 0 ) : ?>
        <p class="return-to-shop text-center place-order">
            <a class="button wc-backward place-order-btn"
               href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
                <?php _e( 'Regresar a la tienda' , 'moon-shop' ) ?>
            </a>
        </p>
    <?php endif; ?>
</div>