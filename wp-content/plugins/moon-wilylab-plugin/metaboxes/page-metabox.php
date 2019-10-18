<?php

/* Adding Metaboxes For Pages */

add_action( 'add_meta_boxes' , 'moon_shop_additionalMetaBoxes' , 100 );

/* Saving Post Data */

add_action( 'save_post' , 'moon_shop_savePageData' );

/*
 * Function to add metabox
 */

function moon_shop_additionalMetaBoxes() {
    add_meta_box( 'msk-theme-option-content' , esc_html__( 'Page Settings' , 'moon-shop' ) , 'moon_shop_pageHeader' , 'page' , 'normal' , 'high' );
}

/**
 * Function To Generate Page Header Metabox Options
 */

function moon_shop_pageHeader() {

    wp_nonce_field( 'moon-shop-page-meta-options' , 'moon-shop-page-meta-nonce' );

    global $post_id;

    // Getting Previously Saved Values

    $moon_shop_values = get_post_custom( $post_id );

    //page logo section
    $moon_shop_page_logo = isset( $moon_shop_values[ 'moon-shop-page-logo' ][ 0 ] ) ? esc_url( $moon_shop_values[ 'moon-shop-page-logo' ][ 0 ] ) : '';

    $moon_shop_trans = isset( $moon_shop_values[ 'moon-shop-header-transparent' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-header-transparent' ][ 0 ] ) : 'off';

    //slider options
    $moon_shop_slider_select = isset( $moon_shop_values[ 'moon-shop-page-silder-select' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-silder-select' ][ 0 ] ) : '';

    //revolution slider shortcode select
    $moon_shop_rv_slider_select = isset( $moon_shop_values[ 'moon-shop-rv-silder-sc-select' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-rv-silder-sc-select' ][ 0 ] ) : '';

    //slider category
    $moon_shop_slider_category_select = isset( $moon_shop_values[ 'moon-shop-page-silder-category-select' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-silder-category-select' ][ 0 ] ) : '';

    //slides per page
    $moon_shop_slides_per_page = isset( $moon_shop_values[ 'moon-shop-slider-per-page' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-slider-per-page' ][ 0 ] ) : '';

    //slider custom height
    $moon_shop_slider_height = isset( $moon_shop_values[ 'moon-shop-slider-height' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-slider-height' ][ 0 ] ) : '';

    //slider width
    $moon_shop_slider_width = isset( $moon_shop_values[ 'moon-shop-page-silder-width' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-silder-width' ][ 0 ] ) : '';

    //slider animation select
    $moon_shop_slider_animation_select = isset( $moon_shop_values[ 'moon-shop-slider-animation-select' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-slider-animation-select' ][ 0 ] ) : '';

    //slider control nav
    $moon_shop_slider_CN_on_off = isset( $moon_shop_values[ 'moon-shop-slider-control-nav-on-off' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-slider-control-nav-on-off' ][ 0 ] ) : '';

    //slider direction nav
    $moon_shop_slider_DN_on_off = isset( $moon_shop_values[ 'moon-shop-slider-direction-nav-on-off' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-slider-direction-nav-on-off' ][ 0 ] ) : '';

    //slider direction nav
    $moon_shop_slider_AP_on_off = isset( $moon_shop_values[ 'moon-shop-slider-auto-play-on-off' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-slider-auto-play-on-off' ][ 0 ] ) : '';

    //banner options
    $moon_shop_banner_on_off = isset( $moon_shop_values[ 'moon-shop-page-banner-on-off' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-banner-on-off' ][ 0 ] ) : 'on';

    //banner select options
    $moon_shop_banner_select = isset( $moon_shop_values[ 'moon-shop-page-banner-select' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-banner-select' ][ 0 ] ) : '';

    //banner image
    $moon_shop_banner_image = isset( $moon_shop_values[ 'moon-shop-banner-image' ][ 0 ] ) ? esc_url( $moon_shop_values[ 'moon-shop-banner-image' ][ 0 ] ) : '';

    //banner overlay color
    $moon_shop_banner_overlay_color = isset( $moon_shop_values[ 'moon-shop-banner-overlay-color' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-banner-overlay-color' ][ 0 ] ) : '';

    //banner opacity
    $moon_shop_banner_opacity = isset( $moon_shop_values[ 'moon-shop-banner-image-opacity' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-banner-image-opacity' ][ 0 ] ) : '';

    //banner background color
    $moon_shop_banner_bg_color = isset( $moon_shop_values[ 'moon-shop-banner-background-color' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-banner-background-color' ][ 0 ] ) : '';

    //banner height select
    $moon_shop_banner_height_select = isset( $moon_shop_values[ 'moon-shop-page-banner-height-select' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-banner-height-select' ][ 0 ] ) : '';

    //banner height select
    $moon_shop_banner_custom_height = isset( $moon_shop_values[ 'moon-shop-banner-custom-height' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-banner-custom-height' ][ 0 ] ) : '';

    //page layout select
    $moon_shop_page_layout = isset( $moon_shop_values[ 'moon-shop-page-layout' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-layout' ][ 0 ] ) : '';

    //page sidebar select to load
    $moon_shop_page_sidebarLoad = isset( $moon_shop_values[ 'moon-shop-page-sidebar-load' ][ 0 ] ) ? esc_attr( $moon_shop_values[ 'moon-shop-page-sidebar-load' ][ 0 ] ) : '';
    ?>

    <div class="msk-theme-option-content">

    <table class="msk-theme-opt-form">

    <tbody>

    <!-- Upload page logo -->

    <tr>

        <th class="msk-left-column moon-shop-page-logo">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Upload Page Logo' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Choose your logo to set in this page' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column moon-shop-page-logo-close">

            <fieldset>

                <div class="msk-opt-upload">

                    <input id="moon-shop-page-logo" name="moon-shop-page-logo"
                           value="<?php echo esc_url( $moon_shop_page_logo ); ?>" type="text"/>

                    <button id="moon-shop-page-logo-uploader"
                            type="submit"><?php esc_html_e( 'Upload' , 'moon-shop' ); ?></button>

                    <div class="moon-shop-page-logo-wrapper">

                        <span id="moon-shop-page-logo-close"></span>

                        <img class="moon-shop-page-logo-loader" src="<?php echo esc_url( $moon_shop_page_logo ); ?>"/>

                    </div>

                </div>

            </fieldset>

        </td>

    </tr>

    <tr>
        <th class="msk-left-column moon-shop-header-transparent">
            <div class="msk-field-th">
                <h3 class="wlopt-title" for="moon-shop-header-transparent"><?php esc_html_e( 'Enable Header Transparent' , 'moon-shop' ); ?></h3>
            </div>
        </th>
        <td class="msk-right-column">
            <fieldset>
                <div class="msk-opt-upload">
                    <input type="checkbox" id="moon-shop-header-transparent" name="moon-shop-header-transparent" <?php checked( $moon_shop_trans , 'on' ) ?> />
                </div>
            </fieldset>
        </td>
    </tr>

    <!-- slider select option -->

    <tr>

        <th class="msk-left-column moon-shop-page-silder-select">

            <div class="msk-field-th">

                <h3 class="wlopt-title"
                    for="moon-shop-page-silder-on-off"><?php esc_html_e( 'Slider Enable/Disable' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Enable/Disable your page silder' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-silder-select" name="moon-shop-page-silder-select" class="opt_group">

                        <option value="none" <?php selected( $moon_shop_slider_select , 'none' ); ?>><?php esc_html_e( 'None' , 'moon-shop' ) ?></option>
                        <option value="revulotion-slider" <?php selected( $moon_shop_slider_select , 'revulotion-slider' ); ?>><?php esc_html_e( 'Revulotion Slider' , 'moon-shop' ) ?></option>
                    </select>

                </div>

            </fieldset>

        </td>

    </tr>

    <?php if( shortcode_exists( "rev_slider" ) ) { ?>

        <!-- revolution slider shortcode select option -->

        <tr>

            <th class="msk-left-column moon-shop-rv-silder-sc-select">

                <div class="msk-field-th">

                    <h3 class="wlopt-title"
                        for="moon-shop-page-silder-on-off"><?php esc_html_e( 'Select Created Slider' , 'moon-shop' ); ?></h3>

                    <p class="wlopt-sub-title"><?php esc_html_e( 'Select a revolution slider in this page.' , 'moon-shop' ); ?></p>

                </div>

            </th>

            <td class="msk-right-column">

                <fieldset>

                    <div class="choose-items">

                        <select id="moon-shop-rv-silder-sc-select" name="moon-shop-rv-silder-sc-select"
                                class="opt_group">
                            <?php $moon_shop_meta = get_post_meta( $post_id , 'mytheme_rev_slider' , true ); //in case it is a post/page option
                            $moon_shop_meta = get_option( 'mytheme_rev_slider' ); //in case it is a theme option
                            $moon_shop_slider = new RevSlider();
                            $moon_shop_revolution_sliders = $moon_shop_slider->getArrSliders(); ?>

                            <?php foreach( $moon_shop_revolution_sliders as $moon_shop_revolution_slider ) {

                                $moon_shop_alias = $moon_shop_revolution_slider->getAlias();

                                $moon_shop_title = $moon_shop_revolution_slider->getTitle(); ?>

                                <option value="<?php echo esc_attr( $moon_shop_alias ); ?>" <?php selected( $moon_shop_rv_slider_select , $moon_shop_alias ); ?>><?php echo esc_attr( $moon_shop_title ); ?></option>

                            <?php } ?>

                        </select>

                    </div>

                </fieldset>

            </td>

        </tr>

    <?php } ?>



    <!-- slider category option -->

    <tr>

        <th class="msk-left-column moon-shop-page-silder-category-select">

            <div class="msk-field-th">

                <h3 class="wlopt-title"
                    for="moon-shop-page-silder-on-off"><?php esc_html_e( 'Slider Category Select' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set slider category, default select all category' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-silder-category-select" name="moon-shop-page-silder-category-select" class="opt_group">

                        <option value="all" <?php selected( $moon_shop_slider_category_select , 'all' ); ?>><?php esc_html_e( 'All' , 'moon-shop' ) ?></option>

                        <?php
                        $slider_post = array(
                            'type' => 'slider' ,
                            'taxonomy' => 'slider-category'
                        );

                        $moon_shop_categories = get_categories( $slider_post );

                        foreach( $moon_shop_categories as $moon_shop_category ) { ?>

                            <option value="<?php echo esc_attr( $moon_shop_category->slug ); ?>" <?php selected( $moon_shop_slider_category_select , esc_attr( $moon_shop_category->slug ) ); ?>><?php echo esc_attr( $moon_shop_category->name ); ?></option>

                        <?php } ?>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Slider per page -->

    <tr>

        <th class="msk-left-column moon-shop-slider-per-page">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Slides Per Page' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set slides number which you want to show per page' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <div class="msk-opt-upload">

                        <input id="moon-shop-slider-per-page" name="moon-shop-slider-per-page" value="<?php echo esc_attr( $moon_shop_slides_per_page ); ?>" type="text"/>

                    </div>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Slider height -->

    <tr>

        <th class="msk-left-column moon-shop-slider-height">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Slider Custom Height' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set slider custom height in pixel' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <div class="msk-opt-upload">

                        <input id="moon-shop-slider-height" name="moon-shop-slider-height" value="<?php echo esc_attr( $moon_shop_slider_height ); ?>" type="text"/>

                        <span><?php esc_html_e( 'px' , 'moon-shop' ); ?></span>

                    </div>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Slider width -->

    <tr>

        <th class="msk-left-column moon-shop-page-silder-width">

            <div class="msk-field-th">

                <h3 class="wlopt-title" for="moon-shop-page-silder-on-off"><?php esc_html_e( 'Slider Width' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set page slider width' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-silder-width" name="moon-shop-page-silder-width" class="opt_group">

                        <option value="container" <?php selected( $moon_shop_slider_width , 'container' ); ?>><?php esc_html_e( 'Container' , 'moon-shop' ) ?></option>

                        <option value="full-width" <?php selected( $moon_shop_slider_width , 'full-width' ); ?>><?php esc_html_e( 'Full Width' , 'moon-shop' ) ?></option>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- slider animation effect options -->

    <tr>

        <th class="msk-left-column moon-shop-slider-animation-select">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Slides Options' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Select slider slides style' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-slider-animation-select" name="moon-shop-slider-animation-select" class="opt_group">

                        <option value="fade" <?php selected( $moon_shop_slider_animation_select , 'fade' ); ?>><?php esc_html_e( 'Fade' , 'moon-shop' ); ?></option>

                        <option value="slide" <?php selected( $moon_shop_slider_animation_select , 'slide' ); ?>><?php esc_html_e( 'Slide' , 'moon-shop' ); ?></option>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- slider control nav on/off -->

    <tr>

        <th class="msk-left-column moon-shop-slider-control-nav-on-off">

            <div class="msk-field-th">

                <h3 class="wlopt-title" for="moon-shop-page-banner-on-off"><?php esc_html_e( 'Slider Control Nav Enable/Disable' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Enable/Disable your page slider control navigation' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="msk-opt-upload">

                    <input type="checkbox" id="moon-shop-slider-control-nav-on-off"
                           name="moon-shop-slider-control-nav-on-off" <?php checked( $moon_shop_slider_CN_on_off , 'on' ) ?> />

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- slider direction nav on/off -->

    <tr>

        <th class="msk-left-column moon-shop-slider-direction-nav-on-off">

            <div class="msk-field-th">

                <h3 class="wlopt-title" for="moon-shop-page-banner-on-off"><?php esc_html_e( 'Slider Direction Nav Enable/Disable' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Enable/Disable your page slider control navigation' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="msk-opt-upload">

                    <input type="checkbox" id="moon-shop-slider-direction-nav-on-off"
                           name="moon-shop-slider-direction-nav-on-off" <?php checked( $moon_shop_slider_DN_on_off , 'on' ) ?> />

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- slider auto play on/off -->

    <tr>

        <th class="msk-left-column moon-shop-slider-auto-play-on-off">

            <div class="msk-field-th">

                <h3 class="wlopt-title"
                    for="moon-shop-page-banner-on-off"><?php esc_html_e( 'Slider Auto Play On/Off' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Enable/Disable your page slider auto play' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="msk-opt-upload">

                    <input type="checkbox" id="moon-shop-slider-auto-play-on-off"
                           name="moon-shop-slider-auto-play-on-off" <?php checked( $moon_shop_slider_AP_on_off , 'on' ) ?> />

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- banner on/off -->

    <tr>

        <th class="msk-left-column moon-shop-page-banner-on-off">

            <div class="msk-field-th">

                <h3 class="wlopt-title"
                    for="moon-shop-page-banner-on-off"><?php esc_html_e( 'Page Title Enable' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Enable your page title' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="msk-opt-upload">

                    <input type="checkbox" id="moon-shop-page-banner-on-off"
                           name="moon-shop-page-banner-on-off" <?php checked( $moon_shop_banner_on_off , 'on' ) ?> />

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Page banner select options -->

    <tr>

        <th class="msk-left-column moon-shop-page-banner-select">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Banner Options' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Select banner image/color' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-banner-select" name="moon-shop-page-banner-select" class="opt_group">

                        <option value="default" <?php selected( $moon_shop_banner_select , 'default' ); ?>><?php esc_html_e( 'Default' , 'moon-shop' ); ?></option>

                        <option value="background-image" <?php selected( $moon_shop_banner_select , 'background-image' ); ?>><?php esc_html_e( 'Banner Image' , 'moon-shop' ); ?></option>

                        <option value="banner-color" <?php selected( $moon_shop_banner_select , 'banner-color' ); ?>><?php esc_html_e( 'Banner Color' , 'moon-shop' ); ?></option>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Upload banner image -->

    <tr>

        <th class="msk-left-column moon-shop-banner-image">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Upload Banner Image' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Choose your banner image to set' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column moon-shop-banner-close">

            <fieldset>

                <div class="msk-opt-upload">

                    <input id="moon-shop-banner-image" name="moon-shop-banner-image"
                           value="<?php echo esc_url( $moon_shop_banner_image ); ?>" type="text"/>

                    <button id="moon-shop-banner-image-uploader" type="submit">Upload</button>

                    <div class="moon-shop-banner-image-wrapper">

                        <span id="moon-shop-banner-close"></span>

                        <img class="moon-shop-banner-image-loader"
                             src="<?php echo esc_url( $moon_shop_banner_image ); ?>"/>

                    </div>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- banner overlay color -->

    <tr>

        <th class="msk-left-column moon-shop-banner-overlay-color">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Overlay Color' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set your banner overlay color' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <input class="moon-shop-color-field" id="moon-shop-banner-overlay-color" name="moon-shop-banner-overlay-color" type="text" value="<?php echo esc_attr( $moon_shop_banner_overlay_color ); ?>"/>

            </fieldset>

        </td>

    </tr>


    <!-- Background opacity -->

    <tr>

        <th class="msk-left-column moon-shop-banner-image-opacity">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Background Color Opacity' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Choose background color opacity. If you choose 1, background image will not show.' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="msk-range-slider">

                    <input id="moon-shop-banner-image-opacity" name="moon-shop-banner-image-opacity" type="range"
                           min="0" max="1" step="0.1" value="<?php echo esc_attr( $moon_shop_banner_opacity ); ?>"
                           data-rangeSlider>

                    <output><?php echo esc_attr( $moon_shop_banner_opacity ); ?></output>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- banner background color -->

    <tr>

        <th class="msk-left-column moon-shop-banner-background-color">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Background Color' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set your background color' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <input class="moon-shop-color-field" id="moon-shop-banner-background-color"
                       name="moon-shop-banner-background-color" type="text"
                       value="<?php echo esc_attr( $moon_shop_banner_bg_color ); ?>"/>

            </fieldset>

        </td>

    </tr>


    <!-- Page banner height select options -->

    <tr>

        <th class="msk-left-column moon-shop-page-banner-height-select">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Banner Height Options' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Select banner height' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-banner-height-select" name="moon-shop-page-banner-height-select"
                            class="opt_group">

                        <option
                            value="default" <?php selected( $moon_shop_banner_height_select , 'default' ); ?>><?php esc_html_e( 'Default' , 'moon-shop' ); ?></option>

                        <option
                            value="full-height" <?php selected( $moon_shop_banner_height_select , 'full-height' ); ?>><?php esc_html_e( 'Full Height' , 'moon-shop' ); ?></option>

                        <option
                            value="custom-height" <?php selected( $moon_shop_banner_height_select , 'custom-height' ); ?>><?php esc_html_e( 'Custom Height' , 'moon-shop' ); ?></option>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Banner custom height -->

    <tr>

        <th class="msk-left-column moon-shop-banner-custom-height">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Banner Custom Height' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set banner custom height in pixel' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <div class="msk-opt-upload">

                        <input id="moon-shop-banner-custom-height" name="moon-shop-banner-custom-height"
                               value="<?php echo esc_attr( $moon_shop_banner_custom_height ); ?>" type="text"/>

                        <span><?php esc_html_e( 'px' , 'moon-shop' ); ?></span>

                    </div>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Page layout options -->

    <tr>

        <th class="msk-left-column moon-shop-page-layout">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Page Layout' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Set your page layout' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-layout" name="moon-shop-page-layout" class="opt_group">

                        <option
                            value="default" <?php selected( $moon_shop_page_layout , 'default' ); ?>><?php esc_html_e( 'Theme Default' , 'moon-shop' ); ?></option>
                        <option
                            value="no_sidebar" <?php selected( $moon_shop_page_layout , 'no_sidebar' ); ?>><?php esc_html_e( 'Full Width' , 'moon-shop' ); ?></option>
                        <option
                            value="left_sidebar" <?php selected( $moon_shop_page_layout , 'left_sidebar' ); ?>><?php esc_html_e( 'Left Sidebar' , 'moon-shop' ); ?></option>

                        <option
                            value="right_sidebar" <?php selected( $moon_shop_page_layout , 'right_sidebar' ); ?>><?php esc_html_e( 'Right Sidebar' , 'moon-shop' ); ?></option>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>


    <!-- Page layout options -->

    <tr>

        <th class="msk-left-column moon-shop-page-sidebar-load">

            <div class="msk-field-th">

                <h3 class="wlopt-title"><?php esc_html_e( 'Select Sidebar' , 'moon-shop' ); ?></h3>

                <p class="wlopt-sub-title"><?php esc_html_e( 'Choose sidebar to load this page' , 'moon-shop' ); ?></p>

            </div>

        </th>

        <td class="msk-right-column">

            <fieldset>

                <div class="choose-items">

                    <select id="moon-shop-page-sidebar-load" name="moon-shop-page-sidebar-load" class="opt_group">

                        <option
                            value="default" <?php selected( $moon_shop_page_sidebarLoad , 'default' ); ?>><?php esc_html_e( 'Theme Default' , 'moon-shop' ); ?></option>

                        <?php

                        global $wp_registered_sidebars;

                        foreach( $wp_registered_sidebars as $moon_shop_sideBar ) {
                            ?>

                            <option
                                value="<?php echo esc_attr( $moon_shop_sideBar[ 'id' ] ); ?>" <?php selected( $moon_shop_page_sidebarLoad , $moon_shop_sideBar[ 'id' ] ); ?>><?php echo esc_attr( $moon_shop_sideBar[ 'name' ] ); ?></option>

                        <?php } ?>

                    </select>

                </div>

            </fieldset>

        </td>

    </tr>

    </tbody>

    </table>

    </div>
<?php }

/**
 * Function to save user data
 * @param integer $post_id Current Post ID
 * @return
 */

function moon_shop_savePageData( $post_id ) {

    // Bail if doing auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Check for valid nonce
    if( !isset( $_POST[ 'moon-shop-page-meta-nonce' ] ) || !wp_verify_nonce( $_POST[ 'moon-shop-page-meta-nonce' ] , 'moon-shop-page-meta-options' ) ) return;

    // If current user can't edit this post
    if( !current_user_can( 'edit_posts' ) ) return;

    // Saving page meta data

    // page logo
    if( isset( $_POST[ 'moon-shop-page-logo' ] ) ) update_post_meta( $post_id , 'moon-shop-page-logo' , esc_attr( $_POST[ 'moon-shop-page-logo' ] ) );

    $moon_shop_trans_op = isset( $_POST[ 'moon-shop-header-transparent' ] ) ? 'on' : 'off';
    update_post_meta( $post_id, 'moon-shop-header-transparent', $moon_shop_trans_op );

    // page slider select option
    if( isset( $_POST[ 'moon-shop-page-silder-select' ] ) ) update_post_meta( $post_id , 'moon-shop-page-silder-select' , esc_attr( $_POST[ 'moon-shop-page-silder-select' ] ) );

    // revolution slider shortcode select option
    if( isset( $_POST[ 'moon-shop-rv-silder-sc-select' ] ) ) update_post_meta( $post_id , 'moon-shop-rv-silder-sc-select' , esc_attr( $_POST[ 'moon-shop-rv-silder-sc-select' ] ) );

    // page slider category select
    if( isset( $_POST[ 'moon-shop-page-silder-category-select' ] ) ) update_post_meta( $post_id , 'moon-shop-page-silder-category-select' , esc_attr( $_POST[ 'moon-shop-page-silder-category-select' ] ) );

    // slides per page
    if( isset( $_POST[ 'moon-shop-slider-per-page' ] ) ) update_post_meta( $post_id , 'moon-shop-slider-per-page' , esc_attr( $_POST[ 'moon-shop-slider-per-page' ] ) );

    // slider custom height
    if( isset( $_POST[ 'moon-shop-slider-height' ] ) ) update_post_meta( $post_id , 'moon-shop-slider-height' , esc_attr( $_POST[ 'moon-shop-slider-height' ] ) );

    // slider width
    if( isset( $_POST[ 'moon-shop-page-silder-width' ] ) ) update_post_meta( $post_id , 'moon-shop-page-silder-width' , esc_attr( $_POST[ 'moon-shop-page-silder-width' ] ) );

    // slider animation select
    if( isset( $_POST[ 'moon-shop-slider-animation-select' ] ) ) update_post_meta( $post_id , 'moon-shop-slider-animation-select' , esc_attr( $_POST[ 'moon-shop-slider-animation-select' ] ) );

    // Enable/Disable slider control nav
    $moon_shop_slider_CN_on_off = isset( $_POST[ 'moon-shop-slider-control-nav-on-off' ] ) ? 'on' : 'off';

    update_post_meta( $post_id , 'moon-shop-slider-control-nav-on-off' , $moon_shop_slider_CN_on_off );

    // Enable/Disable slider direction nav
    $moon_shop_slider_DN_on_off = isset( $_POST[ 'moon-shop-slider-direction-nav-on-off' ] ) ? 'on' : 'off';

    update_post_meta( $post_id , 'moon-shop-slider-direction-nav-on-off' , $moon_shop_slider_DN_on_off );

    // Enable/Disable slider auto play
    $moon_shop_slider_AP_on_off = isset( $_POST[ 'moon-shop-slider-auto-play-on-off' ] ) ? 'on' : 'off';

    update_post_meta( $post_id , 'moon-shop-slider-auto-play-on-off' , $moon_shop_slider_AP_on_off );

    // Enable/Disable Page banner
    $moon_shop_banner_on_off = isset( $_POST[ 'moon-shop-page-banner-on-off' ] ) ? 'on' : 'off';

    update_post_meta( $post_id , 'moon-shop-page-banner-on-off' , $moon_shop_banner_on_off );

    // page banner select option
    $moon_shop_banner_select = isset( $_POST[ 'moon-shop-page-banner-select' ] ) && !empty($_POST[ 'moon-shop-page-banner-select' ]) ? $_POST[ 'moon-shop-page-banner-select' ] : 'default';
    update_post_meta( $post_id , 'moon-shop-page-banner-select' , esc_attr( $moon_shop_banner_select ) );

    // Banner image
    if( isset( $_POST[ 'moon-shop-banner-image' ] ) ) update_post_meta( $post_id , 'moon-shop-banner-image' , esc_url( $_POST[ 'moon-shop-banner-image' ] ) );

    // Banner overlay color
    if( isset( $_POST[ 'moon-shop-banner-overlay-color' ] ) ) update_post_meta( $post_id , 'moon-shop-banner-overlay-color' , esc_attr( $_POST[ 'moon-shop-banner-overlay-color' ] ) );

    // Banner opacity
    if( isset( $_POST[ 'moon-shop-banner-image-opacity' ] ) ) update_post_meta( $post_id , 'moon-shop-banner-image-opacity' , esc_attr( $_POST[ 'moon-shop-banner-image-opacity' ] ) );

    // Banner background color
    if( isset( $_POST[ 'moon-shop-banner-background-color' ] ) ) update_post_meta( $post_id , 'moon-shop-banner-background-color' , esc_attr( $_POST[ 'moon-shop-banner-background-color' ] ) );

    // banner height select
    if( isset( $_POST[ 'moon-shop-page-banner-height-select' ] ) ) update_post_meta( $post_id , 'moon-shop-page-banner-height-select' , esc_attr( $_POST[ 'moon-shop-page-banner-height-select' ] ) );

    // banner custom height
    if( isset( $_POST[ 'moon-shop-banner-custom-height' ] ) ) update_post_meta( $post_id , 'moon-shop-banner-custom-height' , esc_attr( $_POST[ 'moon-shop-banner-custom-height' ] ) );

    // set page layout
    if( isset( $_POST[ 'moon-shop-page-layout' ] ) ) update_post_meta( $post_id , 'moon-shop-page-layout' , esc_attr( $_POST[ 'moon-shop-page-layout' ] ) );

    // page sidebar to load
    if( isset( $_POST[ 'moon-shop-page-sidebar-load' ] ) ) update_post_meta( $post_id , 'moon-shop-page-sidebar-load' , esc_attr( $_POST[ 'moon-shop-page-sidebar-load' ] ) );
}