<?php
// Adding Scripts To Front End
add_action( 'wp_enqueue_scripts' , 'moon_shop_enqueueScripts' , 10 );
function moon_shop_enqueueScripts() {
    $moon_shop_dynamic_css_on_off = '';
    if( class_exists( 'Redux' ) ) {
        //theme options global variable
        $moon_shop_optionsValue = get_option( 'moon_shop' );
        $moon_shop_dynamic_css_on_off = isset( $moon_shop_optionsValue[ 'moon-shop-redux-style-on-off' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-redux-style-on-off' ] ) : '';
    }

    //Enqueue css file
    wp_enqueue_style( 'moon-fonts' , moon_shop_google_fonts_url() );
    wp_enqueue_style( 'font-awesome' , MOON_SHOP_THEME_ASSETS_CSS . '/font-awesome.min.css' , '' , null );
    wp_enqueue_style( 'animate' , MOON_SHOP_THEME_ASSETS_CSS . '/animate.min.css' , '' , null );
    wp_enqueue_style( 'bootstrap' , MOON_SHOP_THEME_ASSETS_CSS . '/bootstrap.min.css' , '' , null );
    wp_enqueue_style( 'user-interface' , MOON_SHOP_THEME_ASSETS_CSS . '/user-interface.min.css' , '' , null );
    wp_enqueue_style( 'tooltipster' , MOON_SHOP_THEME_ASSETS_CSS . '/tooltipster.bundle.min.css' , '' , null );
    if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
        wp_enqueue_style( 'owl-carousel' , MOON_SHOP_THEME_ASSETS_CSS . '/owl.carousel.min.css' , '' , null );
        wp_enqueue_style( 'owl-carousel-default' , MOON_SHOP_THEME_ASSETS_CSS . '/owl.theme.default.min.css' , '' , null );
        wp_enqueue_style( 'magnific-popup' , MOON_SHOP_THEME_ASSETS_CSS . '/magnific-popup.css' , '' , null );
    }

    wp_enqueue_style( 'meanmenu' , MOON_SHOP_THEME_ASSETS_CSS . '/meanmenu.min.css' , '' , null );
    wp_enqueue_style( 'slick' , MOON_SHOP_THEME_ASSETS_CSS . '/slick.css' , '' , null );
    wp_enqueue_style( 'introLoader' , MOON_SHOP_THEME_ASSETS_CSS . '/introLoader.min.css' , '' , null );
    wp_enqueue_style( 'moon_shop_editor_style' , MOON_SHOP_THEME_ASSETS_CSS . '/editor-style.css' , '' , null );
    wp_enqueue_style( 'moon_style' , MOON_SHOP_THEME_DIR_URI . '/style.css' , '' , null );
    if ( ( isset($moon_shop_optionsValue['moon-shop-rtl-on-off']) && $moon_shop_optionsValue['moon-shop-rtl-on-off'] == '1' ) || is_rtl() ) {
		wp_enqueue_style( 'moon_rtl' , MOON_SHOP_THEME_DIR_URI . '/rtl.css' , '' , null );
    }
	if( $moon_shop_dynamic_css_on_off == '1' ) {
        wp_enqueue_style( 'moon_shop_dynamic_css' , MOON_SHOP_THEME_DIR_URI . '/base/redux/dynamic.css' , '' , null );
    }
    wp_enqueue_style( 'responsive' , MOON_SHOP_THEME_ASSETS_CSS . '/responsive.css' , '' , null );
	if ( ( isset($moon_shop_optionsValue['moon-shop-rtl-on-off']) && $moon_shop_optionsValue['moon-shop-rtl-on-off'] == '1' ) || is_rtl() ) {
		wp_enqueue_style( 'moon_responsive_rtl' , MOON_SHOP_THEME_ASSETS_CSS . '/responsive-rtl.css' , '' , null );
    }
    if( in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) ) {

        wp_enqueue_script( 'wc-add-to-cart-variation' );

        wp_enqueue_script( 'moon-wc-add-to-cart' , MOON_SHOP_THEME_ASSETS_JS . '/moon-add-to-cart.js' , array( 'jquery' ) , null , true );
        wp_localize_script( 'moon-wc-add-to-cart' , 'moon_shop_productCart' , array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

        //product load more
        wp_enqueue_script( 'wc-product-loadmore' , MOON_SHOP_THEME_ASSETS_JS . '/product-load-more.js' , array( 'jquery' ) , null , true );
        $moon_shop_products = ( isset( $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] ) && $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] != '' ) ? $moon_shop_optionsValue[ 'moon-shop-shop-product-page-product-number' ] : 9;
        wp_localize_script( 'wc-product-loadmore' , 'moon_shop_loadmore_product' , array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) , 'posts_per_page' => $moon_shop_products ) );

        //quick view
        wp_enqueue_script( 'wc-product-modal' , MOON_SHOP_THEME_ASSETS_JS . '/product-load-modal.js' , array( 'jquery' ) , null , true );
        wp_localize_script( 'wc-product-modal' , 'moon_shop_single_product_ajaxloader' , array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) , 'jsDirectory' => MOON_SHOP_THEME_ASSETS_JS ) );

        wp_enqueue_script( 'easyzoom' , MOON_SHOP_THEME_ASSETS_JS . '/easyzoom.js' , array( 'jquery' ) , null , true );

        $product_image_style = isset($moon_shop_optionsValue['moon-shop-single-product-style']) ? $moon_shop_optionsValue['moon-shop-single-product-style'] : 'bottom-carousel';
        if ($product_image_style == 'bottom-carousel' || $product_image_style == 'side-carousel' || $product_image_style == 'full-images') {
            wp_dequeue_script( 'flexslider' );
            wp_dequeue_script( 'zoom' );
        }
        $product_sticky = isset($moon_shop_optionsValue['moon-shop-all-images-sticky']) ? $moon_shop_optionsValue['moon-shop-all-images-sticky'] : '';
        if ($product_image_style == 'full-images' && $product_sticky == '1') {
            wp_enqueue_script( 'moon-sticky' , MOON_SHOP_THEME_ASSETS_JS . '/sticky-sidebar.min.js' , array( 'jquery' ) , null , false );
        }

        // wp_enqueue_script( 'jquery.countdown' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.countdown.min.js' , array( 'jquery' ) , null , false );
        // wp_enqueue_script( 'jquery.moment' , MOON_SHOP_THEME_ASSETS_JS . '/moment.min.js' , array( 'jquery' ) , null , false );
        // wp_enqueue_script( 'moment-timezone-with-data' , MOON_SHOP_THEME_ASSETS_JS . '/moment-timezone-with-data.min.js' , array( 'jquery' ) , null , false );
        // wp_localize_script( 'jquery.countdown' , 'timerTranslations' , array( 
        //     'countdown_days' => esc_html__('days', 'moon-shop'),
        //     'countdown_hours' => esc_html__('hr', 'moon-shop'),
        //     'countdown_mins' => esc_html__('min', 'moon-shop'),
        //     'countdown_sec' => esc_html__('sc', 'moon-shop'), ) 
        // );

        wp_enqueue_script( 'owl-carousel' , MOON_SHOP_THEME_ASSETS_JS . '/owl.carousel.min.js' , array( 'jquery' ) , null , true );
        wp_enqueue_script( 'magnific-popup' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.magnific-popup.min.js' , array( 'jquery' ) , null , true );
    }

    wp_enqueue_script( 'tooltipster' , MOON_SHOP_THEME_ASSETS_JS . '/tooltipster.bundle.min.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'bootstrap' , MOON_SHOP_THEME_ASSETS_JS . '/bootstrap.min.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'meanmenu' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.meanmenu.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'slick' , MOON_SHOP_THEME_ASSETS_JS . '/slick.min.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'scrollup' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.scrollup.min.js' , array( 'jquery' ) , null , true );

    wp_enqueue_script( 'user-interface' , MOON_SHOP_THEME_ASSETS_JS . '/user-interface.min.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'wow.min' , MOON_SHOP_THEME_ASSETS_JS . '/wow.min.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'jquery.matchHeight' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.matchHeight.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'moon_shop_main' , MOON_SHOP_THEME_ASSETS_JS . '/main.js' , array( 'jquery' , 'meanmenu' ) , null , true );
    $moon_shop_tooltip = isset($moon_shop_optionsValue['moon-shop-tooltip']) ? $moon_shop_optionsValue['moon-shop-tooltip'] : '1';
    $moon_shop_tooltip_theme = isset($moon_shop_optionsValue['moon-shop-tooltip-theme']) ? $moon_shop_optionsValue['moon-shop-tooltip-theme'] : 'tooltipster-borderless';
    $moon_shop_single_tooltip = isset($moon_shop_optionsValue['moon-shop-single-tooltip']) ? $moon_shop_optionsValue['moon-shop-single-tooltip'] : '1';
    $moon_shop_introloader = isset($moon_shop_optionsValue['moon-shop-go-to-top-enable-disable']) ? $moon_shop_optionsValue['moon-shop-go-to-top-enable-disable'] : '1';
    $moon_shop_single_tooltip_theme = isset($moon_shop_optionsValue['moon-shop-single-tooltip-theme']) ? $moon_shop_optionsValue['moon-shop-single-tooltip-theme'] : 'tooltipster-borderless';
    wp_localize_script( 'moon_shop_main' , 'moonShopMain' , array( 'shopTooltip' =>  $moon_shop_tooltip, 'shopTooltipTheme' => $moon_shop_tooltip_theme, 'singleTooltip' =>  $moon_shop_single_tooltip, 'singleTooltipTheme' => $moon_shop_single_tooltip_theme, 'moonIntroLoader' => $moon_shop_introloader ) );
    wp_enqueue_script( 'introLoader-js' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.introLoader.pack.min.js' , array( 'jquery' ) , null , true );
    wp_enqueue_script( 'moon-viewport' , MOON_SHOP_THEME_ASSETS_JS . '/viewport.js' , array( 'jquery' ) , null , true );
    $moon_shop_preloader_desktop_sc = isset($moon_shop_optionsValue['moon-shop-preloader-enable-desktop']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-desktop'] : '1';
    $moon_shop_preloader_tab_sc = isset($moon_shop_optionsValue['moon-shop-preloader-enable-tab']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-tab'] : '1';
    $moon_shop_preloader_mobile_sc = isset($moon_shop_optionsValue['moon-shop-preloader-enable-mobile']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-mobile'] : '1';
    $moon_shop_spinner = isset($moon_shop_optionsValue['moon-shop-preloader-style']) && !empty($moon_shop_optionsValue['moon-shop-preloader-style']) ? $moon_shop_optionsValue['moon-shop-preloader-style'] : 'simple';
    if ($moon_shop_spinner != 'simple' && $moon_shop_spinner != 'double' && $moon_shop_spinner != 'count') {
        $moon_shop_spinner = 'simple';
    }
    if (($moon_shop_preloader_desktop_sc == '1') || ($moon_shop_preloader_tab_sc == '1') || ($moon_shop_preloader_tab_sc == '1')) {
        wp_enqueue_script( 'moon_shop_preloader' , MOON_SHOP_THEME_ASSETS_JS . '/preloader.js' , array( 'jquery' ) , null , true );
        wp_localize_script( 'moon_shop_preloader' , 'moon_shop_loader' , array( 'style' =>  $moon_shop_spinner ) );
    }

    if( is_singular() ) wp_enqueue_script( 'comment-reply' );

    //post load more script enqueue
    wp_enqueue_script( 'moon_shop_loadmore_post' , MOON_SHOP_THEME_ASSETS_JS . '/load-more-post.js' , array( 'jquery' ) , null , true );
    wp_localize_script( 'moon_shop_loadmore_post' , 'moon_shop_loadmorePost' , array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) , 'posts_per_page' => get_option( 'posts_per_page' ) ) );
}

/**
 * Function to load scripts and style sheet on admin pages
 * @param   $hook
 * @return
 */
add_action( 'admin_enqueue_scripts' , 'moon_shop_enqueueScriptsPageMetaBox' , 10 );
function moon_shop_enqueueScriptsPageMetaBox( $hook ) {
    wp_enqueue_style( 'moon-fonts' , moon_shop_google_fonts_url() , array() , '1.0.0' );
    // Adding Color Picker Stylesheet
    wp_enqueue_style( 'wp-color-picker' );
    // Including css to Page Editor Page
    wp_enqueue_style( 'font-awesome' , MOON_SHOP_THEME_ASSETS_CSS . '/font-awesome.min.css' , '' , '1.0.0' , 'all' );
    wp_enqueue_style( 'dropkick-css' , MOON_SHOP_THEME_ASSETS . '/css/dropkick.css' , array() , '1.0.0' , 'all' );
    wp_enqueue_style( 'elegant-css' , MOON_SHOP_THEME_ASSETS . '/css/elegant.css' , array() , '1.0.0' , 'all' );
    wp_enqueue_style( 'moon_shop_page-custom-css' , MOON_SHOP_THEME_ASSETS . '/css/page.css' , array() , '1.0.0' , 'all' );

    $moon_shop_screen = get_current_screen();
    if( $moon_shop_screen->post_type == 'page' && $moon_shop_screen->base == 'post' ) {
        wp_enqueue_style( 'rangeSlider-css' , MOON_SHOP_THEME_ASSETS . '/css/rangeSlider.min.css' , array() , '1.0.0' , 'all' );
        wp_enqueue_script( 'dropkick-js' , MOON_SHOP_THEME_ASSETS . '/js/dropkick.min.js' , array( 'jquery' ) , '1.0.0' , true );
        wp_enqueue_script( 'rangeSlider-js' , MOON_SHOP_THEME_ASSETS . '/js/rangeslider.min.js' , array( 'jquery' ) , '1.0.0' , true );
        wp_enqueue_script( 'moon_shop_admin-custom-js' , MOON_SHOP_THEME_ASSETS . '/js/admin-custom.js' , array( 'wp-color-picker', 'rangeSlider-js', 'dropkick-js' ) , '1.0.0' , true );
        wp_enqueue_script( 'moon_shop_page-custom-js' , MOON_SHOP_THEME_ASSETS . '/js/page.js' , array( 'wp-color-picker' ) , '1.0.0' , true );
        // Localizing Scripts
        wp_localize_script( 'moon_shop_page-custom-js' , 'moon_shop_page_image' , array( 'title' => esc_html__( 'Upload an Image' , 'moon-shop' ) , 'button' => esc_html__( 'Use This Image' , 'moon-shop' ) ) );
    }

    wp_enqueue_script( 'moon_shop_nav-custom-js' , MOON_SHOP_THEME_ASSETS . '/js/nav.js' , array( 'wp-color-picker' ) , '1.0.0' , true );
}

function moon_shop_google_fonts_url() {
    $moon_shop_font = array();
    if( 'off' !== _x( 'on' , 'Google font: on or off' , 'moon-shop' ) ) {
        $moon_shop_font[ ] = 'Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=latin,latin-ext';
        $moon_shop_font[ ] = 'Libre Baskerville:400,400italic,700';
        $moon_shop_font[ ] = 'Playfair Display:400,400italic,700italic,900italic,900,700';
    }
    $moon_shop_query_args = array( 'family' => urlencode( implode( '|' , $moon_shop_font ) ) , 'subset' => urlencode( 'latin,latin-ext' ) , );
    $moon_shop_fonts_url = add_query_arg( $moon_shop_query_args , 'https://fonts.googleapis.com/css' );
    return $moon_shop_fonts_url;
}