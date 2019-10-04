<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
//payment image
$moon_shop_footer_cols = isset( $moon_shop_optionsValue[ 'moon-shop-footer-widget-column-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-footer-widget-column-select' ] ) : '';

/* Registering Right Sidebar */
$moon_shop_args_woo = array( 'name' => esc_html__( 'Woocommerce sidebar' , 'moon-shop' ) , 'id' => 'woo_sidebar' , 'before_widget' => '<div id="%1$s" class="wl-sidebar-items %2$s">' , 'after_widget' => '</div>' , 'before_title' => '<h5 class="wl-standard-marginbottom">' , 'after_title' => '</h5>' );
register_sidebar( $moon_shop_args_woo );

/* Registering Right Sidebar */
$moon_shop_args_right = array( 'name' => esc_html__( 'Right sidebar' , 'moon-shop' ) , 'id' => 'right_sidebar' , 'before_widget' => '<div id="%1$s" class="wl-sidebar-items %2$s">' , 'after_widget' => '</div>' , 'before_title' => '<h5 class="wl-standard-marginbottom">' , 'after_title' => '</h5>' );
register_sidebar( $moon_shop_args_right );

/* Registering Left Sidebar */
$moon_shop_args_left = array( 'name' => esc_html__( 'Left sidebar' , 'moon-shop' ) , 'id' => 'left_sidebar' , 'before_widget' => '<div id="%1$s" class="wl-sidebar-items %2$s">' , 'after_widget' => '</div>' , 'before_title' => '<h5 class="wl-standard-marginbottom">' , 'after_title' => '</h5>' );
register_sidebar( $moon_shop_args_left );

$moon_shop_cols = 'col-md-3 col-sm-5';

if( $moon_shop_footer_cols != '' && $moon_shop_footer_cols == 'col-one' ) {
    $moon_shop_cols = 'col-md-12 col-sm-12';
} else if( $moon_shop_footer_cols != '' && $moon_shop_footer_cols == 'col-two' ) {
    $moon_shop_cols = 'col-md-6 col-sm-6';
} else if( $moon_shop_footer_cols != '' && $moon_shop_footer_cols == 'col-three' ) {
    $moon_shop_cols = 'col-md-4 col-sm-4';
} else if( $moon_shop_footer_cols != '' && $moon_shop_footer_cols == 'col-four' ) {
    $moon_shop_cols = 'col-md-3 col-sm-5';
}

/* Registering Footer Widget */
$moon_shop_args_left = array( 'name' => esc_html__( 'Footer Widget' , 'moon-shop' ) , 'id' => 'footer_widget' , 'before_widget' => '<div id="%1$s" class="footer-widget footer-widget-about %2$s ' . $moon_shop_cols . '">' , 'after_widget' => '</div>' , 'before_title' => '<h3>' , 'after_title' => '</h3>' );
register_sidebar( $moon_shop_args_left );

/* Registering top menu Widget */
$moon_shop_args_top = array( 'name' => esc_html__( 'Top Widget' , 'moon-shop' ) , 'id' => 'top_widget' , 'before_widget' => '<div id="%1$s" class="top-widget %2$s ">' , 'after_widget' => '</div>' , 'before_title' => '<h3 class="hidden">' , 'after_title' => '</h3>' );
if (function_exists('icl_object_id')) {
    register_sidebar( $moon_shop_args_top );
}

/* Registering User Defined Sidebars */
$moon_shop_sideBars = get_option( 'moon_shop' );

if( isset( $moon_shop_sideBars[ 'moon-shop-register-sidebar' ] ) ) {
    if( !empty( $moon_shop_sideBars[ 'moon-shop-register-sidebar' ] ) ) {
        foreach( $moon_shop_sideBars[ 'moon-shop-register-sidebar' ] as $moon_shop_sideBar ) {
            if( !empty( $moon_shop_sideBar ) ) {
                $moon_shop_args = array( 'name' => $moon_shop_sideBar , 'id' => str_replace( ' ' , '_' , strtolower( $moon_shop_sideBar ) ) , 'before_widget' => '<div id="%1$s" class="sin-shop-sidebar %2$s">' , 'after_widget' => '</div>' , 'before_title' => '<h5 class="wl-standard-marginbottom">' , 'after_title' => '</h5>' );
                register_sidebar( $moon_shop_args );
            }
        }
    }
}