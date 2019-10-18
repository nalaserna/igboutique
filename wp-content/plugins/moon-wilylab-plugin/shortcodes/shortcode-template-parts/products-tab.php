<?php
/**
 * Product Tab slider shortcode
 */
extract( shortcode_atts( array(
	'recent_product_number' => '',
	'featured_product_number' => '',
	'grid_sale_product_number' => '',
	'best_selling_product_number' => '',
	'top_rated_product_number' => '',
    'slider_category' => 'all',
    'grid_recent_products' => '',
	'grid_featured_products' => '',
	'grid_sale_products' => '',
	'grid_best_selling_products' => '',
	'grid_top_rated_products' => '',
	'tab_font_size' => '',
	'tab_font_line_height' => '',
	'tab_font_color' => '',
	'active_tab_font_color' => '',
	'divider_color' => '',
	'divider_height' => '',
	'divider_width' => '',
	'hide_divider' => '',
	'grid_recent_products_name' => 'Recent Products',
	'grid_featured_products_name' => 'Featured Products',
	'sale_products_name' => 'Sale Products',
	'grid_best_sale_products_name' => 'Best Selling Products',
	'grid_top_rated_products_name' => 'Top Rated Products',
) , $atts ) );
$recent_product_number = (empty($recent_product_number)) ? '12' : $recent_product_number;
$featured_product_number = (empty($featured_product_number)) ? '12' : $featured_product_number;
$grid_sale_product_number = (empty($grid_sale_product_number)) ? '12' : $grid_sale_product_number;
$best_selling_product_number = (empty($best_selling_product_number)) ? '12' : $best_selling_product_number;
$top_rated_product_number = (empty($top_rated_product_number)) ? '12' : $top_rated_product_number;
if( !function_exists( 'moon_wl_random_number' ) ) {
    function moon_wl_random_number() {
        $class_name = 'wl-';

        for( $i = 0 ; $i < 5 ; $i++ ) {
            $class_name .= mt_rand( 0 , 9999 );
        }
        return $class_name;
    }
}
$className = moon_wl_random_number();
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$custom_inline_style = '';
$custom_inline_style .='.'.$className.' ul li a{color: '.$tab_font_color.';font-size: '.$tab_font_size.'px;line-height: '.$tab_font_line_height.'px;}';
$custom_inline_style .='.'.$className.' ul li.active a{color: '.$active_tab_font_color.';}';
$custom_inline_style .='.'.$className.' .pro-tab-list li::before {background:'.$divider_color.'; height:'.$divider_height.'px;width:'.$divider_width.'px;}';

wp_add_inline_style( 'moon_shop_inline-style', $custom_inline_style );
?>
<div class="col-xs-12 text-center <?php echo $className;?>">
	<ul class="pro-tab-list fix">
		<?php if($grid_recent_products == 'true'){?>
			<li class="active"><a href="#grid_recent_products" data-toggle="tab"><?php echo $grid_recent_products_name;?></a></li>
		<?php }?>
		<?php if($grid_featured_products == 'true'){?>
			<li><a href="#grid_featured_products" data-toggle="tab"><?php echo $grid_featured_products_name;?></a></li>
		<?php }?>
		<?php if($grid_sale_products == 'true'){?>
			<li><a href="#grid_sale_products" data-toggle="tab"><?php echo $sale_products_name;?></a></li>
		<?php }?>
		<?php if($grid_best_selling_products == 'true'){?>
			<li><a href="#grid_best_selling_products" data-toggle="tab"><?php echo $grid_best_sale_products_name;?></a></li>
		<?php }?>
		<?php if($grid_top_rated_products == 'true'){?>
			<li><a href="#grid_top_rated_products" data-toggle="tab"><?php echo $grid_top_rated_products_name;?></a></li>
		<?php }?>
		
	</ul>
</div>
<div class="tab-content product-tab-grid tab-short col-xs-12 products">
	<?php if($grid_recent_products == 'true'){?>
	<div class="wl-products-slide-recent tab-pane row active clearfix" id="grid_recent_products">
		<?php
			echo do_shortcode('[recent_products product_number="'.$recent_product_number.'"]');
		?>
	</div>
	<?php }?>
	<?php if($grid_featured_products == 'true'){?>
	<div class="tab-pane row clearfix" id="grid_featured_products">
		<?php
			echo do_shortcode('[featured_products product_number="'.$featured_product_number.'"]');
		?>
	</div>
	<?php }?>
	<?php if($grid_sale_products == 'true'){?>
	<div class="tab-pane row clearfix" id="grid_sale_products">
		<?php
			echo do_shortcode('[sale_products product_number="'.$grid_sale_product_number.'"]');
		?>
	</div>
	<?php }?>
	<?php if($grid_best_selling_products == 'true'){?>
	<div class="tab-pane row clearfix" id="grid_best_selling_products">
		<?php
			echo do_shortcode('[best_selling_products product_number="'.$best_selling_product_number.'"]');
		?>
	</div>
	<?php }?>
	<?php if($grid_top_rated_products == 'true'){?>
	<div class="tab-pane row clearfix" id="grid_top_rated_products">
		<?php
			echo do_shortcode('[top_rated_products product_number="'.$top_rated_product_number.'"]');
		?>
	</div>
	<?php }?>
</div>
