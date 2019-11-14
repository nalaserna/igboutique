<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce;

echo '<div class="cart-page-container fix">';

if( $order ) : ?>

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

    <?php if( $order->has_status( 'failed' ) ) : ?>
        <div class="order-complete-mgs text-center">
            <p class="woocommerce-thankyou-order-failed"><?php _e( '¡Oops! Tu orden no pudo ser procesada por tu banco. Por favor contacta a tu banco y vuelve a intentar la transacción.' , 'moon-shop' ); ?></p>

            <p class="woocommerce-thankyou-order-failed-actions text-center place-order">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
                   class="button pay place-order-btn"><?php _e( 'Pay' , 'moon-shop' ) ?></a>
                <?php if( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
                       class="button pay place-order-btn"><?php _e( 'My Account' , 'moon-shop' ); ?></a>
                <?php endif; ?>
            </p>
        </div>

    <?php else : ?>
        <div class="order-complete-mgs text-center">
            <p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text' , __( '¡Gracias por tu compra, wapa! Nos podremos en contacto para realizar el envío.' , 'moon-shop' ) , $order ); ?></p>
        </div>

        <ul class="woocommerce-thankyou-order-details order_details order-information text-center fix">
            <li class="order single">
                <span><?php _e( 'Numero de orden:' , 'moon-shop' ); ?></span>
                <h4><?php echo esc_attr( $order->get_order_number() ); ?></h4>
            </li>
            <li class="date single">
                <span><?php _e( 'Fecha:' , 'moon-shop' ); ?></span>
                <h4><?php echo wc_format_datetime( $order->get_date_created() ); ?></h4>
            </li>
            <?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
                    <li class="woocommerce-order-overview__email email single">
                        <span><?php _e( 'Email:', 'moon-shop' ); ?></span>
                        <h4 style="text-transform: lowercase;"><?php echo esc_attr($order->get_billing_email()); ?></h4>
                    </li>
            <?php endif; ?>
            <li class="total single">
                <span><?php _e( 'Total:' , 'moon-shop' ); ?></span>
                <h4><?php echo ($order->get_formatted_order_total()); ?></h4>
            </li>
            <?php if( $order->get_payment_method_title() ) : ?>
                <li class="method single">
                    <span><?php _e( 'Metodo de pago:' , 'moon-shop' ); ?></span>
                    <h4><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></h4>
                </li>
            <?php endif; ?>
        </ul>
        <div class="clear"></div>

    <?php endif; ?>
    <div class="row">
        <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method() , $order->get_id() ); ?>
        <?php do_action( 'woocommerce_thankyou' , $order->get_id() ); ?>
    </div>

<?php else : ?>
    <div class="order-complete-mgs text-center">
        <p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text' , __( '¡Gracias por tu compra, Wapa!' , 'moon-shop' ) , null ); ?></p>
    </div>

<?php endif; ?>

</div>