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
    if ( is_shop() ) {
        echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">';
    } else {
        echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">';
    }
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
    <div class="grid grid-cols-2 gap-2 md:gap-3">
        <!-- 100% Genuine -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-green-500 flex-shrink-0">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
            100% Genuine
        </div>
        <!-- Delivery -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-[#6B7280] flex-shrink-0">
                <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 010 1.06L4.81 8.25H15a6.75 6.75 0 010 13.5h-3a.75.75 0 010-1.5h3a5.25 5.25 0 100-10.5H4.81l4.72 4.72a.75.75 0 11-1.06 1.06l-6-6a.75.75 0 010-1.06l6-6a.75.75 0 011.06 0z" clip-rule="evenodd" />
            </svg>
            Easy Return
        </div>
        <!-- Packaging -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-[#E85D04] flex-shrink-0">
                <path d="M3.375 4.5C2.339 4.5 1.5 5.34 1.5 6.375V13.5h12V6.375c0-1.036-.84-1.875-1.875-1.875h-8.25zM13.5 15h-12v2.625c0 1.035.84 1.875 1.875 1.875h.318c.105.809.824 1.425 1.682 1.425s1.577-.616 1.682-1.425h6.818c.105.809.824 1.425 1.682 1.425s1.577-.616 1.682-1.425h.318c1.036 0 1.875-.84 1.875-1.875V15h-4.5z" />
                <path d="M15 11.25v-3.75h3.375a3 3 0 012.122.878l1.621 1.622a3 3 0 01.878 2.122V13.5h-7.996z" />
            </svg>
            Fast Delivery
        </div>
        <!-- Secure Payment -->
        <div class="flex items-center justify-center gap-2 bg-[#EAF2FF] border border-[#B3D4FF] text-primary font-medium text-[13px] md:text-sm py-2 px-3 rounded-md shadow-sm leading-tight text-center">
            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-[#D4AF37] flex-shrink-0">
                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
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

/**
 * Wrap Add to Cart in a white box on Mobile only.
 * Priority 25 is after Excerpt (20), before Add to Cart (30).
 */
add_action('woocommerce_single_product_summary', 'armo_mobile_box_open', 25);
function armo_mobile_box_open() {
    echo '<div class="w-full bg-white shadow-md rounded-xl p-5 lg:bg-transparent lg:shadow-none lg:rounded-none lg:p-0 mb-6 lg:mb-0">';
}

/**
 * Priority 32 is after Add to Cart (30), before Feature Pills Mobile (35).
 */
add_action('woocommerce_single_product_summary', 'armo_mobile_box_close', 32);
function armo_mobile_box_close() {
    echo '</div>';
}
