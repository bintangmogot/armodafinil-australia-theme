<?php
/**
 * The template for displaying 404 (Page Not Found) errors.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress loads this when a visitor goes to a URL that doesn't exist.
 * This is pure HTML/Tailwind — almost no PHP needed!
 * =====================================================================
 */

get_header();
?>

<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">

    <!-- 404 Number -->
    <p class="text-8xl font-extrabold text-gray-200">404</p>

    <!-- Message -->
    <h1 class="mt-4 text-3xl font-bold text-gray-900">Page not found</h1>
    <p class="mt-4 text-lg text-gray-500">
        Sorry, we couldn't find the page you're looking for.
    </p>

    <!-- Action Button -->
    <div class="mt-8">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Home
        </a>
    </div>

    <!-- Search Form -->
    <div class="mt-10">
        <p class="text-sm text-gray-500 mb-4">Or try searching:</p>
        <?php get_search_form(); ?>
    </div>

</div>

<?php
get_footer();
