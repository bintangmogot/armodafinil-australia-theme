<?php
/**
 * Layout: Review Page
 * Fields: (none) — displays reviews from the 'reviews' custom post type
 */
$reviews = new WP_Query(array(
    'post_type'      => 'reviews',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
));
?>
<section class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <?php if ($reviews->have_posts()) : ?>
            <div class="space-y-6">
                <?php while ($reviews->have_posts()) : $reviews->the_post(); 
                    $rating = get_field('rating');
                    $name   = get_field('name');
                ?>
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <?php if ($rating) : ?>
                            <div class="flex gap-1 mb-2">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                        <div class="prose prose-sm"><?php the_content(); ?></div>
                        <?php if ($name) : ?>
                            <p class="mt-3 text-sm font-semibold text-gray-900">— <?php echo esc_html($name); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">No reviews yet.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
