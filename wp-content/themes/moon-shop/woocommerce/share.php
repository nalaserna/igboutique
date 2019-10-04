<?php
/**
 * Share template
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.13
 */

if( !defined( 'YITH_WCWL' ) ) {
    exit;
} // Exit if accessed directly
?>

<div class="yith-wcwl-share text-center">
    <div class="cart-page-title text-center">
        <h5 class="yith-wcwl-share-title"><?php echo esc_attr( $share_title ); ?></h5>
    </div>
    <ul>
        <?php if( $share_facebook_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="facebook"
                   href="https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D=<?php echo esc_attr( $share_link_title ); ?>&amp;p%5Burl%5D=<?php echo urlencode( $share_link_url ) ?>"
                   title="<?php _e( 'Facebook' , 'moon-shop' ) ?>"><i class="fa fa-facebook"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_twitter_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="twitter"
                   href="https://twitter.com/share?url=<?php echo esc_url( $share_link_url ) ?>&amp;text=<?php echo esc_attr( $share_twitter_summary ); ?>"
                   title="<?php _e( 'Twitter' , 'moon-shop' ) ?>"><i class="fa fa-twitter"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_pinterest_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="pinterest"
                   href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url( $share_link_url ); ?>&amp;description=<?php echo esc_attr( $share_summary ); ?>&amp;media=<?php echo esc_url( $share_image_url ) ?>"
                   title="<?php _e( 'Pinterest' , 'moon-shop' ) ?>" onclick="window.open(this.href); return false;"><i
                        class="fa fa-pinterest"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_googleplus_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a target="_blank" class="googleplus"
                   href="https://plus.google.com/share?url=<?php echo esc_url( $share_link_url ); ?>&amp;title=<?php echo esc_attr( $share_link_title ) ?>"
                   title="<?php _e( 'Google+' , 'moon-shop' ) ?>"
                   onclick='javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'><i
                        class="fa fa-google-plus"></i></a>
            </li>
        <?php endif; ?>

        <?php if( $share_email_enabled ): ?>
            <li style="list-style-type: none; display: inline-block;">
                <a class="email"
                   href="mailto:?subject=<?php echo urlencode( apply_filters( 'yith_wcwl_email_share_subject' , __( 'I wanted you to see this site' , 'moon-shop' ) ) ) ?>&amp;body=<?php echo apply_filters( 'yith_wcwl_email_share_body' , $share_link_url ) ?>&amp;title=<?php echo esc_attr( $share_link_title ); ?>"
                   title="<?php _e( 'Email' , 'moon-shop' ) ?>"><i class="fa fa-envelope-o"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>