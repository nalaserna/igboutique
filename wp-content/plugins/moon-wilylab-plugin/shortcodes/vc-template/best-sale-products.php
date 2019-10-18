<?php

	vc_map ( array(
		"name" 						=> esc_html__("Best Selling Products", "moon-wl-plugin"),
		"class"						=> "moon_wl_vc_map",
		"base" 						=> "moon_best_selling_products",
		"category"  				=> esc_html__( "Moon", "moon-wl-plugin"),	
		"content_element" 			=> true,
		"show_settings_on_create" 	=> true,
		"params" 					=> array(
			array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __( 'Product Number', 'moon-wl-plugin' ),
				'param_name' => 'product_number',
			),
			array(
                "type" 			=> "dropdown",
                "holder"		=> "div",
                "class" 		=> "",
                "heading"		=> esc_html__( "Column Number", "moon-wl-plugin" ),
                "param_name" 	=> "column",
				"value"         => array(
					"Select Column Number"    		=> "default",
					"Two Column"    		=> "2",
					"Three Column"    		=> "3",
					"Four Column"    		=> "4",
				)
			),			
		)
	));