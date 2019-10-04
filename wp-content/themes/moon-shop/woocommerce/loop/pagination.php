<?php

/**
 * Pagination - Show numbered pagination for catalog pages
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     3.3.1
 */

if( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $wp_query;

if( $wp_query->max_num_pages <= 1 ) {
    return;
}

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
    return;
}

$moon_shop_optionsValue = get_option( 'moon_shop' );

if( isset( $moon_shop_optionsValue[ 'moon-shop-product-shop-load-pagi-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-product-shop-load-pagi-select' ] == 'loadmore' ) {
    $moon_shop_pagi = false;
} else {
    $moon_shop_pagi = true;
}

if( $moon_shop_pagi ) { ?>
    <div class="text-center loadmore-wraper row">
        <nav class="woocommerce-pagination">
            <?php
            echo paginate_links( apply_filters( 'woocommerce_pagination_args' , array(
                'base' => $base,
                'format' => $format,
                'add_args' => false ,
                'current' => $current,
                'total' => $total,
                'prev_text' => '<i class="fa fa-long-arrow-left"></i>' ,
                'next_text' => '<i class="fa fa-long-arrow-right"></i>' ,
                'type' => 'list' ,
                'end_size' => 3 ,
                'mid_size' => 3
            ) ) );
            ?>
        </nav>
    </div>
<?php } else { ?>
    <div class="text-center loadmore-wraper row">
        <div class="more-product">
            <a class="shop-link" id="load-more-product" data-value="1" data-post="product" href="javascript:void(0);">
                <i class="fa fa-circle"></i>
                <i class="fa fa-circle"></i>
                <i class="fa fa-circle"></i>
            </a>
        </div>
    </div>
<?php } ?>