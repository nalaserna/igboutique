<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if( !class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.

$opt_name = "moon_shop";

// This line is only for altering the demo. Can be easily removed.

$opt_name = apply_filters( 'redux_demo/opt_name' , $opt_name );

$sampleHTML = '';

if( file_exists( get_theme_file_path('/base/redux/info-html.html') ) ) {

    Redux_Functions::initWpFilesystem();

    global $wp_filesystem;

    $sampleHTML = $wp_filesystem->get_contents( get_theme_file_path('/base/redux/info-html.html') );

}

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$moon_shop_args = array(
    'opt_name' => $opt_name ,
    'display_name' => $theme->get( 'Name' ) ,
    'display_version' => $theme->get( 'Version' ) ,
    'menu_type' => 'menu' ,
    'allow_sub_menu' => true ,
    'menu_title' => esc_html__( 'Moon Theme Options' , 'moon-shop' ) ,
    'page_title' => esc_html__( 'Moon Theme Options' , 'moon-shop' ) ,
    'google_api_key' => 'AIzaSyAGbLtqnrjAcHaJS5CoT80XwJZDmgeoD3I' ,
    'google_update_weekly' => false ,
    'async_typography' => false ,
    'disable_google_fonts_link' => false ,
    'admin_bar' => true ,
    'admin_bar_icon' => 'dashicons-portfolio' ,
    'admin_bar_priority' => 50 ,
    'global_variable' => '' ,
    'dev_mode' => false ,
    'update_notice' => false ,
    'customizer' => false ,
    'page_priority' => null ,
    'page_parent' => 'themes.php' ,
    'page_permissions' => 'manage_options' ,
    'menu_icon' => '' ,
    'last_tab' => '' ,
    'page_icon' => 'icon-themes' ,
    'page_slug' => '' ,
    'save_defaults' => true ,
    'default_show' => false ,
    'default_mark' => '' ,
    'show_import_export' => true ,
    'transient_time' => 60 * MINUTE_IN_SECONDS ,
    'output' => true ,
    'output_tag' => true ,
    'database' => '' ,
    'use_cdn' => true ,
    'hints' => array(
        'icon' => 'el el-question-sign' ,
        'icon_position' => 'right' ,
        'icon_color' => 'lightgray' ,
        'icon_size' => 'normal' ,
        'tip_style' => array(
            'color' => 'red' ,
            'shadow' => true ,
            'rounded' => false ,
            'style' => '' ,
        ) ,
        'tip_position' => array(
            'my' => 'top left' ,
            'at' => 'bottom right' ,
        ) ,
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide' ,
                'duration' => '500' ,
                'event' => 'mouseover' ,
            ) ,
            'hide' => array(
                'effect' => 'slide' ,
                'duration' => '500' ,
                'event' => 'click mouseleave' ,
            ) ,
        ) ,
    )
);

// Panel Intro text -> before the form

if( !isset( $moon_shop_args[ 'global_variable' ] ) || $moon_shop_args[ 'global_variable' ] !== false ) {

    if( !empty( $moon_shop_args[ 'global_variable' ] ) ) {

        $v = $moon_shop_args[ 'global_variable' ];

    } else {

        $v = str_replace( '-' , '_' , $moon_shop_args[ 'opt_name' ] );

    }

} else {

}

// Add content after the form.
Redux::setArgs( $opt_name , $moon_shop_args );
$tabs = array(
    array(
        'id' => 'redux-help-tab-1' ,
        'tiidtle' => esc_html__( 'Theme Information 1' , 'moon-shop' ) ,
        'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>' , 'moon-shop' )
    ) ,
    array(
        'id' => 'redux-help-tab-2' ,
        'title' => esc_html__( 'Theme Information 2' , 'moon-shop' ) ,
        'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>' , 'moon-shop' )
    )
);

Redux::setHelpTab( $opt_name , $tabs );

// Set the help sidebar

$content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>' , 'moon-shop' );

Redux::setHelpSidebar( $opt_name , $content );

/* Header Section */
Redux::setSection( $opt_name , array( 'title' => esc_html__( 'Header' , 'moon-shop' ) , 'id' => 'moon-shop-general-header' , 'customizer_width' => '400px' , 'icon' => 'el el-th' , ) );
/* Header Style Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 

    'title' => esc_html__( 'Header Style' , 'moon-shop' ) ,

    'id' => 'moon-shop-header-style' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-home' ,

    'fields' => array( 
        array( 
            'id' => 'moon-shop-header-style' , 
            'type' => 'select' , 
            'title' => esc_html__( 'Select Header Style' , 'moon-shop' ) , 
            'default' => 'header-style-one' , 
            'options' => array( 
                'header-style-one' => esc_html__( 'Header Style One' , 'moon-shop' ) , 
                'header-style-two' => esc_html__( 'Header Style Two' , 'moon-shop' ) , 
            ) 
        ) ,
        array(
            'id' => 'moon-shop-header-search-icon-position' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Search Icon Position' , 'moon-shop' ) , 
            'default' => 'main-menu' , 
            'options' => array( 
                'top-bar' => esc_html__( 'Top Bar' , 'moon-shop' ) , 
                'main-menu' => esc_html__( 'Main Menu' , 'moon-shop' ) ,
            )
        ) ,

        array(
            'id' => 'moon-shop-header-background-color' ,
            'type' => 'background' ,
            'compiler' => array( '.header-bottom' ) ,
            'title' => esc_html__( 'Header Background Color' , 'moon-shop' ) ,
            'google' => true ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
        ) , 
        array( // search icon enable/disable
            'id' => 'moon-shop-cart-color' , 
            'type' => 'color' , 
            'title' => esc_html__( 'Cart Icon Color' , 'moon-shop' ) , 
            'compiler' => '.header-cart .cart-btn i',
            'transparent' => false ,
        ),
        array( // search icon enable/disable
            'id' => 'moon-shop-cart-number-color' , 
            'type' => 'color' , 
            'title' => esc_html__( 'Cart Icon Number Color' , 'moon-shop' ) , 
            'compiler' => '.header-cart .cart-btn .cart-number',
            'transparent' => false ,
        ),
        array( // search icon enable/disable
            'id' => 'moon-shop-cart-number-bg-color' , 
            'type' => 'color' , 
            'title' => esc_html__( 'Cart Icon Number Background Color' , 'moon-shop' ) , 
            'transparent' => true ,
        ),
        array( // search icon enable/disable
            'id' => 'moon-shop-search-icon-enable-disable' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Search Icon Enable/Disable' , 'moon-shop' ) , 
            'default' => true , 
        ) , 
        array( // sticky header enable/disable
            'id' => 'moon-shop-sticky-menu-enable-disable' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Sticky Header Enable/Disable' , 'moon-shop' ) , 
            'default' => true , 
        ) , 
        array( // sticky header mobile enable/disable
            'id' => 'moon-shop-sticky-header-mobile-enable-disable' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Sticky Header Mobile Enable/Disable' , 'moon-shop' ) ,  
            'default' => false , 
        ) ,
		array(
            // header area spacing
            'id' 					=> 'moon-shop-header-spacing' ,
            'type' 					=> 'spacing' ,
            'title' 				=> esc_html__( 'Header Area Padding' , 'moon-shop' ) ,
			'compiler'				=> array( '.header-bottom' ),
			'mode'					=> 'padding',
			'units'					=> array( 'em', 'px' ),
			'display_units'			=> false,
			'default'            	=> array(
				'padding-top'     		=> '22', 
				'padding-right'   		=> '0', 
				'padding-bottom'  		=> '22', 
				'padding-left'    		=> '0',
				'units'          		=> 'px', 
			)
        ),
		array(
            // Sticky header area spacing
            'id' 					=> 'moon-shop-sticky-header-spacing' ,
            'type' 					=> 'spacing' ,
            'title' 				=> esc_html__( 'Sticky Header Area Padding' , 'moon-shop' ) ,
			'compiler'				=> array( '.stick' ),
			'units'					=> array( 'em', 'px' ),
			'display_units'			=> false,
			'default'            	=> array(
				'padding-top'     		=> '22', 
				'padding-right'   		=> '0', 
				'padding-bottom'  		=> '22', 
				'padding-left'    		=> '0',
				'units'          		=> 'px', 
			)
        ),
) ) );

/* General Logo Sub Section */
Redux::setSection( $opt_name , array(

    'id' => 'moon-shop-general-logos' , 'subsection' => true , 'title' => esc_html__( 'Logo' , 'moon-shop' ) ,
    'icon' => 'el el-picture' ,
    'fields' => array(
        array(
            // Main Logo
            'id' => 'moon-shop-main-logo' ,
            'type' => 'media' ,
            'url' => true ,
            'title' => esc_html__( 'Main Logo' , 'moon-shop' ) ,
            'subtitle' => esc_html__( 'Upload main logo' , 'moon-shop' ) ,
            'default' => array( 'url' => MOON_SHOP_THEME_ASSETS_IMAGE . '/logo.png' ) ,
        ) ,
        array( // Sticky Logo enable/disable
            'id' => 'moon-shop-sticky-logo-enable-disable' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Sticky Logo Enable/Disable' , 'moon-shop' ) , 
            'default' => true , 
        ) ,
        array(
            // Sticky Header Logo
            'id' => 'moon-shop-sticky-logo' ,
            'type' => 'media' ,
            'url' => true ,
            'title' => esc_html__( 'Sticky Logo' , 'moon-shop' ) ,
            'subtitle' => esc_html__( 'Upload sticky logo' , 'moon-shop' ) ,
            'default' => array( 'url' => MOON_SHOP_THEME_ASSETS_IMAGE . '/logo.png' ) ,
            'required' => array( 'moon-shop-sticky-logo-enable-disable' , '=' , array( true ) ) ,
        ) ,
        array(
            // Mobile Logo
            'id' => 'moon-shop-mobile-logo' ,
            'type' => 'media' ,
            'url' => true ,
            'title' => esc_html__( 'Mobile Logo' , 'moon-shop' ) ,
            'subtitle' => esc_html__( 'Upload mobile logo' , 'moon-shop' ) ,
            'default' => array( 'url' => MOON_SHOP_THEME_ASSETS_IMAGE . '/logo.png' ) ,
        ) ,
		array( // logo Height
            'id' => 'moon-shop-logo-height' , 
            'type' => 'text' , 
            'title' => esc_html__( 'Logo Height' , 'moon-shop' ) , 
            'default' => '', 
        ) ,
    )
) );

