<?php

//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//sidebar position
$moon_shop_sidebar_position = isset( $moon_shop_optionsValue[ 'moon-shop-blog-sidebar-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-sidebar-position' ] ) : '';

//blog archive sidebar load
$moon_shop_blog_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-blog-pages-sidebar' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-pages-sidebar' ] ) : '';
if( is_active_sidebar( $moon_shop_sidebar_position ) ) {
    dynamic_sidebar( $moon_shop_blog_sidebar );
}
?>
