<?php

	vc_map ( array(
		"name" 						=> esc_html__("Album", "moon-wl-plugin"),
		"class"						=> "moon_wl_vc_map",
		"base" 						=> "moon_album",
		"category"  				=> esc_html__( "Moon", "moon-wl-plugin"),	
		"content_element" 			=> true,
		"show_settings_on_create" 	=> true,
		"params" 					=> array(
            array(
                'type' => 'dropdown',
                'holder' => 'div',
                "class" => "hide_in_vc_editor",
                'heading' => esc_html__('Select Style', 'moon-wl-plugin'),
                'param_name' => 'styles',
                "value" => array(
                    "Select" 			=> "select",
                    "Grid Style" 		=> "grid",
                    "Masonry Style" 	=> "masonry",
                )
            ),
            array(
                'type' => 'textfield',
                'holder' => 'div',
                "class" => "hide_in_vc_editor",
                'heading' => esc_html__('Number of album', 'moon-wl-plugin'),
                'param_name' => 'posts_per_page',
                'value' => '',
            ),
            array(
                "type"          => "mk-album",
                "holder"        => "div",
                "class" 		=> "hide_in_vc_editor",
                "heading"       => esc_html__( "Album category", "moon-wl-plugin" ),
                "param_name"    => "category",
                "description"   => esc_html__( "Only selected category items will show", "moon-wl-plugin" )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "hide_in_vc_editor",
                "heading" => esc_html__( "Select Column", "moon-wl-plugin" ),
                "param_name" => "album_columns",
                "value" => "select",
                "value" => array(
                    "Select" 		=> "select",
                    "Two Column" 	=> "column-2",
                    "Three Column" 	=> "column-3",
                    "Four Column" 	=> "column-4",
                )
            ),		
		)
	));