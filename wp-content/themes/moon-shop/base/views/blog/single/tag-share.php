<?php
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_single_tag = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-tag-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-tag-enable-disable' ] ) : '';
$moon_shop_single_share = isset( $moon_shop_optionsValue[ 'moon-shop-blog-single-share-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-share-enable-disable' ] ) : '';
if( $moon_shop_single_tag != '0' || $moon_shop_single_share != '0' ) {
    ?>
    <div class="post-tag-share fix">
        <?php if( has_tag() && $moon_shop_single_tag != '0' ) { ?>
            <div class="post-tags float-left">
                <?php
                the_tags( '<strong>Tags: </strong>' , '<small class="moon-tag-comma">,</small> ' , '' );
                ?>
            </div>
        <?php } ?>

        <?php if( $moon_shop_single_share != '0' ) { ?>
            <div class="post-share float-right">
                <strong><?php esc_html_e( 'Share This :' , 'moon-shop' ); ?></strong>
                <?php if( esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-facebook' ] != '0' ) ) { ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i
                            class="fa fa-facebook"></i></a>
                <?php }
                if( isset ( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-twitter' ] ) && esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-twitter' ] ) != '0' ) { ?>
                    <a href="http://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>"
                       target="_blank"><i class="fa fa-twitter"></i></a>
                <?php }
                if( esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-google-plus' ] ) != '0' ) { ?>
                    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i
                            class="fa fa-google-plus"></i></a>
                <?php }
                if( esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-pinterest' ] ) != '0' ) { ?>
                    <a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&description=<?php the_title(); ?>"
                       target="_blank"><i class="fa fa-pinterest"></i></a>
                <?php }
                if( esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-tumblr' ] ) != '0' ) { ?>
                    <a href="http://www.tumblr.com/share?v=3&u=<?php the_permalink(); ?>" target="_blank"><i
                            class="fa fa-tumblr"></i></a>
                <?php }
                if( esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-single-social-share-delicious' ] ) != '0' ) { ?>
                    <a href="https://delicious.com/save?v=5&jump=close&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"
                       target="_blank"><i class="fa fa-delicious"></i></a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
<?php } ?>