<?php
/**
 * The template for displaying Archive pages (category, tag, date, author).
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress loads this when viewing a category page, tag page,
 * author page, or date archive. For example:
 *   - yoursite.com/category/health/  → archive.php
 *   - yoursite.com/tag/modafinil/    → archive.php
 *   - yoursite.com/2024/01/          → archive.php
 *
 * the_archive_title()       → outputs "Category: Health" etc.
 * the_archive_description() → outputs the category description
 * =====================================================================
 */

get_header();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Archive Header -->
    <header class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">
            <?php the_archive_title(); ?>
        </h1>
        <?php
        $description = get_the_archive_description();
        if ( $description ) : ?>
            <p class="mt-3 text-lg text-gray-600"><?php echo $description; ?></p>
        <?php endif; ?>
    </header>

    <?php if ( have_posts() ) : ?>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;
            ?>
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => '&larr; Previous',
                'next_text' => 'Next &rarr;',
            ) );
            ?>
        </div>

    <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

</div>

<?php
get_footer();
