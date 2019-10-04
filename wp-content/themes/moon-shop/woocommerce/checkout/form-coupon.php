<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
    return;
}

?>
<div class="woocommerce-form-coupon-toggle">
    <?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'moon-shop' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'moon-shop' ) . '</a>' ), 'notice' ); ?>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12">
        <form class="checkout_coupon woocommerce-form-coupon text-center moon-form" method="post" style="display:none">
            <div class="input-box">
                <p class="form-row">
                    <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code' , 'moon-shop' ); ?>" id="coupon_code" value=""/>
                </p>
            </div>

            <div class="input-box">
                <p class="form-row">
                    <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon' , 'moon-shop' ); ?>"/>
                </p>
            </div>

            <div class="clear"></div>
        </form>
    </div>
</div>