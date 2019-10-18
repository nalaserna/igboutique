<?php
/**
 * Clients shortcode
 */
extract( shortcode_atts( array( 
    'size' => '', 
    'color' => '', 
    'hover_color' => '', 
    'position' => '',
    'facebook' => '',
    'twitter' => '',
    'google_plus' => '',
    'pinterest' => '',
    'icon_padding_left' => '',
    'icon_padding_right' => ''
	) , $atts ) 
);

if( !function_exists( 'w_studio_random_number' ) ) {
    function w_studio_random_number() {
        $class_name = 'wl-';
        for( $i = 0 ; $i < 5 ; $i++ ) {
            $class_name .= mt_rand( 0 , 9999 );
        }
        return $class_name;
    }
}
$className = w_studio_random_number();

if($position == '' || $position == 'left') {
	$position = 'text-left';
} else if($position == 'center') {
	$position = 'text-center';
} else if($position == 'right') {
	$position = 'text-right';
}
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$custom_inline_style = '';
$custom_inline_style .= '.wl-blog-media .wl-media-plot .'.$className.' a {padding-left: '.$icon_padding_left.'px; padding-right: '.$icon_padding_right.'px;}';
$custom_inline_style .= '.wl-blog-media .wl-media-plot .'.$className.' a i {font-size: '.$size.'px; color: '.$color.';}';
$custom_inline_style .= '.wl-blog-media .wl-media-plot .'.$className.' a:hover i {color: '.$hover_color.';}';
wp_add_inline_style( 'moon_shop_inline-style', $custom_inline_style );

?>

<div class="wl-media-icons wl-blog-media">
	<div class="wl-media-plot  row">
		<div class="wl-media-share <?php echo esc_attr($className).' '.$position; ?>">	
			<?php if( $facebook != '' ) { ?>
				<a href="<?php echo esc_url($facebook); ?>" target="_blank">
					<i class="fa fa-facebook" aria-hidden="true"></i>
				</a>
			<?php } if( $twitter != '' ) { ?>
				<a href="<?php echo esc_url($twitter); ?>" target="_blank">
					<i class="fa fa-twitter" aria-hidden="true"></i>

				</a>
			<?php } if( $google_plus != '' ) { ?>
				<a href="<?php echo esc_url($google_plus); ?>" target="_blank">
					<i class="fa fa-google-plus" aria-hidden="true"></i>
				</a>
			<?php } if( $pinterest != '' ) { ?>
				<a href="<?php echo esc_url($pinterest); ?>" target="_blank">
					<i class="fa fa-pinterest-p" aria-hidden="true"></i>
				</a>
			<?php } ?>
		</div>
	</div>
</div>