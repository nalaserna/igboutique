<?php
/**
 * Single Product tabs
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs' , array() );

if( !empty( $tabs ) ) : ?>
<div class="pro-info-tab-container-2 fix">
    <ul class="pro-info-tab-list pro-info-tab-list-2">
        <?php $count = 0;
        foreach( $tabs as $key => $tab ) : ?>
            <li class="<?php echo ( $count == 0 ) ? 'active' : ''; ?> <?php echo esc_attr( $key ); ?>_tab">
                <a href="#tab-<?php echo esc_attr( $key ); ?>"
                   data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title' , esc_html( $tab[ 'title' ] ) , $key ); ?></a>
            </li>
            <?php $count++; endforeach; ?>
    </ul>
    <div class="pro-info-tab-container tab-content fix">
        <?php $count = 0;
        foreach( $tabs as $key => $tab ) : ?>
            <div id="tab-<?php echo esc_attr( $key ); ?>"
                 class="pro-info-tab tab-pane <?php echo ( $count == 0 ) ? 'active' : ''; ?>">
                <?php call_user_func( $tab[ 'callback' ] , $key , $tab ); ?>
            </div>
            <?php $count++; endforeach; ?>
    </div>
</div>
<?php endif; ?>
