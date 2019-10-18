<?php
/* Get Theme Option Values */

// only Title *************
add_action( 'vc_before_init', 'moon_wl_title_vc' );
function moon_wl_title_vc(){
   vc_map( array(
    "name" => esc_html__("Title", "moon-wl-plugin"),
    "base" => "moon_wl_titles",
    "class" => "moon_wl_vc_map",
    "category" => esc_html__( "Moon", "moon-wl-plugin"),
    "content_element" => true,
    "show_settings_on_create" => true,
    "description" => esc_html__( "Title style", "moon-wl-plugin" ),
    "params" => array(
        array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__( "Select element tag", "moon-wl-plugin" ),
                "param_name" => "title_heading",
                "value" => array(
                    "Select" => "0",
                    "H1" => "h1",
                    "H2" => "h2",
                    "H3" => "h3",
                    "H4" => "h4",
                    "H5" => "h5",
                    "H6" => "h6",
                )
            ),
         array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__( "Alignment", "moon-wl-plugin" ),
                "param_name" => "title_content",
                "value" => array(
                    "Align Left" => "style-1",
                    "Align Right" => "style-2",
                    "Align Center" => "style-3"
                )
        ),
          array(
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_html__( "Text transform", "moon-wl-plugin" ),
              "param_name" => "text_transform",
              "value" => array(
                  "Default" => "inherit",
                  "Uppercase" => "uppercase",
                  "Capitalize" => "capitalize",
                  "Inherit" => "inherit",
              )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title", "moon-wl-plugin" ),
            "param_name" => "title",
            "description" => esc_html__( "You can use <br> for line break", "moon-wl-plugin" )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title font size", "moon-wl-plugin" ),
            "param_name" => "font_size",
            "description" => "(px)"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title line height", "moon-wl-plugin" ),
            "param_name" => "line_height",
            "description" => "(px)"
        ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Letter spacing", "moon-wl-plugin" ),
            "param_name" => "letter_spacing",
            "description" => "(px)"
        ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Title color", "moon-wl-plugin" ),
             "param_name" => "title_color",
             "value" => "#222222",
         ),
         array(
             "type" => "checkbox",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Use link", "moon-wl-plugin" ),
             "param_name" => "use_title_link",
              'value'         => array( 'Yes' => 'yes' ),
          ),
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title link", "moon-wl-plugin" ),
            "param_name" => "title_link",
            'dependency' => array(
                'element' => 'use_title_link',
                'value' => 'yes',
            ),
        ),
         array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Link hover color", "moon-wl-plugin" ),
             "param_name" => "title_hover_color",
             "value" => "#222222",
              'dependency' => array(
                    'element' => 'use_title_link',
                    'value' => 'yes',
            ),
         ),
         array(
             "type" => "checkbox",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Link target blank", "moon-wl-plugin" ),
             "param_name" => "target_link",
             'value'         => array( 'Yes' => 'yes' ),
             'dependency' => array(
                    'element' => 'use_title_link',
                    'value' => 'yes',
            ),
          ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use theme default font family?', 'moon-wl-plugin' ),
            'param_name' => 'use_theme_fonts',
            'value' => array( 'Yes' => 'yes' ),
            'description' => esc_html__( 'Use font family from the theme.', 'moon-wl-plugin' ),
      ),
      array(
          'type' => 'google_fonts',
          'param_name' => 'google_fonts',
          'value' => '',
          'settings' => array(
                  'fields' => array(
                          'font_family_description' => esc_html__( 'Select Title font family.', 'moon-wl-plugin' ),
                          'font_style_description' => esc_html__( 'Select Title font styling.', 'moon-wl-plugin' ),
                  ),
          ),
          'dependency' => array(
                  'element' => 'use_theme_fonts',
                  'value_not_equal_to' => 'yes',
          ),
      ),
           
    )
    ) ); 
}

