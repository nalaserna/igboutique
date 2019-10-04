<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//enqueue inline style css
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$moon_shop_custom_inline_style = '';

//Page banner title alignment theme option
$moon_shop_page_title_align = isset( $moon_shop_optionsValue[ 'moon-shop-album-title-alignment' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-album-title-alignment' ] ) : 'center';

//Page banner select theme option
$moon_shop_page_banner_select = isset( $moon_shop_optionsValue[ 'moon-shop-album-title-background-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-album-title-background-select' ] ) : '';

//Page banner overlay theme option
$moon_shop_page_banner_overlay = isset( $moon_shop_optionsValue[ 'moon-shop-album-title-background-overlay-color' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-album-title-background-overlay-color' ] ) : '';

//Page banner opacity theme option
$moon_shop_page_banner_opacity = isset( $moon_shop_optionsValue[ 'moon-shop-album-title-background-opacity' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-album-title-background-opacity' ] ) : '';


//Page banner height select theme option
$moon_shop_page_banner_height_select = isset( $moon_shop_optionsValue[ 'moon-shop-album-title-background-height-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-album-title-background-height-select' ] ) : '';

//Page banner height set theme option
$moon_shop_page_banner_height_set = isset( $moon_shop_optionsValue[ 'moon-shop-album-title-background-height' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-album-title-background-height' ] ) : '';
//Page title alignment theme option

$moon_shop_custom_inline_style .= '.page-banner { text-align: ' . $moon_shop_page_title_align . ';}';

//Page banner overlay theme option
if( $moon_shop_page_banner_overlay != '' && $moon_shop_page_banner_select == 'background-image' ) {
    $moon_shop_custom_inline_style .= '.page-banner { background: url("'.get_the_post_thumbnail_url(get_the_id(), 'moon_shop_image_1170x878' ).'"); background-repeat: no-repeat; background-size: cover; background-position: center; }';
    list( $r , $g , $b ) = sscanf( $moon_shop_page_banner_overlay , "#%02x%02x%02x" );
    $moon_shop_custom_inline_style .= '.overlay { background-color: rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $moon_shop_page_banner_opacity . ' ); }';
}

$moon_shop_full_banner = '';

//banner custom height set theme option
if( $moon_shop_page_banner_height_select == 'custom-height' && $moon_shop_page_banner_height_set != '' ) {
    $moon_shop_custom_inline_style .= '.page-banner { height: ' . $moon_shop_page_banner_height_set . 'px;}';
}
//banner full height set theme option
if( $moon_shop_page_banner_height_select == 'full-height' ) {
    $moon_shop_full_banner = 'full-banner';
}
 
if( $moon_shop_page_banner_select == 'background-none' ) {
	$moon_shop_custom_inline_style .= '.page-banner { background: inherit; } .page-banner h1 {color: #222;}';
}

wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );
?>

<!-- Page Banner -->
<div class="page-banner album-banner relative">
    <div class="display-table absolute overlay">
        <div class="vertical-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1><?php wp_title( '' , true , '' ); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>