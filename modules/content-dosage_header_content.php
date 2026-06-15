<?php
/**
 * Layout: Dosage Header Content
 */
$content = get_sub_field('content');
?>
<section class="py-12 px-4 bg-blue-50">
    <div class="max-w-4xl mx-auto prose prose-lg">
        <?php echo $content ? wp_kses_post($content) : '<p class="text-gray-400 text-center italic">[ Dosage Header Content module — add content in ACF ]</p>'; ?>
    </div>
</section>
