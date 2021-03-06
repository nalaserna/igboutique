<?php
  extract( shortcode_atts( array(
    'product_number' 		=> '',		
	'column'  => '',    
    ), $atts ) );

if ($product_number == '') {
	$posts_per_page = "12";
} else {
	$posts_per_page = $product_number;
}

if ($column == '') {
	$column = '4';
}

$args = Array(
    "post_type" => "product",
    "post_status" => "publish",
    "ignore_sticky_posts" => "1",
    "no_found_rows" => "1",
    "posts_per_page" => $posts_per_page,
    "tax_query" => Array(
        "0" => Array(
            "taxonomy" => "product_visibility",
            "field" => "term_taxonomy_id",
            "terms" => Array(
                "0" => "7"
            ),
            "operator" => "NOT IN"
        ),
    ),
);

add_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );

$products = new WP_Query( $args );

if(!function_exists('moon_shop_random_number')) {
    function moon_shop_random_number() {
        $id = 'moon-';
        for ($i = 0; $i<5; $i++) {
            $id .= mt_rand(0,9999);
        }
        return $id;
    }
}

$random = moon_shop_random_number();

if ( $products->have_posts() ) {
	?>
    <div class="row">
    	<div id="top-products" class="woocommerce row grid-responsive column-<?php echo esc_attr($column).' '.$random; ?> owl-carousel">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
    			<?php wc_get_template_part( 'content', 'product-shortcode' ); ?>
    		<?php endwhile; wp_reset_postdata(); // end of the loop. ?>			
    	</div>
    </div>
	<?php
}
remove_filter( 'posts_clauses', array( 'WC_Shortcodes', 'order_by_rating_post_clauses' ) );

if( !function_exists( 'footer_script_top_rated' ) ) {
    function footer_script_top_rated($args, $param) { ?>
        <script>
            jQuery('.<?php echo $param[0]; ?>').owlCarousel({
                loop: true,
                nav: true,
                dots: false,
                rtl: jQuery('body').hasClass('rtl'),
                navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
                smartSpeed: 300,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1
                    },
                    767:{
                        items:2
                    },
                    969:{
                        items:<?php echo $param[1] ?>
                    }
                }
            });
        </script>
    <?php }
}

add_action('wp_footer', array (
    new WPSE_Filter_Storage( array( $random, $column ) ),
    'footer_script_top_rated'
), 100, 1);