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

<div class="woocommerce-order">

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
			<h1 class='order-received-title'>Congratulations, <?php echo $order->get_billing_first_name()?></h1>
			<?php //wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>
			<div class='row g-5'>
				<div class='col-md-6'>
					<div class='thankyou-order-review'>
						<div class='site-logo'><img src='<?php bloginfo('template_directory'); ?>/images/logo.png' alt='<?php bloginfo('name') ?>' title='<?php bloginfo('name') ?>'/></div>
						<price><?php echo $order->get_formatted_order_total();?></price>
						<div class='thankyou-order-review-details'>
							<li><label>Order Number:</label> <?php echo $order->get_order_number(); ?></li>
							<li><label>Date:</label> <?php echo wc_format_datetime( $order->get_date_created() );?></li>
							<li><label>Payment Method:</label> <?php echo wp_kses_post( $order->get_payment_method_title() ); ?></li>
						</div>
					</div>
					
				</div>
				<div class='col-md-6'>
					<div class='thankyou-note'>Thank you for your order. Please complete your payment using <span style='color:#FF3232;'>EFT</span> or <span style='color:#FF3232;'>PayID</span> below.</div>
					<div class="bacs-note">* Use the below BSB &amp; account details to make the transfer. Simply mention your order number in the comment section. <strong>DO NOT</strong> reference anything related to <strong>medicine</strong> or <strong>website</strong> name. Just mention your order number.</div>
					<div class='payment-instruction'>
						<div class='payment-instruction-row'>			
							<div class='payment-value'><label>PayID:</label><input id='payment-value-1' value='0402 222 605'></div><span class='btn-copy' data-id='1'>Copy <span class="copy-tooltip-text">Copied</span></span>
						</div>
						
						<p>Or use bank transfer:</p>
					</div>
					<div class='order-received-payment-details'>
						
						<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
					</div>
				</div>
			</div>
			

		<?php endif; ?>
		
		<div class='row reverse align-items-center'>
			<div class='col-md-6'>
				<img src='<?php bloginfo('template_directory'); ?>/images/bank-logo.png'/>
			</div>
			<div class='col-md-6'>
				<div class='thankyou-note-3'>* Once your payment is done, just send the transaction copy to <a href='mailto:orders@modafinilaustraliaxpress.com'>orders@modafinilaustraliaxpress.com</a> and we’ll ship your order immediately.</div>
			</div>
		</div>
		
		<div class='thankyou-note-4'>
			<header>Note</header>
			<p>The average shipping time is 10 - 15 days. Please note that delivery may take up to 30 days from the date of dispatch due to potential disruptions in postal services caused by weather issues or natural disaster.</p>
		</div>

		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>

</div>
