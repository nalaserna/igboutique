<?php

extract( shortcode_atts(array(
	'styles'			=> 	'',
	'posts_per_page'	=> 	'',
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

if( $category != 'all' ) {
	$args = array(
	    'post_type' => 'mk-album' ,
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'mk-album-category' ,
	            'field' => 'name' ,
	            'terms' => explode( ',' , $category ) ,
	        ),
	    ) ,
	    'posts_per_page' => $posts_per_page ,
	    'taxonomy' => 'mk-album-category' ,
	);
} else {
    $args = array(
	    'post_type' => 'mk-album' ,
	    'posts_per_page' => $posts_per_page ,
	    'taxonomy' => 'mk-album-category' ,
	);
}

$query = new WP_Query( $args );

if($styles == 'masonry')  {

if($query->have_posts()) :
	echo '<div class="gallery-grid clearfix">';
	while($query->have_posts()) : $query->the_post();
?>
	<div class="<?php echo esc_attr($column_class); ?>">						
		<div class="album-sin">	
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $moon_image_size ); ?>					
				<div class="album-content">
					<div class="display-table">
						<div class="vertical-middle">
							<div class="album-name"><?php the_title(); ?></div>
							<div class="album-icon">
								<i class="dashicons dashicons-plus"></i>
							</div>										
						</div>
					</div>
				</div>
			</a>
		</div>						
	</div>
<?php
	endwhile;
	echo '</div>';
endif; wp_reset_postdata();

} else  {
	if($query->have_posts()) :
		while($query->have_posts()) : $query->the_post();	
	?>
	<div class="<?php echo esc_attr($column_class); ?>">						
		<div class="album-sin">	
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $moon_image_size ); ?>					
				<div class="album-content">
					<div class="display-table">
						<div class="vertical-middle">
							<div class="album-name"><?php the_title(); ?></div>
							<div class="album-icon">
								<i class="dashicons dashicons-plus"></i>
							</div>										
						</div>
					</div>
				</div>
			</a>
		</div>						
	</div>
	<?php
		endwhile;
	endif; wp_reset_postdata();
}

if( !function_exists( 'footer_script_album_shortcode' ) ) {
	function footer_script_album_shortcode() { ?>
		<script type="text/javascript">
			jQuery(window).on('load',function() {
				jQuery('.gallery-grid').isotope({
				  layoutMode: 'masonry',
				  resizesContainer: false,
				});
			});
		</script>
	<?php }
	add_action('wp_footer','footer_script_album_shortcode' , 100, 1);
}
wp_enqueue_script( 'isotope' , MOON_SHOP_THEME_ASSETS_JS . '/isotope.pkgd.min.js' , array( 'jquery' ) , '1.0.0' , true );