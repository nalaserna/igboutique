<?php
get_header();
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//Select Slider
$moon_shop_page_sliderSelect_meta = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-silder-select' , true ) );

//banner enable/disable options
$moon_shop_page_bannerED_meta = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-banner-on-off' , true ) );

//page layout option
$moon_shop_page_layout = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-layout' , true ) );

//page sidebar select
$moon_shop_page_sidebar = '';
if( $moon_shop_page_layout != 'no_sidebar' ) {
    $moon_shop_page_sidebar = isset( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-sidebar-position' ] ) : '';
}
$moon_shop_col = 'col-md-12 moon-shop-without-sidebar';
if( $moon_shop_page_layout == 'no_sidebar' ) {
} else if( $moon_shop_page_layout == 'default' ) {
    if( $moon_shop_page_sidebar != '' && $moon_shop_page_sidebar != 'no_sidebar' ) {
        $moon_shop_col = 'col-md-8 col-sm-12 moon-shop-with-sidebar';
    } else {
        $moon_shop_col = 'col-md-12 moon-shop-without-sidebar';
    }
} else {
    if( $moon_shop_page_layout == 'left_sidebar' ) {
        $moon_shop_col = 'col-md-8 col-sm-12 moon-shop-with-sidebar';
        $moon_shop_page_sidebar = 'left_sidebar';
    } else if( $moon_shop_page_layout == 'right_sidebar' ) {
        $moon_shop_col = 'col-md-8 col-sm-12 moon-shop-with-sidebar';
        $moon_shop_page_sidebar = 'right_sidebar';
    }
}
?>

    <!-- Page Slider -->
<?php
if( $moon_shop_page_sliderSelect_meta == 'revulotion-slider' ) {
    get_template_part( 'base/views/revolution-slider' );
} else if( $moon_shop_page_sliderSelect_meta == 'nivo-slider' ) {
    get_template_part( 'base/views/nivo-slider' );
} else if( $moon_shop_page_sliderSelect_meta == 'flexslider' ) {
    get_template_part( 'base/views/flexslider' );
}
?>

    <!-- Page Banner -->
<?php
if( $moon_shop_page_bannerED_meta != 'off' ) {
    get_template_part( 'base/views/page-banner' );
}
?>
<?php
$moon_shop_page_comments = isset( $moon_shop_optionsValue[ 'moon-shop-page-comments-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-comments-enable-disable' ] ) : '';
?>

    <!-- page Container -->
    <div class="pages moon-shop-page-content">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar -->
                <?php if( $moon_shop_page_sidebar == 'left_sidebar' ) {
                    get_sidebar();
                } ?>

                <div class="<?php echo esc_attr( $moon_shop_col ); ?>">
                    <?php
                    while( have_posts() ) : the_post();
                        the_content();

                        if( $moon_shop_page_comments != '0' ) {
                            if( comments_open( $post->ID ) || get_comments_number() ) :
                                comments_template();
                            endif;
                        }
                    endwhile;
                    ?>
                </div>

                <!-- Right Sidebar -->
                <?php if( $moon_shop_page_sidebar == 'right_sidebar' ) {
                    get_sidebar();
                } ?>
            </div>
        </div>
    </div>

<?php get_footer();