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
 * Add Shop Page Copy / Short Description to Product Cards
 */
add_action('woocommerce_after_shop_loop_item_title', 'armo_add_shop_page_copy', 5);
function armo_add_shop_page_copy() {
    global $post;
    
    $copy = '';
    if (function_exists('get_field')) {
        $copy = get_field('shop_page_text', $post->ID);
        if (empty($copy)) {
            $copy = get_field('shop_page_copy', $post->ID);
        }
    }
    
    // Fallback to the WooCommerce short description (excerpt) if the ACF field is empty
    if (empty($copy)) {
        $copy = $post->post_excerpt;
    }
    
    if (!empty($copy)) {
        $copy_plain = wp_strip_all_tags(strip_shortcodes($copy));
        $length = mb_strlen($copy_plain);
        if ($length > 100) {
            $short_text = mb_strimwidth($copy_plain, 0, 100, '...');
            echo '<div class="product-excerpt text-xs md:text-sm text-gray-500 mt-2 mb-3 leading-snug px-1 text-center">';
            echo '<span class="excerpt-short">' . esc_html($short_text) . '</span>';
            echo '<span class="excerpt-full hidden">' . wp_kses_post($copy) . '</span>';
            echo '<span class="read-more-toggle text-[11px] text-gray-500 italic hover:text-[#00125e] ml-1 cursor-pointer" onclick="event.preventDefault(); event.stopPropagation(); const p=this.closest(\'.product-excerpt\'); const s=p.querySelector(\'.excerpt-short\'); const f=p.querySelector(\'.excerpt-full\'); if(f.classList.contains(\'hidden\')){ f.classList.remove(\'hidden\'); s.classList.add(\'hidden\'); this.textContent=\'Read less <<\'; }else{ f.classList.add(\'hidden\'); s.classList.remove(\'hidden\'); this.textContent=\'Read more >>\'; }">Read more &gt;&gt;</span>';
            echo '</div>';
        } else {
            echo '<div class="product-excerpt text-xs md:text-sm text-gray-500 mt-2 mb-3 leading-snug px-1 text-center">';
            echo '<span>' . wp_kses_post($copy) . '</span>';
            echo '</div>';
        }
    }
}

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


/**
 * Reusable Feature Pills HTML
 */
function armo_feature_pills() {
    ?>
    <div class="grid grid-cols-2 gap-y-4 gap-x-2 md:gap-x-4">
        <!-- 100% Genuine -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
            100% Genuine
        </div>
        <!-- Delivery -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            8-12 Days USA<br>Tracked Delivery
        </div>
        <!-- Packaging -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            Discreet Packaging
        </div>
        <!-- Secure Payment -->
        <div class="flex items-start gap-2 text-gray-800 text-[13px] md:text-sm leading-snug">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-500 flex-shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>
            Secure Payment
        </div>
    </div>
    <?php
}

/**
 * Display Feature Pills below Add to Cart on Mobile
 */
add_action('woocommerce_single_product_summary', 'armo_display_feature_pills_mobile', 35);
function armo_display_feature_pills_mobile() {
    echo '<div class="block lg:hidden mt-6">';
    armo_feature_pills();
    echo '</div>';
}
