<?php
/**
 * Layout: City Header
 * Fields: heading, subheading, content, delivery_text, button_text, button_link
 */
$heading = get_sub_field('heading');
$subheading = get_sub_field('subheading');
$content = get_sub_field('content');
$delivery_text = get_sub_field('delivery_text');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');
?>
<section class="py-12 lg:py-16 px-6 lg:px-12 bg-[#E1EDFF]">
    <div class="max-w-4xl mx-auto text-center">
        <?php if ($heading) : ?>
            <h1 class="text-2xl md:text-3xl font-bold text-[#00125E] mb-2"><?php echo esc_html($heading); ?></h1>
        <?php endif; ?>
        
        <?php if ($subheading) : ?>
            <h2 class="text-xl md:text-2xl font-bold text-[#00125E] mb-6"><?php echo esc_html($subheading); ?></h2>
        <?php endif; ?>

        <?php if ($content) : ?>
            <div class="module-city-header-content text-[#00125E] text-[15px] md:text-base leading-relaxed space-y-4 mb-8">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php endif; ?>

        <?php if ($delivery_text) : ?>
            <div class="flex items-center justify-center gap-2 font-bold text-[#00125E] mb-4">
                <span class="text-lg">⏱️</span> 
                <span><?php echo esc_html($delivery_text); ?></span>
            </div>
        <?php endif; ?>

        <?php if ($button_text && $button_link) : ?>
            <a href="<?php echo esc_url($button_link); ?>" class="inline-flex items-center justify-center gap-2 bg-[#ff0000] hover:bg-red-700 text-white font-bold text-sm md:text-base px-6 md:px-8 py-3 rounded-md transition-colors shadow-md no-underline">
                <?php echo esc_html($button_text); ?>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        <?php endif; ?>
    </div>
</section>
