<?php

	vc_map ( array(
		"name" 						=> esc_html__("Portfolio", "moon-wl-plugin"),
		"class"						=> "moon_wl_vc_map",
		"base" 						=> "moon_portfolio",
		"category"  				=> esc_html__( "Moon", "moon-wl-plugin"),	
		"content_element" 			=> true,
		"show_settings_on_create" 	=> true,
		"params" 					=> array(
            array(
                'type' => 'textfield',
                'holder' => 'div',
                "class" => "hide_in_vc_editor",
                'heading' => esc_html__('Number of Potfolio', 'moon-wl-plugin'),
                'param_name' => 'posts_per_page',
                'value' => '',
            ),
            array(
                "type"          => "mk-portfolio",
                "holder"        => "div",
                "class" 		=> "hide_in_vc_editor",
                "heading"       => esc_html__( "Portfolio category", "moon-wl-plugin" ),
                "param_name"    => "category",
                "description"   => esc_html__( "Only selected category items will show", "moon-wl-plugin" )
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "hide_in_vc_editor",
                "heading" => esc_html__( "Select Column", "moon-wl-plugin" ),
                "param_name" => "columns",
                "value" => "select",
                "value" => array(
                    "Select" 		=> "select",
                    "Two Column" 	=> "column-2",
                    "Three Column" 	=> "column-3",
                    "Four Column" 	=> "column-4",
                )
            ),
            array(
                'type' => 'dropdown',
                'holder' => 'div',
                "class" => "hide_in_vc_editor",
                'heading' => esc_html__('Filter Show/Hide', 'moon-wl-plugin'),
                'param_name' => 'filter',
                "value" => array(
                    "Select"            => "default",
                    "Show Filter"        => "show",
                    "Hide Filter"     => "hide",
                )
            ),
            array(
                'type' => 'dropdown',
                'holder' => 'div',
                "class" => "hide_in_vc_editor",
                'heading' => esc_html__('Pagination Show/Hide', 'moon-wl-plugin'),
                'param_name' => 'pagination',
                "value" => array(
                    "Select"            => "default",
                    "Show Pagination"        => "show",
                    "Hide Pagination"     => "hide",
                )
            ),
		)
	));