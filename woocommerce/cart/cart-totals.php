<?php
/**
 * Cart totals
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="cart_totals bg-white border border-gray-200 rounded-lg p-5 <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h2 class="text-base font-semibold text-gray-800 mb-4"><?php esc_html_e( 'Carts Totals', 'woocommerce' ); ?></h2>

    <?php if ( wc_coupons_enabled() ) { ?>
        <div class="coupon flex items-center gap-2 mb-5">
            <input type="text" name="coupon_code" class="input-text flex-1 h-9 px-3 text-sm border border-gray-300 rounded-full focus:outline-none focus:border-primary-dark" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Discount voucher', 'woocommerce' ); ?>" />
            <button type="submit" class="button bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold text-sm px-5 h-9 rounded-full transition-colors whitespace-nowrap" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
            <?php do_action( 'woocommerce_cart_coupon' ); ?>
        </div>
    <?php } ?>

    <table cellspacing="0" class="shop_table shop_table_responsive w-full text-sm">

        <tr class="cart-subtotal">
            <th class="text-left font-medium text-gray-600 py-2"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            <td class="text-right font-semibold text-gray-900 py-2" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th class="text-left font-medium text-green-600 py-2"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td class="text-right text-green-600 py-2" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
            <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
            <tr class="shipping">
                <th class="text-left font-medium text-gray-600 py-2"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
                <td class="text-right py-2" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
            </tr>
        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee">
                <th class="text-left font-medium text-gray-600 py-2"><?php echo esc_html( $fee->name ); ?></th>
                <td class="text-right py-2" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php
        if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
            $taxable_address = WC()->customer->get_taxable_address();
            $estimated_text  = '';
            if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
                $estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
            }
            if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
                foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
                    ?>
                    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th class="text-left font-medium text-gray-600 py-2"><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
                        <td class="text-right py-2" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr class="tax-total">
                    <th class="text-left font-medium text-gray-600 py-2"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
                    <td class="text-right py-2" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <tr class="order-total border-t border-gray-200">
            <th class="text-left font-bold text-gray-900 py-3"><?php esc_html_e( 'Estimated total', 'woocommerce' ); ?></th>
            <td class="text-right font-bold text-gray-900 py-3 text-base" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>

    <div class="wc-proceed-to-checkout mt-5">
        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward block w-full text-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-full transition-colors text-sm">
            <?php esc_html_e( 'Proceed to Checkout', 'woocommerce' ); ?>
        </a>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
