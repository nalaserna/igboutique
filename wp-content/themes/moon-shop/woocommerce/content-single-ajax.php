
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$product = wc_get_product( $post );

$classes = array();
$classes[] = 'product-quick-view single-product-content';

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
    return;
?>
<div class="modal-container container">
    <div class="row">
        <div class="col-sm-12">
            <button class="model-close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <div <?php post_class( $classes ); ?> id="product-<?php the_ID(); ?>">
                <div class="pro-info-container fix">
                    <div class="product-info col-md-6 col-xs-12">

                        <?php
                        /**
                         * woocommerce_single_product_summary hook.
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>

                    </div>
                    <!-- .summary -->

                    <div class="product-image col-md-6 col-xs-12">
                        <?php
                        wc_get_template( 'single-product/sale-flash.php' );
                        get_template_part('woocommerce/ajax-product-image');
                        ?>
                    </div>

                    <meta itemprop="url" content="<?php the_permalink(); ?>"/>
                </div>
            </div>
        </div>
    </div>
</div>