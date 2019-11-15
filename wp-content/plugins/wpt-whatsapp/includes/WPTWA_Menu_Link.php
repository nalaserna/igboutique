<?php

class WPTWA_Menu_Link {
	
	private static $menus = array();
	
	public function __construct () {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'addMenuLink' ) );
			add_filter( 'plugin_action_links_' . WPTWA_PLUGIN_BASENAME, array( $this, 'addPluginActionLinks' ) );
		}
	}
	
	public function addMenuLink () {
		
		$parent_slug = 'wptwa_settings';
		
		$this->addMenu(
			esc_html__( 'WhatsApp Click', 'wptwa' ),
			array( $this, 'getView' ),
			$parent_slug,
			'',
			'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAABP0lEQVQoz2XRO0gVcBTH8ZNDVzEpNFIicIpa06VBIQgSDFzcnAJpiCKCwEBuiEi6+KBwikiscNDu0NLQEgpNQctFe4C9aEgjscQX6OfvcB+gcobDOb8vvx+cE6JYTcbl/bbkowmtpX2hZQzju3E33TBiQTLpRAnIyNlxx7GyW8Y1a+bUFIBBSVtZLNUFW56LcN6ue0K7nIZ9SJfkUhiypFqlvKRnH3BE3ovwzpRw3A/JwwMxQxbDN/eF8ETScgDo9id81SeE035675RQoa4IXLccZr0sjhf9M++KrF+yaoRRn0LWX/VFpNkHSZJsqldh0ePQaENvObVKlxmvXRVuSZrDSStuHzpTaJOMidBh22Wd7jpTFmv12pVTKcIjyX/r1qx6ZdCAacu2PHC08Kxnnup2VqMeb3z2xVv9zpXc9gBr2VaI0t5EZgAAAABJRU5ErkJggg=='
			);
			
		
	}
	
	private function addMenu ( $title, $callback, $slug, $parent_slug = '', $icon = '' ) {
		
		if ( '' === $parent_slug ) {
			add_menu_page(
				$title,
				$title,
				'manage_options',
				$slug,
				$callback,
				$icon
			);
		}
		else {
			add_submenu_page(
				$parent_slug,
				$title,
				$title,
				'manage_options',
				$slug,
				$callback,
				$icon
			);
			
			self::$menus[$title] = $slug;
		}
		
	}
	
	public function getView () {
		WPTWA_Utils::getView();
	}
	
	public static function getMenus () {
		return self::$menus;
	}
	
	/**
	 * Add 'Settings' link to the plugin page. 
	 * This link will only displayed if the plugin is active.
	 */
	public function addPluginActionLinks ( $links ) {
		$settings_link = sprintf( '<a href="admin.php?page=wptwa_settings">%1$s</a>', esc_html__( 'Settings', 'wptwa' ) );
		array_unshift( $links, $settings_link );
		return $links;
	}
	
}

?>