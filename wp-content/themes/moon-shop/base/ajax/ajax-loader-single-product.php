<?php

add_action( 'wp_ajax_nopriv_moon_shop_single_pro_ajaxloader' , 'moon_shop_single_pro_ajaxloader' );
add_action( 'wp_ajax_moon_shop_single_pro_ajaxloader' , 'moon_shop_single_pro_ajaxloader' );

/**
 * Ajax Loader Call Back Function
 * Responses To Ajax Requests
 */
function moon_shop_single_pro_ajaxloader() {

    global $wpdb;
    $moon_shop_product_id = esc_attr( $_POST[ 'productId' ] );
    $args = array( 'post_type' => 'product' , 'posts_per_page' => 1 , 'p' => $moon_shop_product_id );
    $moon_shop_products = new WP_Query( $args );

    while( $moon_shop_products->have_posts() ) : $moon_shop_products->the_post();
        wc_get_template( 'content-single-ajax.php' );
    endwhile;

    wp_reset_postdata();
    wp_die();
}
