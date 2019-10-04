<?php

/**
 * My Addresses
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */


if( !defined( 'ABSPATH' ) ) {

    exit; // Exit if accessed directly

}


$customer_id = get_current_user_id();


if( !wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {

    $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses' , array(

        'billing' => __( 'Billing Address' , 'moon-shop' ) ,

        'shipping' => __( 'Shipping Address' , 'moon-shop' )

    ) , $customer_id );

} else {

    $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses' , array(

        'billing' => __( 'Billing Address' , 'moon-shop' )

    ) , $customer_id );

}


$oldcol = 1;

$col = 1;

?>

<div class="order-complete-mgs text-center">

    <p>

        <?php echo apply_filters( 'woocommerce_my_account_my_address_description' , __( 'The following addresses will be used on the checkout page by default.' , 'moon-shop' ) ); ?>

    </p>

</div>

<?php if( !wc_ship_to_billing_address_only() && wc_shipping_enabled() ) echo '<div class="u-columns woocommerce-Addresses col2-set addresses">'; ?>



<?php foreach( $get_addresses as $name => $title ) : ?>



    <div
        class="u-column<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> col-<?php echo ( ( $oldcol = $oldcol * -1 ) < 0 ) ? 1 : 2; ?> woocommerce-Address billing-address">

        <header class="woocommerce-Address-title title">

            <h3><?php echo esc_attr( $title ); ?></h3>

        </header>

        <address class="content">

            <?php

            $address = apply_filters( 'woocommerce_my_account_my_address_formatted_address' , array(

                'first_name' => get_user_meta( $customer_id , $name . '_first_name' , true ) ,

                'last_name' => get_user_meta( $customer_id , $name . '_last_name' , true ) ,

                'company' => get_user_meta( $customer_id , $name . '_company' , true ) ,

                'address_1' => get_user_meta( $customer_id , $name . '_address_1' , true ) ,

                'address_2' => get_user_meta( $customer_id , $name . '_address_2' , true ) ,

                'city' => get_user_meta( $customer_id , $name . '_city' , true ) ,

                'state' => get_user_meta( $customer_id , $name . '_state' , true ) ,

                'postcode' => get_user_meta( $customer_id , $name . '_postcode' , true ) ,

                'country' => get_user_meta( $customer_id , $name . '_country' , true )

            ) , $customer_id , $name );


            extract( $address );


            // Get all formats

            $formats = WC()->countries->get_address_formats();


            // Get format for the address' country

            $format = ( $country && isset( $formats[ $country ] ) ) ? $formats[ $country ] : $formats[ 'default' ];


            // Handle full country name

            $full_country = ( isset( WC()->countries->countries[ $country ] ) ) ? WC()->countries->countries[ $country ] : $country;

            // Handle full state name
            $full_state = ( $country && $state && isset( WC()->countries->states[ $country ][ $state ] ) ) ? WC()->countries->states[ $country ][ $state ] : $state;

            ?>
            <?php if( $first_name != '' || $last_name != '' ) { ?>
                <h4><?php echo esc_attr( $first_name . ' ' . $last_name ); ?></h4>
            <?php } ?>

            <?php

            if( $company != '' ) {

                echo '<p>' . esc_attr( $company ) . '</p>';

            } ?>

            <?php if( $address_1 != '' ) { ?>
                <p><?php echo esc_attr( $address_1 ); ?></p>
            <?php } ?>

            <?php

            if( $address_2 != '' ) {

                echo '<p>Address 2: ' . esc_attr( $address_2 ) . '</p>';

            } ?>

            <?php if( $city != '' && $full_state != '' ) { ?>
                <p><?php echo esc_attr( $city ) . ', ' . esc_attr( $full_state ); ?></p>
            <?php } else if( $city == '' && $full_state != '' ) { ?>
                <p><?php echo esc_attr( $full_state ); ?></p>
            <?php } else if( $city != '' && $full_state == '' ) { ?>
                <p><?php echo esc_attr( $city ); ?></p>
            <?php } ?>

            <?php if( $postcode != '' && $full_country != '' ) { ?>
                <p><?php echo esc_attr( $postcode ) . ', ' . esc_attr( $full_country ); ?></p>
            <?php } else if( $postcode == '' && $full_country != '' ) { ?>
                <p><?php echo esc_attr( $full_country ); ?></p>
            <?php } else if( $postcode != '' && $full_country == '' ) { ?>
                <p><?php echo esc_attr( $postcode ); ?></p>
            <?php } ?>

            <?php

            // Country is not needed if the same as base

            if( $country == WC()->countries->get_base_country() && !apply_filters( 'woocommerce_formatted_address_force_country_display' , false ) ) {

                $format = str_replace( '{country}' , '' , $format );

            }

            if( !$format )

                _e( 'You have not set up this type of address yet.' , 'moon-shop' );

            ?>

        </address>

        <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address' , $name ) ); ?>"
           class="edit button"><?php _e( 'Edit' , 'moon-shop' ); ?></a>

    </div>



<?php endforeach; ?>



<?php if( !wc_ship_to_billing_address_only() && wc_shipping_enabled() ) echo '</div>'; ?>

