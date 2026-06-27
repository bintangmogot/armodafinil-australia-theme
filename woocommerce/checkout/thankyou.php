<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 checkout-page-wrapper">

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
            
            <!-- Success Header -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full border-4 border-green-500 text-green-500 mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h1 class="text-3xl font-bold text-primary-dark mb-4">Order Confirmed!</h1>
                <p class="text-gray-600">Thank you for your order. Please complete your payment using EFT or PayID below.</p>
            </div>

            <!-- Payment Details Box -->
            <h3 class="text-lg font-bold text-gray-900 mb-4">Payment Details</h3>
            <div class="bg-[#e5f0f9] rounded-xl p-6 md:p-8 mb-8 border border-blue-100">
                
                <!-- PayID Section -->
                <div class="mb-6">
                    <div class="text-xs text-gray-500 mb-1">PayID</div>
                    <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm">
                        <div class="text-lg font-bold text-gray-900">0402 222 605</div>
                        <button class="copy-btn text-orange-500 hover:text-orange-600 font-medium text-sm flex items-center gap-1 transition-colors" data-copy="0402 222 605">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span>Copy</span>
                        </button>
                    </div>
                </div>

                <div class="border-t border-blue-200 my-6"></div>
                <div class="text-sm text-gray-600 mb-4">Or use bank transfer:</div>

                <!-- Bank Transfer Section -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <div class="text-xs text-gray-500 mb-1">Account Name</div>
                        <div class="font-bold text-primary-dark">Steven Waldberg</div>
                    </div>
                    <div class="text-right md:text-left">
                        <div class="text-xs text-gray-500 mb-1">Bank</div>
                        <div class="font-bold text-primary-dark">Commonwealth Bank</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <div class="text-xs text-gray-500 mb-1">Account Number</div>
                            <div class="text-lg font-bold text-gray-900">48880531</div>
                        </div>
                        <button class="copy-btn text-orange-500 hover:text-orange-600 font-medium text-sm flex items-center gap-1 transition-colors" data-copy="48880531">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span>Copy</span>
                        </button>
                    </div>

                    <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <div class="text-xs text-gray-500 mb-1">BSB</div>
                            <div class="text-lg font-bold text-gray-900">062 948</div>
                        </div>
                        <button class="copy-btn text-orange-500 hover:text-orange-600 font-medium text-sm flex items-center gap-1 transition-colors" data-copy="062 948">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span>Copy</span>
                        </button>
                    </div>

                    <div class="bg-white rounded-lg p-4 flex items-center justify-between shadow-sm border border-blue-100">
                        <div>
                            <div class="text-xs text-gray-500 mb-1">Amount to Send</div>
                            <div class="text-lg font-bold text-blue-600"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></div>
                        </div>
                        <button class="copy-btn text-orange-500 hover:text-orange-600 font-medium text-sm flex items-center gap-1 transition-colors" data-copy="<?php echo esc_attr( $order->get_total() ); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span>Copy</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Important Steps -->
            <div class="bg-[#fff5eb] border-l-4 border-orange-500 rounded-r-xl p-6 mb-8">
                <h4 class="font-bold text-orange-800 mb-2 text-sm">Important Steps:</h4>
                <ol class="list-decimal list-inside text-orange-900 text-sm space-y-1">
                    <li>Open your banking app</li>
                    <li>Choose Pay Anyone / Bank Transfer (EFT) or PayID</li>
                    <li>Enter the recipient details provided (Account Name / BSB & Account Number or PayID)</li>
                    <li>Send the exact amount</li>
                    <li>Use your order number as the payment reference</li>
                    <li>Email your payment confirmation once the transfer is complete</li>
                </ol>
            </div>

            <!-- After Payment -->
            <div class="bg-[#eafbf0] border-l-4 border-green-500 rounded-r-xl p-6 mb-12">
                <h4 class="font-bold text-green-800 mb-2 text-sm">After Payment:</h4>
                <p class="text-green-900 text-sm mb-2">Once we receive your payment confirmation, we will:</p>
                <ul class="list-disc list-inside text-green-900 text-sm space-y-1">
                    <li>Confirm receipt of payment</li>
                    <li>Process your order immediately</li>
                    <li>Send tracking information to your email</li>
                    <li>Ship your order within 24 hours</li>
                </ul>
            </div>

            <!-- Order Summary -->
            <h3 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h3>
            <div class="bg-[#f0f8ff] rounded-xl p-6 mb-8 border border-blue-100">
                <div class="flex justify-between items-center mb-2 text-sm text-gray-600">
                    <span>Order Number:</span>
                    <span class="font-bold text-blue-600"><?php echo $order->get_order_number(); ?></span>
                </div>
                <div class="flex justify-between items-center mb-2 text-sm text-gray-600">
                    <span>Date:</span>
                    <span class="font-bold text-blue-600"><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
                </div>
                <div class="flex justify-between items-center mb-4 text-sm text-gray-600 pb-4 border-b border-blue-200">
                    <span>Payment Method:</span>
                    <span class="font-bold text-blue-600"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
                </div>
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start text-sm">
                    <span class="text-gray-600 mb-2 sm:mb-0">Order Contains:</span>
                    <div class="text-right">
                        <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                            <div class="font-bold text-blue-600 mb-1">
                                <?php echo wp_kses_post( $item->get_name() ); ?> X <?php echo $item->get_quantity(); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Addresses & Totals -->
            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

            <div class="text-center mt-8">
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="inline-block w-full sm:w-auto bg-[#ff0000] hover:bg-red-700 text-white font-bold py-3 px-8 rounded-md shadow-md transition-all text-lg">
                    Continue Shopping
                </a>
            </div>

            <!-- Warning Notes -->
            <div class="mt-12 text-sm">
                <div class="flex items-start gap-2 mb-4">
                    <span class="text-yellow-500 font-bold">⚠️ Note</span>
                    <p class="text-primary-dark">The average shipping time is 15-22 days. Please note that delivery may take up to 30 days from the date of dispatch due to potential disruptions in postal services caused by weather issues or natural disaster.</p>
                </div>
                <p class="text-primary-dark font-medium"><span class="text-red-600 font-bold">DO NOT</span> mention anything related to <span class="text-red-600 font-bold">medicine</span> or <span class="text-red-600 font-bold">website</span> name. Just mention your order number.</p>
            </div>

            <!-- Bank Logos -->
            <div class="flex justify-center items-center gap-6 mt-8 flex-wrap">
                <img src="<?php echo get_template_directory_uri(); ?>/images/bank-logo.png" alt="Commonwealth Bank" class="h-10 object-contain" onerror="this.style.display='none'">
                <!-- You can upload the PayID and Osko logos to your images folder to show them here -->
            </div>

		<?php endif; ?>

	<?php else : ?>
		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>
	<?php endif; ?>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtns = document.querySelectorAll('.copy-btn');
    copyBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const textToCopy = this.getAttribute('data-copy');
            navigator.clipboard.writeText(textToCopy).then(() => {
                const span = this.querySelector('span');
                const originalText = span.innerText;
                span.innerText = 'Copied!';
                this.classList.add('text-green-500');
                setTimeout(() => {
                    span.innerText = originalText;
                    this.classList.remove('text-green-500');
                }, 2000);
            });
        });
    });
});
</script>
