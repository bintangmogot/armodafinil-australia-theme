<?php
/**
 * Checkout Form
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<div class="checkout-page max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-sm text-gray-500 hover:text-primary-dark inline-flex items-center gap-1 mb-2">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to shop
    </a>
    <h1 class="text-2xl font-bold text-primary-dark mb-6">Checkout</h1>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

        <?php if ( $checkout->get_checkout_fields() ) : ?>

            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="flex flex-col lg:flex-row gap-6 items-start" id="customer_details">
                <!-- LEFT column: Billing + Shipping -->
                <div class="w-full lg:w-1/2 flex flex-col gap-6">
                    <div class="checkout-fields-block bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>
                    <div class="checkout-fields-block bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <!-- RIGHT column: Medical Conditions -->
                <div class="w-full lg:w-1/2 flex flex-col gap-6">
                    <div class="checkout-fields-block medical-condition-fields bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <?php do_action( 'armo_custom_checkout_medical_conditions' ); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

        <div class="mt-10">
            <h3 id="order_review_heading" class="text-2xl font-bold text-[#00104a] text-center mb-6"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>

            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>

            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>

    </form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
