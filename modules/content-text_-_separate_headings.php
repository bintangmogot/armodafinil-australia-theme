<?php
/**
 * Layout: Text - Separate Headings
 * Fields: h1_heading, h2_heading, h3_heading, content (wysiwyg)
 * Design: White background, centered text with dark navy headings
 */
$h1_heading = get_sub_field('h1_heading');
$h2_heading = get_sub_field('h2_heading');
$h3_heading = get_sub_field('h3_heading');
$content = get_sub_field('content');
?>
<section class="py-6 lg:py-12 px-6 lg:px-12 bg-surface">
    <div class="max-w-4xl mx-auto text-center">
        <?php if ($h1_heading) : ?>
            <h1 class="text-3xl lg:text-4xl font-extrabold text-primary mb-5"><?php echo esc_html($h1_heading); ?></h1>
        <?php endif; ?>

        <?php if ($h2_heading) : ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-primary mb-4"><?php echo esc_html($h2_heading); ?></h2>
        <?php endif; ?>

        <?php if ($h3_heading) : ?>
            <h3 class="text-xl lg:text-2xl font-bold text-primary mb-3"><?php echo esc_html($h3_heading); ?></h3>
        <?php endif; ?>

        <?php if ($content) : ?>
            <div class="module-fulltext-content prose max-w-none mt-6">
                <?php echo wp_kses_post($content); ?>
            </div>
        <?php elseif (!$h1_heading && !$h2_heading && !$h3_heading) : ?>
            <p class="text-[#1E1E1E] text-center italic">[ Text Separate Headings module — add content in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
