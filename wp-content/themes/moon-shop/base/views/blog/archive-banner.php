<?php

//Redux global variable

$moon_shop_optionsValue = get_option( 'moon_shop' );


//enqueue inline style css

wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );

$moon_shop_custom_inline_style = '';


//blog archive banner title text

$moon_shop_blog_archive_title_text = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-title-text' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-title-text' ] ) : '';


//blog archive title alignment

$moon_shop_blog_archive_title_align = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-title-alignment' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-title-alignment' ] ) : '';


//blog archive banner select

$moon_shop_blog_archive_banner_select = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-select' ] ) : '';


//blog archive banner overlay
$moon_shop_blog_archive_banner_overlay = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-overlay-color' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-overlay-color' ] ) : '';

//blog archive banner opacity
$moon_shop_blog_archive_banner_opacity = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-opacity' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-opacity' ] ) : '';

//blog archive banner height select
$moon_shop_blog_archive_banner_height_select = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-height-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-height-select' ] ) : '';

//blog archive banner height set
$moon_shop_blog_archive_banner_height_set = isset( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-height' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-archive-background-height' ] ) : '';

//title align
if( $moon_shop_blog_archive_title_align != '' ) {
    $moon_shop_custom_inline_style .= '.archive-banner { text-align: ' . $moon_shop_blog_archive_title_align . ';}';
} else {
    $moon_shop_custom_inline_style .= '.archive-banner { text-align: center;}';
}


//blog archive banner overlay
if( $moon_shop_blog_archive_banner_overlay != '' && $moon_shop_blog_archive_banner_select == 'background-image' ) {

    list( $r , $g , $b ) = sscanf( $moon_shop_blog_archive_banner_overlay , "#%02x%02x%02x" );

    $moon_shop_custom_inline_style .= '.overlay {

                background-color: rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $moon_shop_blog_archive_banner_opacity . ' );

             }';

}

//banner custom height set
if( $moon_shop_blog_archive_banner_height_select != 'full-height' && $moon_shop_blog_archive_banner_height_set != '' ) {

    $moon_shop_custom_inline_style .= '.archive-banner { height: ' . $moon_shop_blog_archive_banner_height_set . 'px;}';

}

//banner full height set
$moon_shop_full_banner = '';
if( $moon_shop_blog_archive_banner_height_select == 'full-height' ) {
    $moon_shop_full_banner = 'full-banner';
}

if( $moon_shop_blog_archive_banner_select == 'background-none' ) {
	$moon_shop_custom_inline_style .= '.archive-banner { background: inherit; }';
}

wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );

?>

<!-- Blog Page Banner -->

<div class="archive-banner relative <?php echo esc_attr( $moon_shop_full_banner ); ?>">

    <div class="display-table absolute overlay">

        <div class="vertical-middle">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12">

                        <h1>

                            <?php

                            if( $moon_shop_blog_archive_title_text == '' ) {

                                the_archive_title();

                            } else {

                                echo esc_attr( $moon_shop_blog_archive_title_text );

                            }

                            ?>

                        </h1>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>