<?php

extract( shortcode_atts(array(
	'bg_image' => 	'',
	'bg_color' => '#ffffff'
), $atts));

$bg_image_link = wp_get_attachment_image_src($bg_image, "large");

if( !function_exists( 'w_studio_random_number1' ) ) {
	function w_studio_random_number1() {
		$class_name = 'wl-';

		for( $i = 0 ; $i < 5 ; $i++ ) {
			$class_name .= mt_rand( 0 , 9999 );
		}
		return $class_name;
	}
}
$className = w_studio_random_number1();

wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$custom_inline_style = '';

if($bg_image !== ' '){
	$custom_inline_style .= '.'.$className.'{background:url('.$bg_image_link[0].');min-height:300px;}';
}
if($bg_image_link[0] == NULL){
$custom_inline_style .= '.'.$className.'{background:'.$bg_color.'; min-height:300px;}';
}
wp_add_inline_style( 'moon_shop_inline-style' , $custom_inline_style );

?>

<div class="single-offer offer-1">
	<div class="offer-wrap" >
		<div class="offer-brief-1 ps-static fix <?php echo $className;?>">
			<?php echo do_shortcode( $content );?>
		</div>
	</div>
</div>