//cta box content *************
add_action( 'vc_before_init', 'moon_wl_cta_box_vc' );
function moon_wl_cta_box_vc() {
   vc_map( array(
    "name" => esc_html__("CTA Box", "moon-wl-plugin"),
    "base" => "moon_wl_cta_box",
    "class" => "moon_wl_vc_map",
    "category" => esc_html__( "Moon", "moon-wl-plugin"),
    "content_element" => true,
    "show_settings_on_create" => true,
    "description" => esc_html__( "Call to action", "moon-wl-plugin" ),
    "params" => array(
      array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Title", "moon-wl-plugin" ),
            "param_name"    => "title",
            "description"   => esc_html__( "Title here", "moon-wl-plugin" )
        ),
         array(
            "type"              => "colorpicker",
            "holder"            => "div",
            "class"             => "",
            "heading"           => esc_html__( "Title color", "moon-wl-plugin" ),
            "param_name"        => "title_color",
            "value"             => "#e5e5e5",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Title font size", "moon-wl-plugin" ),
            "param_name"    => "title_font_size",
            "description"   => "(px)"
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Title line height", "moon-wl-plugin" ),
            "param_name"    => "title_line_height",
            "description"   => "(px)"
        ),
        array(
            "type"          => "textarea",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Description", "moon-wl-plugin" ),
            "param_name"    => "description",
        ),
         array(
            "type"              => "colorpicker",
            "holder"            => "div",
            "class"             => "",
            "heading"           => esc_html__( "Description color", "moon-wl-plugin" ),
            "param_name"        => "description_color",
            "value"             => "#e5e5e5",
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Description font size", "moon-wl-plugin" ),
            "param_name"    => "description_font_size",
            "description"   => "(px)"
        ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Description line height", "moon-wl-plugin" ),
            "param_name"    => "description_line_height",
            "description" => "(px)"
        ),
      array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use theme default font family?', 'moon-wl-plugin' ),
            'param_name' => 'use_theme_fonts',
            'value' => array( 'Yes' => 'yes' ),
            'description' => esc_html__( 'Use font family from the theme.', 'moon-wl-plugin' ),
      ),
      array(
          'type' => 'google_fonts',
          'param_name' => 'google_fonts',
          'value' => '',
          'settings' => array(
                  'fields' => array(
                          'font_family_description' => esc_html__( 'Select Title font family.', 'moon-wl-plugin' ),
                          'font_style_description' => esc_html__( 'Select Title font styling.', 'moon-wl-plugin' ),
                  ),
          ),
          'dependency' => array(
                  'element' => 'use_theme_fonts',
                  'value_not_equal_to' => 'yes',
          ),
      ),
      array(
            "type"              => "attach_image",
            "holder"            => "div",
            "class"             => "",
            "heading"           => esc_html__( "Add background image", "moon-wl-plugin" ),
            "param_name"        => "background_image",
        ),
       array(
            "type"              => "colorpicker",
            "holder"            => "div",
            "class"             => "",
            "heading"           => esc_html__( "Background overlay color", "moon-wl-plugin" ),
            "param_name"        => "overlay_color",
        ),
       array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Top bottom padding", "moon-wl-plugin" ),
            "param_name"    => "padding",
            "description" => "(px)"
        ),
       array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Left right padding", "moon-wl-plugin" ),
            "param_name"    => "padding_left",
            "description" => "(px)"
        ),
       array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Content position", "moon-wl-plugin" ),
          "param_name" => "cont_text_position",
          "value" => array(
              "Left" => "letf",
              "Right" => "right"
          )
      ),
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Content text align", "moon-wl-plugin" ),
          "param_name" => "cont_text_align",
          "value" => array(
              "Left" => "text-left",
              "Center" => "text-center",
              "Right" => "text-right"
          )
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Show button", "moon-wl-plugin" ),
         "param_name" => "is_button",
         "group" => "Button Style"
      ),
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Select button size", "moon-wl-plugin" ),
          "param_name" => "button_size",
          "value" => array(
              "Small" => "small",
              "Medium" => "medium",
               "Large" => "large"
          ),
          "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
          "group" => "Button Style"
      ),
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Select button position", "moon-wl-plugin" ),
          "param_name" => "button_align",
          "value" => array(
              "Center" => "center",
              "Left" => "left",
               "Right" => "right"
          ),
          "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
          "group" => "Button Style"
      ),
      array(
         "type" => "checkbox",
         "holder" => "div",
         "heading" => esc_html__( "New Tab?", "moon-wl-plugin" ),
         "param_name" => "button_new_tab",
         "group" => "Button Style",
         "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
      ),
      array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button top margin", "moon-wl-plugin" ),
          "param_name" => "button_top_margin",
          "value" => "23",
          "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
          "group" => "Button Style"
      ),
      
      array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button text", "moon-wl-plugin" ),
          "param_name" => "text",
          "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
          "group" => "Button Style"
      ),
      array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button link", "moon-wl-plugin" ),
          "param_name" => "btn_link",
          "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
          "group" => "Button Style"
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Button text color", "moon-wl-plugin" ),
         "param_name" => "text_color",
         "value" => "#fcfcfc",
         "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
         "group" => "Button Style"
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Button text hover color", "moon-wl-plugin" ),
         "param_name" => "text_hover_color",
         "value" => "#222222",
         "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
         "group" => "Button Style"
      ),
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button text transform", "moon-wl-plugin" ),
          "param_name" => "text_transform",
          "value" => "uppercase",
          "value" => array(
              "Default" => "default",
              "Capitalize" => "capitalize",
              "Lowercase" => "lowercase",
              "Uppercase" => "uppercase"
          ),
          "dependency" => array(
            "element" => "is_button",
            "not_empty" => true,
          ),
          "group" => "Button Style"
      ),
      array(
        "type" => "textfield",
        "holder" => "div",
        "class" => "",
        "heading" => esc_html__( "Font size", "moon-wl-plugin" ),
        "param_name" => "font_size",
        "description" => "(px)",
        "dependency" => array(
          "element" => "is_button",
          "not_empty" => true,
        ),
        "group" => "Button Style"
      ),
      array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_html__( "Background color", "moon-wl-plugin" ),
           "param_name" => "background_color",
           "value" => "#111111",
           "dependency" => array(
              "element" => "is_button",
              "not_empty" => true,
            ),
           "group" => "Button Style"
        ),
       array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_html__( "Background hover color", "moon-wl-plugin" ),
           "param_name" => "background_hover_color",
           "value" => "#fcfcfc",
           "dependency" => array(
              "element" => "is_button",
              "not_empty" => true,
            ),
           "group" => "Button Style"
        ), 
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Border color", "moon-wl-plugin" ),
             "param_name" => "border_color",
             "value" => "#111111",
             "dependency" => array(
                "element" => "is_button",
                "not_empty" => true,
              ),
             "group" => "Button Style"
        ),
       
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_html__( "Border hover color", "moon-wl-plugin" ),
           "param_name" => "border_hover_color",
           "value" => "#fcfcfc",
           "dependency" => array(
              "element" => "is_button",
              "not_empty" => true,
            ),
           "group" => "Button Style"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Button border radius", "moon-wl-plugin" ),
            "param_name" => "button_border_radius",
            "description" => "(px)",
            "dependency" => array(
              "element" => "is_button",
              "not_empty" => true,
            ),
             'dependency'        => array(
                        'element'       => 'is_button',
                        'not_empty' => true,
                ),
            "group" => "Button Style"
      ),
        array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Use Icon", "moon-wl-plugin" ),
            "param_name"    => "icon",
            'value'         => array( 'Yes' => 'yes' ),
            "group" => "Button Style"
        ),
        array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Icon color", "moon-wl-plugin" ),
         "param_name" => "icon_color",
         "dependency" => array(
            "element" => "icon",
            "not_empty" => true,
          ),
         "group" => "Button Style"
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Icon hover color", "moon-wl-plugin" ),
         "param_name" => "icon_hover_color",
         "value" => "#222222",
         "dependency" => array(
            "element" => "icon",
            "not_empty" => true,
          ),
         "group" => "Button Style"
      ),
      array(
          'type' => 'dropdown',
          'heading' => esc_html__( 'Icon library', 'moon-wl-plugin' ),
          'value' => array(
                  esc_html__( 'Font Awesome', 'moon-wl-plugin' ) => 'fontawesome',
                  esc_html__( 'Open Iconic', 'moon-wl-plugin' ) => 'openiconic',
                  esc_html__( 'Typicons', 'moon-wl-plugin' ) => 'typicons',
                  esc_html__( 'Entypo', 'moon-wl-plugin' ) => 'entypo',
                  esc_html__( 'Linecons', 'moon-wl-plugin' ) => 'linecons',
                  esc_html__( 'Mono Social', 'moon-wl-plugin' ) => 'monosocial',
                  esc_html__( 'Elegent', 'moon-wl-plugin' ) => 'elegent',
          ),
          'admin_label' => true,
          'param_name' => 'type',
          'description' => esc_html__( 'Select icon library.', 'moon-wl-plugin' ),
          "group" => "Button Style",
          'dependency'        => array(
                  'element'       => 'icon',
                  'not_empty' => true,
          )
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
            "group" => "Button Style",
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'openiconic',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
            "group" => "Button Style",
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'typicons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
            "group" => "Button Style",
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'entypo',
            ),
            "group" => "Button Style",
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'linecons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
            "group" => "Button Style",
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_monosocial',
            'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'monosocial',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'monosocial',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
            "group" => "Button Style"
        ),        
    )
    ) ); 
}

