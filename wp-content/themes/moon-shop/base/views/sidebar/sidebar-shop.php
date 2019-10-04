<?php

//Redux global variable

$moon_shop_optionsValue = get_option( 'moon_shop' );

//sidebar position

$moon_shop_sidebar_position = isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] ) : '';

//Shop page sidebar load

if( $moon_shop_sidebar_position == 'left_sidebar' ) {

    $moon_shop_shop_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-left-sidebar-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-left-sidebar-select' ] ) : '';

} else if( $moon_shop_sidebar_position == 'right_sidebar' ) ) {

    $moon_shop_shop_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-right-sidebar-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-right-sidebar-select' ] ) : '';

}

	if( $moon_shop_sidebar_position != 'fullwidth' && is_active_sidebar( $moon_shop_sidebar_position ) ) {

        dynamic_sidebar( $moon_shop_shop_sidebar );

    }

?>
