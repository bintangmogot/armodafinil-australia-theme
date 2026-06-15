<?php
/**
 * Layout: Tips
 * Fields: content_left_title (text), content_left (wysiwyg), content_right_title (text), content_right (wysiwyg)
 */
$left_title  = get_sub_field('content_left_title');
$left        = get_sub_field('content_left');
$right_title = get_sub_field('content_right_title');
$right       = get_sub_field('content_right');
?>
<section class="py-12 px-4">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-8">
        <!-- Left Column -->
        <div>
            <?php if ($left_title) : ?>
                <h2 class="text-2xl font-bold text-gray-900 mb-4"><?php echo esc_html($left_title); ?></h2>
            <?php endif; ?>
            <?php if ($left) : ?>
                <div class="prose"><?php echo wp_kses_post($left); ?></div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column -->
        <div>
            <?php if ($right_title) : ?>
                <h2 class="text-2xl font-bold text-gray-900 mb-4"><?php echo esc_html($right_title); ?></h2>
            <?php endif; ?>
            <?php if ($right) : ?>
                <div class="prose"><?php echo wp_kses_post($right); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
