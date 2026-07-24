<?php
/**
 * Bulk Assign Existing Reviews to Products (One-Time Script)
 *
 * HOW TO USE:
 * 1. Upload this file to your theme directory (it's already there)
 * 2. Add this line temporarily to your functions.php:
 *    require_once get_template_directory() . '/bulk-assign-reviews.php';
 * 3. As a logged-in admin, visit any page with ?armo_bulk_assign_reviews=1
 * 4. After running, REMOVE the require_once line from functions.php
 * 5. Delete this file
 *
 * This distributes all unassigned reviews evenly across all published products.
 */

function armo_bulk_assign_reviews_to_products() {
    // Only run when explicitly triggered by admin
    if ( ! isset($_GET['armo_bulk_assign_reviews']) || $_GET['armo_bulk_assign_reviews'] !== '1' ) {
        return;
    }

    // Must be admin
    if ( ! current_user_can('manage_options') ) {
        wp_die('Unauthorized.');
    }

    // Get all published products
    $products = get_posts(array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ));

    if ( empty($products) ) {
        wp_die('No products found.');
    }

    // Get all reviews that don't have a linked_product yet
    $reviews = new WP_Query(array(
        'post_type'      => 'reviews',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'linked_product',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => 'linked_product',
                'value'   => '',
                'compare' => '=',
            ),
            array(
                'key'     => 'linked_product',
                'value'   => '0',
                'compare' => '=',
            ),
        ),
    ));

    if ( ! $reviews->have_posts() ) {
        wp_die('No unassigned reviews found. All reviews already have a product linked.');
    }

    // Shuffle products for random distribution
    shuffle($products);
    $product_count = count($products);
    $assigned = 0;
    $index = 0;

    $output = '<h2>Bulk Assign Reviews - Results</h2><ul>';

    while ($reviews->have_posts()) {
        $reviews->the_post();
        $review_id = get_the_ID();
        $review_title = get_the_title();

        // Round-robin assignment across products
        $target_product_id = $products[$index % $product_count];
        $product_title = get_the_title($target_product_id);

        update_field('linked_product', $target_product_id, $review_id);

        $output .= '<li>Review #' . $review_id . ' "' . esc_html($review_title) . '" &rarr; Product #' . $target_product_id . ' "' . esc_html($product_title) . '"</li>';

        $assigned++;
        $index++;
    }
    wp_reset_postdata();

    $output .= '</ul>';
    $output .= '<p><strong>Done!</strong> Assigned ' . $assigned . ' reviews across ' . $product_count . ' products.</p>';
    $output .= '<p style="color:red;"><strong>Now remove the require_once line from functions.php and delete this file.</strong></p>';

    wp_die($output, 'Bulk Assign Reviews', array('response' => 200));
}
add_action('template_redirect', 'armo_bulk_assign_reviews_to_products');
