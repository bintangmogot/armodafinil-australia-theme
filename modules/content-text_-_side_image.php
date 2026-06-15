<?php
/**
 * Layout: Text - Side Image
 * Fields: image (image, return_format=id), content (wysiwyg)
 */
$image   = get_sub_field('image');
$content = get_sub_field('content');
?>
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8 items-center">
        <div class="prose prose-lg">
            <?php echo $content ? wp_kses_post($content) : '<p class="text-gray-400 italic">[ Text content — add in ACF ]</p>'; ?>
        </div>
        <div>
            <?php if ($image) : ?>
                <?php echo wp_get_attachment_image($image, 'large', false, array('class' => 'w-full rounded-lg')); ?>
            <?php else : ?>
                <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center text-gray-400 italic">[ Image — add in ACF ]</div>
            <?php endif; ?>
        </div>
    </div>
</section>
