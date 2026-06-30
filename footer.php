<?php
/**
 * Footer Template — Now powered by ACF Options.
 *
 * All footer content is editable from: WP Admin → Options → Footer
 * Falls back to defaults if options haven't been set yet.
 *
 * @package Armodafinil_Australia
 * @since   2.1.0
 */

// Retrieve ACF option values with fallbacks
$footer_description = get_field( 'footer_text', 'option' );
if ( ! $footer_description ) {
    $footer_description = 'Looking to buy Armodafinil online in Australia? Armodafinil Australia provides a secure and trusted platform for premium Armodafinil products with fast Australia-wide delivery. Pay easily via Commonwealth Bank transfer, enjoy discreet shipping, and get reliable service trusted by customers across Sydney, Melbourne, Brisbane, Perth, and beyond.';
}

$footer_address = get_field( 'footer_address', 'option' );
if ( ! $footer_address ) {
    $footer_address = 'Level 2/29 Chifley Square, Sydney NSW 2000';
}

$footer_whatsapp = get_field( 'footer_whatsapp', 'option' );
if ( ! $footer_whatsapp ) {
    $footer_whatsapp = '+61 8 6866 0556';
}

$footer_whatsapp_link = get_field( 'footer_whatsapp_link', 'option' );

$footer_email = get_field( 'footer_email', 'option' );
if ( ! $footer_email ) {
    $footer_email = 'orders@armodafinilaustralia.com.au';
}

$footer_facebook = get_field( 'footer_facebook', 'option' );
if ( ! $footer_facebook && $footer_facebook !== '' ) {
    $footer_facebook = 'https://www.facebook.com/profile.php?id=61591182224726';
}

$footer_linkedin = get_field( 'footer_linkedin', 'option' );
if ( ! $footer_linkedin && $footer_linkedin !== '' ) {
    $footer_linkedin = 'https://www.linkedin.com/company/armodafinil-australia/about/?viewAsMember=true';
}

$footer_copyright = get_field( 'footer_copyright', 'option' );
if ( ! $footer_copyright ) {
    $footer_copyright = '© {year} {site_name}. All rights reserved.';
}
// Replace placeholders
$footer_copyright = str_replace(
    array( '{year}', '{site_name}' ),
    array( date('Y'), get_bloginfo('name') ),
    $footer_copyright
);

