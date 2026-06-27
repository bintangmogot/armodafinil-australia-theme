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
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>" style="background: #fff; border: 1px solid #e0e0e0; border-radius: 10px; padding: 20px; width: 100% !important; float: none !important;">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h2 style="font-size: 20px; font-weight: 700; color: #333; margin: 0 0 16px 0; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb;"><?php esc_html_e( 'Carts Totals', 'woocommerce' ); ?></h2>

    <?php if ( wc_coupons_enabled() ) { ?>
        <div class="coupon" style="display: none; align-items: center; gap: 10px; margin-bottom: 20px;">
            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Discount voucher', 'woocommerce' ); ?>" style="flex: 1; height: 40px; padding: 0 16px; font-size: 14px; border: 1px solid #333; border-radius: 9999px; outline: none;" />
            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" style="background: #FFD700; color: #000; font-weight: 600; font-size: 14px; padding: 0 24px; height: 40px; border-radius: 9999px; border: 1px solid #333; cursor: pointer; white-space: nowrap;"><?php esc_html_e( 'Apply', 'woocommerce' ); ?></button>
            <?php do_action( 'woocommerce_cart_coupon' ); ?>
        </div>
    <?php } ?>

    <table cellspacing="0" class="shop_table shop_table_responsive" style="width: 100%; border-collapse: collapse;">

        <tr class="cart-subtotal">
            <th style="text-align: left; font-weight: 400; color: #1868C6; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            <td style="text-align: right; font-weight: 700; color: #111; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>"><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th style="text-align: left; font-weight: 400; color: #16a34a; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td style="text-align: right; color: #16a34a; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;" data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
            <?php wc_cart_totals_shipping_html(); ?>
            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>
            <tr class="shipping">
                <th style="text-align: left; font-weight: 400; color: #1868C6; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
                <td style="text-align: right; font-weight: 700; color: #111; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
            </tr>
        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <tr class="fee">
                <th style="text-align: left; font-weight: 400; color: #1868C6; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;"><?php echo esc_html( $fee->name ); ?></th>
                <td style="text-align: right; font-weight: 700; color: #111; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;" data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
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
                        <th style="text-align: left; font-weight: 400; color: #1868C6; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;"><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
                        <td style="text-align: right; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr class="tax-total">
                    <th style="text-align: left; font-weight: 400; color: #1868C6; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
                    <td style="text-align: right; padding: 10px 0; font-size: 14px; background: transparent !important; border: none !important;" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
                </tr>
                <?php
            }
        }
        ?>

        <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

        <tr class="order-total" style="border-top: 1px solid #e5e7eb;">
            <th style="text-align: left; font-weight: 800; color: #00125E; padding: 16px 0 8px; font-size: 16px; background: transparent !important; border: none !important;"><?php esc_html_e( 'Estimated total', 'woocommerce' ); ?></th>
            <td style="text-align: right; font-weight: 800; color: #111; padding: 16px 0 8px; font-size: 16px; background: transparent !important; border: none !important;" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>

    <div style="border-top: 1px solid #e5e7eb; padding-top: 20px; margin-top: 8px;">
        <div class="wc-proceed-to-checkout">
            <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward" style="display: block; width: 100%; text-align: center; background-color: #FF0000 !important; color: #fff !important; font-weight: 700; font-size: 16px; padding: 14px 0; border-radius: 8px; text-decoration: none; box-sizing: border-box;">
                <?php esc_html_e( 'Proceed to Checkout', 'woocommerce' ); ?>
            </a>
        </div>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
