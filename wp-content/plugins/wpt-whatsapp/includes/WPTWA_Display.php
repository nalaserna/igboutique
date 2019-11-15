<?php

/**
 * This class is loaded on the front-end since its main job is 
 * to display the WhatsApp box.
 */

class WPTWA_Display {
	
	private $showWidget = false;
	private $account_items = array();
	
	public function __construct () {
		
		add_action( 'wp_ajax_display_widget', array( $this, 'displayWidget' ) );
		add_action( 'wp_ajax_nopriv_display_widget', array( $this, 'displayWidget' ) );
		
		if ( is_admin() ) {
			return;
		}
		
		add_action( 'wp_footer', array( $this, 'outputHTML' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wpEnqueueScripts' ), 1000 );
	}
	
	public function isBetweenTime( $from, $till, $input ) {
		$f = DateTime::createFromFormat( '!H:i', $from );
		$t = DateTime::createFromFormat( '!H:i', $till );
		$i = DateTime::createFromFormat( '!H:i', $input );
		if ( $f > $t ) {
			$t->modify( '+1 day' );
		}
		return ( $f <= $i && $i <= $t ) || ( $f <= $i->modify( '+1 day' ) && $i <= $t );
	}
	
	public function checkAvailability () {
		
		$accounts = json_decode( WPTWA_Utils::getSetting( 'accounts' ), true );
		if ( count( $accounts ) < 1 ) {
			return;
		}
		
		$i = 0;
		foreach ( $accounts as $k => $v ) {
			
			$from = $v['hour_start'] . ':' . $v['minute_start'];
			$till = $v['hour_end'] . ':' . $v['minute_end'];
			
			/* Remove from the list if time is unavailable */
			if ( ! $this->isBetweenTime( $from, $till, current_time( 'H:i' ) ) ) {
				unset( $accounts[ $k ] );
			}
			
			/* Remove from the list if day is unavailable */
			if ( isset( $v[ strtolower( current_time( 'l' ) ) ] ) && 'off' === $v[ strtolower( current_time( 'l' ) ) ] ) {
				unset( $accounts[ $k ] );
			}
		}
		
		/* Recheck array. */
		if ( count( $accounts ) < 1 ) {
			return;
		}
		
		$this->account_items = $accounts;
		
		$target = json_decode( WPTWA_Utils::getSetting( 'target' ), true );
		
		$included_ids = json_decode( WPTWA_Utils::getSetting( 'included_ids' ), true );
		$included_ids = is_array( $included_ids ) ? $included_ids : array();
		
		$excluded_ids = json_decode( WPTWA_Utils::getSetting( 'excluded_ids' ), true );
		$excluded_ids = is_array( $excluded_ids ) ? $excluded_ids : array();
		
		/* Page targeting. */
		
		/* Included Posts */
		if ( is_singular() && in_array( get_the_ID(), $included_ids ) ) {
			$this->showWidget = true;
			return;
		}
		
		/* Default homepage */
		if ( ( is_front_page() && is_home() ) && ! in_array( 'home', $target ) ) {
			return;
		}
		
		/* Static homepage */
		if ( is_front_page() && ! in_array( 'home', $target ) ) {
			return;
		}
		
		/* Blog page */
		if ( is_home() && ! in_array( 'blog', $target )) {
			return;
		}
		
		if ( ( is_search() || is_archive() ) && ! in_array( 'archive', $target ) ) {
			return;
		}
		
		if ( ! ( is_front_page() && is_home() ) && ! is_front_page() && is_singular( 'page' ) && ! in_array( 'page', $target ) ) {
			return;
		}
		
		if ( is_singular() && in_array( get_the_ID(), $excluded_ids ) ) {
			return;
		}
		
		if ( is_singular( 'post' ) && ! in_array( 'post', $target ) ) {
			return;
		}
		
		foreach ( get_post_types( array( '_builtin' => false ), 'objects' ) as $post_type ) {
			if ( get_post_type() === $post_type->name && ! in_array( $post_type->name, $target ) ) {
				return;
			}
		}
		
		$this->showWidget = true;
		
	}
	
	public function displayWidget () {
		
		$this->checkAvailability();
		
		if ( ! $this->showWidget ) {
			wp_die();
		}
		
		$classes = array( 'wptwa-container' );
		
		$toggle_text = esc_html( WPTWA_Utils::getSetting( 'toggle_text' ) );
		$description = esc_html( WPTWA_Utils::getSetting( 'description' ) );
		
		if ( has_filter( 'wpml_translate_single_string' ) ) {
			$toggle_text = apply_filters('wpml_translate_single_string', $toggle_text, 'WhatsApp Click to Chat', 'Toggle Text' );
			$description = apply_filters('wpml_translate_single_string', $description, 'WhatsApp Click to Chat', 'Description' );
		}
		
		$delay_time = filter_var( WPTWA_Utils::getSetting( 'delay_time' ), FILTER_SANITIZE_NUMBER_INT );
		$inactivity_time = filter_var( WPTWA_Utils::getSetting( 'inactivity_time' ), FILTER_SANITIZE_NUMBER_INT );
		$scroll_length = filter_var( WPTWA_Utils::getSetting( 'scroll_length' ), FILTER_SANITIZE_NUMBER_INT );
		//$box_position_class = 'left' === esc_attr( WPTWA_Utils::getSetting( 'box_position' ) ) ? 'left-side' : '';
		$auto_display_on_mobile = 'on' === esc_attr( WPTWA_Utils::getSetting( 'auto_display_on_mobile' ) ) ? 'on' : 'off';
		
		if ( 'left' === esc_attr( WPTWA_Utils::getSetting( 'box_position' ) ) ) {
			$classes[] = 'left-side';
		}
		
		if ( '' === $toggle_text ) {
			$classes[] = 'circled-handler';
		}
		
		if ( 'on' === esc_attr( WPTWA_Utils::getSetting( 'toggle_round_on_desktop' ) ) ) {
			$classes[] = 'circled-handler-on-desktop';
		}
		
		if ( 'on' === esc_attr( WPTWA_Utils::getSetting( 'toggle_round_on_mobile' ) ) ) {
			$classes[] = 'circled-handler-on-mobile';
		}
		
		?>
		<div class="<?php echo implode( ' ', $classes ); ?>" data-delay-time="<?php echo $delay_time; ?>" data-inactive-time="<?php echo $inactivity_time; ?>" data-scroll-length="<?php echo $scroll_length; ?>" data-auto-display-on-mobile="<?php echo esc_attr( $auto_display_on_mobile );  ?>">
			<div class="wptwa-box">
				<div class="wptwa-wrapper">
				
					<?php if ( '' !== trim( $description ) ) : ?>
					
					<div class="wptwa-description">
						<?php echo wpautop( $description ); ?>
					</div>
					
					<?php endif; ?>
					<span class="wptwa-close"></span>
					<div class="wptwa-people">
						
						<?php foreach ( $this->account_items as $k => $v ) : ?>
						
						<?php
						
						$number = preg_replace( '/[^0-9]/', '', $v['number'] );
						$name = esc_html( $v['name'] );
						$auto_text = '' !== trim( $v['auto_text'] ) ? esc_attr( $v['auto_text'] ) : '';
						$title = '' !== esc_html( $v['title'] ) ? esc_html( $v['title'] ) : '';
						$picture_url = esc_url( $v['picture_url'] );
						
						$href = 'https://api.whatsapp.com/send?phone=' . $number . ( '' !== $auto_text ? '&text=' . $auto_text : '' );
						$classes = array( 'wptwa-account' );
						if ( strpos( $v['number'], 'chat.whatsapp.com' ) !== false ) {
							$number = '';
							$href = esc_url( $v['number'] );
							$classes[] = 'wptwa-group';
						}
						
						if ( has_filter( 'wpml_translate_single_string' ) ) {
							$title = apply_filters('wpml_translate_single_string', $title, 'WhatsApp Click to Chat', 'Title for ' . $name );
							$auto_text = apply_filters('wpml_translate_single_string', $auto_text, 'WhatsApp Click to Chat', 'Predefined Text for ' . $name );
						}
						
						?>
						
						<a href="<?php echo $href; ?>" target="_blank" class="<?php echo implode( ' ', $classes ); ?>" data-number="<?php echo $number; ?>" data-auto-text="<?php echo $auto_text; ?>">
							<div class="wptwa-face"><img src="<?php echo $picture_url; ?>" onerror="this.style.display='none'"/></div>
							<div class="wptwa-info">
								
								<?php if ( '' !== $title ) : ?>
								<span class="wptwa-title"><?php echo $title; ?></span>								
								<?php endif; ?>
								
								<span class="wptwa-name"><?php echo $name; ?></span>
								
							</div>
							<div class="wptwa-clearfix"></div>
						</a>
						
						<?php endforeach; ?>
						
					</div>
				</div>
			</div>
			<span class="wptwa-handler">
				<svg class="WhatsApp" width="15px" height="15px" viewBox="0 0 90 90"><use xlink:href="#wptwa-logo"></svg>
				<?php echo '' !== $toggle_text ? '<span class="text">' . $toggle_text . '</span>' : ''; ?>
			</span>
		</div>
		<?php
		
		wp_die();
		
	}
	
	public function outputHTML () {
		
		echo '
			<span class="wptwa-flag"></span>
			<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
				<symbol id="wptwa-logo">
					<path id="WhatsApp" d="M90,43.841c0,24.213-19.779,43.841-44.182,43.841c-7.747,0-15.025-1.98-21.357-5.455L0,90l7.975-23.522   c-4.023-6.606-6.34-14.354-6.34-22.637C1.635,19.628,21.416,0,45.818,0C70.223,0,90,19.628,90,43.841z M45.818,6.982   c-20.484,0-37.146,16.535-37.146,36.859c0,8.065,2.629,15.534,7.076,21.61L11.107,79.14l14.275-4.537   c5.865,3.851,12.891,6.097,20.437,6.097c20.481,0,37.146-16.533,37.146-36.857S66.301,6.982,45.818,6.982z M68.129,53.938   c-0.273-0.447-0.994-0.717-2.076-1.254c-1.084-0.537-6.41-3.138-7.4-3.495c-0.993-0.358-1.717-0.538-2.438,0.537   c-0.721,1.076-2.797,3.495-3.43,4.212c-0.632,0.719-1.263,0.809-2.347,0.271c-1.082-0.537-4.571-1.673-8.708-5.333   c-3.219-2.848-5.393-6.364-6.025-7.441c-0.631-1.075-0.066-1.656,0.475-2.191c0.488-0.482,1.084-1.255,1.625-1.882   c0.543-0.628,0.723-1.075,1.082-1.793c0.363-0.717,0.182-1.344-0.09-1.883c-0.27-0.537-2.438-5.825-3.34-7.977   c-0.902-2.15-1.803-1.792-2.436-1.792c-0.631,0-1.354-0.09-2.076-0.09c-0.722,0-1.896,0.269-2.889,1.344   c-0.992,1.076-3.789,3.676-3.789,8.963c0,5.288,3.879,10.397,4.422,11.113c0.541,0.716,7.49,11.92,18.5,16.223   C58.2,65.771,58.2,64.336,60.186,64.156c1.984-0.179,6.406-2.599,7.312-5.107C68.398,56.537,68.398,54.386,68.129,53.938z"/>
				</symbol>
			</svg>
			';
		
	}
	
	public function wpEnqueueScripts () {
		
		wp_enqueue_style( 'wptwa-public', WPTWA_PLUGIN_URL . 'assets/css/public.css' );
		
		$css_file = WPTWA_PLUGIN_DIR . 'assets/css/auto-generated-wptwa.css';
		if ( file_exists( $css_file ) ) {
			wp_enqueue_style( 'wptwa-generated', WPTWA_PLUGIN_URL . 'assets/css/auto-generated-wptwa.css' );
		}
		
		wp_enqueue_script( 'wptwa-public', WPTWA_PLUGIN_URL . 'assets/js/public.js', array( 'jquery' ), false, true );
		wp_localize_script( 'wptwa-public', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}
	
}

?>