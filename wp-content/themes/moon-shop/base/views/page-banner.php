<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );

//enqueue inline style css
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$moon_shop_custom_inline_style = '';

//Page banner title alignment theme option
$moon_shop_page_title_align = isset( $moon_shop_optionsValue[ 'moon-shop-page-title-alignment' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-title-alignment' ] ) : '';

$moon_shop_page_id = $post->ID;
if (in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) )) {
    if (is_shop()) {
        $moon_shop_page_id = wc_get_page_id( 'shop' );
    }
}

//Page banner select page meta
$moon_shop_page_banner_select_meta = get_post_meta( $moon_shop_page_id , 'moon-shop-page-banner-select' , true );

if( $moon_shop_page_banner_select_meta == 'banner-color' ) {
    if( esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-background-color' , true ) ) != '' ) {
        $moon_shop_custom_inline_style .= '.page-banner { background: ' . esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-background-color' , true ) ) . ';}';
    }
} else if( $moon_shop_page_banner_select_meta == 'background-image' ) {
    if( esc_url( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-image' , true ) ) ) {
        $moon_shop_custom_inline_style .= '.page-banner { background: url( ' . esc_url( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-image' , true ) ) . ' );}';
    }
    $moon_shop_page_banner_overlay = '';
    $moon_shop_page_banner_select = '';
    if( esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-overlay-color' , true ) ) != '' ) {
        $moon_shop_page_banner_overlay = esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-overlay-color' , true ) );
        $moon_shop_page_banner_opacity = esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-image-opacity' , true ) );
        $moon_shop_page_banner_select = 'background-image';
    }
} else {
    //Page banner select theme option
    $moon_shop_page_banner_select = isset( $moon_shop_optionsValue[ 'moon-shop-page-title-background-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-title-background-select' ] ) : '';

    //Page banner overlay theme option
    $moon_shop_page_banner_overlay = isset( $moon_shop_optionsValue[ 'moon-shop-page-title-background-overlay-color' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-title-background-overlay-color' ] ) : '';

    //Page banner opacity theme option
    $moon_shop_page_banner_opacity = isset( $moon_shop_optionsValue[ 'moon-shop-page-title-background-opacity' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-title-background-opacity' ] ) : '';

}

//Page banner height select theme option
$moon_shop_page_banner_height_select = isset( $moon_shop_optionsValue[ 'moon-shop-page-title-background-height-select' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-title-background-height-select' ] ) : '';

//Page banner height set theme option
$moon_shop_page_banner_height_set = isset( $moon_shop_optionsValue[ 'moon-shop-page-title-background-height' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-page-title-background-height' ] ) : '';
//Page title alignment theme option
if( $moon_shop_page_title_align != '' ) {
    $moon_shop_custom_inline_style .= '.page-banner { text-align: ' . $moon_shop_page_title_align . ';}';
} else {
    $moon_shop_custom_inline_style .= '.page-banner { text-align: center; }';
}

//Page banner overlay theme option
if( $moon_shop_page_banner_overlay != '' && $moon_shop_page_banner_select == 'background-image' ) {
    list( $r , $g , $b ) = sscanf( $moon_shop_page_banner_overlay , "#%02x%02x%02x" );
    $moon_shop_custom_inline_style .= '.overlay {
                background-color: rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $moon_shop_page_banner_opacity . ' );
             }';
}

$moon_shop_full_banner = '';
//page banner height meta
$moon_shop_banner_height = esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-page-banner-height-select' , true ) );
if( $moon_shop_page_banner_select_meta == 'default' || $moon_shop_banner_height == 'default' ) {
    //banner custom height set theme option
    if( $moon_shop_page_banner_height_select == 'custom-height' && $moon_shop_page_banner_height_set != '' ) {
        $moon_shop_custom_inline_style .= '.page-banner { height: ' . $moon_shop_page_banner_height_set . 'px;}';
    } else {
        $moon_shop_custom_inline_style .= '.page-banner { height: ' . $moon_shop_page_banner_height_set . 'px;}';
    }
    //banner full height set theme option
    if( $moon_shop_page_banner_height_select == 'full-height' ) {
        $moon_shop_full_banner = 'full-banner';
    }
} else {
    if( $moon_shop_banner_height == 'full-height' ) {
        $moon_shop_full_banner = 'full-banner';
    } else if( $moon_shop_banner_height == 'custom-height' && esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-custom-height' , true ) ) != '' ) {
        $moon_shop_custom_inline_style .= '.page-banner { height: ' . esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-custom-height' , true ) ) . 'px;}';
        $moon_shop_custom_inline_style .= '.page-banner.moon-shop-banner { height: ' . esc_attr( get_post_meta( $moon_shop_page_id , 'moon-shop-banner-custom-height' , true ) ) . 'px;}';
    }
}
 
if( $moon_shop_page_banner_select == 'background-none' ) {
	$moon_shop_custom_inline_style .= '.page-banner { background: inherit; }';
}

//for shop category page
if (in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) && is_product_category() ) {
    $moon_shop_category_bc = isset($moon_shop_optionsValue['moon-shop-product-page-banner-select']) ? $moon_shop_optionsValue['moon-shop-product-page-banner-select'] : 'background_color';
    $moon_shop_category_bc_color = isset($moon_shop_optionsValue['moon-shop-product-banner-background-color']) ? $moon_shop_optionsValue['moon-shop-product-banner-background-color'] : '';
    $moon_shop_category_bc_image = isset($moon_shop_optionsValue['moon-shop-product-banner-background-image']) ? $moon_shop_optionsValue['moon-shop-product-banner-background-image'] : '';
    $moon_shop_category_bc_image_overlay = isset($moon_shop_optionsValue['moon-shop-product-banner-image-background-color']) ? $moon_shop_optionsValue['moon-shop-product-banner-image-background-color'] : '';
    $moon_shop_category_height_op = isset($moon_shop_optionsValue['moon-shop-product-page-banner-height']) ? $moon_shop_optionsValue['moon-shop-product-page-banner-height'] : 'default';
    $moon_shop_category_height = isset($moon_shop_optionsValue['moon-shop-product-banner-image-custom-height']) ? $moon_shop_optionsValue['moon-shop-product-banner-image-custom-height'] : '200';

    if ($moon_shop_category_bc == 'category') {
        global $wp_query;
        // get the query object
        $moon_shop_cat = $wp_query->get_queried_object();

        // get the thumbnail id using the queried category term_id
        $moon_shop_thumbnail_id = get_woocommerce_term_meta( $moon_shop_cat->term_id, 'thumbnail_id', true ); 

        // get the image URL
        $moon_shop_image = wp_get_attachment_url( $moon_shop_thumbnail_id );
        $moon_shop_custom_inline_style .= '.page-banner { background-image: url("'.$moon_shop_image.'"); }';
        $moon_shop_custom_inline_style .= '.page-banner .overlay { background-color: '.$moon_shop_category_bc_image_overlay['rgba'].'; }';
    } else if ($moon_shop_category_bc == 'custom') {
        $moon_shop_custom_inline_style .= '.page-banner { background-image: url("'.$moon_shop_category_bc_image['background-image'].'"); }';
        $moon_shop_custom_inline_style .= '.page-banner { background-repeat: no-repeat; background-position: center top; }';
        $moon_shop_custom_inline_style .= '.page-banner .overlay { background-color: '.$moon_shop_category_bc_image_overlay['rgba'].'; }';
    } else if ($moon_shop_category_bc == 'background_color') {
        if ($moon_shop_category_bc_color == '') {
            $moon_shop_theme_color = moon_shop_theme_color();
            $moon_shop_custom_inline_style .= '.page-banner { background-color: '.$moon_shop_theme_color.'; }';
        } else {
            $moon_shop_custom_inline_style .= '.page-banner { background-color: '.$moon_shop_category_bc_color.'; }';
        }
    }
    if( $moon_shop_category_height_op == 'full-height' ) {
        $moon_shop_full_banner = 'full-banner';
    } else if( $moon_shop_category_height_op == 'custom' ) {
        $moon_shop_custom_inline_style .= '.page-banner.moon-shop-banner { height: ' . $moon_shop_category_height . 'px;}';
    }
}
wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );
?>

<!-- Page Banner -->
<div class="page-banner relative <?php echo esc_attr( $moon_shop_full_banner ).' ';
if( in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) && is_woocommerce() ) {
    echo 'moon-shop-banner';
} ?>">
    <div class="display-table absolute overlay">
        <div class="vertical-middle">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1><?php 
                        if (in_array( 'woocommerce/woocommerce.php' , apply_filters( 'active_plugins' , get_option( 'active_plugins' ) ) ) && is_woocommerce()) {
                            woocommerce_page_title();
                        } else {
                        	if (is_front_page()) {
                        		the_title();
                        	} else {
                        		wp_title( '' , true , '' );
                        	}
                        }
                        ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>