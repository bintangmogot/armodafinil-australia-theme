<?php
/**
 * Layout: Featured Blog
 * Fields: intro_content (wysiwyg), selected_posts (relationship -> post)
 */
$intro_content = get_sub_field('intro_content');
$selected_posts = get_sub_field('selected_posts');

if (!empty($selected_posts) && is_array($selected_posts)) {
    $post_ids = array_values(array_filter(array_map(function ($item) {
        return is_object($item) ? (int) $item->ID : (int) $item;
    }, $selected_posts)));

    $recent = new WP_Query(array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'post__in'       => $post_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => count($post_ids),
    ));
} else {
    $recent = new WP_Query(array('posts_per_page' => 3, 'post_type' => 'post', 'post_status' => 'publish', 'tag' => 'featured'));
    // Fallback to latest posts if no "featured" tag
    if (!$recent->have_posts()) {
        $recent = new WP_Query(array('posts_per_page' => 3, 'post_type' => 'post', 'post_status' => 'publish'));
    }
}
?>
<section class="py-12 lg:py-16 px-6 lg:px-12 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <?php if ($intro_content): ?>
            <div class="prose prose-lg max-w-4xl mx-auto mb-10 text-center [&_h1]:text-3xl [&_h1]:lg:text-4xl [&_h1]:font-extrabold [&_h1]:text-primary [&_h2]:text-3xl [&_h2]:lg:text-4xl [&_h2]:font-extrabold [&_h2]:text-primary [&_h3]:text-3xl [&_h3]:lg:text-4xl [&_h3]:font-extrabold [&_h3]:text-primary"><?php echo armo_content($intro_content); ?>
            </div>
        <?php endif; ?>
        <?php if ($recent->have_posts()): ?>
            <div class="grid md:grid-cols-3 gap-6">
                <?php while ($recent->have_posts()):
                    $recent->the_post(); ?>
                    <?php get_template_part( 'template-parts/content' ); ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>