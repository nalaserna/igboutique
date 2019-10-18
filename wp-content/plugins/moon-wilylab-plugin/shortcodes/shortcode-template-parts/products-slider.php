<?php
/**
 * Product Tab slider shortcode
 */
extract( shortcode_atts( array(
    'slider_recent' => '',
	'slider_featured' => '',
	'slider_sale' => '',
	'slider_best_selling' => '',
	'slider_top_rated' => '',
    'slider_category' => 'all',
    'recent_products' => '',
	'featured_products' => '',
	'sale_products' => '',
	'best_selling_products' => '',
	'top_rated_products' => '',
	'tab_font_size' => '',
	'tab_font_line_height' => '',
	'tab_font_color' => '',
	'active_tab_font_color' => '',
	'divider_color' => '',
	'divider_height' => '',
	'divider_width' => '',
	'hide_divider' => '',
	'recent_products_name' => 'Recent Products',
	'featured_products_name' => 'Featured Products',
	'sale_products_name' => 'Sale Products',
	'best_sale_products_name' => 'Best Selling Products',
	'top_rated_products_name' => 'Top Rated Products',
  
) , $atts ) );
$slider_recent = (empty($slider_recent)) ? '12' : $slider_recent;
$slider_featured = (empty($slider_featured)) ? '12' : $slider_featured;
$slider_sale = (empty($slider_sale)) ? '12' : $slider_sale;
$slider_best_selling = (empty($slider_best_selling)) ? '12' : $slider_best_selling;
$slider_top_rated = (empty($slider_top_rated)) ? '12' : $slider_top_rated;
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
		<?php if($recent_products == 'true'){?>
			<li class="active"><a href="#slider_recent_products" data-toggle="tab"><?php echo $recent_products_name;?></a></li>
		<?php }?>
		<?php if($featured_products == 'true'){?>
			<li><a href="#slider_featured_products" data-toggle="tab"><?php echo $featured_products_name;?></a></li>
		<?php }?>
		<?php if($sale_products == 'true'){?>
			<li><a href="#slider_sale_products" data-toggle="tab"><?php echo $sale_products_name;?></a></li>
		<?php }?>
		<?php if($best_selling_products == 'true'){?>
			<li><a href="#slider_best_selling_products" data-toggle="tab"><?php echo $best_sale_products_name;?></a></li>
		<?php }?>
		<?php if($top_rated_products == 'true'){?>
			<li><a href="#slider_top_rated_products" data-toggle="tab"><?php echo $top_rated_products_name;?></a></li>
		<?php }?>
		
	</ul>
</div>
<div class="tab-content tab-short col-xs-12 products" style="padding-left: 0; padding-right: 0;">
	<?php if($recent_products == 'true'){?>
	<div class="wl-products-slide-recent tab-pane active clearfix" id="slider_recent_products">
		<?php
			echo do_shortcode('[moon_recent_products limit="'.$slider_recent.'"]');
		?>
	</div>
	<?php }?>
	<?php if($featured_products == 'true'){?>
	<div class="tab-pane clearfix" id="slider_featured_products">
		<?php
			echo do_shortcode('[moon_featured_products limit="'.$slider_featured.'"]');
		?>
	</div>
	<?php }?>
	<?php if($sale_products == 'true'){?>
	<div class="tab-pane clearfix" id="slider_sale_products">
		<?php
			echo do_shortcode('[moon_sale_products limit="'.$slider_sale.'"]');
		?>
	</div>
	<?php }?>
	<?php if($best_selling_products == 'true'){?>
	<div class="tab-pane clearfix" id="slider_best_selling_products">
		<?php
			echo do_shortcode('[moon_best_selling_products limit="'.$slider_best_selling.'"]');
		?>
	</div>
	<?php }?>
	<?php if($top_rated_products == 'true'){?>
	<div class="tab-pane clearfix" id="slider_top_rated_products">
		<?php
			echo do_shortcode('[moon_top_rated_products limit="'.$slider_top_rated.'"]');
		?>
	</div>
	<?php }?>
</div>
