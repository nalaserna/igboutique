<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<div class="coustomer-details">

    <div class="order-com-title">
        <h2><?php _e( 'Detalles del cliente' , 'moon-shop' ); ?></h2>
    </div>

    <div class="content">
        <ul class="shop_table customer_details">
            <?php if( $order->get_customer_note() ) : ?>
                <li>
                    <span><?php _e( 'Notas:' , 'moon-shop' ); ?></span>
                    <?php echo wptexturize( $order->get_customer_note() ); ?>
                </li>
            <?php endif; ?>

            <?php if( $order->get_billing_email() ) : ?>
                <li>
                    <span><?php _e( 'Email:' , 'moon-shop' ); ?></span>
                    <?php echo esc_html( $order->get_billing_email() ); ?>
                </li>
            <?php endif; ?>

            <?php if( $order->get_billing_phone() ) : ?>
                <li>
                    <span><?php _e( 'Teléfono:' , 'moon-shop' ); ?></span>
                    <?php echo esc_html( $order->get_billing_phone() ); ?>
                </li>
            <?php endif; ?>

            <?php do_action( 'woocommerce_order_details_after_customer_details' , $order ); ?>
        </ul>
    </div>
</div>

<?php if ($show_shipping) : ?>

<div class="col2-set addresses">

    <?php endif; ?>
    <div class="billing-address">
        <div class="order-com-title">
            <h2><?php _e( 'Dirección' , 'moon-shop' ); ?></h2>
        </div>

        <div class="content">
            <address>
                <?php 
                $address = apply_filters( 'woocommerce_order_formatted_billing_address' , array(
                    'first_name' => $order->get_billing_first_name() ,
                    'last_name' => $order->get_billing_last_name() ,
                    'company' => $order->get_billing_company() ,
                    'address_1' => $order->get_billing_address_1() ,
                    'address_2' => $order->get_billing_address_2() ,
                    'city' => $order->get_billing_city() ,
                    'state' => $order->get_billing_state() ,
                    'postcode' => $order->get_billing_postcode() ,
                    'country' => $order->get_billing_country()
                ) );

                extract( $address );

                // Get all formats
                $formats = WC()->countries->get_address_formats();

                // Get format for the address' country
                $format = ( $country && isset( $formats[ $country ] ) ) ? $formats[ $country ] : $formats[ 'default' ];

                // Handle full country name
                $full_country = ( isset( WC()->countries->countries[ $country ] ) ) ? WC()->countries->countries[ $country ] : $country;

                // Country is not needed if the same as base
                if( $country == WC()->countries->get_base_country() && !apply_filters( 'woocommerce_formatted_address_force_country_display' , false ) ) {
                    $format = str_replace( '{country}' , '' , $format );
                }

                // Handle full state name
                $full_state = ( $country && $state && isset( WC()->countries->states[ $country ][ $state ] ) ) ? WC()->countries->states[ $country ][ $state ] : $state;
                ?>

                <h4><?php echo esc_attr( $first_name . ' ' . $last_name ); ?></h4>

                <?php
                if( $company != '' ) {
                    echo '<p>'.__('Nombre de la empresa', 'moon-shop').': ' . esc_attr( $company ) . '</p>';
                } ?>

                <p><?php echo __('Dirección', 'moon-shop').': ' . esc_attr( $address_1 ); ?></p>

                <?php
                if( $address_2 != '' ) {
                    echo '<p>'.__('Dirección', 'moon-shop').': ' . esc_attr( $address_2 ) . '</p>';
                } ?>

                <p><?php echo esc_attr( $city ) . ', ' . esc_attr( $full_state ); ?></p>

                <p><?php echo esc_attr( $postcode ) . ', ' . esc_attr( $full_country ); ?></p>

            </address>

        </div>
    </div>

    <?php if ($show_shipping) : ?>

<!-- /.col-1 -->

<div class="billing-address shipping-address">

    <div class="order-com-title">

        <h2><?php _e( 'Dirección de envío' , 'moon-shop' ); ?></h2>

    </div>

    <div class="content">

        <address>
            <?php 
            if( $order->get_shipping_address_1() || $order->get_shipping_address_2() ) {
                // Formatted Addresses
                $shipping_address = apply_filters( 'woocommerce_order_formatted_shipping_address' , array(
                    'first_name' => $order->get_shipping_first_name() ,
                    'last_name' => $order->get_shipping_last_name() ,
                    'company' => $order->get_shipping_company() ,
                    'address_1' => $order->get_shipping_address_1() ,
                    'address_2' => $order->get_shipping_address_2() ,
                    'city' => $order->get_shipping_city() ,
                    'state' => $order->get_shipping_state() ,
                    'postcode' => $order->get_shipping_postcode() ,
                    'country' => $order->get_shipping_country()
                ) , $order );

                extract( $shipping_address );

                // Get all formats
                $formats = WC()->countries->get_address_formats();

                // Get format for the address' country
                $format = ( $country && isset( $formats[ $country ] ) ) ? $formats[ $country ] : $formats[ 'default' ];

                // Handle full country name
                $full_country = ( isset( WC()->countries->countries[ $country ] ) ) ? WC()->countries->countries[ $country ] : $country;

                // Country is not needed if the same as base
                if( $country == WC()->countries->get_base_country() && !apply_filters( 'woocommerce_formatted_address_force_country_display' , false ) ) {
                    $format = str_replace( '{country}' , '' , $format );
                }

                // Handle full state name
                $full_state = ( $country && $state && isset( WC()->countries->states[ $country ][ $state ] ) ) ? WC()->countries->states[ $country ][ $state ] : $state;
                ?>

                <h4><?php echo esc_attr( $first_name . ' ' . $last_name ); ?></h4>

                <?php
                if( $company != '' ) {
                    echo '<p>Company Name: ' . esc_attr( $company ) . '</p>';
                } ?>

                <p><?php echo __('Address','moon-shop').': ' . esc_attr( $address_1 ); ?></p>

                <?php
                if( $address_2 != '' ) {
                    echo '<p>'.__('Address','moon-shop').': ' . esc_attr( $address_2 ) . '</p>';
                } ?>

                <p><?php echo esc_attr( $city ) . ', ' . esc_attr( $full_state ); ?></p>

                <p><?php echo esc_attr( $postcode ) . ', ' . esc_attr( $full_country ); ?></p>

            <?php } ?>
        </address>
    </div>
</div>
<!-- /.col-2 -->
</div><!-- /.col2-set -->

<?php endif; ?>