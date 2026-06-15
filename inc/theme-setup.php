<?php
/**
 * Theme Setup — registers features, menus, and image sizes.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This file tells WordPress: "My theme supports these features."
 *
 * - add_theme_support() → enables built-in WordPress features
 * - register_nav_menus() → creates menu locations you can assign in WP Admin
 * - register_sidebar() → creates widget areas for the footer
 *
 * The function runs on 'after_setup_theme' — a WordPress "hook" that fires
 * when the theme is loaded. Think of hooks as events:
 *   "When WordPress finishes loading the theme, run this function."
 * =====================================================================
 */

if ( ! function_exists( 'armo_theme_setup' ) ) :
    function armo_theme_setup() {

        /*
         * Let WordPress manage the <title> tag in <head>.
         * Without this, you'd have to hardcode <title> in header.php.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable "Featured Images" (thumbnails) for posts and pages.
         * This lets you set a main image for each post/page in the editor.
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Enable the "Custom Logo" feature.
         * This adds a logo uploader in: WP Admin → Appearance → Customize → Site Identity
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 250,
            'flex-height' => true,
            'flex-width'  => true,
        ) );

        /*
         * Switch core WordPress markup to output clean HTML5.
         * (Instead of older XHTML-style markup.)
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        ) );

        /*
         * Register Navigation Menu locations.
         * After this, go to WP Admin → Appearance → Menus to create menus
         * and assign them to these locations.
         *
         * 'primary' → the main header navigation
         * 'footer'  → the footer navigation
         */
        register_nav_menus( array(
            'primary' => __( 'Primary Menu (Header)', 'armodafinil-australia' ),
            'footer'  => __( 'Footer Menu', 'armodafinil-australia' ),
        ) );

        /*
         * Add custom image sizes for your modules.
         * Usage in templates: the_post_thumbnail('armo-hero');
         */
        add_image_size( 'armo-hero', 1920, 800, true );     // Hero banners
        add_image_size( 'armo-card', 600, 400, true );       // Card thumbnails
        add_image_size( 'armo-product', 800, 800, true );    // Product images

    }
endif;
add_action( 'after_setup_theme', 'armo_theme_setup' );


/**
 * Register Widget Areas (Sidebars).
 *
 * These create the widget zones you see in WP Admin → Appearance → Widgets.
 * We're creating 3 zones: a sidebar and two footer columns.
 */
function armo_widgets_init() {

    // Sidebar (for blog pages)
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'armodafinil-australia' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets shown in the blog sidebar.', 'armodafinil-australia' ),
        'before_widget' => '<div id="%1$s" class="widget mb-6 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">',
        'after_title'   => '</h3>',
    ) );

    // Footer Column 1
    register_sidebar( array(
        'name'          => __( 'Footer Column 1', 'armodafinil-australia' ),
        'id'            => 'footer-1',
        'description'   => __( 'Widgets shown in footer column 1.', 'armodafinil-australia' ),
        'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">',
        'after_title'   => '</h3>',
    ) );

    // Footer Column 2
    register_sidebar( array(
        'name'          => __( 'Footer Column 2', 'armodafinil-australia' ),
        'id'            => 'footer-2',
        'description'   => __( 'Widgets shown in footer column 2.', 'armodafinil-australia' ),
        'before_widget' => '<div id="%1$s" class="widget mb-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'armo_widgets_init' );
