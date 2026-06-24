<?php
require_once dirname(__DIR__, 3) . '/wp-load.php';

$categories = ['Peak Performance', 'Mind & Focus', 'Male Biohacking', 'Shift Work Support'];
$cat_ids = [];
foreach ($categories as $cat) {
    $term = term_exists($cat, 'category');
    if (!$term) {
        $term = wp_insert_term($cat, 'category');
    }
    $cat_ids[] = is_array($term) ? $term['term_id'] : $term;
}

$dummy_posts = [
    [
        'title' => 'Modafinil vs Other Nootropics: What Actually Works for Australians in 2026?',
        'content' => 'Modafinil isn\'t new. It\'s been around for years and was originally used for sleep-related conditions like narcolepsy. But today, Australians are increasingly turning to nootropics for cognitive enhancement. In this comprehensive guide, we compare Modafinil with other popular cognitive enhancers on the market.',
        'excerpt' => 'Modafinil isn\'t new. It\'s been around for years and was originally used for sleep-related conditions...',
        'cat' => $cat_ids[1] // Mind & Focus
    ],
    [
        'title' => 'How to Maximize Your Productivity During Night Shifts',
        'content' => 'Shift work can take a significant toll on your natural circadian rhythm. Here are the top strategies for maintaining peak performance and avoiding the dreaded 3 AM crash when working irregular hours.',
        'excerpt' => 'Shift work can take a significant toll on your natural circadian rhythm. Here are the top strategies for maintaining peak performance...',
        'cat' => $cat_ids[3] // Shift Work Support
    ],
    [
        'title' => 'The Ultimate Guide to Biohacking Your Morning Routine',
        'content' => 'Your morning routine sets the tone for the entire day. Discover the scientifically proven methods to biohack your mornings for sustained energy, laser focus, and optimal mental clarity.',
        'excerpt' => 'Your morning routine sets the tone for the entire day. Discover the scientifically proven methods to biohack your mornings...',
        'cat' => $cat_ids[2] // Male Biohacking
    ],
    [
        'title' => 'Understanding Armodafinil: Benefits, Dosage, and Timing',
        'content' => 'Armodafinil offers a smoother, longer-lasting cognitive boost compared to standard Modafinil. In this post, we break down the optimal dosage, the best time to take it, and what you can expect.',
        'excerpt' => 'Armodafinil offers a smoother, longer-lasting cognitive boost compared to standard Modafinil. In this post, we break down...',
        'cat' => $cat_ids[0] // Peak Performance
    ],
    [
        'title' => 'Beating Brain Fog: 5 Strategies That Actually Work',
        'content' => 'Brain fog can ruin your productivity and leave you feeling drained. We explore five actionable strategies, including diet adjustments, sleep optimization, and nootropic support, to clear your mind.',
        'excerpt' => 'Brain fog can ruin your productivity and leave you feeling drained. We explore five actionable strategies, including diet adjustments...',
        'cat' => $cat_ids[1] // Mind & Focus
    ],
    [
        'title' => 'Combining Nootropics: What You Need to Know',
        'content' => 'Stacking nootropics can amplify their effects, but it must be done carefully. Learn about the most effective and safest combinations for achieving peak cognitive performance without the jitters.',
        'excerpt' => 'Stacking nootropics can amplify their effects, but it must be done carefully. Learn about the most effective and safest combinations...',
        'cat' => $cat_ids[0] // Peak Performance
    ]
];

// Let's find an image ID to use as featured image
global $wpdb;
$attachment_id = $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID DESC LIMIT 1");

foreach ($dummy_posts as $p) {
    $post_id = wp_insert_post([
        'post_title'   => $p['title'],
        'post_content' => $p['content'],
        'post_excerpt' => $p['excerpt'],
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'post_category'=> [$p['cat']]
    ]);

    if ($post_id && $attachment_id) {
        set_post_thumbnail($post_id, $attachment_id);
    }
}

echo "Inserted 6 dummy posts successfully.\n";
