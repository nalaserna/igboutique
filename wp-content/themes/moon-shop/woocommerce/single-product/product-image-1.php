<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
    return;
}

global $product;
$moon_shop_optionsValue = get_option( 'moon_shop' );
$zoom_on_off = (isset($moon_shop_optionsValue['moon-shop-hover-zoom']) && $moon_shop_optionsValue['moon-shop-hover-zoom'] == '1') ? 'easyzoom easyzoom--overlay' : '';

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
    'woocommerce-product-gallery--columns-' . absint( $columns ),
    'images',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> pro-image-tab-container tab-content" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <span class="zoom" data-index="0"><i class="fa fa-search"></i></span>
    <figure id="product-image" class="owl-carousel owl-theme woocommerce-product-gallery__wrapper">
        <?php
        if ( has_post_thumbnail() ) {
            $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
            $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
            $image_size        = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );
            $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
            $thumbnail_src     = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
            $full_src          = wp_get_attachment_image_src( $post_thumbnail_id, $full_size );
            $image             = wp_get_attachment_image( $post_thumbnail_id, $image_size, false, array(
                'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
                'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
                'data-src'                => $full_src[0],
                'data-large_image'        => $full_src[0],
                'data-large_image_width'  => $full_src[1],
                'data-large_image_height' => $full_src[2],
                'class'                   => 'wp-post-image',
            ) );

            $html  = '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="item '.$zoom_on_off.' woocommerce-product-gallery__image" data-zoom="'.$zoom_on_off.'"><a href="' . esc_url( $full_src[0] ) . '">';
            $html .= $image;
            $html .= '</a></div>';
        } else {
            $html  = '<div class="item easyzoom easyzoom--overlay">';
            $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'moon-shop' ) );
            $html .= '</div>';
        }

        echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

        $attachment_ids = $product->get_gallery_image_ids();

        if ( $attachment_ids && has_post_thumbnail() ) {
            foreach ( $attachment_ids as $attachment_id ) {
                $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
                $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
                $image_size        = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );
                $full_size_src    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
                $full_size_image  = wp_get_attachment_image_src( $attachment_id, $full_size_src );
                $thumbnail        = wp_get_attachment_image_src( $attachment_id, 'gallery_thumbnail' );
                $thumbnail_post   = get_post( $attachment_id );
                $image_title      = $thumbnail_post->post_content;

                $attributes = array(
                    'title'                   => $image_title,
                    'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                    'data-src'                => $full_size_image[0],
                    'data-large_image'        => $full_size_image[0],
                    'data-large_image_width'  => $full_size_image[1],
                    'data-large_image_height' => $full_size_image[2],
                );

                $html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="item '.$zoom_on_off.'"><a href="' . esc_url( $full_size_image[0] ) . '">';
                $html .= wp_get_attachment_image( $attachment_id, $image_size, false, $attributes );
                $html .= '</a></div>';

                echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
            }
        }
        ?>
    </figure>
    <?php
    do_action( 'woocommerce_product_thumbnails' );
    ?>
</div>

<?php
if( !function_exists( 'footer_script_single_product' ) ) {
    function footer_script_single_product() {
        $tClose = __('Close (Esc)', 'moon-shop');
        $tLoading = __('Loading...', 'moon-shop');
        $tPrev = __('Previous (Left arrow key)', 'moon-shop');
        $tNext = __('Next (Right arrow key)', 'moon-shop');
        $tError = __('The image could not be loaded.', 'moon-shop');
        $moon_shop_optionsValue = get_option( 'moon_shop' );
        $slidesPerPage = isset($moon_shop_optionsValue['moon-shop-single-product-thumbs-number']) ? $moon_shop_optionsValue['moon-shop-single-product-thumbs-number'] : '4';
        ?>
        <script>
        //product carousel
        var rtl = false;
        if (jQuery('body').hasClass('rtl')) {
            rtl = true;
        } else {
            rtl = false;
        }
        var sync1 = jQuery("#product-image");
        var sync2 = jQuery("#product-thumbs");
        var slidesPerPage = <?php echo esc_attr($slidesPerPage); ?>; //globaly define number of elements per page
        var syncedSecondary = true;
        
        sync1.owlCarousel({
            rtl:rtl,
            items : 1,
            slideSpeed : 1000,
            nav: false,
            autoplay: false,
            dots: true,
            loop: true,
            dots: false,
            responsiveRefreshRate : 200
        }).on('changed.owl.carousel', syncPosition);

        sync2.on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            rtl:rtl,
            items : slidesPerPage,
            dots: true,
            nav: true,
            autoplay: false,
            smartSpeed: 200,
            slideSpeed : 1000,
            dots: false,
            slideBy: slidesPerPage,
            responsiveRefreshRate : 200,
            navText: ['<svg width="20px" height="20px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>','<svg width="20px" height="20px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
        }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if you disable loop you have to comment this block
            var count = el.item.count-1;
            var current = Math.round(el.item.index - (el.item.count/2) - .5);

            if(current < 0) {
                current = count;
            }
            if(current > count) {
                current = 0;
            }

            //end block
            sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
              sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
              sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if(syncedSecondary) {
              var number = el.item.index;
              sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e){
            e.preventDefault();
            var number = jQuery(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
        /*----------------------------
           magnificPopup
        ------------------------------ */
        jQuery('.zoom').on('click', function (e) {
            e.preventDefault();
            jQuery.magnificPopup.close();
            var links = []; var i = 0; var currentItem = ''; var currentIndex;
            jQuery('#product-image').find('.owl-item:not(.cloned)').each(function() {
                var slide = {};
                slide.src = jQuery(this).children('.item').children('a').children('img').attr('data-large_image');
                links[i] = slide;
                if (jQuery(this).hasClass('active')) {
                    currentItem = jQuery(this).children('.item').children('a').children('img').attr('data-large_image');
                    currentIndex = i;
                }
                i++;
            });
            var mpDefaults = {
                tClose: '<?php echo esc_attr($tClose); ?>',
                tLoading: '<?php echo esc_attr($tLoading); ?>',
                gallery: {
                    tPrev: '<?php echo esc_attr($tPrev); ?>',
                    tNext: '<?php echo esc_attr($tNext); ?>',
                    tCounter: '%curr% of %total%'
                },
                image: {
                    tError: '<?php echo esc_attr($tError); ?>'
                },
                ajax: {
                    tError: '<?php echo esc_attr($tError); ?>'
                }
            }
            jQuery.magnificPopup.open(jQuery.extend(true, {}, mpDefaults, {
                items: links,
                gallery: {
                    enabled: true
                },
                type: 'image' // this is default type
            }), currentIndex);
        });
        var zoom = jQuery('#product-image .item').attr('data-zoom');
        if (zoom != '') {
            var $easyzoom = jQuery('.easyzoom').easyZoom();
            var api = $easyzoom.data('easyZoom');
            api.teardown();
            api._init();
        }
        </script>
    <?php }
}
add_action('wp_footer', 'footer_script_single_product', 100, 1);