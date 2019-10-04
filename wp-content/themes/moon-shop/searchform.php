<?php

// Do not allow directly accessing this file.
if( !defined( 'ABSPATH' ) ) {
    exit( 'Direct script access denied.' );
}

//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//search icon position
$moon_shop_search_icon_position = isset( $moon_shop_optionsValue[ 'moon-shop-header-search-icon-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-search-icon-position' ] ) : '';
//cart icon position
$moon_shop_cart_icon_position = isset( $moon_shop_optionsValue[ 'moon-shop-header-cart-icon-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-cart-icon-position' ] ) : '';
if( $moon_shop_search_icon_position == 'top-bar' ) {
    $moon_shop_search = 'header-search-2 float-right';
}
if( $moon_shop_search_icon_position == 'main-menu' && $moon_shop_cart_icon_position == 'main-menu' ) {
    $moon_shop_search = 'float-left';
} else if( $moon_shop_search_icon_position == 'main-menu' && $moon_shop_cart_icon_position != 'main-menu' ) {
    $moon_shop_search = 'float-right';
}
?>
<!-- Header Search -->
<div class="sin-shop-sidebar">
    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="hidden" name="post_type" value=""/>
        <input type="search" class="search-field"
               placeholder="<?php echo esc_attr_x( 'Search &hellip;' , 'placeholder' , 'moon-shop' ); ?>"
               value="<?php echo get_search_query(); ?>" name="s"/>
    </form>
</div>
