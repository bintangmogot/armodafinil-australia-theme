<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shipping-section-wrapper border border-gray-200 rounded-lg bg-white overflow-hidden">
    <div class="p-6 bg-white">
        <div class="woocommerce-shipping-fields">
            <?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
                <h3>Ship to a different address</h3>
                <div class="form-row mb-6">
                    <div id="ship-to-different-address">
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox flex items-center gap-2 cursor-pointer m-0">
                            <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox w-4 h-4 text-[#00125E] focus:ring-[#00125E] border-gray-300 rounded m-0 mt-0.5" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> 
                            <span class="text-[#00125E] font-bold text-[17px] select-none"><?php esc_html_e( 'Deliver to a different address?', 'woocommerce' ); ?></span>
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

