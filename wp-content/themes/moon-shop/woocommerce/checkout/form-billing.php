<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
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
<div class="woocommerce-billing-fields">
    <div class="cart-page-title">
        <?php if( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
            <h2><?php _e( 'Facturación y Envío' , 'moon-shop' ); ?></h2>
        <?php else : ?>
            <h2><?php _e( 'Detalles de pago' , 'moon-shop' ); ?></h2>
        <?php endif; ?>
    </div>

    <?php do_action( 'woocommerce_before_checkout_billing_form' , $checkout ); ?>

    <?php foreach( $checkout->checkout_fields[ 'billing' ] as $key => $field ) : ?>
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
            if( $key == 'billing_address_2' ) {
                $field[ 'placeholder' ] = __('Línea dos Dirección (opcional)', 'moon-shop');
            }
            woocommerce_form_field( $key , $field , $checkout->get_value( $key ) );
            ?>
        </div>
    <?php endforeach; ?>

    <?php do_action( 'woocommerce_after_checkout_billing_form' , $checkout ); ?>

</div>
<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
    <div class="woocommerce-account-fields">
        <?php if ( ! $checkout->is_registration_required() ) : ?>
            <p class="form-row form-row-wide create-account">
                <input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked' , false ) ) ) , true ) ?> type="checkbox" name="createaccount" value="1"/> 
                <label for="createaccount" class="checkbox"><?php _e( '¿Deseas crear una cuenta?' , 'moon-shop' ); ?></label>
            </p>
        <?php endif; ?>

        <?php do_action( 'woocommerce_before_checkout_registration_form' , $checkout ); ?>

        <?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

            <div class="create-account">
                <p><?php _e( 'Crea una cuenta ingresando los datos requeridos a continuación. Si ya tienes una cuenta, inicia sesión.' , 'moon-shop' ); ?></p>
                
                <?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
                    <div class="input-box">
                        <?php
                        if( !array_key_exists( 'label' , $field ) ) {
                            $field[ 'label' ] = '';
                        }
                        if( array_key_exists( 'required' , $field ) && $field[ 'required' ] == 1 ) {
                            $field[ 'placeholder' ] = $field[ 'label' ] . ' (required)';
                        } else {
                            $field[ 'placeholder' ] = $field[ 'label' ] . ' (optional)';
                        }
                        $field[ 'label' ] = '';
                        $field[ 'class' ] = array( '0' => 'form-row-wide' );
                        if( $key == 'billing_address_2' ) {
                            $field[ 'placeholder' ] = 'Address Line Two (optional)';
                        }
                        woocommerce_form_field( $key , $field , $checkout->get_value( $key ) );
                        ?>
                    </div>
                <?php endforeach; ?>

                <div class="clear"></div>
            </div>
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_checkout_registration_form' , $checkout ); ?>
    </div>
<?php endif; ?>