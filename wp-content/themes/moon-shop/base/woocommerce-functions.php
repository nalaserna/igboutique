<?php

//theme options
$moon_shop_optionsValue = get_option( 'moon_shop' );

// function modify for comment form
function moon_shop_comment_form( $args = array() , $post_id = null ) {
    if( null === $post_id ) $post_id = get_the_ID();

    // Exit the function when comments for the post are closed.
    if( !comments_open( $post_id ) ) {
        /**
         * Fires after the comment form if comments are closed.
         * @since 3.0.0
         */
        do_action( 'comment_form_comments_closed' );

        return;
    }

    $commenter = wp_get_current_commenter();
    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';

    $args = wp_parse_args( $args );
    if( !isset( $args[ 'format' ] ) ) $args[ 'format' ] = current_theme_supports( 'html5' , 'comment-form' ) ? 'html5' : 'xhtml';

    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $html5 = 'html5' === $args[ 'format' ];
    $fields = array( 'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' , 'moon-shop' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>' , 'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email' , 'moon-shop' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>' , 'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website' , 'moon-shop' ) . '</label> ' . '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="30" maxlength="200" /></p>' , );

    $required_text = sprintf( ' ' . __( 'Required fields are marked %s' , 'moon-shop' ) , '<span class="required">*</span>' );

    /**
     * Filters the default comment form fields.
     * @since 3.0.0
     * @param array $fields The default comment fields.
     */
    $fields = apply_filters( 'comment_form_default_fields' , $fields );
    $defaults = array( 'fields' => $fields , 'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment' , 'noun' , 'moon-shop' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>' , /** This filter is documented in wp-includes/link-template.php */
        'must_log_in' => '<p class="must-log-in">' . sprintf( /* translators: %s: login URL */
                __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'moon-shop' ) , wp_login_url( apply_filters( 'the_permalink' , get_permalink( $post_id ) ) ) ) . '</p>' , /** This filter is documented in wp-includes/link-template.php */
        'logged_in_as' => '<p class="logged-in-as">' . sprintf( /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
                __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>' , 'moon-shop' ) , get_edit_user_link() , /* translators: %s: user name */
                esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' , 'moon-shop' ) , $user_identity ) ) , $user_identity , wp_logout_url( apply_filters( 'the_permalink' , get_permalink( $post_id ) ) ) ) . '</p>' , 'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . __( 'Your email address will not be published.' , 'moon-shop' ) . '</span>' . ( $req ? $required_text : '' ) . '</p>' , 'comment_notes_after' => '' , 'action' => site_url( '/wp-comments-post.php' ) , 'id_form' => 'commentform' , 'id_submit' => 'submit' , 'class_form' => 'comment-form' , 'class_submit' => 'submit' , 'name_submit' => 'submit' , 'title_reply' => __( 'Leave a Reply' , 'moon-shop' ) , 'title_reply_to' => __( 'Leave a Reply to %s' , 'moon-shop' ) , 'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">' , 'title_reply_after' => '</h3>' , 'cancel_reply_before' => ' <small>' , 'cancel_reply_after' => '</small>' , 'cancel_reply_link' => __( 'Cancel reply' , 'moon-shop' ) , 'label_submit' => __( 'Post Comment' , 'moon-shop' ) , 'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />' , 'submit_field' => '<div class="input-box">%1$s %2$s</div>' , 'format' => 'xhtml' , );

    /**
     * Filters the comment form default arguments.
     * Use {@see 'comment_form_default_fields'} to filter the comment fields.
     * @since 3.0.0
     * @param array $defaults The default comment form arguments.
     */
    $args = wp_parse_args( $args , apply_filters( 'comment_form_defaults' , $defaults ) );

    // Ensure that the filtered args contain all required default values.
    $args = array_merge( $defaults , $args );

    /**
     * Fires before the comment form.
     * @since 3.0.0
     */
    do_action( 'comment_form_before' );
    ?>
    <div id="respond" class="comment-respond">
        <?php
        echo( $args[ 'title_reply_before' ] );

        comment_form_title( $args[ 'title_reply' ] , $args[ 'title_reply_to' ] );

        echo( $args[ 'cancel_reply_before' ] );

        cancel_comment_reply_link( $args[ 'cancel_reply_link' ] );

        echo( $args[ 'cancel_reply_after' ] );

        echo( $args[ 'title_reply_after' ] );

        if( get_option( 'comment_registration' ) && !is_user_logged_in() ) :
            echo( $args[ 'must_log_in' ] );
            /**
             * Fires after the HTML-formatted 'must log in after' message in the comment form.
             * @since 3.0.0
             */
            do_action( 'comment_form_must_log_in_after' );
        else : ?>
            <form action="<?php echo esc_url( $args[ 'action' ] ); ?>" method="post"
                  id="<?php echo esc_attr( $args[ 'id_form' ] ); ?>"
                  class="<?php echo esc_attr( $args[ 'class_form' ] ); ?>"<?php echo esc_attr( $html5 ) ? ' novalidate' : ''; ?>>
                <?php
                /**
                 * Fires at the top of the comment form, inside the form tag.
                 * @since 3.0.0
                 */
                do_action( 'comment_form_top' );

                if( is_user_logged_in() ) :
                    /**
                     * Filters the 'logged in' message for the comment form for display.
                     * @since 3.0.0
                     * @param string $args_logged_in The logged-in-as HTML-formatted message.
                     * @param array $commenter An array containing the comment author's
                     *                               username, email, and URL.
                     * @param string $user_identity If the commenter is a registered user,
                     *                               the display name, blank otherwise.
                     */
                    echo apply_filters( 'comment_form_logged_in' , $args[ 'logged_in_as' ] , $commenter , $user_identity );

                    /**
                     * Fires after the is_user_logged_in() check in the comment form.
                     * @since 3.0.0
                     * @param array $commenter An array containing the comment author's
                     *                              username, email, and URL.
                     * @param string $user_identity If the commenter is a registered user,
                     *                              the display name, blank otherwise.
                     */
                    do_action( 'comment_form_logged_in_after' , $commenter , $user_identity );

                else :

                    echo( $args[ 'comment_notes_before' ] );

                endif;

                // Prepare an array of all fields, including the textarea
                $comment_fields = (array)$args[ 'fields' ] + array( 'comment' => $args[ 'comment_field' ] );

                /**
                 * Filters the comment form fields, including the textarea.
                 * @since 4.4.0
                 * @param array $comment_fields The comment fields.
                 */
                $comment_fields = apply_filters( 'comment_form_fields' , $comment_fields );

                // Get an array of field names, excluding the textarea
                $comment_field_keys = array_diff( array_keys( $comment_fields ) , array( 'comment' ) );

                // Get the first and the last field name, excluding the textarea
                $first_field = reset( $comment_field_keys );
                $last_field = end( $comment_field_keys );

                foreach( $comment_fields as $name => $field ) {

                    if( 'comment' === $name ) {

                        /**
                         * Filters the content of the comment textarea field for display.
                         * @since 3.0.0
                         * @param string $args_comment_field The content of the comment textarea field.
                         */
                        echo apply_filters( 'comment_form_field_comment' , $field );

                        echo( $args[ 'comment_notes_after' ] );

                    } elseif( !is_user_logged_in() ) {

                        if( $first_field === $name ) {
                            /**
                             * Fires before the comment fields in the comment form, excluding the textarea.
                             * @since 3.0.0
                             */
                            do_action( 'comment_form_before_fields' );
                        }

                        /**
                         * Filters a comment form field for display.
                         * The dynamic portion of the filter hook, `$name`, refers to the name
                         * of the comment form field. Such as 'author', 'email', or 'url'.
                         * @since 3.0.0
                         * @param string $field The HTML-formatted output of the comment form field.
                         */
                        echo apply_filters( "comment_form_field_{$name}" , $field ) . "\n";

                        if( $last_field === $name ) {
                            /**
                             * Fires after the comment fields in the comment form, excluding the textarea.
                             * @since 3.0.0
                             */
                            do_action( 'comment_form_after_fields' );
                        }
                    }
                }

                $submit_button = sprintf( $args[ 'submit_button' ] , esc_attr( $args[ 'name_submit' ] ) , esc_attr( $args[ 'id_submit' ] ) , esc_attr( $args[ 'class_submit' ] ) , esc_attr( $args[ 'label_submit' ] ) );

                /**
                 * Filters the submit button for the comment form to display.
                 * @since 4.2.0
                 * @param string $submit_button HTML markup for the submit button.
                 * @param array $args Arguments passed to `comment_form()`.
                 */
                $submit_button = apply_filters( 'comment_form_submit_button' , $submit_button , $args );

                $submit_field = sprintf( $args[ 'submit_field' ] , $submit_button , get_comment_id_fields( $post_id ) );
                /**
                 * Filters the submit field for the comment form to display.
                 * The submit field includes the submit button, hidden fields for the
                 * comment form, and any wrapper markup.
                 * @since 4.2.0
                 * @param string $submit_field HTML markup for the submit field.
                 * @param array $args Arguments passed to comment_form().
                 */
                echo apply_filters( 'comment_form_submit_field' , $submit_field , $args );

                /**
                 * Fires at the bottom of the comment form, inside the closing </form> tag.
                 * @since 1.5.0
                 * @param int $post_id The post ID.
                 */
                //do_action( 'comment_form' , $post_id );
                ?>
            </form>
        <?php endif; ?>
    </div><!-- #respond -->
    <?php

    /**
     * Fires after the comment form.
     * @since 3.0.0
     */
    do_action( 'comment_form_after' );
}

