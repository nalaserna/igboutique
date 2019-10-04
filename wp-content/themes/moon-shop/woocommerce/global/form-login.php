<?php
/**
 * Login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
    return;
}

?>

<div class="cart-page-container fix lost-password col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
    <form method="post" class="woocommerce-form woocommerce-form-login login moon-form" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>

        <?php do_action( 'woocommerce_login_form_start' ); ?>

        <?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; ?>

        <div class="input-box">
            <p class="form-row">
                <input type="text" class="input-text" name="username" id="username" placeholder="<?php echo esc_html__( 'Username or Email Address' , 'moon-shop' ); ?> *"/>
            </p>
        </div>

        <div class="input-box">
            <p class="form-row">
                <input class="input-text" type="password" name="password" id="password" placeholder="<?php echo esc_html__( 'Password' , 'moon-shop' ); ?> *"/>
            </p>
        </div>
        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <div class="input-box check">
            <p class="form-row text-center">
                <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                <input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login' , 'moon-shop' ); ?>"/>
                <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>"/>
                <input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"/>
                <label for="rememberme" class="inline">
                    <?php _e( 'Remember me' , 'moon-shop' ); ?>
                </label>
            </p>
        </div>

        <div class="input-box">
            <p class="woocommerce-LostPassword lost_password text-center">
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?' , 'moon-shop' ); ?></a>
            </p>
        </div>

        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form_end' ); ?>
    </form>
</div>