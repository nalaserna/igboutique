<?php
/* Adding Metaboxes For Pages */
add_action( 'add_meta_boxes' , 'moon_shop_product_metabox' , 100 );

/* Saving Post Data */
add_action( 'save_post' , 'moon_shop_save_product_metabox' );

/*
 * Function to add metabox
 *
 */
function moon_shop_product_metabox() {
    add_meta_box( 'msk-theme-option-content' , esc_html__( 'Product Settings' , 'moon-shop' ) , 'moon_shop_product_options' , 'product' , 'normal' , 'high' );
}

/**
 * Function To Generate Page Header Metabox Options
 */
function moon_shop_product_options() {
    wp_nonce_field( 'moon-shop-page-meta-options' , 'moon-shop-page-meta-nonce' );
    global $post_id;

    // Getting Previously Saved Values
    $moon_shop_values = get_post_custom( $post_id );

	$moon_shop_product_video = isset( $moon_shop_values[ 'moon-shop-product-video' ][ 0 ] ) ? esc_url( $moon_shop_values[ 'moon-shop-product-video' ][ 0 ] ) : '';
	?>

	<div class="msk-theme-opion-wrap">
		<div class="msk-theme-option-main">
			<div class="msk-theme-option-content">
				<table class="msk-theme-opt-form" style="margin-bottom: 15px;">
					<tr>
						<th class="msk-left-column msk-field-th">
							<label class="wlopt-title"><?php esc_html_e( 'Product Video URL', 'moon-shop' ); ?></label>
						</th>
						<td class="msk-right-column">
							<input id="moon-shop-product-video" name="moon-shop-product-video" value="<?php echo esc_url( $moon_shop_product_video ); ?>" type="url" style="width: 100%;"/>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php }

add_action( 'admin_enqueue_scripts' , 'moon_shop_product_admin' );
function moon_shop_product_admin() {
	wp_enqueue_style( 'moon-shop-admin-style' , MOON_SHOP_THEME_ASSETS_CSS . '/meta-style.css' , '' , '1.0.0' , 'all' );
}

/**
 * Function to save user data
 * @param integer $post_id Current Post ID
 * @return
 */
function moon_shop_save_product_metabox( $post_id ) {
    // Bail if doing auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Check for valid nonce
    if( !isset( $_POST[ 'moon-shop-page-meta-nonce' ] ) || !wp_verify_nonce( $_POST[ 'moon-shop-page-meta-nonce' ] , 'moon-shop-page-meta-options' ) ) return;

    // If current user can't edit this post
    if( !current_user_can( 'edit_posts' ) ) return;

    if( isset( $_POST[ 'moon-shop-product-video' ] ) ) update_post_meta( $post_id , 'moon-shop-product-video' , esc_url( $_POST[ 'moon-shop-product-video' ] ) );
}