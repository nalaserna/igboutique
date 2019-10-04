<?php
/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>

<div class="contact-form pass-reset">
    <div class="text-center col-md-6 col-md-offset-3">
        <form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="woocommerce-form woocommerce-form-track-order track_order moon-form">
            <p><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.' , 'moon-shop' ); ?></p>
            <div class="input-box">
                <p class="form-row">
                    <label for="orderid"><?php _e( 'Order ID' , 'moon-shop' ); ?></label>
                    <input class="input-text" type="text" name="orderid" id="orderid" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.' , 'moon-shop' ); ?>"/>
                </p>
            </div>
            <div class="input-box">
                <p class="form-row">
                    <label for="order_email"><?php _e( 'Billing Email' , 'moon-shop' ); ?></label>
                    <input class="input-text" type="text" name="order_email" id="order_email" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email you used during checkout.' , 'moon-shop' ); ?>"/>
                </p>
            </div>
            <div class="clear"></div>
            <div class="input-box">
                <p class="form-row">
                    <input type="submit" class="button" name="track" value="<?php esc_attr_e( 'Track' , 'moon-shop' ); ?>"/>
                </p>
            </div>
            <?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>
        </form>
    </div>
</div>