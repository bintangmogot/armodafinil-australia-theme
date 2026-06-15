<?php
/**
 * Layout: Benefit
 * Fields: intro (wysiwyg), benefit (repeater: icon (image, return=id), content (wysiwyg))
 */
$intro = get_sub_field('intro');
?>
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if ($intro) : ?>
            <div class="prose prose-lg max-w-4xl mx-auto mb-10"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>
        
        <?php if (have_rows('benefit')) : ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while (have_rows('benefit')) : the_row();
                    $icon    = get_sub_field('icon');    // Returns ID
                    $content = get_sub_field('content'); // Returns wysiwyg HTML
                ?>
                    <div class="bg-green-50 rounded-lg p-6 flex gap-4">
                        <?php if ($icon) : ?>
                            <div class="flex-shrink-0">
                                <?php echo wp_get_attachment_image($icon, 'thumbnail', false, array('class' => 'w-12 h-12')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                            <div class="prose prose-sm"><?php echo wp_kses_post($content); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ Benefit module — add benefits in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
