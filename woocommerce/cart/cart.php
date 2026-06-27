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

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-sm text-gray-500 hover:text-primary-dark inline-flex items-center gap-1 mb-2">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to shop
    </a>
    <h1 class="text-2xl font-bold text-primary-dark mb-6">Shopping Cart</h1>

    <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <!-- LEFT: Product list -->
            <div class="w-full lg:flex-1 bg-white border border-gray-200 rounded-lg overflow-hidden">
                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-left text-sm font-semibold text-gray-700 px-5 py-3 border-b border-gray-200" colspan="3"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th class="text-right text-sm font-semibold text-gray-700 px-5 py-3 border-b border-gray-200"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
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
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> border-b border-gray-100 last:border-0">

                                    <!-- Thumbnail -->
                                    <td class="product-thumbnail px-5 py-4 w-24">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', array('class' => 'w-20 h-auto rounded')), $cart_item, $cart_item_key );
                                        if ( ! $product_permalink ) {
                                            echo $thumbnail;
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                        }
                                        ?>
                                    </td>

                                    <!-- Name + Price + Qty + Qty controls -->
                                    <td class="product-name py-4" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>" colspan="2">
                                        <div class="flex flex-col gap-1">
                                            <a href="<?php echo esc_url( $product_permalink ); ?>" class="font-bold text-primary-dark text-sm hover:underline leading-tight">
                                                <?php echo wp_kses_post( $_product->get_name() ); ?>
                                            </a>
                                            <?php
                                            do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                            echo wc_get_formatted_cart_item_data( $cart_item );
                                            ?>
                                            <span class="text-sm text-gray-600"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
                                            <?php
                                            $package_size = $_product->get_attribute('package-size') ?: $_product->get_attribute('quantity');
                                            if ($package_size) {
                                                echo '<span class="text-xs text-gray-500">Quantity : ' . esc_html($package_size) . '</span>';
                                            }
                                            ?>
                                            <div class="flex items-center gap-2 mt-1">
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
                                                        '<a href="%s" class="remove text-red-500 hover:text-red-700 transition-colors" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></a>',
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
                                    </td>

                                    <!-- Subtotal -->
                                    <td class="product-subtotal text-right font-bold text-gray-900 text-sm px-5 py-4 align-top" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <tr>
                            <td colspan="4" class="actions px-5 py-4">
                                <button type="submit" class="button text-xs text-gray-500 hover:text-gray-700 float-right" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
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
            <div class="w-full lg:w-80 flex-shrink-0">
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
