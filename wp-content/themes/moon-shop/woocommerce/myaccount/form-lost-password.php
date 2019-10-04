<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="contact-form pass-reset">
    <div class="text-center col-md-6 col-md-offset-3">

        <h2><?php echo __( 'Reset Password' , 'moon-shop' ); ?></h2>

        <form method="post" class="woocommerce-ResetPassword lost_reset_password moon-form">
            <p class="lost-text"><?php echo apply_filters( 'woocommerce_lost_password_message' , __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.' , 'moon-shop' ) ); ?></p>
            <div class="input-box">
                <p class="woocommerce-FormRow woocommerce-FormRow--first form-row">
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" placeholder="<?php _e( 'Username or Email Address' , 'moon-shop' ); ?>"/>
                </p>
            </div>

            <div class="clear"></div>

            <?php do_action( 'woocommerce_lostpassword_form' ); ?>

            <div class="input-box">
                <p class="woocommerce-FormRow form-row">
                    <input type="hidden" name="wc_reset_password" value="true"/>
                    <input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset Password' , 'moon-shop' ); ?>"/>
                </p>
            </div>

            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
        </form>
        <?php do_action( 'woocommerce_after_lost_password_form' ); ?>
    </div>
</div>