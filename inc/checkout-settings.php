<?php
/**
 * Checkout & Thank-You settings (Theme Settings > Checkout & Thank-You).
 *
 * Every bank detail, heading, label, note and logo on the order-received page lives here,
 * so the client edits it in WordPress. Defaults are copied into the options once (seeded),
 * after that a blank field hides the element.
 *
 * @package Armodafinil_Australia
 */

if ( ! function_exists( 'acf_add_options_sub_page' ) ) {
    return;
}

acf_add_options_sub_page( array(
    'page_title'  => 'Checkout & Thank-You',
    'menu_title'  => 'Checkout & Thank-You',
    'parent_slug' => 'theme-settings',
    'menu_slug'   => 'theme-settings-checkout',
) );

/**
 * Field definitions: name => [ label, type, default, instructions, group ].
 * Groups render as accordions in the admin.
 */
function armo_ck_definitions() {
    return array(
        'Bank Transfer Details' => array(
            'ck_payid'          => array( 'PayID', 'text', '0455 241 294', 'Shown first on the thank-you page. Leave blank to hide the PayID box.' ),
            'ck_account_name'   => array( 'Account Name', 'text', 'Sean Williams', '' ),
            'ck_bank_name'      => array( 'Bank', 'text', 'Commonwealth Bank', 'Name of the bank shown next to the account name.' ),
            'ck_account_number' => array( 'Account Number', 'text', '306528842', '' ),
            'ck_bsb'            => array( 'BSB', 'text', '923100', '' ),
        ),
        'Thank-You Page: Heading' => array(
            'ck_title' => array( 'Heading', 'text', 'Order Confirmed!', '' ),
            'ck_intro' => array( 'Intro Text', 'textarea', 'Thank you for your order. Please complete your payment using EFT or PayID below.', '' ),
        ),
        'Thank-You Page: Payment Box' => array(
            'ck_label_payment_details' => array( 'Section Heading', 'text', 'Payment Details', '' ),
            'ck_label_payid'           => array( 'Label: PayID', 'text', 'PayID', '' ),
            'ck_label_or_transfer'     => array( 'Text Before Bank Transfer', 'text', 'Or use bank transfer:', '' ),
            'ck_label_account_name'    => array( 'Label: Account Name', 'text', 'Account Name', '' ),
            'ck_label_bank'            => array( 'Label: Bank', 'text', 'Bank', '' ),
            'ck_label_account_number'  => array( 'Label: Account Number', 'text', 'Account Number', '' ),
            'ck_label_bsb'             => array( 'Label: BSB', 'text', 'BSB', '' ),
            'ck_label_amount'          => array( 'Label: Amount to Send', 'text', 'Amount to Send', '' ),
            'ck_copy_label'            => array( 'Copy Button', 'text', 'Copy', '' ),
            'ck_copied_label'          => array( 'Copied Message', 'text', 'Copied!', '' ),
        ),
        'Thank-You Page: Order Summary' => array(
            'ck_label_summary'  => array( 'Section Heading', 'text', 'Order Summary', '' ),
            'ck_label_order'    => array( 'Label: Order Number', 'text', 'Order Number:', '' ),
            'ck_label_date'     => array( 'Label: Date', 'text', 'Date:', '' ),
            'ck_label_method'   => array( 'Label: Payment Method', 'text', 'Payment Method:', '' ),
            'ck_label_contains' => array( 'Label: Order Contains', 'text', 'Order Contains:', '' ),
            'ck_label_billing'  => array( 'Heading: Billing Address', 'text', 'Billing address', '' ),
            'ck_label_shipping' => array( 'Heading: Shipping Address', 'text', 'Shipping address', '' ),
            'ck_label_total_due' => array( 'Label: Total Due', 'text', 'Total Due', '' ),
        ),
        'Thank-You Page: Button, Notes & Logos' => array(
            'ck_shop_button'    => array( 'Continue Shopping Button', 'text', 'Continue Shopping', '' ),
            'ck_note_shipping'  => array( 'Shipping Note', 'textarea', 'The average shipping time is 15-22 days. Please note that delivery may take up to 30 days from the date of dispatch due to potential disruptions in postal services caused by weather issues or natural disaster.', 'Shown with a yellow "Note" label. Leave blank to hide.' ),
            'ck_note_reference' => array( 'Payment Reference Warning', 'textarea', '<span class="text-red-600 font-bold">DO NOT</span> mention anything related to <span class="text-red-600 font-bold">medicine</span> or <span class="text-red-600 font-bold">website</span> name. Just mention your order number.', 'Red words use the span tags shown. Leave blank to hide the warning.' ),
            'ck_logo_bank'      => array( 'Bank Logo', 'image', '', 'Upload the bank logo. If empty, the theme default (Commonwealth Bank) is used.' ),
            'ck_logo_payid'     => array( 'PayID Logo', 'image', '', 'If empty, the theme default is used.' ),
            'ck_logo_osko'      => array( 'Osko Logo', 'image', '', 'If empty, the theme default is used.' ),
        ),
    );
}