//Button shortcode 
add_action( 'vc_before_init', 'moon_wl_button_vc' );
function moon_wl_button_vc() {
   vc_map( array(
    "name" => esc_html__("Button", "moon-wl-plugin"),
    "base" => "moon_wl_button",
    "class" => "moon_wl_vc_map",
    "category" => esc_html__( "Moon", "moon-wl-plugin"),
    "content_element" => true,
    "show_settings_on_create" => true,
    "description" => esc_html__( "Button style", "moon-wl-plugin" ),
    "params" => array(
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button size", "moon-wl-plugin" ),
          "param_name" => "button_size",
          "value" => array(
              "Small" => "small",
              "Medium" => "medium",
               "Large" => "large"
          )
      ),
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button position", "moon-wl-plugin" ),
          "param_name" => "button_align",
          "value" => array(
              "Center" => "center",
              "Left" => "left",
               "Right" => "right"
          )
      ),
      array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button text", "moon-wl-plugin" ),
          "param_name" => "text",
      ),
      array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button link", "moon-wl-plugin" ),
          "param_name" => "btn_link",
      ),
      array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Border radius", "moon-wl-plugin" ),
          "param_name" => "border_radius",
      ),
      array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Button text transform", "moon-wl-plugin" ),
          "param_name" => "text_transform",
          "value" => "uppercase",
          "value" => array(
              "Default" => "default",
              "Capitalize" => "capitalize",
              "Lowercase" => "lowercase",
              "Uppercase" => "uppercase"
          )
      ),
      array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use theme default font family?', 'moon-wl-plugin' ),
            'param_name' => 'use_theme_fonts',
            'value' => array( esc_html__( 'Yes', 'moon-wl-plugin' ) => 'yes' ),
            'description' => esc_html__( 'Use font family from the theme.', 'moon-wl-plugin' ),
        ),
        array(
            'type' => 'google_fonts',
            'param_name' => 'google_fonts',
            'value' => '',
            'settings' => array(
                    'fields' => array(
                            'font_family_description' => esc_html__( 'Select font family.', 'moon-wl-plugin' ),
                            'font_style_description' => esc_html__( 'Select font styling.', 'moon-wl-plugin' ),
                    ),
            ),
            'dependency' => array(
                    'element' => 'use_theme_fonts',
                    'value_not_equal_to' => 'yes',
            ),
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Font size", "moon-wl-plugin" ),
          "param_name" => "font_size",
          "description" => "(px)"
        ),
        
         array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => esc_html__( "Use Icon", "moon-wl-plugin" ),
            "param_name"    => "icon",
            'value'         => array( 'Yes' => 'yes' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon library', 'moon-wl-plugin' ),
            'value' => array(
                    esc_html__( 'Font Awesome', 'moon-wl-plugin' ) => 'fontawesome',
                    esc_html__( 'Open Iconic', 'moon-wl-plugin' ) => 'openiconic',
                    esc_html__( 'Typicons', 'moon-wl-plugin' ) => 'typicons',
                    esc_html__( 'Entypo', 'moon-wl-plugin' ) => 'entypo',
                    esc_html__( 'Linecons', 'moon-wl-plugin' ) => 'linecons',
            ),
            'admin_label' => true,
            'param_name' => 'type',
            'description' => esc_html__( 'Select icon library.', 'moon-wl-plugin' ),
            'dependency'        => array(
                    'element'       => 'icon',
                    'not_empty' => true,
            )
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_fontawesome',
            'value' => 'fa fa-adjust', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 4000,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_openiconic',
            'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'openiconic',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'openiconic',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_typicons',
            'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'typicons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'typicons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_entypo',
            'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'entypo',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'entypo',
            ),
    ),
    array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'moon-wl-plugin' ),
            'param_name' => 'icon_linecons',
            'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
            'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'linecons',
                    'iconsPerPage' => 4000, // default 100, how many icons per/page to display
            ),
            'dependency' => array(
                    'element' => 'type',
                    'value' => 'linecons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'moon-wl-plugin' ),
    ),
    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Icon color", "moon-wl-plugin" ),
         "param_name" => "icon_color",
         "value" => "#fcfcfc",
         "group" => "Color option",
         "dependency" => array(
            "element" => "icon",
            "not_empty" => true,
          )
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Icon hover color", "moon-wl-plugin" ),
         "param_name" => "icon_hover_color",
         "value" => "#222222",
         "group" => "Color option",
         "dependency" => array(
            "element" => "icon",
            "not_empty" => true,
          )
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Button text color", "moon-wl-plugin" ),
         "param_name" => "text_color",
         "value" => "#fcfcfc",
         "group" => "Color option",
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Button text hover color", "moon-wl-plugin" ),
         "param_name" => "text_hover_color",
         "value" => "#222222",
         "group" => "Color option",
      ),
       array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Button background color", "moon-wl-plugin" ),
             "param_name" => "background_color",
             "value" => "#111111",
             "group" => "Color option",
        ),
       array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_html__( "Button background hover color", "moon-wl-plugin" ),
           "group" => "Color option",
           "param_name" => "background_hover_color",
           "value" => "#fcfcfc",
        ), 
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Button border color", "moon-wl-plugin" ),
             "group" => "Color option",
             "param_name" => "border_color",
             "value" => "#111111",
        ),
        array(
           "type" => "colorpicker",
           "holder" => "div",
           "class" => "",
           "heading" => esc_html__( "Button border hover color", "moon-wl-plugin" ),
           "group" => "Color option",
           "param_name" => "border_hover_color",
        ),     
    )
    ) ); 
}


