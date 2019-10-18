<?php


add_shortcode( 'moon_wl_titles' , 'moon_wl_titles' );
/***
 * Function to load Title
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_titles( $atts , $content = null ) {

    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/title.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'moon_wl_cta_box' , 'moon_wl_cta_box' );
/***
 * Function to load CTA Box
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_cta_box( $atts , $content = null ) {

    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/cta-box.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
add_shortcode( 'moon_wl_button' , 'moon_wl_button' );
/***
 * Function to load Button
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_button( $atts , $content = null ) {

    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/button-content.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'moon_wl_newsletter' , 'moon_wl_newsletter' );
/***
 * Function to load Newsletter
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_newsletter( $atts , $content = null ) {

    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/newsletter.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'moon_wl_social_links' , 'moon_wl_social_links' );
/***
 * Function to load Social links
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_social_links( $atts , $content = null ) {


    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/social-content.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'moon_wl_logo' , 'moon_wl_logo' );
/***
 * Function to load Social links
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_logo( $atts , $content = null ) {


    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/logo-slider.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'moon_wl_products_slider' , 'moon_wl_products_slider' );
/***
 * Function to load Product Slider
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_products_slider( $atts , $content = null ) {


    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/products-slider.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
 
 add_shortcode('moon_wl_badge', 'moon_wl_badge');
 /***
 * Function to load Badge
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */

 
function moon_wl_badge($atts, $content = null) {
    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/badge.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
 }
 add_shortcode( 'moon_wl_sin_promo' , 'moon_wl_sin_promo' );
/***
 * Function to Sin Promo
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_sin_promo( $atts , $content = null ) {

    ob_start();
    set_query_var( 'atts', $atts );

    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/sin-promo.php' );
    $output = ob_get_contents();
    
    ob_end_clean();

    return $output;
}

 add_shortcode( 'moon_wl_blog' , 'moon_wl_blog' );
/***
 * Function to load Blog
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
function moon_wl_blog( $atts , $content = null ) {

    ob_start();
    set_query_var( 'atts', $atts );

    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/blog.php' );
    $output = ob_get_contents();
    
    ob_end_clean();

    return $output;
}

 /***
 * Function to load Small Banner
 *
 * @param array - $atts
 * @param string - $content
 *
 * @return string   - $output
 */
 
 add_shortcode('moon_wl_sm_banner', 'moon_wl_sm_banner');
 
function moon_wl_sm_banner($atts, $content = null) {
    ob_start();
    set_query_var( 'atts', $atts );
    include( plugin_dir_path( __FILE__ ).'shortcode-template-parts/sm-banner.php' );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode( 'moon_recent_products', 'moon_recent_products' );
/***
 * Function to recent products
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_recent_products($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/recent-products.php');
    return ob_get_clean();
}

add_shortcode( 'moon_featured_products', 'moon_featured_products' );
/***
 * Function to featured products
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_featured_products($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/featured-products.php');
    return ob_get_clean();
}

add_shortcode( 'moon_sale_products', 'moon_sale_products' );
/***
 * Function to sale products
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_sale_products($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/sale-products.php');
    return ob_get_clean();
}

add_shortcode( 'moon_best_selling_products', 'moon_best_selling_products' );
/***
 * Function to best selling products
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_best_selling_products($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/best-sale-products.php');
    return ob_get_clean();
}

add_shortcode( 'moon_top_rated_products', 'moon_top_rated_products' );
/***
 * Function to Top rated products
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_top_rated_products($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/top-rated-products.php');
    return ob_get_clean();
}

add_shortcode( 'moon_products_tab', 'moon_products_tab' );
/***
 * Function to Products Tab
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_products_tab($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/products-tab.php');
    return ob_get_clean();
}

add_shortcode( 'moon_album', 'moon_album' );
/***
 * Function to Album
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_album($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/album.php');
    return ob_get_clean();
}

add_shortcode( 'moon_gallery', 'moon_gallery' );
/***
 * Function to Gallery
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
function moon_gallery($atts, $content = null) {
    ob_start();
    include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/gallery.php');
    return ob_get_clean();
}

//add_shortcode( 'moon_portfolio', 'moon_portfolio' );
/***
 * Function to Portfolio
 * 
 * @param array     - $atts
 * @param string    - $content
 * 
 * @return string   - $output
 */
// function moon_portfolio($atts, $content = null) {
//     ob_start();
//     include(plugin_dir_path( __FILE__ ). 'shortcode-template-parts/portfolio.php');
//     return ob_get_clean();
// }