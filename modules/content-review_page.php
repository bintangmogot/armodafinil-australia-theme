<?php
/**
 * Layout: Review Page
 * Fields: heading (text)
 * Design: Left column for aggregate score, Right column for stacked review cards.
 */

$heading = get_sub_field('heading');
if ( ! $heading ) {
    $heading = 'Customer Reviews';
}

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$reviews = new WP_Query(array(
    'post_type'      => 'reviews',
    'posts_per_page' => 20,
    'paged'          => $paged,
    'post_status'    => 'publish',
));

// Calculate average rating and total
$all_reviews = new WP_Query(array(
    'post_type'      => 'reviews',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
));
$total_reviews = $all_reviews->found_posts;
$total_rating = 0;
$valid_ratings = 0;
if ($all_reviews->have_posts()) {
    while ($all_reviews->have_posts()) {
        $all_reviews->the_post();
        $r = get_field('rating');
        if ($r) {
            $total_rating += intval($r);
            $valid_ratings++;
        }
    }
    wp_reset_postdata();
}
$average_rating = $valid_ratings > 0 ? round($total_rating / $valid_ratings, 1) : 5.0;

// Pagination calculations
$start_count = ( ( $paged - 1 ) * 20 ) + 1;
$end_count   = min( $start_count + 20 - 1, $total_reviews );
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-[#f5f7fb]">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl lg:text-4xl font-bold text-primary mb-12 pb-4 border-b border-primary/10">
            <?php echo esc_html( $heading ); ?>
        </h1>

        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">
            <!-- Left Side: Aggregate Score -->
            <div class="lg:w-1/4 flex flex-col">
                <div class="text-xs text-gray-500 mb-6 uppercase tracking-wider font-semibold">
                    <?php echo esc_html( $start_count ); ?> TO <?php echo esc_html( $end_count ); ?> FROM <?php echo esc_html( $total_reviews ); ?>
                </div>

                <div class="flex flex-row lg:flex-col items-center lg:items-start gap-4">
                    <div class="text-6xl font-bold text-primary leading-none">
                        <?php echo number_format($average_rating, 1); ?>
                    </div>
                    <div>
                        <div class="flex gap-1 mb-2">
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <svg class="w-6 h-6 <?php echo $i <= round($average_rating) ? 'text-[#EAA800] fill-current' : 'text-gray-300 fill-current'; ?>" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <div class="text-base font-medium text-gray-600">
                            From <?php echo esc_html( $total_reviews ); ?> reviews
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Reviews List -->
            <div class="lg:w-3/4 flex flex-col gap-6">
                <?php if ( $reviews->have_posts() ) : ?>
                    <?php while ( $reviews->have_posts() ) : $reviews->the_post(); 
                        $rating = get_field('rating') ? get_field('rating') : 5;
                        $name   = get_field('name') ? get_field('name') : get_the_title();
                        $content = get_the_content();
                    ?>
                        <div class="bg-primary rounded-2xl p-6 md:p-8 shadow-md text-white">
                            <div class="grid grid-cols-1 md:grid-cols-[200px_auto_1fr] gap-6 md:gap-8 items-center">
                                <!-- Left side: Name, Verified, Stars -->
                                <div class="flex flex-col items-center md:items-start text-center md:text-left">
                                    <h3 class="text-lg md:text-xl font-bold text-white mb-1"><?php echo esc_html($name); ?></h3>
                                    
                                    <div class="flex items-center gap-1 text-xs text-[#EAA800] font-bold mb-3">
                                        <span>Verified</span>
                                        <svg class="w-4 h-4 text-[#EAA800] fill-current" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    
                                    <div class="flex gap-1">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="w-5 h-5 <?php echo $i <= $rating ? 'text-[#EAA800] fill-current' : 'text-white/25 fill-current'; ?>" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
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
                                    <h4 class="text-base md:text-lg font-bold text-white mb-2"><?php echo esc_html( get_the_title() ); ?></h4>
                                    <?php echo armo_content(wpautop($content)); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                    <!-- Pagination / Load More -->
                    <div class="mt-8 flex flex-col items-center">
                        <div class="text-base text-gray-500 mb-4 font-semibold">
                            <?php echo esc_html( $start_count ); ?> TO <?php echo esc_html( $end_count ); ?> FROM <?php echo esc_html( $total_reviews ); ?>
                        </div>
                        <?php if ( $reviews->max_num_pages > $paged ) : ?>
                            <a href="<?php echo esc_url( get_pagenum_link( $paged + 1 ) ); ?>" class="inline-flex items-center gap-2 bg-[#d61e1e] text-white font-bold py-4 px-10 rounded-full hover:bg-red-700 transition-colors">
                                Load More
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <p class="text-gray-500 italic">No reviews found.</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>
