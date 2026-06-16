<?php
/**
 * Layout: Why Buy From Us
 * Fields: heading (text), intro (wysiwyg), features (repeater: icon (image), title (text), content (textarea))
 * Design: White background section with a 3x2 grid of light blue cards.
 */

$heading = get_sub_field('heading');
$intro   = get_sub_field('intro');
?>
<section class="py-16 lg:py-24 px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="max-w-3xl mb-12">
            <?php if ($heading) : ?>
                <h2 class="text-3xl lg:text-4xl font-bold text-[#00125E] mb-4 leading-tight">
                    <?php echo esc_html( $heading ); ?>
                </h2>
            <?php else : ?>
                <h2 class="text-3xl lg:text-4xl font-bold text-[#00125E] mb-4 leading-tight">
                    Why Buy From Armodafinil Australia?
                </h2>
            <?php endif; ?>

            <?php if ($intro) : ?>
                <div class="prose prose-lg text-[#00125E]/80 leading-relaxed max-w-none">
                    <?php echo wp_kses_post( $intro ); ?>
                </div>
            <?php else : ?>
                <div class="text-[#00125E]/80 text-base md:text-lg leading-relaxed">
                    <p class="mb-2">Looking to buy Armodafinil online in Australia without the stress?</p>
                    <p>Thousands of Australians choose Armodafinil Australia for premium Armodafinil tablets, fast Australia-wide shipping, discreet packaging, and trusted customer support.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <?php if ( have_rows('features') ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                <?php while ( have_rows('features') ) : the_row();
                    $icon    = get_sub_field('icon');
                    $title   = get_sub_field('title');
                    $content = get_sub_field('content');
                    
                    $icon_url = '';
                    if ($icon) {
                        if (is_array($icon) && isset($icon['url'])) {
                            $icon_url = $icon['url'];
                        } elseif (is_numeric($icon)) {
                            $icon_url = wp_get_attachment_image_url($icon, 'thumbnail');
                        } elseif (is_string($icon)) {
                            $icon_url = $icon;
                        }
                    }
                ?>
                    <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                        <?php if ($icon_url) : ?>
                            <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0">
                                <img src="<?php echo esc_url($icon_url); ?>" alt="" class="h-full w-auto object-contain">
                            </div>
                        <?php endif; ?>
                        
                        <div>
                            <?php if ($title) : ?>
                                <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">
                                    <?php echo esc_html($title); ?>
                                </h3>
                            <?php endif; ?>
                            
                            <?php if ($content) : ?>
                                <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">
                                    <?php echo esc_html($content); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <!-- Fallback content if ACF fields are empty -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <!-- Card 1 -->
                <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0 text-[#00125E]">
                        <!-- Australia Icon SVG placeholder -->
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">Australia-Focused Service</h3>
                        <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">We built our platform specifically for Australian customers. Pricing, support, shipping, and product selections are tailored for Australia-wide delivery.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0 text-[#00125E]">
                        <!-- Discreet Shipping SVG -->
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">Discreet Shipping</h3>
                        <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">All orders are packed discreetly for privacy and convenience.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0 text-[#00125E]">
                        <!-- Premium Quality Badge SVG -->
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">Premium Quality Products</h3>
                        <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">We stock trusted Armodafinil brands sourced from reputable manufacturers with strong global reputations.</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0 text-[#00125E]">
                        <!-- Fast Dispatch Truck SVG -->
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2" />
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                            <circle cx="5.5" cy="18.5" r="2.5" />
                            <circle cx="18.5" cy="18.5" r="2.5" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">Fast Dispatch</h3>
                        <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">Orders are processed quickly to minimise delays and keep delivery times consistent.</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0 text-[#00125E]">
                        <!-- Secure Ordering Shield SVG -->
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">Secure Ordering Process</h3>
                        <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">Our checkout process is simple, secure, and designed to make ordering stress-free.</p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="bg-[#EAF2FF] rounded-2xl p-6 lg:p-8 hover:shadow-lg hover:shadow-[#00125E]/5 hover:scale-[1.01] transition-all duration-300 flex flex-col items-start gap-4">
                    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-start flex-shrink-0 text-[#00125E]">
                        <!-- Support Headset SVG -->
                        <svg class="w-full h-full" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-xl font-bold text-[#00125E] mb-2 leading-snug">Responsive Support Team</h3>
                        <p class="text-[#00125E]/80 text-sm md:text-base leading-relaxed">We stock trusted Armodafinil brands sourced from reputable manufacturers with strong global reputations.</p>
                    </div>
                </div>

            </div>
        <?php endif; ?>
    </div>
</section>
