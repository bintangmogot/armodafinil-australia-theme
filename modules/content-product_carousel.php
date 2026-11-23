<?php
/**
 * Layout: Product Carousel (Static 4-Product Grid)
 * Fields: heading (text), feature_product (relationship, return=object, post_type=product)
 * Design: Clean 4-column static grid on desktop (2-column on mobile), navy border around images, no carousel/arrows.
 */
$heading = get_sub_field('heading');
$products = get_sub_field('feature_product');
$products = ($products && is_array($products)) ? array_slice($products, 0, 4) : [];
?>

<section class="py-10 lg:py-14 pb-6 lg:pb-10 bg-white relative">
    <div class="max-w-[1140px] mx-auto px-4 md:px-6 relative">
        <?php if ($heading): ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center mb-10 text-primary"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if (!empty($products)): ?>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 items-stretch">
                <?php
                foreach ($products as $product):
                    $post_id = is_object($product) ? $product->ID : $product;
                    $wc_product = wc_get_product($post_id);

                    if ($wc_product):
                        $permalink = esc_url(get_permalink($post_id));
                        $name = armo_content($wc_product->get_name());
                        $price_html = $wc_product->get_price_html();
                        $image_html = $wc_product->get_image('woocommerce_thumbnail', array(
                            'class' => 'w-full h-auto aspect-square object-cover rounded-xl'
                        ));
                        ?>
                        <div class="w-full flex flex-col rounded-xl hover:bg-gray-50 transition-colors pb-3 md:pb-5 h-full">
                            <a href="<?php echo $permalink; ?>"
                                class="block w-full no-underline text-inherit flex-grow flex flex-col">
                                <div class="bg-white border border-primary rounded-xl relative p-4 mb-4 flex items-center justify-center min-h-[160px] md:min-h-[180px]">
                                    <?php echo $image_html; ?>
                                </div>

                                <div class="text-center px-1 flex-grow flex flex-col">
                                    <h3 class="text-sm md:text-lg font-bold text-[#1E1E1E] mb-1 leading-snug">
                                        <?php echo $name; ?>
                                    </h3>
                                    <div class="text-sm md:text-lg font-extrabold text-primary mb-1">
                                        <?php echo $price_html; ?>
                                    </div>
                                    <?php
                                    $price_subtext = get_field('price_subtext', $post_id);
                                    if (empty($price_subtext)) $price_subtext = 'From $1.45/tab';
                                    if ($price_subtext):
                                    ?>
                                        <div class="text-sm font-bold mb-3" style="color: #196C21;">
                                            <?php echo esc_html($price_subtext); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mt-auto pt-1">
                                        <span class="inline-flex items-center justify-center gap-1 md:gap-2 bg-[#ff0000] text-white py-2 px-3 md:px-6 rounded shadow-md font-bold text-sm md:text-base text-center hover:bg-red-600 transition-colors whitespace-nowrap">
                                            Buy Now
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endif;
                endforeach;
                ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-400 italic mt-6">No products selected.</p>
        <?php endif; ?>
    </div>
</section>