if (!function_exists('wo9876_template_single_category')) {
    //hook for single product breadcrumb
    add_action( 'woocommerce_single_product_summary' , 'wo9876_template_single_category' , 4 );
    function wo9876_template_single_category() {

        $args = array( 'delimiter' => '&nbsp;&gt;&nbsp;' , 'wrap_before' => '<div class="bradcamp"><ul>' , 'wrap_after' => '</ul></div>' , 'before' => '<li>' , 'after' => '</li>' , );

        echo woocommerce_breadcrumb( $args );
    }
}

remove_action( 'woocommerce_review_comment_text' , 'woocommerce_review_display_comment_text' , 10 );
add_action( 'woocommerce_review_comment_text' , 'woo9876_review_display_comment_text' , 10 );
function woo9876_review_display_comment_text() {
    comment_text();
}

//out of stock badge
add_action( 'woocommerce_before_single_product_summary_summary' , 'moon_shop_outofstock' , 9 );
function moon_shop_outofstock() {
    global $product;
    $availability = $product->get_availability();
    $availability_class = esc_attr( $availability[ 'class' ] );
    if( $availability_class == 'out-of-stock' ) {
        echo '<div class="outOfstock"><span>'.esc_attr__('Out of Stock', 'moon-shop').'</span></div>';
    }
}