// Newsletter shortcode
add_action( 'vc_before_init', 'moon_wl_newsletter_vc' );
function moon_wl_newsletter_vc(){
   vc_map( array(
    "name" => esc_html__("Newsletter", "moon-wl-plugin"),
    "base" => "moon_wl_newsletter",
    "class" => "moon_wl_vc_map",
    "category" => esc_html__( "Moon", "moon-wl-plugin"),
    "content_element" => true,
    "show_settings_on_create" => true,
    "description" => esc_html__( "Newsletter style", "moon-wl-plugin" ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Mailchimp shortcode ID", "moon-wl-plugin" ),
            "param_name" => "mailchimp_id",
            "description" => "eg: 452 from [mc4wp_form id=452]"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title", "moon-wl-plugin" ),
            "param_name" => "title",
            "description" => esc_html__( "You can use <br> for line break", "moon-wl-plugin" )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title font size", "moon-wl-plugin" ),
            "param_name" => "font_size",
            "description" => "(px)"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Letter spacing", "moon-wl-plugin" ),
            "param_name" => "letter_spacing",
            "description" => "(px)"
        ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title line height", "moon-wl-plugin" ),
            "param_name" => "line_height",
            "description" => "(px)"
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Title text transform", "moon-wl-plugin" ),
          "param_name" => "title_case",
          "value" => array(
              "Default" => "inherit",
              "Uppercase" => "uppercase",
              "Capitalize" => "capitalize",
              "Inherit" => "inherit"
              )
          ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Title color", "moon-wl-plugin" ),
             "param_name" => "title_color",
             "value" => "#222222",
         ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Content color", "moon-wl-plugin" ),
             "param_name" => "content_color",
             "value" => "#222222",
         ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_html__( "Alignment", "moon-wl-plugin" ),
          "param_name" => "content_alinged",
          "value" => array(
              "Left" => "left",
              "Right" => "right",
              "Center" => "center"
              )
          ),
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Newsletter content", "moon-wl-plugin" ),
            "param_name" => "newletter_cont",
            "description" => esc_html__( "You can use <br> for line break", "moon-wl-plugin" )
        ),
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Form margin top", "moon-wl-plugin" ),
            "param_name" => "form_margin_top",
            "description" => "(px)"
        ),
          array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Form margin bottom", "moon-wl-plugin" ),
            "param_name" => "form_margin_bottom",
            "description" => "(px)"
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use theme default font family?', 'moon-wl-plugin' ),
            'param_name' => 'use_theme_fonts',
            'value' => array( 'Yes' => 'yes' ),
            'description' => esc_html__( 'Use font family from the theme.', 'moon-wl-plugin' ),
      ),
      array(
          'type' => 'google_fonts',
          'param_name' => 'google_fonts',
          'value' => '',
          'settings' => array(
                  'fields' => array(
                          'font_family_description' => esc_html__( 'Select Title font family.', 'moon-wl-plugin' ),
                          'font_style_description' => esc_html__( 'Select Title font styling.', 'moon-wl-plugin' ),
                  ),
          ),
          'dependency' => array(
                  'element' => 'use_theme_fonts',
                  'value_not_equal_to' => 'yes',
          ),
      ),
           
    )
    ) ); 
}

// Social media shortcode
add_action( 'vc_before_init', 'moon_wl_social_links_vc' );
function moon_wl_social_links_vc() {
   vc_map( array(
      "name" => esc_html__( "Social media", "moon-wl-plugin" ),
      "base" => "moon_wl_social_links",
      "class" => "moon_wl_vc_map",
      "category" => esc_html__( "Moon", "moon-wl-plugin"),
      "description" => esc_html__( "Social media", "moon-wl-plugin" ),
      "params" => array(
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Icon font size", "moon-wl-plugin" ),
               "param_name" => "size",
               "description" => "(px)"
            ),
             array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Icon padding left", "moon-wl-plugin" ),
               "param_name" => "icon_padding_left",
               "description" => "(px)"
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Icon padding right", "moon-wl-plugin" ),
               "param_name" => "icon_padding_right",
               "description" => "(px)"
            ),
            array(
               "type" => "colorpicker",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Icon color", "moon-wl-plugin" ),
               "param_name" => "color",
            ),
           
            array(
               "type" => "colorpicker",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Icon hover color", "moon-wl-plugin" ),
               "param_name" => "hover_color",
            ),
            array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_html__( "Icons position", "moon-wl-plugin" ),
                 "param_name" => "position",
                 "value" => array(
                    "Left Align" => "left",
                    "Center Align" => "center",
                    "Right Align" => "right"

                )
              ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Facebook link", "moon-wl-plugin" ),
               "param_name" => "facebook",
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Twitter link", "moon-wl-plugin" ),
               "param_name" => "twitter",
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Google plus link", "moon-wl-plugin" ),
               "param_name" => "google_plus",
            ),
            array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Pinterest link", "moon-wl-plugin" ),
               "param_name" => "pinterest"
            ),
      )
   ) );
}

