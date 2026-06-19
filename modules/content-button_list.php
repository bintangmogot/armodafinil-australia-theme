<?php
/**
 * Layout: Button List
 * Fields: heading (text), subheading (text), buttons (repeater: button_text, button_link, button_color)
 */

$heading = get_sub_field('heading');
$subheading = get_sub_field('subheading');
?>
<?php if (have_rows('buttons') || $heading) : ?>
<section class="py-12 px-6 lg:px-12 bg-white">
    <div class="max-w-4xl mx-auto text-center">
        
        <?php if ($heading) : ?>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-[#00125E] mb-4">
                <?php echo wp_kses_post($heading); ?>
            </h2>
        <?php endif; ?>

        <?php if ($subheading) : ?>
            <div class="text-lg md:text-xl text-[#00125E] mb-10 opacity-90">
                <?php echo wp_kses_post($subheading); ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('buttons')) : ?>
            <div class="flex flex-wrap justify-center gap-4">
                <?php while (have_rows('buttons')) : the_row(); 
                    $button_text = get_sub_field('button_text');
                    $button_link = get_sub_field('button_link');
                    $button_color = get_sub_field('button_color'); // 'blue' or 'yellow'
                    
                    if (!$button_text || !$button_link) continue;

                    // Set colors based on selection. Default to yellow if not set.
                    if ($button_color === 'blue') {
                        $btn_bg = 'bg-gradient-to-r from-[#073980] to-[#2056A2] text-white hover:from-[#ffcc00] hover:to-[#ffcc00] hover:text-[#00125E]';
                    } else {
                        $btn_bg = 'bg-[#ffcc00] text-[#00125E] hover:bg-gradient-to-r hover:from-[#073980] hover:to-[#2056A2] hover:text-white';
                    }
                ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="inline-flex items-center justify-center <?php echo $btn_bg; ?> font-bold text-[17px] py-3 px-6 rounded-xl transition-all duration-300 shadow hover:-translate-y-1 hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-4 h-4 mr-2" fill="currentColor">
                            <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                        </svg>
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>
