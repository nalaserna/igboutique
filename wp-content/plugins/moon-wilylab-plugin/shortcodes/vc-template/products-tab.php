<?php

// Products shortcode
vc_map( array(
	"name" => esc_html__( "Grid View Products tab", "moon-wl-plugin" ),
	"base" => "moon_products_tab",
	"class" => "moon_wl_vc_map",
	"category" => esc_html__( "Moon", "moon-wl-plugin"),
	"params" => array(
       array(
        "type"          => "checkbox",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Recent products", "moon-wl-plugin" ),
        "param_name"    => "grid_recent_products",
        "value" 		=> "",
        "description"       => esc_html__( "Show recent products", "moon-wl-plugin" )
    ),
    array(
        'type' => 'textfield',
        'holder' => 'div',
        'heading' => esc_html__( 'Recent Products Number', 'moon-wl-plugin' ),
        'param_name' => 'tab_recent',
        "dependency" => array(
          "element" => "grid_recent_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "textfield",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Recent products custom name", "moon-wl-plugin" ),
        "param_name"    => "grid_recent_products_name",
        "value" 		=> "",
        "dependency" 	=> array(
          "element" 	=> "grid_recent_products",
          "not_empty" 	=> true,
        )
    ),
     array(
        "type"          => "checkbox",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Featured products", "moon-wl-plugin" ),
        "param_name"    => "grid_featured_products",
        "value" 		=> "",
        "description"       => esc_html__( "Show featured products", "moon-wl-plugin" )
    ),
    array(
        'type' => 'textfield',
        'holder' => 'div',
        'heading' => esc_html__( 'Featured Products Number', 'moon-wl-plugin' ),
        'param_name' => 'tab_featured',
        "dependency" => array(
          "element" => "grid_featured_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "textfield",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Featured products custom name", "moon-wl-plugin" ),
        "param_name"    => "grid_featured_products_name",
        "value" 		=> "",
        "dependency" 	=> array(
          "element" 	=> "grid_featured_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "checkbox",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Sale products", "moon-wl-plugin" ),
        "param_name"    => "grid_sale_products",
        "value" 		=> "",
        "description"   => esc_html__( "Show sale products", "moon-wl-plugin" )
    ),
    array(
        'type' => 'textfield',
        'holder' => 'div',
        'heading' => esc_html__( 'Sale Products Number', 'moon-wl-plugin' ),
        'param_name' => 'tab_sale',
        "dependency" => array(
          "element" => "grid_sale_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "textfield",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Sale products custom name", "moon-wl-plugin" ),
        "param_name"    => "grid_sale_products_name",
        "dependency" => array(
          "element" => "grid_sale_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "checkbox",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Best selling products", "moon-wl-plugin" ),
        "param_name"    => "grid_best_selling_products",
        "description"   => esc_html__( "Show best selling products", "moon-wl-plugin" )
    ),
    array(
        'type' => 'textfield',
        'holder' => 'div',
        'heading' => esc_html__( 'Best Selling Products Number', 'moon-wl-plugin' ),
        'param_name' => 'tab_best_selling',
        "dependency" => array(
          "element" => "grid_best_selling_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "textfield",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Best selling products custom name", "moon-wl-plugin" ),
        "param_name"    => "grid_best_sale_products_name",
        "value" 		=> "",
        "dependency" => array(
          "element" => "grid_best_selling_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "checkbox",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Top rated products", "moon-wl-plugin" ),
        "param_name"    => "grid_top_rated_products",
        "value" 		=> "",
        "description"       => esc_html__( "Show top rated products", "moon-wl-plugin" )
    ),
    array(
        'type' => 'textfield',
        'holder' => 'div',
        'heading' => esc_html__( 'Top Rated Products Number', 'moon-wl-plugin' ),
        'param_name' => 'tab_top_rated',
        "dependency" => array(
          "element" => "grid_top_rated_products",
          "not_empty" => true,
        )
    ),
    array(
        "type"          => "textfield",
        "holder"        => "div",
        "class"         => "",
        "heading"       => esc_html__( "Top rated products custom name", "moon-wl-plugin" ),
        "param_name"    => "grid_top_rated_products_name",
        "value" 		=> "",
         "dependency" => array(
          "element" => "grid_top_rated_products",
          "not_empty" => true,
        )
    ),
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" 		=> esc_html__( "Tab text font size", "moon-wl-plugin" ),
         "param_name" => "tab_font_size",
         "value" 		=> "",
         "description" => "(px)"
    ),
    array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Tab text font line height", "moon-wl-plugin" ),
         "param_name" => "tab_font_line_height",
         "value" => "",
         "description" => "(px)"
    ),
    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Tab text font color", "moon-wl-plugin" ),
         "param_name" => "tab_font_color",
         "value" => "",
    ),
    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Active tab text font color", "moon-wl-plugin" ),
         "param_name" => "active_tab_font_color",
         "value" => "",
    ),
    array(
         "type" => "colorpicker",
         "holder" => "div",
         "class" => "",
         "heading" => esc_html__( "Color", "moon-wl-plugin" ),
         "param_name" => "divider_color",
         "value" => "",
         'dependency' => array(
            'element' => 'hide_divider',
            'value_not_equal_to' => 'yes',
          ),
    ),
  ),
  
) );