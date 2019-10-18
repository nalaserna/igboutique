<?php
extract( shortcode_atts(array(
	'posts_per_page'	=> 	'',
	'columns' 			=>  '',
	'category' 			=>  '',
	'filter' 			=>  '',
	'pagination' 			=>  '',
), $atts));

$column_class = '';
if($columns == 'column-2') {
	$column_class = 'col-sm-6';
	$moon_image_size = 'moon_shop_image_570x370';
} elseif($columns == 'column-3') {
	$column_class = 'col-sm-4';
	$moon_image_size = 'moon_shop_image_370x270';
} else {
	$column_class = 'col-sm-3';
	$moon_image_size = 'moon_shop_image_270x270';
}

global $wp_query;
$original_query = $wp_query;
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

if( $category != 'all' ) {
	$args = array(
	    'post_type' => 'mk-portfolio' ,
	    'tax_query' => array(
	        array(
	            'taxonomy' => 'mk-portfolio-category' ,
	            'field' => 'name' ,
	            'terms' => explode( ',' , $category ) ,
	        ),
	    ) ,
	    'posts_per_page' => $posts_per_page ,
	    'taxonomy' => 'mk-portfolio-category' ,
	    'paged'			=> $paged,
	);
} else {
    $args = array(
	    'post_type' => 'mk-portfolio' ,
	    'posts_per_page' => $posts_per_page ,
	    'taxonomy' => 'mk-portfolio-category' ,
	    'paged'			=> $paged,
	);
}

$query = new WP_Query( $args );
$wp_query = $query;
if ($filter != 'hide') { ?>
	<div class="row">
		<div class="portfolio-filter">
			<ul id="portfolio-menu-filter">                                        
				<li class="active" data-filter="*"><?php echo __('All', 'moon-wl-plugin'); ?></li>
				<?php
				$profolio_post = array(
					'type'=> 'mk-portfolio',
					'taxonomy'=> 'mk-portfolio-category'
				);
				
				$portfolio_categories = get_categories($profolio_post);
				
				foreach($portfolio_categories as $portfolio_category) { ?>
					<li data-filter=".<?php echo esc_attr($portfolio_category->slug); ?>">
						<?php echo esc_attr($portfolio_category->name) .' '; ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
<?php
}
echo '<div class="row"><div class="portfolio-items">';
	if($query->have_posts()) :
		while($query->have_posts()) : $query->the_post();
		$moon_shop_category = get_the_terms( get_the_ID(), 'mk-portfolio-category' );
		$moon_shop_terms = '';
		if( $moon_shop_category ) {
			for( $moon_shop_count = 0 ; $moon_shop_count < count( $moon_shop_category ) ; $moon_shop_count++ ) {
		   		$moon_shop_terms .= esc_attr( $moon_shop_category[ $moon_shop_count ]->slug ) . ' ';
		  	}
		}
		?>
			<div class="<?php echo $column_class; ?> <?php echo $moon_shop_terms; ?>">						
				<div class="portfolio-sin">	
					<div class="portfolio-sin-inner">
						<?php the_post_thumbnail('moon_shop_image_570x570'); ?>
						<a href="<?php  echo get_the_permalink(); ?>" class="full-link"></a>								
						<div class="portfolio-content">									
							<h5><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
							<p>
								<?php 
								$cat_count = 0;
								foreach($moon_shop_category as $sin_cat) {
									if( $cat_count != ( count( $moon_shop_category ) - 1 ) ) {
										echo '<a href="'.get_term_link( $sin_cat->term_id , 'mk-portfolio-category' ).'">'.$sin_cat->name.',</a> ';
									} else {
										echo '<a href="'.get_term_link( $sin_cat->term_id , 'mk-portfolio-category' ).'">'.$sin_cat->name.'</a>';
									}
									$cat_count++;
								} ?>
							</p>
						</div>
					</div>
				</div>						
			</div>
		<?php endwhile;
	endif;
echo '</div></div>';

if( $pagination != 'hide' ) { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="paginetion text-center margin-top-20">
				<ul>
					<?php
					$mishuk_left_icon = '<i class="fa fa-angle-left"></i>';
					$mishuk_right_icon = '<i class="fa fa-angle-right"></i>';
					the_posts_pagination( array(
							'prev_text'          => $mishuk_left_icon,
							'next_text'          => $mishuk_right_icon,
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( '', 'mishuk' ) . ' </span>',
					) );
					?>
				</ul>
			</div>					
		</div>
	</div>
<?php }

$wp_query = $original_query;

wp_reset_postdata();

if( !function_exists( 'footer_script_portfolio_shortcode' ) ) {
	function footer_script_portfolio_shortcode() { ?>
		<script type="text/javascript">
			jQuery(window).on('load',function() {
				jQuery('.gallery-grid').isotope({
				  layoutMode: 'masonry',
				  resizesContainer: false,
				});

				jQuery('#portfolio-menu-filter li').click(function(){ 
					jQuery("#portfolio-menu-filter li").removeClass("active");
					jQuery(this).addClass("active");        

					var selector = jQuery(this).attr('data-filter'); 
					jQuery(".portfolio-items").isotope({ 
						filter: selector, 
						animationOptions: { 
							duration: 750, 
							easing: 'linear', 
							queue: false, 
						} 
					}); 
					return false; 
				});  
			});
		</script>
	<?php }
	add_action('wp_footer','footer_script_portfolio_shortcode' , 100, 1);
}
wp_enqueue_script( 'isotope' , MOON_SHOP_THEME_ASSETS_JS . '/isotope.pkgd.min.js' , array( 'jquery' ) , '1.0.0' , true );