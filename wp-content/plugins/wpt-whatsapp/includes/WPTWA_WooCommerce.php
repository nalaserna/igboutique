<?php

class WPTWA_WooCommerce {
	
	public function __construct () {
		
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', array( $this, 'addMetaBoxes' ) );
			add_action( 'save_post', array( $this, 'saveMetaBoxes' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueueScripts' ) );
		}
		else {
			add_action( 'woocommerce_before_add_to_cart_form', array( $this, 'showBeforeATC' ) );
			add_action( 'woocommerce_after_add_to_cart_form', array( $this, 'showAfterATC' ) );
			
			if ( 'after_description' === WPTWA_Utils::getSetting( 'wc_button_position' ) ) {
				add_filter( 'woocommerce_short_description', array( $this, 'showAfterShortDescription' ), 10, 1 );
			}
		}
		
	}
	
	public function showBeforeATC () {
		
		if ( 'above' !== WPTWA_Utils::getSetting( 'wc_button_position' ) || 'on' == get_post_meta( get_the_ID(), 'wptwa_remove_button', true ) ) {
			return;
		}
		echo $this->showButton();
	}
	
	public function showAfterATC () {
		
		if ( 'below' !== WPTWA_Utils::getSetting( 'wc_button_position' ) || 'on' == get_post_meta( get_the_ID(), 'wptwa_remove_button', true ) ) {
			return;
		}
		echo $this->showButton();
	}
	
	public function showAfterShortDescription ( $post_excerpt ) {
		
		if ( 'after_description' !== WPTWA_Utils::getSetting( 'wc_button_position' ) 
				|| 'on' == get_post_meta( get_the_ID(), 'wptwa_remove_button', true ) 
				|| ! is_single()
			) {
			return $post_excerpt;
		}
		return $post_excerpt . $this->showButton();
	}
	
	private function showButton () {
		
		$number = preg_replace( '/[^0-9]/', '', WPTWA_Utils::getSetting( 'wc_account_number' ) );
		if ( '' != trim( get_post_meta( get_the_ID(), 'wptwa_account_number', true ) ) ) {
			$number = preg_replace( '/[^0-9]/', '', get_post_meta( get_the_ID(), 'wptwa_account_number', true ) );
		}
		
		if ( '' === $number ) {
			return;
		}
		
		$product_title = get_the_title( get_the_ID() );
		
		/* Text label */
		$text_label = '' !== trim( WPTWA_Utils::getSetting( 'wc_button_text_label' ) ) ? esc_attr( WPTWA_Utils::getSetting( 'wc_button_text_label' ) ) : '';
		if ( '' != trim( get_post_meta( get_the_ID(), 'wptwa_text_label', true ) ) ) {
			$text_label = get_post_meta( get_the_ID(), 'wptwa_text_label', true );
		}
		$text_label = str_ireplace( '[product_title]', $product_title, $text_label );
		
		/* Auto text */
		$auto_text = '' !== trim( WPTWA_Utils::getSetting( 'wc_button_auto_text' ) ) ? esc_attr( WPTWA_Utils::getSetting( 'wc_button_auto_text' ) ) : '';
		if ( '' != trim( get_post_meta( get_the_ID(), 'wptwa_auto_text', true ) ) ) {
			$auto_text = get_post_meta( get_the_ID(), 'wptwa_auto_text', true );
		}
		$auto_text = str_ireplace( '[product_title]', $product_title, $auto_text );
		
		/*---*/
		
		$href = 'https://api.whatsapp.com/send?phone=' . $number . ( '' !== $auto_text ? '&text=' . $auto_text : '' );
		$fa = '<svg class="WhatsApp" width="15px" height="15px" viewBox="0 0 90 90"><use xlink:href="#wptwa-logo"></svg>';
		
		return wpautop('<a class="wptwa-account whatsapp-custom-styled wptwa-wc-button" href="' . $href . '" data-number="' . $number . '" data-auto-text="' . $auto_text . '" target="_blank">' . $fa . ( '' !== $text_label ? '<span>' . $text_label . '</span>' : '' ) . '</a>');
	}
	
	public function addMetaBoxes () {
		
		add_meta_box(
			'wptwa_wc_button',
			esc_html( 'WhatsApp Contact Button', 'wptwa' ),
			array( $this, 'showMetaBox' ),
			array( 'product' )
		);
		
	}
	
	public function hasDefaults () {
		if ( '' === trim( WPTWA_Utils::getSetting( 'wc_account_number' ) ) ) {
			return false;
		}
		return true;
	}
	
	public function showMetaBox ( $post ) {
		
		?>
		<p class="description"><?php esc_html_e( 'You can set a custom WhatsApp button for this product. Leave the following fields blank if you wish to use the default values.', 'wptwa' ); ?></p>
		<table class="form-table">
			<tbody>
				<tr>
					<th><?php esc_html_e( 'Remove Button', 'wptwa' ); ?></th>
					<td>
						<input type="checkbox" name="wptwa_remove_button" id="wptwa_remove_button" value="on" <?php echo 'on' === strtolower( get_post_meta( $post->ID, 'wptwa_remove_button', true ) ) ? 'checked' : ''; ?> /> <label for="wptwa_remove_button"><?php esc_html_e( 'Remove WhatsApp button for this product', 'wptwa' ); ?></label>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="form-table" id="wptwa-custom-wc-button-settings">
			<tbody>
				<tr>
					<th><label for="wptwa_account_number"><?php esc_html_e( 'WhatsApp Number', 'wptwa' ); ?></label></th>
					<td>
						<p>
							<input type="text" class="widefat" id="wptwa_account_number" name="wptwa_account_number" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wptwa_account_number', true ) ); ?>" />
							
							<?php if ( $this->hasDefaults() ) : ?>
								<p class="description"><?php esc_html_e( 'Default:', 'wptwa' ); ?> <a href="admin.php?page=wptwa_settings#wc-button-settings" target="_blank"><?php echo WPTWA_Utils::getSetting( 'wc_account_number' ); ?></a></p>
							<?php endif; ?>
						</p>
					</td>
				</tr>
				<tr>
					<th><label for="wptwa_text_label"><?php esc_html_e( 'Button Text Label', 'wptwa' ); ?></label></th>
					<td>
						<p>
							<input type="text" class="widefat" id="wptwa_text_label" name="wptwa_text_label" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wptwa_text_label', true ) ); ?>" />
							<?php if ( $this->hasDefaults() ) : ?>
								<p class="description"><?php esc_html_e( 'Default:', 'wptwa' ); ?> <a href="admin.php?page=wptwa_settings#wc-button-settings" target="_blank"><?php echo WPTWA_Utils::getSetting( 'wc_button_text_label' ); ?></a></p>
							<?php endif; ?>
						</p>
					</td>
				</tr>
				<tr>
					<th><label for="wptwa_auto_text"><?php esc_html_e( 'Button Auto Text', 'wptwa' ); ?></label></th>
					<td>
						<p>
							<input type="text" class="widefat" id="wptwa_auto_text" name="wptwa_auto_text" value="<?php echo esc_attr( get_post_meta( $post->ID, 'wptwa_auto_text', true ) ); ?>" />
							<?php if ( $this->hasDefaults() ) : ?>
								<p class="description"><?php esc_html_e( 'Default:', 'wptwa' ); ?> <a href="admin.php?page=wptwa_settings#wc-button-settings" target="_blank"><?php echo WPTWA_Utils::getSetting( 'wc_button_auto_text' ); ?></a></p>
							<?php endif; ?>
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php
		
		wp_nonce_field( 'wptwa_wc_meta_box', 'wptwa_wc_meta_box_nonce' );
		
	}
	
	public function saveMetaBoxes ( $post_id ) {
		
		/* Check if our nonce is set. */
		if ( ! isset( $_POST['wptwa_wc_meta_box_nonce'] ) ) {
			return;
		}
		
		$nonce = $_POST['wptwa_wc_meta_box_nonce'];
		
		/* Verify that the nonce is valid. */
		if ( ! wp_verify_nonce( $nonce, 'wptwa_wc_meta_box' ) ) {
			return;
		}
		
		$remove_button = isset( $_POST['wptwa_remove_button'] ) ? 'on' : 'off';
		$account_number = isset( $_POST['wptwa_account_number'] ) ? sanitize_text_field( trim( $_POST['wptwa_account_number'] ) ) : '';
		$text_label = isset( $_POST['wptwa_text_label'] ) ? sanitize_text_field( trim( $_POST['wptwa_text_label'] ) ) : '';
		$auto_text = isset( $_POST['wptwa_auto_text'] ) ? sanitize_text_field( trim( $_POST['wptwa_auto_text'] ) ) : '';
		
		update_post_meta( $post_id, 'wptwa_remove_button', $remove_button);
		update_post_meta( $post_id, 'wptwa_account_number', $account_number);
		update_post_meta( $post_id, 'wptwa_text_label', $text_label);
		update_post_meta( $post_id, 'wptwa_auto_text', $auto_text);
		
	}
	
	public function adminEnqueueScripts ( $hook ) {
		
		if ( 'post.php' != $hook || 'product' != get_current_screen()->post_type ) {
			return;
		}
		wp_enqueue_script( 'wptwa-public', WPTWA_PLUGIN_URL . 'assets/js/admin.js', array( 'jquery' ), false, true );
	}
	
}

?>