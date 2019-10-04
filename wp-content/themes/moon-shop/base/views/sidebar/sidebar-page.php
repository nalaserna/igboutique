<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
global $post;
//page sidebar position
$moon_shop_page_sidebarPosition = isset( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) : '';

//page layout option
$moon_shop_page_layout = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-layout' , true ) );
if( $moon_shop_page_layout != 'default' && $moon_shop_page_layout != '' ) {
    $moon_shop_page_sidebarPosition = $moon_shop_page_layout;
} else if( $moon_shop_page_layout == '' ) {
    $moon_shop_page_sidebarPosition = isset( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) : '';
}
//page sidebar select
$moon_shop_page_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-pages-sidebar' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-pages-sidebar' ] ) : '';
$moon_shop_page_sidebarLoad = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-sidebar-load' , true ) );
if( $moon_shop_page_sidebarLoad == '' ) {
    $moon_shop_page_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-pages-sidebar' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-pages-sidebar' ] ) : '';
} else if( $moon_shop_page_sidebarLoad != 'default' && $moon_shop_page_sidebarLoad != '' ) {
    $moon_shop_page_sidebar = $moon_shop_page_sidebarLoad;
}
if( is_active_sidebar( $moon_shop_page_sidebarPosition ) ) {
    dynamic_sidebar( $moon_shop_page_sidebar );
}
if( is_search() ) {
    //page sidebar position
    $moon_shop_page_sidebarPosition = isset( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) : '';
    //page sidebar select
    $moon_shop_page_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-pages-sidebar' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-pages-sidebar' ] ) : '';
    if( is_active_sidebar( $moon_shop_page_sidebarPosition ) ) {
        dynamic_sidebar( $moon_shop_page_sidebar );
    }
}