//availabity
add_action( 'woocommerce_single_product_summary' , 'moon_shop_woo_stock_html' , 15 );
function moon_shop_woo_stock_html() {
    global $product;
    $availability = $product->get_availability();
    preg_match_all( '!\d+!' , $availability[ 'availability' ] , $availability_number );

    $availability_class = esc_attr( $availability[ 'class' ] );

    $moon_shop_availability_text = '';

    echo '<div class="price-ds stock ' . $availability_class . '">';
    if( $availability_class == 'out-of-stock' ) {
        $moon_shop_availability_text .= '<span class="availabity">'.esc_attr__('Available:', 'moon-shop').' '.'<a href="javascript:void(0)" tabindex="0">'.esc_attr__('Out of Stock', 'moon-shop').'</a></span>';
    } else {
        if( !empty( $availability_number[ 0 ][ 0 ] ) ) {
            $moon_shop_availability_text .= '<span class="discount">'.sprintf( __( 'Only %s Left', 'moon-shop' ), $availability_number[ 0 ][ 0 ]) . '</span>';
        }
        $moon_shop_availability_text .= '<span class="availabity">'.esc_attr__('Available:', 'moon-shop').' '.'<a href="javascript:void(0)" tabindex="0">'.esc_attr__('In Stock', 'moon-shop').'</a></span>';
    }
    echo( $moon_shop_availability_text );
    echo '</div>';
}

