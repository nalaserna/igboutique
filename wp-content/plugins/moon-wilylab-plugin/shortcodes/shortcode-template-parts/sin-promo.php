<?php
extract( shortcode_atts( array(
    'imageurl' => '',
    'image_size' => '',
    'title' => '' , 
    'title_tag' => '' , 
    'title_content' => 'style-1' , 
    'line_height' => '', 
    'font_size' => '' , 
    'title_color' => '' , 
    'border_color' => '' ,
    'other_content' => '',
    'other_content_link' => '',
    'other_content2' => '',
    'other_content_link2' => '',
    'other_content_color' => '',
    'other_content_hover_color' => '',
    'other_content_devider_color' => '',
    'google_fonts' => '' 
) , $atts ) );
    
    if($title_tag == 'h1') {
        $title_tag = 'h1';
    } else if($title_tag == 'h2') {
        $title_tag = 'h2';
    } else if($title_tag == 'h3') {
        $title_tag = 'h3';
    } else if($title_tag == 'h4') {
        $title_tag = 'h4';
    } else if($title_tag == 'h5') {
        $title_tag = 'h5';
    } else if($title_tag == 'h6') {
        $title_tag = 'h6';
    } else{
        $title_tag = 'span';
    }

    $imageid = wp_get_attachment_image_src( $imageurl, 'moon_shop_image_1170x878' );
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

     if( !function_exists( 'w_studio_random_number2' ) ) {
        function w_studio_random_number2() {
            $class_name = 'wl-';

            for( $i = 0 ; $i < 5 ; $i++ ) {
                $class_name .= mt_rand( 0 , 9999 );
            }
            return $class_name;
        }
    }
    $borderclassName = w_studio_random_number2(); 

     if( !function_exists( 'w_studio_random_number2' ) ) {
        function w_studio_random_number2() {
            $class_name = 'wl-';

            for( $i = 0 ; $i < 5 ; $i++ ) {
                $class_name .= mt_rand( 0 , 9999 );
            }
            return $class_name;
        }
    }
    $otherclassName = w_studio_random_number2();    

    wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
    $custom_inline_style= '';
    $custom_inline_style = '.' . $className . ' '.$title_tag.'{ color: ' . $title_color . ';font-family: '.$font_family_name[0].',sans-serif; font-weight: '.$font_style_name[ 0 ].'; font-size: '.$font_size.'px; display: inline-block; line-height:'.$line_height.'px }';
    $custom_inline_style .= '.' . $borderclassName.'::before{ background: ' . $border_color . ' }';
    $custom_inline_style .= '.' . $borderclassName.'::after{ background: ' . $border_color . ' }';
    $custom_inline_style .= '.' . $otherclassName.' a{ color: ' . $other_content_color . ' }'; 
       $custom_inline_style .= '.' . $otherclassName.' a:hover{ color: ' . $other_content_hover_color . ' }'; 
       $custom_inline_style .= '.' . $otherclassName.' a:after{ color: ' . $other_content_devider_color . ' }';     
    wp_add_inline_style( 'moon_shop_inline-style' , $custom_inline_style );
    ?>

<?php
if($title_content == 'style-1' ){ ?>
    <div class="two-column-promo sin-promo-left">
        <div class="two-column-promo-container">
            <div class="sin-promo fix">
                <div class="promo-border-top-bottom <?php echo $borderclassName;?>"></div>
                <div class="promo-border-left-right <?php echo $borderclassName;?>"></div>
                <img src="<?php echo $imageid[0]; ?>" alt="promo" />
                <div class="promo-title promo-title-left <?php echo $className;?>">
                    <<?php echo esc_attr($title_tag); ?>><?php echo $title;?></<?php echo esc_attr($title_tag); ?>>
                </div>
                <div class="links <?php echo $otherclassName;?>">

                    <?php if($other_content !== ''){?>
                        <a href="<?php echo !empty($other_content_link) ? $other_content_link : 'javascript:void(0)';?>"><?php echo $other_content;?> </a>
                    <?php }?>
                    <?php if($other_content2 !== ''){?>
                        <a href="<?php echo !empty($other_content_link2) ? $other_content_link2 : 'javascript:void(0)';?>"><?php echo $other_content2;?> </a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
<?php   
} else if($title_content == 'style-2' ){ ?>
    <div class="two-column-promo">         
        <div class="two-column-promo-container">
            <div class="sin-promo sin-promo-right fix">
                <div class="promo-border-top-bottom <?php echo $borderclassName;?>"></div>
                <div class="promo-border-left-right <?php echo $borderclassName;?>"></div>
                <img src="<?php echo $imageid[0]; ?>" alt="promo" />
                <div class="promo-title promo-title-right <?php echo $className;?>">
                    <<?php echo esc_attr($title_tag); ?>><?php echo $title;?></<?php echo esc_attr($title_tag); ?>>
                </div>
                <div class="links <?php echo $otherclassName;?>">
                    <?php if($other_content !== ''){?>
                        <a href="<?php echo !empty($other_content_link) ? $other_content_link : 'javascript:void(0)';?>"><?php echo $other_content;?> </a>
                    <?php }?>
                    <?php if($other_content2 !== ''){?>
                        <a href="<?php echo !empty($other_content_link2) ? $other_content_link2 : 'javascript:void(0)';?>"><?php echo $other_content2;?> </a>
                    <?php }?>
                </div>
            </div>
        </div>     
    </div>
<?php } ?>
<script>
    var windowSize = jQuery(window).width();
    if(windowSize < 768){
        jQuery('.sin-promo-left').closest('.vc_column-inner').css('padding-right', 15);
        jQuery('.sin-promo-right').closest('.vc_column-inner').css('padding-left', 15);
    }else{
        jQuery('.sin-promo-left').closest('.vc_column-inner').css('padding-right', 0);
        jQuery('.sin-promo-right').closest('.vc_column-inner').css('padding-left', 0);
    }
</script>