<?php
/**
 * Related Products
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if( !defined( 'ABSPATH' ) ) {
    exit;
}

global $product , $woocommerce_loop;

//theme options
$moon_shop_optionsValue = get_option( 'moon_shop' );

if( empty( $product ) || !$product->exists() ) {
    return;
}

if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] ) && !empty( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] ) ) {
    $posts_per_page = $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ];
} else {
    $posts_per_page = 9;
}

if( !$related = wc_get_related_products(get_the_ID(), $posts_per_page) ) {
    return;
}

$args = apply_filters( 'woocommerce_related_products_args' , array( 'post_type' => 'product' , 'ignore_sticky_posts' => 1 , 'no_found_rows' => 1 , 'posts_per_page' => $posts_per_page , 'orderby' => 'ASC' , 'post__in' => $related , 'post__not_in' => array( get_the_ID() ) ) );

$products = new WP_Query( $args );
$woocommerce_loop[ 'name' ] = 'related';
$woocommerce_loop[ 'columns' ] = apply_filters( 'woocommerce_related_products_columns' , $woocommerce_loop[ 'columns' ] );

$moon_shop_related = isset( $moon_shop_optionsValue[ 'moon-shop-related-product-enable-disable' ] ) ? $moon_shop_optionsValue[ 'moon-shop-related-product-enable-disable' ] : true;

if( $products->have_posts() && $moon_shop_related ) : ?>

    <div class="related products related-products col-sm-12">
        <div class="rp-title text-center">
            <h2><?php _e( 'Related Products' , 'moon-shop' ); ?></h2>
        </div>

        <?php woocommerce_product_loop_start(); ?>

        <?php while( $products->have_posts() ) : $products->the_post(); ?>

            <?php wc_get_template_part( 'content' , 'product' ); ?>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

    </div>

<?php endif;

wp_reset_postdata();
