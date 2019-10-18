<?php

extract( shortcode_atts(array(
	'title'				=> 	'',
	'bg_color'			=> 	'',
	'radious'			=>	'',
	'letter_spacing'	=> 	'',
	'padding_top'		=> 	'',
	'padding_left'		=> 	'',
	'padding_right'		=> 	'',
	'padding_bottom'	=> 	'',
	'opacity'			=> 	'',
	'font_size'			=> 	'',
	'line_height'		=> 	'',
	'text_color'		=> 	'',
	'font_style'		=> 	'',
	'alignment'			=> 	'',
	'text_transform'	=> 	'',
	 'google_fonts'     =>  ''
), $atts));


$font_family_name[0] = '';
$font_style_name[0] = '';
if($google_fonts !==""){
	$processing_google_font_data = explode( '|', rawurldecode( $atts['google_fonts'] ) );

	$processing_google_font_data['font-family']    = ltrim( $processing_google_font_data['0'], 'font_family:' );
	$processing_google_font_data['font-style']     = ltrim( $processing_google_font_data['1'], 'font_style:' );
	$font_family = $processing_google_font_data['font-family'];
	$font_style = $processing_google_font_data['font-style'];

	$font_family_name = explode(':',$font_family);
	$font_style_name = explode(' ',$font_style);

	wp_enqueue_style('style_icon' , '//fonts.googleapis.com/css?family=' . $processing_google_font_data['font-family'] );
}

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
	
	$custom_inline_style = ".$className {";
	$custom_inline_style .= "background:$bg_color;border-radius:$radious".'px'.";color:$text_color;line-height:$line_height".'px'.";font-size:$font_size".'px'.";font-family:$font_family_name[0];font-weight:$font_style_name[0];font-style:$font_style;text-transform:$text_transform;letter-spacing:$letter_spacing".'px'.";opacity:$opacity;padding-top:$padding_top".'px'.";padding-left:$padding_left".'px'.";padding-right:$padding_right".'px'.";padding-bottom:$padding_bottom".'px'.";}";
	wp_add_inline_style( 'moon_shop_inline-style' , $custom_inline_style );


	if(!function_exists('base_alignment')) {
		function base_alignment($alignment = null) {
			if(!empty($alignment)) {
				if($alignment == 'left' or $alignment == 'center' or $alignment == 'right') {
					return $alignment;
				} else {
					return false;
				}
			}
		}
	}
?>
<div class="text-<?php echo base_alignment($alignment); ?>">
	<span class="banner-label <?php echo $className;?>"><?php echo $title; ?></span>
</div>