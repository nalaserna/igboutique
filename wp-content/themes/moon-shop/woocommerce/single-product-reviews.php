<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
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

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

global $product;

if ( ! comments_open() ) {
    return;
}

?>

<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
        <?php if( have_comments() ) : ?>

            <ol class="commentlist pro-review-container">
                <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args' , array( 'callback' => 'woocommerce_comments' ) ) ); ?>
            </ol>

            <?php if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args' , array(
                    'prev_text' => '&larr;' ,
                    'next_text' => '&rarr;' ,
                    'type' => 'list' ,
                ) ) );
                echo '</nav>';
            endif; ?>

        <?php else : ?>
            <p class="woocommerce-noreviews"><?php _e( 'There are no reviews yet.' , 'moon-shop' ); ?></p>
        <?php endif; ?>
    </div>

    <?php if( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '' , get_current_user_id() , get_the_ID() ) ) : ?>

        <div id="review_form_wrapper" class="pro-rev-form fix">
            <?php
            $commenter = wp_get_current_commenter();

            $comment_form = array(
                'title_reply_before' => '<h2>' ,
                'title_reply_after' => '</h2>' ,
                'title_reply' => __( 'Add your review' , 'moon-shop' ) ,
                'title_reply_to' => '' ,
                'comment_notes_after' => '' ,
                'fields' => array(
                    'author' => '<div class="input-box input-box-2"><input id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Name', 'moon-shop').'" required /></div>' ,
                    'email' => '<div class="input-box input-box-2"><input id="email" name="email" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Email', 'moon-shop').'" required /></div>' ,
                ) ,
                'label_submit' => __( 'Submit' , 'moon-shop' ) ,
                'logged_in_as' => '' ,
                'comment_field' => '' ,
                'class_form' => 'moon-form' ,
                'comment_notes_before' => '' ,
                'id_submit' => ''
            );

            $account_page_url = wc_get_page_permalink( 'myaccount' );
            if ( $account_page_url ) {
                /* translators: %s opening and closing link tags respectively */
                $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'moon-shop' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
            }

            if ( wc_review_ratings_enabled() ) {
                $comment_form[ 'comment_field' ] = '<div class="comment-form-rating form-ratting"><select name="rating" id="rating" aria-required="true" required>
						<option value="">' . __( 'Rate&hellip;' , 'moon-shop' ) . '</option>
						<option value="5">' . __( 'Perfect' , 'moon-shop' ) . '</option>
						<option value="4">' . __( 'Good' , 'moon-shop' ) . '</option>
						<option value="3">' . __( 'Average' , 'moon-shop' ) . '</option>
						<option value="2">' . __( 'Not that bad' , 'moon-shop' ) . '</option>
						<option value="1">' . __( 'Very Poor' , 'moon-shop' ) . '</option>
					</select></div>';
            }

            $comment_form[ 'comment_field' ] .= '<div class="input-box"><textarea name="comment" cols="45" rows="5" aria-required="true" placeholder="'.esc_attr__('Message', 'moon-shop').'" required></textarea></div>';

            moon_shop_comment_form( apply_filters( 'woocommerce_product_review_comment_form_args' , $comment_form ) );
            ?>
        </div>

    <?php else : ?>
        <p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.' , 'moon-shop' ); ?></p>
    <?php endif; ?>

    <div class="clear"></div>
</div>