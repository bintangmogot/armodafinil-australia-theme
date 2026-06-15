<?php
/**
 * Armodafinil Australia — Theme Functions
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This is the "brain" of your WordPress theme.
 * It runs automatically when WordPress loads your theme.
 *
 * Think of it like your JavaScript entry point — it sets everything up.
 * We keep it clean by putting the actual code in separate files
 * inside the inc/ folder and using require_once to include them.
 *
 * require_once = "load this file, but only once (don't duplicate)"
 * get_stylesheet_directory() = the absolute path to YOUR theme folder
 * =====================================================================
 *
 * @package Armodafinil_Australia
 * @since   2.0.0
 */

// Define constants for easy reference
define( 'ARMO_THEME_VERSION', '2.0.0' );
define( 'ARMO_THEME_DIR', get_stylesheet_directory() );
define( 'ARMO_THEME_URI', get_stylesheet_directory_uri() );

/*
 * ── One-time fix: tell WordPress this is a standalone theme ──
 * When we removed "Template: astra" from style.css, WordPress still had
 * the old value cached in the database. This auto-corrects it once.
 */
if ( get_option( 'template' ) !== get_option( 'stylesheet' ) ) {
    update_option( 'template', get_option( 'stylesheet' ) );
}

/*
 * ── Load Theme Setup ──
 * Registers: menus, theme supports, image sizes, widget areas
 * File: inc/theme-setup.php
 */
require_once ARMO_THEME_DIR . '/inc/theme-setup.php';

/*
 * ── Load Asset Enqueuing ──
 * Registers: CSS and JS files
 * File: inc/enqueue.php
 */
require_once ARMO_THEME_DIR . '/inc/enqueue.php';

/*
 * ── Load WooCommerce Support ──
 * Registers: WooCommerce compatibility, custom wrappers
 * File: inc/woocommerce.php
 */
if ( class_exists( 'WooCommerce' ) ) {
    require_once ARMO_THEME_DIR . '/inc/woocommerce.php';
}

/*
 * ── Fix: Make ACF "Modules" field group show on ALL page templates ──
 * The ACF field group was set to only show on "Default Template".
 * This overrides that rule so modules appear no matter which
 * page template you select in the editor.
 *
 * 🔰 How this works:
 * ACF checks "location rules" to decide if a field group should appear.
 * This filter intercepts that check and says "yes, show it" for any page.
 */
function armo_acf_modules_on_all_pages( $match, $rule, $screen, $field_group ) {
    // Only modify rules about page templates
    if ( $rule['param'] === 'page_template' && isset( $screen['post_type'] ) && $screen['post_type'] === 'page' ) {
        return true; // Always show on pages, regardless of template
    }
    return $match;
}
add_filter( 'acf/location/match_rule', 'armo_acf_modules_on_all_pages', 10, 4 );

/**
 * Dynamically register the Hero Section (Split Fields) layout inside the ACF Modules flexible content field.
 */
function armo_add_hero_section_layout_to_modules( $field ) {
    // Check if layout is already registered
    if ( isset( $field['layouts'] ) ) {
        foreach ( $field['layouts'] as $layout ) {
            if ( isset( $layout['name'] ) && $layout['name'] === 'hero_section' ) {
                return $field;
            }
        }
    }

    // Register Hero Section (Split Fields) layout
    $field['layouts']['layout_hero_section_layout'] = array(
        'key' => 'layout_hero_section_layout',
        'name' => 'hero_section',
        'label' => 'Hero Section (Split Fields)',
        'display' => 'block',
        'sub_fields' => array(
            array(
                'key' => 'field_hero_section_image',
                'label' => 'Background Image',
                'name' => 'image',
                'type' => 'image',
                'return_format' => 'url',
                'wrapper' => array('width' => '50'),
            ),
            array(
                'key' => 'field_hero_section_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'wrapper' => array('width' => '50'),
                'default_value' => 'Armodafinil Australia',
            ),
            array(
                'key' => 'field_hero_section_subtitle',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'wrapper' => array('width' => '50'),
                'default_value' => 'Trusted Armodafinil Supplier with Fast Australia-Wide Delivery',
            ),
            array(
                'key' => 'field_hero_section_tagline',
                'label' => 'Yellow Tagline',
                'name' => 'tagline',
                'type' => 'text',
                'wrapper' => array('width' => '50'),
                'default_value' => 'Wake up sharper, stay focused longer',
            ),
            array(
                'key' => 'field_hero_section_features',
                'label' => 'Features List',
                'name' => 'features',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Feature',
                'sub_fields' => array(
                    array(
                        'key' => 'field_hero_section_feature_text',
                        'label' => 'Feature Text',
                        'name' => 'feature_text',
                        'type' => 'text',
                        'required' => 1,
                    )
                ),
            ),
            array(
                'key' => 'field_hero_section_button_text',
                'label' => 'Button Text',
                'name' => 'button_text',
                'type' => 'text',
                'wrapper' => array('width' => '50'),
                'default_value' => 'Shop Armodafinil Now',
            ),
            array(
                'key' => 'field_hero_section_button_link',
                'label' => 'Button Link (URL)',
                'name' => 'button_link',
                'type' => 'text',
                'wrapper' => array('width' => '50'),
                'default_value' => '/shop/',
            ),
        ),
    );

    return $field;
}
add_filter( 'acf/load_field/name=modules', 'armo_add_hero_section_layout_to_modules' );

