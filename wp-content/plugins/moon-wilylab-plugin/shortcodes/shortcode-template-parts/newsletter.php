<?php   extract( shortcode_atts( array(
    'title' => '',
    'title_color' => '',
    'font_size' => '',
    'line_height' => '',
    'letter_spacing' => '',
    'title_case' => '',
    'content_color' => '',
    'newletter_cont' => '',
    'google_fonts' => '',
    'mailchimp_id' => '',
    'content_alinged' => '',
    'form_margin_top' => '',
    'form_margin_bottom' => ''
    
    ), $atts ) );
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
    $custom_inline_style .='.'.$className.' h2{color: '.$title_color.'; text-transform:'.$title_case.'; letter-spacing:'.$letter_spacing.'px; font-size:'.$font_size.'px; line-height:'.$line_height.'px; }';
    $custom_inline_style .='.'.$className.' p{color: '.$content_color.';}';
    $custom_inline_style .='.'.$className.' form{margin-top: '.$form_margin_top.'px; margin-bottom: '.$form_margin_bottom.'px;}';
    $custom_inline_style .='.'.$className. ' *{font-family: '.$font_family_name[ 0 ].'; font-weight: '.$font_style_name[ 0 ].';}';
   if($content_alinged == 'center'){
    $custom_inline_style .='.'.$className.' {text-align: center;}';
    $custom_inline_style .='.'.$className.' .mc4wp-form-fields{margin: auto; width: 600px;}';
    $custom_inline_style .='.'.$className.' .mc4wp-response {clear: both;display: block;float: none;margin: auto;width: 600px;}';
    $custom_inline_style .='.'.$className.' .mc4wp-alert.mc4wp-success{margin: auto;width: 80%;}';
   }
   if($content_alinged == 'right'){
    $custom_inline_style .='.'.$className.' {text-align: right;}';
    $custom_inline_style .='.'.$className.' .mc4wp-form-fields{ float: right;}';
    $custom_inline_style .='.'.$className.' .mc4wp-response {clear: both;display: block;float: right ;width: 600px;}';
    $custom_inline_style .='.'.$className.' .mc4wp-alert.mc4wp-success{width: 80%;}';
   }
    wp_add_inline_style( 'moon_shop_inline-style', $custom_inline_style );

?>
<div class="subscribe-container <?php echo $className ?> ">
    <!-- Subscribe Text -->
    <div class="fix">
        <h2><?php echo $title;?></h2>
        <p><?php echo $newletter_cont;?></p>
    </div>
    <!-- Subscribe Form -->
    <div class="subscribe-form fix">
        <?php echo do_shortcode('[mc4wp_form id="'.$mailchimp_id.'"]');?>
    </div>
</div>