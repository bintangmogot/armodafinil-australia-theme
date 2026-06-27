<?php
/**
 * The template for displaying all pages.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * WordPress loads this file when viewing any "Page" (not "Post").
 *
 * This template checks: does this page have ACF Flexible Content modules?
 *   YES → render each module from the modules/ folder
 *   NO  → just show the normal page content from the editor
 *
 * Key ACF functions:
 * - have_rows('modules')  → "does this page have any modules added?"
 * - the_row()             → "move to the next module"
 * - get_row_layout()      → "what TYPE of module is this?" (e.g., 'hero_banner')
 * - get_template_part()   → "load the file modules/content-hero_banner.php"
 * =====================================================================
 */

get_header(); // Loads YOUR header.php
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // Start the standard WordPress loop
        while ( have_posts() ) : the_post();

            // 1. Check if our ACF Flexible Content field has data
            if ( have_rows('modules') ) :

                // 2. Loop through each module the client added in the editor
                while ( have_rows('modules') ) : the_row();

                    // 3. Get the slug/layout name of the current module
                    $layout_name = get_row_layout(); // e.g., 'hero_banner', 'product_slider'

                    // 4. Load the matching file from modules/ folder
                    //    Example: get_row_layout() returns 'hero_banner'
                    //    → loads modules/content-hero_banner.php
                    get_template_part( 'modules/content', $layout_name );

                endwhile;

            else :
                // Fallback: If no ACF modules exist on this page, show normal content
                ?>
                <?php
                // Give WooCommerce pages a wider container and remove prose styling
                $is_woo_page = function_exists('is_woocommerce') && ( is_cart() || is_checkout() || is_account_page() );
                $container_classes = $is_woo_page ? 'max-w-7xl mx-auto' : 'max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 prose prose-lg';
                ?>
                <div class="<?php echo esc_attr($container_classes); ?>">
                    <?php the_content(); ?>
                </div>
                <?php

            endif;

        endwhile;
        ?>

    </main>
</div>

<?php
get_footer(); // Loads YOUR footer.php