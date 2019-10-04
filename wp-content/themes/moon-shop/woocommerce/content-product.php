<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}

//theme options 
$moon_shop_optionsValue = get_option( 'moon_shop' );

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
<li <?php wc_product_class( '', $product ); ?>>
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
            $moon_shop_badge_text = isset($moon_shop_optionsValue['moon-shop-out-of-stock-badge']) && !empty($moon_shop_optionsValue['moon-shop-out-of-stock-badge']) ? $moon_shop_optionsValue['moon-shop-out-of-stock-badge'] : __('Out of Stock', 'moon-shop');
            if( $availability[ 'class' ] == 'out-of-stock' ) {
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
            <div class="pro-hover fix" style="background-image: url('<?php echo ( $moon_hover_img ) ? $moon_shop_image_url : ''; ?>');">
                <!-- Product Hover Action -->
                <div class="pro-hover-action animated text-center">
                    <?php
                    $moon_shop_catalog = isset($moon_shop_optionsValue['moon-shop-catalog-mode']) ? $moon_shop_optionsValue['moon-shop-catalog-mode'] : '0';
                    if ($moon_shop_catalog != '1') {
                        if ( $product ) {
                            $defaults = array(
                                'quantity'   => 1,
                                'class'      => implode( ' ', array_filter( array(
                                    'button',
                                    'product_type_' . $product->get_type(),
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                    $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                                ) ) ),
                                'attributes' => array(
                                    'data-product_id'  => $product->get_id(),
                                    'data-product_sku' => $product->get_sku(),
                                    'aria-label'       => $product->add_to_cart_description(),
                                    'rel'              => 'nofollow',
                                ),
                            );
                            $args = array();

                            $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

                            if ( isset( $args['attributes']['aria-label'] ) ) {
                                $args['attributes']['aria-label'] = strip_tags( $args['attributes']['aria-label'] );
                            }
                            wc_get_template( 'loop/add-to-cart.php', $args );
                        }
                    }

                    if( in_array( 'yith-woocommerce-wishlist/init.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
                        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                    }
                    if($moon_shop_quick_view != '0') { ?>
                        <a href=".ajax-product" class="quick-view pro-action" data-id="<?php echo esc_attr( $product->get_id() ); ?>" data-toggle="modal" title="<?php echo __( 'View Product' , 'moon-shop' ); ?>"><i class="fa fa-eye"></i></a>
                    <?php } ?>
                </div>
                <?php moon_shop_swatches_list(); ?>
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
             * woocommerce_after_shop_loop_item_title hook.
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item hook.
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );

            //moon_product_sale_countdown();
            ?>
        </div>
    </div>
</li>
	