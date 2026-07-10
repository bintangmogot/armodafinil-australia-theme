<?php
/**
 * Template part for displaying a single post card in the blog grid.
 *
 * Used by index.php, archive.php, and search.php.
 * Design: gradient blue card with rounded corners, yellow title, white excerpt.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-gradient-review rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full' ); ?>>

    <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="block overflow-hidden" aria-label="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( 'medium_large', array(
                'class' => 'w-full h-48 md:h-52 object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out',
            ) ); ?>
        </a>
    <?php else : ?>
        <!-- Placeholder when no image is set -->
        <a href="<?php the_permalink(); ?>" class="block bg-white/10 h-48 md:h-52 flex items-center justify-center">
            <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </a>
    <?php endif; ?>

    <!-- Text Content -->
    <div class="flex flex-col flex-grow p-5">

        <!-- Title -->
        <h2 class="text-[15px] md:text-base font-bold text-accent leading-snug mb-2 group-hover:text-accent-hover transition-colors duration-200">
            <a href="<?php the_permalink(); ?>" class="hover:no-underline text-accent">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Excerpt -->
        <p class="text-[13px] md:text-sm text-white/90 leading-relaxed line-clamp-3 mb-4">
            <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
        </p>

        <!-- Push the footer to the bottom -->
        <div class="mt-auto"></div>

        <!-- Card Footer: Category + Date -->
        <div class="flex items-center justify-between gap-3 pt-3 border-t border-white/15">
            <?php
            $categories = get_the_category();
            if ( ! empty( $categories ) ) :
            ?>
                <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
                   class="flex-initial min-w-0 inline-block text-[11px] md:text-xs font-semibold uppercase tracking-wide text-white bg-white/15 px-3 py-1 rounded-full hover:bg-white/25 transition-colors duration-200 truncate" title="<?php echo esc_attr( $categories[0]->name ); ?>">
                    <?php echo esc_html( $categories[0]->name ); ?>
                </a>
            <?php else : ?>
                <span class="flex-1"></span>
            <?php endif; ?>

            <time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-[11px] text-white/50 whitespace-nowrap flex-shrink-0">
                <?php echo get_the_date( 'M j, Y' ); ?>
            </time>
        </div>

    </div>

    <!-- Hover overlay link for the whole card -->
    <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
        <span class="sr-only">Read article</span>
    </a>

</article>