// Logo shortcode
add_action( 'vc_before_init', 'moon_wl_logo_vc' );
function moon_wl_logo_vc() {
   vc_map( array(
      "name" => esc_html__( "Logos", "moon-wl-plugin" ),
      "base" => "moon_wl_logo",
      "class" => "moon_wl_vc_map",
      "category" => esc_html__( "Moon", "moon-wl-plugin"),
      "as_child" => array('except' => 'abc'),
      "description" => esc_html__( "Logos", "moon-wl-plugin" ),
      "params" => array(
          array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Category name", "moon-wl-plugin" ),
               "param_name" => "slider_category",
               "description" => esc_html__( "Type a category slug (optional)", "moon-wl-plugin" )
            ),
      )
   ) );
}

// Products shortcode
add_action( 'vc_before_init', 'moon_wl_products_vc' );
function moon_wl_products_vc() {
   vc_map( array(
      "name" => esc_html__( "Products tab", "moon-wl-plugin" ),
      "base" => "moon_wl_products_slider",
      "class" => "moon_wl_vc_map",
      "category" => esc_html__( "Moon", "moon-wl-plugin"),
      "description" => esc_html__( "", "moon-wl-plugin" ),
      "params" => array(
           array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Recent products", "moon-wl-plugin" ),
            "param_name"    => "recent_products",
            "description"       => __( "Show recent products", "moon-wl-plugin" )
        ),
           array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__( 'Recent Products Number', 'moon-wl-plugin' ),
            'param_name' => 'slider_recent',
            "dependency" => array(
              "element" => "recent_products",
              "not_empty" => true,
            )
          ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Recent products custom name", "moon-wl-plugin" ),
            "param_name"    => "recent_products_name",
            "dependency" => array(
              "element" => "recent_products",
              "not_empty" => true,
            )
        ),
         array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Featured products", "moon-wl-plugin" ),
            "param_name"    => "featured_products",
            "description"       => __( "Show featured productsr", "moon-wl-plugin" )
        ),
         array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__( 'Featured Products Number', 'moon-wl-plugin' ),
            'param_name' => 'slider_featured',
            "dependency" => array(
              "element" => "featured_products",
              "not_empty" => true,
            )
          ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Featured products custom name", "moon-wl-plugin" ),
            "param_name"    => "featured_products_name",
            "dependency" => array(
              "element" => "featured_products",
              "not_empty" => true,
            )
        ),
        array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Sale products", "moon-wl-plugin" ),
            "param_name"    => "sale_products",
            "description"       => __( "Show sale products", "moon-wl-plugin" )
        ),
        array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__( 'Sale Products Number', 'moon-wl-plugin' ),
            'param_name' => 'slider_sale',
            "dependency" => array(
              "element" => "sale_products",
              "not_empty" => true,
            )
          ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Sale products custom name", "moon-wl-plugin" ),
            "param_name"    => "sale_products_name",
            "dependency" => array(
              "element" => "sale_products",
              "not_empty" => true,
            )
        ),
        array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Best selling products", "moon-wl-plugin" ),
            "param_name"    => "best_selling_products",
            "description"       => __( "Show best selling products", "moon-wl-plugin" )
        ),
        array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__( 'Best Selling Products Number', 'moon-wl-plugin' ),
            'param_name' => 'slider_best_selling',
            "dependency" => array(
              "element" => "best_selling_products",
              "not_empty" => true,
            )
          ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Best selling products custom name", "moon-wl-plugin" ),
            "param_name"    => "best_sale_products_name",
            "dependency" => array(
              "element" => "best_selling_products",
              "not_empty" => true,
            )
        ),
        array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Top rated products", "moon-wl-plugin" ),
            "param_name"    => "top_rated_products",
            "description"       => __( "Show top rated products", "moon-wl-plugin" )
        ),
        array(
            'type' => 'textfield',
            'holder' => 'div',
            'heading' => esc_html__( 'Top Rated Products Number', 'moon-wl-plugin' ),
            'param_name' => 'slider_top_rated',
            "dependency" => array(
              "element" => "top_rated_products",
              "not_empty" => true,
            )
          ),
        array(
            "type"          => "textfield",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Top rated products custom name", "moon-wl-plugin" ),
            "param_name"    => "top_rated_products_name",
             "dependency" => array(
              "element" => "top_rated_products",
              "not_empty" => true,
            )
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Tab text font size", "moon-wl-plugin" ),
             "param_name" => "tab_font_size",
             "description" => "(px)"
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Tab text font line height", "moon-wl-plugin" ),
             "param_name" => "tab_font_line_height",
             "description" => "(px)"
        ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Tab text font color", "moon-wl-plugin" ),
             "param_name" => "tab_font_color",
        ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Active tab text font color", "moon-wl-plugin" ),
             "param_name" => "active_tab_font_color",
        ),
        array(
            "type"          => "checkbox",
            "holder"        => "div",
            "class"         => "",
            "heading"       => __( "Hide divider", "moon-wl-plugin" ),
            "param_name"    => "hide_divider",
            'value'         => array( 'Yes' => 'yes' ),
            "group" => "Divider options",
        ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Color", "moon-wl-plugin" ),
             "param_name" => "divider_color",
             "group" => "Divider options",
             'dependency' => array(
                'element' => 'hide_divider',
                'value_not_equal_to' => 'yes',
              ),
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Width", "moon-wl-plugin" ),
             "param_name" => "divider_width",
             "value" => "30",
             "description" => "(px)",
             "group" => "Divider options",
             'dependency' => array(
                'element' => 'hide_divider',
                'value_not_equal_to' => 'yes',
              ),
        ),
        array(
             "type" => "textfield",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Height", "moon-wl-plugin" ),
             "param_name" => "divider_height",
             "value" => "4",
             "description" => "(px)",
             "group" => "Divider options",
             'dependency' => array(
                'element' => 'hide_divider',
                'value_not_equal_to' => 'yes',
              ),
        ),
      ),
      
   ) );
}

