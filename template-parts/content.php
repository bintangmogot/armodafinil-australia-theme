<?php
/**
 * Template part for displaying a single post card in the blog grid.
 *
 * Used by index.php, archive.php, and search.php.
 * Design: white card with rounded corners, soft shadow, image + text + category pill.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100 transition-shadow duration-300 flex flex-col h-full' ); ?>>

    <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="block overflow-hidden" aria-label="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail( 'medium_large', array(
                'class' => 'w-full h-48 md:h-52 object-cover group-hover:scale-[1.03] transition-transform duration-500 ease-out',
            ) ); ?>
        </a>
    <?php else : ?>
        <!-- Placeholder when no image is set -->
        <a href="<?php the_permalink(); ?>" class="block bg-surface-light h-48 md:h-52 flex items-center justify-center">
            <svg class="w-12 h-12 text-primary/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </a>
    <?php endif; ?>

    <!-- Text Content -->
    <div class="flex flex-col flex-grow p-5">

        <!-- Title -->
        <h2 class="text-[15px] md:text-base font-bold text-primary leading-snug mb-2 group-hover:text-secondary transition-colors duration-200">
            <a href="<?php the_permalink(); ?>" class="hover:no-underline">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Excerpt -->
        <p class="text-[13px] md:text-sm text-gray-600 leading-relaxed line-clamp-3 mb-4">
            <?php echo wp_trim_words( get_the_excerpt(), 18, '...' ); ?>
        </p>

        <!-- Push the footer to the bottom -->
        <div class="mt-auto"></div>

        <!-- Card Footer: Category + Date -->
        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <?php
            $categories = get_the_category();
            if ( ! empty( $categories ) ) :
            ?>
                <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"
                   class="inline-block text-[11px] md:text-xs font-semibold uppercase tracking-wide text-secondary bg-surface-light px-3 py-1 rounded-full hover:bg-surface transition-colors duration-200">
                    <?php echo esc_html( $categories[0]->name ); ?>
                </a>
            <?php else : ?>
                <span></span>
            <?php endif; ?>

            <time datetime="<?php echo get_the_date( 'c' ); ?>" class="text-[11px] text-gray-400">
                <?php echo get_the_date( 'M j, Y' ); ?>
            </time>
        </div>

    </div>

</article>
