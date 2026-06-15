<?php
/**
 * Layout: Text - Full Width
 * Fields: content (wysiwyg)
 * Design: White background, centered text with dark navy headings
 */
$content = get_sub_field('content');
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-white">
    <div class="max-w-4xl mx-auto text-center">
        <?php if ($content) : ?>
            <div class="module-fulltext-content">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ Text Full Width module — add content in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
