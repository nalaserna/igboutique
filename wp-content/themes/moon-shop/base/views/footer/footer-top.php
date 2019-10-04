<!-- Footer Top -->

<?php 
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_destract_free = isset( $moon_shop_optionsValue[ 'moon-shop-destract-free' ] ) ? $moon_shop_optionsValue[ 'moon-shop-destract-free' ] : '';

if( is_active_sidebar( 'footer_widget' ) ) { ?>

    <div class="footer-top">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar( 'footer_widget' ); ?>
            </div>
        </div>
    </div>

<?php } ?>