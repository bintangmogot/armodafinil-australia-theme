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
                <h1 class="text-2xl font-bold text-primary-dark mb-2"><?php echo esc_html( armo_ck( 'ck_title' ) ); ?></h1>
                <?php if ( armo_ck( 'ck_intro' ) ) : ?><p class="text-sm text-gray-500"><?php echo esc_html( armo_ck( 'ck_intro' ) ); ?></p><?php endif; ?>
            </div>

            <?php
            $account_name  = armo_ck( 'ck_account_name' );
            $account_num   = armo_ck( 'ck_account_number' );
            $bank_name     = armo_ck( 'ck_bank_name' );
            $bsb_code      = armo_ck( 'ck_bsb' );
            $pay_id        = armo_ck( 'ck_payid' );
            $copy_label    = armo_ck( 'ck_copy_label' );
            $copied_label  = armo_ck( 'ck_copied_label' );
            ?>
            <!-- Payment Details -->
            <h3 class="text-sm font-bold text-gray-900 mb-3"><?php echo esc_html( armo_ck( 'ck_label_payment_details' ) ); ?></h3>
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 sm:p-6 mb-8">

                <?php if ( $pay_id ) : ?>
                <!-- PayID -->
                <div class="mb-5">
                    <div class="text-xs text-gray-400 mb-1"><?php echo esc_html( armo_ck( 'ck_label_payid' ) ); ?></div>
                    <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                        <span class="text-base font-bold text-gray-900"><?php echo esc_html( $pay_id ); ?></span>
                        <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="<?php echo esc_attr( $pay_id ); ?>">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span><?php echo esc_html( $copy_label ); ?></span>
                        </button>
                    </div>
                </div>
                <div class="border-t border-blue-200 my-5"></div>
                <?php endif; ?>
                <?php if ( armo_ck( 'ck_label_or_transfer' ) ) : ?><div class="text-xs text-gray-500 mb-4"><?php echo esc_html( armo_ck( 'ck_label_or_transfer' ) ); ?></div><?php endif; ?>

                <!-- Account Name / Bank -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <div class="text-xs text-gray-400 mb-0.5"><?php echo esc_html( armo_ck( 'ck_label_account_name' ) ); ?></div>
                        <div class="font-bold text-sm text-primary-dark"><?php echo esc_html( $account_name ); ?></div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-400 mb-0.5"><?php echo esc_html( armo_ck( 'ck_label_bank' ) ); ?></div>
                        <div class="font-bold text-sm text-primary-dark"><?php echo esc_html( $bank_name ); ?></div>
                    </div>
                </div>

                <!-- Account Number -->
                <div class="space-y-3">
                    <div>
                        <div class="text-xs text-gray-400 mb-1"><?php echo esc_html( armo_ck( 'ck_label_account_number' ) ); ?></div>
                        <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                            <span class="text-base font-bold text-gray-900"><?php echo esc_html( $account_num ); ?></span>
                            <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="<?php echo esc_attr( $account_num ); ?>">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span><?php echo esc_html( $copy_label ); ?></span>
                            </button>
                        </div>
                    </div>

                    <!-- BSB -->
                    <div>
                        <div class="text-xs text-gray-400 mb-1"><?php echo esc_html( armo_ck( 'ck_label_bsb' ) ); ?></div>
                        <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                            <span class="text-base font-bold text-gray-900"><?php echo esc_html( $bsb_code ); ?></span>
                            <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="<?php echo esc_attr( $bsb_code ); ?>">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span><?php echo esc_html( $copy_label ); ?></span>
                            </button>
                        </div>
                    </div>

                    <!-- Amount to Send -->
                    <div>
                        <div class="text-xs text-gray-400 mb-1"><?php echo esc_html( armo_ck( 'ck_label_amount' ) ); ?></div>
                        <div class="bg-white rounded-lg px-4 py-3 flex items-center justify-between shadow-sm">
                            <span class="text-base font-bold text-blue-600"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></span>
                            <button type="button" class="copy-btn text-orange-500 hover:text-orange-600 text-xs font-semibold flex items-center gap-1 transition-colors" data-copy="<?php echo esc_attr( $order->get_total() ); ?>">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span><?php echo esc_html( $copy_label ); ?></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Order Summary -->
            <h3 class="text-sm font-bold text-gray-900 mb-3"><?php echo esc_html( armo_ck( 'ck_label_summary' ) ); ?></h3>
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-8">
                <div class="flex justify-between items-center mb-2 text-xs text-gray-600">
                    <span><?php echo esc_html( armo_ck( 'ck_label_order' ) ); ?></span>
                    <span class="font-bold text-blue-700"><?php echo $order->get_order_number(); ?></span>
                </div>
                <div class="flex justify-between items-center mb-2 text-xs text-gray-600">
                    <span><?php echo esc_html( armo_ck( 'ck_label_date' ) ); ?></span>
                    <span class="font-bold text-blue-700"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
                </div>
                <div class="flex justify-between items-start mb-3 pb-3 border-b border-blue-200 text-xs text-gray-600">
                    <span><?php echo esc_html( armo_ck( 'ck_label_method' ) ); ?></span>
                    <span class="font-bold text-blue-700 text-right"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start text-xs text-gray-600">
                    <span class="mb-1 sm:mb-0">
                    <?php echo esc_html( armo_ck( 'ck_label_contains' ) ); ?></span>
                    <div class="sm:text-right">
                        <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                            <div class="font-bold text-blue-700 mt-1 sm:mt-0">
                                <?php echo wp_kses_post( $item->get_name() ); ?> · Quantity : <?php echo esc_html( $item->get_quantity() ); ?>  X <?php echo esc_html( $item->get_quantity() ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Billing / Shipping Addresses -->
            <div class="flex flex-col sm:flex-row justify-between gap-8 mb-6 text-sm text-gray-700">
                <div class="flex-1">
                    <h4 class="font-bold text-gray-900 mb-2 text-base"><?php echo esc_html( armo_ck( 'ck_label_billing' ) ); ?></h4>
                    <div class="leading-relaxed">
                        <?php echo wp_kses_post( $order->get_formatted_billing_address() ?: esc_html__( 'N/A', 'woocommerce' ) ); ?>
                        <?php if ( $order->get_billing_phone() ) : ?>
                            <br/><?php echo esc_html( $order->get_billing_phone() ); ?>
                        <?php endif; ?>
                        <?php if ( $order->get_billing_email() ) : ?>
                            <br/><?php echo esc_html( $order->get_billing_email() ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
                <div class="flex-1 sm:text-right">
                    <h4 class="font-bold text-gray-900 mb-2 text-base"><?php echo esc_html( armo_ck( 'ck_label_shipping' ) ); ?></h4>
                    <div class="leading-relaxed">
                        <?php echo wp_kses_post( $order->get_formatted_shipping_address() ?: esc_html__( 'N/A', 'woocommerce' ) ); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Divider -->
            <hr class="border-gray-300 mb-6">

            <!-- Totals breakdown -->
            <div class="mb-6">
                <table class="w-full text-base">
                    <?php 
                    $order_totals = $order->get_order_item_totals();
                    foreach ( $order_totals as $key => $total ) : 
                        if ( $key === 'order_total' ) continue;
                        $label = wp_strip_all_tags( $total['label'] );
                        $label = rtrim( $label, ':' );
                        
                        $value = $total['value'];
                        $extra_text = '';
                        if ( $key === 'shipping' ) {
                            if ( strpos( $value, '<small' ) !== false ) {
                                $parts = explode( '<small', $value, 2 );
                                $value = $parts[0];
                                $extra_text = wp_strip_all_tags( '<small' . $parts[1] );
                            } elseif ( strpos( $value, '&nbsp;via ' ) !== false ) {
                                $parts = explode( '&nbsp;via ', $value, 2 );
                                $value = $parts[0];
                                $extra_text = 'via ' . wp_strip_all_tags( $parts[1] );
                            } elseif ( strpos( $value, ' via ' ) !== false ) {
                                $parts = explode( ' via ', $value, 2 );
                                $value = $parts[0];
                                $extra_text = 'via ' . wp_strip_all_tags( $parts[1] );
                            }
                        }
                    ?>
                        <tr class="<?php echo esc_attr( $key ); ?>">
                            <td class="text-left text-gray-700 py-2 align-top">
                                <?php echo esc_html( $label ); ?>
                                <?php if ( $extra_text ) : ?>
                                    <div class="text-xs text-gray-500 mt-0.5"><?php echo esc_html( $extra_text ); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="text-right font-bold text-gray-900 py-2 align-top"><?php echo wp_kses_post( $value ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <!-- Divider -->
            <hr class="border-gray-300 mb-6">

            <!-- Total Due -->
            <?php if ( isset( $order_totals['order_total'] ) ) : ?>
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-lg font-bold text-gray-900"><?php echo esc_html( armo_ck( 'ck_label_total_due' ) ); ?></h3>
                <div class="text-2xl font-bold text-blue-600">
                    <?php echo wp_kses_post( $order_totals['order_total']['value'] ); ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Continue Shopping -->
            <div class="text-center mb-10">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-10 rounded-xl transition-colors text-base text-center shadow-sm">
                    <?php echo esc_html( armo_ck( 'ck_shop_button' ) ); ?>
                </a>
            </div>

            <!-- Warning -->
            <?php $note_ship = armo_ck( 'ck_note_shipping' ); $note_ref = armo_ck( 'ck_note_reference' ); ?>
            <?php if ( $note_ship || $note_ref ) : ?>
            <div class="text-sm text-blue-900 space-y-3 mb-10 mt-10">
                <?php if ( $note_ship ) : ?><p><span class="text-yellow-500 font-bold">&#9888; Note</span><br/><?php echo esc_html( $note_ship ); ?></p><?php endif; ?>
                <?php if ( $note_ref ) : ?><p><?php echo wp_kses( $note_ref, array( 'span' => array( 'class' => true ), 'strong' => array(), 'br' => array() ) ); ?></p><?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Payment Methods Images -->
            <div class="flex flex-wrap justify-center items-center gap-4 lg:gap-8 pb-10">
                <img src="<?php echo esc_url( armo_ck_logo_url( 'ck_logo_bank', 'commonwealth.png' ) ); ?>" alt="Commonwealth Bank" style="width:130px;height:44px;object-fit:contain;">
                <img src="<?php echo esc_url( armo_ck_logo_url( 'ck_logo_payid', 'pay-idi.png' ) ); ?>" alt="PayID" style="width:130px;height:44px;object-fit:contain;">
                <img src="<?php echo esc_url( armo_ck_logo_url( 'ck_logo_osko', 'osko-1.jpg' ) ); ?>" alt="Osko by BPAY" style="width:130px;height:44px;object-fit:contain;">
            </div>

            <div style="display:none;">
                <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
            </div>

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
                span.innerText = <?php echo wp_json_encode( $copied_label ?: 'Copied!' ); ?>;
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