//content product image
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'moon_template_loop_product_thumbnail', 10 );
function moon_template_loop_product_thumbnail() {
    echo moon_loop_product_thumbnail();
}
function moon_loop_product_thumbnail( $size = 'shop_single', $deprecated1 = 0, $deprecated2 = 0 ) {
    global $post;
    $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

    if ( has_post_thumbnail() ) {
        $props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
        return get_the_post_thumbnail( $post->ID, $image_size, array(
            'title'  => $props['title'],
            'alt'    => $props['alt'],
        ) );
    } elseif ( wc_placeholder_img_src() ) {
        return wc_placeholder_img( $image_size );
    }
}

//hook for single rating
remove_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_rating' , 10 );
add_action( 'woocommerce_single_product_summary' , 'woocommerce_template_single_rating' , 5 );

//related product title
remove_action( 'woocommerce_shop_loop_item_title' , 'woocommerce_template_loop_product_title' , 10 );
add_action( 'woocommerce_shop_loop_item_title' , 'woo9876_template_loop_product_title' , 10 );
function woo9876_template_loop_product_title() {
    echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
}

//related product category
$moon_shop_category_on = isset($moon_shop_optionsValue['moon-shop-category-loop']) ? $moon_shop_optionsValue['moon-shop-category-loop'] : '1';
if ($moon_shop_category_on == '1') {
    add_action( 'woocommerce_shop_loop_item_title' , 'wo9876_template_related_category' , 9 );
}
function wo9876_template_related_category() {
    $moon_shop_categories = wp_get_post_terms( get_the_ID() , 'product_cat' );

    $moon_shop_cat_array = array();
    $moon_shop_category_link = array();
    foreach( $moon_shop_categories as $moon_shop_category ) {
        if( $moon_shop_category->parent != 0 ) {
            $moon_shop_category_link[ ] = get_term_link( $moon_shop_category->term_id );
            $moon_shop_cat_array[ ] = $moon_shop_category->name;
        }
    }

    if( empty( $moon_shop_cat_array ) ) {
        foreach( $moon_shop_categories as $moon_shop_category ) {
            if( $moon_shop_category->parent == 0 ) {
                $moon_shop_category_link[ ] = get_term_link( $moon_shop_category->term_id );
                $moon_shop_cat_array[ ] = $moon_shop_category->name;
            }
        }
    }

    echo '<p>';
    for( $i = 0 ; $i < count( $moon_shop_cat_array ) ; $i++ ) {
        if( $i != ( count( $moon_shop_cat_array ) - 1 ) ) {
            echo '<a class="pro-cat" href="' . $moon_shop_category_link[ $i ] . '">' . $moon_shop_cat_array[ $i ] . '</a>, ';
        } else {
            echo '<a class="pro-cat" href="' . $moon_shop_category_link[ $i ] . '">' . $moon_shop_cat_array[ $i ] . '</a>';
        }
    }
    echo '</p>';
}

//releted product rating
remove_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_rating' , 5 );
add_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_rating' , 11 );

//releted product price
remove_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_price' , 10 );
add_action( 'woocommerce_after_shop_loop_item_title' , 'woocommerce_template_loop_price' , 12 );

//releted product add to cart
remove_action( 'woocommerce_after_shop_loop_item' , 'woocommerce_template_loop_add_to_cart' , 10 );

add_filter( 'loop_shop_per_page' , 'moon_shop_products_number' , 20 );
function moon_shop_products_number() {
    $moon_shop_optionsValue = get_option( 'moon_shop' );
    
    //shop page posts per page
    if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] != '' ) {
        $moon_shop_products = $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ];
    } else {
        $moon_shop_products = '9';
    }

    return $moon_shop_products;
}

