<?php

/**
 * The template for displaying product category thumbnails within loops
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */


if( !defined( 'ABSPATH' ) ) {

    exit;

}

?>

<div <?php wc_product_cat_class( 'sin-product-list fix' , $category ); ?>>

    <div class="list-pro-image col-lg-4 col-sm-5 col-xs-12">

        <?php

        /**
         * woocommerce_before_subcategory hook.
         * @hooked woocommerce_template_loop_category_link_open - 10
         */

        do_action( 'woocommerce_before_subcategory' , $category );


        /**
         * woocommerce_before_subcategory_title hook.
         * @hooked woocommerce_subcategory_thumbnail - 10
         */

        do_action( 'woocommerce_before_subcategory_title' , $category );


        /**
         * woocommerce_after_subcategory_title hook.
         */

        do_action( 'woocommerce_after_subcategory_title' , $category );


        /**
         * woocommerce_after_subcategory hook.
         * @hooked woocommerce_template_loop_category_link_close - 10
         */

        do_action( 'woocommerce_after_subcategory' , $category ); ?>

    </div>

    <div class="list-pro-content col-lg-6 col-sm-7 col-xs-12">

        <?php

        /**
         * woocommerce_shop_loop_subcategory_title hook.
         * @hooked woocommerce_template_loop_category_title - 10
         */

        echo '<a href="' . get_term_link( $category , 'product_cat' ) . '">';

        do_action( 'woocommerce_shop_loop_subcategory_title' , $category );

        echo '</a>';

        ?>

    </div>

</div>