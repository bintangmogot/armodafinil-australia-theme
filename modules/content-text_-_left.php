<?php
/**
 * Layout: Text - Left Aligned
 * Fields: content (wysiwyg)
 * Design: White background, left-aligned text with dark navy headings
 */
$content = get_sub_field('content');
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-white">
    <div class="max-w-4xl mx-auto">
        <?php if ($content) : ?>
            <div class="module-text-left-content text-left text-[15px] lg:text-base text-[#1E1E1E] leading-relaxed">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php else : ?>
            <p class="text-[#1E1E1E] italic">[ Text Left Aligned module — add content in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
