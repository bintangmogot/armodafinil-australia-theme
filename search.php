<?php
/**
 * The template for displaying search results.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress loads this when a visitor uses the search form.
 * get_search_query() → returns whatever the user typed in the search box.
 * =====================================================================
 */

get_header();
?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <header class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">
            Search results for: <span class="text-gray-500">"<?php echo get_search_query(); ?>"</span>
        </h1>
    </header>

    <?php if ( have_posts() ) : ?>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;
            ?>
        </div>

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
