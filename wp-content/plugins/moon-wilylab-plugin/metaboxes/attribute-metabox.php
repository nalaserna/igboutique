<?php
// Add term page
function cring_taxonomy_add_new_meta_field() {	?>
	<div class="form-field">
		<label for="enable-swatch"><?php _e( 'Enable Swatch', 'cring' ); ?></label>
		<input type="checkbox" name="enable-swatch" id="enable-swatch">
		<p class="description"><?php _e( 'Attribute dropdown will be replaces with buttons','cring' ); ?></p>
	</div>

	<div class="form-field">
		<label for="swatch-image-url"><?php _e( 'Image URL for This Swatch', 'cring' ); ?></label>
		<input type="url" name="swatch-image-url" id="swatch-image-url">
	</div>

	<div class="form-field">
		<label for="swatch-color"><?php _e( 'Color preview for this value', 'cring' ); ?></label>
		<input type="text" name="swatch-color" id="swatch-color">
	</div>
<?php
}

function cring_taxonomy_edit_meta_field($term) {
	$t_id = $term->term_id;
	$term_meta = get_option( $term->taxonomy.'_'.$t_id );
	$enable_swatch = isset($term_meta['enable-swatch']) ? $term_meta['enable-swatch'] : 'off';
	$swatch_image = isset($term_meta['swatch-image-url']) ? $term_meta['swatch-image-url'] : ''; 
	$swatch_color = isset($term_meta['swatch-color']) ? $term_meta['swatch-color'] : ''; 
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="enable-swatch"><?php _e( 'Enable Swatch', 'cring' ); ?></label></th>
		<td>
			<input type="checkbox" name="enable-swatch" id="enable-swatch" <?php checked( $enable_swatch , 'on' ); ?>>
			<p class="description"><?php _e( 'Attribute dropdown will be replaces with buttons','cring' ); ?></p>
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label for="swatch-image-url"><?php _e( 'Image URL for This Swatch', 'cring' ); ?></label></th>
		<td>
			<input type="url" name="swatch-image-url" id="swatch-image-url" value="<?php echo esc_url($swatch_image); ?>">
		</td>
	</tr>

	<tr class="form-field">
		<th scope="row" valign="top"><label for="swatch-color"><?php _e( 'Color preview for this value', 'cring' ); ?></label></th>
		<td>
			<input type="text" name="swatch-color" id="swatch-color" value="<?php echo esc_url($swatch_color); ?>">
		</td>
	</tr>
<?php
}
$cring_product_attributes = array();
if( in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
	$cring_product_attributes = wc_get_attribute_taxonomies();
}
foreach ($cring_product_attributes as $key => $value) {
	add_action( 'pa_'.$value->attribute_name.'_add_form_fields', 'cring_taxonomy_add_new_meta_field', 10, 2 );
	add_action( 'pa_'.$value->attribute_name.'_edit_form_fields', 'cring_taxonomy_edit_meta_field', 10, 2 );
	add_action( 'edited_pa_'.$value->attribute_name, 'save_attributes_custom_meta', 10, 2 );  
	add_action( 'create_pa_'.$value->attribute_name, 'save_attributes_custom_meta', 10, 2 );
	//add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
	
    add_action('admin_footer','footer_script_attributes_meta' , 100);
}

function load_custom_wp_admin_style() {
	
}

function footer_script_attributes_meta() { 
	wp_enqueue_style( 'wp-color-picker');
    wp_enqueue_script( 'wp-color-picker'); ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
		    jQuery('#swatch-color').wpColorPicker();
		});
	</script>
<?php }

function save_attributes_custom_meta( $term_id ) {

		$t_id = $term_id;
		$term_meta = array();
		$enable_swatch = isset($_POST['enable-swatch']) ? 'on' : 'off';
		$term_meta['enable-swatch'] = $enable_swatch;

		$swatch_image = isset($_POST['swatch-image-url']) ? $_POST['swatch-image-url'] : '';
		$term_meta['swatch-image-url'] = $swatch_image;

		$swatch_color = isset($_POST['swatch-color']) ? $_POST['swatch-color'] : '';
		$term_meta['swatch-color'] = $swatch_color;

		// Save the option array.
		$taxonomy_name = $_POST['taxonomy'];
		update_option( $taxonomy_name.'_'.$t_id, $term_meta );

}  