// Adding Overlay Fields To vc_row shortcode
add_action( 'vc_before_init', 'vc_add_row_new_fields' );

function vc_add_row_new_fields(){


$attributes = array(
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Enable overlay', 'moon-wl-plugin' ),
        'param_name' => 'w_overlay',
        'value' => false,
        'description' => esc_html__( 'Set overlay', 'moon-wl-plugin' )
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Overlay color', 'moon-wl-plugin' ),
        'param_name' => 'w_overlay_color',
        'value' => '',
        'description' => esc_html__( 'Overlay color picker', 'moon-wl-plugin' ),
        'dependency' => array(
                        'element' => 'w_overlay',
                        'value' => 'true'
                    )
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Opacity', 'moon-wl-plugin' ),
        'param_name' => 'w_opacity_value',
        'value' => '',
        'description' => esc_html__( 'Opacity value', 'moon-wl-plugin' ),
        'dependency' => array(
                        'element' => 'w_overlay',
                        'value' => 'true'
                    )
    ),
);

vc_add_params( 'vc_row', $attributes );
}

/* badge shortcode */
add_action('vc_before_init', 'moon_wl_badge_vc');

function moon_wl_badge_vc() {
  vc_map(array(
    'name'              => esc_html__('Text badge', 'moon-wl-plugin'),
    'base'              => 'moon_wl_badge',
    'class'             => 'moon_wl_vc_map',
    'category'            =>  esc_html__("Moon", 'moon-wl-plugin'),
    'content_element'       =>  true,
    'show_settings_on_create'   =>  true,
    'params'            => array (
        array(
          'type'  => 'textfield',
          'holder'  => 'div',
          'class' => '',
          'heading' => esc_html__('Title', 'moon-wl-plugin'),
          'param_name'  => 'title',
        ),
        array(
          'type'  => 'colorpicker',
          'holder'  => 'div',
          'class' => '',
          'heading' => esc_html__('Background Color', 'moon-wl-plugin'),
          'param_name'  => 'bg_color',
          'value' => '#fff',
        ),
        array(
          'type'  => 'textfield',
          'holder'  => 'div',
          'class' => '',
          'heading' => esc_html__('Border Radious', 'moon-wl-plugin'),
          'param_name'  => 'radious',
          'description' => '(px)'
        ),
        array(
          'type'  => 'textfield',
          'param_name'  => 'font_size',
          'heading' => esc_html__('Font Size', 'moon-wl-plugin'),
          'description' => '(px)',
        ),
        array(
          'type'  => 'textfield',
          'param_name'  => 'letter_spacing',
          'heading' => esc_html__('Letter Spacing', 'moon-wl-plugin'),
          "description" => "(px)"
        ),
        array(
          'type'  => 'textfield',
          'param_name'  => 'line_height',
          'heading' => esc_html__('Lineheight', 'moon-wl-plugin'),
          'value' => '21',
          "description" => "(px)"
        ),
        array(
          'type'  => 'colorpicker',
          'param_name'  => 'text_color',
          'heading' => esc_html__('Title Color', 'moon-wl-plugin'),
          'value' => '#c7444a',
        ),
        array(
          'type'  => 'dropdown',
          'param_name'  => 'font_style',
          'heading' => esc_html__('Font Style', 'moon-wl-plugin'),
           "value" => array(
            "Default" => "normal",
            "Italic" => "italic",
            "Oblique" => "oblique",
          )
        ),
        array(
          'type'  => 'dropdown',
          'param_name'  => 'text_transform',
          'heading' => esc_html__('Text Transform', 'moon-wl-plugin'),
          "value" => array(
            "Default" => "default",
            "Capitalize" => "capitalize",
            "Lowercase" => "lowercase",
            "Uppercase" => "uppercase"
          )
        ),
        array(
          'type'  => 'dropdown',
          'param_name'  => 'alignment',
          'heading' => esc_html__('Alignment', 'moon-wl-plugin'),
            "value" => array(
            "Left" => "left",
            "Center" => "center",
            "Right" => "right"
          )
        ),
        array(
          'type' => 'checkbox',
          'heading' => esc_html__( 'Use theme default font family?', 'js_composer' ),
          'param_name' => 'use_theme_fonts',
          'value' => array( 'Yes' => 'yes' ),
          'description' => esc_html__( 'Use font family from the theme.', 'js_composer' ),
        ),
        array(
          'type' => 'google_fonts',
          'param_name' => 'google_fonts',
          'value' => '',
          'settings' => array(
              'fields' => array(
                  'font_family_description' => esc_html__( 'Select font family.', 'js_composer' ),
                  'font_style_description' => esc_html__( 'Select font styling.', 'js_composer' ),
              ),
          ),
          'dependency' => array(
              'element' => 'use_theme_fonts',
              'value_not_equal_to' => 'yes',
          ),
        ),
        array(
          'type'      => 'textfield',
          'param_name'  => 'padding_top',
          'heading'   => esc_html__('Padding Top', 'moon-wl-plugin'),
          "description" => "(px)"
        ),
        array(
          'type'      => 'textfield',
          'param_name'  => 'padding_bottom',
          'heading'   => esc_html__('Padding Bottom', 'moon-wl-plugin'),
          "description" => "(px)"
        ),
        array(
          'type'      => 'textfield',
          'param_name'  => 'padding_left',
          'heading'   => esc_html__('Padding Left', 'moon-wl-plugin'),
          "description" => "(px)"
        ),
        array(
          'type'      => 'textfield',
          'param_name'  => 'padding_right',
          'heading'   => esc_html__('Padding Right', 'moon-wl-plugin'),
          "description" => "(px)"
        ),
    )
    
  ));
}
// Single Promo *************
add_action( 'vc_before_init', 'moon_wl_sin_promo_vc' );
function moon_wl_sin_promo_vc(){
   vc_map( array(
    "name" => esc_html__("Features box", "moon-wl-plugin"),
    "base" => "moon_wl_sin_promo",
    "class" => "moon_wl_vc_map",
    "category" => esc_html__( "Moon", "moon-wl-plugin"),
    "content_element" => true,
    "show_settings_on_create" => true,
    "description" => esc_html__( "Features box style", "moon-wl-plugin" ),
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title Text", "moon-wl-plugin" ),
            "param_name" => "title",
            "description" => esc_html__( "You can use <br> for line break", "moon-wl-plugin" )
        ),
        array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => esc_html__( "Select title element tag", "moon-wl-plugin" ),
                "param_name" => "title_tag",
                "value" => array(
                    "Select" => "0",
                    "H1" => "h1",
                    "H2" => "h2",
                    "H3" => "h3",
                    "H4" => "h4",
                    "H5" => "h5",
                    "H6" => "h6",
                    "Span" => "span",
                )
        ),
        array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title alignment", "moon-wl-plugin" ),
            "param_name" => "title_content",
            "value" => array(
                "Text Left" => "style-1",
                "Text Right" => "style-2"
            )
        ),      
        array(
            "type" => "attach_image",
            "holder" => "",
            "class" => "",
            "heading" => esc_html__( "Background image", "moon-wl-plugin" ),
            "param_name" => "imageurl",
            "description" => esc_html__( "Upload your image", "moon-wl-plugin" )
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title font size", "moon-wl-plugin" ),
            "param_name" => "font_size",
            "description" => "(px)"
        ),
        array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Title line height", "moon-wl-plugin" ),
            "param_name" => "line_height",
            "description" => "(px)"
        ),      
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Title color", "moon-wl-plugin" ),
             "param_name" => "title_color",
             "value" => "#fff",
         ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Border color", "moon-wl-plugin" ),
             "param_name" => "border_color",
             "value" => "#fff",
         ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use theme default font family?', 'moon-wl-plugin' ),
            'param_name' => 'use_theme_fonts',
            'value' => array( 'Yes' => 'yes' ),
            'description' => esc_html__( 'Use font family from the theme.', 'moon-wl-plugin' ),
      ),
      array(
          'type' => 'google_fonts',
          'param_name' => 'google_fonts',
          'value' => '',
          'settings' => array(
                  'fields' => array(
                          'font_family_description' => esc_html__( 'Select Title font family.', 'moon-wl-plugin' ),
                          'font_style_description' => esc_html__( 'Select Title font styling.', 'moon-wl-plugin' ),
                  ),
          ),
          'dependency' => array(
                  'element' => 'use_theme_fonts',
                  'value_not_equal_to' => 'yes',
          ),
      ),
        array(
            "type" => "textfield",
            "holder" => "",
            "class" => "",
            "heading" => esc_html__( "Link 1 text", "moon-wl-plugin" ),
            "param_name" => "other_content",
        ),
        array(
            "type" => "textfield",
            "holder" => "",
            "class" => "",
            "heading" => esc_html__( "Link 1 URL", "moon-wl-plugin" ),
            "param_name" => "other_content_link",
        ),
        array(
            "type" => "textfield",
            "holder" => "",
            "class" => "",
            "heading" => esc_html__( "Link 2 text", "moon-wl-plugin" ),
            "param_name" => "other_content2",
        ),
        array(
            "type" => "textfield",
            "holder" => "",
            "class" => "",
            "heading" => esc_html__( "Link 2 URL", "moon-wl-plugin" ),
            "param_name" => "other_content_link2",
        ), 
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Link Text color", "moon-wl-plugin" ),
             "param_name" => "other_content_color",
             "value" => "#fff",
         ), 
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Link Text Hover color", "moon-wl-plugin" ),
             "param_name" => "other_content_hover_color",
             "value" => "#e2214b",
         ),
        array(
             "type" => "colorpicker",
             "holder" => "div",
             "class" => "",
             "heading" => esc_html__( "Link Devider color", "moon-wl-plugin" ),
             "param_name" => "other_content_devider_color",
             "value" => "#fff",
         ),                      
    )
    ) ); 
}

