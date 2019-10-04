<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 2 );
$post_thumbnail_id = get_post_thumbnail_id( $product->get_id() );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'shop_single' );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . $placeholder,
    'woocommerce-product-gallery--columns-' . absint( $columns ),
    'images',
) );
?>
<div class="pro-image-tab-container tab-content fix">
    <?php
    $attributes = array(
        'title'                   => $image_title,
        'data-src'                => $full_size_image[0],
        'data-large_image'        => $full_size_image[0],
        'data-large_image_width'  => $full_size_image[1],
        'data-large_image_height' => $full_size_image[2],
    );

    if ( has_post_thumbnail() ) {
        $html  = '<div data-thumb="' . get_the_post_thumbnail_url( $product->get_id(), 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
        $html .= get_the_post_thumbnail( $product->get_id(), 'shop_single', $attributes );
        $html .= '</div>';
    } else {
        $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
        $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'moon-shop' ) );
        $html .= '</div>';
    }

    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $product->get_id() ) );
    ?>
</div>