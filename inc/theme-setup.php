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
         * Add custom styles to the backend visual editor (TinyMCE)
         */
        add_editor_style( 'assets/css/editor-style.css' );

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
            'primary'          => __( 'Primary Menu (Header)', 'armodafinil-australia' ),
            'footer'           => __( 'Footer Category Menu', 'armodafinil-australia' ),
            'footer-quick'     => __( 'Footer Quick Links', 'armodafinil-australia' ),
            'footer-important' => __( 'Footer Important Links', 'armodafinil-australia' ),
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


/**
 * Register "Reviews" Custom Post Type.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This creates the "Reviews" menu item in WP Admin sidebar.
 * Your client can go to Reviews → Add New to create review entries.
 * The review modules on the frontend automatically query this CPT.
 * =====================================================================
 */
function armo_register_reviews_cpt() {
    $labels = array(
        'name'                  => __( 'Reviews', 'armodafinil-australia' ),
        'singular_name'         => __( 'Review', 'armodafinil-australia' ),
        'menu_name'             => __( 'Reviews', 'armodafinil-australia' ),
        'add_new'               => __( 'Add New', 'armodafinil-australia' ),
        'add_new_item'          => __( 'Add New Review', 'armodafinil-australia' ),
        'edit_item'             => __( 'Edit Review', 'armodafinil-australia' ),
        'new_item'              => __( 'New Review', 'armodafinil-australia' ),
        'view_item'             => __( 'View Review', 'armodafinil-australia' ),
        'search_items'          => __( 'Search Reviews', 'armodafinil-australia' ),
        'not_found'             => __( 'No reviews found.', 'armodafinil-australia' ),
        'not_found_in_trash'    => __( 'No reviews found in Trash.', 'armodafinil-australia' ),
        'all_items'             => __( 'All Reviews', 'armodafinil-australia' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 25,
        'menu_icon'          => 'dashicons-star-filled',
        'supports'           => array( 'title', 'editor' ),
        'has_archive'        => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
    );

    register_post_type( 'reviews', $args );
}
add_action( 'init', 'armo_register_reviews_cpt' );




/**
 * Handle Review Form Submission via AJAX.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * When a visitor submits the review form on the frontend, the form data
 * is sent here via AJAX. This function:
 * 1. Verifies the security nonce
 * 2. Sanitizes all input data
 * 3. Creates a new 'reviews' CPT post with status 'pending'
 * 4. Saves the rating and name as ACF fields
 *
 * The review will NOT appear on the site until the admin goes to
 * Reviews → All Reviews and changes the status from "Pending" to "Published".
 * =====================================================================
 */
function armo_handle_review_submission() {
    // Verify security nonce
    if ( ! isset( $_POST['armo_review_nonce'] ) || ! wp_verify_nonce( $_POST['armo_review_nonce'], 'armo_submit_review' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed. Please refresh the page and try again.' ) );
    }

    // Sanitize inputs
    $title      = isset( $_POST['review_title'] )      ? sanitize_text_field( $_POST['review_title'] )      : '';
    $content    = isset( $_POST['review_content'] )    ? sanitize_textarea_field( $_POST['review_content'] ) : '';
    $name       = isset( $_POST['review_name'] )       ? sanitize_text_field( $_POST['review_name'] )       : '';
    $email      = isset( $_POST['review_email'] )      ? sanitize_email( $_POST['review_email'] )           : '';
    $rating     = isset( $_POST['review_rating'] )     ? intval( $_POST['review_rating'] )                  : 5;
    $product_id = isset( $_POST['review_product_id'] ) ? intval( $_POST['review_product_id'] )              : 0;

    // Validate required fields
    if ( empty( $title ) || empty( $content ) || empty( $name ) || empty( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    // Validate email
    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
    }

    // Clamp rating to 1-5
    $rating = max( 1, min( 5, $rating ) );

    // Create the review post as 'pending' (requires admin approval)
    $post_id = wp_insert_post( array(
        'post_type'    => 'reviews',
        'post_title'   => $title,
        'post_content' => $content,
        'post_status'  => 'pending',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'Something went wrong. Please try again.' ) );
    }

    // Save ACF fields
    update_field( 'rating', $rating, $post_id );
    update_field( 'name', $name, $post_id );
    update_field( 'email', $email, $post_id );

    // Save linked product if submitted from a product page
    if ( $product_id > 0 ) {
        update_field( 'linked_product', $product_id, $post_id );
    }

    wp_send_json_success( array(
        'message' => 'Thank you for your review! It will appear on the site once approved.',
    ) );
}
// wp_ajax_ = for logged-in users, wp_ajax_nopriv_ = for visitors (not logged in)
add_action( 'wp_ajax_armo_submit_review', 'armo_handle_review_submission' );
add_action( 'wp_ajax_nopriv_armo_submit_review', 'armo_handle_review_submission' );

/**
 * Auto-populate Feature Bar Items if empty
 */
add_action('admin_init', function() {
    if (function_exists('update_field') && !get_option('_armo_feature_bar_populated')) {
        $existing = get_field('feature_bar_items', 'option');
        if (empty($existing)) {
            $default_items = array(
                array(
                    'icon' => '<svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 18.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM18 18.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M5 18.5H3V7h10v11.5h-1M13 7h4l3 4v7.5h-2M1 11h3M2 14h2M1 8h3"></path></svg>',
                    'text' => '7-10 Day Delivery',
                ),
                array(
                    'icon' => '<svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 12a3 3 0 100-6 3 3 0 000 6z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 3-2.5 5.5-5.5 5.5h-4c-3 0-5.5-2.5-5.5-5.5V9l7-2 7 2v1.5z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M9 16.5v5l3-2 3 2v-5"></path><circle cx="16" cy="6" r="3" fill="currentColor" stroke="none"></circle><path d="M16 4.5l.5 1 1.2.2-.8.8.2 1.2-1-.5-1 .5.2-1.2-.8-.8 1.2-.2z" fill="#fff"></path></svg>',
                    'text' => '5,000+ Australian Customers',
                ),
                array(
                    'icon' => '<svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" fill="currentColor" viewBox="0 0 512 512"><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.1 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg>',
                    'text' => 'Genuine Brands',
                ),
                array(
                    'icon' => '<svg class="w-4 h-4 sm:w-5 sm:h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"></path></svg>',
                    'text' => '24/7 Customer Support',
                ),
            );
            update_field('feature_bar_items', $default_items, 'option');
        }
        update_option('_armo_feature_bar_populated', 'yes');
    }
});
