<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );


	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );
	
	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
	
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	
	if ( $rating_count > 0 ) : ?>

		<div class="woocommerce-product-rating">
			<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
			<?php if ( comments_open() ) : ?>
				<?php //phpcs:disable ?>
				<?php printf( _n( '%s happy customer', '%s happy customers', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>
				<?php // phpcs:enable ?>
			<?php endif ?>
		</div>

	<?php endif; ?>
	<?php 	

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
	<div class='price-per-unit'><?php the_field('price_per_unit')?></div>
	<?php 
	$price_subtext = get_field('price_subtext', $product->get_id());
	if (empty($price_subtext)) $price_subtext = 'From $1.45/tab';
	if ($price_subtext): 
	?>
		<div class="text-sm font-bold mb-3 text-center" style="color: #196C21; width:100%; display:block; margin-top:-10px;">
			<?php echo esc_html($price_subtext); ?>
		</div>
	<?php endif; ?>
	<!--<?php
	$copy = get_field('shop_page_text', $product->get_id());
	if (empty($copy)) {
		$copy = get_field('shop_page_copy', $product->get_id());
	}
	if (empty($copy)) {
		$copy = get_post_field('post_excerpt', $product->get_id());
	}
	if (!empty($copy)):
		$copy_plain = wp_strip_all_tags(strip_shortcodes($copy));
		$length = mb_strlen($copy_plain);
		?>
		<div class="product-excerpt text-xs md:text-sm text-gray-500 mt-2 mb-3 leading-snug px-1 text-center">
			<?php if ($length > 100): 
				$short_text = mb_strimwidth($copy_plain, 0, 100, '...');
				?>
				<span class="excerpt-short"><?php echo esc_html($short_text); ?></span>
				<span class="excerpt-full hidden"><?php echo wp_kses_post($copy); ?></span>
				<span class="read-more-toggle text-[11px] text-gray-500 italic hover:text-[#00125e] ml-1 cursor-pointer" onclick="event.preventDefault(); event.stopPropagation(); const p=this.closest('.product-excerpt'); const s=p.querySelector('.excerpt-short'); const f=p.querySelector('.excerpt-full'); if(f.classList.contains('hidden')){ f.classList.remove('hidden'); s.classList.add('hidden'); this.textContent='Read less <<'; }else{ f.classList.add('hidden'); s.classList.remove('hidden'); this.textContent='Read more >>'; }">Read more &gt;&gt;</span>
			<?php else: ?>
				<span><?php echo wp_kses_post($copy); ?></span>
			<?php endif; ?>
		</div>
	<?php endif; ?>-->
	<?php 
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
