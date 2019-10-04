<?php

//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//enqueue inline style css
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$moon_shop_custom_inline_style = '';


//blog index banner title text

$moon_shop_blog_index_title_text = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-title-text' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-title-text' ] ) : '';


//blog index title alignment

$moon_shop_blog_index_title_align = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-title-alignment' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-title-alignment' ] ) : '';


//blog index banner select

$moon_shop_blog_index_banner_select = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-select' ] ) : '';


//blog index banner overlay

$moon_shop_blog_index_banner_overlay = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-overlay-color' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-overlay-color' ] ) : '';


//blog index banner opacity

$moon_shop_blog_index_banner_opacity = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-opacity' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-opacity' ] ) : '';


//blog index banner height select

$moon_shop_blog_index_banner_height_select = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-height-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-height-select' ] ) : '';


//blog index banner height set

$moon_shop_blog_index_banner_height_set = isset( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-height' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-blog-index-background-height' ] ) : '';


//title align

if( $moon_shop_blog_index_title_align != '' ) {

    $moon_shop_custom_inline_style .= '.blog-banner { text-align: ' . $moon_shop_blog_index_title_align . ';}';

} else {

    $moon_shop_custom_inline_style .= '.blog-banner { text-align: center;}';

}


//blog index banner overlay

if( $moon_shop_blog_index_banner_overlay != '' && $moon_shop_blog_index_banner_select == 'background-image' ) {

    list( $r , $g , $b ) = sscanf( $moon_shop_blog_index_banner_overlay , "#%02x%02x%02x" );

    $moon_shop_custom_inline_style .= '.overlay {

                background-color: rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $moon_shop_blog_index_banner_opacity . ' );

             }';

}

//banner custom height set

if( $moon_shop_blog_index_banner_height_select != 'full-height' && $moon_shop_blog_index_banner_height_set != '' ) {

    $moon_shop_custom_inline_style .= '.blog-banner { height: ' . $moon_shop_blog_index_banner_height_set . 'px;}';

}

//banner full height set

$moon_shop_full_banner = '';

if( $moon_shop_blog_index_banner_height_select == 'full-height' ) {

    $moon_shop_full_banner = 'full-banner';

}

if( $moon_shop_blog_index_banner_select == 'background-none' ) {
	$moon_shop_custom_inline_style .= '.blog-banner { background: inherit; }';
}

wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );

?>

<!-- Blog Page Banner -->

<div class="blog-banner relative <?php echo esc_attr( $moon_shop_full_banner ); ?>">

    <div class="display-table absolute overlay">

        <div class="vertical-middle">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12">

                        <h1>
                            <?php
                            if( $moon_shop_blog_index_title_text == '' ) {
                                wp_title( $sep = '' , $display = true , $seplocation = '' );
                            } else {
                                echo esc_attr( $moon_shop_blog_index_title_text );
                            }
                            ?>
                        </h1>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>