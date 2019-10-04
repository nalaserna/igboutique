<?php
//Redux global variable

$moon_shop_optionsValue = get_option( 'moon_shop' );

global $post;

//sidebar position

$moon_shop_sidebar_position = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-page-sidebar' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-page-sidebar' ] ) : '';

//blog archive sidebar load

$moon_shop_blog_single_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-page-sidebar-load' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-page-sidebar-load' ] ) : '';

if( is_active_sidebar( $moon_shop_sidebar_position ) ) {

    dynamic_sidebar( $moon_shop_blog_single_sidebar );

}

?>