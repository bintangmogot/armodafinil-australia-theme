<?php
/**
 * Thankyou page
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>

            <!-- Green checkmark + heading -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full border-4 border-green-500 text-green-500 mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h1 class="text-2xl font-bold text-primary-dark mb-2">Order Confirmed!</h1>
                <p class="text-sm text-gray-500">Thank you for your order. Please complete your payment using EFT or PayID below.</p>
            </div>

            <!-- Payment Details -->
            <h3 class="text-sm font-bold text-gray-900 mb-3">Payment Details</h3>
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 sm:p-6 mb-8">

                <!-- PayID -->
                <div class="mb-5">
                    <div class="text-xs text-gray-400 mb-1">PayID</div>
                    <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                        <span class="text-base font-bold text-gray-900">0402 222 605</span>
                        <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="0402 222 605">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span>Copy</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-blue-200 my-5"></div>
                <div class="text-xs text-gray-500 mb-4">Or use bank transfer:</div>

                <!-- Account Name / Bank -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <div class="text-xs text-gray-400 mb-0.5">Account Name</div>
                        <div class="font-bold text-sm text-primary-dark">Steven Waldberg</div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 mb-0.5">Bank</div>
                        <div class="font-bold text-sm text-primary-dark">Commonwealth Bank</div>
                    </div>
                </div>

                <!-- Account Number -->
                <div class="space-y-3">
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Account Number</div>
                        <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                            <span class="text-base font-bold text-gray-900">48880531</span>
                            <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="48880531">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span>Copy</span>
                            </button>
                        </div>
                    </div>

                    <!-- BSB -->
                    <div>
                        <div class="text-xs text-gray-400 mb-1">BSB</div>
                        <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                            <span class="text-base font-bold text-gray-900">062 948</span>
                            <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="062 948">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span>Copy</span>
                            </button>
                        </div>
                    </div>

                    <!-- Amount to Send -->
                    <div>
                        <div class="text-xs text-gray-400 mb-1">Amount to Send</div>
                        <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                            <span class="text-base font-bold text-blue-600"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
                            <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="<?php echo esc_attr( $order->get_total() ); ?>">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span>Copy</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Steps (orange) -->
            <div class="bg-orange-50 border border-orange-200 rounded-xl p-5 mb-6">
                <h4 class="font-bold text-orange-800 text-sm mb-2">Important Steps:</h4>
                <ol class="list-decimal list-inside text-orange-900 text-xs space-y-1 leading-relaxed">
                    <li>Open your banking app</li>
                    <li>Choose Pay Anyone / Bank Transfer (EFT) or PayID</li>
                    <li>Enter the recipient details provided (Account Name / BSB &amp; Account Number or PayID)</li>
                    <li>Send the exact amount</li>
                    <li>Use your order number as the payment reference</li>
                    <li>Email your payment confirmation once the transfer is complete</li>
                </ol>
            </div>

            <!-- After Payment (green) -->
            <div class="bg-green-50 border border-green-200 rounded-xl p-5 mb-10">
                <h4 class="font-bold text-green-800 text-sm mb-2">After Payment:</h4>
                <p class="text-green-900 text-xs mb-2">Once we receive your payment confirmation, we will:</p>
                <ul class="list-disc list-inside text-green-900 text-xs space-y-1 leading-relaxed">
                    <li>Confirm receipt of payment</li>
                    <li>Process your order immediately</li>
                    <li>Send tracking information to your email</li>
                    <li>Ship your order within 24 hours</li>
                </ul>
            </div>

            <!-- Order Summary -->
            <h3 class="text-sm font-bold text-gray-900 mb-3">Order Summary</h3>
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-8">
                <div class="flex justify-between items-center mb-2 text-xs text-gray-600">
                    <span>Order Number:</span>
                    <span class="font-bold text-blue-700"><?php echo $order->get_order_number(); ?></span>
                </div>
                <div class="flex justify-between items-center mb-2 text-xs text-gray-600">
                    <span>Date:</span>
                    <span class="font-bold text-blue-700"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
                </div>
                <div class="flex justify-between items-center mb-3 pb-3 border-b border-blue-200 text-xs text-gray-600">
                    <span>Payment Method:</span>
                    <span class="font-bold text-blue-700"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
                </div>
                <div class="text-xs text-gray-600">
                    <span>Order Contains:</span>
                    <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                        <div class="font-bold text-blue-700 mt-1">
                            <?php echo wp_kses_post( $item->get_name() ); ?> · Quantity : <?php echo esc_html( $item->get_quantity() ); ?>  X <?php echo esc_html( $item->get_quantity() ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Billing / Shipping Addresses -->
            <div class="flex flex-col sm:flex-row gap-8 mb-8 text-xs text-gray-700">
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Billing address</h4>
                    <?php echo wp_kses_post( $order->get_formatted_billing_address() ?: esc_html__( 'N/A', 'woocommerce' ) ); ?>
                    <?php if ( $order->get_billing_phone() ) : ?>
                        <br/><?php echo esc_html( $order->get_billing_phone() ); ?>
                    <?php endif; ?>
                    <?php if ( $order->get_billing_email() ) : ?>
                        <br/><?php echo esc_html( $order->get_billing_email() ); ?>
                    <?php endif; ?>
                </div>
                <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 mb-2 text-sm">Shipping address</h4>
                    <?php echo wp_kses_post( $order->get_formatted_shipping_address() ?: esc_html__( 'N/A', 'woocommerce' ) ); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Totals breakdown -->
            <div class="border-t border-gray-200 pt-4 mb-8">
                <table class="w-full text-sm">
                    <?php foreach ( $order->get_order_item_totals() as $key => $total ) : ?>
                        <tr class="<?php echo esc_attr( $key ); ?>">
                            <th class="text-left font-medium text-gray-600 py-1.5"><?php echo wp_kses_post( $total['label'] ); ?></th>
                            <td class="text-right font-bold text-gray-900 py-1.5"><?php echo wp_kses_post( $total['value'] ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Continue Shopping -->
            <div class="text-center mb-10">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-10 rounded-full transition-colors text-sm">
                    Continue Shopping
                </a>
            </div>

            <!-- Warning -->
            <div class="text-xs text-gray-600 space-y-3">
                <p><span class="text-yellow-500 font-bold">⚠ Note</span><br/>
                The average shipping time is 15-22 days. Please note that delivery may take up to 30 days from the date of dispatch due to potential disruptions in postal services caused by weather issues or natural disaster.</p>
                <p><span class="text-red-600 font-bold">DO NOT</span> mention anything related to <span class="text-red-600 font-bold">medicine</span> or <span class="text-red-600 font-bold">website</span> name. Just mention your order number.</p>
            </div>

            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

		<?php endif; ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.copy-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var text = this.getAttribute('data-copy');
            navigator.clipboard.writeText(text).then(function() {
                var span = btn.querySelector('span');
                var orig = span.innerText;
                span.innerText = 'Copied!';
                btn.classList.replace('text-orange-500', 'text-green-500');
                setTimeout(function() {
                    span.innerText = orig;
                    btn.classList.replace('text-green-500', 'text-orange-500');
                }, 2000);
            });
        });
    });
});
</script>