//wishlist message
apply_filters( 'yith_wcwl_product_added_to_wishlist_message' , '' );

//min and max price of products
function woo_min_max_price() {
    global $wpdb , $wp_the_query;

    $args = $wp_the_query->query_vars;
    $tax_query = isset( $args[ 'tax_query' ] ) ? $args[ 'tax_query' ] : array();
    $meta_query = isset( $args[ 'meta_query' ] ) ? $args[ 'meta_query' ] : array();

    if( !empty( $args[ 'taxonomy' ] ) && !empty( $args[ 'term' ] ) ) {
        $tax_query[ ] = array( 'taxonomy' => $args[ 'taxonomy' ] , 'terms' => array( $args[ 'term' ] ) , 'field' => 'slug' , );
    }

    foreach( $meta_query as $key => $query ) {
        if( !empty( $query[ 'price_filter' ] ) || !empty( $query[ 'rating_filter' ] ) ) {
            unset( $meta_query[ $key ] );
        }
    }

    $meta_query = new WP_Meta_Query( $meta_query );
    $tax_query = new WP_Tax_Query( $tax_query );

    $meta_query_sql = $meta_query->get_sql( 'post' , $wpdb->posts , 'ID' );
    $tax_query_sql = $tax_query->get_sql( $wpdb->posts , 'ID' );

    $sql = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
    $sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql[ 'join' ] . $meta_query_sql[ 'join' ];
    $sql .= "   WHERE {$wpdb->posts}.post_type IN ('" . implode( "','" , array_map( 'esc_sql' , apply_filters( 'woocommerce_price_filter_post_type' , array( 'product' ) ) ) ) . "')
                AND {$wpdb->posts}.post_status = 'publish'
                AND price_meta.meta_key IN ('" . implode( "','" , array_map( 'esc_sql' , apply_filters( 'woocommerce_price_filter_meta_keys' , array( '_price' ) ) ) ) . "')
                AND price_meta.meta_value > '' ";
    $sql .= $tax_query_sql[ 'where' ] . $meta_query_sql[ 'where' ];

    return $wpdb->get_row( $sql );
}

//catalog mode
if (isset( $moon_shop_optionsValue['moon-shop-catalog-mode'] ) && $moon_shop_optionsValue['moon-shop-catalog-mode'] == '1') {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}

/**
 * @snippet Add next/prev buttons @ WooCommerce Single Product Page
 */
