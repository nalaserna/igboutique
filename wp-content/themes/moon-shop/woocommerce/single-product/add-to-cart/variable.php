<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$moon_shop_optionsValue = get_option( 'moon_shop' );

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'moon-shop' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php $loop = 0; foreach ( $attributes as $attribute_name => $options ) : $loop++;
				$swatches = moon_shop_has_swatches( $product->get_id(), $attribute_name, $options, $available_variations, false);
				$moon_has_swatch = false;
				foreach ($swatches as $key => $value) {
					if (array_key_exists('not_dropdown', $value) && $value['not_dropdown'] == 'on') {
						$moon_has_swatch = true;
					}
				}
				?>
					<tr>
						<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
						<td class="value <?php if ( $moon_has_swatch ): ?>with-swatches<?php endif; ?>">
							<?php if ( $moon_has_swatch ): ?>
                                <div class="swatches-select" data-id="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
                                    <?php
                                        if ( is_array( $options ) ) {

                                            if ( isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) {
                                                $selected_value = $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ];
                                            } elseif ( isset( $selected_attributes[ sanitize_title( $attribute_name ) ] ) ) {
                                                $selected_value = $selected_attributes[ sanitize_title( $attribute_name ) ];
                                            } else {
                                                $selected_value = '';
                                            }

                                            // Get terms if this is a taxonomy - ordered
                                            if ( taxonomy_exists( $attribute_name ) ) {

                                                $terms = wc_get_product_terms( $product->get_id(), $attribute_name, array( 'fields' => 'all' ) );

                                                $_i = 0;
                                                $options_fliped = array_flip( $options );
                                                foreach ( $terms as $term ) {
                                                    if ( ! in_array( $term->slug, $options ) ) {
                                                        continue;
                                                    }
                                                    $key = $options_fliped[$term->slug];

                                                    $style = '';
                                                    $class = 'moon-shop-swatch moon-shop-tooltip ';
                                                    if( ! empty( $swatches[$key]['image'] )) {
                                                        $class .= ' image-swatch';
                                                        $style = 'background-image: url(' . $swatches[$key]['image'] . ')';
                                                    } else if( ! empty( $swatches[$key]['color'] )) {
                                                        $class .= ' colored-swatch';
                                                        $style = 'background-color:' .  $swatches[$key]['color'];
                                                    } else if( ! empty( $swatches[$key]['not_dropdown'] ) ) {
                                                        $class .= ' text-only';
                                                    }

                                                    echo '<div class="' . esc_attr( $class ) . '" data-value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $term->slug ), false ) . ' style="' . esc_attr( $style ) .'" title="' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '"></div>';

                                                    $_i++;
                                                }

                                            } else {

                                                foreach ( $options as $option ) {
                                                    echo '<div data-value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</div>';
                                                }

                                            }
                                        }
                                    ?>

                                </div>

                            <?php endif; ?>
							<?php
								wc_dropdown_variation_attribute_options( array(
									'options'   => $options,
									'attribute' => $attribute_name,
									'product'   => $product,
								) );
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'moon-shop' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
