<?php
/**
 * Layout: Tips
 * Fields: content_left_title (text), content_left (wysiwyg), content_right_title (text), content_right (wysiwyg)
 * Design: White bg, two columns with titles and content
 */
$left_title  = get_sub_field('content_left_title');
$left        = get_sub_field('content_left');
$right_title = get_sub_field('content_right_title');
$right       = get_sub_field('content_right');
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-[#f5f7fb]">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-2 gap-10 lg:gap-16">
            <!-- Left Column -->
            <div>
                <?php if ($left_title) : ?>
                    <h2 class="text-2xl lg:text-3xl font-bold text-[#0a1045] mb-5"><?php echo esc_html($left_title); ?></h2>
                <?php endif; ?>
                <?php if ($left) : ?>
                    <div class="module-tips-content text-[#0a1045]/80 leading-relaxed">
                        <?php echo wp_kses_post($left); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Right Column -->
            <div>
                <?php if ($right_title) : ?>
                    <h2 class="text-2xl lg:text-3xl font-bold text-[#0a1045] mb-5"><?php echo esc_html($right_title); ?></h2>
                <?php endif; ?>
                <?php if ($right) : ?>
                    <div class="module-tips-content text-[#0a1045]/80 leading-relaxed">
                        <?php echo wp_kses_post($right); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
