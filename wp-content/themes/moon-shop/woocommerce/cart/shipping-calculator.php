<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
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

do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php printf( '<a href="#" class="shipping-calculator-button">%s</a>', esc_html( ! empty( $button_text ) ? $button_text : __( 'Calculate shipping', 'moon-shop' ) ) ); ?>
    <div class="input-wrapper shipping-calculator-form" style="display:none;">
        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_country', true ) ) : ?>
            <div class="form-row form-row-wide input-box" id="calc_shipping_country_field">
                <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
                    <option value=""><?php _e( 'Select a country&hellip;' , 'moon-shop' ); ?></option>
                    <?php
                    foreach( WC()->countries->get_shipping_countries() as $key => $value )
                        echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country() , esc_attr( $key ) , false ) . '>' . esc_html( $value ) . '</option>';
                    ?>
                </select>
            </div>
        <?php endif; ?>

        <?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_state', true ) ) : ?>
            <div class="form-row form-row-wide input-box" id="calc_shipping_state_field">
                <?php
                $current_cc = WC()->customer->get_shipping_country();
                $current_r = WC()->customer->get_shipping_state();
                $states = WC()->countries->get_states( $current_cc );

                // Hidden Input
                if( is_array( $states ) && empty( $states ) ) {
                    ?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / county' , 'moon-shop' ); ?>" /><?php

                    // Dropdown Input
                } elseif( is_array( $states ) ) {
                    ?>
                    <select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / county' , 'moon-shop' ); ?>">
                        <option value=""><?php _e( 'Select a state&hellip;' , 'moon-shop' ); ?></option>
                        <?php
                        foreach( $states as $key => $value )
                            echo '<option value="' . esc_attr( $key ) . '" ' . selected( $current_r , $key , false ) . '>' . esc_html( $value ) . '</option>';
                        ?>
                    </select>
                    <?php
                    // Standard Input
                } else { ?>
                    <input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / county' , 'moon-shop' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php
                } ?>
            </div>
        <?php endif; ?>

        <?php if( apply_filters( 'woocommerce_shipping_calculator_enable_city' , false ) ) : ?>
            <div class="form-row form-row-wide input-box" id="calc_shipping_city_field">
                <input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City' , 'moon-shop' ); ?>" name="calc_shipping_city" id="calc_shipping_city"/>
            </div>
        <?php endif; ?>

        <?php if( apply_filters( 'woocommerce_shipping_calculator_enable_postcode' , true ) ) : ?>
            <div class="form-row form-row-wide input-box" id="calc_shipping_postcode_field">
                <input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'State / Province' , 'moon-shop' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode"/>
            </div>
        <?php endif; ?>

        <input type="submit" name="calc_shipping" value="<?php _e( 'Calculate Shipping' , 'moon-shop' ); ?>" class="button"/>

        <?php wp_nonce_field( 'woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce' ); ?>
    </div>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
