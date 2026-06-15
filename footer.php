<?php
/**
 * The Footer for our theme.
 *
 * Closes the main content area and displays the site footer.
 *
 * =====================================================================
 * 🔰 PHP GUIDE:
 * =====================================================================
 * This closes the <main> and <div id="page"> that were opened in header.php.
 * Think of header.php + footer.php as the top and bottom of your HTML page.
 *
 * Key functions:
 * - wp_nav_menu()    → outputs a footer menu (same as header, different location)
 * - dynamic_sidebar()→ outputs widgets added in WP Admin → Appearance → Widgets
 * - wp_footer()      → lets WordPress inject JS before </body> (REQUIRED!)
 * - date('Y')        → outputs the current year (pure PHP, not WordPress)
 * =====================================================================
 */
?>

    </main><!-- end #main-content (opened in header.php) -->

    <!-- ============================================ -->
    <!-- SITE FOOTER — Edit your footer design here   -->
    <!-- ============================================ -->
    <footer id="site-footer" class="bg-gray-900 text-gray-300 mt-auto">

        <!-- Footer Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

                <!-- Column 1: Brand / About -->
                <div class="lg:col-span-1">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-bold text-white">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    <p class="mt-3 text-sm text-gray-400 leading-relaxed">
                        <?php bloginfo( 'description' ); ?>
                    </p>
                </div>

                <!-- Column 2: Footer Navigation -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Navigation</h3>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'space-y-2',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ) );
                    ?>
                </div>

                <!-- Column 3: Footer Widget Area 1 -->
                <div>
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    <?php else : ?>
                        <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Info</h3>
                        <p class="text-sm text-gray-400">Add widgets in WP Admin → Appearance → Widgets → Footer Column 1</p>
                    <?php endif; ?>
                </div>

                <!-- Column 4: Footer Widget Area 2 -->
                <div>
                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    <?php else : ?>
                        <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Contact</h3>
                        <p class="text-sm text-gray-400">Add widgets in WP Admin → Appearance → Widgets → Footer Column 2</p>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="border-t border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">
                        &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-500">
                        Built with ❤️ by <a href="https://www.firas.cloud/" class="text-gray-400 hover:text-white transition-colors" target="_blank" rel="noopener">Firas Alawad</a>
                    </p>
                </div>
            </div>
        </div>

    </footer>

</div><!-- end #page (opened in header.php) -->

<?php wp_footer(); // REQUIRED — WordPress injects JS here. Never remove this! ?>
</body>
</html>
