<?php
/*
Plugin Name: Moon Core Plugin
Plugin URI:  https://www.onaz.io/
Description: Plugin For Moon Theme To Add Additional Functionality
Version:     2.1.0
Author:      Onazio
Author URI:  https://www.onaz.io/
License:     GPLv2 or later
License URI: https://www.onaz.io/
Text Domain: moon-wilylab-plugin
Domain Path: /languages
*/

if( !defined( 'ABSPATH' ) ) {
    die;
}

// Defining WCP Path
if ( !defined( 'MOON_SHOP_PLUGIN' ) )
    define( 'MOON_SHOP_PLUGIN', trim( dirname( plugin_basename( __FILE__ ) ), '/' ) );

// Defining WCP Directory
if ( !defined( 'MOON_SHOP_PLUGIN_DIR' ) )
    define( 'MOON_SHOP_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MOON_SHOP_PLUGIN );

// Defining WCP URL
if ( !defined( 'MOON_SHOP_PLUGIN_URL' ) )
    define( 'MOON_SHOP_PLUGIN_URL', WP_PLUGIN_URL . '/' . MOON_SHOP_PLUGIN );

// Defining WCP Version Key
if ( !defined( 'MOON_SHOP_PLUGIN_KEY' ) )
    define( 'MOON_SHOP_PLUGIN_KEY', 'moon_wl_plugin' );

// Defining WCP Version Number
if ( !defined( 'MOON_SHOP_PLUGIN_VERSION_NUM' ) )
    define( 'MOON_SHOP_PLUGIN_VERSION_NUM', '1.0.0' );

// Registering Text Domain For The Plugin
add_action( 'plugins_loaded', 'moon_shop_plugin_load_textdomain', 0 );

add_action( 'plugins_loaded', 'moon_shop_plugin_widget', 4 );

register_activation_hook( __FILE__, 'moon_shop_plugin_activation' );

register_deactivation_hook( __FILE__, 'moon_shop_plugin_deactivation' );

add_action( 'init', 'moon_shop_plugin_init', 2 );

/*
 * Text Domain Loader 
 * 
 */
function moon_shop_plugin_load_textdomain() {
    
    load_plugin_textdomain( 'moon-shop-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

/*
 * Things to do when plugin is activated 
 * 
 * @param
 * @return
 */
if( !function_exists( 'moon_shop_plugin_activation' ) ) {
    
    function moon_shop_plugin_activation() {
        // Adding Plugin Version Info Into DB
        if( !get_option( MOON_SHOP_PLUGIN_KEY, false ) )
            add_option( MOON_SHOP_PLUGIN_KEY, MOON_SHOP_PLUGIN_VERSION_NUM );
    }
}

/*
 * Things to do when plugin is deactivated
 *
 * @param
 * @return
 */
if( !function_exists( 'moon_shop_plugin_deactivation' ) ) {
    function moon_shop_plugin_deactivation(){
        // Deleting Plugin Version Info From DB
        if( get_option( MOON_SHOP_PLUGIN_KEY, false ) )
            delete_option( MOON_SHOP_PLUGIN_KEY );
    }
}

/*
 * Things To Perform With Init Hook
 * 
 * @param
 * @return
 */
if( !function_exists( 'moon_shop_plugin_init' ) ) {
    function moon_shop_plugin_init() {

        // Load Post Types
        require_once MOON_SHOP_PLUGIN_DIR . '/cpt/cpt.php';
        require_once MOON_SHOP_PLUGIN_DIR . '/cpt/wilypost.php';

        // Load Shortcodes
        require_once MOON_SHOP_PLUGIN_DIR . '/shortcodes/shortcodes.php';

        if( is_admin() ){
            /* Load Metaboxes For Pages */
            require_once MOON_SHOP_PLUGIN_DIR . '/metaboxes/page-metabox.php';
            require_once MOON_SHOP_PLUGIN_DIR . '/metaboxes/album-metabox.php';
            require_once MOON_SHOP_PLUGIN_DIR . '/metaboxes/product-metabox.php';
            require_once MOON_SHOP_PLUGIN_DIR . '/metaboxes/attribute-metabox.php';
        }
    }
}

function moon_shop_plugin_widget() {
    // Load Widgets
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-categories.php';
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-archives.php';
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-meta.php';
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-recent-comments.php';
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-recent-posts.php';
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-search.php';
    require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-tag-cloud.php';
    if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
        require_once MOON_SHOP_PLUGIN_DIR . '/widgets/moon-wl-widget-layered-nav.php';
    }
}

// Load Widgets
//require_once MOON_SHOP_PLUGIN_DIR . '/widgets/widgets-loader.php';

if( is_admin() ) {
    // Load Necessary Scripts For Metaboxes
    //require_once MOON_SHOP_PLUGIN_DIR . '/load-scripts.php';
    
    // Check if Visual Composer is installed
    if ( ! defined( 'WPB_VC_VERSION' ) ) {
        // Things To Do When Visual Compoer Is Not Installed
    } else {
        /* Load VC Addon  */
        require_once MOON_SHOP_PLUGIN_DIR . '/shortcodes/vc-addon.php';
    }
}

if ( class_exists( 'Redux' ) ) {
	/* Load redux demo importer file */
	require_once MOON_SHOP_PLUGIN_DIR . '/loader.php';
}
 add_action( 'admin_enqueue_scripts', 'moon_wl_load_scripts', 10 );
 function moon_wl_load_scripts(){
    wp_register_style( 'shortcode-custom-css', MOON_SHOP_PLUGIN_URL. '/shortcodes/assets/css/moon-vc.css' , array(), '1.0.0', 'all' );
    wp_enqueue_style( 'shortcode-custom-css' );
}

class WPSE_Filter_Storage {
    private $values;

    public function __construct( $values ) {
        $this->values = $values;
    }

    public function __call( $callback, $arguments ) {
        if ( is_callable( $callback ) )
            return call_user_func( $callback, $arguments, $this->values );

        // Wrong function called.
        throw new InvalidArgumentException(
            sprintf( 'File: %1$s<br>Line %2$d<br>Not callable: %3$s',
                __FILE__, __LINE__, print_r( $callback, TRUE )
            )
        );
    }
}