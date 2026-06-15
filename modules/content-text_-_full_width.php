<?php
/**
 * Layout: Text - Full Width
 * TODO: Build this module's design
 */
$content = get_sub_field('content');
?>
<section class="py-12 px-4">
    <div class="max-w-4xl mx-auto prose prose-lg">
        <?php if ($content) : ?>
            <?php echo wp_kses_post($content); ?>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ Text Full Width module — add content in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
