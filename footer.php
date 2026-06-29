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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-10 pb-10 border-b border-primary-dark/10">

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
                </div>

                <!-- Get in Touch (mobile: 2nd, desktop: hidden here — shown below) -->
                <div class="order-2 lg:hidden">
                    <h3 class="text-lg font-bold text-primary-dark mb-4">Get in Touch with Us</h3>
                    <ul class="space-y-2.5 text-sm text-primary-dark/80">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span><?php echo esc_html( $footer_address ); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            <?php if ( $footer_whatsapp_link ) : ?>
                                <a href="<?php echo esc_url( $footer_whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer" class="hover:underline">WhatsApp: <?php echo esc_html( $footer_whatsapp ); ?></a>
                            <?php else : ?>
                                <span>WhatsApp: <?php echo esc_html( $footer_whatsapp ); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            <a href="mailto:<?php echo esc_attr( $footer_email ); ?>" class="hover:underline"><?php echo esc_html( $footer_email ); ?></a>
                        </li>
                    </ul>
                </div>

                <!-- Category -->
                <div class="order-3 lg:order-2">
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
                <div class="order-4 lg:order-3">
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
                    </div>
                </div>

                <!-- Important Links -->
                <div class="order-5 lg:order-4">
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
            <div class="hidden lg:grid lg:grid-cols-3 gap-8 py-8 border-b border-primary-dark/10">

                <!-- Get in Touch -->
                <div>
                    <h3 class="text-lg font-bold text-primary-dark mb-4">Get in Touch with Us</h3>
                    <ul class="space-y-2.5 text-sm text-primary-dark/80">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span><?php echo esc_html( $footer_address ); ?></span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            <?php if ( $footer_whatsapp_link ) : ?>
                                <a href="<?php echo esc_url( $footer_whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer" class="hover:underline">WhatsApp: <?php echo esc_html( $footer_whatsapp ); ?></a>
                            <?php else : ?>
                                <span>WhatsApp: <?php echo esc_html( $footer_whatsapp ); ?></span>
                            <?php endif; ?>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-dark" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            <a href="mailto:<?php echo esc_attr( $footer_email ); ?>" class="hover:underline"><?php echo esc_html( $footer_email ); ?></a>
                        </li>
                    </ul>
                </div>

                <!-- Payments Accepted -->
                <div>
                    <h3 class="text-sm font-semibold text-primary-dark/60 mb-3">Payments Accepted</h3>
                    <div class="flex items-center gap-4">
                        <?php if ( $payment_images ) : ?>
                            <?php foreach ( $payment_images as $payment ) : ?>
                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                    <img src="<?php echo esc_url( $payment['image']['url'] ); ?>" alt="<?php echo esc_attr( $payment['alt_text'] ?: $payment['image']['alt'] ); ?>" class="!h-5 md:!h-6 w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- Fallback: original hardcoded images -->
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/commonwealth.png'); ?>" alt="Commonwealth Bank" class="!h-5 md:!h-6 w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/osko-1.jpg'); ?>" alt="Osko" class="!h-5 md:!h-6 w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/pay-idi.png'); ?>" alt="PayID" class="!h-5 md:!h-6 w-auto object-contain">
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
                                    <img src="<?php echo esc_url( $shipping['image']['url'] ); ?>" alt="<?php echo esc_attr( $shipping['alt_text'] ?: $shipping['image']['alt'] ); ?>" class="!h-4 md:!h-5 w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <!-- Fallback: original hardcoded image -->
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/Australia_Post_Logo 1.png'); ?>" alt="Australia Post" class="!h-4 md:!h-5 w-auto object-contain">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Mobile-only: Payments & Shipping -->
            <div class="lg:hidden py-8 space-y-6 border-b border-primary-dark/10">
                <div>
                    <h3 class="text-sm font-semibold text-primary-dark/60 mb-3">Payments Accepted</h3>
                    <div class="flex items-center gap-4">
                        <?php if ( $payment_images ) : ?>
                            <?php foreach ( $payment_images as $payment ) : ?>
                                <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                    <img src="<?php echo esc_url( $payment['image']['url'] ); ?>" alt="<?php echo esc_attr( $payment['alt_text'] ?: $payment['image']['alt'] ); ?>" class="!h-5 md:!h-6 w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/commonwealth.png'); ?>" alt="Commonwealth Bank" class="!h-5 md:!h-6 w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/osko-1.jpg'); ?>" alt="Osko" class="!h-5 md:!h-6 w-auto object-contain">
                            </div>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/pay-idi.png'); ?>" alt="PayID" class="!h-5 md:!h-6 w-auto object-contain">
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
                                    <img src="<?php echo esc_url( $shipping['image']['url'] ); ?>" alt="<?php echo esc_attr( $shipping['alt_text'] ?: $shipping['image']['alt'] ); ?>" class="!h-4 md:!h-5 w-auto object-contain">
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200 flex items-center justify-center">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/Australia_Post_Logo 1.png'); ?>" alt="Australia Post" class="!h-4 md:!h-5 w-auto object-contain">
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

</div>

<?php wp_footer(); ?>
</body>
</html>