$payment_images  = get_field( 'footer_payment_images', 'option' );
$shipping_images = get_field( 'footer_shipping_images', 'option' );
?>

    </main>

    <footer id="site-footer" class="bg-surface text-primary-dark mt-auto">

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-12 lg:pt-16 pb-6">

            <!-- Top Row: Logo/Description + 3 Link Columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10 pb-10 border-b border-primary-dark/10" data-aos="fade-up">

                <!-- Brand -->
                <div class="order-1 lg:col-span-2 lg:pr-8">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="[&_img]:h-16 lg:[&_img]:h-19 [&_img]:w-auto mb-4 lg:mb-5">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="text-xl font-bold text-primary-dark no-underline">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                    <div class="text-base text-primary-dark/70 leading-relaxed">
                        <?php echo wp_kses_post( $footer_description ); ?>
                    </div>

                    <!-- Get in Touch (Moved below Brand Description) -->
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-primary-dark mb-4">Get in Touch with Us</h3>
                        <ul class="space-y-2.5 text-sm text-primary-dark/80">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                <span><?php echo esc_html( $footer_address ); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                                <?php if ( $footer_whatsapp_link ) : ?>
                                    <a href="<?php echo esc_url( $footer_whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer" class="hover:underline"><?php echo esc_html( $footer_whatsapp ); ?></a>
                                <?php else : ?>
                                    <span><?php echo esc_html( $footer_whatsapp ); ?></span>
                                <?php endif; ?>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                                <a href="mailto:<?php echo esc_attr( $footer_email ); ?>" class="hover:underline"><?php echo esc_html( $footer_email ); ?></a>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Icons (Moved below Get in Touch) -->
                    <div class="flex items-center gap-4 mt-8">
                        <?php if ( $footer_facebook ) : ?>
                            <a href="<?php echo esc_url( $footer_facebook ); ?>" target="_blank" rel="noopener noreferrer" class="text-primary-dark/70 hover:text-primary-dark transition-colors" aria-label="Facebook">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                            </a>
                        <?php endif; ?>
                        <?php if ( $footer_linkedin ) : ?>
                            <a href="<?php echo esc_url( $footer_linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="text-primary-dark/70 hover:text-primary-dark transition-colors" aria-label="LinkedIn">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Category -->
                <div class="order-2 lg:order-2">
                    <h3 class="text-lg font-bold text-primary-dark mb-4"><?php echo esc_html( get_field('footer_menu_1_heading', 'option') ?: 'Category' ); ?></h3>
                    <div class="footer-menu-wrapper">
                        <?php 
                        $menu_1_acf = get_field('footer_menu', 'option');
                        if ( $menu_1_acf ) {
                            echo $menu_1_acf;
                        } else {
                            wp_nav_menu( array(
                                'theme_location' => 'footer',
                                'menu_class'     => 'footer-links',
                                'container'      => false,
                                'fallback_cb'    => false,
                            ) );
                        }
                        ?>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="order-3 lg:order-3">
                    <h3 class="text-lg font-bold text-primary-dark mb-4"><?php echo esc_html( get_field('footer_menu_2_heading', 'option') ?: 'Quick Links' ); ?></h3>
                    <div class="footer-menu-wrapper">
                        <?php 
                        $menu_2_acf = get_field('footer_menu_2', 'option');
                        if ( $menu_2_acf ) {
                            echo $menu_2_acf;
                        } else {
                            wp_nav_menu( array(
                                'theme_location' => 'footer-quick',
                                'menu_class'     => 'footer-links',
                                'container'      => false,
                                'fallback_cb'    => false,
                            ) );
                        }
                        ?>
                        <ul class="footer-links mt-1">
                            <li><a href="<?php echo esc_url( home_url( '/sitemap_index.xml' ) ); ?>">Site Map</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Important Links -->
                <div class="order-4 lg:order-4">
                    <h3 class="text-lg font-bold text-primary-dark mb-4"><?php echo esc_html( get_field('footer_menu_3_heading', 'option') ?: 'Important Links' ); ?></h3>
                    <div class="footer-menu-wrapper">
                        <?php 
                        $menu_3_acf = get_field('footer_menu_3', 'option');
                        if ( $menu_3_acf ) {
                            echo $menu_3_acf;
                        } else {
                            wp_nav_menu( array(
                                'theme_location' => 'footer-important',
                                'menu_class'     => 'footer-links',
                                'container'      => false,
                                'fallback_cb'    => false,
                            ) );
                        }
                        ?>
                    </div>
                </div>

            </div>

            <!-- Middle Row: Contact + Payments + Shipping (desktop only — mobile version is inline above) -->
            <div class="hidden lg:grid lg:grid-cols-2 gap-8 py-8 border-b border-primary-dark/10" data-aos="fade-up" data-aos-delay="100">

                <!-- Payments Accepted -->
                <div>
                    <h3 class="text-sm font-semibold text-primary-dark/60 mb-3">Payments Accepted</h3>
                    <div class="flex items-center gap-2 sm:gap-4">
                        <?php if ( $payment_images ) : ?>
                            <?php foreach ( $payment_images as $payment ) : ?>
                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                    <img src="<?php echo esc_url( $payment['image']['url'] ); ?>" alt="<?php echo esc_attr( $payment['alt_text'] ?: $payment['image']['alt'] ); ?>" class="footer-pay-logo w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- Fallback: original hardcoded images -->
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/commonwealth.png'); ?>" alt="Commonwealth Bank" class="footer-pay-logo w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/osko-1.jpg'); ?>" alt="Osko" class="footer-pay-logo w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/pay-idi.png'); ?>" alt="PayID" class="footer-pay-logo w-auto object-contain">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Shipping Partner -->
                <div>
                    <h3 class="text-sm font-semibold text-primary-dark/60 mb-3">Shipping Partner</h3>
                    <div class="flex items-center gap-3">
                        <?php if ( $shipping_images ) : ?>
                            <?php foreach ( $shipping_images as $shipping ) : ?>
                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                    <img src="<?php echo esc_url( $shipping['image']['url'] ); ?>" alt="<?php echo esc_attr( $shipping['alt_text'] ?: $shipping['image']['alt'] ); ?>" class="footer-ship-logo w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- Fallback: original hardcoded image -->
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/Australia_Post_Logo 1.png'); ?>" alt="Australia Post" class="footer-ship-logo w-auto object-contain">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Mobile-only: Payments & Shipping -->
            <div class="lg:hidden py-8 space-y-6 border-b border-primary-dark/10" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <h3 class="text-sm font-semibold text-primary-dark/60 mb-3">Payments Accepted</h3>
                    <div class="flex items-center gap-4">
                        <?php if ( $payment_images ) : ?>
                            <?php foreach ( $payment_images as $payment ) : ?>
                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                    <img src="<?php echo esc_url( $payment['image']['url'] ); ?>" alt="<?php echo esc_attr( $payment['alt_text'] ?: $payment['image']['alt'] ); ?>" class="footer-pay-logo w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/commonwealth.png'); ?>" alt="Commonwealth Bank" class="footer-pay-logo w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/osko-1.jpg'); ?>" alt="Osko" class="footer-pay-logo w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/pay-idi.png'); ?>" alt="PayID" class="footer-pay-logo w-auto object-contain">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-primary-dark/60 mb-3">Shipping Partner</h3>
                    <div class="flex items-center gap-3">
                        <?php if ( $shipping_images ) : ?>
                            <?php foreach ( $shipping_images as $shipping ) : ?>
                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                    <img src="<?php echo esc_url( $shipping['image']['url'] ); ?>" alt="<?php echo esc_attr( $shipping['alt_text'] ?: $shipping['image']['alt'] ); ?>" class="footer-ship-logo w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/Australia_Post_Logo 1.png'); ?>" alt="Australia Post" class="footer-ship-logo w-auto object-contain">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-6">
                <p class="text-sm text-primary-dark/50">
                    <?php echo esc_html( $footer_copyright ); ?>
                </p>
            </div>

        </div>

    </footer>
    <style>
        .footer-pay-logo {
            height: 1.25rem !important; /* Mobile: 20px */
            width: auto !important;
        }
        @media (min-width: 768px) {
            .footer-pay-logo {
                height: 1.5rem !important; /* Desktop: 24px */
            }
        }
        .footer-ship-logo {
            height: 1.25rem !important; /* Mobile: 20px */
            width: auto !important;
        }
        @media (min-width: 768px) {
            .footer-ship-logo {
                height: 1.5rem !important; /* Desktop: 24px */
            }
        }
    </style>
</div>

<?php wp_footer(); ?>
</body>
</html>
