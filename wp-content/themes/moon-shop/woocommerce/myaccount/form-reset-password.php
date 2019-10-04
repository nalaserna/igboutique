<?php
/**
 * Lost password reset form.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-reset-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>

<div class="cart-page-container fix lost-password col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">

    <form method="post" class="woocommerce-ResetPassword lost_reset_password moon-form">

        <p class="lost-text"><?php echo apply_filters( 'woocommerce_reset_password_message' , esc_html__( 'Enter a new password below.' , 'moon-shop' ) ); ?></p>

        <div class="input-box">
            <p class="woocommerce-FormRow woocommerce-FormRow--first form-row">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="new-password" placeholder="<?php _e( 'New password' , 'moon-shop' ); ?> *"/>
            </p>
        </div>

        <div class="input-box">
            <p class="woocommerce-FormRow woocommerce-FormRow--last form-row">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="new-password" placeholder="<?php _e( 'Re-enter new password' , 'moon-shop' ); ?> *"/>
            </p>
        </div>

        <input type="hidden" name="reset_key" value="<?php echo esc_attr( $args[ 'key' ] ); ?>"/>
        <input type="hidden" name="reset_login" value="<?php echo esc_attr( $args[ 'login' ] ); ?>"/>

        <div class="clear"></div>

        <?php do_action( 'woocommerce_resetpassword_form' ); ?>

        <div class="input-box">
            <p class="woocommerce-FormRow form-row">
                <input type="hidden" name="wc_reset_password" value="true"/>
                <input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Save' , 'moon-shop' ); ?>"/>
            </p>
        </div>

        <?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>
    </form>
</div>

<?php
do_action( 'woocommerce_after_reset_password_form' );