<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
    return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
    wc_get_template( 
        'order/order-downloads.php', 
        array( 
            'downloads' => $downloads, 
            'show_title' => true 
        ) 
    );
}
?>

<div class="col-md-6 col-xs-12">
    <div class="cart-page-title">
        <h2><?php esc_html_e( 'Detalles de la compra' , 'moon-shop' ); ?></h2>
    </div>
    <div class="table-responsive">
        <fieldset>
            <table class="shop_table order_details order-pro-table table">
                <thead>
                <tr>
                    <th class="product-name product text-left"><?php esc_html_e( 'Producto' , 'moon-shop' ); ?></th>
                    <th class="product-total total text-right"><?php esc_html_e( 'Total' , 'moon-shop' ); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach( $order->get_items() as $item_id => $item ) {
                        $product = $item->get_product();
                        wc_get_template( 
                            'order/order-details-item.php', 
                            array(
                                'order'              => $order,
                                'item_id'            => $item_id,
                                'item'               => $item,
                                'show_purchase_note' => $show_purchase_note,
                                'purchase_note'      => $product ? $product->get_purchase_note() : '',
                                'product'            => $product,
                            ) 
                        );
                    }
                    do_action( 'woocommerce_order_details_after_order_table_items', $order ); ?>
                </tbody>
                <tfoot>
                    <?php
                    foreach( $order->get_order_item_totals() as $key => $total ) {
                        if( $key == 'order_total' ) {
                            $total[ 'label' ] = __('Grand Total', 'moon-shop');
                            $wl_moon_class_td = 'grand-total text-right';
                            $wl_moon_class_tr = 'order-total';
                            $wl_moon_class_th = 'grand-total-title text-left';
                        }
                        if( $key == 'shipping' ) {
                            $wl_moon_class_tr = 'shipping';
                            $wl_moon_class_th = '';
                        }
                        if( $key == 'cart_subtotal' ) {
                            $wl_moon_class_tr = 'cart-subtotal';
                            $wl_moon_class_td = 'cart-total text-right';
                            $wl_moon_class_th = '';
                        } else {
                            $wl_moon_class_td = '';
                        }
                        ?>
                        <tr class="<?php echo esc_attr( $wl_moon_class_tr ); ?>">
                            <th scope="row" class="cart-total-title text-left <?php echo esc_attr( $wl_moon_class_th ); ?>"><?php echo esc_html($total[ 'label' ]); ?></th>
                            <td class="<?php echo esc_attr( $wl_moon_class_td ); ?>"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); ?></td>
                        </tr>
                        <?php if ( $order->get_customer_note() ) : ?>
                            <tr>
                                <th><?php esc_html_e( 'Note:', 'moon-shop' ); ?></th>
                                <td><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php } ?>
                </tfoot>
            </table>
        </fieldset>
    </div>
</div>

<?php do_action( 'woocommerce_order_details_after_order_table' , $order ); ?>

<div class="col-md-6 col-xs-12">
    <?php if( $show_customer_details ) : ?>
        <?php wc_get_template( 
            'order/order-details-customer.php' , 
            array( 
                'order' => $order 
            ) 
        ); ?>
    <?php endif; ?>
</div>