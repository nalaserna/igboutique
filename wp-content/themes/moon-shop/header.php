<?php
/**
 * The template for displaying the header
 * @package WordPress
 * @subpackage Moon Shop
 * @since Moon Shop 1.0.0
 */

//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_rtl = isset( $moon_shop_optionsValue[ 'moon-shop-rtl-on-off' ] ) ? $moon_shop_optionsValue[ 'moon-shop-rtl-on-off' ] : '0';
$moon_shop_rtl_cls = '';
if( $moon_shop_rtl == '1' ) {
	$moon_shop_rtl_cls = 'rtl';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php if( $moon_shop_rtl == '1' ) { ?> dir="rtl" <?php } ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
	
    <?php wp_head(); ?>
</head>

<body <?php body_class( $moon_shop_rtl_cls ); ?>>
<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_preloader_desktop = isset($moon_shop_optionsValue['moon-shop-preloader-enable-desktop']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-desktop'] : '1';
$moon_shop_preloader_tab = isset($moon_shop_optionsValue['moon-shop-preloader-enable-tab']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-tab'] : '1';
$moon_shop_preloader_mobile = isset($moon_shop_optionsValue['moon-shop-preloader-enable-mobile']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-mobile'] : '1';

if (($moon_shop_preloader_desktop == '1') || ($moon_shop_preloader_tab == '1') || ($moon_shop_preloader_mobile == '1')) { ?>
<div id="element" class="introLoading"></div>
<?php } ?>
<div class="moon-page-wrapper">
    <header id="masthead" class="site-header" role="banner">
        <?php get_template_part( 'base/views/header/site', 'branding' );

        //Header Top
        $moon_shop_top_barED = isset( $moon_shop_optionsValue[ 'moon-shop-top-bar-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-top-bar-enable-disable' ] ) : '';
        
        if( $moon_shop_top_barED != '0' ) {
            get_template_part( 'base/views/header/header-top' );
        }

        //Header Bottom
        get_template_part( 'base/views/header/header-bottom' ); ?>
    </header>