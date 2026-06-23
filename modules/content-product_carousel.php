<?php
/**
 * Layout: Product Carousel
 * Fields: heading (text), feature_product (relationship, return=object, post_type=product)
 * Design: Carousel of products with left/right arrows on desktop, navy border around images only, "IN STOCK" badge
 */
$heading  = get_sub_field('heading');
$products = get_sub_field('feature_product');
// Generate a unique ID for this carousel instance
$carousel_id = 'carousel-' . uniqid();
?>

<section class="py-10 lg:py-14 pb-0 lg:pb-0 bg-white relative overflow-hidden">
    <!-- overflow-hidden on the section prevents horizontal scrollbar issues -->
    <div class="max-w-[1100px] mx-auto px-6 md:px-12 relative">
        <?php if ( $heading ) : ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center mb-10 text-primary"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <?php if ( $products && is_array($products) ) : ?>
            <div class="relative group">
                <!-- Left Arrow -->
                <button id="<?php echo $carousel_id; ?>-prev" class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 -ml-12 z-10 w-10 h-10 items-center justify-center text-primary hover:text-red-600 transition-colors" aria-label="Previous">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </button>

                <!-- Carousel Container -->
                <div id="<?php echo $carousel_id; ?>-container" class="flex overflow-x-auto gap-4 md:gap-6 pb-4 snap-x snap-mandatory w-full scroll-smooth">
                    <?php 
                    foreach ( $products as $product ) : 
                        $post_id = is_object( $product ) ? $product->ID : $product;
                        $wc_product = wc_get_product( $post_id );
                        
                        if ( $wc_product ) :
                            $permalink  = esc_url( get_permalink( $post_id ) );
                            $name       = armo_content( $wc_product->get_name() );
                            $price_html = $wc_product->get_price_html();
                            $image_html = $wc_product->get_image('woocommerce_thumbnail', array(
                                'class' => 'w-full h-auto object-contain max-h-[140px]'
                            ));
                            
                            $in_stock = $wc_product->is_in_stock();
                            ?>
                            <div class="w-[200px] md:w-[calc(25%-18px)] flex-shrink-0 snap-start flex flex-col pb-6">
                                <a href="<?php echo $permalink; ?>" class="group block w-full no-underline text-inherit flex-grow flex flex-col">
                                    <div class="bg-white border border-primary rounded-xl relative p-4 mb-4 flex items-center justify-center min-h-[160px] md:min-h-[180px] transition-all duration-300 group-hover:-translate-y-2 group-hover:shadow-[0_20px_40px_rgba(0,18,94,0.15)] group-hover:border-[#000a33]">
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
                                            <span class="inline-flex items-center justify-center gap-2 bg-[#ff0000] text-white py-2 px-6 rounded shadow-md font-bold text-base text-center hover:bg-red-600 transition-colors">
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

                <!-- Right Arrow -->
                <button id="<?php echo $carousel_id; ?>-next" class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 -mr-12 z-10 w-10 h-10 items-center justify-center text-primary hover:text-red-600 transition-colors" aria-label="Next">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const container = document.getElementById('<?php echo $carousel_id; ?>-container');
                    const prevBtn = document.getElementById('<?php echo $carousel_id; ?>-prev');
                    const nextBtn = document.getElementById('<?php echo $carousel_id; ?>-next');
                    
                    if(container && prevBtn && nextBtn && container.children.length > 0) {
                        prevBtn.addEventListener('click', () => {
                            // Calculate dynamically based on the first card's actual rendered width plus the gap (approx 24px)
                            const cardWidth = container.children[0].offsetWidth;
                            const gap = 24; // md:gap-6 is 24px
                            const scrollAmount = cardWidth + gap;
                            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                        });
                        
                        nextBtn.addEventListener('click', () => {
                            const cardWidth = container.children[0].offsetWidth;
                            const gap = 24;
                            const scrollAmount = cardWidth + gap;
                            
                            // Loop back to start if at the end
                            if (container.scrollLeft + container.clientWidth >= container.scrollWidth - 10) {
                                container.scrollTo({ left: 0, behavior: 'smooth' });
                            } else {
                                container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                            }
                        });

                        // Auto-scroll every 5 seconds
                        let autoScroll = setInterval(() => {
                            nextBtn.click();
                        }, 5000);

                        // Pause auto-scroll when interacting
                        container.addEventListener('mouseenter', () => clearInterval(autoScroll));
                        container.addEventListener('mouseleave', () => {
                            autoScroll = setInterval(() => {
                                nextBtn.click();
                            }, 5000);
                        });
                        container.addEventListener('touchstart', () => clearInterval(autoScroll), {passive: true});
                    }
                });
            </script>
            <style>
                /* Desktop: Hide completely */
                @media (min-width: 768px) {
                    #<?php echo $carousel_id; ?>-container::-webkit-scrollbar {
                        display: none;
                    }
                    #<?php echo $carousel_id; ?>-container {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
                }
            </style>
        <?php else : ?>
            <p class="text-center text-gray-400 italic mt-6">No products selected.</p>
        <?php endif; ?>
    </div>
</section>
