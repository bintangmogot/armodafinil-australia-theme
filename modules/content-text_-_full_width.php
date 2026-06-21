<?php
/**
 * Layout: Text - Full Width
 * Fields: content (wysiwyg)
 * Design: White background, centered text with dark navy headings
 */
$content = get_sub_field('content');
$background_color = get_sub_field('background_color');
?>
<section class="py-6 lg:py-12 px-6 lg:px-12 <?php echo $background_color ? '' : 'bg-surface'; ?>" <?php if($background_color) echo 'style="background-color: ' . esc_attr($background_color) . ';"'; ?>>
    <div class="max-w-4xl mx-auto text-center">
        <?php if ($content) : ?>
            <div class="module-fulltext-content prose max-w-none">
                <?php echo armo_content($content); ?>
            </div>
        <?php else : ?>
            <p class="text-[#1E1E1E] text-center italic">[ Text Full Width module — add content in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
