<?php
/**
 * Layout: Reviews Carousel Grid
 * Fields: heading (text), selected_reviews (relationship -> reviews), button_text (text), button_link (text)
 * Design: Full-width white band, 3-column desktop carousel (2 tablet, 1 mobile), built-in CTA button directly below.
 */
$heading = get_sub_field('heading');
if (!$heading) {
    $heading = 'Trusted by Everyday Australians';
}

$selected_reviews = get_sub_field('selected_reviews');
$button_text = trim((string) get_sub_field('button_text'));
$button_link = trim((string) get_sub_field('button_link'));

if (!empty($selected_reviews) && is_array($selected_reviews)) {
    $review_ids = array_values(array_filter(array_map(function ($item) {
        return is_object($item) ? (int) $item->ID : (int) $item;
    }, $selected_reviews)));

    $reviews = new WP_Query(array(
        'post_type'      => 'reviews',
        'post__in'       => $review_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => count($review_ids),
        'post_status'    => 'publish',
    ));
} else {
    $reviews = new WP_Query(array(
        'post_type'      => 'reviews',
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'meta_query'     => array(
            'relation' => 'OR',
            array('key' => 'linked_product', 'compare' => 'NOT EXISTS'),
            array('key' => 'linked_product', 'value' => '', 'compare' => '='),
        ),
    ));
}

$carousel_id = 'reviews-carousel-grid-' . uniqid();
?>
<section class="py-12 lg:py-16 bg-white relative overflow-hidden">
    <div class="w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-10 relative">
        <?php if ($heading): ?>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-8 text-[#173062]">
                <?php echo esc_html($heading); ?>
            </h2>
        <?php endif; ?>

        <?php if ($reviews->have_posts()): ?>
            <div class="relative group px-0 md:px-12">
                <!-- Left Arrow -->
                <button type="button" id="<?php echo esc_attr($carousel_id); ?>-prev"
                    class="carousel-arrow absolute -left-3 md:left-0 top-1/2 -translate-y-1/2 z-10 w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/95 border border-primary/15 shadow-md flex items-center justify-center text-primary hover:text-[#FF0000] hover:border-[#FF0000]/30 cursor-pointer transition-colors"
                    aria-label="Previous reviews">
                    <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Carousel Track -->
                <div id="<?php echo esc_attr($carousel_id); ?>-container"
                    class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar w-full scroll-smooth py-2 <?php echo ($reviews->post_count < 3) ? 'lg:justify-center' : ''; ?>">
                    <?php while ($reviews->have_posts()):
                        $reviews->the_post();
                        $rating  = get_field('rating') ? get_field('rating') : 5;
                        $name    = get_field('name') ? get_field('name') : get_the_title();
                        $content = get_the_content();
                        ?>
                        <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 snap-start px-0 md:px-2.5 lg:px-3">
                            <div class="h-full bg-gradient-review rounded-2xl px-6 py-6 sm:p-7 lg:p-8 flex flex-col items-center text-center shadow-md">
                                <h3 class="text-lg font-bold text-white mb-1 leading-snug">
                                    <?php echo esc_html($name); ?>
                                </h3>

                                <div class="flex items-center gap-1 text-xs text-[#EAA800] font-bold mb-2">
                                    <span>Verified</span>
                                    <svg class="w-4 h-4 text-green-400 fill-current" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>

                                <div class="text-xl leading-none tracking-[2px] text-[#EAA800] mb-4">
                                    <?php
                                    $r = intval($rating);
                                    echo str_repeat('★', $r);
                                    if (5 - $r > 0) {
                                        echo '<span class="text-white/25">' . str_repeat('★', 5 - $r) . '</span>';
                                    }
                                    ?>
                                </div>

                                <h4 class="text-base font-bold text-white mb-2.5">
                                    <?php echo esc_html(get_the_title()); ?>
                                </h4>

                                <div class="text-white/90 text-sm md:text-base leading-relaxed [&>p:last-child]:mb-0">
                                    <?php echo wp_kses_post(wpautop($content)); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Right Arrow -->
                <button type="button" id="<?php echo esc_attr($carousel_id); ?>-next"
                    class="carousel-arrow absolute -right-3 md:right-0 top-1/2 -translate-y-1/2 z-10 w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/95 border border-primary/15 shadow-md flex items-center justify-center text-primary hover:text-[#FF0000] hover:border-[#FF0000]/30 cursor-pointer transition-colors"
                    aria-label="Next reviews">
                    <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <?php if ($button_text !== ''):
                $clean_label = rtrim($button_text, " \t\n\r\0\x0B>");
                $href = $button_link !== '' ? $button_link : '/reviews/';
                ?>
                <div class="mt-6 lg:mt-8 text-center">
                    <a href="<?php echo esc_url($href); ?>"
                        class="group inline-flex items-center justify-center gap-2 bg-[#FF0000] hover:bg-[#dc0000] text-white font-bold text-base lg:text-lg px-7 lg:px-10 py-3 lg:py-3.5 rounded-full no-underline shadow-md hover:shadow-lg transition-all">
                        <span class="whitespace-nowrap"><?php echo esc_html($clean_label); ?></span>
                        <svg class="w-5 h-5 flex-shrink-0 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const container = document.getElementById('<?php echo esc_js($carousel_id); ?>-container');
                    const prevBtn = document.getElementById('<?php echo esc_js($carousel_id); ?>-prev');
                    const nextBtn = document.getElementById('<?php echo esc_js($carousel_id); ?>-next');

                    if (container && prevBtn && nextBtn && container.children.length > 0) {
                        prevBtn.addEventListener('click', () => {
                            const cardWidth = container.children[0].offsetWidth;
                            container.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                        });

                        nextBtn.addEventListener('click', () => {
                            const cardWidth = container.children[0].offsetWidth;
                            if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                                container.scrollTo({ left: 0, behavior: 'smooth' });
                            } else {
                                container.scrollBy({ left: cardWidth, behavior: 'smooth' });
                            }
                        });
                    }
                });
            </script>

            <style>
                .hide-scrollbar::-webkit-scrollbar { display: none; }
                .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            </style>
        <?php else: ?>
            <p class="text-center text-gray-400 italic mt-6">No reviews found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
