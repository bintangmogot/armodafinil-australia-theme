<?php
/**
 * Enqueue Styles & Scripts — loads your CSS and JS files.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * In plain HTML, you'd write: <link rel="stylesheet" href="main.css">
 * In WordPress, you use wp_enqueue_style() instead. Why?
 *   - WordPress controls WHEN and WHERE files load
 *   - Plugins can depend on your styles or vice versa
 *   - Avoids duplicate loading
 *
 * wp_enqueue_style( 'handle', 'url', dependencies, version, media )
 *   - 'handle'       → a unique name for this stylesheet
 *   - 'url'          → the file URL
 *   - dependencies   → array of other stylesheets to load FIRST
 *   - version        → version number (for cache busting)
 *   - media          → 'all', 'screen', 'print', etc.
 *
 * wp_enqueue_script() works the same way for JS files.
 *
 * get_stylesheet_directory_uri() → URL to your theme folder
 *   Example: http://localhost/wp-content/themes/armodafinil-australia
 * =====================================================================
 */

function armo_enqueue_assets() {

    // Get theme version for cache-busting
    $theme_version = wp_get_theme()->get( 'Version' );

    /*
     * ── CSS FILES ──
     */

    // Main Tailwind compiled CSS
    // This is the OUTPUT file from: npx tailwindcss -i source.css -o main.css
    $main_css_path = get_stylesheet_directory() . '/assets/css/main.css';
    $css_version = time(); // FORCED CACHE BUSTING

    wp_enqueue_style(
        'armo-tailwind',                                                   // handle
        get_stylesheet_directory_uri() . '/assets/css/main.css',           // URL
        array(),                                                           // no dependencies
        $css_version                                                       // version
    );

    // Theme's style.css (for WordPress theme metadata — mostly empty)
    wp_enqueue_style(
        'armo-style',
        get_stylesheet_uri(),           // This always points to style.css in theme root
        array( 'armo-tailwind' ),       // Load AFTER Tailwind
        $theme_version
    );

    /*
     * ── JAVASCRIPT FILES ──
     */

    wp_enqueue_script(
        'armo-app',                                                        // handle
        get_stylesheet_directory_uri() . '/assets/js/app.js',              // URL
        array(),                                                           // no dependencies (no jQuery!)
        time(),                                                            // version (forced cache busting)
        true                                                               // load in footer (better performance)
    );

    // Product Total calculation & quantity buttons (single product and cart)
    if ( class_exists( 'WooCommerce' ) && ( is_product() || is_cart() ) ) {
        wp_enqueue_script(
            'armo-product-total',
            get_stylesheet_directory_uri() . '/assets/js/product-total.js',
            array('jquery'),
            $theme_version,
            true
        );
    }

}
add_action( 'wp_enqueue_scripts', 'armo_enqueue_assets' );
