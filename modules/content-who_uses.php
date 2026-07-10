<?php
/**
 * Layout: Who Uses Armodafinil
 * Fields: heading (text), intro (wysiwyg), users (repeater: title (text), image (image))
 * Design: Solid blue background, grid of light blue cards (4 cols on desktop, 2 cols on mobile) with white borders.
 */

$heading = get_sub_field('heading');
$intro   = get_sub_field('intro');
?>
<section class="py-16 px-6 lg:px-12 bg-gradient-review text-white">
    <div class="max-w-7xl mx-auto">
        
        <!-- Section Header -->
        <div class="max-w-3xl mb-12">
            <?php if ($heading) : ?>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                    <?php echo esc_html($heading); ?>
                </h2>
            <?php else : ?>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4 leading-tight">
                    Who Uses Armodafinil?
                </h2>
            <?php endif; ?>

            <?php if ($intro) : ?>
                <div class="module-who-uses-content text-white text-opacity-90 leading-relaxed max-w-none">
                    <?php echo armo_content($intro); ?>
                </div>
            <?php else : ?>
                <p class="text-white text-opacity-90 text-base md:text-lg leading-relaxed">
                    Armodafinil is commonly used by Australians with demanding schedules, including:
                </p>
            <?php endif; ?>
        </div>

        <!-- Cards Grid -->
        <?php if (have_rows('users')) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-6">
                <?php while (have_rows('users')) : the_row(); 
                    $title = get_sub_field('title');
                    $image = get_sub_field('image');

                    $image_url = '';
                    if ($image) {
                        if (is_array($image) && isset($image['url'])) {
                            $image_url = $image['url'];
                        } elseif (is_numeric($image)) {
                            $image_url = wp_get_attachment_image_url($image, 'large');
                        } elseif (is_string($image)) {
                            $image_url = $image;
                        }
                    }
                ?>
                    <div class="bg-surface-dark border-2 border-white rounded-2xl p-3 md:p-4 flex flex-col items-center gap-3 text-primary shadow-lg hover:shadow-white/5 hover:scale-[1.02] transition-all duration-300">
                        <?php if ($title) : ?>
                            <span class="text-base md:text-lg font-bold text-center leading-snug">
                                <?php echo esc_html($title); ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php if ($image_url) : ?>
                            <div class="w-full aspect-[4/3] overflow-hidden rounded-xl bg-primary/5">
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover">
                            </div>
                        <?php else : ?>
                            <div class="w-full aspect-[4/3] bg-gray-200/50 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">
                                [ Add Image ]
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <!-- Fallback content if ACF fields are empty -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">FIFO workers</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 2 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">Shift workers</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 3 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">Business owner</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 4 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">University students</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 5 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">Designers & creatives</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 6 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">Truck drivers</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 7 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">Remote workers</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

                <!-- Card 8 -->
                <div class="bg-surface-dark border-2 border-white rounded-2xl p-4 flex flex-col items-center gap-3 text-primary shadow-lg">
                    <span class="text-base md:text-lg font-bold text-center leading-snug">Software developers</span>
                    <div class="w-full aspect-[4/3] bg-primary/10 rounded-xl flex items-center justify-center text-gray-500 italic text-xs">[ Image ]</div>
                </div>

            </div>
        <?php endif; ?>

    </div>
</section>

<style>
.module-who-uses-content p {
    color: rgba(255, 255, 255, 0.8) !important;
}
</style>
