<?php
/**
 * Layout: Contact
 * Fields: form (wysiwyg), email (text), phone (text), address (wysiwyg), map (textarea)
 */
$form    = get_sub_field('form');
$email   = get_sub_field('email');
$phone   = get_sub_field('phone');
$address = get_sub_field('address');
$map     = get_sub_field('map');
?>
<section class="py-12 px-4 bg-gray-50">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div>
            <?php if ($form) : ?>
                <div class="prose"><?php echo armo_content($form); ?></div>
            <?php else : ?>
                <p class="text-gray-400 italic">[ Contact form — add shortcode or content in ACF ]</p>
            <?php endif; ?>
        </div>
        
        <!-- Contact Details -->
        <div class="space-y-6">
            <?php if ($email) : ?>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="text-blue-600 hover:underline"><?php echo esc_html($email); ?></a>
                </div>
            <?php endif; ?>
            
            <?php if ($phone) : ?>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                    <a href="tel:<?php echo esc_attr($phone); ?>" class="text-blue-600 hover:underline"><?php echo esc_html($phone); ?></a>
                </div>
            <?php endif; ?>
            
            <?php if ($address) : ?>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                    <div class="text-gray-600"><?php echo armo_content($address); ?></div>
                </div>
            <?php endif; ?>
            
            <?php if ($map) : ?>
                <div class="rounded-lg overflow-hidden">
                    <?php echo $map; // Raw HTML for iframe embed ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
