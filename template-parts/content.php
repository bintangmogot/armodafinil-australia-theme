<?php
/**
 * Template part for displaying a single post in a listing (grid/archive).
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-[#1b4f93] rounded-sm flex flex-col h-full' ); ?>>

    <div class="p-[6px] flex-grow flex flex-col">
        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" class="block overflow-hidden mb-4">
                <?php the_post_thumbnail( 'large', array(
                    'class' => 'w-full h-[220px] object-cover',
                ) ); ?>
            </a>
        <?php endif; ?>

        <!-- Content -->
        <div class="flex-grow flex flex-col px-4 pb-4">
            <!-- Title -->
            <h2 class="text-[16px] md:text-[17px] font-bold text-[#FFD000] leading-snug mb-3 text-center">
                <a href="<?php the_permalink(); ?>" class="hover:underline">
                    <?php the_title(); ?>
                </a>
            </h2>

            <!-- Excerpt -->
            <div class="text-[14px] text-white leading-relaxed text-center mb-6">
                <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
            </div>

            <!-- Spacer -->
            <div class="mt-auto"></div>

            <!-- Category -->
            <div class="text-center">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="text-white font-bold uppercase tracking-wider text-[13px] hover:underline">' . esc_html( $categories[0]->name ) . '</a>';
                }
                ?>
            </div>
        </div>
    </div>

</article>