add_action( 'woocommerce_single_product_summary', 'bbloomer_prev_next_product' );
add_action( 'woocommerce_single_product_summary', 'bbloomer_prev_next_product' );
function bbloomer_prev_next_product(){
    echo '<div class="prev-next-buttons">';
    // 'product_cat' will make sure to return next/prev from current category
    echo next_post_link('%link', '<i class="fa fa-angle-left"></i>', TRUE, ' ', 'product_cat');
    echo previous_post_link('%link', '<i class="fa fa-angle-right"></i>', TRUE, ' ', 'product_cat');
    echo '</div>';  
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

add_action( 'woocommerce_before_shop_loop', 'wc_toggle_product', 15 );
function wc_toggle_product() { 
    $moon_shop_optionsValue = get_option( 'moon_shop' );
    ?>
    <ul class="view-mode float-left">
        <?php if( isset( $moon_shop_optionsValue[ 'moon-shop-shop-list-grid-toggle-enable-disable' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-list-grid-toggle-enable-disable' ] == '1' ) { ?>
            <li class="active"><a href="#grid-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i></a></li>
            <li class=""><a href="#list-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-bars"></i></a></li>
        <?php } ?>
    </ul>
<?php }

function moon_shop_product_video($id) {
    $video_link  = get_post_meta( $id, 'moon-shop-product-video', false );

    if( isset($video_link[0]) && strlen($video_link[0])!= 0) {
        wp_enqueue_style( 'venobox' , MOON_SHOP_THEME_ASSETS_CSS . '/venobox.css' , '' , null , 'all' );
        wp_enqueue_script( 'venobox' , MOON_SHOP_THEME_ASSETS_JS . '/venobox.min.js' , array( 'jquery' ) , null , false );

        echo '<div class="moon-product-video text-center"><a class="venobox" data-vbtype="video" data-autoplay="true" href="'.$video_link[0].'"><i class="fa fa-play"></i><span>'.__('Watch Video', 'moon-shop').'</span></a></div>';
    }
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
$woo_breadcrumb = isset($moon_shop_optionsValue['moon-shop-shop-product-breadcrumb-enable-disable']) ? $moon_shop_optionsValue['moon-shop-shop-product-breadcrumb-enable-disable'] : '';
if ($woo_breadcrumb == '1') {
    add_action('woocommerce_archive_description', 'woocommerce_breadcrumb', 5);
}

add_filter( 'woocommerce_cross_sells_columns', 'moon_shop_cross_sells_columns' );
function moon_shop_cross_sells_columns($columns = 4) {
    return 4;
}

if ( ! function_exists( 'moon_shop_sticky_add_to_cart' ) ) {
    function moon_shop_sticky_add_to_cart() {
        global $product;

        $moon_shop_optionsValue = get_option( 'moon_shop' );
        $sticky_desktop = isset($moon_shop_optionsValue['moon-shop-sticky-cart-desktop']) ? $moon_shop_optionsValue['moon-shop-sticky-cart-desktop'] : '1';
        $sticky_mobile = isset($moon_shop_optionsValue['moon-shop-sticky-cart-mobile']) ? $moon_shop_optionsValue['moon-shop-sticky-cart-mobile'] : '1';

        if ( $sticky_desktop != '1' && $sticky_mobile != '1' ) return;
        ?>
            <div class="moon-sticky-btn <?php echo ( $sticky_mobile == '1' ) ? 'mobile-on' : 'mobile-off' ?>">
                <div class="moon-sticky-btn-container container">
                    <div class="moon-sticky-btn-content">
                        <div class="moon-sticky-btn-thumbnail">
                            <?php echo woocommerce_get_product_thumbnail(); ?>  
                        </div>
                        <div class="moon-sticky-btn-info">
                            <h4 class="product-title"><?php the_title(); ?></h4>
                        </div>
                    </div>
                    <div class="moon-sticky-btn-cart">
                        <span class="price"><?php echo $product->get_price_html(); ?></span>
                        <?php if ( $product->is_type( 'simple' ) ): ?>
                            <?php woocommerce_simple_add_to_cart(); ?>
                        <?php else: ?>
                            <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="moon-sticky-add-to-cart button alt button-cart">
                                <?php echo $product->is_type( 'variable' ) ? esc_html__( 'Select options', 'moon-shop' ) : $product->single_add_to_cart_text(); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
    }
}

if( ! function_exists( 'moon_product_sale_countdown' ) ) {
    function moon_product_sale_countdown() {
        global $post;
        $sale_date_end = get_post_meta( $post->ID, '_sale_price_dates_to', true );
        $sale_date_start = get_post_meta( $post->ID, '_sale_price_dates_from', true );
        $curent_date = strtotime( date( 'Y-m-d H:i:s' ) );

        if( $sale_date_end < $curent_date || $curent_date < $sale_date_start ) return;

        $timezone = 'GMT';

        if ( apply_filters( 'moon_wp_timezone_shop', false ) ) $timezone = wc_timezone_string();

        echo '<div class="moon-product-countdown moon-timer" data-end-date="' . esc_attr( date( 'Y-m-d H:i:s', $sale_date_end ) ) . '" data-timezone="' . $timezone . '"></div>';
    }
}

add_filter( 'woocommerce_show_page_title', 'moon_shop_product_page_title' );
function moon_shop_product_page_title() {
    $moon_shop_optionsValue = get_option( 'moon_shop' );
    $page_title = isset($moon_shop_optionsValue['moon-shop-product-page-title']) ? $moon_shop_optionsValue['moon-shop-product-page-title'] : true;
    if ($page_title == true) {
        return true;
    } else {
        return false;
    }
}