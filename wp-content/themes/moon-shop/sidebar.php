<?php
global $wp_query;
$moon_shop_WC_exist = 0;
if( function_exists( "is_shop" ) ) {
    if( is_woocommerce() ) {
        dynamic_sidebar( 'woo_sidebar' );
    }
    $moon_shop_WC_exist = 1;
}

//page layout option
$moon_shop_page_layout = 'no_sidebar';
if( !is_search() ) {
    $moon_shop_page_layout = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-layout' , true ) );
}

if( is_page() || is_front_page() || is_home() ) {
    if( $moon_shop_page_layout != 'no_sidebar' ) {
        echo '<div class="col-md-4 col-sm-12 moon-sidebar">';
        get_template_part( 'base/views/sidebar/sidebar-page' );
        echo '</div>';
    }
} else if( is_archive() && $moon_shop_WC_exist != 1 ) {
    echo '<div class="col-md-4 col-sm-12 moon-sidebar">';
    get_template_part( 'base/views/sidebar/sidebar-blog' );
    echo '</div>';
} else if( is_single() ) {
    echo '<div class="col-md-4 col-sm-12 moon-sidebar">';
    get_template_part( 'base/views/sidebar/sidebar-blog-single' );
    echo '</div>';
} else if( $wp_query->is_posts_page ) {
    echo '<div class="col-md-4 col-sm-12 moon-sidebar">';
    get_template_part( 'base/views/sidebar/sidebar-blog' );
    echo '</div>';
}