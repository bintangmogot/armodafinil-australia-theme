<?php
/**
 * Layout: Feature Product
 * Fields: heading (text), feature_product (relationship, return=object, post_type=product)
 * Design: White bg, heading centered, product cards in 4-column grid with rounded corners, navy border around images only, "IN STOCK" badge
 */
$heading  = get_sub_field('heading');
$products = get_sub_field('feature_product');
?>

<section class="py-10 lg:py-14 px-6 lg:px-16 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <?php if ( $heading ) : ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center mb-10 text-primary"><?php echo esc_html( $heading ); ?></h2>
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
                        $name       = wp_kses_post( $wc_product->get_name() );
                        $price_html = $wc_product->get_price_html();
                        $image_html = $wc_product->get_image('woocommerce_thumbnail', array(
                            'class' => 'w-full h-auto object-contain max-h-[140px]'
                        ));
                        
                        $in_stock = $wc_product->is_in_stock();
                        ?>
                        <div class="min-w-[200px] lg:min-w-0 flex-shrink-0 lg:flex-shrink snap-start flex flex-col">
                            <a href="<?php echo $permalink; ?>" class="block w-full no-underline text-inherit flex-grow flex flex-col">
                                <div class="bg-white border border-primary rounded-xl relative p-4 mb-4 flex items-center justify-center min-h-[160px] md:min-h-[180px]">
                                    <?php if ( $in_stock ) : ?>
                                        <div class="absolute top-2 left-2 bg-[#1e7e34] text-white text-[10px] font-bold px-2 py-1 rounded">
                                            IN STOCK
                                        </div>
                                    <?php endif; ?>
                                    <?php echo $image_html; ?>
                                </div>
                                
                                <div class="text-center px-1 flex-grow flex flex-col">
                                    <h3 class="text-base md:text-lg font-bold text-[#1E1E1E] mb-1 leading-snug">
                                        <?php echo $name; ?>
                                    </h3>
                                    <div class="text-base md:text-lg font-extrabold text-primary mb-3">
                                        <?php echo $price_html; ?>
                                    </div>
                                    <div class="mt-auto">
                                        <span class="inline-flex items-center justify-center gap-2 bg-[#ff0000] text-white py-2 px-6 rounded shadow-md font-bold text-base text-center hover:bg-red-700 transition-colors">
                                            Buy Now 
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
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
        <?php else : ?>
            <p class="text-center text-gray-400 italic mt-6">No products selected.</p>
        <?php endif; ?>
    </div>
</section>
