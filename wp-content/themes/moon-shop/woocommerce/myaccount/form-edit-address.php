<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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

$page_title = ( 'billing' === $load_address ) ? __( 'Billing Address' , 'moon-shop' ) : __( 'Shipping Address' , 'moon-shop' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if( !$load_address ) :
    wc_get_template( 'myaccount/my-address.php' );
else : ?>

    <form method="post" class="moon-form">
        <div class="cart-page-title">
            <h2><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h2>
        </div>

        <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

        <div class="no-padding-form">
            <?php foreach( $address as $key => $field ) :
                echo '<div class="input-box">';
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
                woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
                echo '</div>';
            endforeach; ?>

            <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

            <div class="input-box">
                <p>
                    <input type="submit" class="button" name="save_address" value="<?php esc_attr_e( 'Save Address' , 'moon-shop' ); ?>"/>
                    <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
                    <input type="hidden" name="action" value="edit_address"/>
                </p>
            </div>
        </div>
    </form>
<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>