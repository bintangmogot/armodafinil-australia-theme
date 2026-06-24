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
        echo '<div class="armo-total-price-box mt-6 mb-4 bg-surface border border-[#ff0000] rounded-md p-4">';
        echo '<div class="text-xs text-primary font-semibold mb-1">Total Price</div>';
        echo '<div class="text-2xl font-bold text-primary" id="armo-dynamic-total">$0.00</div>';
        echo '</div>';
    }
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('custom-product-layout flex flex-col', $product); ?>>

    <!-- Top Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-[45%_55%] xl:grid-cols-[50%_50%] gap-10 lg:gap-16 mb-16">

        <!-- Left Column: Images & Features -->
        <div class="product-gallery-column flex flex-col w-full">
            <div class="w-full">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 * Outputs Product Images
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
            </div>
            <div style="clear: both; width: 100%;"></div>

            <!-- Feature Pills under the image -->
            <div class="grid grid-cols-2 gap-3 mt-4 w-full">
                <div
                    class="flex items-center justify-center gap-2 bg-surface border border-[#B3D4FF] text-primary font-bold text-sm py-2.5 px-4 rounded-md shadow-sm">
                    <svg class="w-4 h-4 text-green-500 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    100% Genuine
                </div>
                <div
                    class="flex items-center justify-center gap-2 bg-surface border border-[#B3D4FF] text-primary font-bold text-sm py-2.5 px-4 rounded-md shadow-sm">
                    <svg class="w-4 h-4 text-blue-500 fill-current" viewBox="0 0 20 20">
                        <path
                            d="M8 5a1 1 0 100 2h5.586l-1.293 1.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L13.586 5H8zM12 15a1 1 0 100-2H6.414l1.293-1.293a1 1 0 10-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L6.414 15H12z" />
                    </svg>
                    Easy Returns
                </div>
                <div
                    class="flex items-center justify-center gap-2 bg-surface border border-[#B3D4FF] text-primary font-bold text-sm py-2.5 px-4 rounded-md shadow-sm">
                    <span>🚚</span>
                    Fast Delivery
                </div>
                <div
                    class="flex items-center justify-center gap-2 bg-surface border border-[#B3D4FF] text-primary font-bold text-sm py-2.5 px-4 rounded-md shadow-sm">
                    <span>🔒</span>
                    Secure Payment
                </div>
            </div>
        </div>

        <!-- Right Column: Summary -->
        <div class="summary entry-summary">
            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             * Outputs Title, Price, Excerpt, Add to Cart
             */
            do_action('woocommerce_single_product_summary');
            ?>
        </div>
    </div>

    <!-- Custom Tabs Section -->
    <?php
    $description = get_the_content();
    $dosage = get_field('product_dosage');
    $shipping = get_field('product_shipping');
    $safety = get_field('product_safety');

    // We only show tabs if at least Description is present
    if ($description):
        ?>
        <div class="armo-product-tabs mt-8 mb-16">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-8 overflow-x-auto hide-scrollbar" aria-label="Tabs" id="product-tabs-nav">
                    <?php if ($description): ?>
                        <button
                            class="tab-btn active border-primary text-primary whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide"
                            data-target="tab-description">
                            Description
                        </button>
                    <?php endif; ?>
                    <?php if ($dosage): ?>
                        <button
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide"
                            data-target="tab-dosage">
                            Dosage & Direction
                        </button>
                    <?php endif; ?>
                    <?php if ($shipping): ?>
                        <button
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide"
                            data-target="tab-shipping">
                            Shipping & Returns
                        </button>
                    <?php endif; ?>
                    <?php if ($safety): ?>
                        <button
                            class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm uppercase tracking-wide"
                            data-target="tab-safety">
                            Safety & Side Effects
                        </button>
                    <?php endif; ?>
                </nav>
            </div>

            <div class="tab-content py-10" id="product-tabs-content">
                <?php if ($description): ?>
                    <div class="tab-pane active prose max-w-none text-primary-dark" id="tab-description">
                        <?php echo apply_filters('the_content', $description); ?>
                    </div>
                <?php endif; ?>
                <?php if ($dosage): ?>
                    <div class="tab-pane hidden prose max-w-none text-primary-dark" id="tab-dosage">
                        <?php echo wp_kses_post($dosage); ?>
                    </div>
                <?php endif; ?>
                <?php if ($shipping): ?>
                    <div class="tab-pane hidden prose max-w-none text-primary-dark" id="tab-shipping">
                        <?php echo wp_kses_post($shipping); ?>
                    </div>
                <?php endif; ?>
                <?php if ($safety): ?>
                    <div class="tab-pane hidden prose max-w-none text-primary-dark" id="tab-safety">
                        <?php echo wp_kses_post($safety); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Simple Script for Tabs -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tabs = document.querySelectorAll('.tab-btn');
                const panes = document.querySelectorAll('.tab-pane');

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        // Remove active from all tabs
                        tabs.forEach(t => {
                            t.classList.remove('active', 'border-primary', 'text-primary');
                            t.classList.add('border-transparent', 'text-gray-500');
                        });
                        // Hide all panes
                        panes.forEach(p => p.classList.add('hidden'));

                        // Add active to clicked tab
                        tab.classList.remove('border-transparent', 'text-gray-500');
                        tab.classList.add('active', 'border-primary', 'text-primary');

                        // Show corresponding pane
                        const targetId = tab.getAttribute('data-target');
                        document.getElementById(targetId).classList.remove('hidden');
                    });
                });
            });
        </script>
    <?php endif; ?>

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

if (have_rows('modules')) {
    while (have_rows('modules')) {
        the_row();
        get_template_part('modules/content', get_row_layout());
    }
}

// Re-open it to avoid breaking footer layout
echo '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">';
?>

<?php do_action('woocommerce_after_single_product'); ?>