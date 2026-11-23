<?php
/**
 * Layout: Text - 1/2 & 1/2
 * Fields: content_left (wysiwyg), content_right (wysiwyg)
 * Design: Clean two-column structured card layout with clear heading hierarchy and balanced spacing.
 */
$content_left  = get_sub_field('content_left');
$content_right = get_sub_field('content_right');
if (!$content_left && !$content_right) return;
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-[#F4F7FC] border-y border-primary/10">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-start">
        <?php if ($content_left) : ?>
            <div class="split-prose-card prose max-w-none bg-white rounded-2xl border border-primary/10 border-t-4 border-t-primary shadow-sm p-6 sm:p-8 lg:p-10">
                <?php echo armo_content($content_left); ?>
            </div>
        <?php endif; ?>
        <?php if ($content_right) : ?>
            <div class="split-prose-card prose max-w-none bg-white rounded-2xl border border-primary/10 border-t-4 border-t-primary shadow-sm p-6 sm:p-8 lg:p-10">
                <?php echo armo_content($content_right); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
