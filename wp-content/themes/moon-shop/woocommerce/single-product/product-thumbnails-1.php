<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post, $product;
?>
<div id="product-thumbs" class="owl-carousel owl-theme">
    <?php
    if ( has_post_thumbnail() ) {
        echo '<div class="item">';
        echo get_the_post_thumbnail( $product->get_id(), 'shop_catalog' );
        echo '</div>';
    }

    $attachment_ids = $product->get_gallery_image_ids();

    if ( $attachment_ids && has_post_thumbnail() ) {
        foreach ( $attachment_ids as $attachment_id ) {
            echo '<div class="item">';
            echo wp_get_attachment_image( $attachment_id, 'shop_catalog', false );
            echo'</div>';
        }
    }
    ?>
</div>