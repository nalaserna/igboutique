<?php

class WPTWA_Activation {
	
	public function __construct () {
		
		if ( is_admin() ) {
			register_activation_hook( WPTWA_PLUGIN_BOOTSTRAP_FILE, array( $this, 'activation' ) );
		}
		
		add_action( 'plugins_loaded', array( $this, 'loadTextDomain' ) );
		
	}
	
	public function activation () {
		
		/* Add options to WordPress specific for WPTWA */
		if ( ! get_option( WPTWA_SETTINGS_NAME ) ) {
			WPTWA_Utils::prepeareSettings();
			WPTWA_Utils::updateSetting( 'toggle_text', esc_html__( 'Chat with us on WhatsApp', 'wptwa' ) );
			WPTWA_Utils::updateSetting( 'toggle_text_color', 'rgba(255, 255, 255, 1)' );
			WPTWA_Utils::updateSetting( 'toggle_background_color', 'rgba(69, 90, 100, .9)' );
			WPTWA_Utils::updateSetting( 'description', esc_html__( 'Hi there! Click one of our representatives below and we will get back to you as soon as possible.', 'wptwa' ) );
			WPTWA_Utils::updateSetting( 'container_text_color', 'rgba(85, 85, 85, 1)' );
			WPTWA_Utils::updateSetting( 'container_background_color', 'rgba(255, 255, 255, 1)' );
			WPTWA_Utils::updateSetting( 'account_hover_background_color', 'rgba(245, 245, 245, 1)' );
			WPTWA_Utils::updateSetting( 'account_hover_text_color', 'rgba(85, 85, 85, 1)' );
			WPTWA_Utils::updateSetting( 'border_color_between_item', 'rgba(245, 245, 245, 1)' );
			WPTWA_Utils::updateSetting( 'container_max_width', '400' );
			WPTWA_Utils::updateSetting( 'box_position', 'right' );
			
			WPTWA_Utils::updateSetting( 'hide_on_large_screen', 'off' );
			WPTWA_Utils::updateSetting( 'hide_on_small_screen', 'off' );
			
			WPTWA_Utils::updateSetting( 'delay_time', '0' );
			WPTWA_Utils::updateSetting( 'inactivity_time', '0' );
			WPTWA_Utils::updateSetting( 'scroll_length', '0' );
			WPTWA_Utils::updateSetting( 'auto_display_on_mobile', 'off' );
			WPTWA_Utils::updateSetting( 'target', json_encode( array( 'home', 'blog', 'archive', 'post', 'page' ) ) );
			
			WPTWA_Utils::updateSetting( 'wc_button_text_label', 'Ask Question via WhatsApp' );
			WPTWA_Utils::updateSetting( 'wc_button_text_label', 'Hi, I have a question about [product_title]' );
			WPTWA_Utils::updateSetting( 'wc_button_background_color', 'rgba(69, 90, 100, .9)' );
			WPTWA_Utils::updateSetting( 'wc_button_text_color', 'rgba(255, 255, 255, 1)' );
			WPTWA_Utils::updateSetting( 'wc_button_background_color_on_hover', 'rgba(69, 90, 100, .9)' );
			WPTWA_Utils::updateSetting( 'wc_button_text_color_on_hover', 'rgba(255, 255, 255, 1)' );
			
			WPTWA_Utils::updateSetting( 'accounts', json_encode( array() ) );
		}
		else {
			WPTWA_Utils::generateCustomCSS();
		}
		
	}
	
	public function loadTextDomain () {
		load_plugin_textdomain( 'wptwa', false, plugin_basename( WPTWA_PLUGIN_DIR ) . '/languages' );
	}
	
}

?>