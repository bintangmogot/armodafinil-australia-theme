<?php
/**
 * Theme Options — ACF Options Page for editable site-wide settings.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This creates the "Options" menu item in WP Admin that your client
 * asked for. It uses ACF's Options Page feature to store site-wide
 * settings (not tied to any specific page or post).
 *
 * The client can edit footer content from:
 *   WP Admin → Options (in the left sidebar)
 *
 * In templates, retrieve values with:
 *   get_field('field_name', 'option')
 * =====================================================================
 *
 * @package Armodafinil_Australia
 * @since   2.1.0
 */

// Safety check — only run if ACF is active
if ( ! function_exists( 'acf_add_options_page' ) ) {
    return;
}

/**
 * Register the "Footer" page under Appearance menu.
 *
 * The client will find it at: WP Admin → Appearance → Footer
 */
acf_add_options_page();

/**
 * Register ACF Field Group for Footer Settings.
 *
 * This creates all the editable fields the client will see
 * when they go to Options → Footer in WP Admin.
 */
if ( function_exists( 'acf_add_local_field_group' ) ) :

    acf_add_local_field_group( array(
        'key'    => 'group_footer_options',
        'title'  => 'Contact, Payments & Copyright',
        'fields' => array(

            // ─── TAB: Menu Headings ───────────────────────────────
            array(
                'key'   => 'field_footer_tab_menu_headings',
                'label' => 'Menu Headings',
                'type'  => 'tab',
            ),
            array(
                'key'           => 'field_footer_menu_1_heading',
                'label'         => 'Menu 1 Heading',
                'name'          => 'footer_menu_1_heading',
                'type'          => 'text',
                'default_value' => 'Category',
            ),
            array(
                'key'           => 'field_footer_menu_2_heading',
                'label'         => 'Menu 2 Heading',
                'name'          => 'footer_menu_2_heading',
                'type'          => 'text',
                'default_value' => 'Quick Links',
            ),
            array(
                'key'           => 'field_footer_menu_3_heading',
                'label'         => 'Menu 3 Heading',
                'name'          => 'footer_menu_3_heading',
                'type'          => 'text',
                'default_value' => 'Important Links',
            ),

            // ─── TAB: Contact Info ────────────────────────────────
            array(
                'key'   => 'field_footer_tab_contact',
                'label' => 'Contact Info',
                'type'  => 'tab',
            ),
            array(
                'key'           => 'field_footer_address',
                'label'         => 'Address',
                'name'          => 'footer_address',
                'type'          => 'text',
                'instructions'  => 'Physical address displayed in the footer.',
                'default_value' => 'Level 2/29 Chifley Square, Sydney NSW 2000',
            ),
            array(
                'key'           => 'field_footer_whatsapp',
                'label'         => 'WhatsApp Number',
                'name'          => 'footer_whatsapp',
                'type'          => 'text',
                'instructions'  => 'WhatsApp contact number (displayed as-is).',
                'default_value' => '+61 8 6866 0556',
            ),
            array(
                'key'           => 'field_footer_whatsapp_link',
                'label'         => 'WhatsApp Link URL',
                'name'          => 'footer_whatsapp_link',
                'type'          => 'url',
                'instructions'  => 'Full WhatsApp chat link (e.g. https://wa.me/61868660556). Leave empty to disable clickable link.',
                'default_value' => '',
            ),
            array(
                'key'           => 'field_footer_email',
                'label'         => 'Email Address',
                'name'          => 'footer_email',
                'type'          => 'email',
                'instructions'  => 'Contact email displayed in the footer.',
                'default_value' => 'orders@armodafinilaustralia.com.au',
            ),

            // ─── TAB: Payments & Shipping ─────────────────────────
            array(
                'key'   => 'field_footer_tab_payments',
                'label' => 'Payments & Shipping',
                'type'  => 'tab',
            ),
            array(
                'key'          => 'field_footer_payment_images',
                'label'        => 'Payment Method Images',
                'name'         => 'footer_payment_images',
                'type'         => 'repeater',
                'instructions' => 'Add payment method logos (e.g. Commonwealth Bank, Osko, PayID). Upload images in the Media Library first.',
                'layout'       => 'table',
                'button_label' => 'Add Payment Method',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_footer_payment_image',
                        'label'         => 'Logo Image',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ),
                    array(
                        'key'   => 'field_footer_payment_alt',
                        'label' => 'Alt Text',
                        'name'  => 'alt_text',
                        'type'  => 'text',
                    ),
                ),
            ),
            array(
                'key'          => 'field_footer_shipping_images',
                'label'        => 'Shipping Partner Images',
                'name'         => 'footer_shipping_images',
                'type'         => 'repeater',
                'instructions' => 'Add shipping partner logos (e.g. Australia Post).',
                'layout'       => 'table',
                'button_label' => 'Add Shipping Partner',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_footer_shipping_image',
                        'label'         => 'Logo Image',
                        'name'          => 'image',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ),
                    array(
                        'key'   => 'field_footer_shipping_alt',
                        'label' => 'Alt Text',
                        'name'  => 'alt_text',
                        'type'  => 'text',
                    ),
                ),
            ),

            // ─── TAB: Copyright ───────────────────────────────────
            array(
                'key'   => 'field_footer_tab_copyright',
                'label' => 'Copyright',
                'type'  => 'tab',
            ),
            array(
                'key'           => 'field_footer_copyright',
                'label'         => 'Copyright Text',
                'name'          => 'footer_copyright',
                'type'          => 'text',
                'instructions'  => 'Copyright notice. Use {year} for the current year and {site_name} for the site name. Example: © {year} {site_name}. All rights reserved.',
                'default_value' => '© {year} {site_name}. All rights reserved.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'options_page',
                    'operator' => '==',
                    'value'    => 'acf-options',
                ),
            ),
        ),
        'style'    => 'default',
        'position' => 'normal',
    ) );

endif;
