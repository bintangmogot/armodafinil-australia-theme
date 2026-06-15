<?php
/**
 * Layout: Boxes
 * Fields: boxes (repeater: image (image, return=id), content (wysiwyg))
 */
?>
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if (have_rows('boxes')) : ?>
            <div class="grid md:grid-cols-3 gap-6">
                <?php while (have_rows('boxes')) : the_row();
                    $image   = get_sub_field('image');   // Returns ID
                    $content = get_sub_field('content');  // Returns wysiwyg HTML
                ?>
                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                        <?php if ($image) : ?>
                            <div class="aspect-video">
                                <?php echo wp_get_attachment_image($image, 'medium_large', false, array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                            <div class="p-5 prose prose-sm"><?php echo wp_kses_post($content); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ Boxes module — add box items in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
