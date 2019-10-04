<?php

$theme = new Moon_Shop();
$theme->MOON_SHOP_init();

Class Moon_Shop {
    /**
     * Defining Necessary Constants
     */
    function moon_shop_loadConstants() {
        /* Define Constants */
        define( "MOON_SHOP_THEME_DIR" , get_template_directory() );
        define( "MOON_SHOP_THEME_DIR_URI" , get_template_directory_uri() );
        define( "MOON_SHOP_THEME_ASSETS" , MOON_SHOP_THEME_DIR_URI . "/assets" );
        define( "MOON_SHOP_THEME_ASSETS_CSS" , MOON_SHOP_THEME_ASSETS . "/css" );
        define( "MOON_SHOP_THEME_ASSETS_JS" , MOON_SHOP_THEME_ASSETS . "/js" );
        define( "MOON_SHOP_THEME_ASSETS_IMAGE" , MOON_SHOP_THEME_ASSETS . "/images" );
    }

    /**
     * Loading Necessary Scripts & Style Sheets
     */
    function moon_shop_loadScripts() {
        /* Enqueue Style Sheets & Scripts */
        require_once MOON_SHOP_THEME_DIR . '/base/load-scripts.php';
    }

    //ajax loader
    function moon_shop_AjaxResponder() {
        require_once MOON_SHOP_THEME_DIR . '/base/ajax/ajax-loader.php';
        require_once MOON_SHOP_THEME_DIR . '/base/ajax/ajax-loader-single-product.php';
        require_once MOON_SHOP_THEME_DIR . '/base/ajax/ajax-loader-post.php';
    }

    /**
     * Setting Theme Necessary Components
     */
    function moon_shop_afterThemeSetup() {

        if( !isset( $content_width ) ) $content_width = 900;

        /* Things to do after theme setup */
        // Make sure featured images are enabled
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-background' );
        add_theme_support( 'custom-header' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'editor-style' );
        add_theme_support( 'post-formats' );
        add_theme_support( 'custom-logo' );
        add_theme_support( 'html5' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'woocommerce' );

        // Support wide images in the editor
        add_theme_support( 'align-wide' );
        add_theme_support( 'gutenberg', array( 'wide-images' => true ) );

        // Increase JPEG quality from the default 82
        add_filter( 'jpeg_quality', function( $arg ) { return 90; } );


        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );


        add_post_type_support( 'post_type' , 'woosidebars' );
        /* Post Format Support */
        add_theme_support( 'post-formats' , array( 'aside' , 'gallery' , 'link' , 'image' , 'quote' , 'status' , 'video' , 'audio' , 'chat' ) );

        /* Custom Logo Support */
        add_theme_support( 'custom-logo' , array( 'height' => 100 , 'width' => 400 , 'flex-height' => true , 'flex-width' => true , 'header-text' => array( 'site-title' , 'site-description' ) , ) );

        // Add featured image sizes
        add_image_size( 'moon_shop_image_60x60', 60, 60, array('center', 'top'));
        add_image_size( 'moon_shop_image_170x82', 170, 82, array('center', 'top'));
        add_image_size( 'moon_shop_image_114x110', 114, 110, array('center', 'top'));
        add_image_size( 'moon_shop_image_270x267', 270, 267, array('center','top'));
        add_image_size( 'moon_shop_image_270x278', 270, 278, array('center','top' ));
        add_image_size( 'moon_shop_image_270x370', 270, 370, array('center', 'top'));
        add_image_size( 'moon_shop_image_270x370', 270, 370, array('center','top' ));
        add_image_size( 'moon_shop_image_570x570', 570, 570, array('center', 'top'));
        add_image_size( 'moon_shop_image_1170x878', 1170, 878, array('center', 'top'));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'assets/css/editor-style.css' , '' ) );
    }

    /**
     * Function To Load Language Contents
     */
    function moon_shop_loadLanguages() {
        /* Loading Text Domain For Languages */
        load_theme_textdomain( 'moon-shop' , get_stylesheet_directory() . '/languages' );
        $locale = get_locale();
	    $locale_file = get_template_directory() . "/languages/$locale.php";

	    if ( is_readable( $locale_file ) ) {
	        require_once( $locale_file );
	    }
    }

    /**
     * Function To Load TGMPA
     */
    public function moon_shop_loadTgmpa() {

        require_once MOON_SHOP_THEME_DIR . '/base/tgmpa/config.php';
    }

    /**
     * Loading Theme Options Config File For Redux
     */
    function moon_shop_loadThemeOptions() {

        /* Load Redux Config */
        require_once MOON_SHOP_THEME_DIR . '/base/redux/config.php';
    }

    /**
     * Loading Custom Metaboxes Necessary For Out Theme
     */
    function moon_shop_loadMetaboxes() {

        /* Load Metaboxes For Pages */
        require_once MOON_SHOP_THEME_DIR . '/base/metaboxes/page-metabox.php';
        require_once MOON_SHOP_THEME_DIR . '/base/metaboxes/album-metabox.php';
    }

    function moon_shop_woocommerce() {
        /* woocommerce */
        require_once MOON_SHOP_THEME_DIR . '/base/woocommerce-functions.php';
    }

    /**
     * Function For Registering Sidebars
     */
    function moon_shop_loadSidebars() {

        /* Registering Sidebar */
        require_once MOON_SHOP_THEME_DIR . '/base/sidebars.php';
    }

    /**
     * Loading Menu For Front End & For Back End Menu Page
     */
    function moon_shop_loadMenus() {

        /* Register Nav Menu */
        if( is_admin() ) {
            // Load Meaga Menu Option
            require_once MOON_SHOP_THEME_DIR . '/base/views/header/mega-menu.php';
        } else {
            require_once MOON_SHOP_THEME_DIR . '/base/views/header/display-menu.php';
        }

        // Registering Menus
        register_nav_menu( 'main-menu' , esc_html__( 'Main Menu' , 'moon-shop' ) );
        register_nav_menu( 'top-menu' , esc_html__( 'Top Menu' , 'moon-shop' ) );
    }

    /*******************************************************
     * Initializer Method Runs When Theme Is Loaded
     *******************************************************/
    public function moon_shop_init() {
        $this->moon_shop_loadConstants();
        $this->moon_shop_loadScripts();
        $this->moon_shop_loadMenus();
        $this->moon_shop_loadTgmpa();
        $this->moon_shop_loadThemeOptions();
        $this->moon_shop_woocommerce();
        $this->moon_shop_AjaxResponder();

        add_action( 'wp_head', array( &$this, 'moon_shop_header_css' ), 9999 );

        add_action( 'after_setup_theme' , array( &$this , 'moon_shop_loadLanguages' ) );

        /* Loading Functionalities After Theme Setup */
        add_action( 'after_setup_theme' , array( &$this , 'moon_shop_afterThemeSetup' ) );

        /* Loading Widgets */
        add_action( 'widgets_init' , array( &$this , 'moon_shop_loadSidebars' ) );
        add_filter( 'excerpt_length' , array( &$this , 'moon_shop_customExcerptLength' ) );
    }

    public static function moon_shop_header_css( $output = NULL ) {

        get_template_part('base/redux/theme-color');
                
        // Add filter for adding custom css via other functions
        $output = apply_filters( 'moon_shop_head_css', $output );

        echo "<!-- Theme Color CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( moon_shop_minify_css( $output ) ) . "\n</style>";
    }

    /**
     * Filter the except moon_shop_length to 20 characters.
     * @param int $moon_shop_length Excerpt w_studio_length.
     * @return int (Maybe) modified excerpt w_studio_length.
     */
    function moon_shop_customExcerptLength( $moon_shop_length ) {

        $moon_shop_length = 30;

        return $moon_shop_length;
    }
}