//Blog shortcode
add_action( 'vc_before_init', 'moon_wl_blog_vc' );
function moon_wl_blog_vc() {
   vc_map( array(
      "name" => esc_html__( "Blog", "moon-wl-plugin" ),
      "base" => "moon_wl_blog",
      "class" => "moon_wl_vc_map",
      "category" => esc_html__( "Moon", "moon-wl-plugin"),
      "as_child" => array('except' => 'abc'),
      "description" => esc_html__( "Blog", "moon-wl-plugin" ),
      "params" => array(
          array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Post to show", "moon-wl-plugin" ),
               "param_name" => "post_to_show",
            ),
           array(
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_html__( "Category slug", "moon-wl-plugin" ),
               "param_name" => "category_slug",
               "description" => esc_html__( "Category slug", "moon-wl-plugin" )
            ),
          array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => esc_html__( "Blog style", "moon-wl-plugin" ),
            "param_name" => "blog_style",
            "value" => array(
                "Default" => "default",
                "Slider" => "slider",
            )
        ),
        array (
              "type" => "checkbox",
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__(' Hide meta info', 'moon-wl-plugin'),
              'param_name' => 'is_meta_info',
               'value'         => array( 'Hide' => 'yes' ),
          ),
          array (
              'type' => 'dropdown',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__('Order', 'moon-wl-plugin'),
              'param_name' => 'order',
              'value' => array (
                  'Ascending' => 'ASC',
                  'Descending' => 'DESC',
                  'Random' => 'RANDOM'
              )
          ),
          array (
              'type' => 'dropdown',
              'holder' => 'div',
              'class' => '',
              'heading' => esc_html__('Order by', 'moon-wl-plugin'),
              'param_name' => 'order_by',
              'value' => array (
                  'Default' => 'default',
                  'author' => 'Author',
                  'Title' => 'title',
                  'Type' => 'type',
                  'Date' => 'date',
                  'Modified' => 'modified',
                  'Random' => 'rand'
              )
          ),

      )
   ) );
}
/* Banner shortcode vc */

