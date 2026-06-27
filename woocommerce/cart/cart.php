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
    color: #00125E !important;
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
/* Gap above first product */
.armo-cart-page table.woocommerce-cart-form__contents tbody tr:first-child td {
    padding-top: 20px !important;
}
/* Variation formatting */
.armo-cart-page .armo-cart-item-variation dl.variation {
    display: flex;
    flex-wrap: wrap;
    align-items: baseline;
    font-size: 14px !important;
    color: #00125E !important;
    margin: 0 0 6px 0 !important;
    padding: 0 !important;
}
.armo-cart-page .armo-cart-item-variation dl.variation dt {
    font-weight: 400 !important;
    margin: 0 4px 0 0 !important;
    padding: 0 !important;
    clear: none !important;
}
.armo-cart-page img {
    margin: 0 !important;
    padding: 0 !important;
}
.armo-cart-page .armo-cart-item-variation dl.variation dd {
    margin: 0 8px 0 0 !important;
    padding: 0 !important;
}
.armo-cart-page .armo-cart-item-variation dl.variation p {
    margin: 0 !important;
    display: inline !important;
}
/* Quantity box sizing */
.armo-cart-page .quantity {
    height: 28px !important;
}
.armo-cart-page .quantity input.qty {
    height: 28px !important;
    font-size: 14px !important;
}
.armo-cart-page .quantity .qty-btn {
    width: 24px !important;
    height: 28px !important;
}

/* Trash icon */
.armo-cart-page a.remove {
    display: flex !important;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 4px;
    color: #111 !important;
    transition: all 0.2s ease;
}
.armo-cart-page a.remove:hover {
    background-color: #fee2e2 !important;
    color: #dc2626 !important;
}
.armo-cart-page a.remove svg {
    width: 18px;
    height: 18px;
}

/* Button hovers */
.armo-cart-page .checkout-button,
.armo-cart-page .coupon button {
    transition: opacity 0.2s ease !important;
}
.armo-cart-page .checkout-button:hover,
.armo-cart-page .coupon button:hover {
    opacity: 0.8 !important;
}
/* Quantity box sizing */
.armo-cart-page .quantity {
    height: 28px !important;
    width: auto !important;
    min-width: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    margin: 0 !important;
}
.armo-cart-page .quantity input.qty {
    height: 28px !important;
    width: 40px !important;
    font-size: 14px !important;
    padding: 0 !important;
    margin: 0 !important;
}
.armo-cart-page .quantity .qty-btn {
    width: 28px !important;
    height: 28px !important;
    font-size: 14px !important;
    padding: 0 !important;
    margin: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 1 !important;
}

/* Trash icon */
.armo-cart-page a.remove {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 28px !important;
    height: 28px !important;
    border-radius: 4px !important;
    color: #dc2626 !important;
    padding: 0 !important;
    margin: 0 !important;
    border: none !important;
    box-sizing: border-box !important;
    text-decoration: none !important;
    transition: all 0.2s ease;
}
.armo-cart-page a.remove:hover {
    background-color: #fee2e2 !important;
    color: #dc2626 !important;
}
.armo-cart-page a.remove svg {
    width: 18px !important;
    height: 18px !important;
    display: block !important;
    margin: 0 auto !important;
}

/* Button hovers */
.armo-cart-page .checkout-button,
.armo-cart-page .coupon button {
    transition: background-color 0.2s ease !important;
}
.armo-cart-page .checkout-button:hover {
    background-color: #dc0000 !important;
}
.armo-cart-page .coupon button:hover {
    background-color: #e6c200 !important;
}

/* Mobile Responsive Fixes */
@media (max-width: 768px) {
    /* Stack the main cart grid */
    .armo-cart-page > form > div[style*="display: flex"] {
        flex-direction: column !important;
    }
    .armo-cart-page > form > div[style*="display: flex"] > div {
        width: 100% !important;
        flex: none !important;
    }
    .armo-cart-page .armo-cart-box {
        padding: 12px !important;
    }
    .armo-cart-page .armo-cart-grid {
        gap: 16px !important;
    }
    
    /* Keep product table intact, just scale down the thumbnail to fit mobile */
    .armo-cart-page .armo-product-thumb {
        width: 70px !important;
    }
    
    .armo-cart-page table.cart tbody td {
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }
    
    /* Fix Cart Totals Table */
    .armo-cart-page .cart_totals table {
        display: table !important;
        width: 100% !important;
    }
    .armo-cart-page .cart_totals table tbody,
    .armo-cart-page .cart_totals table tr {
        display: table-row !important;
    }
    .armo-cart-page .cart_totals table th,
    .armo-cart-page .cart_totals table td {
        display: table-cell !important;
    }
    .armo-cart-page .cart_totals table td::before {
        display: none !important;
    }
}

