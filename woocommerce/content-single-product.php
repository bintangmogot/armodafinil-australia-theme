<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template has been highly customized for Armodafinil Australia to match the Figma design.
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

// Remove default WooCommerce actions we don't need
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Add "Total Price" box after quantity input, before the add to cart button
add_action('woocommerce_after_add_to_cart_quantity', 'armo_custom_total_price_box', 10);
function armo_custom_total_price_box()
{
    global $product;
    if ($product->is_type('variable')) {
        // We will update this dynamically via JS
        echo '<div class="armo-total-price-box mt-0 mb-1 bg-gradient-to-r from-[#FFF6EA] to-[#E1EDFF] border border-[#ff0000] rounded-[5px] p-2 md:p-3">';
        echo '<div class="text-[11px] md:text-xs text-primary font-semibold mb-0.5">Total Price</div>';
        echo '<div class="text-xl md:text-2xl font-bold text-gray-900" id="armo-dynamic-total">$0.00</div>';
        echo '</div>';
    }
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('custom-product-layout flex flex-col max-w-7xl mx-auto w-full', $product); ?>>

    <!-- Top Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-[40%_60%] gap-4 lg:gap-8 mb-0 lg:mb-8 items-start">

        <!-- Left Column: Images & Features -->
        <div class="product-gallery-column hidden lg:flex flex-col w-full gap-y-4">
            <div class="w-full">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 * Outputs Product Images
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
            </div>

            <!-- Feature Pills under the image (Desktop Only) -->
            <div class="hidden lg:block w-full bg-white shadow-lg rounded-xl p-5">
                <?php armo_feature_pills(); ?>
            </div>
        </div>

        <!-- Right Column: Summary -->
        <div class="summary entry-summary lg:bg-white lg:shadow-md lg:rounded-xl lg:p-6">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             * Outputs Title, Price, Excerpt, Add to Cart
             */
            do_action('woocommerce_single_product_summary');
            ?>
        </div>
    </div>

    <!-- Custom Tabs Section (Description + ACF Repeater "extra_tabs") -->
    <?php
    global $product;
    $product_id  = $product->get_id();
    $description = get_the_content();
    $extra_tabs  = get_field('extra_tabs', $product_id); // ACF Repeater: tab_title (Text), tab_content (WYSIWYG)

    // Show tabs if at least Description or extra tabs exist
    if ($description || $extra_tabs):
        ?>
        <div class="armo-product-tabs mt-0 lg:mt-8 mb-16">
            <!-- Tab Navigation -->
            <div class="armo-tabs-nav-wrapper">
                <nav class="armo-tabs-nav" aria-label="Product Tabs" id="product-tabs-nav">
                    <?php if ($description): ?>
                        <button
                            class="armo-tab-btn"
                            data-target="tab-description"
                            type="button">
                            Description
                        </button>
                    <?php endif; ?>
                    <?php if ($extra_tabs): ?>
                        <?php foreach ($extra_tabs as $index => $tab): ?>
                            <button
                                class="armo-tab-btn"
                                data-target="tab-extra-<?php echo $index; ?>"
                                type="button">
                                <?php echo esc_html($tab['tab_title']); ?>
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </nav>
            </div>

            <!-- Tab Content Panels -->
            <div class="armo-tabs-content" id="product-tabs-content">
                <?php if ($description): ?>
                    <div class="armo-tab-pane prose max-w-none text-primary-dark" id="tab-description">
                        <?php echo apply_filters('the_content', $description); ?>
                    </div>
                <?php endif; ?>
                <?php if ($extra_tabs): ?>
                    <?php foreach ($extra_tabs as $index => $tab): ?>
                        <div class="armo-tab-pane prose max-w-none text-primary-dark" id="tab-extra-<?php echo $index; ?>">
                            <?php echo wp_kses_post($tab['tab_content']); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tabs Interaction Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tabBtns = document.querySelectorAll('.armo-tab-btn');
                const tabPanes = document.querySelectorAll('.armo-tab-pane');

                tabBtns.forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        // Deactivate all tabs
                        tabBtns.forEach(function (b) { b.classList.remove('active'); });
                        // Hide all panes
                        tabPanes.forEach(function (p) { p.classList.remove('active'); });

                        // Activate clicked tab
                        btn.classList.add('active');

                        // Show corresponding pane
                        var targetId = btn.getAttribute('data-target');
                        var targetPane = document.getElementById(targetId);
                        if (targetPane) {
                            targetPane.classList.add('active');
                        }
                    });
                });

                // Auto-open the very first tab by default
                if (tabBtns.length > 0) {
                    tabBtns[0].click();
                }
            });
        </script>
    <?php endif; ?>

    <?php
    /**
     * Product-Specific Reviews Section
     * Queries Reviews CPT where linked_product matches current product.
     */
    $review_query = new WP_Query(array(
        'post_type'      => 'reviews',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'linked_product',
                'value'   => $product_id,
                'compare' => '=',
            ),
        ),
    ));

    // Get total reviews & average for this product
    $all_product_reviews = new WP_Query(array(
        'post_type'      => 'reviews',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => 'linked_product',
                'value'   => $product_id,
                'compare' => '=',
            ),
        ),
    ));
    $total_product_reviews = $all_product_reviews->found_posts;
    $total_rating = 0;
    $valid_ratings = 0;
    if ($all_product_reviews->have_posts()) {
        while ($all_product_reviews->have_posts()) {
            $all_product_reviews->the_post();
            $r = get_field('rating');
            if ($r) {
                $total_rating += intval($r);
                $valid_ratings++;
            }
        }
        wp_reset_postdata();
    }
    $average_rating = $valid_ratings > 0 ? round($total_rating / $valid_ratings, 1) : 5.0;
    $shown_count = min(5, $total_product_reviews);
    ?>

    <!-- Product Reviews Section -->
    <div class="armo-product-reviews mt-8 lg:mt-12 mb-8" id="product-reviews-section" data-product-id="<?php echo esc_attr($product_id); ?>">
        <h2 class="text-2xl lg:text-3xl font-bold text-primary mb-8 pb-4 border-b border-primary/10">
            Customer Reviews
        </h2>

        <?php if ($total_product_reviews > 0) : ?>
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-16">
            <!-- Left Side: Aggregate Score -->
            <div class="lg:w-1/4 flex flex-col">
                <div class="text-xs text-gray-500 mb-6 uppercase tracking-wider font-semibold" id="product-reviews-count-display">
                    Showing <?php echo esc_html($shown_count); ?> of <?php echo esc_html($total_product_reviews); ?> reviews
                </div>

                <div class="flex flex-row lg:flex-col items-center lg:items-start gap-4">
                    <div class="text-6xl font-bold text-primary leading-none">
                        <?php echo number_format($average_rating, 1); ?>
                    </div>
                    <div>
                        <div class="mb-2 text-2xl leading-none tracking-[4px] text-accent">
                            <?php
                            $r = intval(round($average_rating));
                            echo str_repeat('★', $r);
                            if (5 - $r > 0) {
                                echo '<span class="text-gray-300">' . str_repeat('★', 5 - $r) . '</span>';
                            }
                            ?>
                        </div>
                        <div class="text-base font-medium text-gray-600">
                            From <?php echo esc_html($total_product_reviews); ?> reviews
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Reviews List -->
            <div class="lg:w-3/4 flex flex-col gap-6" id="product-reviews-wrapper">
                <div id="product-reviews-container" class="flex flex-col gap-6">
                    <?php if ($review_query->have_posts()) : ?>
                        <?php while ($review_query->have_posts()) : $review_query->the_post();
                            $rating = get_field('rating') ? get_field('rating') : 5;
                            $name   = get_field('name') ? get_field('name') : get_the_title();
                            $content = get_the_content();
                        ?>
                            <div class="bg-gradient-review rounded-2xl p-4 md:p-8 shadow-md text-white">
                                <div class="grid grid-cols-1 md:grid-cols-[200px_auto_1fr] gap-4 md:gap-8 items-center">
                                    <!-- Left side: Name, Verified, Stars -->
                                    <div class="flex flex-col items-center md:items-start text-center md:text-left">
                                        <h3 class="text-lg md:text-xl font-bold text-white mb-1"><?php echo esc_html($name); ?></h3>

                                        <div class="flex items-center gap-1 text-xs text-accent font-bold mb-3">
                                            <span>Verified</span>
                                            <svg class="w-4 h-4 text-accent fill-current" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>

                                        <div class="text-xl leading-none tracking-[4px] text-accent">
                                            <?php
                                            $r = intval($rating);
                                            echo str_repeat('★', $r);
                                            if (5 - $r > 0) {
                                                echo '<span class="text-white/25">' . str_repeat('★', 5 - $r) . '</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <!-- Divider (desktop only) -->
                                    <div class="hidden md:block w-[1px] h-20 bg-white/20 self-stretch"></div>

                                    <!-- Divider (mobile only) -->
                                    <div class="md:hidden w-full h-[1px] bg-white/20"></div>

                                    <!-- Right side: Title + Content -->
                                    <div class="text-white/90 text-sm md:text-base leading-relaxed text-center md:text-left">
                                        <h4 class="text-xl font-extrabold text-white mb-2"><?php echo esc_html(get_the_title()); ?></h4>
                                        <?php echo wp_kses_post(wpautop($content)); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

                <!-- Load More -->
                <?php if ($review_query->max_num_pages > 1) : ?>
                <div id="product-reviews-pagination" class="mt-8 flex flex-col items-center">
                    <div class="text-base text-gray-500 mb-4 font-semibold">
                        Showing <?php echo esc_html($shown_count); ?> of <?php echo esc_html($total_product_reviews); ?> reviews
                    </div>
                    <button type="button" id="product-reviews-load-more"
                        class="group inline-flex items-center gap-2 bg-[#FF0000] text-white font-bold py-4 px-10 rounded-full hover:bg-red-600 transition-colors"
                        data-page="1"
                        data-product-id="<?php echo esc_attr($product_id); ?>">
                        Load More
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php else : ?>
            <p class="text-gray-400 italic mb-4">No reviews yet. Be the first to review this product!</p>
        <?php endif; ?>

        <!-- Review Form -->
        <div class="mt-12 bg-primary rounded-2xl py-14 px-6 lg:px-12">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-10">
                    Leave a Review 🙏
                </h2>

                <div class="bg-surface rounded-2xl p-8 lg:p-12 text-left shadow-xl max-w-2xl mx-auto">
                    <form id="armo-product-review-form" method="POST" class="flex flex-col gap-6">
                        <?php wp_nonce_field( 'armo_submit_review', 'armo_review_nonce' ); ?>
                        <input type="hidden" name="action" value="armo_submit_review">
                        <input type="hidden" name="review_product_id" value="<?php echo esc_attr($product_id); ?>">
                        <input type="hidden" name="review_rating" id="product-review-rating-value" value="5">

                        <!-- Rating -->
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Your overall rating *</label>
                            <div id="product-star-rating-selector" class="whitespace-nowrap">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    echo '<span data-rating="' . $i . '" class="product-star-icon text-3xl text-accent cursor-pointer transition-colors leading-none select-none inline-block mr-2">★</span>';
                                }
                                ?>
                            </div>
                        </div>

                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Title of your review *</label>
                            <input type="text" name="review_title" placeholder="Enter your title" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-primary transition-colors" required>
                        </div>

                        <!-- Review Content -->
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Your review *</label>
                            <textarea name="review_content" placeholder="Write your review" rows="4" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-primary transition-colors resize-none" required></textarea>
                        </div>

                        <!-- Grid for Name and Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-bold text-primary mb-2">Your name *</label>
                                <input type="text" name="review_name" placeholder="Enter your name" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-primary transition-colors" required>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-bold text-primary mb-2">Your email address *</label>
                                <input type="email" name="review_email" placeholder="Enter your email" class="w-full bg-white border border-gray-200 rounded-lg px-4 py-3 text-gray-700 focus:outline-none focus:border-primary transition-colors" required>
                            </div>
                        </div>

                        <!-- Success / Error Messages -->
                        <div id="product-review-form-message" class="hidden rounded-lg p-4 text-sm font-medium text-center"></div>

                        <!-- Submit Button -->
                        <div class="mt-4 text-center">
                            <button type="submit" id="product-review-submit-btn" class="bg-[#FF0000] text-white font-bold py-4 px-10 rounded-full hover:bg-red-600 transition-colors w-full md:w-auto">
                                Submit your review
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Reviews Scripts -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Load More Reviews ──
        var reviewsWrapper = document.getElementById('product-reviews-wrapper');
        if (reviewsWrapper) {
            reviewsWrapper.addEventListener('click', function(e) {
                var loadMoreBtn = e.target.closest('#product-reviews-load-more');
                if (!loadMoreBtn) return;

                e.preventDefault();

                var currentPage = parseInt(loadMoreBtn.getAttribute('data-page')) + 1;
                var productId = loadMoreBtn.getAttribute('data-product-id');
                var originalHTML = loadMoreBtn.innerHTML;

                // Loading state
                loadMoreBtn.innerHTML = 'Loading... <svg class="animate-spin w-5 h-5 ml-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>';
                loadMoreBtn.style.pointerEvents = 'none';

                var formData = new FormData();
                formData.append('action', 'armo_load_product_reviews');
                formData.append('product_id', productId);
                formData.append('page', currentPage);

                fetch('<?php echo esc_url(admin_url("admin-ajax.php")); ?>', {
                    method: 'POST',
                    body: formData,
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.success && data.data.html) {
                        document.getElementById('product-reviews-container').insertAdjacentHTML('beforeend', data.data.html);
                        loadMoreBtn.setAttribute('data-page', currentPage);

                        // Update counts
                        var countDisplay = document.getElementById('product-reviews-count-display');
                        if (countDisplay) {
                            countDisplay.innerHTML = 'Showing ' + data.data.shown + ' of ' + data.data.total + ' reviews';
                        }
                        var paginationText = loadMoreBtn.previousElementSibling;
                        if (paginationText) {
                            paginationText.textContent = 'Showing ' + data.data.shown + ' of ' + data.data.total + ' reviews';
                        }

                        if (!data.data.has_more) {
                            document.getElementById('product-reviews-pagination').innerHTML =
                                '<div class="text-base text-gray-500 font-semibold">Showing all ' + data.data.total + ' reviews</div>';
                        } else {
                            loadMoreBtn.innerHTML = originalHTML;
                            loadMoreBtn.style.pointerEvents = 'auto';
                        }
                    }
                })
                .catch(function() {
                    loadMoreBtn.innerHTML = originalHTML;
                    loadMoreBtn.style.pointerEvents = 'auto';
                });
            });
        }

        // ── Star Rating Selector (Product Review Form) ──
        var stars = document.querySelectorAll('#product-star-rating-selector .product-star-icon');
        var ratingInput = document.getElementById('product-review-rating-value');
        var currentRating = 5;

        function updateProductStars(rating) {
            stars.forEach(function(star) {
                var starRating = parseInt(star.getAttribute('data-rating'));
                if (starRating <= rating) {
                    star.classList.add('text-[#EAA800]');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.remove('text-[#EAA800]');
                    star.classList.add('text-gray-300');
                }
            });
        }

        stars.forEach(function(star) {
            star.addEventListener('click', function() {
                currentRating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = currentRating;
                updateProductStars(currentRating);
            });
            star.addEventListener('mouseenter', function() {
                updateProductStars(parseInt(this.getAttribute('data-rating')));
            });
            star.addEventListener('mouseleave', function() {
                updateProductStars(currentRating);
            });
        });

        // ── Product Review Form Submission ──
        var form = document.getElementById('armo-product-review-form');
        var submitBtn = document.getElementById('product-review-submit-btn');
        var messageDiv = document.getElementById('product-review-form-message');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';
                messageDiv.classList.add('hidden');

                var formData = new FormData(form);

                fetch('<?php echo esc_url(admin_url("admin-ajax.php")); ?>', {
                    method: 'POST',
                    body: formData,
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    messageDiv.classList.remove('hidden');
                    if (data.success) {
                        messageDiv.className = 'rounded-lg p-4 text-sm font-medium text-center bg-green-100 text-green-800 border border-green-200';
                        messageDiv.textContent = data.data.message;
                        form.reset();
                        currentRating = 5;
                        updateProductStars(5);
                        ratingInput.value = 5;
                    } else {
                        messageDiv.className = 'rounded-lg p-4 text-sm font-medium text-center bg-red-100 text-red-800 border border-red-200';
                        messageDiv.textContent = data.data.message || 'Something went wrong. Please try again.';
                    }
                })
                .catch(function() {
                    messageDiv.classList.remove('hidden');
                    messageDiv.className = 'rounded-lg p-4 text-sm font-medium text-center bg-red-100 text-red-800 border border-red-200';
                    messageDiv.textContent = 'Connection error. Please try again.';
                })
                .finally(function() {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit your review';
                });
            });
        }
    });
    </script>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     */
    do_action('woocommerce_after_single_product_summary');
    ?>


</div>

<?php
/**
 * Render ACF Flexible Content Modules (Reviews Carousel, Featured Products, FAQs, etc.)
 * This appears FULL WIDTH below the entire product.
 */
// Close the max-w-7xl wrapper from inc/woocommerce.php temporarily so modules can be full width
echo '</div>';

if (have_rows('modules', $product_id)) {
    while (have_rows('modules', $product_id)) {
        the_row();
        get_template_part('modules/content', get_row_layout());
    }
}

// Re-open it to avoid breaking footer layout
echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">';
?>

<?php do_action('woocommerce_after_single_product'); ?>