<?php
/* Adding Metaboxes For Pages */
add_action( 'add_meta_boxes' , 'moon_shop_album_metabox' , 100 );

/* Saving Post Data */
add_action( 'save_post' , 'moon_shop_save_album_metabox' );

/*
 * Function to add metabox
 *
 */
function moon_shop_album_metabox() {
    add_meta_box( 'msk-theme-option-content' , esc_html__( 'Album Settings' , 'moon-shop' ) , 'moon_shop_album_options' , 'mk-album' , 'normal' , 'high' );
}

/**
 * Function To Generate Page Header Metabox Options
 */
function moon_shop_album_options() {
    wp_nonce_field( 'moon-shop-page-meta-options' , 'moon-shop-page-meta-nonce' );
    global $post_id;

    // Getting Previously Saved Values
    $moon_shop_values = get_post_custom( $post_id );
	
	//album
	$moon_shop_albumImages    = isset( $moon_shop_values['moon-shop-album-images'][0] ) ? unserialize( $moon_shop_values['moon-shop-album-images'][0] ) : '';

	$moon_shop_gallery_display = isset( $moon_shop_values[ 'moon-shop-gallery-display' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-gallery-display' ][ 0 ] ) : 'masonry';

	$moon_shop_image_column = isset( $moon_shop_values[ 'moon-shop-image-column' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-image-column' ][ 0 ] ) : '4';
	?>

	<div class="msk-theme-opion-wrap">
		<div class="msk-theme-option-main">
			<div class="msk-theme-option-content">
				<table class="msk-theme-opt-form">
					<!-- Album Images -->
					<tr class="msk-page-logo-close">
						<th class="msk-left-column msk-field-th">
							<label class="wlopt-title"><?php esc_html_e( 'Upload Images', 'moon-shop' ); ?></label>
							<small class="wlopt-sub-title"><p><?php esc_html_e( 'Upload images for album', 'moon-shop' ); ?></p>
						</th>
						<td class="msk-right-column msk-opt-upload">
							<div class="msk-opt-upload">
								<button id="moon-shop-album-image-uploader-button" type="submit"><?php esc_html_e( 'Upload', 'moon-shop' ); ?></button>
								<div class="msk-album-image-wrapper">
									<?php
									if( $moon_shop_albumImages ) {
										foreach( $moon_shop_albumImages as $moon_shop_image ){ ?>
											<div class="msk-album-image">
												<input type="text" name="moon-shop-album-images[]" id="moon-shop-album-images" class="<?php echo esc_attr($moon_shop_image); ?>" value="<?php echo esc_attr($moon_shop_image); ?>" style="display:none;" />
												<span id="moon-shop-image-close" class="fa fa-times msk-page-logo-close" onclick="deleteImage(<?php echo esc_attr($moon_shop_image); ?>)"></span>
												<img class="msk-album-image-loader <?php echo esc_attr($moon_shop_image); ?>" value="<?php echo esc_attr($moon_shop_image); ?>" src="<?php echo wp_get_attachment_url( $moon_shop_image );?>" />
											</div>
										<?php }
									}
									?> 
								</div>
							</div>
						</td>
					</tr>
					<!-- display style -->
					<tr>
						<th class="msk-left-column msk-field-th">
							<label class="wlopt-title"><?php esc_html_e( 'Display Style', 'moon-shop' ); ?></label>
						</th>
						<td class="msk-right-column">
							<select class="opt_group" name="moon-shop-gallery-display" id="moon-shop-gallery-display">
								<option value="masonry" <?php selected( $moon_shop_gallery_display, 'masonry' ); ?>><?php esc_html_e( 'Masonry Style', 'moon-shop' ); ?></option>
								<option value="grid" <?php selected( $moon_shop_gallery_display, 'grid' ); ?>><?php esc_html_e( 'Grid Style', 'moon-shop' ); ?></option>
							</select>
						</td>
					</tr>
					<!-- column number -->
					<tr>
						<th class="msk-left-column msk-field-th">
							<label class="wlopt-title"><?php esc_html_e( 'Image Column', 'moon-shop' ); ?></label>
						</th>
						<td class="msk-right-column">
							<select class="opt_group" name="moon-shop-image-column" id="moon-shop-image-column">
								<option value="2" <?php selected( $moon_shop_image_column, '2' ); ?>><?php esc_html_e( 'Two Column', 'moon-shop' ); ?></option>
								<option value="3" <?php selected( $moon_shop_image_column, '3' ); ?>><?php esc_html_e( 'Three Column', 'moon-shop' ); ?></option>
								<option value="4" <?php selected( $moon_shop_image_column, '4' ); ?>><?php esc_html_e( 'Four Column', 'moon-shop' ); ?></option>
								<option value="6" <?php selected( $moon_shop_image_column, '6' ); ?>><?php esc_html_e( 'Six Column', 'moon-shop' ); ?></option>
							</select>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php }

add_action( 'admin_enqueue_scripts' , 'moon_shop_albun_admin' );
function moon_shop_albun_admin() {
	wp_enqueue_style( 'moon-shop-admin-style' , MOON_SHOP_THEME_ASSETS_CSS . '/meta-style.css' , '' , '1.0.0' , 'all' );
	wp_enqueue_script( 'album-upload' , MOON_SHOP_THEME_ASSETS_JS . '/album.js' , array( 'jquery' ) , '1.0.0' , true );
}

/**
 * Function to save user data
 * @param integer $post_id Current Post ID
 * @return
 */
function moon_shop_save_album_metabox( $post_id ) {
    // Bail if doing auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Check for valid nonce
    if( !isset( $_POST[ 'moon-shop-page-meta-nonce' ] ) || !wp_verify_nonce( $_POST[ 'moon-shop-page-meta-nonce' ] , 'moon-shop-page-meta-options' ) ) return;

    // If current user can't edit this post
    if( !current_user_can( 'edit_posts' ) ) return;

    /* Saving page meta data */
	
	/*** Album section ***/
    /* For Multiple Image Uploader  */
    $w_studio_images = array();
    if( isset( $_POST['moon-shop-album-images'] ) ){
        foreach( $_POST['moon-shop-album-images'] as $moon_shop_image ){
            $moon_shop_images['url'][]   = $moon_shop_image;
        }
        update_post_meta( $post_id, 'moon-shop-album-images', $moon_shop_images['url'] );
    } else{
    	$moon_shop_images['url']	= '';
        delete_post_meta( $post_id, 'moon-shop-album-images', $moon_shop_images['url'] );
    }

    if( isset( $_POST[ 'moon-shop-gallery-display' ] ) ) update_post_meta( $post_id , 'moon-shop-gallery-display' , esc_attr( $_POST[ 'moon-shop-gallery-display' ] ) );

    if( isset( $_POST[ 'moon-shop-image-column' ] ) ) update_post_meta( $post_id , 'moon-shop-image-column' , esc_attr( $_POST[ 'moon-shop-image-column' ] ) );
}