/* Shipping row stacking */
.armo-cart-page tr.shipping {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    width: 100% !important;
}
.armo-cart-page tr.shipping th,
.armo-cart-page tr.shipping td {
    display: block !important;
    width: 100% !important;
    text-align: left !important;
    padding: 8px 0 !important;
}
/* Erase yellow check (likely a prose list marker/before element) */
.armo-cart-page ul#shipping_method li::before,
.armo-cart-page ul#shipping_method li::marker {
    display: none !important;
    content: none !important;
}
/* Modern Radio Buttons */
.armo-cart-page input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    background-color: #fff;
    margin: 0;
    color: currentColor;
    width: 18px !important;
    height: 18px !important;
    border: 2px solid #ccc !important;
    border-radius: 50% !important;
    display: grid;
    place-content: center;
    cursor: pointer;
    flex-shrink: 0;
}
.armo-cart-page input[type="radio"]::before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    transform: scale(0);
    transition: 120ms transform ease-in-out;
    box-shadow: inset 1em 1em #00125E;
}
.armo-cart-page input[type="radio"]:checked::before {
    transform: scale(1);
}
.armo-cart-page input[type="radio"]:checked {
    border-color: #00125E !important;
}
/* Make shipping method options look like clickable blocks */
.armo-cart-page ul#shipping_method li {
    padding: 12px !important;
    background: #f8fafc !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 8px !important;
    margin-bottom: 8px !important;
    cursor: pointer;
    transition: border-color 0.2s;
}
.armo-cart-page ul#shipping_method li:hover {
    border-color: #cbd5e1 !important;
}
</style>

<div class="armo-cart-page" style="width: 100%; max-width: 1280px; margin: 0 auto; padding-left: 16px; padding-right: 16px; padding-top: 32px; padding-bottom: 32px;">
    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-sm text-gray-500 hover:text-gray-700 inline-flex items-center gap-1 mb-3 no-underline">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to shop
    </a>
    <h1 style="font-size: 28px; font-weight: 800; color: #00125E; margin-bottom: 28px; line-height: 1.2;">Shopping Cart</h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div class="armo-cart-grid" style="display: flex; flex-wrap: wrap; gap: 24px; align-items: flex-start;">

            <!-- LEFT: Product list -->
            <div class="armo-cart-box" style="flex: 2; min-width: 0; background: #fff; border: 1px solid #e0e0e0; border-radius: 10px; padding: 24px;">
                <table class="shop_table cart woocommerce-cart-form__contents" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="width: 85%; text-align: left; font-size: 16px; font-weight: 600; color: #555; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb;" colspan="2"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th style="width: 15%; text-align: right; font-size: 16px; font-weight: 600; color: #555; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb;"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
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
                                            <div class="armo-product-thumb" style="flex-shrink: 0; width: 100px; border-radius: 6px; overflow: hidden; background: #fff;">
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
                                                <?php if ( $_product->get_short_description() ) : ?>
                                                    <div style="font-size: 13px; color: #666; margin-bottom: 4px;">
                                                        <?php echo wp_kses_post( $_product->get_short_description() ); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span style="display: block; font-size: 14px; color: #111; margin-bottom: 8px;"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
                                                
                                                <div class="armo-cart-item-variation">
                                                    <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                                </div>
                                                <div style="display: flex; align-items: center; gap: 12px; margin-top: 8px;">
                                                    <?php
                                                    if ( $_product->is_sold_individually() ) {
                                                        $min_quantity = 1;
                                                        $max_quantity = 1;
                                                        echo '<span style="font-size: 14px; font-weight: 500; color: #555; padding: 0 12px 0 0;">Qty: 1</span>';
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
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m3 0v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6h14zM10 11v6M14 11v6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>',
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

                        <tr style="display: none !important;">
                            <td colspan="3" class="actions" style="padding: 0 !important; margin: 0 !important;">
                                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>" style="display: none !important;"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
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
            <div style="flex: 1; min-width: 320px; max-width: 480px;">
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
