 <?php   extract( shortcode_atts( array(
    'title' => '',
    'title_color' => '',
    'title_font_size' => '',
    'title_line_height' => '',
    'google_fonts' => '',
    'description' => '',
    'description_color' => '',
    'description_font_size' => '',
    'description_line_height' => '',
    'background_image' => '',
    'overlay_color' => '',
    'padding' => '',
    'padding_left' => '',
    'is_button' => '',
    'button_size' => '', 
    'button_align' => '',
    'button_new_tab' => '',
    'button_top_margin' => '23',
    'icon' => '',
    'icon_color' => '',
    'icon_hover_color' => '',
    'text' => '',
    'btn_link' => '',
    'text_color' => '',
    'text_hover_color' => '',
    'text_transform' => '',
    'google_fonts' => '',
    'font_size' => '',
    'background_color' => '',
    'border_color' => '',
    'background_hover_color' => 'transparent',
    'border_hover_color' => '',
    'cont_text_position' => 'left',
    'cont_text_align' => '',
    'icon_fontawesome'=> '',
    'icon_openiconic'=> '',
    'icon_typicons'=> '',
    'icon_entypo'=> '',
    'icon_linecons'=> '',
    'icon_monosocial'=> '',
    'button_border_radius' => ''
    ), $atts ) );

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

if (!function_exists ('random_number')) {
    function random_number() {
        $class_btn = 'wll-';
        for ($i = 0; $i<10; $i++) {
            $class_btn .= mt_rand(0,9999);
        }
        return $class_btn;
    }
}
$classBtn = random_number();
$class1 = random_number(); 

wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$custom_inline_style = '';
$custom_inline_style .= '.wl-cta-background {background-image: url('.wp_get_attachment_image_src($background_image,'large')[0].'); background-repeat: no-repeat; background-size: cover; display: inline-block; position: relative; width: 100%; height: 100%;}';
$custom_inline_style .= '.'.$classBtn.' .cta-desc h2 {font-family: '.$font_family_name[0].',sans-serif; font-weight: '.$font_style_name[ 0 ].'; color: '.$title_color.'; font-size: '.$title_font_size.'px; line-height: '.$title_line_height.'px}';
$custom_inline_style .= '.'.$classBtn.' .cta-desc *{font-family: '.$font_family_name[0].',sans-serif; font-weight: '.$font_style_name[ 0 ].';}';
$custom_inline_style .= '.'.$classBtn.' .cta-desc p { color: '.$description_color.'; font-size: '.$description_font_size.'px; line-height: '.$description_line_height.'px}';
$custom_inline_style .= '.'.$classBtn.' .w-button button {border-radius: '.$button_border_radius.'px; border: 2px solid '.$border_color.';background: '.$background_color.'}';
$custom_inline_style .= '.'.$classBtn.' .f-btn { color: '.$text_color.';}';
$custom_inline_style .= '.'.$classBtn.' .f-btn.bg:hover { color: '.$text_hover_color.';}';
$custom_inline_style .= '.'.$classBtn.' .w-button {margin-top: '.$button_top_margin.'px;}';
$custom_inline_style .= '.'.$classBtn.' .w-button button.f-btn {background-color: '.$background_color.'; border: 2px solid '.$border_color.'; color: '.$text_color.'; font-size: '.$font_size.'px; font-family: '.$font_family_name[ 0 ].'; font-weight: '.$font_style_name[ 0 ].'; text-transform: '.$text_transform.';}';
$custom_inline_style .= '.'.$classBtn.' .w-button button.f-btn:hover {background-color: '.$background_hover_color.'; border: 2px solid '.$border_hover_color.'; color: '.$text_hover_color.';}';
$custom_inline_style .= '.'.$classBtn.' .w-button button.f-btn i {color: '.$icon_color.';}';
$custom_inline_style .= '.'.$classBtn.' .w-button button.f-btn:hover i{color: '.$icon_hover_color.';}';
$custom_inline_style .= '.'.$class1.' .wl-cta-overlay {background-color:'.$overlay_color.';padding: '.$padding.'px '.$padding_left.'px; float: left; height: 100%; width: 100%;}';
 wp_add_inline_style( 'moon_shop_inline-style' , $custom_inline_style );
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
if($button_top_margin == '') {
    $button_top_margin = '23';
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

if($is_button) {
    $class = 'col-lg-9 col-md-9 col-sm-8';
} else {
    $class = 'col-lg-12 col-md-12 col-sm-12';
}

if($cont_text_position== 'right')
{
?>

<div class="row">
    <div class="col-md-12">
        <div class="wl-cta-background <?php echo $class1;?>">
            <div class="wl-cta-overlay">
               
                <?php if($is_button) { ?>
                <div class="col-lg-3 col-md-3 col-sm-4 <?php echo esc_attr($classBtn); ?>">
                    <div class="w-button <?php echo esc_attr($button_position); ?>">
                        <a href="<?php echo esc_url($btn_link);?>" <?php echo ($button_new_tab) ? 'target="_blank"' : ''; ?>>
                            <button class="f-btn bg <?php echo esc_attr($button_class); ?>">
                                <?php if($icon != '') { ?>
                                    <i class="<?php echo esc_attr($sp_icon); ?>"></i>
                                <?php } ?>
                                <?php echo ($text != '') ? $text : 'Buy Now'; ?>
                            </button>
                        </a>
                    </div>
                    <?php } ?>
                </div> 
                 <div class="<?php echo esc_attr($classBtn).' '.$class.' '.$cont_text_align; ?>">
                    <div class="cta-desc">      
                        <h2><?php echo $title;?></h2>
                        <p><?php echo $description ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
if($cont_text_position== 'left')
{
?>
<div class="row">
    <div class="col-md-12">
        <div class="wl-cta-background <?php echo $class1;?>">
            <div class="wl-cta-overlay">
                <div class="<?php echo esc_attr($classBtn).' '.$class.' '.$cont_text_align; ?>">
                    <div class="cta-desc">      
                        <h2><?php echo $title;?></h2>
                        <p><?php echo $description ?></p>
                    </div>
                </div>
                <?php if($is_button) { ?>
                <div class="col-lg-3 col-md-3 col-sm-4 <?php echo esc_attr($classBtn); ?>">
                    <div class="w-button <?php echo esc_attr($button_position); ?>">
                        <a href="<?php echo esc_url($btn_link);?>" <?php echo ($button_new_tab) ? 'target="_blank"' : ''; ?>>
                            <button class="f-btn bg <?php echo esc_attr($button_class); ?>">
                                <?php if($sp_icon != '') { ?>
                                    <i class="<?php echo esc_attr($sp_icon); ?>"></i>
                                <?php } ?>
                                <?php echo ($text != '') ? $text : 'Buy Now'; ?>
                            </button>
                        </a>
                    </div>
                    <?php } ?>
                </div> 
            </div>
        </div>
    </div>
</div>
<?php }?>