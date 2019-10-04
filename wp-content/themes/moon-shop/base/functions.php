<?php
if( ! function_exists( 'moon_shop_swatches_list' ) ) {
	function moon_shop_swatches_list( $attribute_name = false ) {
		global $product;

		$id = $product->get_id();

		if( empty( $id ) || ! $product->is_type( 'variable' ) ) return;

		$moon_shop_optionsValue = get_option( 'moon_shop' );
		
		if( ! $attribute_name ) {
			$attribute_name = isset($moon_shop_optionsValue['moon-shop-swatch-list']) ? $moon_shop_optionsValue['moon-shop-swatch-list'] : '';
		}
		$swatch_width = isset($moon_shop_optionsValue['moon-shop-swatch-grid-width']) ? $moon_shop_optionsValue['moon-shop-swatch-grid-width'] : 16;

		if( empty( $attribute_name ) ) return false;

		$available_variations = $product->get_available_variations();

		if( empty( $available_variations ) ) return;

		$swatches_to_show = moon_shop_get_option_variations(  $attribute_name, $available_variations, false, $id );

		if( empty( $swatches_to_show ) ) return;

		if( apply_filters( 'moon_shop_swatches_on_grid', true ) ) {
			$terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'slugs' ) );

			$swatches_to_show_tmp = $swatches_to_show;

			$swatches_to_show = array();

			foreach ($terms as $id => $slug) {
				if( ! isset( $swatches_to_show_tmp[$slug] ) ) continue;
				$swatches_to_show[$slug] = $swatches_to_show_tmp[$slug];
			}
		}
		if (!empty($swatches_to_show)) {
			echo '<div class="pro-hover-option text-center">';

			foreach ($swatches_to_show as $key => $swatch) {
				$style = $class = '';

				if( ! empty( $swatch['image'] ) ) {
					$style = 'background-image: url(' . $swatch['image'] . ')';
				} else if( ! empty( $swatch['color'] )) {
					$style = 'background-color:' .  $swatch['color'];
				} else if( ! empty( $swatch['not_dropdown'] ) ) {
					$class .= 'text-only ';
				}

				$style .= '; width: '.$swatch_width.'px; height: '.$swatch_width.'px;';

				$data = '';

				if( isset( $swatch['image_src'] ) ) {
					$class .= 'swatch-has-image';
					$data .= 'data-image-src="' . $swatch['image_src'] . '"';
					$data .= ' data-image-srcset="' . $swatch['image_srcset'] . '"';
					$data .= ' data-image-sizes="' . $swatch['image_sizes'] . '"';

					if( ! $swatch['is_in_stock'] ) {
						$class .= ' variation-out-of-stock';
					}
				}

				$term = get_term_by( 'slug', $key, $attribute_name );

				echo '<div class="swatch-on-grid swatch-tooltip ' . esc_attr( $class ) . '" style="' . esc_attr( $style ) .'" ' . $data . ' title="'.$term->name.'"></div>';
			}

			echo '</div>';
		}
	}
}

if( ! function_exists( 'moon_shop_get_option_variations' ) ) {
	function moon_shop_get_option_variations( $attribute_name, $available_variations, $option = false, $product_id = false ) {
		$swatches_to_show = array();
		foreach ($available_variations as $key => $variation) {
			$option_variation = array();
			$attr_key = 'attribute_' . $attribute_name;
			if( ! isset( $variation['attributes'][$attr_key] )) return;

			$val = $variation['attributes'][$attr_key]; // red green black ..

			if( ! empty( $variation['image']['src'] ) ) {
				$option_variation = array(
					'variation_id' => $variation['variation_id'],
					'image_src' => $variation['image']['src'],
					'image_srcset' => $variation['image']['srcset'],
					'image_sizes' => $variation['image']['sizes'],
					'is_in_stock' => $variation['is_in_stock'],
				);
			}

			// Get only one variation by attribute option value 
			if( $option ) {
				if( $val != $option ) {
					continue;
				} else {
					return $option_variation;
				}
			} else {
				// Or get all variations with swatches to show by attribute name
				
				$swatch = moon_shop_has_swatch($product_id, $attribute_name, $val);
				$swatches_to_show[$val] = array_merge( $option_variation, $swatch);

			}

		}

		return $swatches_to_show;
	}
}

if( ! function_exists( 'moon_shop_has_swatch' ) ) {
	function moon_shop_has_swatch($id, $attr_name, $value) {
		$swatches = array();

		$color = $image = $not_dropdown = '';
		$term = get_term_by( 'slug', $value, $attr_name );
	
		if ( is_object( $term ) ) {
			$cring_options = get_option($attr_name.'_'.$term->term_id);
			$color = $cring_options['swatch-color'];
			$image = $cring_options['swatch-image-url'];
			$not_dropdown = $cring_options['enable-swatch'];
		}

		if( $color != '' ) {
			$swatches['color'] = $color;
		}

		if( $image != '' ) {
			$swatches['image'] = $image;
		}

		if( $not_dropdown != '' ) {
			$swatches['not_dropdown'] = $not_dropdown;
		}

		return $swatches;
	}
}

if( ! function_exists( 'moon_shop_has_swatches' ) ) {
	function moon_shop_has_swatches( $id, $attr_name, $options, $available_variations, $swatches_use_variation_images = false ) {
		$swatches = array();

		foreach ($options as $key => $value) {
			$swatch = moon_shop_has_swatch($id, $attr_name, $value);

			if( ! empty( $swatch ) ) {

				if( $swatches_use_variation_images && get_theme_mod('cring_product_catalog_swatch') == $attr_name ) {

					$variation = moon_shop_get_option_variations( $attr_name, $available_variations, $value );

					$swatch = array_merge( $swatch, $variation);
				}

				$swatches[$key] = $swatch;
			}
		}

		return $swatches;
	}
}

if(! function_exists('moon_shop_theme_color')) {
	function moon_shop_theme_color() {
		$moon_shop_optionsValue = get_option( 'moon_shop' );

		$moon_shop_custom_color = isset($moon_shop_optionsValue['moon-shop-deafult-colors']) ? $moon_shop_optionsValue['moon-shop-deafult-colors'] : '1';
        if ($moon_shop_custom_color == '1') {
            $theme_color = '#e2214b';
        } else if ($moon_shop_custom_color == '2') {
            $theme_color = '#1e73be';
        } else if ($moon_shop_custom_color == '3') {
            $theme_color = '#f57c00';
        } else if ($moon_shop_custom_color == '4') {
            $theme_color = '#ab47bc';
        } else if ($moon_shop_custom_color == '5') {
            $theme_color = '#e67fb9';
        } else if ($moon_shop_custom_color == '6') {
            $theme_color = '#00acc1';
        } else if ($moon_shop_custom_color == '7') {
            $theme_color = '#8b82d5';
        } else if ($moon_shop_custom_color == '8') {
            $theme_color = '#43a047';
        } else if ($moon_shop_custom_color == '9') {
            $theme_color = '#ab8b65';
        } else if ($moon_shop_custom_color == '10') {
            $theme_color = (isset($moon_shop_optionsValue['moon-shop-theme-color-options']) && $moon_shop_optionsValue['moon-shop-theme-color-options'] != '') ? $moon_shop_optionsValue['moon-shop-theme-color-options'] : '#e2214b';
        }

        return $theme_color;
	}
}