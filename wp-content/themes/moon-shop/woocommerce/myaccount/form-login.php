<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    <div class="u-columns col2-set" id="customer_login">

        <div class="u-column1 col-1">

<?php endif; ?>

    <div class="cart-page-container fix">

        <div class="cart-page-title text-center">
            <h2><?php _e( 'Login' , 'moon-shop' ); ?></h2>
        </div>

        <form method="post" class="woocommerce-form woocommerce-form-login login moon-form">
            <?php do_action( 'woocommerce_login_form_start' ); ?>
            <div class="input-box">
                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php _e( 'Username or Email Address *' , 'moon-shop' ); ?>"/>
                </p>
            </div>
            <div class="input-box">
                <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php _e( 'Password *' , 'moon-shop' ); ?>"/>
                </p>
            </div>

            <?php do_action( 'woocommerce_login_form' ); ?>

            <div class="input-box check">
                <p class="form-row text-center">
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login' , 'moon-shop' ); ?>"/>
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

            <?php do_action( 'woocommerce_login_form_end' ); ?>
        </form>
    </div>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    </div>

    <div class="u-column2 col-2">

        <div class="cart-page-container fix">
            <div class="cart-page-title text-center">
                <h2><?php _e( 'Register' , 'moon-shop' ); ?></h2>
            </div>

            <form method="post" class="register moon-form">
                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                    <div class="input-box">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php _e( 'Username' , 'moon-shop' ); ?> *"/>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="input-box">
                    <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="<?php _e( 'Email address' , 'moon-shop' ); ?> *"/>
                    </p>
                </div>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <div class="input-box">
                        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" autocomplete="new-password" id="reg_password" placeholder="<?php _e( 'Password' , 'moon-shop' ); ?> *"/>
                        </p>
                    </div>

                <?php else : ?>

                    <p><?php esc_html_e( 'A password will be sent to your email address.', 'moon-shop' ); ?></p>

                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <?php do_action( 'register_form' ); ?>

                <div class="input-box">
                    <p class="woocomerce-FormRow form-row">
                        <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                        <input type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register' , 'moon-shop' ); ?>"/>
                    </p>
                </div>

                <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>
        </div>
    </div>
    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>