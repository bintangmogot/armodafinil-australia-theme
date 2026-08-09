<?php
/**
 * Theme Shortcodes
 * 
 * Provides easy-to-use shortcodes for the client to paste into WYSIWYG editors.
 */

/**
 * 1. Red Action Button
 * Usage: [armo_button text="Buy Modafinil in Perth" link="/shop/"]
 */
function armo_red_button_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'text' => 'Buy Modafinil',
        'link' => '/shop/',
    ), $atts, 'armo_button' );

    $text = esc_html( $atts['text'] );
    $link = esc_url( $atts['link'] );

    return '
    <div class="my-8">
        <a href="' . $link . '" class="inline-flex items-center justify-between bg-[#ff0000] text-white rounded-full pl-8 pr-2 py-2 shadow-lg hover:bg-[#cc0000] transition-colors no-underline group" style="text-decoration: none;">
            <span class="text-xl md:text-2xl font-bold mr-6">' . $text . '</span>
            <span class="bg-white rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0 text-[#ff0000] group-hover:bg-gray-100 transition-colors">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                </svg>
            </span>
        </a>
    </div>
    ';
}
add_shortcode( 'armo_button', 'armo_red_button_shortcode' );

/**
 * 2. Important Information Box
 * Usage: [armo_info title="Important Information"]Your text here...[/armo_info]
 */
function armo_info_box_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'title' => 'Important Information',
    ), $atts, 'armo_info' );

    $title = esc_html( $atts['title'] );
    
    // Remove empty p tags that WordPress might wrap around the shortcode content
    $content = do_shortcode( shortcode_unautop( $content ) );

    return '
    <div class="bg-[#e8f1fa] p-6 md:p-8 rounded-xl my-8 border border-[#d0e3f5]">
        <h3 class="text-[#0a1930] text-2xl font-bold mb-4 mt-0">' . $title . '</h3>
        <div class="text-[#4a5568] text-sm md:text-base leading-relaxed">
            ' . wpautop( wp_kses_post( $content ) ) . '
        </div>
    </div>
    ';
}
add_shortcode( 'armo_info', 'armo_info_box_shortcode' );

/**
 * 3. Inline Detailed Product
 * Usage: [armo_inline_product id="123"]
 */
function armo_inline_product_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id' => '',
    ), $atts, 'armo_inline_product' );

    if ( empty( $atts['id'] ) ) return '';

    $post_id = intval( $atts['id'] );
    $post_object = get_post( $post_id );
    if ( ! $post_object || $post_object->post_type !== 'product' ) return '';

    ob_start();

    global $post, $product;
    $post = $post_object;
    setup_postdata( $post );
    $product = wc_get_product( $post_id );

    // Prevent reviews anchor button from showing since the reviews section isn't on the blog page
    remove_action('woocommerce_single_product_summary', 'armo_custom_reviews_anchor_button', 27);

    // Prevent product meta (SKU, Categories, Tags) from showing
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

    // Prevent theme's custom mobile layout from rendering inside the inline shortcode
    remove_action('woocommerce_single_product_summary', 'armo_mobile_box_open', 25);
    remove_action('woocommerce_single_product_summary', 'armo_mobile_product_image', 26);
    remove_action('woocommerce_single_product_summary', 'armo_mobile_box_close', 32);
    remove_action('woocommerce_single_product_summary', 'armo_display_feature_pills_mobile', 35);

    ?>
    <style>
        .armo-inline-product-shortcode ul li::before,
        .armo-inline-product-shortcode ul li::after {
            display: none !important;
            content: none !important;
            background: none !important;
        }
        .armo-inline-product-shortcode ul li {
            background-image: none !important;
            list-style: none !important;
            padding-left: 0 !important;
        }
        .armo-inline-product-shortcode img.wp-post-image {
            margin: 0 !important;
        }
        .armo-inline-product-shortcode .armo-table-wrapper {
            margin-bottom: 16px !important;
        }
    </style>
    <div class="woocommerce my-8 armo-inline-product-shortcode">
        <div id="product-<?php the_ID(); ?>" <?php wc_product_class('custom-product-layout flex flex-col mx-auto w-full', $product); ?>>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-8 items-start">
                <!-- Left Column: Image -->
                <div class="product-gallery-column w-full">
                    <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="block w-full text-center hover:opacity-90 transition-opacity">
                        <?php 
                        $image_size = apply_filters( 'woocommerce_gallery_image_size', 'woocommerce_single' );
                        echo $product->get_image( $image_size, array( 'class' => 'w-full h-auto object-contain rounded-lg inline-block' ) ); 
                        ?>
                    </a>
                </div>

                <!-- Right Column: Summary -->
                <div class="summary entry-summary">
                    <?php
                    do_action('woocommerce_single_product_summary');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    // Restore the action for other parts of the site
    add_action('woocommerce_single_product_summary', 'armo_custom_reviews_anchor_button', 27);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    
    add_action('woocommerce_single_product_summary', 'armo_mobile_box_open', 25);
    add_action('woocommerce_single_product_summary', 'armo_mobile_product_image', 26);
    add_action('woocommerce_single_product_summary', 'armo_mobile_box_close', 32);
    add_action('woocommerce_single_product_summary', 'armo_display_feature_pills_mobile', 35);

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'armo_inline_product', 'armo_inline_product_shortcode' );
