<?php

class WPTWA_Scripts_And_Styles {
	
	public function __construct () {
		
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
		}
		
	}
	
	/**
	 * Enqueue scripts and styles only for our plugin.
	 */
	public function adminEnqueueScripts ( $hook ) {
		
		global $pagenow;
		
		if ( 'admin.php' === $pagenow && isset( $_GET['page'] ) && WPTWA_PREFIX . '_settings' === $_GET['page'] ) {
			
			wp_enqueue_media();
			
			wp_enqueue_style( 'jquery-minicolors', WPTWA_PLUGIN_URL . 'assets/css/jquery-minicolors.css' );
			wp_enqueue_style( 'wptwa-admin', WPTWA_PLUGIN_URL . 'assets/css/admin.css' );
			
			wp_enqueue_script( 'jquery-minicolors', WPTWA_PLUGIN_URL . 'assets/js/vendor/jquery.minicolors.min.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wptwa-admin', WPTWA_PLUGIN_URL . 'assets/js/admin.js', array( 'jquery' ), false, true );
		}
		
	}
	
}

?>