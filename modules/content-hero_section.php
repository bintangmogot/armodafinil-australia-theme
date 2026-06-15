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
        $words[0] = '<span class="text-yellow-400">' . esc_html($words[0]) . '</span>';
        $title_html = implode( ' ', $words );
    } else {
        $title_html = esc_html($title);
    }
}
?>
<section class="hero relative overflow-hidden md:min-h-[600px] lg:h-[100vh] max-h-[964px]">
    <?php if ($image) : ?>
        <img src="<?php echo esc_url($image); ?>" alt="" class="absolute inset-0 w-full h-full object-cover object-right">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0a1045]/90 via-[#0a1045]/20 to-transparent lg:hidden"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a1045]/20 to-transparent lg:hidden"></div>
    <?php endif; ?>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 h-full flex items-end lg:items-center min-h-[inherit]">
        <div class="w-full pt-28 pb-12 md:pt-32 md:pb-16 lg:pt-36 lg:pb-20 text-white">
            <?php if ($title_html) : ?>
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-none mb-3 lg:mb-4">
                    <?php echo $title_html; ?>
                </h1>
            <?php endif; ?>

            <?php if ($subtitle) : ?>
                <p class="text-lg md:text-xl lg:text-2xl font-semibold text-white/90 leading-snug mb-2 lg:mb-3">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>

            <?php if ($tagline) : ?>
                <p class="text-base lg:text-lg text-yellow-400 italic mb-6 lg:mb-8">
                    <?php echo esc_html($tagline); ?>
                </p>
            <?php endif; ?>

            <?php if ( have_rows('features') ) : ?>
                <ul class="space-y-3 mb-6 lg:mb-8">
                    <?php while ( have_rows('features') ) : the_row(); ?>
                        <?php $feature_text = get_sub_field('feature_text'); ?>
                        <?php if ( $feature_text ) : ?>
                            <li class="flex items-center gap-3 text-sm lg:text-base text-white/90">
                                <svg class="w-5 h-5 text-white flex-shrink-0" fill="currentColor" viewBox="0 0 100 100">
                                    <path d="M62,16.7 C48,12.5 31.8,17 21.8,28.2 C10,41.4 10.9,61.8 23.8,73.8 C36.8,85.8 57.2,85.2 69.4,72.4 C78.2,63.2 81.3,50.2 78.4,38.2 C77.8,35.8 74.8,34.8 73,36.6 C71.2,38.4 71.5,41.4 72.4,43.6 C74.6,49.2 74,55.6 70.4,60.8 C61,74.2 42.4,77 29.4,67 C16.4,57 14,38.4 24,25.4 C32,15 46,11.4 57.6,16 C60,17 63,15.6 63.8,13 C64.6,10.4 63.2,7.4 60.6,6.6" />
                                    <path d="M35.4,48 C33,45.4 29,45.4 26.4,48 C23.8,50.6 23.8,54.6 26.4,57.2 L41.2,72 C42.6,73.4 44.4,74 46.2,74 C48,74 49.8,73.4 51.2,72 L83.2,40 C85.8,37.4 85.8,33.4 83.2,30.8 C80.6,28.2 76.6,28.2 74,30.8 L46.2,58.6 L35.4,48 Z" />
                                </svg>
                                <span><?php echo esc_html($feature_text); ?></span>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <?php if ($button_text && $button_link) : ?>
                <div class="mt-5 lg:mt-6">
                    <a href="<?php echo esc_url($button_link); ?>" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold text-sm lg:text-base px-6 lg:px-8 py-3 lg:py-3.5 rounded-full no-underline transition-all hover:shadow-lg hover:shadow-red-600/30">
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
