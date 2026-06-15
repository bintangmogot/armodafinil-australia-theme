<?php
/**
 * Layout: How to Order
 * Fields: intro (wysiwyg), how_to_order (repeater: icon (image, return=url), content (text))
 */
$intro = get_sub_field('intro');
?>
<section class="py-12 px-4">
    <div class="max-w-4xl mx-auto">
        <?php if ($intro) : ?>
            <div class="prose prose-lg max-w-3xl mx-auto mb-10 text-center"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>
        
        <?php if (have_rows('how_to_order')) : ?>
            <div class="grid md:grid-cols-3 gap-8">
                <?php $step = 1; while (have_rows('how_to_order')) : the_row();
                    $icon    = get_sub_field('icon');    // Returns URL
                    $content = get_sub_field('content'); // Returns text
                ?>
                    <div class="text-center">
                        <?php if ($icon) : ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="Step <?php echo $step; ?>" class="w-16 h-16 mx-auto mb-4">
                        <?php else : ?>
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg mx-auto mb-4"><?php echo $step; ?></div>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                            <p class="text-gray-700"><?php echo esc_html($content); ?></p>
                        <?php endif; ?>
                    </div>
                <?php $step++; endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ How to Order module — add steps in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
