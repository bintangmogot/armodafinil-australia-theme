<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress uses a "Template Hierarchy" to decide which file to load:
 *   - Viewing a page?     → page.php
 *   - Viewing a blog post? → single.php
 *   - Viewing an archive?  → archive.php
 *   - Nothing else matches? → index.php (THIS FILE — the ultimate fallback)
 *
 * The "WordPress Loop" below is how WordPress outputs content.
 * Think of it as: "while there are posts to show, show each one."
 * =====================================================================
 */

get_header(); // Loads header.php (your header HTML)
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <?php if ( have_posts() ) : ?>

        <!-- Page Title (shown on blog/archive pages) -->
        <?php if ( is_home() && ! is_front_page() ) : ?>
            <h1 class="text-3xl font-bold text-gray-900 mb-8">
                <?php single_post_title(); ?>
            </h1>
        <?php endif; ?>

        <!-- Post Grid -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php
            // THE WORDPRESS LOOP — this runs once for each post
            while ( have_posts() ) : the_post();
                // Load the content template part
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;
            ?>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
                'class'     => 'flex items-center gap-2',
            ) );
            ?>
        </div>

    <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

</div>

<?php
get_footer(); // Loads footer.php (your footer HTML)
