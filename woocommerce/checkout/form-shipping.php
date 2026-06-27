<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shipping-section-wrapper border border-gray-300 rounded mb-8">
    <?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
        <div class="bg-[#1868C6] text-white px-4 py-3 rounded-t flex items-center gap-2">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M8 16a2 2 0 100-4 2 2 0 000 4zM14 16a2 2 0 100-4 2 2 0 000 4z" /><path d="M16 5h-3V4a1 1 0 00-1-1H3a1 1 0 00-1 1v10h1.27a3.001 3.001 0 015.46 0h2.54a3.001 3.001 0 015.46 0H18v-5l-2-4zm-2.4 1l1.5 3H13V6h.6z" /></svg>
            <h3 class="text-[17px] font-normal m-0 tracking-wide text-white">Ship to a different addresss</h3>
        </div>
    <?php endif; ?>

    <div class="p-6 bg-white <?php echo true === WC()->cart->needs_shipping_address() ? 'rounded-b' : 'rounded'; ?>">
        <div class="woocommerce-shipping-fields">
            <?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
                <div class="form-row mb-6">
                    <div id="ship-to-different-address">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center gap-2 cursor-pointer m-0">
                            <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox w-4 h-4 text-[#1868C6] focus:ring-[#1868C6] border-gray-300 rounded m-0 mt-0.5" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> 
                            <span class="text-[#0f4d92] text-[17px] select-none"><?php esc_html_e( 'Deliver to a different address?', 'woocommerce' ); ?></span>
                        </label>
                    </div>
                </div>

                <div class="shipping_address mt-4">
                    <?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>
                    <div class="woocommerce-shipping-fields__field-wrapper">
                        <?php
                        $fields = $checkout->get_checkout_fields( 'shipping' );
                        foreach ( $fields as $key => $field ) {
                            woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        }
                        ?>
                    </div>
                    <?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="woocommerce-additional-fields mt-6">
            <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

            <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>
                <?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>
                    <h3 class="text-base font-semibold text-gray-800 mb-4"><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>
                <?php endif; ?>

                <div class="woocommerce-additional-fields__field-wrapper">
                    <?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
        </div>
    </div>
</div>