/* Header Top Bar Options Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Top Bar' , 'moon-shop' ) , 
    'id' => 'moon-shop-header-top-bar-options' ,  
    'customizer_width' => '400px' , 
    'icon' => 'el el-circle-arrow-up' , 
    'fields' => array( array( // top bar enable/disable
        'id' => 'moon-shop-top-bar-enable-disable' , 
        'type' => 'switch' , 
        'title' => esc_html__( 'Top Bar Enable/Disable' , 'moon-shop' ) , 
        'default' => true , 
    ) , 
    array( // login register enable/disable
        'id' => 'moon-shop-login-register-enable-disable' , 
        'type' => 'switch' , 
        'title' => esc_html__( 'Login / Register Enable/Disable' , 'moon-shop' ) , 
        'default' => true , 
    ) , 
    array( // Top bar custom text
        'id' => 'moon-shop-top-bar-custom-text' , 
        'type' => 'textarea' , 
        'compiler' => array( 'body' ) , 
        'title' => esc_html__( 'Top Bar Custom Text' , 'moon-shop' ) , 
        'allowed_html' => array() , 
        'rows' => 3 
    ) , 
    array( // Top bar contact info phone
        'id' => 'moon-shop-top-bar-contact-info-phone' , 
        'type' => 'text' , 
        'title' => esc_html__( 'Top Bar Phone Number' , 'moon-shop' ) , 
        'allowed_html' => array() , 
        'rows' => 3 
    ) , 
    array( // Top bar contact info email
        'id' => 'moon-shop-top-bar-contact-info-email' , 
        'type' => 'text' , 
        'title' => esc_html__( 'Top Bar Email' , 'moon-shop' ) , 
        'allowed_html' => array() , 
        'rows' => 3
    ) ,

    array(
        // Top bar background color
        'id' => 'moon-shop-top-bar-background-color' ,
        'type' => 'background' ,
        'compiler' => array( '.header-top' ) ,
        'title' => esc_html__( 'Top Bar Background Color' , 'moon-shop' ) ,
        'background-position' => false ,
        'background-image' => false ,
        'background-size' => false ,
        'transparent' => false ,
        'background-repeat' => false ,
        'background-attachment' => false ,
        'preview_height' => '50px' ,
        'default' => array(
            'background-color' => '#272727'
        ) ,
    ) ,
    array(
        // Top bar text color
        'id' => 'moon-shop-top-bar-text-color' ,
        'type' => 'color' ,
        'compiler' => array( '.header-contact-info ul li' ) ,
        'title' => esc_html__( 'Top Bar Text Color' , 'moon-shop' ) ,
        'transparent' => false ,
    ) ,
    array(
        // Top bar link color
        'id' => 'moon-shop-top-bar-link-color' ,
        'type' => 'color' ,
        'compiler' => array( '.header-contact-info ul li > a, .language-currency ul > li > a, #menu-top-menu li a' ) ,
        'title' => esc_html__( 'Top Bar Link Color' , 'moon-shop' ) ,
        'transparent' => false ,
    ) ,
    array(
        // Top bar hover link color
        'id' => 'moon-shop-top-bar-hover-link-color' ,
        'type' => 'color' ,
        'compiler' => array( '.header-contact-info ul li > a:hover, #menu-top-menu.language-currency >li >a:hover' ) ,
        'title' => esc_html__( 'Top Bar Link Hover Color' , 'moon-shop' ) ,
        'transparent' => false ,
    ) ,
    array(
        // Top item ivider color
        'id' => 'moon-shop-top-bar-divider-color' ,
        'type' => 'color_rgba' ,
        'compiler' => array( '.header-contact-info ul li::before' ) ,
        'title' => esc_html__( 'Top Bar Item Divider Color' , 'moon-shop' ) ,
        'transparent' => false ,
    ) ,
    array(
        // Top bar icon color
        'id' => 'moon-shop-top-bar-icon-color' ,
        'type' => 'color' ,
        'compiler' => array( '.header-cart-2 .cart-btn i, .header-search-2 .search-btn i, .header-top-cart .header-search .search-btn i' ) ,
        'title' => esc_html__( 'Top Bar Icon Color' , 'moon-shop' ) ,
        'transparent' => false ,
    ) ,
    array(
            'id' => 'moon-shop-topbar-typography' ,
            'type' => 'typography' ,
            'title' => esc_html__( 'Top Bar Typography' , 'moon-shop' ) ,
            'compiler' => array( '.header-contact-info ul li, .header-contact-info ul li a, #menu-top-menu.language-currency > li > a' ) ,
            'all_styles' => true ,
            'google' => true ,
            'font-backup' => true ,
            'letter-spacing' => true ,
            'word-spacing' => true ,
            'text-transform' => true ,
        ) ,
) ) );

/* Menu Section */

Redux::setSection( $opt_name , array(
    'title' => esc_html__( 'Menu' , 'moon-shop' ) ,
    'id' => 'moon-shop-menu-section' ,
    'customizer_width' => '400px' ,
    'icon' => 'el el-th' , ) 
);
/* Main Menu Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Main Menu' , 'moon-shop' ) , 
    'id' => 'moon-shop-main-menu-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-credit-card' , 
    'fields' => array(
        array(
            'id' => 'moon-shop-main-menu-typograpy' ,
            'type' => 'typography' ,
            'title' => esc_html__( 'Main Menu Typography' , 'moon-shop' ) ,
            'compiler' => array( '.main-menu nav > ul > li > a' ) ,
            'all_styles' => true ,
            'google' => true ,
            'font-backup' => true ,
            'letter-spacing' => true ,
            'word-spacing' => true ,
            'text-transform' => true ,
        ) ,
		array(
            // menu spacing
            'id' 					=> 'moon-shop-menu-spacing' ,
            'type' 					=> 'spacing' ,
            'title' 				=> esc_html__( 'Menu Spacing' , 'moon-shop' ) ,
			'compiler'				=> array( '.main-menu nav > ul > li > a' ),
			'units'					=> array( 'em', 'px' ),
			'display_units'			=> false,
			'default'            	=> array(
				'padding-top'     		=> '0', 
				'padding-right'   		=> '25', 
				'padding-bottom'  		=> '0', 
				'padding-left'    		=> '0',
				'units'          		=> 'px', 
			)
        ),
        array(

            // Menu background color
            'id' => 'moon-shop-menu-background-color' ,
            'type' => 'background' ,
            'compiler' => array( '.main-menu' ) ,
            'title' => esc_html__( 'Main Menu Background color' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
        ) ,
        array(
            // Menu text hover color
            'id' => 'moon-shop-menu-text-hover-color' ,
            'type' => 'color' ,
            'compiler' => array( '.main-menu nav > ul > li > a:hover' ) ,
            'title' => esc_html__( 'Menu Text Hover Color' , 'moon-shop' ) ,
            'transparent' => false ,
        ) , 
        array( // Menu hover bottom border enable/disable
            'id' => 'moon-shop-menu-hover-bottom-border-enable-disable' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Menu Hover Bottom Border Enable/Disable' , 'moon-shop' ) , 
            'default' => true , 
        ) , 
        array( // Menu hover bottom border color
            'id' => 'moon-shop-menu-hover-bottom-color' , 
            'type' => 'background' , 
            'compiler' => array( '.main-menu nav > ul > li > a::before' ) , 
            'title' => esc_html__( 'Menu Hover Bottom Border Color' , 'moon-shop' ) , 
            'transparent' => false , 
            'background-position' => false , 
            'background-image' => false , 
            'background-size' => false , 
            'transparent' => false , 
            'background-repeat' => false , 
            'background-attachment' => false , 
            'preview' => false , 
        ) , 
        array( // Search icon color
            'id' => 'moon-shop-search-icon-color' , 
            'type' => 'color' , 
            'compiler' => array('.header-search .search-btn i') , 
            'title' => esc_html__( 'Search Icon Color' , 'moon-shop' ) , 
            'transparent' => false , 
        ) , 
    )
) );

/* Sub Menu Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Sub Menu' , 'moon-shop' ) ,
    'id' => 'moon-shop-sub-menu-section' ,
    'customizer_width' => '400px' ,
    'icon' => 'el el-lines' ,
    'fields' => array(
        array(
            'id' => 'moon-shop-sub-menu-typograpy' ,
            'type' => 'typography' ,
            'title' => esc_html__( 'Sub Menu Typography' , 'moon-shop' ) ,
            'compiler' => array( '.main-menu .sub-menu > li > a' ) ,
            'all_styles' => true ,
            'google' => true ,
            'font-backup' => true ,
            'letter-spacing' => true ,
            'word-spacing' => true ,
            'text-transform' => true ,
        ) ,
        array(
            'id' => 'moon-shop-mega-menu-title-typograpy' ,
            'type' => 'typography' ,
            'title' => esc_html__( 'Mega Menu Title Typography' , 'moon-shop' ) ,
            'compiler' => array( '.mega-menu li span.mega-title' ) ,
            'all_styles' => true ,
            'google' => true ,
            'font-backup' => true ,
            'letter-spacing' => true ,
            'word-spacing' => true ,
            'text-transform' => true ,
        ) ,
        array(
            // Sub menu background color
            'id' => 'moon-shop-sub-menu-background-color' ,
            'type' => 'background' ,
            'compiler' => array( '.main-menu .sub-menu, .main-menu .sub-menu::before' ) ,
            'title' => esc_html__( 'Sub Menu Background color' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
        ) ,
        array(
            // mega menu background color
            'id' => 'moon-shop-mega-menu-background-color' ,
            'type' => 'background' ,
            'compiler' => array( '.mega-menu ul.sub-menu, .main-menu .mega-menu::before' ) ,
            'title' => esc_html__( 'Mega Menu Background color' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
        ) ,
        array(
            // Sub menu text hover color
            'id' => 'moon-shop-sub-menu-text-hover-color' ,
            'type' => 'color' ,
            'compiler' => array( '.main-menu .sub-menu > li > a:hover' ) ,
            'title' => esc_html__( 'Sub Menu Text Hover Color' , 'moon-shop' ) ,
            'transparent' => false ,
        ) ,
        array(
            // Sub menu background hover color
            'id' => 'moon-shop-sub-menu-background-hover-color' ,
            'type' => 'background' ,
            'compiler' => array( '.main-menu .sub-menu > li > a:hover' ) ,
            'title' => esc_html__( 'Sub Menu Background Hover color' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
        ) ,
        array(
            // Sub menu background hover color
            'id' => 'moon-shop-mega-menu-hover-color' ,
            'type' => 'background' ,
            'compiler' => array( '.mega-menu .sub-menu > li .sub-menu a:hover' ) ,
            'title' => esc_html__( 'Mega Sub Menu Hover color' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
        ) ,
        array(
            // Mega menu width
            'id' => 'moon-shop-mega-menu-width' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Mega Menu Width' , 'moon-shop' ) ,
            'default' => 'container' ,
            'options' => array(
                'fullwidth' => esc_html__( 'Full Width' , 'moon-shop' ) ,
                'container' => esc_html__( 'Container' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // Sub menu divider color
            'id' => 'moon-shop-sub-menu-divider-color' ,
            'type' => 'border' ,
            'compiler' => array( '.main-menu .sub-menu > li, .mega-title' ) ,
            'title' => esc_html__( 'Sub Menu Divider Color' , 'moon-shop' ) ,
            'all' => false ,
            'bottom' => true
        ) ,
    )
) );

/* Appearance Section */
Redux::setSection( $opt_name , array( 
    'title' => esc_html__( 'Appearance' , 'moon-shop' ) , 
    'id' => 'moon-shop-appearance-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-brush' , 
    'fields' => array(
        array(
            // Page title background image
            'id' => 'moon-shop-body-background' ,
            'type' => 'background' ,
            'compiler' => array( 'body' ) ,
            'title' => esc_html__( 'Body Background' , 'moon-shop' ) ,
            'background-position' => true ,
            'background-image' => true ,
            'background-size' => true ,
            'transparent' => false ,
            'background-repeat' => true ,
            'background-attachment' => true ,
            'background-color' => true ,
        ) ,
        array(
            'title' => esc_html__( 'Defaults Color' , 'moon-shop' ),
            'type' => 'radio',
            'id' => 'moon-shop-deafult-colors',
            'default' => '1' ,
            'options' => array(
                '1' => '<img src="'.get_template_directory_uri().'/assets/images/e2214b.png">',
                '2' => '<img src="'.get_template_directory_uri().'/assets/images/1e73be.png">',
                '3' => '<img src="'.get_template_directory_uri().'/assets/images/f57c00.png">',
                '4' => '<img src="'.get_template_directory_uri().'/assets/images/ab47bc.png">',
                '5' => '<img src="'.get_template_directory_uri().'/assets/images/e67fb9.png">',
                '6' => '<img src="'.get_template_directory_uri().'/assets/images/00acc1.png">',
                '7' => '<img src="'.get_template_directory_uri().'/assets/images/8b82d5.png">',
                '8' => '<img src="'.get_template_directory_uri().'/assets/images/43a047.png">',
                '9' => '<img src="'.get_template_directory_uri().'/assets/images/ab8b65.png">',
                '10' => esc_html__( 'Custom Color' , 'moon-shop' ) ,
            ),
        ),
        array( 
            // Theme color options
            'title' => esc_html__( 'Theme Color' , 'moon-shop' ) , 
            'id' => 'moon-shop-theme-color-options' , 
            'type' => 'color' , 
            'default' => '#e2214b' ,
            'transparent' => false,
            'required' => array( 'moon-shop-deafult-colors' , '=' , array( '10' ) ) ,
        ),
        array( 
            // Selectin Hightlight options
            'title' => esc_html__( 'Selectin Hightlight Color' , 'moon-shop' ) , 
            'id' => 'moon-shop-selectin-hightlight-color' , 
            'type' => 'color' , 
            'default' => '' ,
            'transparent' => false,
        ),
        array(
            'title' => esc_html__( 'Selectin Hightlight Background Color' , 'moon-shop' ) , 
            'id' => 'moon-shop-selectin-hightlight-back-color' , 
            'type' => 'color' , 
            'default' => '' ,
            'transparent' => false,
        ),
        array(
            'id' => 'moon-shop-preloader-enable-desktop' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Preloader Enable/Disable Desktop' , 'moon-shop' ) , 
            'default' => true ,
        ),
        array(
            'id' => 'moon-shop-preloader-enable-tab' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Preloader Enable/Disable Tab' , 'moon-shop' ) , 
            'default' => true ,
        ),
        array(
            'id' => 'moon-shop-preloader-enable-mobile' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Preloader Enable/Disable Mobile' , 'moon-shop' ) , 
            'default' => true ,
        ),
        array(
            // Preloader Display Type
            'id' => 'moon-shop-preloader-style' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Preloader Display Style' , 'moon-shop' ) ,
            'default' => 'simple' ,
            'options' => array(
                'simple' => esc_html__( 'Simple Spinner Preloader' , 'moon-shop' ) ,
                'double' => esc_html__( 'Double Preoloader' , 'moon-shop' ) ,
                'count' => esc_html__( 'Counter Preloader' , 'moon-shop' ) ,
            ) ,
            'required' => array( 'moon-shop-preloader-enable' , '=' , array( true ) ) ,
        ),
    ) ) 
);

