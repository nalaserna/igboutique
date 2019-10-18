<?php

extract( shortcode_atts(array(
	'styles'			=> 	'',
	'album_columns' 	=>  '',
	'category' 			=>  '',
), $atts));

$column_class = '';

if($album_columns == 'column-2') {
	$column_class = 'col-sm-6';
	$moon_image_size = 'moon_shop_image_570x370';
} elseif($album_columns == 'column-3') {
	$column_class = 'col-sm-4';
	$moon_image_size = 'moon_shop_image_370x270';
} else {
	$column_class = 'col-sm-3';
	$moon_image_size = 'moon_shop_image_270x270';
}

$args = array(
	'post_type' => 'mk-album' ,
	'posts_per_page' => 1 ,
	'taxonomy' => 'mk-album-category' ,
);

$query = new WP_Query( $args ); ?>
	<?php if($query->have_posts()) :
			while($query->have_posts()) : $query->the_post();
			
			$moon_shop_AlbumMetaData  = get_post_meta( get_the_ID(), 'moon-shop-album-images', false );
			$moon_shop_Album_style  = get_post_meta( get_the_ID(), 'moon-shop-gallery-display', false );
			$moon_shop_Album_column  = get_post_meta( get_the_ID(), 'moon-shop-image-column', false );

			if($styles == 'grid') {
				foreach($moon_shop_AlbumMetaData as $sin_album => $sin_album_inner) {
					foreach($sin_album_inner as $sin_album_inner_deep) { ?>
						<div class="<?php echo esc_attr($column_class); ?>">						
							<div class="album-sin">	
								<a href="<?php echo wp_get_attachment_url($sin_album_inner_deep); ?>" rel="prettyPhoto[gallery1]">
								<?php
									$moon_shop_img_src = wp_get_attachment_image_src($sin_album_inner_deep, 'large');
									foreach($moon_shop_img_src as $moon_shop_img_src_inner) {
										if(!is_int($moon_shop_img_src_inner) and !empty($moon_shop_img_src_inner) and !preg_match('/^[0-9]*$/', $moon_shop_img_src_inner)) { ?>
											<img src="<?php echo esc_url($moon_shop_img_src_inner); ?>" alt="" />
										<?php
										}
									}
								?>
								</a>
							</div>						
						</div>
					<?php }
				}
			} else {
				echo '<div class="gallery-grid clearfix">';
				foreach($moon_shop_AlbumMetaData as $sin_album => $sin_album_inner) {
					foreach($sin_album_inner as $sin_album_inner_deep) { ?>
						<div class="<?php echo esc_attr($column_class); ?>">						
							<div class="album-sin">	
								<a href="<?php echo wp_get_attachment_url($sin_album_inner_deep); ?>" rel="prettyPhoto[gallery1]">
								<?php
									$moon_shop_img_src = wp_get_attachment_image_src($sin_album_inner_deep, 'large');
									foreach($moon_shop_img_src as $moon_shop_img_src_inner) {
										if(!is_int($moon_shop_img_src_inner) and !empty($moon_shop_img_src_inner) and !preg_match('/^[0-9]*$/', $moon_shop_img_src_inner)) { ?>
											<img src="<?php echo esc_url($moon_shop_img_src_inner); ?>" alt="" />
										<?php
										}
									}
								?>
								</a>
							</div>						
						</div>
					<?php }
				}
				echo '</div>';
			}
			
				endwhile;
			endif;
			
if( !function_exists( 'footer_script_gallery_shortcode' ) ) {
	function footer_script_gallery_shortcode() { ?>
		<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery("area[rel^='prettyPhoto']").prettyPhoto();
				jQuery(".album-sin a[rel^='prettyPhoto'], .gallery-grid-item a[rel^='prettyPhoto']").prettyPhoto({
					animation_speed:'normal',
					theme:'pp_default',
					slideshow:4000, 
					autoplay_slideshow: false,
					social_tools:false,
					allow_resize: true,
					autoplay: true,
					opacity: 0.7,
					horizontal_padding: 5,
				});
				jQuery(".album-sin:gt(0) a[rel^='prettyPhoto'], .gallery-grid-item:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
					animation_speed:'normal',
					slideshow:50000, 
					hideflash: false
				});

				jQuery(window).on('load',function() {
					jQuery('.gallery-grid').isotope({
					  layoutMode: 'masonry',
					  resizesContainer: false,
					});
				});
			});	
		</script>
	<?php }
	add_action('wp_footer','footer_script_gallery_shortcode' , 100, 1);
}

wp_enqueue_style( 'prettyPhoto' , MOON_SHOP_THEME_ASSETS_CSS . '/prettyPhoto.css' , '' , '1.0.0' , 'all' );
wp_enqueue_script( 'isotope' , MOON_SHOP_THEME_ASSETS_JS . '/isotope.pkgd.min.js' , array( 'jquery' ) , '1.0.0' , true );
wp_enqueue_script( 'prettyPhoto' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.prettyPhoto.js' , array( 'jquery' ) , '1.0.0' , true );