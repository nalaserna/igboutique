<?php get_header(); ?>

    <!-- Page Banner -->
<?php
//banner enable/disable options
$moon_shop_page_bannerED_meta = get_post_meta( wc_get_page_id( 'shop' ) , 'moon-shop-page-banner-on-off' , true );
if( $moon_shop_page_bannerED_meta != 'off' && !is_product() ) {
    get_template_part( 'base/views/page-banner' );
}
?>

    <!-- page Container -->
    <div class="woocommerce-wrapper pages">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sin-blog-post">
                        <div class="blog-details">
                            <?php woocommerce_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>