if ( ! function_exists( 'moon_shop_minify_css' ) ) {
    function moon_shop_minify_css( $css = '' ) {

        // Return if no CSS
        if ( ! $css ) return;

        // Normalize whitespace
        $css = preg_replace( '/\s+/', ' ', $css );

        // Remove ; before }
        $css = preg_replace( '/;(?=\s*})/', '', $css );

        // Remove space after , : ; { } */ >
        $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

        // Remove space before , ; { }
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

        // Strips leading 0 on decimal values (converts 0.5px into .5px)
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

        // Strips units if value is 0 (converts 0px to 0)
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        // Trim
        $css = trim( $css );

        // Return minified CSS
        return $css;    
    }
}

/**
 * Comments form submit button
 */
function moon_shop_comment_button() {
    echo '<div class="input-box"><input name="submit" type="submit" value="' . __( 'Comment' , 'moon-shop' ) . '" /></div>';
}

add_action( 'comment_form' , 'moon_shop_comment_button' );

/**
 * Comments form return
 */
function moon_shop_comments_form( $fields ) {
    $comment_field = $fields[ 'comment' ];
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields' , 'moon_shop_comments_form' );

$moon_shop_args_left = array( 'name' => esc_html__( 'Woocommerce sidebar' , 'moon-shop' ) , 'id' => 'woo_sidebar' , 'before_widget' => '<div id="%1$s" class="wl-sidebar-items %2$s">' , 'after_widget' => '</div>' , 'before_title' => '<h5 class="wl-standard-marginbottom">' , 'after_title' => '</h5>' );
/* Registering Left Sidebar */
register_sidebar( $moon_shop_args_left );

/**
 * mailchimp form add custom class
 */
add_filter( 'mc4wp_form_css_classes' , 'moon_shop_mc4wp_form_css_classes' );
function moon_shop_mc4wp_form_css_classes ( $classes ) {
    $classes[ ] = 'subscribe-form';
    return $classes;
}

/**
 * custom Logo add class
 */

add_filter( 'get_custom_logo' , 'moon_shop_change_logo_class' );
function moon_shop_change_logo_class( $html ) {
    $html = str_replace( 'custom-logo' , 'moon-shop-main-logo' , $html );
    return $html;
}

/**
 * Adds custom classes to the array of body classes.
 * @param array $classes Classes for the body element.
 * @return array
 */
add_filter( 'body_class' , 'moon_shop_body_classes' );
function moon_shop_body_classes( $classes ) {
    $classes[ ] = 'no-js';
    return $classes;
}

/**
 * Redux Active demo mode disable
 */
function moon_shop_removeDemoModeLink() {
    if ( class_exists('Vc_Manager') ) {
        vc_disable_frontend();
    }
}
add_action('init', 'moon_shop_removeDemoModeLink');

if(!function_exists('fnn_hex2RGB')) {
    function fnn_hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
        $rgbArray = array();
        if (strlen($hexStr) == 6) {
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3) {
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false;
        }
        return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
    }
}

require_once MOON_SHOP_THEME_DIR . '/base/functions.php';