<?php
/**
 * Layout: FAQs
 * Fields: faq_title (text), faqs (repeater: question (text), answer (wysiwyg))
 * Design: Light background, centered heading, accordion cards with chevron icons
 */
$faq_title = get_sub_field('faq_title');
$faq_id = 'faq-' . uniqid();
?>
<section class="py-14 lg:py-20 px-6 lg:px-12 bg-[#f5f7fb]">
    <div class="max-w-3xl mx-auto">
        <?php if ($faq_title) : ?>
            <h2 class="text-2xl lg:text-3xl font-bold text-center text-[#0a1045] mb-10"><?php echo esc_html($faq_title); ?></h2>
        <?php endif; ?>

        <?php if (have_rows('faqs')) : ?>
            <div class="space-y-3" id="<?php echo esc_attr($faq_id); ?>">
                <?php $i = 0; while (have_rows('faqs')) : the_row(); 
                    $question = get_sub_field('question');
                    $answer   = get_sub_field('answer');
                ?>
                    <details class="bg-white rounded-xl shadow-sm border border-[#0a1045]/5 group overflow-hidden" <?php echo $i === 0 ? 'open' : ''; ?>>
                        <summary class="font-semibold text-[#0a1045] cursor-pointer list-none flex justify-between items-center px-6 py-4 hover:bg-[#f5f7fb] transition-colors">
                            <span class="pr-4"><?php echo esc_html($question); ?></span>
                            <svg class="w-5 h-5 text-[#0a1045]/40 group-open:rotate-180 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-6 pb-5 text-sm text-[#0a1045]/70 leading-relaxed border-t border-[#0a1045]/5 pt-4">
                            <?php echo wp_kses_post($answer); ?>
                        </div>
                    </details>
                <?php $i++; endwhile; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-400 text-center italic">[ FAQs module — add FAQ items in ACF ]</p>
        <?php endif; ?>
    </div>
</section>
