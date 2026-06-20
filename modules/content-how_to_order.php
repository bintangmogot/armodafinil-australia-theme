<?php
/**
 * Layout: How to Order
 * Fields: heading (text), steps (repeater: title, description), safety_title (text), safety_text (wysiwyg)
 */

$heading = get_sub_field('heading');
$safety_title = get_sub_field('safety_title');
$safety_text = get_sub_field('safety_text');
?>
<?php if (have_rows('steps') || $heading || $safety_text) : ?>
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-6 pb-12 lg:pb-20">
        
        <?php if ($heading) : ?>
            <h2 class="text-2xl md:text-3xl font-bold text-center text-primary mb-12">
                <?php echo esc_html($heading); ?>
            </h2>
        <?php endif; ?>

        <?php if (have_rows('steps')) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-12">
                <?php 
                $count = 1;
                while (have_rows('steps')) : the_row(); 
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    if (!$title && !$description) continue;
                ?>
                    <div class="relative bg-gradient-review rounded-xl shadow-lg pt-10 pb-6 px-4 text-center">
                        <div class="absolute -top-6 left-1/2 -translate-x-1/2 w-16 h-16 bg-accent rounded-full flex items-center justify-center text-primary text-xl font-bold shadow-md">
                            <?php echo $count; ?>
                        </div>
                        <h3 class="text-white text-lg md:text-xl font-semibold mb-3">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <p class="text-white/90 text-base md:text-lg leading-relaxed">
                            <?php echo esc_html($description); ?>
                        </p>
                    </div>
                <?php 
                $count++;
                endwhile; ?>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($safety_title || $safety_text) : ?>
        <div class="bg-[#eef4fa] py-10 px-6">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col items-start gap-1 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-7 h-7 mb-1">
                        <path fill="#ffcc00" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32z"/>
                        <path fill="#00125E" d="M232 184v112c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24s-24 10.7-24 24zm24 232a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/>
                    </svg>
                    <?php if ($safety_title) : ?>
                        <h3 class="text-lg md:text-xl font-bold text-primary"><?php echo esc_html($safety_title); ?></h3>
                    <?php endif; ?>
                </div>
                <?php if ($safety_text) : ?>
                    <div class="text-primary text-base md:text-lg leading-relaxed max-w-4xl">
                        <?php echo wp_kses_post($safety_text); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php endif; ?>
