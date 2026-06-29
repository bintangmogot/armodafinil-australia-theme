<?php
/**
 * Check the Options group location and if footer fields exist elsewhere
 */
require_once dirname(__FILE__, 4) . '/wp-load.php';
global $wpdb;

// Get the Options group content (post_content has the location rules)
$group = $wpdb->get_row("SELECT ID, post_title, post_content FROM {$wpdb->posts} WHERE ID = 37");
echo "=== Options Group (ID 37) ===\n";
echo "Title: {$group->post_title}\n";
$content = maybe_unserialize($group->post_content);
echo "Location: " . print_r($content, true) . "\n";

// Search for any field with 'footer' in the name across ALL groups
echo "\n=== All fields with 'footer' in name ===\n";
$footer_fields = $wpdb->get_results("
    SELECT p.ID, p.post_title, p.post_name, p.post_excerpt, p.post_parent,
           parent.post_title as group_title
    FROM {$wpdb->posts} p
    LEFT JOIN {$wpdb->posts} parent ON p.post_parent = parent.ID
    WHERE p.post_type = 'acf-field'
    AND (p.post_excerpt LIKE '%footer%' OR p.post_title LIKE '%footer%' OR p.post_name LIKE '%footer%')
");
foreach ($footer_fields as $f) {
    echo "ID: {$f->ID} | Title: {$f->post_title} | Key: {$f->post_name} | Name: {$f->post_excerpt} | Parent: {$f->group_title} (ID: {$f->post_parent})\n";
}

// Check if group_theme_footer key exists in postmeta
echo "\n=== Checking for group_theme_footer in postmeta ===\n";
$meta = $wpdb->get_results("
    SELECT post_id, meta_key, meta_value 
    FROM {$wpdb->postmeta} 
    WHERE meta_value LIKE '%group_theme_footer%'
    LIMIT 10
");
foreach ($meta as $m) {
    echo "Post ID: {$m->post_id} | Key: {$m->meta_key} | Value: {$m->meta_value}\n";
}
