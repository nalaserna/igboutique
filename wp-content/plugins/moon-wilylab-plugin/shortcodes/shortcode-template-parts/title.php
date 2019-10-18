<?php
extract( shortcode_atts( array( 'title' => '' , 'text_transform' => '', 'letter_spacing' => '', 'google_fonts' => '', 'title_hover_color'=>'', 'title_heading' => 'h2', 'title_content' => 'style-1' , 'line_height' => '', 'font_size' => '' , 'title_color' => '' , 'title_border_color' => '' , 'hide_title_border' => '' , 'use_title_link' => '', 'title_link' => '', 'target_link' => '',  ) , $atts ) );
    
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
    $custom_inline_style= '';
    $custom_inline_style = '.' . $className . '{ color: ' . $title_color . '; letter-spacing: '.$letter_spacing.'px; text-transform:'.$text_transform.';font-family: '.$font_family_name[0].',sans-serif; font-weight: '.$font_style_name[ 0 ].'; font-size: '.$font_size.'px; display: inline-block; line-height:'.$line_height.'px }';
    $custom_inline_style .= '.' . $className . ' a{color: ' . $title_color . ';}';
    $custom_inline_style .= '.' . $className . ' a:hover{color: ' . $title_hover_color . ';}';
    wp_add_inline_style( 'moon_shop_inline-style' , $custom_inline_style );
    ?>
    <?php
    if( $title_content == 'style-2' ) {?>
        <div class="wl-aligned-right">
            <div class="wl-section-heading">
                <?php 
                if($title_heading == 'h1'){?>
                    <h1 class="wl-margintopzero <?php echo $className;?>">
                        <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                        
                    </h1>
                <?php }?>
                <?php 
                if($title_heading == 'h2'){?>
                    <h2 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h2>
                <?php }?>
                <?php 
                if($title_heading == 'h3'){?>
                    <h3 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h3>
                <?php }?>
                <?php 
                if($title_heading == 'h4'){?>
                    <h4 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h4>
                <?php }?>
                <?php 
                if($title_heading == 'h5'){?>
                    <h5 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h5>
                <?php }?>
                <?php 
                if($title_heading == 'h6'){?>
                    <h6 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h6>
                <?php }?>
            </div>
        </div>
    <?php }?>
     <?php
    if( $title_content == 'style-3' ) {?>
        <div class="wl-aligned-center">
            <div class="wl-section-heading">
                <?php 
                if($title_heading == 'h1'){?>
                    <h1 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h1>
                <?php }?>
                <?php 
                if($title_heading == 'h2'){?>
                    <h2 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h2>
                <?php }?>
                <?php 
                if($title_heading == 'h3'){?>
                    <h3 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h3>
                <?php }?>
                <?php 
                if($title_heading == 'h4'){?>
                    <h4 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h4>
                <?php }?>
                <?php 
                if($title_heading == 'h5'){?>
                    <h5 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h5>
                <?php }?>
                <?php 
                if($title_heading == 'h6'){?>
                    <h6 class="wl-margintopzero <?php echo $className;?>">
                         <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                    </h6>
                <?php }?>
            </div>
        </div>
    <?php }?>
     <?php
    if( $title_content == 'style-1' ) {?>
        <div class="wl-section-heading">
            <?php 
            if($title_heading == 'h1'){?>
                <h1 class="wl-margintopzero <?php echo $className;?>">
                     <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                </h1>
            <?php }?>
            <?php 
            if($title_heading == 'h2'){?>
                <h2 class="wl-margintopzero <?php echo $className;?>">
                     <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                </h2>
            <?php }?>
            <?php 
            if($title_heading == 'h3'){?>
                <h3 class="wl-margintopzero <?php echo $className;?>">
                     <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                </h3>
            <?php }?>
            <?php 
            if($title_heading == 'h4'){?>
                <h4 class="wl-margintopzero <?php echo $className;?>">
                     <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                </h4>
            <?php }?>
            <?php 
            if($title_heading == 'h5'){?>
                <h5 class="wl-margintopzero <?php echo $className;?>">
                     <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                </h5>
            <?php }?>
            <?php 
            if($title_heading == 'h6'){?>
                <h6 class="wl-margintopzero <?php echo $className;?>">
                     <?php 
                            if($use_title_link == 'yes'){?>
                                <a href= "<?php echo esc_url($title_link); ?>" <?php if($target_link== 'yes'){ echo 'target="_blank"'; }?>><?php echo esc_html($title); ?></a>
                            <?php
                            }else{
                                echo $title;
                            }
                        ?>
                </h6>
            <?php }?>
        </div>
    <?php }?>



