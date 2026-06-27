<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="text-gray-600 hover:text-primary-dark font-medium inline-flex items-center gap-1 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Back to shop
    </a>
    
    <h1 class="text-3xl font-bold text-primary-dark mt-4 mb-8">Shopping Cart</h1>

        <!-- Wrap everything in the form so coupon works anywhere -->
        <form class="woocommerce-cart-form w-full flex flex-col lg:flex-row gap-8 items-start" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            
            <!-- Left Column: Cart Items -->
            <div class="w-full lg:w-[60%] border border-gray-200 rounded-xl p-6 bg-white shadow-sm">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full" cellspacing="0">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th scope="col" class="product-name text-left pb-4 text-gray-700 font-semibold text-lg"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
                            <th scope="col" class="product-subtotal text-right pb-4 text-gray-700 font-semibold text-lg"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
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
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item border-b border-gray-100 last:border-0', $cart_item, $cart_item_key ) ); ?>">
                                    
                                    <td class="product-name py-6 align-top" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                                            <!-- Thumbnail -->
                                            <div class="product-thumbnail w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden flex items-center justify-center border border-gray-100">
                                                <?php
                                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_thumbnail', array('class' => 'max-w-full h-auto object-contain')), $cart_item, $cart_item_key );
                                                if ( ! $product_permalink ) {
                                                    echo $thumbnail;
                                                } else {
                                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
                                                }
                                                ?>
                                            </div>

                                            <!-- Details -->
                                            <div class="flex-grow flex flex-col justify-between">
                                                <div>
                                                    <h3 class="text-base sm:text-lg font-bold text-primary-dark leading-tight mb-1">
                                                        <?php
                                                        if ( ! $product_permalink ) {
                                                            echo wp_kses_post( $product_name );
                                                        } else {
                                                            echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="hover:text-primary-light transition-colors">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                        }
                                                        do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                                        echo wc_get_formatted_cart_item_data( $cart_item );
                                                        ?>
                                                    </h3>
                                                    <div class="product-price text-gray-700 text-sm sm:text-base mb-1">
                                                        <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                                    </div>
                                                    
                                                    <?php
                                                    $package_size = $_product->get_attribute('package-size') ?: $_product->get_attribute('quantity');
                                                    if ($package_size) {
                                                        echo '<div class="text-sm text-gray-600 mb-3">Quantity : ' . esc_html($package_size) . '</div>';
                                                    }
                                                    ?>
                                                </div>

                                                <!-- Actions: Qty & Remove -->
                                                <div class="flex items-center gap-3 mt-2">
                                                    <div class="product-quantity cart-qty-wrapper">
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
                                                    </div>
                                                    <div class="product-remove">
                                                        <?php
                                                            echo apply_filters( 
                                                                'woocommerce_cart_item_remove_link',
                                                                sprintf(
                                                                    '<a href="%s" class="remove text-red-500 hover:text-red-700 p-1 flex items-center justify-center transition-colors" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></a>',
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
                                        </div>
                                    </td>

                                    <td class="product-subtotal py-6 align-top text-right font-bold text-lg text-gray-900" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>">
                                        <?php
                                            echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>

                        <tr>
                            <td colspan="2" class="actions pt-6">
                                <div class="flex flex-col sm:flex-row items-center justify-end gap-4">
                                    <button type="submit" class="button bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium px-4 h-10 rounded-md transition-colors text-sm w-full sm:w-auto" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                                </div>
                                <?php do_action( 'woocommerce_cart_actions' ); ?>
                                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                            </td>
                        </tr>

                        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </div>

            <!-- Right Column: Cart Totals -->
            <div class="w-full lg:w-[40%]">
                <div class="cart-collaterals border border-gray-200 rounded-xl p-6 bg-white shadow-sm">
                    <?php
                        remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
                        do_action( 'woocommerce_cart_collaterals' );
                    ?>
                </div>
                
                <?php 
                // Output cross sells outside the totals box if they exist
                woocommerce_cross_sell_display(); 
                ?>
            </div>

        </form>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
