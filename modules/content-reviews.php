<?php
/**
 * Layout: Reviews
 * Fields: heading (text) — queries 'reviews' CPT for display
 * Design: White bg, heading centered, review cards in 2-col grid with stars and names
 */
$heading = get_sub_field('heading');
$reviews = new WP_Query(array(
    'post_type'      => 'reviews',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
));
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-white">
    <div class="max-w-5xl mx-auto">
        <?php if ($heading) : ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center text-primary-dark mb-10"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($reviews->have_posts()) : ?>
            <div class="grid md:grid-cols-2 gap-6">
                <?php while ($reviews->have_posts()) : $reviews->the_post(); 
                    $rating = get_field('rating');
                    $name   = get_field('name');
                ?>
                    <div class="bg-[#f5f7fb] rounded-2xl p-6 border border-primary-dark/5 hover:shadow-md transition-shadow">
                        <?php if ($rating) : ?>
                            <div class="flex gap-1 mb-3">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-accent' : 'text-gray-200'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                        <?php endif; ?>
                        <h4 class="text-base font-bold text-primary-dark mb-2"><?php echo esc_html( get_the_title() ); ?></h4>
                        <div class="text-base text-primary-dark/70 leading-relaxed mb-4"><?php the_content(); ?></div>
                        <?php if ($name) : ?>
                            <p class="text-base font-bold text-primary-dark">— <?php echo esc_html($name); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">No reviews found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
