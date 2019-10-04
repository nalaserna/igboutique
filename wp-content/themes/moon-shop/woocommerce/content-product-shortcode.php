<?php

if( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product , $woocommerce_loop;

// Ensure visibility
if( empty( $product ) || !$product->is_visible() ) {
    return;
}

//theme options 
$moon_shop_optionsValue = get_option( 'moon_shop' );

$moon_shop_parent_class = 'sin-product';
$moon_shop_image_class = 'pro-image';
$moon_hover_img = true;

if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] == 'style-two' ) {
    $moon_shop_parent_class = 'sin-promo-product';
    $moon_shop_image_class = 'promo-pro-image';
    $moon_hover_img = false;
} else {
    $moon_shop_parent_class = 'sin-product';
    $moon_shop_image_class = 'pro-image';
    $moon_hover_img = true;
}

$moon_shop_quick_view = isset($moon_shop_optionsValue['moon-shop-quick-view']) ? $moon_shop_optionsValue['moon-shop-quick-view'] : '1';
?>
<div <?php post_class( 'padding-left-right grid-product' ); ?>>
    <div class="<?php echo esc_attr( $moon_shop_parent_class ); ?> fix">
        <!-- Product Image -->
        <div class="<?php echo esc_attr( $moon_shop_image_class ); ?>">
            <?php
            /**
             * woocommerce_before_shop_loop_item hook.
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_before_shop_loop_item' );

            $availability = $product->get_availability();
            $moon_shop_badge_text = isset($moon_shop_optionsValue['moon-shop-out-of-stock-badge']) && !empty($moon_shop_optionsValue['moon-shop-out-of-stock-badge']) ? $moon_shop_optionsValue['moon-shop-out-of-stock-badge'] : 'Out of Stock';
            if( $availability[ 'availability' ] == 'Out of stock' ) {
                echo '<div class="outOfstock"><span>'.$moon_shop_badge_text.'</span></div>';
            }

            /**
             * woocommerce_before_shop_loop_item_title hook.
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            $moon_shop_image_url = get_the_post_thumbnail_url( $product->get_id() , 'shop_single' );
            ?>
            <!-- Product Hover Content -->
            <div class="pro-hover fix"
                 style="background-image: url('<?php echo ( $moon_hover_img ) ? $moon_shop_image_url : ''; ?>');">
                <!-- Product Hover Action -->
                <div class="pro-hover-action animated text-center">
                    <?php
                    $moon_shop_catalog = isset($moon_shop_optionsValue['moon-shop-catalog-mode']) ? $moon_shop_optionsValue['moon-shop-catalog-mode'] : '0';
                    if ($moon_shop_catalog != '1') {
                        wc_get_template( 'loop/add-to-cart.php' );
                    }
                    if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] == 'style-two' ) {
                        if( in_array( 'yith-woocommerce-wishlist/init.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
                            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
                            <?php if($moon_shop_quick_view != '0') { ?>
                            <a href=".ajax-product" class="quick-view pro-action"
                               data-id="<?php echo get_the_ID(); ?>" data-toggle="modal"
                               title="<?php echo __( 'View Product' , 'moon-shop' ); ?>"><i class="fa fa-eye"></i></a>
                            <?php } ?>
                        <?php
                        } else {
                            ?>
                            <?php if($moon_shop_quick_view != '0') { ?>
                            <a href=".ajax-product" class="quick-view pro-action pull-right"
                               data-id="<?php echo get_the_ID(); ?>" data-toggle="modal"
                               title="<?php echo __( 'View Product' , 'moon-shop' ); ?>"><i class="fa fa-eye"></i></a>
                            <?php } ?>
                        <?php
                        }
                    } else {
                        if( in_array( 'yith-woocommerce-wishlist/init.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
                            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                        } ?>
                        <?php if($moon_shop_quick_view != '0') { ?>
                        <a href=".ajax-product" class="quick-view pro-action"
                           data-id="<?php echo get_the_ID(); ?>" data-toggle="modal" title="<?php echo __( 'View Product' , 'moon-shop' ); ?>"><i class="fa fa-eye"></i></a>
                        <?php } ?>
                    <?php
                    } ?>
                </div>
            </div>
        </div>

        <div class="pro-content text-center">
            <?php
            /**
             * woocommerce_shop_loop_item_title hook.
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item hook.
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook.
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>
    </div>
</div>
	