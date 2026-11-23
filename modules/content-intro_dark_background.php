<?php
/**
 * Layout: Intro Dark Background
 * Design: Cohesive brand navy-to-blue header band with crisp high-contrast inverted typography.
 */
$content = get_sub_field('content');
if (!$content) return;
?>
<section class="bg-gradient-to-b from-primary-light to-secondary-dark text-white py-14 lg:py-20 px-6 lg:px-12">
    <div class="max-w-4xl mx-auto">
        <div class="prose prose-invert max-w-none"><?php echo armo_content($content); ?></div>
    </div>
</section>
