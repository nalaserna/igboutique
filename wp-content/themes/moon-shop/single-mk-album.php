<?php get_header(); ?>

<?php get_template_part( 'base/views/album-banner' ); ?>

<div class="container album-single">
	<?php if (have_posts()) :
		while(have_posts()) : the_post();
			
			$moon_shop_AlbumMetaData  = get_post_meta( get_the_ID(), 'moon-shop-album-images', false );
			$moon_shop_Album_style  = get_post_meta( get_the_ID(), 'moon-shop-gallery-display', false );
			$moon_shop_Album_column  = get_post_meta( get_the_ID(), 'moon-shop-image-column', false );
			if (! isset($moon_shop_Album_style) || empty($moon_shop_Album_style)) {
				$moon_shop_Album_style = array('0' => 'masonry');
			}
			if (! isset($moon_shop_Album_column) || empty($moon_shop_Album_column)) {
				$moon_shop_Album_column = array('0' => '4');
			}
			if ($moon_shop_Album_column['0'] == '2') {
				$grid_class = 'col-sm-6';
				$masonry_class= 'gallery-grid-sizer-2';
			} else if ($moon_shop_Album_column['0'] == '3') {
				$grid_class = 'col-sm-4';
				$masonry_class= 'gallery-grid-sizer-3';
			} else if ($moon_shop_Album_column['0'] == '6') {
				$grid_class = 'col-sm-2';
				$masonry_class= 'gallery-grid-sizer-6';
			}  else {
				$grid_class = 'col-sm-3';
				$masonry_class= '';
			}

			if($moon_shop_Album_style['0'] == 'grid') {
				echo '<div class="row">';
				foreach($moon_shop_AlbumMetaData as $sin_album => $sin_album_inner) {
					foreach($sin_album_inner as $sin_album_inner_deep) { ?>
						<div class="<?php echo esc_attr($grid_class); ?> album-grid">
							<div class="album-sin">		
								<a href="<?php echo wp_get_attachment_url($sin_album_inner_deep); ?>" rel="prettyPhoto[gallery1]">
								<?php
									echo wp_get_attachment_image($sin_album_inner_deep, 'moon_shop_image_570x570');
									?>
								</a>									
							</div>
						</div>
					<?php }
				}
				echo '</div>';
			} else {
				echo '<div class="gallery-grid clearfix"><div class="gallery-grid-sizer '.$masonry_class.'"></div>';
				foreach($moon_shop_AlbumMetaData as $sin_album => $sin_album_inner) {
					foreach($sin_album_inner as $sin_album_inner_deep) { ?>
						<div class="gallery-grid-item album-sin <?php echo esc_attr($masonry_class); ?>">		
							<a href="<?php echo wp_get_attachment_url($sin_album_inner_deep); ?>" rel="prettyPhoto[gallery1]">
							<?php
								echo wp_get_attachment_image($sin_album_inner_deep, 'large');
							?>
							</a>									
						</div>
					<?php }
				}
				echo '</div>';
			}
			?>
		<?php endwhile; ?>
	<?php endif; ?>	
</div>

<?php 
if( !function_exists( 'footer_script_album_single' ) ) {
	function footer_script_album_single() { ?>
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

				jQuery('.gallery-grid').isotope({
				  	itemSelector: '.gallery-grid-item',
				  	percentPosition: true,
				  	masonry: {
				    	columnWidth: '.gallery-grid-sizer' 
				  	}
				});
			});	
		</script>
	<?php }
	add_action('wp_footer','footer_script_album_single' , 100, 1);
}
wp_enqueue_style( 'prettyPhoto' , MOON_SHOP_THEME_ASSETS_CSS . '/prettyPhoto.css' , '' , '1.0.0' , 'all' );
wp_enqueue_script( 'isotope' , MOON_SHOP_THEME_ASSETS_JS . '/isotope.pkgd.min.js' , array( 'jquery' ) , '1.0.0' , true );
wp_enqueue_script( 'prettyPhoto' , MOON_SHOP_THEME_ASSETS_JS . '/jquery.prettyPhoto.js' , array( 'jquery' ) , '1.0.0' , true );

get_footer();