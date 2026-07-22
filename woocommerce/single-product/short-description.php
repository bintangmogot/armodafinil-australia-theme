<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<style>
.woocommerce-product-details__short-description h1 {
    font-size: 2.25rem;
    line-height: 2.5rem;
    font-weight: 700;
    color: #00125E;
    margin-bottom: 1rem;
    margin-top: 1.5rem;
}
.woocommerce-product-details__short-description h2 {
    font-size: 1.875rem;
    line-height: 2.25rem;
    font-weight: 700;
    color: #00125E;
    margin-bottom: 0.75rem;
    margin-top: 1.5rem;
}
.woocommerce-product-details__short-description h3 {
    font-size: 1.5rem;
    line-height: 2rem;
    font-weight: 700;
    color: #00125E;
    margin-bottom: 0.75rem;
    margin-top: 1.25rem;
}
.woocommerce-product-details__short-description h4 {
    font-size: 1.25rem;
    line-height: 1.75rem;
    font-weight: 700;
    color: #00125E;
    margin-bottom: 0.5rem;
    margin-top: 1rem;
}
.woocommerce-product-details__short-description h1:first-child,
.woocommerce-product-details__short-description h2:first-child,
.woocommerce-product-details__short-description h3:first-child,
.woocommerce-product-details__short-description h4:first-child {
    margin-top: 0;
}
.woocommerce-product-details__short-description p {
    margin-bottom: 1rem;
}
.woocommerce-product-details__short-description ul {
    margin-bottom: 1rem;
}
</style>
<div class="woocommerce-product-details__short-description prose max-w-none text-primary-dark">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
