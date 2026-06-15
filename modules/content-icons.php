<?php
/**
 * Layout: Icons
 * Fields: intro_content (wysiwyg), icons (repeater: icon (image, return=id), title (wysiwyg))
 */
$intro_content = get_sub_field('intro_content');
?>
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto">
        <?php if ($intro_content) : ?>
            <div class="prose prose-lg max-w-4xl mx-auto mb-10 text-center"><?php echo wp_kses_post($intro_content); ?></div>
        <?php endif; ?>
        
        <?php if (have_rows('icons')) : ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <?php while (have_rows('icons')) : the_row(); 
                    $icon  = get_sub_field('icon');  // Returns ID
                    $title = get_sub_field('title');  // Returns wysiwyg HTML
                ?>
                    <div class="text-center">
                        <?php if ($icon) : ?>
                            <div class="mb-3">
                                <?php echo wp_get_attachment_image($icon, 'thumbnail', false, array('class' => 'w-16 h-16 mx-auto')); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($title) : ?>
                            <div class="prose prose-sm mx-auto"><?php echo wp_kses_post($title); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ Icons module — add icon items in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
