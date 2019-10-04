<?php
$moon_shop_rev_slider = get_post_meta( $post->ID , 'moon-shop-rv-silder-sc-select' , true );
echo do_shortcode( '[rev_slider alias="' . $moon_shop_rev_slider . '"]' );
