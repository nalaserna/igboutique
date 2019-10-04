<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
$moon_shop_search = '';
//enqueue inline style css
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$moon_shop_custom_inline_style = '';

//header style
$moon_shop_header_style = isset( $moon_shop_optionsValue[ 'moon-shop-header-style' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-style' ] ) : '';
//cart icon position
$moon_shop_cart_icon_position = isset( $moon_shop_optionsValue[ 'moon-shop-header-cart-icon-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-cart-icon-position' ] ) : 'header';
//search icon position
$moon_shop_search_icon_position = isset( $moon_shop_optionsValue[ 'moon-shop-header-search-icon-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-search-icon-position' ] ) : '';
//search placeholder text
$moon_shop_search_placeholder = isset( $moon_shop_optionsValue[ 'moon-shop-search-placeholder-text' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-search-placeholder-text' ] ) : esc_attr__('Product Search...', 'moon-shop');

//main logo in theme options
$moon_shop_main_logo_TO = isset( $moon_shop_optionsValue[ 'moon-shop-main-logo' ][ 'url' ] ) ? esc_url( $moon_shop_optionsValue[ 'moon-shop-main-logo' ][ 'url' ] ) : '';
if( !is_search() && !is_404() ) {
    //main logo in page meta
    $moon_shop_main_logo_MO = esc_url( get_post_meta( get_the_ID() , 'moon-shop-page-logo' , true ) );
} else {
    $moon_shop_main_logo_MO = '';
}
//sticky on/off logo
$moon_shop_sticky_logo_OF = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-logo-enable-disable' ] ) ? $moon_shop_optionsValue[ 'moon-shop-sticky-logo-enable-disable' ] : '';
//sticky logo
$moon_shop_sticky_logo = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-logo' ][ 'url' ] ) ? $moon_shop_optionsValue[ 'moon-shop-sticky-logo' ][ 'url' ] : '';

//mobile logo
$moon_shop_mobile_logo = isset( $moon_shop_optionsValue[ 'moon-shop-mobile-logo' ][ 'url' ] ) ? $moon_shop_optionsValue[ 'moon-shop-mobile-logo' ][ 'url' ] : '';
$moon_shop_mobile = '';
if( $moon_shop_mobile_logo != '' ) {
    $moon_shop_mobile = 'moon-shop-desktop-logo';
}

//sticky logo on/off settings
if( $moon_shop_sticky_logo != '' && $moon_shop_sticky_logo_OF == '1' ) {
    $moon_shop_custom_inline_style .= '.stick .moon-shop-main-logo { display: none; }';
    $moon_shop_custom_inline_style .= '.stick .moon-shop-sticky-logo { display: block; }';
} else if( $moon_shop_sticky_logo_OF == '1' && $moon_shop_sticky_logo == '' ) {
} else if( $moon_shop_sticky_logo_OF == '0' ) {
    $moon_shop_custom_inline_style .= '.stick .moon-shop-main-logo { display: none; }';
}

$moon_shop_sticky_menu = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-menu-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-sticky-menu-enable-disable' ] ) : '';
$moon_shop_sticky_header_mobile = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-header-mobile-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-sticky-header-mobile-enable-disable' ] ) : '';
$moon_shop_search_iconED = isset( $moon_shop_optionsValue[ 'moon-shop-search-icon-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-search-icon-enable-disable' ] ) : '';

if( $moon_shop_sticky_menu == '0' ) {
    $moon_shop_custom_inline_style .= '.stick { position: inherit; }';
}
$moon_shop_catalog = isset($moon_shop_optionsValue[ 'moon-shop-catalog-mode' ]) ? $moon_shop_optionsValue[ 'moon-shop-catalog-mode' ] : '0';
if( $moon_shop_catalog == '1' ) {
	$moon_shop_custom_inline_style .= '.moon-header-one .header-one-search.pull-right{ margin-left: 0; }';
}

$moon_shop_logo_width = isset( $moon_shop_optionsValue[ 'moon-shop-logo-width' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-logo-width' ] ) : '';
$moon_shop_logo_height = isset( $moon_shop_optionsValue[ 'moon-shop-logo-height' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-logo-height' ] ) : '';
if( $moon_shop_logo_width != '' ) {
	$moon_shop_custom_inline_style .= '.logo a img{ width: '.$moon_shop_logo_width.'px; }';
}
if( $moon_shop_logo_height != '' ) {
	$moon_shop_custom_inline_style .= '.logo a img{ height: '.$moon_shop_logo_height.'px; }';
}

$moon_shop_header_spacing_top = isset( $moon_shop_optionsValue[ 'moon-shop-header-spacing' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-spacing' ][ 'padding-bottom' ] ) : '';
$moon_shop_header_spacing_top_sticky = isset( $moon_shop_optionsValue[ 'moon-shop-sticky-header-spacing' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-sticky-header-spacing' ][ 'padding-bottom' ] ) : '';
$moon_shop_custom_inline_style .= '.mega-menu ul.sub-menu, .main-menu .sub-menu { margin-top: '.$moon_shop_header_spacing_top.'; }';
$moon_shop_custom_inline_style .= '.stick .mega-menu ul.sub-menu, .stick .main-menu .sub-menu { margin-top: '.$moon_shop_header_spacing_top_sticky.'; }';

wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );
$moon_shop_transparent = '';
$moon_shop_trans = get_post_meta(get_the_ID(), 'moon-shop-header-transparent', true);
if (isset($moon_shop_trans) && $moon_shop_trans == 'on') {
    $moon_shop_transparent = 'header-transparent';
}
?>

<!-- Header Bottom -->
<div class="header-bottom moon-find-cart <?php echo ($moon_shop_sticky_header_mobile == '0') ? 'sticky-mobile' : ''; echo esc_attr($moon_shop_transparent); ?>" id="sticker">
    <div class="container header-padding-tb moon-relative">
        <div class="row">
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
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img  class="moon-shop-sticky-logo <?php echo esc_attr( $moon_shop_mobile ); ?>" src="<?php echo esc_url( $moon_shop_sticky_logo ); ?>" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/></a>
                <?php }
                if( $moon_shop_mobile_logo != '' ) { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="moon-shop-mobile-logo" src="<?php echo esc_url( $moon_shop_mobile_logo ); ?>" alt="<?php esc_html_e( 'logo' , 'moon-shop' ); ?>"/></a>
                <?php } ?>
            </div>
            <div class="moon-position-none <?php if( $moon_shop_header_style == 'header-style-one' ) {
                echo 'moon-header-one';
            } ?>">
				<?php if( $moon_shop_header_style == 'header-style-one' ) { ?>
                <!-- Header Search & Cart -->
                <div class="search-cart pull-right <?php if( $moon_shop_header_style == 'header-style-one' ) {
                    echo 'header-one-search';
                } ?> ">
                    <!-- Header Cart -->
                    <?php
					if( $moon_shop_catalog != '1' ) {
						if( in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
							if( $moon_shop_cart_icon_position == 'header' && in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
								get_template_part( 'woocommerce/cart/mini-cart' );
							}
						}
					}
                    ?>

                    <!-- Header Search -->
                    <?php if( $moon_shop_search_iconED == '1' ) {
                        if( $moon_shop_search_icon_position == 'main-menu' && $moon_shop_header_style == 'header-style-one' ) {
                            ?>
                            <!-- Header Search -->
                            <div class="header-search <?php echo esc_attr( $moon_shop_search ); ?>">
                                <button class="search-btn search-open"><i class="fa fa-search"></i></button>
                            </div>
                        <?php }
                    } ?>
                </div>
				<?php } ?>

                <?php if( $moon_shop_header_style == 'header-style-two' ) { ?>
                    <div class="header-search-box">
                        <form role="search" class="search-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input type="hidden" name="post_type" value="product"/>
                            <input type="search" value="" name="s" id="s" class="s" placeholder="<?php esc_html_e( 'Search products...' , 'moon-shop' ); ?>"/>
                            <button type="submit"><?php esc_html_e( 'Search' , 'moon-shop' ); ?></button>
                        </form>
                    </div>
                <?php } ?>
                <!-- Main Menu -->
                <?php
                if( $moon_shop_header_style == 'header-style-one' || $moon_shop_header_style == '' ) {
                    get_template_part( 'base/views/header/menu' );
                }
                ?>
            </div>
        </div>
        <?php if( $moon_shop_header_style == 'header-style-two' ) { ?>
            <div class="row moon-position-relative">
                <div class="moon-menu moon-position-none">
                    <!-- Header Search & Cart -->
                    <div class="search-cart pull-right">
                        <!-- Header Cart -->
                        <?php
                        if( $moon_shop_catalog != '1' ) {
							if( $moon_shop_cart_icon_position == 'header' && in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {
								get_template_part( 'woocommerce/cart/mini-cart' );
							}
						}
                        ?>

                        <!-- Header Search -->
                        <?php if( $moon_shop_search_iconED == '1' ) {
                            if( $moon_shop_search_icon_position == 'main-menu' && $moon_shop_header_style == 'header-style-two' ) {
                                ?>
                                <!-- Header Search -->
                                <div
                                    class="header-search header-search-menu <?php echo esc_attr( $moon_shop_search ); ?>">
                                    <button class="search-btn search-open"><i class="fa fa-search"></i></button>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <!-- Main Menu -->
                    <div class="pull-left">
                        <?php
                        if( $moon_shop_header_style == 'header-style-two' ) {
                            get_template_part( 'base/views/header/menu' );
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="search-page">
    <div class="full-banner">
        <div class="search">
            <span class="close"><i class="fa fa-times"></i></span>

            <div class="wl-middle">
                <form role="search" class="search-form-full" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="hidden" name="post_type" value="product"/>
                    <input type="text" value="" name="s" id="s" class="s" placeholder="<?php echo esc_attr( $moon_shop_search_placeholder ); ?>"/>
                </form>
            </div>
        </div>
    </div>
</div>	

