<?php
add_action( 'wp_ajax_nopriv_moon_shop_ajaxloader' , 'moon_shop_ajaxloader' );

add_action( 'wp_ajax_moon_shop_ajaxloader' , 'moon_shop_ajaxloader' );

/**
 * Ajax Loader Call Back Function
 * Responses To Ajax Requests
 */
function moon_shop_ajaxloader() {

    global $wpdb;

    $moon_shop_postType = esc_attr( $_POST[ 'postType' ] );

    $moon_shop_pagedNumber = esc_attr( $_POST[ 'pagedNumber' ] );

    $moon_shop_orderby = esc_attr( $_POST[ 'orderby' ] );

    $moon_shop_posts_per_page = esc_attr( $_POST[ 'postsPerPage' ] );

    $moon_shop_tax_name = esc_attr( $_POST[ 'taxName' ] );

    $moon_shop_tag_name = esc_attr( $_POST[ 'tagName' ] );

    $moon_shop_rating = esc_attr( $_POST[ 'rating' ] );

    $moon_shop_min_value = esc_attr( $_POST[ 'minValue' ] );

    $moon_shop_max_value = esc_attr( $_POST[ 'maxValue' ] );

    $moon_shop_hover = esc_attr( $_POST[ 'hoverClass' ] );

    if( $moon_shop_postType == 'product' ) {

        $args = array(

            'post_type' => 'product' ,

            'product_cat' => $moon_shop_tax_name ,

            'product_tag' => $moon_shop_tag_name ,

            'tax_query' => array(

                'taxonomy' => 'product_tag' ,

                'field' => 'slug' ,

                'terms' => $moon_shop_tag_name ,

                'operator' => 'IN' ,

                'include_children' => 1 ,

            ) ,

            'meta_query' => array(

                array(

                    'key' => '_price' ,

                    'value' => array( $moon_shop_min_value , $moon_shop_max_value ) ,

                    'compare' => 'BETWEEN' ,

                    'type' => 'DECIMAL' ,

                    'price_filter' => true ,

                ) ,

                array(

                    'key' => '_wc_average_rating' ,

                    'value' => is_numeric( $moon_shop_rating ) ? $moon_shop_rating : 0 ,

                    'compare' => '>=' ,

                    'type' => 'DECIMAL' ,

                    'rating_filter' => true ,

                ) ,

            ) ,

            'posts_per_page' => $moon_shop_posts_per_page ,

            'offset' => $moon_shop_posts_per_page * $moon_shop_pagedNumber ,

            'orderby' => $moon_shop_orderby ,

            'order' => 'DESC' ,

        );

        $moon_shop_loop = new WP_Query( $args );

        if( $moon_shop_loop->have_posts() ) {

            $response[ 'grid' ] = moon_shop_product_grid( $moon_shop_loop , $moon_shop_hover );

            $response[ 'list' ] = moon_shop_product_list( $moon_shop_loop );

            $response[ 'count' ] = count( $moon_shop_loop->posts );

        } else {

            $response[ 'data' ] = 'no-data';

        }

        echo json_encode( $response );

    }

    wp_reset_postdata();

    wp_die();
}

//product grid data
function moon_shop_product_grid( $moon_shop_loop , $moon_shop_hover ) {

    ob_start();

    while( $moon_shop_loop->have_posts() ) : $moon_shop_loop->the_post();

        wc_get_template( 'content-product.php' , array( 'hover' => $moon_shop_hover ) );

    endwhile;

    return ob_get_clean();

}

//product list data
function moon_shop_product_list( $moon_shop_loop ) {
    ob_start();
    while( $moon_shop_loop->have_posts() ) : $moon_shop_loop->the_post();

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

            <div class="list-pro-content col-lg-6 col-sm-7 col-xs-12">

                <h3>

                    <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>

                </h3>

                <?php

                /**
                 * woocommerce_after_shop_loop_item hook.
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */

                do_action( 'woocommerce_after_shop_loop_item' );

                /**
                 * woocommerce_after_shop_loop_item_title hook.
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */

                do_action( 'woocommerce_after_shop_loop_item_title' );

                //sort-description
                wc_get_template( 'single-product/short-description.php' );

                ?>

                <div class="list-pro-action">

                    <?php

                    $defaults = array(

                        'quantity' => 1 ,

                        'class' => implode( ' ' , array_filter( array(

                            'button' ,

                            'product_type_' . $product->product_type ,

                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '' ,

                            $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''

                        ) ) )

                    );

                    $args = apply_filters( 'woocommerce_loop_add_to_cart_args' , wp_parse_args( $args , $defaults ) , $product );

                    echo apply_filters( 'woocommerce_loop_add_to_cart_link' ,

                        sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>' ,
                            esc_url( $product->add_to_cart_url() ) ,
                            esc_attr( isset( $quantity ) ? $quantity : 1 ) ,
                            get_the_ID() ,
                            esc_attr( $product->get_sku() ) ,
                            esc_attr( isset( $class ) ? $class . ' add-cart list-action' : 'button add-cart list-action' ) ,
                            '<i class="fa fa-shopping-cart"></i><span>Add to Cart</span>'
                        ) ,
                        $product );
                    echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                    ?>

                </div>

            </div>

        </div>

    <?php

    endwhile;

    return ob_get_clean();

}

add_action( 'wp_ajax_nopriv_moon_shop_ajaxloader_cart' , 'moon_shop_ajaxloader_cart' );

add_action( 'wp_ajax_moon_shop_ajaxloader_cart' , 'moon_shop_ajaxloader_cart' );

function moon_shop_ajaxloader_cart() {
    global $wpdb, $woocommerce;

    do_action( 'woocommerce_before_mini_cart_contents' );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
            $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
            $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                <?php if ( ! $_product->is_visible() ) : ?>
                    <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                        <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
                    </a>
                <?php endif; ?>
                <?php echo WC()->cart->get_item_data( $cart_item ); ?>

                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $product_price, $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
                <?php
                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times-circle-o"></i></a>',
                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                    __( 'Remove this item', 'moon-shop' ),
                    esc_attr( $product_id ),
                    esc_attr( $_product->get_sku() )
                ), $cart_item_key );
                ?>
            </li>
            <?php
        }
    }

    do_action( 'woocommerce_mini_cart_contents' );
}

add_action( 'wp_ajax_nopriv_moon_shop_ajaxloader_cart_price' , 'moon_shop_ajaxloader_cart_price' );

add_action( 'wp_ajax_moon_shop_ajaxloader_cart_price' , 'moon_shop_ajaxloader_cart_price' );

function moon_shop_ajaxloader_cart_price() {
    return wc_cart_totals_subtotal_html();
}