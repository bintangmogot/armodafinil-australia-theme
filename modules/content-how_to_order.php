<?php
/**
 * Layout: How to Order
 * Fields: intro (wysiwyg), how_to_order (repeater: icon (image, return=url), content (text))
 * Design: White bg, heading centered, 3 steps with numbered yellow circles and connecting dotted lines
 */
$intro = get_sub_field('intro');
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-white">
    <div class="max-w-5xl mx-auto">
        <?php if ($intro) : ?>
            <div class="module-howto-intro text-center mb-12 lg:mb-16 max-w-3xl mx-auto">
                <?php echo wp_kses_post($intro); ?>
            </div>
        <?php endif; ?>
        
        <?php if (have_rows('how_to_order')) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12 relative">
                <!-- Connecting line (desktop only) -->
                <div class="hidden md:block absolute top-10 left-[20%] right-[20%] h-0.5 border-t-2 border-dashed border-[#0a1045]/20"></div>

                <?php $step = 1; while (have_rows('how_to_order')) : the_row();
                    $icon    = get_sub_field('icon');
                    $content = get_sub_field('content');
                ?>
                    <div class="text-center relative z-10">
                        <!-- Step number circle -->
                        <?php if ($icon) : ?>
                            <div class="w-20 h-20 mx-auto mb-5 rounded-full overflow-hidden bg-yellow-400 flex items-center justify-center shadow-lg shadow-yellow-400/30">
                                <img src="<?php echo esc_url($icon); ?>" alt="Step <?php echo $step; ?>" class="w-10 h-10 object-contain">
                            </div>
                        <?php else : ?>
                            <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-yellow-400 flex items-center justify-center shadow-lg shadow-yellow-400/30">
                                <span class="text-2xl font-extrabold text-[#0a1045]"><?php echo $step; ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($content) : ?>
                            <p class="text-sm lg:text-base text-[#0a1045]/80 leading-relaxed max-w-[240px] mx-auto"><?php echo esc_html($content); ?></p>
                        <?php endif; ?>
                    </div>
                <?php $step++; endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ How to Order module — add steps in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
