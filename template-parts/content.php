<?php
/**
 * Template part for displaying a single post in a listing (grid/archive).
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This is a "template part" — a reusable piece of HTML.
 * It's used by index.php, archive.php, and search.php to display
 * each post as a card in a grid.
 *
 * Think of it like a React component: <PostCard />
 * WordPress loads it with: get_template_part('template-parts/content')
 *
 * the_permalink()      → the URL to this specific post
 * the_title()          → the post title
 * the_excerpt()        → a short preview of the post content
 * has_post_thumbnail() → checks if the post has a featured image
 * the_post_thumbnail() → outputs the featured image <img> tag
 * =====================================================================
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-gradient-to-b from-secondary to-primary border border-primary-light rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col h-full transform hover:-translate-y-1' ); ?>>

    <div class="p-4 flex-grow flex flex-col">
        <!-- Featured Image -->
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" class="block overflow-hidden rounded-lg mb-5 border border-white/5 shadow-inner relative z-10 group-hover:shadow-md transition-shadow">
                <!-- An overlay for a better hover effect -->
                <div class="absolute inset-0 bg-primary/0 group-hover:bg-white/10 transition-colors duration-300 z-20 pointer-events-none"></div>
                <?php the_post_thumbnail( 'large', array(
                    'class' => 'w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500 ease-out',
                ) ); ?>
            </a>
        <?php endif; ?>

        <!-- Content -->
        <div class="flex-grow flex flex-col px-2">
            <!-- Title -->
            <h2 class="text-[17px] md:text-lg font-bold text-accent group-hover:text-accent-hover transition-colors leading-snug mb-3 text-center">
                <a href="<?php the_permalink(); ?>" class="block">
                    <?php the_title(); ?>
                </a>
            </h2>

            <!-- Excerpt (short preview text) -->
            <div class="text-[13px] md:text-sm text-white/90 leading-relaxed line-clamp-3 text-center mb-6">
                <?php echo get_the_excerpt(); ?>
            </div>

            <!-- Spacer to push category to bottom -->
            <div class="mt-auto"></div>

            <!-- Category -->
            <div class="text-center pt-2">
                <?php
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="inline-block text-white font-extrabold uppercase tracking-wide text-xs md:text-sm hover:text-accent transition-colors">' . esc_html( $categories[0]->name ) . '</a>';
                }
                ?>
            </div>
        </div>
    </div>

</article>
