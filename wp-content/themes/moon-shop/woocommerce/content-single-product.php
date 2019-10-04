<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
//theme options
$moon_shop_optionsValue = get_option( 'moon_shop' );

$moon_shop_thumbs = isset($moon_shop_optionsValue['moon-shop-single-product-thumbs-number']) ? $moon_shop_optionsValue['moon-shop-single-product-thumbs-number'] : '4';
$product_sticky = isset($moon_shop_optionsValue['moon-shop-all-images-sticky']) ? $moon_shop_optionsValue['moon-shop-all-images-sticky'] : '';
$product_sticky_offset = isset($moon_shop_optionsValue['moon-shop-all-images-sticky-top']) ? $moon_shop_optionsValue['moon-shop-all-images-sticky-top']['top'] : '';
$moon_shop_image_style = isset($moon_shop_optionsValue[ 'moon-shop-single-product-style-select' ]) ? $moon_shop_optionsValue[ 'moon-shop-single-product-style-select' ] : 'left';
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="product-details pages">
        <div class="row">
            <div class="col-sm-12 single-product">
                <div class="pro-info-container fix row">
                    <div class="product-image col-md-6 col-xs-12 <?php echo ( $moon_shop_image_style == 'left' ) ? 'pull-left' : 'pull-right'; ?>">
                        <?php
                        /**
                         * woocommerce_before_single_product_summary hook.
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );

                        moon_shop_product_video(get_the_ID());
                        ?>
                    </div>
                    <div class="col-md-6 col-xs-12 product-single-details <?php echo ( $moon_shop_image_style == 'left' ) ? 'pull-right' : 'pull-left'; ?> <?php echo ($product_sticky == '1') ? 'single-content-sticky' : ''; ?>" data-offset="<?php echo $product_sticky_offset; ?>">
                        <div class="product-info">
                            <?php
                            /**
                             * Hook: woocommerce_single_product_summary.
                             *
                             * @hooked woocommerce_template_single_title - 5
                             * @hooked woocommerce_template_single_rating - 10
                             * @hooked woocommerce_template_single_price - 10
                             * @hooked woocommerce_template_single_excerpt - 20
                             * @hooked woocommerce_template_single_add_to_cart - 30
                             * @hooked woocommerce_template_single_meta - 40
                             * @hooked woocommerce_template_single_sharing - 50
                             * @hooked WC_Structured_Data::generate_product_data() - 60
                             */
                            do_action( 'woocommerce_single_product_summary' );
                            //moon_product_sale_countdown();
                            ?>
                        </div>
                    </div>
                    <!-- .summary -->
                    <meta itemprop="url" content="<?php the_permalink(); ?>"/>
                </div>

                <?php
                /**
                 * woocommerce_after_single_product_summary hook.
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action( 'woocommerce_after_single_product_summary' );
                ?>
            </div>
        </div>
    </div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