function armo_ck_defaults() {
    $out = array();
    foreach ( armo_ck_definitions() as $fields ) {
        foreach ( $fields as $name => $def ) {
            $out[ $name ] = $def[2];
        }
    }
    return $out;
}

/**
 * Read a setting. Falls back to the default only until the seed has run.
 */
function armo_ck( $name ) {
    $value = function_exists( 'get_field' ) ? get_field( $name, 'option' ) : null;
    if ( ( null === $value || false === $value ) && ! get_option( 'armo_ck_seed_ver' ) ) {
        $defaults = armo_ck_defaults();
        return isset( $defaults[ $name ] ) ? $defaults[ $name ] : '';
    }
    return is_string( $value ) ? $value : ( is_array( $value ) ? $value : '' );
}

/** Image setting: uploaded image URL, or the theme default file. */
function armo_ck_logo_url( $name, $theme_file ) {
    $img = armo_ck( $name );
    if ( is_array( $img ) && ! empty( $img['url'] ) ) {
        return $img['url'];
    }
    return get_template_directory_uri() . '/assets/images/' . $theme_file;
}

add_action( 'acf/init', function () {
    $fields = array();
    $i      = 0;
    foreach ( armo_ck_definitions() as $group => $defs ) {
        $fields[] = array(
            'key'   => 'field_ck_acc_' . ++$i,
            'label' => $group,
            'type'  => 'accordion',
            'open'  => 1 === $i ? 1 : 0,
        );
        foreach ( $defs as $name => $def ) {
            $field = array(
                'key'          => 'field_' . $name,
                'label'        => $def[0],
                'name'         => $name,
                'type'         => $def[1],
                'instructions' => $def[3],
            );
            if ( 'image' === $def[1] ) {
                $field['return_format'] = 'array';
                $field['preview_size']  = 'thumbnail';
            } else {
                $field['default_value'] = $def[2];
            }
            if ( 'textarea' === $def[1] ) {
                $field['rows'] = 3;
            }
            $fields[] = $field;
        }
    }
    $fields[] = array( 'key' => 'field_ck_acc_end', 'label' => '', 'type' => 'accordion', 'endpoint' => 1 );

    acf_add_local_field_group( array(
        'key'      => 'group_armo_checkout_settings',
        'title'    => 'Checkout & Thank-You',
        'fields'   => $fields,
        'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'theme-settings-checkout' ) ) ),
    ) );
} );

/**
 * One-time seed: copy defaults into the options (account name, number, BSB and PayID come
 * from the existing WooCommerce bank account when there is one; the bank name is always the default,
 * Commonwealth Bank, because older accounts still say ING Bank), so the admin shows real values.
 */
add_action( 'init', function () {
    $ver = '20261115';
    if ( get_option( 'armo_ck_seed_ver' ) === $ver || ! function_exists( 'update_field' ) ) {
        return;
    }
    $defaults = armo_ck_defaults();
    $bacs     = get_option( 'woocommerce_bacs_accounts' );
    $acc      = ! empty( $bacs[0] ) ? $bacs[0] : array();
    $from_wc  = array(
        'ck_account_name'   => isset( $acc['account_name'] ) ? $acc['account_name'] : '',
        'ck_account_number' => isset( $acc['account_number'] ) ? $acc['account_number'] : '',
        'ck_bsb'            => isset( $acc['sort_code'] ) ? $acc['sort_code'] : '',
        'ck_payid'          => isset( $acc['iban'] ) ? $acc['iban'] : '',
    );
    foreach ( $defaults as $name => $default ) {
        if ( '' === $default ) {
            continue;
        }
        if ( null !== get_option( 'options_' . $name, null ) ) {
            continue; // never overwrite something already saved
        }
        $value = ! empty( $from_wc[ $name ] ) ? $from_wc[ $name ] : $default;
        update_field( $name, $value, 'option' );
    }
    update_option( 'armo_ck_seed_ver', $ver );
}, 31 );
