<?php
$image       = get_sub_field('image');
$title       = get_sub_field('title');
$subtitle    = get_sub_field('subtitle');
$tagline     = get_sub_field('tagline');
$button_text = get_sub_field('button_text');
$button_link = get_sub_field('button_link');

// Make the first word of the title yellow
$title_html = '';
if ( $title ) {
    $words = explode( ' ', $title );
    if ( !empty( $words ) ) {
        $words[0] = '<span class="text-[#FFD000]">' . esc_html($words[0]) . '</span>';
        $title_html = implode( ' ', $words );
    } else {
        $title_html = esc_html($title);
    }
}
?>
<section class="hero relative overflow-hidden md:min-h-[600px] lg:h-[90vh] max-h-[964px]">
    <?php if ($image) : ?>
        <!-- Desktop Image -->
        <img src="<?php echo esc_url($image); ?>" alt="" class="hidden md:block absolute inset-0 w-full h-full object-cover object-bottom">
        <!-- Mobile Image -->
        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/mobile-hero-image.png" alt="" class="block md:hidden absolute inset-0 w-full h-full object-cover object-right">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0a1045]/90 via-[#0a1045]/20 to-transparent lg:hidden"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1045]/20 to-transparent lg:hidden"></div>
    <?php endif; ?>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 h-full flex items-end lg:items-center min-h-[inherit]">
        <div class="w-[70%] md:w-full pt-28 pb-6 md:pt-32 md:pb-16 lg:pt-36 lg:pb-20 text-white">
            <?php if ($title_html) : ?>
                <h1 class="max-w-5xl text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-[1.2] mb-3 lg:mb-4">
                    <?php echo $title_html; ?>
                </h1>
            <?php endif; ?>

            <?php if ($subtitle) : ?>
                <p class="lg:w-[50%] text-lg md:text-2xl lg:text-3xl font-semibold text-white/90 leading-snug mb-2 lg:mb-3">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>

            <?php if ($tagline) : ?>
                <p class="text-base lg:text-xl text-[#FFD000] italic mb-6 lg:mb-8">
                    <?php echo esc_html($tagline); ?>
                </p>
            <?php endif; ?>

            <?php if ( have_rows('features') ) : ?>
                <ul class="space-y-3 mb-6 lg:mb-8">
                    <?php while ( have_rows('features') ) : the_row(); ?>
                        <?php $feature_text = get_sub_field('feature_text'); ?>
                        <?php if ( $feature_text ) : ?>
                            <li class="flex items-center gap-3 text-sm lg:text-xl text-white/90">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/check.png" alt="Check" class="w-6 h-6 flex-shrink-0 object-contain">
                                <span><?php echo esc_html($feature_text); ?></span>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <?php if ($button_text && $button_link) : ?>
                <div class="mt-5 lg:mt-6">
                    <a href="<?php echo esc_url($button_link); ?>" class="inline-flex items-center gap-2 bg-[#FF0000] hover:bg-[#dc0000] text-white font-bold text-sm lg:text-base px-6 lg:px-8 py-3 lg:py-3.5 rounded-full no-underline transition-all hover:shadow-lg hover:shadow-black/30">
                        <span><?php echo esc_html($button_text); ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
