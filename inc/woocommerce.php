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
function armo_woocommerce_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'armo_woocommerce_support');


/**
 * WooCommerce content wrappers.
 *
 * By default, WooCommerce wraps its pages in <div class="woocommerce">.
 * We override that to use our own layout wrapper with Tailwind classes.
 */
function armo_woocommerce_wrapper_before()
{
    echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">';
}

function armo_woocommerce_wrapper_after()
{
    echo '</div>';
}

// Remove WooCommerce default wrappers
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove default WooCommerce sidebar
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Add our custom wrappers
add_action('woocommerce_before_main_content', 'armo_woocommerce_wrapper_before');
add_action('woocommerce_after_main_content', 'armo_woocommerce_wrapper_after');

/**
 * Render ACF modules and normal text from the Shop page backend
 * onto the actual WooCommerce Shop Archive page.
 */
function armo_woocommerce_shop_page_content() {
    if ( is_shop() && ! is_search() ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        if ( $shop_page_id ) {
            // Check for ACF modules first
            if ( function_exists('have_rows') && have_rows('modules', $shop_page_id) ) {
                echo '<div class="armo-shop-modules-wrapper mb-12">';
                while ( have_rows('modules', $shop_page_id) ) : the_row();
                    $layout_name = get_row_layout();
                    get_template_part( 'modules/content', $layout_name );
                endwhile;
                echo '</div>';
            } else {
                // If no ACF modules, get the normal content (Classic/Gutenberg editor text)
                $shop_page = get_post( $shop_page_id );
                if ( $shop_page && !empty($shop_page->post_content) ) {
                    echo '<div class="mb-12 prose max-w-none">';
                    echo apply_filters( 'the_content', $shop_page->post_content );
                    echo '</div>';
                }
            }
        }
    }
}
// Remove the default WooCommerce description
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

// Hook our custom ACF modules BEFORE the main content wrapper opens so they can be full width
add_action( 'woocommerce_before_main_content', 'armo_woocommerce_shop_page_content', 5 );

/**
 * Hide the default WooCommerce Page Title on the Shop page
 * (Since we are using custom ACF Modules for the header)
 */
add_filter( 'woocommerce_show_page_title', 'armo_hide_shop_page_title' );
function armo_hide_shop_page_title( $show_title ) {
    if ( is_shop() ) {
        return false;
    }
    return $show_title;
}

/**
 * Remove WooCommerce Breadcrumbs on the Shop page
 */
add_action( 'template_redirect', 'armo_remove_shop_breadcrumbs' );
function armo_remove_shop_breadcrumbs() {
    if ( is_shop() ) {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    }
}

/**
 * Change WooCommerce Loop "Add to Cart" button to "Buy Now" + Cart Icon
 */
add_filter( 'woocommerce_loop_add_to_cart_link', 'armo_custom_loop_add_to_cart_link', 10, 3 );
function armo_custom_loop_add_to_cart_link( $html, $product, $args ) {
    $icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; margin-left:8px; vertical-align:middle;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>';
    
    return sprintf(
        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        'Buy Now ' . $icon
    );
}

/**
 * Add "IN STOCK" badge to WooCommerce products on the loop
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'armo_in_stock_badge', 9 );
function armo_in_stock_badge() {
    global $product;
    if ( $product && $product->is_in_stock() ) {
        echo '<span class="armo-in-stock-badge">IN STOCK</span>';
    }
}

