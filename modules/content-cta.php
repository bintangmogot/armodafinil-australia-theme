<?php
/**
 * Layout: CTA
 * Fields: content (wysiwyg)
 */
$content = get_sub_field('content');
?>
<section class="py-16 px-4 bg-blue-600 text-white">
    <div class="max-w-3xl mx-auto text-center">
        <?php if ($content) : ?>
            <div class="prose prose-invert prose-lg mx-auto"><?php echo wp_kses_post($content); ?></div>
        <?php else : ?>
            <p class="text-blue-200 italic">[ CTA module — add content in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
