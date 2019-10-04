<?php

/**
 * Add to wishlist template
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

if( !defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly

global $product;

//theme options
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_class = '';

if( is_shop() ) {

    if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] == 'style-two' ) {

        $moon_shop_class = 'pull-right';
    } else {

        $moon_shop_class = '';
    }
} else {

    if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-hover-style-select' ] == 'style-two' ) {

        $moon_shop_class = 'pull-right';
    } else {

        $moon_shop_class = '';
    }
}
$moon_shop_catalog = $moon_shop_optionsValue['moon-shop-catalog-mode'];
$moon_shop_catalog_class = '';
if (isset($moon_shop_catalog) && $moon_shop_catalog == '1') {
    $moon_shop_catalog_class = 'left-margin-zero';
}
?>

<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?>">
    <?php if( !( $disable_wishlist && !is_user_logged_in() ) ): ?>
        <div class="yith-wcwl-add-button <?php echo ( $exists && !$available_multi_wishlist ) ? 'hide' : 'show' ?>"
             style="display:<?php echo ( $exists && !$available_multi_wishlist ) ? 'none' : 'block' ?>">
            <?php yith_wcwl_get_template( 'add-to-wishlist-' . $template_part . '.php' , $atts ); ?>
        </div>
        <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
            <a class="like <?php echo esc_attr($moon_shop_catalog_class); ?>" href="<?php echo esc_url( $wishlist_url ) ?>" rel="nofollow"
               title="<?php echo apply_filters( 'yith-wcwl-browse-wishlist-label' , $browse_wishlist_text ) ?>">
                <i class="fa fa-heart"></i>
            </a>
        </div>

        <div
            class="yith-wcwl-wishlistexistsbrowse <?php echo ( $exists && !$available_multi_wishlist ) ? 'show' : 'hide' ?>"
            style="display:<?php echo ( $exists && !$available_multi_wishlist ) ? 'block' : 'none' ?>">
            <a class="like <?php echo esc_attr($moon_shop_catalog_class); ?>" href="<?php echo esc_url( $wishlist_url ) ?>" rel="nofollow"
               title="<?php echo apply_filters( 'yith-wcwl-browse-wishlist-label' , $browse_wishlist_text ) ?>">
                <i class="fa fa-heart"></i>
            </a>
        </div>
        <div style="clear:both"></div>
        <div class="yith-wcwl-wishlistaddresponse"></div>
    <?php else: ?>
        <a href="<?php echo esc_url( add_query_arg( array( 'wishlist_notice' => 'true' , 'add_to_wishlist' => $product_id ) , get_permalink( wc_get_page_id( 'myaccount' ) ) ) ) ?>"
           rel="nofollow" class="<?php echo str_replace( 'add_to_wishlist' , '' , $link_classes ) ?>">
            <?php echo esc_attr( $icon ); ?>
            <?php echo esc_attr( $label ); ?>
        </a>
    <?php endif; ?>
</div>
<div class="clear"></div>