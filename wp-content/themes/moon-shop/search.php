<?php get_header();
$moon_shop_search_type = !empty( $_GET[ 'post_type' ] ) ? esc_attr( $_GET[ 'post_type' ] ) : '';
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
//blog title enable/disable
$moon_shop_blog_title_enable = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-title-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-title-enable-disable' ] ) : '';

?>
    <section class="wl-search-item-head woocommerce">
        <!-- Search Banner -->
        <?php if( $moon_shop_blog_title_enable != '0' ) {
            get_template_part( 'base/views/search-banner' );
        } ?>
        <div class="search-content">
            <div class="container">
                <div class="row">
                    <!-- Main content start -->
                    <div class="<?php echo ( $moon_shop_search_type != 'products' ) ? 'col-sm-8' : 'col-sm-12'; ?>">
                        <?php if( have_posts() ) { ?>
                            <?php
                            if( $moon_shop_search_type != 'products' ) {
                                while( have_posts() ) : the_post();
                                    get_template_part( 'base/views/default-search-content' );
                                endwhile;
                            } else {
                                //breadcrumb show/hide
                                if( is_shop() && isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-breadcrumb-enable-disable' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-breadcrumb-enable-disable' ] != '1' ) {
                                    remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb' , 20 );
                                } else if( ( is_product_category() || is_product_tag() ) ) {
                                    remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb' , 20 );
                                }
                                wc_get_template( 'archive-product.php' );
                            }

                            if( $moon_shop_search_type == '' ) {
                                the_posts_pagination( 
                                    array( 
                                        'prev_text' => esc_html__( 'Previous' , 'moon-shop' ) , 
                                        'next_text' => esc_html__( 'Next' , 'moon-shop' ) , 
                                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . '' . ' </span>' , ) 
                                    );
                            }
                            ?>

                        <?php } else { ?>
                            <div class="wl-no-result text-center wl-full-width">
                                <p>
                                    <?php printf( esc_html__( 'No Search Result Found for: %s' , 'moon-shop' ) , '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
                                </p>

                                <form role="search" method="get" class="search-form"
                                      action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <div class="input-box no-result-input">
                                        <input type="hidden" name="post_type" value="products"/>
                                        <input type="text" value="" name="s" id="s" class="s"
                                               placeholder="<?php esc_html_e( 'Search products...' , 'moon-shop' ); ?>"/>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Main content end -->
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer();