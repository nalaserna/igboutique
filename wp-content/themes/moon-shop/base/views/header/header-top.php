<?php
//Redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
//search icon position
$moon_shop_search_icon_position = isset( $moon_shop_optionsValue[ 'moon-shop-header-search-icon-position' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-header-search-icon-position' ] ) : '';
//custom text
$moon_shop_custom_txt = isset( $moon_shop_optionsValue[ 'moon-shop-top-bar-custom-text' ] ) ? $moon_shop_optionsValue[ 'moon-shop-top-bar-custom-text' ] : '';
//phone number
$moon_shop_phone = isset( $moon_shop_optionsValue[ 'moon-shop-top-bar-contact-info-phone' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-top-bar-contact-info-phone' ] ) : '';
//email
$moon_shop_email = isset( $moon_shop_optionsValue[ 'moon-shop-top-bar-contact-info-email' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-top-bar-contact-info-email' ] ) : '';
//language currency
$moon_shop_LC = isset( $moon_shop_optionsValue[ 'moon-shop-top-bar-lan_currency' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-top-bar-lan_currency' ] ) : '';

if( ($moon_shop_LC == 'right-side' || $moon_shop_LC == '' || $moon_shop_LC == 'none') && ( is_active_sidebar('top_widget') && function_exists('icl_object_id') ) ) {
    $moon_shop_left_cols = 'col-sm-5';
    $moon_shop_right_cols = 'col-sm-5';
} else if($moon_shop_LC == 'left-side' && ( is_active_sidebar('top_widget') && function_exists('icl_object_id') )) {
    $moon_shop_left_cols = 'col-sm-7';
    $moon_shop_right_cols = 'col-sm-3';
} else if( $moon_shop_LC == 'right-side' || $moon_shop_LC == '' || $moon_shop_LC == 'none' ) {
    $moon_shop_left_cols = 'col-sm-6';
    $moon_shop_right_cols = 'col-sm-6';
} else if( $moon_shop_LC == 'left-side' ) {
    $moon_shop_left_cols = 'col-sm-9';
    $moon_shop_right_cols = 'col-sm-3';
}
$moon_shop_search_iconED = isset( $moon_shop_optionsValue[ 'moon-shop-search-icon-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-search-icon-enable-disable' ] ) : '';
$moon_shop_login_registerED = isset( $moon_shop_optionsValue[ 'moon-shop-login-register-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-login-register-enable-disable' ] ) : '';
?>
<!-- Header Top -->
<div class="header-top moon-find-cart">
    <div class="container">
        <div class="row">
            <!-- Header Top Left -->
            <div class="header-top-left <?php echo esc_attr( $moon_shop_left_cols ); ?>">
                <div class="header-contact-info">
                    <ul class="header-contact-info">
                        <?php if( $moon_shop_custom_txt != '' ) { ?>
                            <li><?php echo ( $moon_shop_custom_txt ); ?></li>
                        <?php }
                        if( $moon_shop_phone != '' ) { ?>
                            <li><a href="callto:<?php echo esc_attr( $moon_shop_phone ); ?>"><i class="fa fa-phone"></i><?php echo esc_attr( $moon_shop_phone ); ?></a></li>
                        <?php }
                        if( $moon_shop_email != '' ) { ?>
                            <li><a href="mailto:<?php echo esc_attr( $moon_shop_email ); ?>"><i class="fa fa-envelope"></i><?php echo esc_attr( $moon_shop_email ); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php
            if (is_active_sidebar('top_widget')) {
                echo '<div class="col-sm-2">';
                dynamic_sidebar('top_widget');
                echo '</div>';
            }
            ?>
            <!-- Header Top Right -->
            <div class="<?php echo esc_attr( $moon_shop_right_cols ); ?>">
                <!--Cart and Search-->
                <div class="header-top-cart pull-right">
                    <!-- Header Search -->
                    <?php if( $moon_shop_search_iconED == '1' ) {
                        if( $moon_shop_search_icon_position == 'top-bar' ) {
                            ?>
                            <!-- Header Search -->
                            <div class="header-search <?php echo esc_attr( $moon_shop_search ); ?>">
                                <button class="search-btn search-open"><i class="fa fa-search"></i></button>
                            </div>
                        <?php }
                    } ?>
                </div>

                <div class="header-top-right header-contact-info pull-right">
                    <?php
                    if( has_nav_menu( 'top-menu' ) ) {
                        wp_nav_menu( array( 
							'theme_location' 	=> 'top-menu' , 
							'container' 		=> '' , 
							'menu_class' 		=> 'language-currency',
							'depth'				=> 1,
						) );
                    }
                    ?>
                    <?php if( $moon_shop_login_registerED != '0' ) { ?>
                        <ul class="language-currency">
                            <?php if( !is_user_logged_in() ) { ?>
                                <li><a href="<?php if( function_exists( 'is_shop' ) ) {
                                        echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) );
                                    } ?>"><?php esc_html_e( 'Log in / Register' , 'moon-shop' ); ?></a></li>
                            <?php } else { ?>
                                <li><a href="<?php if( function_exists( 'is_shop' ) ) {
                                        echo esc_url( wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) );
                                    } ?>"><?php esc_html_e( 'Logout' , 'moon-shop' ); ?></a></li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>