add_action( 'vc_before_init', 'moon_wl_sm_banner_vc' );

function moon_wl_sm_banner_vc() {
  vc_map(array(
    "name"            => esc_html__("Banner", "moon-wl-plugin"),
    "base"            => "moon_wl_sm_banner",
    "class"           =>  "moon_wl_vc_map",
    "category"          => esc_html__( "Moon", "moon-wl-plugin"),
    "as_parent" => array('except' => 'abc'),
    "content_element"       => true,
    "show_settings_on_create"   => true,
    "description"         => esc_html__( "Offer box style", "moon-wl-plugin" ),
    "params"          => array(
      array(
        "type"          => "attach_image",
        "holder"        => "div",
        "class"         => "",     
        "heading"       => __( "Banner Background Image", "moon-wl-plugin" ),
        "param_name"    => "bg_image",
        "description"   => __( "Small Banner Background Image", "moon-wl-plugin" )
      ),
      array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Background color", "moon-wl-plugin" ),
         "param_name" => "bg_color",
         "value" => "#666666",
      ),
    ),
  
     "js_view" => 'VcColumnView'
  ));
}

// recent products *************
add_action( 'vc_before_init', 'moon_shop_recent_products_vc' );
function moon_shop_recent_products_vc() {
    include('vc-template/recent-products.php');
}

// featured products *************
add_action( 'vc_before_init', 'moon_shop_featured_products_vc' );
function moon_shop_featured_products_vc() {
    include('vc-template/featured-products.php');
}

// sale products *************
add_action( 'vc_before_init', 'moon_shop_sale_products_vc' );
function moon_shop_sale_products_vc() {
    include('vc-template/sale-products.php');
}

// best sale products *************
add_action( 'vc_before_init', 'moon_shop_best_selling_products_vc' );
function moon_shop_best_selling_products_vc() {
    include('vc-template/best-sale-products.php');
}

// top rated products *************
add_action( 'vc_before_init', 'moon_shop_top_rated_products_vc' );
function moon_shop_top_rated_products_vc() {
    include('vc-template/top-rated-products.php');
}

// product tab *************
add_action( 'vc_before_init', 'moon_shop_product_tab_vc' );
function moon_shop_product_tab_vc() {
    include('vc-template/products-tab.php');
}

// Album *************
add_action( 'vc_before_init', 'moon_album_vc' );
function moon_album_vc() {
    include('vc-template/album.php');
}

vc_add_shortcode_param( 'mk-album' , 'album_category' );
function album_category($settings) { ?>
  <script type="text/javascript">
        var select2value = jQuery('.category.mk-album').text();
        if (typeof(select2value) !== 'undefined' && select2value) {
            var srtingArray = select2value.split(',');
        } else {
            srtingArray = ['all'];
        }
        jQuery('.album-select2').select2().val(srtingArray).trigger("change");
        jQuery('.album-select2 ~ .select2-container').css("width","100%");
    </script>
    <?php
    $categories = get_categories(array( 'taxonomy' => 'mk-album-category' ));
    $option = '';
  if( $categories ) {
    foreach($categories as $category) {
      $option .= '<option value="'.strtolower($category->name).'">'.ucfirst($category->name).'</option>';
    } 
  }
    return '<select multiple="multiple" class="album-select2 wpb_vc_param_value wpb-input wpb-select content_length_style dropdown full"  id="'.$settings['param_name'].'" name="'.$settings['param_name'].'" data-option="full">
        <option value="all">All</option>'.$option.'</select>';
}

// Portfolio *************
/*
add_action( 'vc_before_init', 'moon_portfolio_vc' );
function moon_portfolio_vc() {
    include('vc-template/portfolio.php');
}

vc_add_shortcode_param( 'mk-portfolio' , 'portfolio_category' );
function portfolio_category($settings) { ?>
  <script type="text/javascript">
        var select2value = jQuery('.category.mk-portfolio').text();
        if (typeof(select2value) !== 'undefined' && select2value) {
            var srtingArray = select2value.split(',');
        } else {
            srtingArray = ['all'];
        }
        jQuery('.album-select2').select2().val(srtingArray).trigger("change");
        jQuery('.album-select2 ~ .select2-container').css("width","100%");
    </script>
    <?php
    $categories = get_categories(array( 'taxonomy' => 'mk-portfolio-category' ));
    $option = '';
  if( $categories ) {
    foreach($categories as $category) {
      $option .= '<option value="'.strtolower($category->name).'">'.ucfirst($category->name).'</option>';
    } 
  }
    return '<select multiple="multiple" class="album-select2 wpb_vc_param_value wpb-input wpb-select content_length_style dropdown full"  id="'.$settings['param_name'].'" name="'.$settings['param_name'].'" data-option="full">
        <option value="all">All</option>'.$option.'</select>';
}*/

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_moon_wl_sm_banner extends WPBakeryShortCodesContainer {
    }
}