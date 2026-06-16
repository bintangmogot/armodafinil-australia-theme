<?php ?>

    </main>

    <footer id="site-footer" class="bg-[#E1EDFF] text-[#0a1045] mt-auto">

        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 pt-12 lg:pt-16 pb-6">

            <!-- Top Row: Logo/Description + 3 Link Columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10 pb-10 border-b border-[#0a1045]/10">

                <!-- Brand -->
                <div class="order-1">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="[&_img]:h-10 lg:[&_img]:h-14 [&_img]:w-auto mb-4 lg:mb-5">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="text-xl font-bold text-[#0a1045] no-underline">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                    <p class="text-sm text-[#0a1045]/70 leading-relaxed">
                        Looking to buy Armodafinil online in Australia? Armodafinil Australia provides a secure and trusted platform for premium Armodafinil products with fast Australia-wide delivery. Pay easily via Commonwealth Bank transfer, enjoy discreet shipping, and get reliable service trusted by customers across Sydney, Melbourne, Brisbane, Perth, and beyond.
                    </p>
                </div>

                <!-- Get in Touch (mobile: 2nd, desktop: hidden here — shown below) -->
                <div class="order-2 lg:hidden">
                    <h3 class="text-lg font-bold text-[#0a1045] mb-4">Get in Touch with Us</h3>
                    <ul class="space-y-2.5 text-sm text-[#0a1045]/80">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#0a1045]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span>Level 2/29 Chifley Square, Sydney NSW 2000</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#0a1045]" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            <span>WhatsApp: +61 8 6866 0556</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#0a1045]" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            <span>orders@armodafinilaustralia.com.au</span>
                        </li>
                    </ul>
                </div>

                <!-- Category -->
                <div class="order-3 lg:order-2">
                    <h3 class="text-lg font-bold text-[#0a1045] mb-4">Category</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'space-y-2 footer-links',
                        'fallback_cb'    => '__return_false',
                        'depth'          => 1,
                    ));
                    ?>
                    <?php if ( ! has_nav_menu('footer') ) : ?>
                        <ul class="space-y-2 footer-links">
                            <li><a href="#">Erectile Dysfunction</a></li>
                            <li><a href="#">Smart Pills</a></li>
                            <li><a href="#">Skin care</a></li>
                            <li><a href="#">Viral care</a></li>
                            <li><a href="#">Asthma</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Quick Links -->
                <div class="order-4 lg:order-3">
                    <h3 class="text-lg font-bold text-[#0a1045] mb-4">Quick Links</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-quick',
                        'container'      => false,
                        'menu_class'     => 'space-y-2 footer-links',
                        'fallback_cb'    => '__return_false',
                        'depth'          => 1,
                    ));
                    ?>
                    <?php if ( ! has_nav_menu('footer-quick') ) : ?>
                        <ul class="space-y-2 footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">How To Order</a></li>
                            <li><a href="#">Sitemap</a></li>
                            <li><a href="#">Reviews</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Important Links -->
                <div class="order-5 lg:order-4">
                    <h3 class="text-lg font-bold text-[#0a1045] mb-4">Important Links</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-important',
                        'container'      => false,
                        'menu_class'     => 'space-y-2 footer-links',
                        'fallback_cb'    => '__return_false',
                        'depth'          => 1,
                    ));
                    ?>
                    <?php if ( ! has_nav_menu('footer-important') ) : ?>
                        <ul class="space-y-2 footer-links">
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Drug Policy</a></li>
                            <li><a href="#">Shipping &amp; payment</a></li>
                            <li><a href="#">Refund Returns</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Cancellation Policy</a></li>
                            <li><a href="#">Disclaimer</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

            </div>

            <!-- Middle Row: Contact + Payments + Shipping (desktop only — mobile version is inline above) -->
            <div class="hidden lg:grid lg:grid-cols-3 gap-8 py-8 border-b border-[#0a1045]/10">

                <!-- Get in Touch -->
                <div>
                    <h3 class="text-lg font-bold text-[#0a1045] mb-4">Get in Touch with Us</h3>
                    <ul class="space-y-2.5 text-sm text-[#0a1045]/80">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#0a1045]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                            <span>Level 2/29 Chifley Square, Sydney NSW 2000</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#0a1045]" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>
                            <span>WhatsApp: +61 8 6866 0556</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-[#0a1045]" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
                            <span>orders@armodafinilaustralia.com.au</span>
                        </li>
                    </ul>
                </div>

                <!-- Payments Accepted -->
                <div>
                    <h3 class="text-sm font-semibold text-[#0a1045]/60 mb-3">Payments Accepted</h3>
                    <div class="flex items-center gap-4">
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-xs font-bold text-[#0a1045]">Commonwealth<br>Bank</span>
                        </div>
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-sm font-extrabold text-[#0a1045]">Osko</span>
                        </div>
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-sm font-extrabold text-[#0a1045]">PayID</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Partner -->
                <div>
                    <h3 class="text-sm font-semibold text-[#0a1045]/60 mb-3">Shipping Partner</h3>
                    <div class="flex items-center gap-3">
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-xs font-bold text-red-600">Australia<br>Post</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Mobile-only: Payments & Shipping -->
            <div class="lg:hidden py-8 space-y-6 border-b border-[#0a1045]/10">
                <div>
                    <h3 class="text-sm font-semibold text-[#0a1045]/60 mb-3">Payments Accepted</h3>
                    <div class="flex items-center gap-4">
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-xs font-bold text-[#0a1045]">Commonwealth<br>Bank</span>
                        </div>
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-sm font-extrabold text-[#0a1045]">Osko</span>
                        </div>
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-sm font-extrabold text-[#0a1045]">PayID</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-[#0a1045]/60 mb-3">Shipping Partner</h3>
                    <div class="flex items-center gap-3">
                        <div class="bg-white rounded-lg px-3 py-2 shadow-sm border border-gray-200">
                            <span class="text-xs font-bold text-red-600">Australia<br>Post</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-6">
                <p class="text-sm text-[#0a1045]/50">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
                </p>
            </div>

        </div>

    </footer>

</div>

<?php wp_footer(); ?>
</body>
</html>
