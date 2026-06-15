<?php
/**
 * Layout: FAQs
 * Fields: faq_title (text), faqs (repeater: question (text), answer (wysiwyg))
 */
$faq_title = get_sub_field('faq_title');
?>
<section class="py-12 px-4 bg-gray-50">
    <div class="max-w-3xl mx-auto">
        <?php if ($faq_title) : ?>
            <h2 class="text-3xl font-bold text-center mb-8"><?php echo esc_html($faq_title); ?></h2>
        <?php endif; ?>

        <?php if (have_rows('faqs')) : ?>
            <div class="space-y-4">
                <?php while (have_rows('faqs')) : the_row(); 
                    $question = get_sub_field('question');
                    $answer   = get_sub_field('answer');
                ?>
                    <details class="bg-white border border-gray-200 rounded-lg p-4 group">
                        <summary class="font-semibold text-gray-900 cursor-pointer list-none flex justify-between items-center">
                            <?php echo esc_html($question); ?>
                            <svg class="w-5 h-5 text-gray-400 group-open:rotate-180 transition-transform flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="mt-3 text-gray-600 prose">
                            <?php echo wp_kses_post($answer); ?>
                        </div>
                    </details>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ FAQs module — add FAQ items in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
