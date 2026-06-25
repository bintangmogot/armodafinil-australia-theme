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
        echo '<div class="armo-total-price-box mt-1 mb-1 bg-gradient-to-r from-[#FFF6EA] to-[#E1EDFF] border border-[#ff0000] rounded-[5px] p-4">';
        echo '<div class="text-xs text-primary font-semibold mb-1">Total Price</div>';
        echo '<div class="text-2xl font-bold text-gray-900" id="armo-dynamic-total">$0.00</div>';
        echo '</div>';
    }
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class('custom-product-layout flex flex-col max-w-5xl mx-auto w-full', $product); ?>>

    <!-- Top Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-[45%_55%] xl:grid-cols-[50%_50%] gap-10 lg:gap-16 mb-6 lg:mb-16">

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

            <!-- Feature Pills under the image (Desktop Only) -->
            <div class="hidden lg:block mt-4 w-full">
                <?php armo_feature_pills(); ?>
            </div>
        </div>

        <!-- Right Column: Summary -->
        <div class="summary entry-summary bg-white shadow-md rounded-xl p-6 lg:p-0 lg:bg-transparent lg:shadow-none lg:rounded-none">
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
        <div class="armo-product-tabs mt-2 lg:mt-8 mb-16">
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