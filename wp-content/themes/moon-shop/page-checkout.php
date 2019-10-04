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
        $moon_shop_destract_free = isset( $moon_shop_optionsValue[ 'moon-shop-destract-free' ] ) ? $moon_shop_optionsValue[ 'moon-shop-destract-free' ] : '';

        if ($moon_shop_destract_free == '1') {
            $moon_shop_main_logo_MO = esc_url( get_post_meta( $post->ID , 'moon-shop-page-logo' , true ) );
            $moon_shop_mobile_logo = isset( $moon_shop_optionsValue[ 'moon-shop-mobile-logo' ][ 'url' ] ) ? $moon_shop_optionsValue[ 'moon-shop-mobile-logo' ][ 'url' ] : '';
            $moon_shop_mobile = '';
            if( $moon_shop_mobile_logo != '' ) {
                $moon_shop_mobile = 'moon-shop-desktop-logo';
            }
            $moon_shop_main_logo_TO = isset( $moon_shop_optionsValue[ 'moon-shop-main-logo' ][ 'url' ] ) ? esc_url( $moon_shop_optionsValue[ 'moon-shop-main-logo' ][ 'url' ] ) : '';
            $moon_shop_sticky_logo = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-logo' ][ 'url' ] ) ? $moon_shop_optionsValue[ 'moon-shop-sticky-logo' ][ 'url' ] : '';
            $moon_shop_mobile_logo = isset( $moon_shop_optionsValue[ 'moon-shop-mobile-logo' ][ 'url' ] ) ? $moon_shop_optionsValue[ 'moon-shop-mobile-logo' ][ 'url' ] : '';
            $moon_shop_mobile = '';
            if( $moon_shop_mobile_logo != '' ) {
                $moon_shop_mobile = 'moon-shop-desktop-logo';
            }
            $moon_shop_sticky_header_mobile = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-header-mobile-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-sticky-header-mobile-enable-disable' ] ) : '';
            $moon_shop_transparent = '';
            $moon_shop_trans = get_post_meta(get_the_ID(), 'moon-shop-header-transparent', true);
            if (isset($moon_shop_trans) && $moon_shop_trans == 'on') {
                $moon_shop_transparent = 'header-transparent';
            }
            ?>
            <div class="header-bottom moon-find-cart <?php echo ($moon_shop_sticky_header_mobile == '0') ? 'sticky-mobile' : ''; echo esc_attr($moon_shop_transparent); ?>" id="sticker">
                <div class="container header-padding-tb moon-relative">
                    <div class="row text-center destract-free-header">
                        <!-- Header Logo -->
                        <div class="logo moon-position-none">
                            <?php if( $moon_shop_main_logo_MO != '' ) { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img class="moon-shop-main-logo <?php echo esc_attr( $moon_shop_mobile ); ?>" src="<?php echo esc_url( $moon_shop_main_logo_MO ); ?>" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/>
                                </a>
                            <?php
                            } else if( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                                echo '<span class="'.esc_attr( $moon_shop_mobile ).'">';
                                the_custom_logo();
                                echo '</span>';
                            } else if( $moon_shop_main_logo_TO != '' ) {
                                ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img class="moon-shop-main-logo <?php echo esc_attr( $moon_shop_mobile ); ?>" src="<?php echo esc_url( $moon_shop_main_logo_TO ); ?>" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img class="moon-shop-main-logo <?php echo esc_attr( $moon_shop_mobile ); ?>" src="<?php echo MOON_SHOP_THEME_ASSETS_IMAGE ?>/logo.png" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/>
                                </a>
                            <?php }
                            if( $moon_shop_sticky_logo != '' ) { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="moon-shop-sticky-logo <?php echo esc_attr( $moon_shop_mobile ); ?>" src="<?php echo esc_url( $moon_shop_sticky_logo ); ?>" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/></a>
                            <?php }
                            if( $moon_shop_mobile_logo != '' ) { ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="moon-shop-mobile-logo" src="<?php echo esc_url( $moon_shop_mobile_logo ); ?>" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
        
            if( $moon_shop_top_barED != '0' ) {
                get_template_part( 'base/views/header/header-top' );
            }

            //Header Bottom
            get_template_part( 'base/views/header/header-bottom' );
        } ?>
    </header>
<?php
//banner enable/disable options
$moon_shop_page_bannerED_meta = esc_attr( get_post_meta( $post->ID , 'moon-shop-page-banner-on-off' , true ) );
?>

<!-- Page Banner -->
<?php
$moon_shop_destract_free = isset( $moon_shop_optionsValue[ 'moon-shop-destract-free' ] ) ? $moon_shop_optionsValue[ 'moon-shop-destract-free' ] : '';
if( $moon_shop_page_bannerED_meta != 'off' && $moon_shop_destract_free != '1' ) {
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

            <!-- Footer Area -->
            <div class="footer-area">
                <?php 
                if ($moon_shop_destract_free == '1') { ?>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <!-- Footer Copyright -->
                            <div class="copyright text-center">
                                <p>
                                    <?php if( !class_exists( 'Redux' ) ) {
                                        esc_html_e( 'Copyright © 2018. Onaz' , 'moon-shop' );
                                    } ?>
                                    <?php echo wp_kses( sprintf( __( '%s' , 'moon-shop' ) , $moon_shop_optionsValue[ 'moon-shop-footer-copyright-text' ] ) , array( 'a' => array( 'href' => array() ) , 'br' => array() ) ); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else {
                    get_template_part( 'base/views/footer/footer-top' );

                    get_template_part( 'base/views/footer/footer-bottom' ); 
                }
                ?>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>