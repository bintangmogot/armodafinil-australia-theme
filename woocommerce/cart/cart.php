<?php
/**
 * Cart Page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<style>
/* Cart page specific resets - prevent prose/checkout table styles from bleeding in */
.armo-cart-page table {
    background-color: transparent !important;
    border-collapse: collapse !important;
    border-spacing: 0 !important;
    box-shadow: none !important;
    border: none !important;
    outline: none !important;
}
.armo-cart-page thead {
    background-color: transparent !important;
}
.armo-cart-page thead th {
    background-color: transparent !important;
    color: #555 !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    padding: 0 0 12px 0 !important;
    border-bottom: 1px solid #e5e7eb !important;
    border-right: none !important;
    border-top: none !important;
    border-left: none !important;
}
.armo-cart-page tbody tr,
.armo-cart-page tbody td {
    background-color: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
    margin: 0 !important;
}
.armo-cart-page .shop_table::before,
.armo-cart-page .shop_table::after {
    display: none !important;
}
</style>

<div class="armo-cart-page max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-sm text-gray-500 hover:text-gray-700 inline-flex items-center gap-1 mb-3 no-underline">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to shop
    </a>
    <h1 style="font-size: 28px; font-weight: 800; color: #00125E; margin-bottom: 28px; line-height: 1.2;">Shopping Cart</h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div style="display: flex; flex-wrap: wrap; gap: 24px; align-items: flex-start;">

            <!-- LEFT: Product list -->
            <div style="flex: 1 1 0%; min-width: 0; background: #fff; border: 1px solid #e0e0e0; border-radius: 10px; padding: 20px;">
                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; font-size: 16px; font-weight: 600; color: #555; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb;" colspan="2"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th style="text-align: right; font-size: 16px; font-weight: 600; color: #555; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb;"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                            $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                ?>
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" style="border-bottom: 1px solid #e5e7eb;">

                                    <!-- Thumbnail + Info -->
                                    <td style="padding: 24px 0; vertical-align: top;" colspan="2" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                        <div style="display: flex; gap: 16px; align-items: flex-start;">
                                            <!-- Thumbnail -->
                                            <div style="flex-shrink: 0; width: 100px; border-radius: 6px; overflow: hidden; background: #fff;">
                                                <?php
                                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', array('class' => 'w-full h-auto', 'style' => 'display:block;width:100%;height:auto;')), $cart_item, $cart_item_key );
                                                if ( ! $product_permalink ) {
                                                    echo $thumbnail;
                                                } else {
                                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                                }
                                                ?>
                                            </div>

                                            <!-- Product Details -->
                                            <div style="flex: 1; min-width: 0;">
                                                <a href="<?php echo esc_url( $product_permalink ); ?>" style="font-weight: 700; color: #00125E; font-size: 15px; text-decoration: none; display: block; margin-bottom: 4px;">
                                                    <?php echo wp_kses_post( $_product->get_name() ); ?>
                                                </a>
                                                <?php
                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                                echo wc_get_formatted_cart_item_data( $cart_item );
                                                ?>
                                                <span style="display: block; font-size: 14px; color: #333; margin-bottom: 2px;"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
                                                <?php
                                                $package_size = $_product->get_attribute('package-size') ?: $_product->get_attribute('quantity');
                                                if ($package_size) {
                                                    echo '<span style="display: block; font-size: 13px; color: #666; margin-bottom: 8px;">Quantity : ' . esc_html($package_size) . '</span>';
                                                }
                                                ?>
                                                <div style="display: flex; align-items: center; gap: 6px; margin-top: 8px; transform: scale(0.85); transform-origin: left center;">
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $min_quantity = 1;
                                                        $max_quantity = 1;
                                                    } else {
                                                        $min_quantity = 0;
                                                        $max_quantity = $_product->get_max_purchase_quantity();
                                                    }
                                                    $product_quantity = woocommerce_quantity_input(
                                                        array(
                                                            'input_name'   => "cart[{$cart_item_key}][qty]",
                                                            'input_value'  => $cart_item['quantity'],
                                                            'max_value'    => $max_quantity,
                                                            'min_value'    => $min_quantity,
                                                            'product_name' => $product_name,
                                                        ),
                                                        $_product,
                                                        false
                                                    );
                                                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                                    ?>
                                                    <!-- Remove -->
                                                    <?php
                                                    echo apply_filters(
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" style="color: #FF0000; display: inline-flex;"><svg style="width:16px;height:16px;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14zM10 11v6M14 11v6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>',
                                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                            esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                            esc_attr( $product_id ),
                                                            esc_attr( $_product->get_sku() )
                                                        ),
                                                        $cart_item_key
                                                    );
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Subtotal -->
                                    <td style="text-align: right; font-weight: 700; color: #111; font-size: 15px; padding: 24px 0; vertical-align: top; white-space: nowrap;" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <tr>
                            <td colspan="3" class="actions" style="padding-top: 16px; text-align: right;">
                                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" style="background: #f3f4f6; color: #555; border: 1px solid #d1d5db; padding: 8px 16px; border-radius: 6px; font-size: 13px; cursor: pointer;"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                                <?php do_action( 'woocommerce_cart_actions' ); ?>
                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </td>
                        </tr>

                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </div>

            <!-- RIGHT: Cart Totals -->
            <div style="flex-shrink: 0; width: 360px;">
                <div class="cart-collaterals">
                    <?php
                        remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
                        do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
            </div>

        </div>
    </form>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
