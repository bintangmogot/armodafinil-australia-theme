<?php
/**
 * WooCommerce Compatibility — minimal setup to keep WooCommerce working.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WooCommerce needs to know your theme supports it.
 * Without this, WooCommerce will show a warning in WP Admin.
 *
 * The wrapper functions below tell WooCommerce:
 * "Use MY <main> wrapper instead of your default <div>."
 * This keeps your layout consistent on shop/product/cart pages.
 * =====================================================================
 */

/**
 * Declare WooCommerce support.
 */
function armo_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'armo_woocommerce_support' );


/**
 * WooCommerce content wrappers.
 *
 * By default, WooCommerce wraps its pages in <div class="woocommerce">.
 * We override that to use our own layout wrapper with Tailwind classes.
 */
function armo_woocommerce_wrapper_before() {
    echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">';
}

function armo_woocommerce_wrapper_after() {
    echo '</div>';
}

// Remove WooCommerce default wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Add our custom wrappers
add_action( 'woocommerce_before_main_content', 'armo_woocommerce_wrapper_before' );
add_action( 'woocommerce_after_main_content', 'armo_woocommerce_wrapper_after' );
