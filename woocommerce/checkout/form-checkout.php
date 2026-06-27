<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
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

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 checkout-page-wrapper">
    <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="text-gray-600 hover:text-primary-dark font-medium inline-flex items-center gap-1 transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        Back to shop
    </a>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

        <?php if ( $checkout->get_checkout_fields() ) : ?>

            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

            <div class="flex flex-col lg:flex-row gap-8 items-start" id="customer_details">
                <!-- Left Column -->
                <div class="w-full lg:w-1/2 flex flex-col gap-6">
                    <div class='checkout-fields-block bg-white border border-gray-300 rounded-md overflow-hidden'>
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>
                    <div class='checkout-fields-block bg-white border border-gray-300 rounded-md overflow-hidden'>
                        <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                    </div>
                </div>

                <!-- Right Column (Medical Conditions, etc.) -->
                <div class="w-full lg:w-1/2 flex flex-col gap-6">
                    <div class='checkout-fields-block medical-condition-fields bg-white border border-gray-300 rounded-md overflow-hidden'>
                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
        
        <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
        
        <div class="mt-12 max-w-4xl mx-auto">
            <h3 id="order_review_heading" class="text-2xl font-bold text-primary-dark text-center mb-6"><?php esc_html_e( 'Your Order', 'woocommerce' ); ?></h3>
            
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>
            
            <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        </div>

    </form>
</div>


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
