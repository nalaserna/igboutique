<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//payment image
$moon_shop_payment_image = isset( $moon_shop_optionsValue[ 'moon-shop-footer-payment-image' ][ 'url' ] ) ? esc_url( $moon_shop_optionsValue[ 'moon-shop-footer-payment-image' ][ 'url' ] ) : '';
$moon_shop_destract_free = isset( $moon_shop_optionsValue[ 'moon-shop-destract-free' ] ) ? $moon_shop_optionsValue[ 'moon-shop-destract-free' ] : '';
?>

<!-- Footer Bottom -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <!-- Footer Copyright -->
            <div class="copyright col-sm-6 text-left">
                <p>
                    <?php if( !class_exists( 'Redux' ) ) {
                        esc_html_e( 'Copyright © 2019. Onaz' , 'moon-shop' );
                    } ?>
                    <?php echo wp_kses( sprintf( __( '%s' , 'moon-shop' ) , $moon_shop_optionsValue[ 'moon-shop-footer-copyright-text' ] ) , array( 'a' => array( 'href' => array() ) , 'br' => array() ) ); ?>
                </p>
            </div>
            <!-- Footer Payment -->
            <?php if( $moon_shop_payment_image != '' ) { ?>
                <div class="payment col-sm-6 text-right"><img src="<?php echo esc_url( $moon_shop_payment_image ); ?>" alt="payment"/></div>
            <?php } ?>
        </div>
    </div>
</div>