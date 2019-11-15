<?php

class WPTWA_Ajax {
	
	public function __construct () {
		
		add_action( 'wp_ajax_search_posts', array( $this, 'searchPost' ) );
		
	}
	
	public function searchPost(  ) {
		
		check_ajax_referer( 'wptwa-search-nonce', 'security' );
		$title = sanitize_text_field( $_POST['title'] );
		
		global $post;
		$args = array(
			'posts_per_page' => 50,
			's' => $title,
			'post_type' => 'any'
		);
				
		$result = get_posts( $args );
		$html = '';
		
		foreach ( $result as $post ) {
			setup_postdata( $post );
			
			$post_title = '' !== get_the_title() ? get_the_title() : sprintf( esc_html__( '[No title with ID: %s]', 'wptwa' ), get_the_ID() );
			$html.= '<li data-id="' . get_the_ID() . '">
				<span class="wptwa-title">' . $post_title . '</span>
				<span class="wptwa-permalink">' . esc_url( get_the_permalink() ) . '</span>
			</li>';
		}
		wp_reset_postdata();
		
		if ( '' === $html ) {
			$html.= '<li data-id="">' . esc_html__( 'No Result', 'wptwa' ) . '</li>';
		}
		
		echo $html;
		
		wp_die();
		
	}
	
}

?>