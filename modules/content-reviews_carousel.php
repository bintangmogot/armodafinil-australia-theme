<?php
/**
 * Layout: Reviews Carousel
 * Fields: heading (text) — queries 'reviews' CPT for display in a carousel
 * Design: White bg, heading centered, review card with dark blue bg, white text, vertical separator line, stars, verified badge
 */
$heading = get_sub_field('heading');
$reviews = new WP_Query(array(
    'post_type' => 'reviews',
    'posts_per_page' => 8,
    'post_status' => 'publish',
));

// Generate a unique ID for this carousel instance
$carousel_id = 'reviews-carousel-' . uniqid();
?>
<section class="py-3 lg:py-6 bg-white relative overflow-hidden">
    <div class="max-w-[1000px] mx-auto px-6 md:px-16 relative">
        <?php if ($heading): ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center mb-5 lg:mb-7 text-primary">
                <?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($reviews->have_posts()): ?>
            <div class="relative group">
                <!-- Left Arrow -->
                <button id="<?php echo $carousel_id; ?>-prev"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -ml-8 md:-ml-12 z-10 w-10 h-10 flex items-center justify-center text-primary hover:text-red-600 transition-colors"
                    aria-label="Previous">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <!-- Carousel Container -->
                <div id="<?php echo $carousel_id; ?>-container"
                    class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar w-full scroll-smooth">
                    <?php while ($reviews->have_posts()):
                        $reviews->the_post();
                        $rating = get_field('rating') ? get_field('rating') : 5;
                        $name = get_field('name') ? get_field('name') : get_the_title();
                        $content = get_the_content();
                        ?>
                        <div class="w-full flex-shrink-0 snap-start px-2">
                            <div class="bg-gradient-review rounded-2xl p-6 md:p-8 shadow-lg text-white">
                                <!-- Desktop Grid / Mobile Stack -->
                                <div class="grid grid-cols-1 md:grid-cols-[1.2fr_auto_2fr] gap-6 md:gap-8 items-center">
                                    <!-- Left side: Name, Verified, Stars -->
                                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                                        <h3 class="text-lg md:text-xl font-bold text-white mb-1"><?php echo esc_html($name); ?>
                                        </h3>

                                        <div class="flex items-center gap-1 text-xs text-[#EAA800] font-bold mb-3">
                                            <span>Verified</span>
                                            <svg class="w-4 h-4 text-green-400 fill-current" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>

                                        <div class="flex gap-1">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-accent fill-current' : 'text-white/25 fill-current'; ?>"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                    <!-- Divider (desktop only) -->
                                    <div class="hidden md:block w-[1px] h-20 bg-white/20 self-stretch"></div>

                                    <!-- Divider (mobile only) -->
                                    <div class="md:hidden w-full h-[1px] bg-white/20"></div>

                                    <!-- Right side: Title + Content -->
                                    <div class="text-white text-base md:text-lg leading-relaxed text-center md:text-left">
                                        <h4 class="text-base md:text-lg font-bold text-white mb-2">
                                            <?php echo esc_html(get_the_title()); ?></h4>
                                        <?php echo armo_content(wpautop($content)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Right Arrow -->
                <button id="<?php echo $carousel_id; ?>-next"
                    class="absolute right-0 top-1/2 -translate-y-1/2 -mr-8 md:-mr-12 z-10 w-10 h-10 flex items-center justify-center text-primary hover:text-red-600 transition-colors"
                    aria-label="Next">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Pagination dots -->
            <div id="<?php echo $carousel_id; ?>-dots" class="flex justify-center gap-2 mt-6">
                <!-- Will be populated by JS -->
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const container = document.getElementById('<?php echo $carousel_id; ?>-container');
                    const prevBtn = document.getElementById('<?php echo $carousel_id; ?>-prev');
                    const nextBtn = document.getElementById('<?php echo $carousel_id; ?>-next');
                    const dotsContainer = document.getElementById('<?php echo $carousel_id; ?>-dots');

                    if (container && container.children.length > 0) {
                        const slides = Array.from(container.children);
                        const slideCount = slides.length;

                        // Create dots
                        slides.forEach((_, index) => {
                            const dot = document.createElement('button');
                            dot.className = `w-2 h-2 rounded-full transition-all duration-300 ${index === 0 ? 'bg-primary' : 'bg-[#B0C0D6]'}`;
                            dot.setAttribute('aria-label', `Go to slide ${index + 1}`);
                            dot.addEventListener('click', () => {
                                container.scrollTo({
                                    left: container.offsetWidth * index,
                                    behavior: 'smooth'
                                });
                            });
                            dotsContainer.appendChild(dot);
                        });

                        const dots = Array.from(dotsContainer.children);

                        // Update active dot on scroll
                        container.addEventListener('scroll', () => {
                            const scrollPosition = container.scrollLeft;
                            const slideWidth = container.offsetWidth;
                            const activeIndex = Math.round(scrollPosition / slideWidth);

                            dots.forEach((dot, index) => {
                                if (index === activeIndex) {
                                    dot.classList.add('bg-primary');
                                    dot.classList.remove('bg-[#B0C0D6]');
                                } else {
                                    dot.classList.remove('bg-primary');
                                    dot.classList.add('bg-[#B0C0D6]');
                                }
                            });
                        });

                        // Arrow click listeners
                        prevBtn.addEventListener('click', () => {
                            container.scrollBy({ left: -container.offsetWidth, behavior: 'smooth' });
                        });

                        nextBtn.addEventListener('click', () => {
                            container.scrollBy({ left: container.offsetWidth, behavior: 'smooth' });
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
                    -ms-overflow-style: none;
                    /* IE and Edge */
                    scrollbar-width: none;
                    /* Firefox */
                }
            </style>
        <?php else: ?>
            <p class="text-center text-gray-400 italic mt-6">No reviews found.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>