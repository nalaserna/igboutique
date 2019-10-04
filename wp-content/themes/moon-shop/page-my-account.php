<?php
get_header();
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//banner enable/disable options
$moon_shop_page_bannerED_meta = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-banner-on-off' , true ) );
?>

<!-- Page Banner -->
<?php
if( $moon_shop_page_bannerED_meta != 'off' ) {
    get_template_part( 'base/views/page-banner' );
}

while ( have_posts() ) : the_post(); ?>
    <!-- page Container -->
    <div class="pages moon-shop-page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 moon-shop-without-sidebar">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; // end of the loop. ?>  

<?php get_footer();