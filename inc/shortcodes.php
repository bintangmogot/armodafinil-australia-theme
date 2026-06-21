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
