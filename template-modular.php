<?php
/**
 * Template Name: Modular Page (ACF Pro)
 *
 * This template displays pages built dynamically using ACF Pro Flexible Content modules.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This is a "Page Template" — a special template you can select in the
 * WordPress page editor (right sidebar → "Template" dropdown).
 *
 * It works exactly like page.php but is specifically designed for
 * pages built with ACF Flexible Content modules.
 *
 * To use this: Edit a page → look for "Template" in the sidebar → 
 *              select "Modular Page (ACF Pro)"
 * =====================================================================
 */

get_header(); // Loads YOUR header.php
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        // Start the standard WordPress loop
        while ( have_posts() ) : the_post();

            // 1. Check if our ACF Pro Flexible Content field has data
            if ( have_rows('modules') ) :

                // 2. Loop through each row/module added in the editor
                while ( have_rows('modules') ) : the_row();

                    // 3. Get the slug/layout name of the current module
                    $layout_name = get_row_layout(); // e.g., 'hero_banner', 'pharmacy_grid'

                    // 4. Look into the 'modules' folder for content-$layout_name.php
                    get_template_part( 'modules/content', $layout_name );

                endwhile;

            else :
                // Fallback: If no ACF modules exist, show normal page content
                ?>
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 prose prose-lg">
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
