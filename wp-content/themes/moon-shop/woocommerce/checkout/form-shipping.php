<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-shipping-fields">
    <?php if( true === WC()->cart->needs_shipping_address() ) : ?>

        <div class="cart-page-title">
            <h3 id="ship-to-different-address">
                <input id="ship-to-different-address-checkbox" class="input-checkbox check-box" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked' , 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ) , 1 ); ?> type="checkbox" name="ship_to_different_address" value="1"/>
                <label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?' , 'moon-shop' ); ?></label>
            </h3>
        </div>

        <div class="shipping_address checkout-form">

            <?php do_action( 'woocommerce_before_checkout_shipping_form' , $checkout ); ?>

            <?php foreach( $checkout->get_checkout_fields( 'shipping' ) as $key => $field ) : ?>
                <div class="input-box">
                    <?php
                    if( !array_key_exists( 'label' , $field ) ) {
                        $field[ 'label' ] = '';
                    }

                    if( array_key_exists( 'required' , $field ) && $field[ 'required' ] == 1 ) {
                        $field[ 'placeholder' ] = $field[ 'label' ] . ' ('.__('required', 'moon-shop').')';
                    } else {
                        $field[ 'placeholder' ] = $field[ 'label' ] . ' ('.__('optional', 'moon-shop').')';
                    }

                    $field[ 'label' ] = '';

                    //$field[ 'class' ] = array( '0' => 'form-row-wide' );

                    if( $key == 'shipping_address_2' ) {
                        $field[ 'placeholder' ] = __('Address Line Two (optional)', 'moon-shop');
                    }
                    ?>

                    <?php woocommerce_form_field( $key , $field , $checkout->get_value( $key ) ); ?>

                </div>

            <?php endforeach; ?>

            <?php do_action( 'woocommerce_after_checkout_shipping_form' , $checkout ); ?>

        </div>

    <?php endif; ?>

    <div class="woocommerce-additional-fields">
        <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

        <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

            <?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

                <h3><?php _e( 'Additional Information' , 'moon-shop' ); ?></h3>

            <?php endif; ?>

            <div class="woocommerce-additional-fields__field-wrapper">
                <?php foreach( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                    <div class="input-box">
                        <?php
                        $field[ 'custom_attributes' ][ 'rows' ] = '4';
                        woocommerce_form_field( $key , $field , $checkout->get_value( $key ) ); ?>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

        <?php do_action( 'woocommerce_after_order_notes' , $checkout ); ?>
    </div>
</div>