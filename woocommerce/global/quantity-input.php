<?php
/**
 * Product quantity inputs
 *
 * This template overrides the default WooCommerce quantity input.
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );

// Hide the quantity box and output a hidden input if min == max (e.g. max 1 buy)
// Hide the quantity box and output a hidden input if min == max (e.g. max 1 buy)
if ( $max_value && $min_value == $max_value ) {
	?>
	<div class="quantity hidden" style="display:none !important;">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
	return;
}


?>
<div class="quantity flex items-center justify-start border border-gray-300 rounded-md overflow-hidden bg-white w-fit h-[46px] mb-4">
	<?php
	/**
	 * Hook to output something before the quantity input field.
	 *
	 * @since 7.2.0
	 */
	do_action( 'woocommerce_before_quantity_input_field' );
	?>
    
    <!-- Custom Minus Button -->
    <button type="button" class="qty-btn minus w-10 h-full bg-gray-100 text-gray-600 hover:bg-gray-200 border-r border-gray-300 flex items-center justify-center font-bold transition-colors cursor-pointer">-</button>

	<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
	<input
		type="number"
		<?php echo $readonly ? 'readonly="readonly"' : ''; ?>
		id="<?php echo esc_attr( $input_id ); ?>"
		class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?> qty w-14 text-center border-none py-2 h-full m-0 focus:outline-none focus:ring-0 appearance-none bg-transparent"
		name="<?php echo esc_attr( $input_name ); ?>"
		value="<?php echo esc_attr( $input_value ); ?>"
		aria-label="<?php echo esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
		size="4"
		min="<?php echo esc_attr( $min_value ); ?>"
		max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
		<?php if ( ! $readonly ) : ?>
			step="<?php echo esc_attr( $step ); ?>"
			placeholder="<?php echo esc_attr( $placeholder ); ?>"
			inputmode="<?php echo esc_attr( $inputmode ); ?>"
			autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
		<?php endif; ?>
	/>

    <!-- Custom Plus Button -->
    <button type="button" class="qty-btn plus w-10 h-full bg-gray-100 text-gray-600 hover:bg-gray-200 border-l border-gray-300 flex items-center justify-center font-bold transition-colors cursor-pointer">+</button>

	<?php
	/**
	 * Hook to output something after the quantity input field.
	 *
	 * @since 3.6.0
	 */
	do_action( 'woocommerce_after_quantity_input_field' );
	?>
</div>
