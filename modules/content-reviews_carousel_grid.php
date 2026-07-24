<?php
/**
 * Layout: Reviews Carousel Grid
 * Fields: heading (text)
 * Design: White bg, heading centered, 3-column layout on desktop (1 on mobile, 2 on tablet).
 *         Light background cards, blue borders, flex-column inner layout.
 */
$heading = get_sub_field('heading');
if (!$heading) $heading = 'Trusted by Everyday Australian\'s';

$reviews = new WP_Query(array(
    'post_type' => 'reviews',
    'posts_per_page' => 12,
    'post_status' => 'publish',
));

// Generate a unique ID for this carousel instance
$carousel_id = 'reviews-carousel-grid-' . uniqid();
?>
<section class="py-12 lg:py-16 bg-white relative overflow-hidden">
    <div class="max-w-[1200px] mx-auto px-6 md:px-12 relative">
        <?php if ($heading): ?>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-center mb-10 text-[#173062]">
                <?php echo esc_html($heading); ?>
            </h2>
        <?php endif; ?>

        <?php if ($reviews->have_posts()): ?>
            <div class="relative group">
                <!-- Left Arrow -->
                <div id="<?php echo $carousel_id; ?>-prev" role="button"
                    class="carousel-arrow absolute left-0 top-1/2 -mt-5 -ml-4 md:-ml-10 z-10 w-10 h-10 flex items-center justify-center text-primary hover:text-[#FF0000] cursor-pointer"
                    aria-label="Previous">
                    <svg class="w-8 h-8 md:w-10 md:h-10 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>

                <!-- Carousel Container -->
                <div id="<?php echo $carousel_id; ?>-container"
                    class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar w-full scroll-smooth">
                    <?php while ($reviews->have_posts()):
                        $reviews->the_post();
                        $rating = get_field('rating') ? get_field('rating') : 5;
                        $name = get_field('name') ? get_field('name') : get_the_title();
                        $content = get_the_content();
                        ?>
                        <!-- Card Wrapper: 1 col mobile, 2 col tablet, 3 col desktop -->
                        <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 snap-start px-3 py-2">
                            <!-- Card Content (Flex Column) -->
                            <div class="h-full bg-white border border-[#173062] rounded-md p-6 md:p-8 flex flex-col items-center text-center shadow-sm">
                                
                                <!-- Stars -->
                                <div class="text-xl leading-none tracking-[2px] text-[#0066CC] mb-3">
                                    <?php
                                    $r = intval($rating);
                                    echo str_repeat('★', $r);
                                    if (5 - $r > 0) {
                                        echo '<span class="text-gray-300">' . str_repeat('★', 5 - $r) . '</span>';
                                    }
                                    ?>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-semibold text-[#173062] mb-3">
                                    <?php echo esc_html(get_the_title()); ?>
                                </h3>

                                <!-- Content -->
                                <div class="text-gray-700 text-sm md:text-base leading-relaxed mb-4">
                                    <?php echo wp_kses_post(wpautop($content)); ?>
                                </div>

                                <!-- Author / Location -->
                                <div class="text-sm text-[#4da6e7]">
                                    <?php echo esc_html($name); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Right Arrow -->
                <div id="<?php echo $carousel_id; ?>-next" role="button"
                    class="carousel-arrow absolute right-0 top-1/2 -mt-5 -mr-4 md:-mr-10 z-10 w-10 h-10 flex items-center justify-center text-primary hover:text-[#FF0000] cursor-pointer"
                    aria-label="Next">
                    <svg class="w-8 h-8 md:w-10 md:h-10 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const container = document.getElementById('<?php echo $carousel_id; ?>-container');
                    const prevBtn = document.getElementById('<?php echo $carousel_id; ?>-prev');
                    const nextBtn = document.getElementById('<?php echo $carousel_id; ?>-next');

                    if (container && container.children.length > 0) {
                        // Arrow click listeners
                        prevBtn.addEventListener('click', () => {
                            // Scroll by the width of one card
                            const cardWidth = container.children[0].offsetWidth;
                            container.scrollBy({ left: -cardWidth, behavior: 'smooth' });
                        });

                        nextBtn.addEventListener('click', () => {
                            const cardWidth = container.children[0].offsetWidth;
                            container.scrollBy({ left: cardWidth, behavior: 'smooth' });
                        });
                    }
                });
            </script>

            <style>
                /* Hide scrollbar for Chrome, Safari and Opera */
                .hide-scrollbar::-webkit-scrollbar {
                    display: none;
                }
                /* Hide scrollbar for IE, Edge and Firefox */
                .hide-scrollbar {
                    -ms-overflow-style: none; /* IE and Edge */
                    scrollbar-width: none; /* Firefox */
                }
            </style>
        <?php else: ?>
            <p class="text-center text-gray-400 italic mt-6">No reviews found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
