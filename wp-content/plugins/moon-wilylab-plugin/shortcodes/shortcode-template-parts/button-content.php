<?php
/**
 * Button shortcode
 */
extract( shortcode_atts( array( 
    'button_size' => '', 
    'button_align' => '',
    'icon' => '',
    'icon_color' => '',
    'icon_hover_color' => '',
    'icon_fontawesome'=> '',
    'icon_openiconic'=> '',
    'icon_typicons'=> '',
    'icon_entypo'=> '',
    'icon_linecons'=> '',
    'icon_monosocial'=> '',
    'text' => '',
    'btn_link' => '',
    'text_color' => '',
    'text_hover_color' => '',
    'text_transform' => '',
    'google_fonts' => '',
    'font_size' => '',
    'background_color' => '',
    'border_color' => '',
    'border_radius' => '',
    'background_hover_color' => '',
    'border_hover_color' => ''  ) , $atts ) 
);
$font_family_name[0] = '';
$font_style_name[0] = '';
if( $google_fonts !== "" ) {
    $processing_google_font_data = explode( '|' , rawurldecode( $atts[ 'google_fonts' ] ) );

    $processing_google_font_data[ 'font-family' ] = ltrim( $processing_google_font_data[ '0' ] , 'font_family:' );
    $processing_google_font_data[ 'font-style' ] = ltrim( $processing_google_font_data[ '1' ] , 'font_style:' );
    $font_family = $processing_google_font_data[ 'font-family' ];
    $font_style = $processing_google_font_data[ 'font-style' ];
    $font_family_name = explode( ':' , $font_family );
    $font_style_name = explode( ' ' , $font_style );
    wp_enqueue_style( 'style_icon' , '//fonts.googleapis.com/css?family=' . $processing_google_font_data[ 'font-family' ] );

}

if($button_size == 'small' || $button_size == '') {
	$button_class = 'sm';
} else if($button_size == 'medium') {
	$button_class = 'md';
} else if($button_size == 'large') {
	$button_class = 'lg';
}

if($button_align == 'center' || $button_align == '') {
	$button_position = 'text-center';
} else if($button_align == 'left') {
	$button_position = 'text-left';
} else {
	$button_position = 'text-right';
}

if($text_transform == '') {
	$text_transform = 'uppercase';
}

if( !function_exists( 'moon_wl_random_number' ) ) {
        function moon_wl_random_number() {
            $class_name = 'wl-';

            for( $i = 0 ; $i < 5 ; $i++ ) {
                $class_name .= mt_rand( 0 , 9999 );
            }
            return $class_name;
        }
    }
$sp_icon = '';
if($icon_fontawesome !== ''){
    $sp_icon = $icon_fontawesome;
}
if($icon_openiconic !== ''){
    $sp_icon = $icon_openiconic;
    $icon_style = wp_enqueue_style( 'custom-style2' , get_template_directory_uri() . '/assets/lib/vc-open-iconic/vc_openiconic.min.css' );
}
if($icon_typicons !== ''){
    $sp_icon = $icon_typicons;
    $icon_style = wp_enqueue_style( 'custom-style2' , get_template_directory_uri() . '/assets/lib/typicons/src/font/typicons.min.css' );
}
if($icon_entypo !== ''){
    $sp_icon = $icon_entypo;
    $icon_style = wp_enqueue_style( 'custom-style2' , get_template_directory_uri() . '/assets/lib/vc-entypo/vc_entypo.min.css' );
}
if($icon_linecons !== ''){
    $sp_icon = $icon_linecons;
    $icon_style = wp_enqueue_style( 'custom-style2' , get_template_directory_uri() . '/assets/lib/vc-linecons/vc_linecons_icons.min.css' );
}
if($border_hover_color == false){
    $border_hover_color = $border_color;
}

$className = moon_wl_random_number();
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$custom_inline_style = '';
$custom_inline_style .= '.w-button.'.$className.' button.f-btn {background-color: '.$background_color.'; border: 2px solid '.$border_color.'; border-radius: '.$border_radius.'px; color: '.$text_color.'; font-size: '.$font_size.'px; font-family: '.$font_family_name[ 0 ].'; font-weight: '.$font_style_name[ 0 ].'; text-transform: '.$text_transform.'; padding: 0 15px;}';
$custom_inline_style .= '.w-button.'.$className.' button.f-btn:hover {background-color: '.$background_hover_color.'; border: 2px solid '.$border_hover_color.'; color: '.$text_hover_color.';}';
$custom_inline_style .= '.w-button.'.$className.' button.f-btn i {color: '.$icon_color.';}';
$custom_inline_style .= '.w-button.'.$className.' button.f-btn:hover i {color: '.$icon_hover_color.';}';
wp_add_inline_style( 'moon_shop_inline-style', $custom_inline_style );

?>
<div class="w-button <?php echo $button_position.' '.$className ?>">
    <a href="<?php echo esc_url($btn_link);?>">
    	<button class="f-btn bg <?php echo esc_attr($button_class); ?>">
    		<?php if($icon != '') { ?>
    			<i class="<?php echo esc_attr($sp_icon); ?>"></i>
    		<?php } ?>
    		<?php echo $text; ?>
    	</button>
    </a>
</div>

