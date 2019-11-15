<?php

/**
 * This class is meant to bundle miscellaneous functionalities
 */

class WPTWA_Utils {
	
	private static $stateOptionName = WPTWA_SETTINGS_NAME;
	private static $states = array();
	private static $view;
	private static $impressions = array();
	private static $itIsMobileDevice = null;
	
	/**
	 * Setting a vew file to use. This method is used in 
	 * controller files.
	 */
	public static function setView ( $view ) {
		self::$view = $view;
	}
	
	/**
	 * Getting the view file. Used in WPTWA_Menu_Link().
	 */
	public static function getView () {
		
		$view = self::$view;
		
		$path_to_view = WPTWA_PLUGIN_DIR . 'view/' . $view . '.php';
		
		if ( file_exists( $path_to_view ) ) {
			include_once( $path_to_view );
		}
		else {
			if ( ! self::$view ) {
				echo '<p style="color: red;">' . esc_html__( 'Something is wrong: The view is not set yet. Please contact the developer.', 'wptwa' ) . '</p>';
			}
			else {
				echo '<p style="color: red;">' . esc_html__( 'Something is wrong: The view not found. Please contact the developer.', 'wptwa' ) . '</p>';
			}
		}
		
	}
	
	/**
	 * Used only once during plugin activation. Making sure that 
	 * we have the option.
	 */
	public static function prepeareSettings () {
		add_option( self::$stateOptionName );
	}
	
	public static function updateSetting ( $key, $value ) {
		$option = get_option( self::$stateOptionName );
		$data = array();
		
		if ( $option ) {
			$data = json_decode( $option, true );
		}
		$data[ $key ] = $value;
		
		update_option( self::$stateOptionName, json_encode( $data ), true );
	}
	
	public static function getSetting ( $key, $default = '' ) {
		$option = get_option( self::$stateOptionName );
		$data = json_decode( $option, true );
		if ( $data && isset( $data[ $key ] ) ) {
			return stripslashes( $data[ $key ] );
		}
		return $default;
	}
	
	public static function generateCustomCSS () {
		$css = '
.wptwa-container .wptwa-handler,
.wptwa-description {
	background-color: ' . WPTWA_Utils::getSetting( 'toggle_background_color', 'rgba(69, 90, 100, .9)' ) . ';
	color: ' . WPTWA_Utils::getSetting( 'toggle_text_color', '#ffffff' ) . ';
}
.wptwa-container .wptwa-handler svg {
	fill: ' . WPTWA_Utils::getSetting( 'toggle_text_color', '#ffffff' ) . ';
}
.wptwa-container .wptwa-box {
	background-color: ' . WPTWA_Utils::getSetting( 'container_background_color', '#ffffff' ) . ';
	color: ' . WPTWA_Utils::getSetting( 'container_text_color', '#555555' ) . ';
}
.wptwa-container .wptwa-box:before,
.wptwa-container .wptwa-box:after {
	background-color: ' . WPTWA_Utils::getSetting( 'container_background_color', '#ffffff' ) . ';
	border-color: ' . WPTWA_Utils::getSetting( 'container_background_color', '#ffffff' ) . ';
}
.wptwa-container .wptwa-close:before,
.wptwa-container .wptwa-close:after {
	background-color: ' . WPTWA_Utils::getSetting( 'toggle_text_color', '#ffffff' ) . ';
}
.wptwa-container {
	max-width: ' . WPTWA_Utils::getSetting( 'container_max_width', '400' ) . 'px;
}

.wptwa-wc-button {
	background-color: ' . WPTWA_Utils::getSetting( 'wc_button_background_color', 'rgba(69, 90, 100, .9)' ) . ';
	color: ' . WPTWA_Utils::getSetting( 'wc_button_text_color', '#ffffff' ) . ';
}
.wptwa-wc-button svg {
	fill: ' . WPTWA_Utils::getSetting( 'wc_button_text_color', '#ffffff' ) . ';
}
.wptwa-wc-button:hover {
	background-color: ' . WPTWA_Utils::getSetting( 'wc_button_background_color_on_hover', 'rgba(69, 90, 100, .9)' ) . ';
	color: ' . WPTWA_Utils::getSetting( 'wc_button_text_color_on_hover', '#ffffff' ) . ';
}

@media screen and (max-width : ' . WPTWA_Utils::getSetting( 'container_max_width', '400' ) . 'px) {
	.wptwa-container {
		max-width: 100%;
	}
}
.wptwa-container .wptwa-box {
	width: calc(' . WPTWA_Utils::getSetting( 'container_max_width', '400' ) . 'px - 80px);
	max-width: calc(100% - 40px);
}

.wptwa-container .wptwa-account:hover {
	background-color: ' . WPTWA_Utils::getSetting( 'account_hover_background_color', '#f5f5f5' ) . ';
	color: ' . WPTWA_Utils::getSetting( 'account_hover_text_color', '#555555' ) . ';
}
.wptwa-container .wptwa-account:not(:last-child):after {
	background-color: ' . WPTWA_Utils::getSetting( 'border_color_between_accounts', '#f5f5f5' ) . ';
}
.wptwa-container .wptwa-account:hover:after {
	background-color: ' . WPTWA_Utils::getSetting( 'account_hover_background_color', '#f5f5f5' ) . ';
}
	';
	
	if ( 'on' === WPTWA_Utils::getSetting( 'hide_on_large_screen' ) ) {
		$css.= '@media screen and (min-width : 783px) {
			.wptwa-container {
				display: none;
			}
		}';
	}
	
	if ( 'on' === WPTWA_Utils::getSetting( 'hide_on_small_screen' ) ) {
		$css.= '@media screen and (max-width : 782px) {
			.wptwa-container {
				display: none;
			}
		}';
	}
	
	$css_file = WPTWA_PLUGIN_DIR . 'assets/css/auto-generated-wptwa.css';
	file_put_contents( $css_file, trim( $css ) );
	}
	
}

?>