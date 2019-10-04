<?php
//redux global variable
$moon_shop_optionsValue = get_option( 'moon_shop' );
//enqueue inline style css
$moon_shop_cols = '';
wp_enqueue_style( 'moon_shop_inline-style' , get_template_directory_uri() . '/assets/css/inline-style.css' );
$moon_shop_custom_inline_style = '';

$moon_shop_custom_inline_style .= '.mean-bar::after { content: "'.__('menu', 'moon-shop').'"; }';
$moon_shop_menu_bottom_border = isset( $moon_shop_optionsValue[ 'moon-shop-menu-hover-bottom-border-enable-disable' ] ) ? esc_attr( $moon_shop_optionsValue[ 'moon-shop-menu-hover-bottom-border-enable-disable' ] ) : '';

//header style
$moon_shop_header_style = isset( $moon_shop_optionsValue[ 'moon-shop-header-style' ] ) ? $moon_shop_optionsValue[ 'moon-shop-header-style' ] : '';

if( $moon_shop_menu_bottom_border == '0' ) {
    $moon_shop_custom_inline_style .= '.main-menu nav > ul > li > a::before { height: 0; }';
}

//menu bottom border before
$moon_shop_menu_bottom_border_before = isset( $moon_shop_optionsValue[ 'moon-shop-menu-spacing' ] ) ? $moon_shop_optionsValue[ 'moon-shop-menu-spacing' ][ 'padding-bottom' ] : '';

if( $moon_shop_menu_bottom_border_before != '' ) {
    $moon_shop_custom_inline_style .= '.main-menu nav > ul > li > a::before { bottom: '.$moon_shop_menu_bottom_border_before.'; }';
}

wp_add_inline_style( 'moon_shop_inline-style' , $moon_shop_custom_inline_style );
?>
<!-- Main Menu -->
<div class="main-menu pull-right <?php echo esc_attr( $moon_shop_cols ); ?>">
    <?php if( has_nav_menu( 'main-menu' ) ) { ?>
        <nav>
            <?php
            wp_nav_menu( array( 'theme_location' => 'main-menu' , 'container' => '' , 'menu_class' => '' , 'fallback_cb' => 'wp_page_menu' , 'walker' => new moon_shop_Walker() ) );
            ?>
        </nav>
    <?php } ?>
</div>