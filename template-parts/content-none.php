<?php
/**
 * Template part for displaying "no posts found" message.
 *
 * Shown when a query returns zero results (empty search, empty category, etc.)
 */
?>

<div class="text-center py-16">
    <svg class="mx-auto w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <h2 class="mt-4 text-xl font-semibold text-gray-900">Nothing found</h2>
    <p class="mt-2 text-gray-500">
        <?php if ( is_search() ) : ?>
            No results matched your search. Try different keywords.
        <?php else : ?>
            It seems we can&rsquo;t find what you&rsquo;re looking for.
        <?php endif; ?>
    </p>

    <?php if ( is_search() ) : ?>
        <div class="mt-6 max-w-md mx-auto">
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>
