<?php
/**
 * Layout: Feature Product
 * Fields: heading (text), feature_product (relationship, return=object, post_type=product)
 * Design: White bg, heading centered, product cards in 4-column grid with rounded corners and shadow
 */
$heading  = get_sub_field('heading');
$products = get_sub_field('feature_product');
?>

<section class="py-10 lg:py-14 px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <?php if ( $heading ) : ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center mb-2 text-[#0a1045]"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <?php if ( $products && is_array($products) ) : ?>
            <!-- Horizontal scroll on mobile, grid on desktop -->
            <div class="flex overflow-x-auto gap-4 lg:gap-6 pb-4 mt-8 lg:mt-10 snap-x snap-mandatory -mx-6 px-6 lg:mx-0 lg:px-0 lg:grid lg:grid-cols-4 lg:overflow-visible">
                <?php 
                foreach ( $products as $product ) : 
                    $post_id = is_object( $product ) ? $product->ID : $product;
                    $wc_product = wc_get_product( $post_id );
                    
                    if ( $wc_product ) :
                        $permalink  = esc_url( get_permalink( $post_id ) );
                        $name       = esc_html( $wc_product->get_name() );
                        $price_html = $wc_product->get_price_html();
                        $image_html = $wc_product->get_image('woocommerce_thumbnail', array(
                            'class' => 'w-full h-auto object-contain'
                        ));
                        ?>
                        <div class="min-w-[260px] lg:min-w-0 snap-start bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col">
                            <a href="<?php echo $permalink; ?>" class="block no-underline text-inherit flex-grow">
                                <div class="bg-gray-50 rounded-xl p-4 mb-4 flex items-center justify-center min-h-[160px]">
                                    <?php echo $image_html; ?>
                                </div>
                                <h3 class="text-sm lg:text-base font-bold text-[#0a1045] mb-2 min-h-[40px] leading-tight">
                                    <?php echo $name; ?>
                                </h3>
                                <div class="text-lg font-extrabold text-[#0a1045] mb-4">
                                    <?php echo $price_html; ?>
                                </div>
                            </a>
                            <a href="<?php echo $permalink; ?>" class="block w-full bg-[#0a1045] text-white py-3 rounded-xl font-bold text-sm text-center hover:bg-[#1a2a6c] transition-colors no-underline mt-auto">
                                View Options
                            </a>
                        </div>
                    <?php 
                    endif; 
                endforeach; 
                ?>
            </div>
        <?php else : ?>
            <p class="text-center text-gray-400 italic mt-6">No products selected.</p>
        <?php endif; ?>
    </div>
</section>
