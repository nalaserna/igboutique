<?php

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( isset( $_POST['wptwa_settings'] ) ) {
	
	$legit = true;
	
	/* Check if our nonce is set. */
	if ( ! isset( $_POST['wptwa_settings_form_nonce'] ) ) {
		$legit = false;
	}
	
	$nonce = $_POST['wptwa_settings_form_nonce'];
	
	/* Verify that the nonce is valid. */
	if ( ! wp_verify_nonce( $nonce, 'wptwa_settings_form' ) ) {
		$legit = false;
	}
	
	/* 	Something is wrong with the nonce. Redirect it to the 
		settings page without processing any data.
		*/
	if ( ! $legit ) {
		wp_redirect( add_query_arg() );
	}
	
	/* Display and load-in settings */
	$toggle_text = isset( $_POST['toggle_text'] ) ? sanitize_text_field( trim( $_POST['toggle_text'] ) ) : '';
	$toggle_text_color = isset( $_POST['toggle_text_color'] ) ? sanitize_text_field( trim( $_POST['toggle_text_color'] ) ) : '';
	$toggle_background_color = isset( $_POST['toggle_background_color'] ) ? sanitize_text_field( trim( $_POST['toggle_background_color'] ) ) : '';
	$toggle_round_on_desktop = isset( $_POST['toggle_round_on_desktop'] ) ? 'on' : 'off';
	$toggle_round_on_mobile = isset( $_POST['toggle_round_on_mobile'] ) ? 'on' : 'off';
	$description = isset( $_POST['description'] ) ? esc_textarea( trim( $_POST['description'] ) ) : '';
	$container_text_color = isset( $_POST['container_text_color'] ) ? sanitize_text_field( trim( $_POST['container_text_color'] ) ) : '';
	$container_background_color = isset( $_POST['container_background_color'] ) ? sanitize_text_field( trim( $_POST['container_background_color'] ) ) : '';
	$account_hover_background_color = isset( $_POST['account_hover_background_color'] ) ? sanitize_text_field( trim( $_POST['account_hover_background_color'] ) ) : '';
	$account_hover_text_color = isset( $_POST['account_hover_text_color'] ) ? sanitize_text_field( trim( $_POST['account_hover_text_color'] ) ) : '';
	$border_color_between_accounts = isset( $_POST['border_color_between_accounts'] ) ? sanitize_text_field( trim( $_POST['border_color_between_accounts'] ) ) : '';
	$container_max_width = isset( $_POST['container_max_width'] ) ? sanitize_text_field( trim( $_POST['container_max_width'] ) ) : '';
	$box_position = isset( $_POST['box_position'] ) ? sanitize_text_field( trim( $_POST['box_position'] ) ) : '';
	$hide_on_large_screen = isset( $_POST['hide_on_large_screen'] ) ? 'on' : 'off';
	$hide_on_small_screen = isset( $_POST['hide_on_small_screen'] ) ? 'on' : 'off';
	$delay_time = isset( $_POST['delay_time'] ) ? sanitize_text_field( trim( $_POST['delay_time'] ) ) : '';
	$inactivity_time = isset( $_POST['inactivity_time'] ) ? sanitize_text_field( trim( $_POST['inactivity_time'] ) ) : '';
	$scroll_length = isset( $_POST['scroll_length'] ) ? sanitize_text_field( trim( $_POST['scroll_length'] ) ) : '';
	$auto_display_on_mobile = isset( $_POST['auto_display_on_mobile'] ) ? 'on' : 'off';
	
	$wc_account_number = isset( $_POST['wc_account_number'] ) ? sanitize_text_field( trim( $_POST['wc_account_number'] ) ) : '';
	$wc_button_text_label = isset( $_POST['wc_button_text_label'] ) ? sanitize_text_field( trim( $_POST['wc_button_text_label'] ) ) : '';
	$wc_button_auto_text = isset( $_POST['wc_button_auto_text'] ) ? sanitize_text_field( trim( $_POST['wc_button_auto_text'] ) ) : '';
	$wc_button_position = isset( $_POST['wc_button_position'] ) ? sanitize_text_field( trim( $_POST['wc_button_position'] ) ) : '';
	$wc_button_background_color = isset( $_POST['wc_button_background_color'] ) ? sanitize_text_field( trim( $_POST['wc_button_background_color'] ) ) : '';
	$wc_button_text_color = isset( $_POST['wc_button_text_color'] ) ? sanitize_text_field( trim( $_POST['wc_button_text_color'] ) ) : '';
	$wc_button_background_color_on_hover = isset( $_POST['wc_button_background_color_on_hover'] ) ? sanitize_text_field( trim( $_POST['wc_button_background_color_on_hover'] ) ) : '';
	$wc_button_text_color_on_hover = isset( $_POST['wc_button_text_color_on_hover'] ) ? sanitize_text_field( trim( $_POST['wc_button_text_color_on_hover'] ) ) : '';
	
	WPTWA_Utils::updateSetting( 'toggle_text', $toggle_text );
	WPTWA_Utils::updateSetting( 'toggle_text_color', $toggle_text_color );
	WPTWA_Utils::updateSetting( 'toggle_background_color', $toggle_background_color );
	WPTWA_Utils::updateSetting( 'toggle_round_on_desktop', $toggle_round_on_desktop );
	WPTWA_Utils::updateSetting( 'toggle_round_on_mobile', $toggle_round_on_mobile );
	WPTWA_Utils::updateSetting( 'description', $description );
	WPTWA_Utils::updateSetting( 'container_text_color', $container_text_color );
	WPTWA_Utils::updateSetting( 'container_background_color', $container_background_color );
	WPTWA_Utils::updateSetting( 'account_hover_background_color', $account_hover_background_color );
	WPTWA_Utils::updateSetting( 'account_hover_text_color', $account_hover_text_color );
	WPTWA_Utils::updateSetting( 'border_color_between_accounts', $border_color_between_accounts );
	WPTWA_Utils::updateSetting( 'container_max_width', $container_max_width );
	WPTWA_Utils::updateSetting( 'box_position', $box_position );
	
	WPTWA_Utils::updateSetting( 'hide_on_large_screen', $hide_on_large_screen );
	WPTWA_Utils::updateSetting( 'hide_on_small_screen', $hide_on_small_screen );
	
	WPTWA_Utils::updateSetting( 'delay_time', $delay_time );
	WPTWA_Utils::updateSetting( 'inactivity_time', $inactivity_time );
	WPTWA_Utils::updateSetting( 'scroll_length', $scroll_length );
	WPTWA_Utils::updateSetting( 'auto_display_on_mobile', $auto_display_on_mobile );
	
	WPTWA_Utils::updateSetting( 'wc_account_number', $wc_account_number );
	WPTWA_Utils::updateSetting( 'wc_button_text_label', $wc_button_text_label );
	WPTWA_Utils::updateSetting( 'wc_button_auto_text', $wc_button_auto_text );
	WPTWA_Utils::updateSetting( 'wc_button_position', $wc_button_position );
	WPTWA_Utils::updateSetting( 'wc_button_background_color', $wc_button_background_color );
	WPTWA_Utils::updateSetting( 'wc_button_text_color', $wc_button_text_color );
	WPTWA_Utils::updateSetting( 'wc_button_background_color_on_hover', $wc_button_background_color_on_hover );
	WPTWA_Utils::updateSetting( 'wc_button_text_color_on_hover', $wc_button_text_color_on_hover );
	
	/* WPML if installed and active */
	do_action( 'wpml_register_single_string', 'WhatsApp Click to Chat', 'Toggle Text', $toggle_text );
	do_action( 'wpml_register_single_string', 'WhatsApp Click to Chat', 'Description', $description );
	
	/* Page targeting */
	if ( isset( $_POST['target'] ) ) {
		$t = array();
		foreach ( $_POST['target'] as $value ) {
			$t[] = sanitize_text_field( $value );
		}
		WPTWA_Utils::updateSetting( 'target', json_encode( $t ) );
	}
	else {
		WPTWA_Utils::updateSetting( 'target', json_encode( array() ) );
	}
	
	/* Included pages */
	if ( isset( $_POST['included'] ) ) {
		$ids = array();
		foreach ( $_POST['included'] as $value ) {
			$ids[] = sanitize_text_field( $value );
		}
		WPTWA_Utils::updateSetting( 'included_ids', json_encode( $ids ) );
	}
	else {
		WPTWA_Utils::updateSetting( 'included_ids', json_encode( array() ) );
	}
	
	/* Excluded pages */
	if ( isset( $_POST['excluded'] ) ) {
		$ids = array();
		foreach ( $_POST['excluded'] as $value ) {
			$ids[] = sanitize_text_field( $value );
		}
		WPTWA_Utils::updateSetting( 'excluded_ids', json_encode( $ids ) );
	}
	else {
		WPTWA_Utils::updateSetting( 'excluded_ids', json_encode( array() ) );
	}
	
	/* WhatsApp accounts */
	if ( isset( $_POST['account'] ) ) {
		$acc = array();
		$i = 1;
		foreach ( $_POST['account'] as $k => $v ) {
			
			if ( '' === trim( $v['number'] ) || '' === trim( $v['name'] ) ) {
				continue;
			}
			
			$acc[ $i ][ 'number' ] = esc_attr( $v['number'] );
			$acc[ $i ][ 'name' ] = sanitize_text_field( htmlentities( stripslashes( $v['name'] ) ) );
			$acc[ $i ][ 'title' ] = sanitize_text_field( htmlentities( stripslashes( $v['title'] ) ) );
			$acc[ $i ][ 'picture_url' ] = esc_url( $v['picture_url'] );
			$acc[ $i ][ 'auto_text' ] = sanitize_text_field( htmlentities( stripslashes( $v['auto_text'] ) ) );
			$acc[ $i ][ 'hour_start' ] = esc_attr( $v['hour_start'] );
			$acc[ $i ][ 'minute_start' ] = esc_attr( $v['minute_start'] );
			$acc[ $i ][ 'hour_end' ] = esc_attr( $v['hour_end'] );
			$acc[ $i ][ 'minute_end' ] = esc_attr( $v['minute_end'] );
			
			$acc[ $i ][ 'sunday' ] = isset( $v['sunday'] ) ? 'on' : 'off';
			$acc[ $i ][ 'monday' ] = isset( $v['monday'] ) ? 'on' : 'off';
			$acc[ $i ][ 'tuesday' ] = isset( $v['tuesday'] ) ? 'on' : 'off';
			$acc[ $i ][ 'wednesday' ] = isset( $v['wednesday'] ) ? 'on' : 'off';
			$acc[ $i ][ 'thursday' ] = isset( $v['thursday'] ) ? 'on' : 'off';
			$acc[ $i ][ 'friday' ] = isset( $v['friday'] ) ? 'on' : 'off';
			$acc[ $i ][ 'saturday' ] = isset( $v['saturday'] ) ? 'on' : 'off';
			
			do_action( 'wpml_register_single_string', 'WhatsApp Click to Chat', 'Title for ' . $acc[ $i ][ 'name' ], $acc[ $i ][ 'title' ] );
			do_action( 'wpml_register_single_string', 'WhatsApp Click to Chat', 'Predefined Text for ' . $acc[ $i ][ 'name' ], $acc[ $i ][ 'auto_text' ] );
			
			$i++;
		}
		WPTWA_Utils::updateSetting( 'accounts', json_encode( $acc, JSON_UNESCAPED_UNICODE ) );
	}
	else {
		WPTWA_Utils::updateSetting( 'accounts', json_encode( array() ) );
	}
	
	/* Recreate CSS file */
	WPTWA_Utils::generateCustomCSS();
	
	add_settings_error( 'wptwa-settings', 'wptwa-settings', __( 'Settings saved', 'wptwa' ), 'updated' );
}

WPTWA_Utils::setView( 'settings' );

?>