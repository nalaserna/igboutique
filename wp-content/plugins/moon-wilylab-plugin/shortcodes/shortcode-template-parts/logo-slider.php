<?php
/**
 * Button shortcode
 */
extract( shortcode_atts( array( 
    'slider_category' => 'all',
    'slider_per_page' => ''
) , $atts ) );

//slider query args
if( $slider_category != 'all' ) {
    $args = array(
        'post_type'         => 'logos',
        'posts_per_page'    => $slider_per_page,
        'tax_query' => array(
            array(
                'taxonomy' => 'logos-category',
                'field'    => 'slug',
                'terms'    => $slider_category,
            ),
        ),
    );
} else {
    $args = array(
        'post_type'         => 'logos',
        'posts_per_page'    => $slider_per_page,
    );
}
$slider = new WP_Query( $args );
?>

<div class="brand-slider">
    <?php if( $slider->have_posts() ) {
        while( $slider->have_posts() ) : $slider->the_post(); ?>
            <div class="brand-item"><?php the_post_thumbnail( 'moon_shop_image_170x82' ); ?></div>
        <?php endwhile; wp_reset_postdata();
    } ?>
</div>
<?php
if( !function_exists( 'footer_script_brand_shortcode' ) ) {
    function footer_script_brand_shortcode() { ?>
        <script type="text/javascript">
            jQuery('.brand-slider').slick({
                speed: 300,
                slidesToShow: 4,
                autoplay: true,
                slidesToScroll: 1,
                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-long-arrow-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-long-arrow-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1169,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        </script>
    <?php
    }
    add_action('wp_footer','footer_script_brand_shortcode' , 100, 1);
}