/* Typography Section */
Redux::setSection( $opt_name , array(

    'title' => esc_html__( 'Typography' , 'moon-shop' ) ,

    'id' => 'moon-shop-typography-section' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-text-width' ,

    'fields' => array(

        array( 
            // Body typography
            'id' => 'moon-shop-body-text-typograpy' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Body' , 'moon-shop' ) , 
            'compiler' => array( 'body' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => false , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false , 
        ) ,

        array(

            // Paragraph typography

            'id' => 'moon-shop-paragraph-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Paragraph' , 'moon-shop' ) ,

            'compiler' => array( 'body p' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // H1 typography

            'id' => 'moon-shop-h1-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'H1' , 'moon-shop' ) ,

            'compiler' => array( '.page-banner h1, .blog-banner h1, .archive-banner h1, .search-banner h1, .moon-shop-banner.page-banner h1' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // H2 typography

            'id' => 'moon-shop-h2-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'H2' , 'moon-shop' ) ,

            'compiler' => array( 'h2' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // H3 typography

            'id' => 'moon-shop-h3-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'H3' , 'moon-shop' ) ,

            'compiler' => array( 'h3' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // H4 typography

            'id' => 'moon-shop-h4-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'H4' , 'moon-shop' ) ,

            'compiler' => array( 'h4' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // H5 typography

            'id' => 'moon-shop-h5-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'H5' , 'moon-shop' ) ,

            'compiler' => array( 'h5' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // H6 typography

            'id' => 'moon-shop-h6-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'H6' , 'moon-shop' ) ,

            'compiler' => array( 'h6' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Block quote typography

            'id' => 'moon-shop-block-quote-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Block Quote' , 'moon-shop' ) ,

            'compiler' => array( 'blockquote p, blockquote p cite a' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Post meta typography

            'id' => 'moon-shop-post-meta-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Post Meta' , 'moon-shop' ) ,

            'compiler' => array( '.blog-meta a' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Link typography

            'id' => 'moon-shop-link-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Link' , 'moon-shop' ) ,

            'compiler' => array( 'a' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array( // Breadcrumb typography

            'id' => 'moon-shop-breadcrumb-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Breadcrumb' , 'moon-shop' ) ,

            'compiler' => array( '.woocommerce-breadcrumb, .woocommerce-breadcrumb a' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false , ) , ) ) );

/* Page Title Section */
Redux::setSection( $opt_name , array(

    'title' => esc_html__( 'Page Title' , 'moon-shop' ) ,

    'id' => 'moon-shop-title-section' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-text-height' ,

    'fields' => array(

        array(

            // Page title color

            'id' => 'moon-shop-page-title-color' ,

            'type' => 'color' ,

            'compiler' => array( '.page-banner h1' ) ,

            'title' => esc_html__( 'Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array(

            // Page title alignment

            'id' => 'moon-shop-page-title-alignment' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Alignment' , 'moon-shop' ) ,

            'default' => 'center' ,

            'options' => array(

                'left' => esc_html__( 'Left' , 'moon-shop' ) ,

                'center' => esc_html__( 'Center' , 'moon-shop' ) ,

                'right' => esc_html__( 'Right' , 'moon-shop' ) ,

            )

        ) ,

        array(

            // Page title background

            'id' => 'moon-shop-page-title-background-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Background' , 'moon-shop' ) ,

            'default' => 'background-color' ,

            'options' => array(

                'background-none' => esc_html__( 'Background None' , 'moon-shop' ) ,

                'background-image' => esc_html__( 'Background Image' , 'moon-shop' ) ,

                'background-color' => esc_html__( 'Background Color' , 'moon-shop' ) ,

            )

        ) ,

        array(

            // Page title background image

            'id' => 'moon-shop-page-title-background-image' ,

            'type' => 'background' ,

            'compiler' => array( '.page-banner' ) ,

            'title' => esc_html__( 'Background Image' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => true ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'background-color' => false ,

            'required' => array( 'moon-shop-page-title-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // page title background overlay color

            'id' => 'moon-shop-page-title-background-overlay-color' ,

            'type' => 'color' ,

            'compiler' => array() ,

            'title' => esc_html__( 'Background Overlay color' , 'moon-shop' ) ,

            'transparent' => false ,

            'required' => array( 'moon-shop-page-title-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // page title background opacity

            'id' => 'moon-shop-page-title-background-opacity' ,

            'type' => 'slider' ,

            'title' => esc_html__( 'Background Opacity' , 'moon-shop' ) ,

            'desc' => esc_html__( 'Description. Min: 0, max: 1, step: 0.1, default value: 0.1' , 'moon-shop' ) ,

            'default' => .1 ,

            'min' => 0 ,

            'step' => .1 ,

            'max' => 1 ,

            'resolution' => 0.1 ,

            'display_value' => 'text' ,

            'required' => array( 'moon-shop-page-title-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // page title background color

            'id' => 'moon-shop-page-title-background-color' ,

            'type' => 'background' ,

            'compiler' => array( '.page-banner' ) ,

            'title' => esc_html__( 'Background color' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => false ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'preview_height' => '50px' ,

            'required' => array( 'moon-shop-page-title-background-select' , '=' , array( 'background-color' ) ) ,

        ) ,

        array(

            // Page title background height

            'id' => 'moon-shop-page-title-background-height-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Background Height' , 'moon-shop' ) ,

            'default' => 'default' ,

            'options' => array(

                'default' => esc_html__( 'Default' , 'moon-shop' ) ,

                'full-height' => esc_html__( 'Full Height' , 'moon-shop' ) ,

                'custom-height' => esc_html__( 'Custom Height' , 'moon-shop' ) ,

            )

        ) ,

        array(

            // page title background height

            'id' => 'moon-shop-page-title-background-height' ,

            'type' => 'text' ,

            'compiler' => array() ,

            'title' => esc_html__( 'Background Custom Height' , 'moon-shop' ) ,

            'required' => array( 'moon-shop-page-title-background-height-select' , '=' , array( 'custom-height' ) ) ,

        ) ,

    )
) );

/* Album Title Section */
Redux::setSection( $opt_name , array(
    'title' => esc_html__( 'Album Title' , 'moon-shop' ) ,
    'id' => 'moon-shop-album-title-section' ,
    'customizer_width' => '400px' ,
    'icon' => 'el el-text-height' ,
    'fields' => array(
        array(
            // Page title color
            'id' => 'moon-shop-album-title-color' ,
            'type' => 'color' ,
            'compiler' => array( '.album-banner.page-banner h1' ) ,
            'title' => esc_html__( 'Title Color' , 'moon-shop' ) ,
            'transparent' => false ,
        ) ,
        array(
            // Page title alignment
            'id' => 'moon-shop-album-title-alignment' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Alignment' , 'moon-shop' ) ,
            'default' => 'center' ,
            'options' => array(
                'left' => esc_html__( 'Left' , 'moon-shop' ) ,
                'center' => esc_html__( 'Center' , 'moon-shop' ) ,
                'right' => esc_html__( 'Right' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // Page title background
            'id' => 'moon-shop-album-title-background-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Select Background' , 'moon-shop' ) ,
            'default' => 'background-color' ,
            'options' => array(
                'background-none' => esc_html__( 'Background None' , 'moon-shop' ) ,
                'background-image' => esc_html__( 'Background Image' , 'moon-shop' ) ,
                'background-color' => esc_html__( 'Background Color' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // page title background overlay color
            'id' => 'moon-shop-album-title-background-overlay-color' ,
            'type' => 'color' ,
            'compiler' => array() ,
            'title' => esc_html__( 'Background Overlay color' , 'moon-shop' ) ,
            'transparent' => false ,
            'required' => array( 'moon-shop-album-title-background-select' , '=' , array( 'background-image' ) ) ,
        ) ,
        array(
            // page title background opacity
            'id' => 'moon-shop-album-title-background-opacity' ,
            'type' => 'slider' ,
            'title' => esc_html__( 'Background Opacity' , 'moon-shop' ) ,
            'desc' => esc_html__( 'Description. Min: 0, max: 1, step: 0.1, default value: 0.1' , 'moon-shop' ) ,
            'default' => .1 ,
            'min' => 0 ,
            'step' => .1 ,
            'max' => 1 ,
            'resolution' => 0.1 ,
            'display_value' => 'text' ,
            'required' => array( 'moon-shop-album-title-background-select' , '=' , array( 'background-image' ) ) ,
        ) ,
        array(
            // page title background color
            'id' => 'moon-shop-album-title-background-color' ,
            'type' => 'background' ,
            'compiler' => array( '.album-banner' ) ,
            'title' => esc_html__( 'Background color' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => false ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'preview_height' => '50px' ,
            'required' => array( 'moon-shop-album-title-background-select' , '=' , array( 'background-color' ) ) ,
        ) ,
        array(
            // Page title background height
            'id' => 'moon-shop-album-title-background-height-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Select Background Height' , 'moon-shop' ) ,
            'default' => 'default' ,
            'options' => array(
                'default' => esc_html__( 'Default' , 'moon-shop' ) ,
                'full-height' => esc_html__( 'Full Height' , 'moon-shop' ) ,
                'custom-height' => esc_html__( 'Custom Height' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // page title background height
            'id' => 'moon-shop-album-title-background-height' ,
            'type' => 'text' ,
            'compiler' => array() ,
            'title' => esc_html__( 'Background Custom Height' , 'moon-shop' ) ,
            'required' => array( 'moon-shop-album-title-background-height-select' , '=' , array( 'custom-height' ) ) ,
        ) ,
    )
) );

// /* Portfolio Title Section */
// Redux::setSection( $opt_name , array(
//     'title' => esc_html__( 'Portfolio Single' , 'moon-shop' ) ,
//     'id' => 'moon-shop-portfolio-section' ,
//     'customizer_width' => '400px' ,
//     'icon' => 'el el-text-height' ,
//     'fields' => array(
//         array(
//             // Page title color
//             'id' => 'moon-shop-portfolio-facebook' ,
//             'type' => 'switch' ,
//             'title' => esc_html__( 'Social Share Facebook Enable' , 'moon-shop' ) ,
//             'transparent' => false ,
//         ),
//         array(
//             // Page title color
//             'id' => 'moon-shop-portfolio-twitter' ,
//             'type' => 'switch' ,
//             'title' => esc_html__( 'Social Share Twitter Enable' , 'moon-shop' ) ,
//             'transparent' => false ,
//         ),
//         array(
//             // Page title color
//             'id' => 'moon-shop-portfolio-google' ,
//             'type' => 'switch' ,
//             'title' => esc_html__( 'Social Share Google Plus Enable' , 'moon-shop' ) ,
//             'transparent' => false ,
//         ),
//         array(
//             // Page title color
//             'id' => 'moon-shop-portfolio-pinterest' ,
//             'type' => 'switch' ,
//             'title' => esc_html__( 'Social Share Pinterest Enable' , 'moon-shop' ) ,
//             'transparent' => false ,
//         ),
//         array(
//             // Page title color
//             'id' => 'moon-shop-portfolio-tumblr' ,
//             'type' => 'switch' ,
//             'title' => esc_html__( 'Social Share Tumblr Enable' , 'moon-shop' ) ,
//             'transparent' => false ,
//         ),
//         array(
//             // Page title color
//             'id' => 'moon-shop-portfolio-delicious' ,
//             'type' => 'switch' ,
//             'title' => esc_html__( 'Social Share Delicious Enable' , 'moon-shop' ) ,
//             'transparent' => false ,
//         )
//     )
// ) );

/* Woocommerce Section */
Redux::setSection( $opt_name , array( 
    'title' => esc_html__( 'Woocommerce' , 'moon-shop' ) , 
    'id' => 'moon-shop-woocommerce-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-shopping-cart' , 
) );

/* Woo commerce default shop page */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Shop Page' , 'moon-shop' ) , 
    'id' => 'moon-shop-shop-page-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-smiley' , 
    'fields' => array(
        array(
            // page title on/off
            'id' => 'moon-shop-product-page-title' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Shop Page Title' , 'moon-shop' ) ,
            'default' => true ,
        ),
        array(
            // list grid toggle on/off
            'id' => 'moon-shop-shop-list-grid-toggle-enable-disable' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'List Grid Toggle Enable/Disable' , 'moon-shop' ) ,
            'default' => true ,
        ),
        array(
            // Product Display Type
            'id' => 'moon-shop-shop-product-display-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Product Display Type' , 'moon-shop' ) ,
            'default' => 'Grid' ,
            'options' => array(
                'list' => esc_html__( 'List' , 'moon-shop' ) ,
                'grid' => esc_html__( 'Grid' , 'moon-shop' ) ,
            ) ,
            'required' => array( 'moon-shop-shop-list-grid-toggle-enable-disable' , '=' , array( false ) ) ,
        ) ,
        array(
            // page title background height
            'id' => 'moon-shop-shop-product-page-product-number' ,
            'type' => 'text' ,
            'compiler' => array() ,
            'title' => esc_html__( 'Product Number Per Page' , 'moon-shop' ) ,
        ) ,
        array(
            // product hover style
            'id' => 'moon-shop-shop-product-hover-style-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Product Hover Style' , 'moon-shop' ) ,
            'default' => 'style-one' ,
            'options' => array(
                'style-one' => esc_html__( 'Style One' , 'moon-shop' ) ,
                'style-two' => esc_html__( 'Style Two' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // category on/off
            'id' => 'moon-shop-category-loop' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Category Show/Hide' , 'moon-shop' ) ,
            'default' => true ,
        ),
        array(
            'id' => 'moon-shop-category-loop-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Category Typography' , 'moon-shop' ) , 
            'compiler' => array( '.pro-cat' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false , 
            'required' => array( 'moon-shop-category-loop' , '=' , array( '1' ) ) ,
        ),
        array(
            'id' => 'moon-shop-category-loop-hover-color' ,
            'type' => 'color' ,
            'transparent' => false,
            'compiler' => array( 'a.pro-cat:hover' ) ,
            'title' => esc_html__( 'Category Hover Color' , 'moon-shop' ) ,
            'required' => array( 'moon-shop-category-loop' , '=' , array( '1' ) ) , 
        ),
        array(
            'id' => 'moon-shop-title-loop-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Product Title Typography' , 'moon-shop' ) , 
            'compiler' => array( '.woocommerce ul.products li.product h3 a' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false ,
        ),
        array(
            'id' => 'moon-shop-title-loop-hover-color' ,
            'type' => 'color' ,
            'transparent' => false,
            'compiler' => array( '.woocommerce ul.products li.product h3 a:hover' ) ,
            'title' => esc_html__( 'Product Title Hover Color' , 'moon-shop' ) ,
        ),
        array(
            'id' => 'moon-shop-price-loop-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Product Regular Price Typography' , 'moon-shop' ) , 
            'compiler' => array( '.woocommerce .pro-content p.price > span.amount, .woocommerce .pro-content p.price > span.amount span.woocommerce-Price-currencySymbol, .woocommerce .pro-content p.price ins span.amount, .woocommerce .pro-content p.price ins span.amount span.woocommerce-Price-currencySymbol' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false ,
        ),
        array(
            'id' => 'moon-shop-sale-price-loop-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Product Sale Price Typography' , 'moon-shop' ) , 
            'compiler' => array( '.woocommerce .pro-content p.price del span.amount, .woocommerce .pro-content p.price del span.woocommerce-Price-currencySymbol' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false ,
        ),
        array(
            'id' => 'moon-shop-swatch-list' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Swatch Attribute to Display' , 'moon-shop' ) ,
            'options' => moon_shop_product_attribute()
        ) ,
        array(
            // swatch tooltip on/off
            'id' => 'moon-shop-tooltip' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Swatch Tooltip' , 'moon-shop' ) ,
            'default' => true ,
        ),
        array(
            // swatch tooltip theme
            'id' => 'moon-shop-tooltip-theme' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Tooltip Theme' , 'moon-shop' ) ,
            'default' => 'tooltipster-borderless' ,
            'options' => array(
                'tooltipster-default'    => esc_html__( 'Default' , 'moon-shop' ) ,
                'tooltipster-light'      => esc_html__( 'Light' , 'moon-shop' ) ,
                'tooltipster-borderless' => esc_html__( 'Borderless' , 'moon-shop' ) ,
                'tooltipster-punk'       => esc_html__( 'Punk' , 'moon-shop' ) ,
                'tooltipster-noir'       => esc_html__( 'Noir' , 'moon-shop' ) ,
                'tooltipster-shadow'     => esc_html__( 'Shadow' , 'moon-shop' ) ,
            ),
            'required' => array( 'moon-shop-tooltip' , '=' , array( '1' ) ) ,
        ) ,
        array(
            'id'        => 'moon-shop-swatch-grid-width',
            'type'      => 'slider',
            'title'     => __('Swatch Width', 'moon-shop'),
            'subtitle'  => __('px', 'moon-shop'),
            "default"   => 16,
            "min"       => 1,
            "step"      => 1,
            "max"       => 100,
            'display_value' => 'label'
        ),
        array(
            // product load more/pagination
            'id' => 'moon-shop-product-shop-load-pagi-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Load More Style' , 'moon-shop' ) ,
            'default' => 'pagination' ,
            'options' => array(
                'pagination' => esc_html__( 'Pagination' , 'moon-shop' ) ,
                'loadmore' => esc_html__( 'Load More' , 'moon-shop' ) ,
            )
        ) ,
        array( // breadcrumb on/off
            'id' => 'moon-shop-shop-product-breadcrumb-enable-disable' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Breadcrumb Enable/Disable' , 'moon-shop' ) , 
            'default' => false ,
        ) ,
        array( // Product page layout
            'id' => 'moon-shop-shop-product-page-layout-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Shop Page Layout' , 'moon-shop' ) ,
            'default' => 'left_sidebar' ,
            'options' => array(
                'fullwidth' => esc_html__( 'Full Width' , 'moon-shop' ) ,
                'left_sidebar' => esc_html__( 'Left Sidebar' , 'moon-shop' ) ,
                'right_sidebar' => esc_html__( 'Right Sidebar' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // sidebar in mobile
            'id' => 'moon-shop-sidebar-enable' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Sidebar Disable In Mobile' , 'moon-shop' ) ,
            'default' => false ,
            'desc' => esc_html__( 'Enable to hide.' , 'moon-shop' ),
        ),
        array( // breadcrumb on/off
            'id' => 'moon-shop-catalog-mode' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Catalog Mode' , 'moon-shop' ), 
            'default' => false ,
            'desc'  => esc_html__( 'This will remove your cart functionality.' , 'moon-shop' ),
        ) ,
        array( // quick view on/off
            'id' => 'moon-shop-quick-view' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Quick View' , 'moon-shop' ) , 
            'default' => true ,
        ) ,
        array( // Product sale
            'id' => 'moon-shop-shop-product-sale' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Sale Badge Style' , 'moon-shop' ) ,
            'default' => 'left_sidebar' ,
            'options' => array(
                'text' => esc_html__( 'Text' , 'moon-shop' ) ,
                'percentage' => esc_html__( 'Sale Percentage' , 'moon-shop' )
            )
        ) ,
        array(
            'id' => 'moon-shop-shop-product-sale-label' ,
            'type' => 'text' ,
            'default' => 'Sale' ,
            'title' => esc_html__( 'Sale Label Text' , 'moon-shop' ) ,
            'required' => array( 'moon-shop-shop-product-sale' , '=' , array( 'text' ) ) ,
        ) ,
        array( // hot label on/off
            'id' => 'moon-shop-featured-label' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Featured Label' , 'moon-shop' ) , 
            'default' => true ,
        ) ,
        array(
            'id' => 'moon-shop-featured-label-text' ,
            'type' => 'text' ,
            'default' => 'hot' ,
            'title' => esc_html__( 'Featured Label Text' , 'moon-shop' ) ,
        ) ,
        array( // cross cell
            'id' => 'moon-shop-cart-cross-cell' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Cross Cells Products In Cart Page' , 'moon-shop' ) , 
            'default' => true ,
        ) ,
        array( // destract free
            'id' => 'moon-shop-destract-free' , 
            'type' => 'switch' , 
            'title' => esc_html__( 'Destract Free Cart and Chackout' , 'moon-shop' ) , 
            'default' => false ,
        ) ,
    )
) );

/* Product Category */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Category Page' , 'moon-shop' ) , 
    'id' => 'moon-shop-product-category-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-shopping-cart' , 
    'fields' => array(
        array(
            // Product page banner
            'id' => 'moon-shop-product-page-banner-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Title Background Option' , 'moon-shop' ) ,
            'default' => 'background_color' ,
            'options' => array(
                'category' => esc_html__( 'Use Category Image' , 'moon-shop' ) ,
                'custom' => esc_html__( 'Use Custom Image For All Category' , 'moon-shop' ) ,
                'background_color' => esc_html__( 'Use Background Color' , 'moon-shop' ) ,
            ),
        ),
        array(
            // title Background color
            'id' => 'moon-shop-product-banner-background-color' ,
            'type' => 'color' ,
            'title' => esc_html__( 'Background Color' , 'moon-shop' ) ,
            'desc' => esc_html__( 'Default is Theme Color' , 'moon-shop' ),
            'transparent' => false ,
            'required' => array( 'moon-shop-product-page-banner-select' , '=' , array( 'background_color' ) ) 
        ),
        array(
            // Blog Index background image
            'id' => 'moon-shop-product-banner-background-image' ,
            'type' => 'background' ,
            'title' => esc_html__( 'Background Image' , 'moon-shop' ) ,
            'background-position' => false ,
            'background-image' => true ,
            'background-size' => false ,
            'transparent' => false ,
            'background-repeat' => false ,
            'background-attachment' => false ,
            'background-color' => false ,
            'required' => array( 'moon-shop-product-page-banner-select' , '=' , array( 'custom' ) ) ,
        ) ,
        array(
            // title Background color
            'id' => 'moon-shop-product-banner-image-background-color' ,
            'type' => 'color_rgba' ,
            'title' => esc_html__( 'Background Color and Opacity' , 'moon-shop' ) ,
            'required' => array( 'moon-shop-product-page-banner-select' , '=' , array( 'custom', 'category' ) ) 
        ),
        array(
            // Product page banner height
            'id' => 'moon-shop-product-page-banner-height' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Title Height' , 'moon-shop' ) ,
            'default' => 'default' ,
            'options' => array(
                'default' => esc_html__( 'Default' , 'moon-shop' ) ,
                'custom' => esc_html__( 'Custom Height' , 'moon-shop' ) ,
                'full-height' => esc_html__( 'Full Height' , 'moon-shop' ) ,
            ),
        ),
        array(
            // title Background color
            'id' => 'moon-shop-product-banner-image-custom-height' ,
            'type' => 'text' ,
            'title' => esc_html__( 'Custom Height' , 'moon-shop' ) ,
            'default' => '200',
            'required' => array( 'moon-shop-product-page-banner-height' , '=' , array( 'custom' ) ) 
        ),
        array(
            // description color
            'id' => 'moon-shop-category-desc-color' ,
            'type' => 'color' ,
            'title' => esc_html__( 'Category Description Color' , 'moon-shop' ) ,
            'default' => '#fff',
            'transparent' => false ,
        ),
    ) ) 
);

/* Single product page */

Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Single Product' , 'moon-shop' ) ,
    'id' => 'moon-shop-single-product-section' ,
    'customizer_width' => '400px' ,
    'icon' => 'el el-laptop-alt' ,
    'fields' => array(
        array(
            // single Product align
            'id' => 'moon-shop-single-product-style-select' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Single Product Image Position' , 'moon-shop' ) ,
            'default' => 'left' ,
            'options' => array(
                'left' => esc_html__( 'Left Align' , 'moon-shop' ) ,
                'right' => esc_html__( 'Right Align' , 'moon-shop' ) ,
            )
        ),
        array(
            // product single images style
            'id' => 'moon-shop-single-product-style' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Product Image Display Style' , 'moon-shop' ) ,
            'default' => 'bottom-carousel',
            'options' => array(
                'thumbs-simple' => esc_html__( 'Thumbs In Bottom' , 'moon-shop' ) ,
                'bottom-carousel' => esc_html__( 'Thumbs Carousel In Bottom' , 'moon-shop' ) ,
                'side-carousel' => esc_html__( 'Thumbs Carousel In Side' , 'moon-shop' ) ,
                'full-images' => esc_html__( 'All Full Images' , 'moon-shop' ) ,
            )
        ),
        array(
            // thumbs number
            'id' => 'moon-shop-single-product-thumbs-number' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Thumbs Items In Single Row' , 'moon-shop' ) ,
            'default' => '4' ,
            'options' => array(
                '3' => esc_html__( 'Three' , 'moon-shop' ) ,
                '4' => esc_html__( 'Four' , 'moon-shop' ) ,
                '5' => esc_html__( 'Five' , 'moon-shop' ) ,
                '6' => esc_html__( 'Six' , 'moon-shop' ) ,
            ),
            'required' => array( 'moon-shop-single-product-style' , '!=' , array( 'full-images' ) ) ,
        ),
        array(
            // sticky on/off
            'id' => 'moon-shop-all-images-sticky' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Sticky Product Details?' , 'moon-shop' ) ,
            'default' => false ,
            'required' => array( 'moon-shop-single-product-style' , '=' , array( 'full-images' ) ) ,
        ),
        $fields = array(
            'id'             => 'moon-shop-all-images-sticky-top',
            'type'           => 'spacing',
            'mode'           => 'absolute',
            'units'          => array('px'),
            'title'          => __('Sticky Top Offset', 'moon-shop'),
            'bottom' => false,
            'right' => false,
            'left' => false,
            'required' => array( 'moon-shop-all-images-sticky' , '=' , array( true ) ) ,
        ),
        array(
            // sticky add to cart desktop on/off
            'id' => 'moon-shop-sticky-cart-desktop' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Sticky Add To Cart Desktop' , 'moon-shop' ) ,
            'default' => true,
        ),
        array(
            // sticky add to cart mobile on/off
            'id' => 'moon-shop-sticky-cart-mobile' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Sticky Add To Cart Mobile' , 'moon-shop' ) ,
            'default' => true,
            'required' => array( 'moon-shop-sticky-cart-desktop' , '=' , array( true ) ) ,
        ),
        array(
            // Related product on/off
            'id' => 'moon-shop-hover-zoom' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Hover Zoom Enable/Disable' , 'moon-shop' ) ,
            'default' => true ,
        ),
        // Blog index title typography
        array(
            'id' => 'moon-shop-single-product-title-text-typograpy' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Title Typography' , 'moon-shop' ) , 
            'compiler' => array( '.woocommerce div.product .product_title' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false , 
        ),
        array(
            'id' => 'moon-shop-price-single-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Product Regular Price Typography' , 'moon-shop' ) , 
            'compiler' => array( '.woocommerce .product-info div.pro-info-price .price ins span, .woocommerce .product-info div.pro-info-price .price > span, .woocommerce .product-info div.pro-info-price .price > span span.woocommerce-Price-currencySymbol' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false ,
        ),
        array(
            'id' => 'moon-shop-sale-price-single-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Product Sale Price Typography' , 'moon-shop' ) , 
            'compiler' => array( '.woocommerce .product-info div.pro-info-price .price del span' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => true , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false ,
        ),
        array(
            'id'        => 'moon-shop-swatch-width',
            'type'      => 'slider',
            'title'     => __('Swatch Width', 'moon-shop'),
            'subtitle'  => __('px', 'moon-shop'),
            "default"   => 32,
            "min"       => 1,
            "step"      => 1,
            "max"       => 100,
            'display_value' => 'label'
        ),
        array(
            // swatch tooltip on/off
            'id' => 'moon-shop-single-tooltip' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Swatch Tooltip' , 'moon-shop' ) ,
            'default' => true ,
        ),
        array(
            // swatch tooltip theme
            'id' => 'moon-shop-single-tooltip-theme' ,
            'type' => 'select' ,
            'title' => esc_html__( 'Tooltip Theme' , 'moon-shop' ) ,
            'default' => 'tooltipster-borderless' ,
            'options' => array(
                'tooltipster-default'    => esc_html__( 'Default' , 'moon-shop' ) ,
                'tooltipster-light'      => esc_html__( 'Light' , 'moon-shop' ) ,
                'tooltipster-borderless' => esc_html__( 'Borderless' , 'moon-shop' ) ,
                'tooltipster-punk'       => esc_html__( 'Punk' , 'moon-shop' ) ,
                'tooltipster-noir'       => esc_html__( 'Noir' , 'moon-shop' ) ,
                'tooltipster-shadow'     => esc_html__( 'Shadow' , 'moon-shop' ) ,
            )
        ) ,
        array(
            // Share on/off
            'id' => 'moon-shop-share-enable-disable' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Share Enable/Disable' , 'moon-shop' ) ,
            'default' => true ,
        ) ,
        array( 
            // products tab title
            'id' => 'moon-shop-signle-tab-typography' , 
            'type' => 'typography' , 
            'title' => esc_html__( 'Product Tab Title Typography' , 'moon-shop' ) , 
            'compiler' => array( '.pro-info-tab-list li a' ) , 
            'all_styles' => true , 
            'google' => true , 
            'font-backup' => false , 
            'letter-spacing' => true , 
            'word-spacing' => true , 
            'text-transform' => true , 
            'text-align' => false , 
        ) ,
        array(
            // active tab title color
            'id' => 'moon-shop-product-tab-active-color' ,
            'type' => 'color' ,
            'title' => esc_html__( 'Product Tab Title Active Color' , 'moon-shop' ) ,
            'default' => '#272727',
            'compiler' => array( '.pro-info-tab-list li.active a' ) , 
            'transparent' => false ,
        ),
        array(
            // Related product on/off
            'id' => 'moon-shop-related-product-enable-disable' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Related Product Enable/Disable' , 'moon-shop' ) ,
            'default' => true ,
        ), 
    )
) );

/* Blog Section */
Redux::setSection( $opt_name , array( 
    'title' => esc_html__( 'Blog' , 'moon-shop' ) , 
    'id' => 'moon-shop-blog-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-th' , 
) );

/* Blog Index Page Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 
    'title' => esc_html__( 'Index Page' , 'moon-shop' ) , 
    'id' => 'moon-shop-blog-index-section' , 
    'customizer_width' => '400px' , 
    'icon' => 'el el-th' , 'fields' => array( 
        array(

            // page title enable/disable

            'id' => 'moon-shop-blog-index-title-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Title Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog index title text

            'id' => 'moon-shop-blog-index-title-text' ,

            'type' => 'Text' ,

            'title' => esc_html__( 'Title Text' , 'moon-shop' ) ,

            'default' => esc_html__( 'Blog & Journal' , 'moon-shop' ) ,

            'required' => array( 'moon-shop-blog-index-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog index title typography

            'id' => 'moon-shop-blog-index-title-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Title Typography' , 'moon-shop' ) ,

            'compiler' => array( '.blog-banner h1' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,
			'default'		=> '',

            'required' => array( 'moon-shop-blog-index-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog index title text alignment

            'id' => 'moon-shop-blog-index-title-alignment' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Title Alignment' , 'moon-shop' ) ,

            'default' => 'center' ,

            'options' => array(

                'light-box' => esc_html__( 'Left' , 'moon-shop' ) ,

                'center' => esc_html__( 'Center' , 'moon-shop' ) ,

                'right' => esc_html__( 'Right' , 'moon-shop' ) ,

            ) ,

            'required' => array( 'moon-shop-blog-index-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog index title background

            'id' => 'moon-shop-blog-index-background-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Background' , 'moon-shop' ) ,

            'default' => 'background-none' ,

            'options' => array(

                'background-none' => esc_html__( 'Background None' , 'moon-shop' ) ,

                'background-image' => esc_html__( 'Background Image' , 'moon-shop' ) ,

                'background-color' => esc_html__( 'Background Color' , 'moon-shop' ) ,

            ) ,

            'required' => array( 'moon-shop-blog-index-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog Index background image

            'id' => 'moon-shop-blog-index-background-image' ,

            'type' => 'background' ,

            'compiler' => array( '.blog-banner' ) ,

            'title' => esc_html__( 'Background Image' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => true ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'background-color' => false ,

            'required' => array( 'moon-shop-blog-index-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // Blog index background overlay color

            'id' => 'moon-shop-blog-index-background-overlay-color' ,

            'type' => 'color' ,

            'title' => esc_html__( 'Background Overlay color' , 'moon-shop' ) ,

            'transparent' => false ,

            'required' => array( 'moon-shop-blog-index-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // Blog index background opacity

            'id' => 'moon-shop-blog-index-background-opacity' ,

            'type' => 'slider' ,

            'title' => esc_html__( 'Background Opacity' , 'moon-shop' ) ,

            'desc' => esc_html__( 'Description. Min: 0, max: 1, step: 0.1, default value: 0.1' , 'moon-shop' ) ,

            'default' => .1 ,

            'min' => 0 ,

            'step' => .1 ,

            'max' => 1 ,

            'resolution' => 0.1 ,

            'display_value' => 'text' ,

            'required' => array( 'moon-shop-blog-index-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // Blog index background color

            'id' => 'moon-shop-blog-index-background-color' ,

            'type' => 'background' ,

            'compiler' => array( '.blog-banner' ) ,

            'title' => esc_html__( 'Background color' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => false ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'preview_height' => '50px' ,

            'required' => array( 'moon-shop-blog-index-background-select' , '=' , array( 'background-color' ) ) ,

        ) ,

        array(

            // Blog index background height

            'id' => 'moon-shop-blog-index-background-height-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Background Height' , 'moon-shop' ) ,

            'default' => 'default' ,

            'options' => array(

                'default' => esc_html__( 'Default' , 'moon-shop' ) ,
                'full-height' => esc_html__( 'Full Height' , 'moon-shop' ) ,

                'custom-height' => esc_html__( 'Custom Height' , 'moon-shop' ) ,

            ) ,

            'required' => array( 'moon-shop-blog-index-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog index background height

            'id' => 'moon-shop-blog-index-background-height' ,

            'type' => 'text' ,

            'compiler' => array() ,

            'title' => esc_html__( 'Background Custom Height' , 'moon-shop' ) ,

            'required' => array( 'moon-shop-blog-index-background-height-select' , '=' , array( 'custom-height' ) ) ,

        ) ,

        array(

            // Blog index meta option on/off

            'id' => 'moon-shop-blog-index-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Meta Option Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog index category option on/off

            'id' => 'moon-shop-blog-index-category-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Category Comments Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

    )
) );

/* Blog Archive Page Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 

    'title' => esc_html__( 'Archive Page' , 'moon-shop' ) ,

    'id' => 'moon-shop-blog-archive-section' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-th' ,

    'fields' => array(

        array(

            // archive title enable/disable

            'id' => 'moon-shop-blog-archive-title-enable-disable' ,

            'type' => 'switch' ,

            'compiler' => array() ,

            'title' => esc_html__( 'Title Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog archive title text

            'id' => 'moon-shop-blog-archive-title-text' ,

            'type' => 'Text' ,

            'title' => esc_html__( 'Title Text' , 'moon-shop' ) ,

            'default' => '' ,

            'required' => array( 'moon-shop-blog-archive-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog archive title typography

            'id' => 'moon-shop-blog-archive-title-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Title Typography' , 'moon-shop' ) ,

            'compiler' => array( '.archive-banner h1' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

            'required' => array( 'moon-shop-blog-archive-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog archive title text alignment

            'id' => 'moon-shop-blog-archive-title-alignment' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Title Alignment' , 'moon-shop' ) ,

            'default' => 'left' ,

            'options' => array(

                'light-box' => esc_html__( 'Left' , 'moon-shop' ) ,

                'center' => esc_html__( 'Center' , 'moon-shop' ) ,

                'right' => esc_html__( 'Right' , 'moon-shop' ) ,

            ) ,

            'required' => array( 'moon-shop-blog-archive-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog archive title background

            'id' => 'moon-shop-blog-archive-background-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Background' , 'moon-shop' ) ,

            'default' => 'background-none' ,

            'options' => array(

                'background-none' => esc_html__( 'Background None' , 'moon-shop' ) ,

                'background-image' => esc_html__( 'Background Image' , 'moon-shop' ) ,

                'background-color' => esc_html__( 'Background Color' , 'moon-shop' ) ,

            ) ,

            'required' => array( 'moon-shop-blog-archive-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog archive background image

            'id' => 'moon-shop-blog-archive-background-image' ,

            'type' => 'background' ,

            'compiler' => array( '.archive-banner' ) ,

            'title' => esc_html__( 'Background Image' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => true ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'background-color' => false ,

            'required' => array( 'moon-shop-blog-archive-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // Blog archive background overlay color

            'id' => 'moon-shop-blog-archive-background-overlay-color' ,

            'type' => 'color' ,

            'title' => esc_html__( 'Background Overlay color' , 'moon-shop' ) ,

            'transparent' => false ,

            'required' => array( 'moon-shop-blog-archive-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // Blog archive background opacity

            'id' => 'moon-shop-blog-archive-background-opacity' ,

            'type' => 'slider' ,

            'title' => esc_html__( 'Background Opacity' , 'moon-shop' ) ,

            'desc' => esc_html__( 'Description. Min: 0, max: 1, step: 0.1, default value: 0.1' , 'moon-shop' ) ,

            'default' => .1 ,

            'min' => 0 ,

            'step' => .1 ,

            'max' => 1 ,

            'resolution' => 0.1 ,

            'display_value' => 'text' ,

            'required' => array( 'moon-shop-blog-archive-background-select' , '=' , array( 'background-image' ) ) ,

        ) ,

        array(

            // Blog archive background color

            'id' => 'moon-shop-blog-archive-background-color' ,

            'type' => 'background' ,

            'title' => esc_html__( 'Background color' , 'moon-shop' ) ,

            'compiler' => array( '.archive-banner' ) ,

            'transparent' => false ,

            'background-position' => false ,

            'background-image' => false ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'preview_height' => '50px' ,

            'required' => array( 'moon-shop-blog-archive-background-select' , '=' , array( 'background-color' ) ) ,

        ) ,

        array(

            // Blog archive background height

            'id' => 'moon-shop-blog-archive-background-height-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Background Height' , 'moon-shop' ) ,

            'default' => 'default' ,

            'options' => array(

                'default' => esc_html__( 'Default' , 'moon-shop' ) ,

                'full-height' => esc_html__( 'Full Height' , 'moon-shop' ) ,

                'custom-height' => esc_html__( 'Custom Height' , 'moon-shop' ) ,

            ) ,

            'required' => array( 'moon-shop-blog-archive-title-enable-disable' , '=' , array( true ) ) ,

        ) ,

        array(

            // Blog archive background height

            'id' => 'moon-shop-blog-archive-background-height' ,

            'type' => 'text' ,

            'compiler' => array() ,

            'title' => esc_html__( 'Background Custom Height' , 'moon-shop' ) ,

            'required' => array( 'moon-shop-blog-archive-background-height-select' , '=' , array( 'custom-height' ) ) ,

        ) ,

        array(

            // Blog archive meta option on/off

            'id' => 'moon-shop-blog-archive-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Meta Option Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) , array(

            // Blog archive category option on/off

            'id' => 'moon-shop-blog-archive-category-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Category Comments Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

    )

) );

/* Blog Single Page Section */
Redux::setSection( $opt_name , array( 
    'subsection' => true , 

    'title' => esc_html__( 'Single Page' , 'moon-shop' ) ,

    'id' => 'moon-shop-blog-single-section' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-th-large' ,

    'fields' => array(

        array(

            // Blog single title typography

            'id' => 'moon-shop-blog-single-title-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Title Typography' , 'moon-shop' ) ,

            'compiler' => array( '.sin-blog-post h1.title' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Blog single content typography

            'id' => 'moon-shop-blog-single-content-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Content Typography' , 'moon-shop' ) ,

            'compiler' => array( '.sin-blog-post .blog-details p' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Blog single category option on/off

            'id' => 'moon-shop-blog-single-cat-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Category Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog single category typography

            'id' => 'moon-shop-blog-single-category-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Category Typography' , 'moon-shop' ) ,

            'compiler' => array( '.sin-blog-post .blog-categories a, .sin-blog-post .blog-categories' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Blog single meta option on/off

            'id' => 'moon-shop-blog-single-meta-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Meta Option Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog single meta typography

            'id' => 'moon-shop-blog-single-meta-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Meta Typography' , 'moon-shop' ) ,

            'compiler' => array( '.sin-blog-post .blog-meta a, .single-blog .blog-meta' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

            'text-align' => false ,

        ) ,

        array(

            // Blog single nav on/off

            'id' => 'moon-shop-blog-single-nav-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Navigation Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog single tag on/off

            'id' => 'moon-shop-blog-single-tag-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Tag Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Blog single share on/off

            'id' => 'moon-shop-blog-single-share-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Share Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Change social share Color

            'id' => 'moon-shop-blog-single-social-share-color' ,

            'type' => 'color' ,

            'title' => esc_html__( 'Social Media Color' , 'moon-shop' ) ,

            'transparent' => false ,

            'compiler' => array( '.post-tag-share .post-share a, .post-tag-share .post-share strong' ) ,

        ) ,

        array(

            // Facebook link

            'id' => 'moon-shop-blog-single-social-share-facebook' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Facebook' , 'moon-shop' ) ,

            'default' => true

        ) ,

        array(

            // Twitter link

            'id' => 'moon-shop-blog-single-social-share-twitter' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Twitter' , 'moon-shop' ) ,

            'default' => true

        ) ,

        array(

            // Google Plus link

            'id' => 'moon-shop-blog-single-social-share-google-plus' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Google Plus' , 'moon-shop' ) ,

            'default' => true

        ) ,

        array(

            // Pinterest link

            'id' => 'moon-shop-blog-single-social-share-pinterest' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Pinterest' , 'moon-shop' ) ,

            'default' => true

        ) ,

        array(

            // Tumblr link

            'id' => 'moon-shop-blog-single-social-share-tumblr' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Tumblr' , 'moon-shop' ) ,

            'default' => false

        ) ,

        array(

            // Delicious link

            'id' => 'moon-shop-blog-single-social-share-delicious' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Delicious' , 'moon-shop' ) ,

            'default' => false

        ) ,

        array(

            // RSS link

            'id' => 'moon-shop-blog-single-social-share-rss' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'RSS' , 'moon-shop' ) ,

            'default' => false

        ) ,

    )

) );

/* Sidebar Section */
Redux::setSection( $opt_name , array(

    'title' => esc_html__( 'Sidebar' , 'moon-shop' ) ,

    'id' => 'moon-shop-sidebar-section' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-th-list' ,

    'fields' => array(

        array(

            // Creating Sidebar

            'id' => 'moon-shop-register-sidebar' ,

            'type' => 'multi_text' ,

            'title' => esc_html__( 'Create Sidebar' , 'moon-shop' ) ,

            'desc' => esc_html__( 'Name your sidebar and save changes' , 'moon-shop' ) ,

        ) ,

        array(

            'id' => 'moon-shop-page-sidebar-position' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Page Sidebar Position' , 'moon-shop' ) ,

            'options' => array(

                'no_sidebar' => esc_html__( 'No Sidebar' , 'moon-shop' ) ,

                'left_sidebar' => esc_html__( 'Left Sidebar' , 'moon-shop' ) ,

                'right_sidebar' => esc_html__( 'Right Sidebar' , 'moon-shop' ) ,

            ) ,

            'default' => 'no_sidebar'

        ) ,

        array(

            'id' => 'moon-shop-pages-sidebar' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Page Sidebar' , 'moon-shop' ) ,

            'options' => getSidebars() ,

            'default' => 'right_sidebar'

        ) ,

        array(

            'id' => 'moon-shop-blog-sidebar-position' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Blog Sidebar Position' , 'moon-shop' ) ,

            'options' => array(

                'no_sidebar' => esc_html__( 'No Sidebar' , 'moon-shop' ) ,

                'left_sidebar' => esc_html__( 'Left Sidebar' , 'moon-shop' ) ,

                'right_sidebar' => esc_html__( 'Right Sidebar' , 'moon-shop' ) ,

            ) ,

            'default' => 'no_sidebar'

        ) ,

        array(

            'id' => 'moon-shop-blog-pages-sidebar' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Blog Archive Sidebar' , 'moon-shop' ) ,

            'options' => getSidebars() ,

            'default' => 'right_sidebar'

        ) ,

        array(

            'id' => 'moon-shop-blog-single-page-sidebar' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Blog Single Post Sidebar Position' , 'moon-shop' ) ,

            'options' => array(

                'no_sidebar' => esc_html__( 'No Sidebar' , 'moon-shop' ) ,

                'left_sidebar' => esc_html__( 'Left Sidebar' , 'moon-shop' ) ,

                'right_sidebar' => esc_html__( 'Right Sidebar' , 'moon-shop' ) ,

            ) ,

            'default' => 'no_sidebar'

        ) ,

        array(

            'id' => 'moon-shop-blog-single-page-sidebar-load' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Blog Single Post Sidebar' , 'moon-shop' ) ,

            'options' => getSidebars() ,

            'default' => 'right_sidebar'

        ) ,

        array(

            'id' => 'moon-shop-sidebar-title-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Widget Title' , 'moon-shop' ) ,

            'compiler' => array( 'h5.wl-standard-marginbottom' ) ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

        ) ,

        array(

            'id' => 'moon-shop-sidebar-content-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Widget Content' , 'moon-shop' ) ,

            'compiler' => array( '.wl-sidebar-items, .wl-sidebar-items p, .wl-sidebar-items a, .wl-sidebar-items ul li' ) ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

        ) ,

    )

) );

/* Footer Section */
Redux::setSection( $opt_name , array(

    'title' => esc_html__( 'Footer Section' , 'moon-shop' ) ,

    'id' => 'moon-shop-footer-section' ,

    'customizer_width' => '400px' ,

    'icon' => 'el el-website-alt' ,

    'fields' => array(

        array(

            // Footer widget column number

            'id' => 'moon-shop-footer-widget-column-select' ,

            'type' => 'select' ,

            'title' => esc_html__( 'Select Footer Widget Column' , 'moon-shop' ) ,

            'default' => 'col-four' ,

            'options' => array(

                'col-one' => esc_html__( 'Column One' , 'moon-shop' ) ,

                'col-two' => esc_html__( 'Column Two' , 'moon-shop' ) ,

                'col-three' => esc_html__( 'Column Three' , 'moon-shop' ) ,

                'col-four' => esc_html__( 'Column Four' , 'moon-shop' ) ,

            )

        ) ,

        array(

            // Footer widget background color

            'id' => 'moon-shop-footer-widget-background-color' ,

            'type' => 'background' ,

            'compiler' => array( '.footer-top' ) ,

            'title' => esc_html__( 'Widget Background Color' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => false ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'preview_height' => '50px' ,

        ) ,

        array(

            // footer widget title color

            'id' => 'moon-shop-footer-widget-title-color' ,

            'type' => 'color' ,

            'compiler' => array( '.footer-top h3' ) ,

            'title' => esc_html__( 'Widget Text Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array(

            // footer widget text color

            'id' => 'moon-shop-footer-widget-text-color' ,

            'type' => 'color' ,

            'compiler' => array( '.footer-top p, .footer-top span, .footer-top strong, .footer-top th, .footer-top td, .footer-top caption' ) ,

            'title' => esc_html__( 'Widget Text Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array(

            // footer widget link color

            'id' => 'moon-shop-footer-widget-link-color' ,

            'type' => 'color' ,

            'compiler' => array( '.footer-top a' ) ,

            'title' => esc_html__( 'Widget Link Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array(

            // footer widget hover text color

            'id' => 'moon-shop-footer-widget-text-hover-color' ,

            'type' => 'color' ,

            'compiler' => array( '.footer-top a:hover' ) ,

            'title' => esc_html__( 'Widget Hover Text Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array( // footer widget hover text color
            'id' => 'moon-shop-footer-copyright-text' , 
            'type' => 'textarea' , 
            'title' => esc_html__( 'Copyright Text' , 'moon-shop' ) , 
            'default' => esc_html__( 'Copyright &copy; 2018. Onaz' , 'moon-shop' ) , 
            'allowed_html' => array( 
                'a' => array( 'href' => array() , 
                    'title' => array() ) , 
                'br' => array() , 
                'em' => array() , 
                'strong' => array() ) ) ,

        array(

            // Copyright background color

            'id' => 'moon-shop-footer-copyright-background-color' ,

            'type' => 'background' ,

            'compiler' => array( '.footer-bottom' ) ,

            'title' => esc_html__( 'Copyright Background Color' , 'moon-shop' ) ,

            'background-position' => false ,

            'background-image' => false ,

            'background-size' => false ,

            'transparent' => false ,

            'background-repeat' => false ,

            'background-attachment' => false ,

            'preview_height' => '50px' ,

        ) ,

        array(

            'id' => 'moon-shop-copyright-text-typograpy' ,

            'type' => 'typography' ,

            'title' => esc_html__( 'Copyright Typography' , 'moon-shop' ) ,

            'compiler' => array( '.footer-bottom .copyright p, .footer-bottom .copyright p a' ) ,

            'all_styles' => true ,

            'google' => true ,

            'font-backup' => true ,

            'letter-spacing' => true ,

            'word-spacing' => true ,

            'text-transform' => true ,

        ) ,

        array(

            // copyright link color

            'id' => 'moon-shop-copyright-link-color' ,

            'type' => 'color' ,

            'compiler' => array( '.footer-bottom .copyright p a' ) ,

            'title' => esc_html__( 'Copyright Link Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array(

            // copyright link hover color

            'id' => 'moon-shop-copyright-text-hover-color' ,

            'type' => 'color' ,

            'compiler' => array( '.footer-bottom .copyright p a:hover' ) ,

            'title' => esc_html__( 'Copyright Text Hover Color' , 'moon-shop' ) ,

            'transparent' => false ,

        ) ,

        array(

            // upload payment image

            'id' => 'moon-shop-footer-payment-image' ,

            'type' => 'media' ,

            'title' => esc_html__( 'Upload Payment Image' , 'moon-shop' ) ,

            'url' => true ,

        ) ,

    )

) );

/* General Option Section */
Redux::setSection( $opt_name , array(
    'title' => esc_html__( 'General Option' , 'moon-shop' ) ,
    'id' => 'moon-shop-general-option-section' ,
    'customizer_width' => '400px' ,
    'icon' => 'el el-cog' ,
    'fields' => array(
        array(
            'id' => 'moon-shop-redux-style-on-off' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Dynamic Style On/OFF' , 'moon-shop' ) ,
            'default' => true ,
        ) ,
		array(
            'id' => 'moon-shop-rtl-on-off' ,
            'type' => 'switch' ,
            'title' => esc_html__( 'Create RTL Site' , 'moon-shop' ) ,
            'default' => false ,
        ) ,
        array(

            // Breadcrumb on/off

            'id' => 'moon-shop-breadcrumb-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Breadcrumb Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // Go to top on/off

            'id' => 'moon-shop-go-to-top-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Go to Top Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

        array(

            // page comments on/off

            'id' => 'moon-shop-page-comments-enable-disable' ,

            'type' => 'switch' ,

            'title' => esc_html__( 'Page Comments Enable/Disable' , 'moon-shop' ) ,

            'default' => true ,

        ) ,

    )

) );

// Function To Get All Registered Sidebars
function getSidebars() {
    $registeredSidebars = get_option( 'moon_shop' );
    $moon_shop_sidebar = array();
    $moon_shop_sidebar[ 'right_sidebar' ] = esc_html__( 'Right Sidebar' , 'moon-shop' );
    $moon_shop_sidebar[ 'left_sidebar' ] = esc_html__( 'Left Sidebar' , 'moon-shop' );
    if( isset( $registeredSidebars[ 'moon-shop-register-sidebar' ] ) ) {
        if( !empty( $registeredSidebars[ 'moon-shop-register-sidebar' ] ) ) {
            foreach( $registeredSidebars[ 'moon-shop-register-sidebar' ] as $moon_shop_sidebars ) {
                $moon_shop_sidebar[ str_replace( 'No Sidebar' , '_' , strtolower( $moon_shop_sidebars ) ) ] = $moon_shop_sidebars;
            }
        }
    }
    return $moon_shop_sidebar;
}

function moon_shop_product_attribute() {
    $moon_product_attributes = array();
    if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
        $moon_product_attributes = wc_get_attribute_taxonomies();
    }
    $moon_product_attribute[''] = esc_html__( 'Select', 'moon-shop' );
    foreach($moon_product_attributes as $key => $value) {
        $moon_product_attribute['pa_'.$value->attribute_name] = $value->attribute_name;
    }
    return $moon_product_attribute;
}

/*

     * <--- END SECTIONS

     */

/*

     *

     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.

     *

     */

/*

    *

    * --> Action hook examples

    *

    */

// If Redux is running as a plugin, this will remove the demo notice and links

//add_action( 'redux/loaded', 'remove_demo' );

// Function to test the compiler hook and demo CSS output.

// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

add_filter( 'redux/options/' . $opt_name . '/compiler' , 'compiler_action' , 10 , 3 );

// Change the arguments after they've been declared, but before the panel is created

//add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

// Change the default value of a field after it's been set, but before it's been useds

//add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

// Dynamically add a section. Can be also used to modify sections/fields

//add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

/**
 * This is a test function that will let you see when the compiler hook occurs.
 * It only runs if a field    set with compiler=>true is changed.
 * */

if( !function_exists( 'compiler_action' ) ) {

    function compiler_action( $options , $css , $changed_values ) {

        global $wp_filesystem;

        $filename = get_theme_file_path('/base/redux/dynamic.css');

        if( empty( $wp_filesystem ) ) {
            get_template_part( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
        }

        if( $wp_filesystem ) {
            $wp_filesystem->put_contents(
                $filename ,
                $css ,
                FS_CHMOD_FILE // predefined mode settings for WP files
            );
        }
    }
}

/**
 * Custom function for the callback validation referenced above
 **/

if( !function_exists( 'redux_validate_callback_function' ) ) {

    function redux_validate_callback_function( $field , $value , $existing_value ) {
        $error = false;
        $warning = false;

        //do your validation
        if( $value == 1 ) {
            $error = true;
            $value = $existing_value;
        } elseif( $value == 2 ) {
            $warning = true;
            $value = $existing_value;
        }

        $return[ 'value' ] = $value;

        if( $error == true ) {
            $return[ 'error' ] = $field;
            $field[ 'msg' ] = esc_html__( 'your custom error message' , 'moon-shop' );
        }

        if( $warning == true ) {
            $return[ 'warning' ] = $field;
            $field[ 'msg' ] = esc_html__( 'your custom warning message' , 'moon-shop' );
        }
        return $return;
    }
}

/**
 * Custom function for the callback referenced above
 */

if( !function_exists( 'redux_my_custom_field' ) ) {

    function redux_my_custom_field( $field , $value ) {

        print_r( $field );

        echo '<br/>';

        print_r( $value );

    }

}

/**
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 * */

if( !function_exists( 'dynamic_section' ) ) {

    function dynamic_section( $sections ) {

        //$sections = array();

        $sections[ ] = array(

            'title' => esc_html__( 'Section via hook' , 'moon-shop' ) ,

            'desc' => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>' , 'moon-shop' ) ,

            'icon' => 'el el-paper-clip' ,

            // Leave this as a blank section, no options just some intro text set above.

            'fields' => array()

        );

        return $sections;

    }

}

/**
 * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
 * */

if( !function_exists( 'change_arguments' ) ) {

    function change_arguments( $moon_shop_args ) {

        //$moon_shop_args['dev_mode'] = true;

        return $moon_shop_args;

    }

}

/**
 * Filter hook for filtering the default value of any given field. Very useful in development mode.
 * */

if( !function_exists( 'change_defaults' ) ) {

    function change_defaults( $moon_shop_defaults ) {

        $moon_shop_defaults[ 'str_replace' ] = esc_html__( 'Testing filter hook!' , 'moon-shop' );

        return $moon_shop_defaults;

    }

}

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */

// if( !function_exists( 'remove_demo' ) ) {
//     function remove_demo() {
//         // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
//         if( class_exists( 'ReduxFrameworkPlugin' ) ) {
//             remove_filter( 'plugin_row_meta' , array(
//                 ReduxFrameworkPlugin::instance() ,
//                 'plugin_metalinks'
//             ) , null , 2 );
//             // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
//             remove_action( 'admin_notices' , array( ReduxFrameworkPlugin::instance() , 'admin_notices' ) );
//         }
//     }
// }

add_action( 'redux/options/w_studio/settings/change' , 'testingReduxAction' );

function testingReduxAction() {

    flush_rewrite_rules();

}