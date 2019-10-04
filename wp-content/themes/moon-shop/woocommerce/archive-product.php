<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

//theme options
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_custom_inline_style = '';
if( ( isset( $moon_shop_optionsValue[ 'moon-shop-sidebar-enable' ] ) && $moon_shop_optionsValue[ 'moon-shop-sidebar-enable' ] == 1 ) ) {
    $moon_shop_custom_inline_style .= '@media only screen and ( max-width: 767px ) { .shop-sidebar { display: none; } }';
}

$moon_shop_full_banner = '';

if ( is_product_category() ) {
    $moon_shop_category_bc = isset($moon_shop_optionsValue['moon-shop-product-page-banner-select']) ? $moon_shop_optionsValue['moon-shop-product-page-banner-select'] : 'background_color';
    $moon_shop_category_bc_color = isset($moon_shop_optionsValue['moon-shop-product-banner-background-color']) ? $moon_shop_optionsValue['moon-shop-product-banner-background-color'] : '';
    $moon_shop_category_bc_image = isset($moon_shop_optionsValue['moon-shop-product-banner-background-image']) ? $moon_shop_optionsValue['moon-shop-product-banner-background-image'] : '';
    $moon_shop_category_bc_image_overlay = isset($moon_shop_optionsValue['moon-shop-product-banner-image-background-color']) ? $moon_shop_optionsValue['moon-shop-product-banner-image-background-color'] : '';
    $moon_shop_category_height_op = isset($moon_shop_optionsValue['moon-shop-product-page-banner-height']) ? $moon_shop_optionsValue['moon-shop-product-page-banner-height'] : 'default';
    $moon_shop_category_height = isset($moon_shop_optionsValue['moon-shop-product-banner-image-custom-height']) ? $moon_shop_optionsValue['moon-shop-product-banner-image-custom-height'] : '200';
    $moon_shop_desc_color = isset($moon_shop_optionsValue['moon-shop-category-desc-color']) ? $moon_shop_optionsValue['moon-shop-category-desc-color'] : '#fff';

    if ($moon_shop_category_bc == 'category') {
        global $wp_query;
        // get the query object
        $moon_shop_cat = $wp_query->get_queried_object();

        // get the thumbnail id using the queried category term_id
        $moon_shop_thumbnail_id = get_woocommerce_term_meta( $moon_shop_cat->term_id, 'thumbnail_id', true ); 

        // get the image URL
        $moon_shop_image = wp_get_attachment_url( $moon_shop_thumbnail_id );
        $moon_shop_custom_inline_style .= '.page-banner { background-image: url("'.$moon_shop_image.'");     background-size: cover; background-position: center center; }';
        $moon_shop_custom_inline_style .= '.page-banner .overlay { background-color: '.$moon_shop_category_bc_image_overlay['rgba'].'; }';
    } else if ($moon_shop_category_bc == 'custom') {
        $moon_shop_custom_inline_style .= '.page-banner { background-image: url("'.$moon_shop_category_bc_image['background-image'].'"); }';
        $moon_shop_custom_inline_style .= '.page-banner { background-repeat: no-repeat; background-position: center top; }';
        $moon_shop_custom_inline_style .= '.page-banner .overlay { background-color: '.$moon_shop_category_bc_image_overlay['rgba'].'; }';
    } else if ($moon_shop_category_bc == 'background_color') {
        if ($moon_shop_category_bc_color == '') {
            $moon_shop_theme_color = moon_shop_theme_color();
            $moon_shop_custom_inline_style .= '.page-banner { background-color: '.$moon_shop_theme_color.'; }';
        } else {
            $moon_shop_custom_inline_style .= '.page-banner { background-color: '.$moon_shop_category_bc_color.'; }';
        }
    }
    if( $moon_shop_category_height_op == 'full-height' ) {
        $moon_shop_full_banner = 'full-banner';
    } else if( $moon_shop_category_height_op == 'custom' ) {
        $moon_shop_custom_inline_style .= '.page-banner.moon-shop-banner { height: ' . $moon_shop_category_height . 'px;}';
    }
    $moon_shop_custom_inline_style .= '.term-description p { color: ' . $moon_shop_desc_color . ';}';
}
wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );

