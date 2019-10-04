<?php

/**
 * Product loop sale flash
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$moon_shop_optionsValue = get_option( 'moon_shop' );
$featured_on = isset($moon_shop_optionsValue['moon-shop-featured-label']) ? $moon_shop_optionsValue['moon-shop-featured-label'] : '';
$featured_label = isset($moon_shop_optionsValue['moon-shop-featured-label-text']) ? $moon_shop_optionsValue['moon-shop-featured-label-text'] : 'hot';
$sale_style = isset($moon_shop_optionsValue['moon-shop-shop-product-sale']) ? $moon_shop_optionsValue['moon-shop-shop-product-sale'] : 'percentage';
$sale_label = isset($moon_shop_optionsValue['moon-shop-shop-product-sale-label']) ? $moon_shop_optionsValue['moon-shop-shop-product-sale-label'] : 'Sale';

global $post , $product;

if ($product->is_on_sale() && ($product->is_featured() && $featured_on == '1')) {
	$regular_price = $product->get_regular_price();
	$sale_price = $product->get_sale_price();
    if ($sale_style == 'percentage' && (!empty($regular_price) || !empty($sale_price))) {
		$percentage = (($regular_price - $sale_price)/$regular_price)*100;
		echo apply_filters( 'woocommerce_sale_flash' , '<span class="onsale pro-label great-deal">' . __('-', 'moon-shop') . intval($percentage) . __('%', 'moon-shop') . '</span>' , $post , $product );
	} else {
		echo apply_filters( 'woocommerce_sale_flash' , '<span class="onsale pro-label great-deal">' .$sale_label . '</span>' , $post , $product );
	}
	echo apply_filters( 'woocommerce_sale_flash' , '<span class="onsale pro-label hot-deal" style="top: 42px;">' . $featured_label . '</span>' , $post , $product );
} else {
	if( $product->is_on_sale() ) :
		$regular_price = $product->get_regular_price();
		$sale_price = $product->get_sale_price();
	    if ($sale_style == 'percentage' && (!empty($regular_price) || !empty($sale_price))) {
			$percentage = (($regular_price - $sale_price)/$regular_price)*100;
			echo apply_filters( 'woocommerce_sale_flash' , '<span class="onsale pro-label great-deal">' . __('-', 'moon-shop') . intval($percentage) . __('%', 'moon-shop') . '</span>' , $post , $product );
		} else {
			echo apply_filters( 'woocommerce_sale_flash' , '<span class="onsale pro-label great-deal">' .$sale_label . '</span>' , $post , $product );
		}
	endif;

	if( $product->is_featured() && $featured_on == '1' ) :
	    echo apply_filters( 'woocommerce_sale_flash' , '<span class="onsale pro-label hot-deal">' . $featured_label . '</span>' , $post , $product );
	endif;
}