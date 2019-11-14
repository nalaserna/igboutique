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
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
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
                    <p><?php _e( 'Orden completa' , 'moon-shop' ); ?></p>
                </a>
            </li>
        </ul>
    </div>

    <div class="cart-page-title cart-page-title-2 text-center">
        <h1><?php _e( 'Finalizar compra' , 'moon-shop' ); ?></h1>
        <p><?php _e( 'Información personal y de pago' , 'moon-shop' ); ?></p>
    </div>
    <?php

    do_action( 'woocommerce_before_checkout_form' , $checkout );
    // If checkout registration is disabled and not logged in, the user cannot checkout
    if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
        echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message' , __( 'You must be logged in to checkout.' , 'moon-shop' ) );
        return;
    }
    ?>
    <form name="checkout" method="post" class="checkout woocommerce-checkout moon-form full-width" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <div class="row padding-left-right">
            <?php if( $checkout->get_checkout_fields() ) : ?>
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                <div class="col-md-6 col-xs-12">
                    <div class="billing-details">
                        <div class="checkout-form" id="customer_details">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            <div class="shipping-details">
                                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                            </div>
                        </div>
                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-6 col-xs-12">
                <div class="order-details">
                    <div class="cart-page-title">
                        <h3 id="order_review_heading"><?php _e( 'Your order' , 'moon-shop' ); ?></h3>
                    </div>
                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <div class="table-responsive">
                            <fieldset>
                                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>
    </form>
    <?php do_action( 'woocommerce_after_checkout_form' , $checkout ); ?>
</div>