/**
 * woocommerce_before_main_content hook.
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );
?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
    <header class="woocommerce-products-header text-center moon-shop-banner page-banner <?php echo esc_attr( $moon_shop_full_banner ); ?>">
        <div class="display-table absolute overlay">
            <div class="vertical-middle">
                <div class="container">
                    <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                    <?php
                    /**
                     * Hook: woocommerce_archive_description.
                     *
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    do_action( 'woocommerce_archive_description' );
                    ?>
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>

<?php
$moon_shop_category_name = '';
$moon_shop_tag_name = '';
if( is_product_category() || is_product_tag() ) {
    $moon_shop_category = single_cat_title( '' , false );
    $moon_shop_tag = single_tag_title( '' , false );
    $moon_shop_categories = get_terms();

    foreach( $moon_shop_categories as $key ) {
        if( $key->taxonomy == 'product_cat' && $key->name == $moon_shop_category ) {
            $moon_shop_category_name = $key->slug;
        }
        if( $key->taxonomy == 'product_tag' && $key->name == $moon_shop_tag ) {
            $moon_shop_tag_name = $key->slug;
        }
    }
}

if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] != 'fullwidth' ) {
    if( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] == 'left_sidebar' ) {
        $moon_wraper_class = 'col-lg-9 col-md-8 col-xs-12 pull-right with-sidebar';
    } else {
        $moon_wraper_class = 'col-lg-9 col-md-8 col-xs-12 pull-left with-sidebar';
    }
} else {
    $moon_wraper_class = 'col-md-12';
}
?>
<input type="hidden" id="category-value" data-cat="<?php echo esc_attr( $moon_shop_category_name ); ?>" data-tag="<?php echo esc_attr( $moon_shop_tag_name ); ?>" data-min="<?php echo woo_min_max_price()->min_price; ?>" data-max="<?php echo woo_min_max_price()->max_price; ?>"/>
<div class="woocommerce-wrapper pages">
    <div class="container">
        <div class="row">
            <div class="shop-products <?php echo esc_attr( $moon_wraper_class ); ?>">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="shop-top-toolbar">
                            <?php
                            /**
                             * Hook: woocommerce_before_shop_loop.
                             *
                             * @hooked wc_print_notices - 10
                             * @hooked woocommerce_result_count - 20
                             * @hooked woocommerce_catalog_ordering - 30
                             */
                            do_action( 'woocommerce_before_shop_loop' );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-content col-xs-12 products">
                    <?php if( have_posts() ) : ?>

                        <?php
                        $moon_shop_list_view = '';
                        $moon_shop_grid_view = 'active';
                        if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-list-grid-toggle-enable-disable' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-list-grid-toggle-enable-disable' ] != 1 && isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-display-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-display-select' ] == 'list' ) {
                            $moon_shop_list_view = 'active';
                            $moon_shop_grid_view = '';
                        } else {
                            $moon_shop_list_view = '';
                            $moon_shop_grid_view = 'active';
                        }
                        ?>

                        <div id="grid-view" class="tab-pane row <?php echo esc_attr( $moon_shop_grid_view ); ?>">

                            <?php
                            woocommerce_product_loop_start();
                            if ( wc_get_loop_prop( 'total' ) ) {
                                while ( have_posts() ) {
                                    the_post();

                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     *
                                     * @hooked WC_Structured_Data::generate_product_data() - 10
                                     */
                                    do_action( 'woocommerce_shop_loop' );

                                    wc_get_template_part( 'content', 'product' );
                                }
                            }
                            woocommerce_product_loop_end();
                            ?>

                        </div>

                        <div id="list-view" class="tab-pane row <?php echo esc_attr( $moon_shop_list_view ); ?>">

                            <?php
                            woocommerce_product_loop_start();
                            if ( wc_get_loop_prop( 'total' ) ) {
                            while( have_posts() ) : the_post();
                                global $product;
                                ?>

                                <div class="sin-product-list fix">
                                    <div class="list-pro-image col-lg-4 col-sm-5 col-xs-12">
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <?php
                                            //sale flash
                                            wc_get_template( 'loop/sale-flash.php' );

                                            //product image
                                            echo woocommerce_get_product_thumbnail( 'moon_shop_image_270x278' );
                                            ?>
                                        </a>
                                    </div>
                                    <div class="list-pro-content col-lg-8 col-sm-7 col-xs-12">
                                        <h3>
                                            <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                        </h3>
                                        <?php moon_shop_swatches_list(); ?>
                                        <?php
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

                                        <?php
                                        //sort-description
                                        wc_get_template( 'single-product/short-description.php' );
                                        ?>
                                        <div class="list-pro-action">
                                            <?php
                                            //add to cart button
                                            $moon_shop_catalog = $moon_shop_optionsValue['moon-shop-catalog-mode'];
                                            if (isset($moon_shop_catalog) && $moon_shop_catalog != '1') {
                                                echo apply_filters( 'woocommerce_loop_add_to_cart_link' , sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s ajax_add_to_cart">%s</a>' , esc_url( $product->add_to_cart_url() ) , esc_attr( isset( $quantity ) ? $quantity : 1 ) , get_the_ID() , esc_attr( $product->get_sku() ) , esc_attr( isset( $class ) ? $class . ' add-cart list-action' : 'button add-cart list-action' ) , '<i class="fa fa-shopping-cart"></i><span>'.__('Add to Cart','moon-shop').'</span>' ) , $product );
                                            }
                                            //wishlist button
                                            if( in_array( 'yith-woocommerce-wishlist/init.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
                                                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            <?php endwhile;
                            } ?>

                            <?php woocommerce_product_loop_end(); ?>
                        </div>

                        <?php
                        /**
                         * woocommerce_after_shop_loop hook.
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                        ?>

                    <?php elseif( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ) , 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                        <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                    <?php endif; ?>
                </div>
            </div>
            <?php if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] != 'fullwidth' ) { ?>
                <div class="col-lg-3 col-md-4 col-xs-12 shop-sidebar <?php echo ( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-layout-select' ] == 'left_sidebar' ) ? 'pull-left' : 'pull-right'; ?>">
                    <?php dynamic_sidebar( 'woo_sidebar' ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
/**
 * woocommerce_after_main_content hook.
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );