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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-300' ); ?>>

    <!-- Featured Image -->
    <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
            <?php the_post_thumbnail( 'armo-card', array(
                'class' => 'w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300',
            ) ); ?>
        </a>
    <?php endif; ?>

    <!-- Content -->
    <div class="p-5">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Excerpt (short preview text) -->
        <p class="mt-2 text-sm text-gray-600 line-clamp-3">
            <?php echo get_the_excerpt(); ?>
        </p>

        <!-- Meta -->
        <div class="mt-4 flex items-center justify-between text-xs text-gray-400">
            <time datetime="<?php echo get_the_date( 'c' ); ?>">
                <?php echo get_the_date(); ?>
            </time>
            <a href="<?php the_permalink(); ?>" class="font-medium text-blue-600 hover:text-blue-800 transition-colors">
                Read more →
            </a>
        </div>
    </div>

</article>
