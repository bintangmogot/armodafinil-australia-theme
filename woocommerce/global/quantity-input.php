<?php
/**
 * Product quantity inputs
 *
 * This template overrides the default WooCommerce quantity input to ALWAYS be hidden,
 * because the user handles quantity via Variation Dropdowns instead of standard WooCommerce quantity.
 */

defined( 'ABSPATH' ) || exit;

// We always force quantity to be 1 (or min_value) and keep it completely hidden.
// This prevents users from buying 2x of a variation pack, matching the client's business model.
$qty_value = isset( $input_value ) && $input_value > 0 ? $input_value : ( isset( $min_value ) ? $min_value : 1 );
?>
<div class="quantity hidden" style="display:none !important;">
	<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $qty_value ); ?>" />
</div>

