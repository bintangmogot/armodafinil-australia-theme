<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="overflow-x-hidden">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        /* Hide the cart injected by Side Cart plugin into the nav menu to avoid duplicates */
        #desktop-nav .xoo-wsc-cart-trigger, 
        #desktop-nav li.menu-item-cart,
        #mobile-menu .xoo-wsc-cart-trigger,
        #mobile-menu li.menu-item-cart,
        .menu-item-cart { 
            display: none !important; 
        }
        
        /* Side Cart Button Fix for Mobile - Ultra High Specificity */
        html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-btn-checkout,
        html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-btn-cart,
        html body .xoo-wsc-modal .xoo-wsc-footer .xoo-wsc-ft-btn-checkout,
        html body .xoo-wsc-modal .xoo-wsc-footer .xoo-wsc-ft-btn-cart {
            height: auto !important;
            min-height: 48px !important;
            max-height: none !important;
            white-space: normal !important;
            line-height: normal !important;
            padding: 10px 8px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-direction: row !important;
            flex-wrap: wrap !important;
            gap: 4px !important;
            text-align: center !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        html body .xoo-wsc-cart .xoo-wsc-footer,
        html body .xoo-wsc-modal .xoo-wsc-footer {
            height: auto !important;
            min-height: fit-content !important;
        }
        html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-btn-checkout *,
        html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-btn-cart *,
        html body .xoo-wsc-modal .xoo-wsc-footer .xoo-wsc-ft-btn-checkout *,
        html body .xoo-wsc-modal .xoo-wsc-footer .xoo-wsc-ft-btn-cart * {
            line-height: normal !important;
            white-space: normal !important;
            margin: 0 !important;
            display: inline-block !important;
        }
        @media (max-width: 768px) {
            html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-btn-checkout,
            html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-btn-cart,
            html body .xoo-wsc-modal .xoo-wsc-footer .xoo-wsc-ft-btn-checkout,
            html body .xoo-wsc-modal .xoo-wsc-footer .xoo-wsc-ft-btn-cart {
                font-size: 13px !important;
                width: 100% !important;
                margin: 0 0 8px 0 !important;
            }
            /* Force buttons to stack vertically on small screens so they don't squish */
            html body .xoo-wsc-cart .xoo-wsc-footer .xoo-wsc-ft-buttons-cont {
                display: flex !important;
                flex-direction: column !important;
                gap: 8px !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body <?php body_class('antialiased bg-white text-gray-900 overflow-x-hidden'); ?>>
    <?php wp_body_open(); ?>

    <?php $has_announcement = get_field('enable_announcement_bar', 'option'); ?>
    
    <?php if ($has_announcement !== false && $has_announcement !== '0'): ?>
    <!-- Top Announcement Bar (Rebuilt from Zero) -->
    <div class="w-full relative z-50 flex items-center justify-center px-4 py-2 sm:py-2.5" data-aos="fade-down" style="background-color: <?php echo esc_attr(get_field('announcement_bg_color', 'option') ?: '#ff0000'); ?>; color: <?php echo esc_attr(get_field('announcement_text_color', 'option') ?: '#ffffff'); ?>;">
        <div class="w-full max-w-7xl mx-auto text-center text-[13px] sm:text-[15px] font-semibold tracking-wide leading-snug px-2">
            <?php 
                $announcement = get_field('announcement_text', 'option');
                if (!$announcement) {
                    $announcement = 'Free Shipping Orders Over $299 Australia-Wide | Call 0455 241 294';
                }
                
                echo wp_kses_post($announcement);
            ?>
        </div>
    </div>
    <?php endif; ?>

    <?php $has_feature_bar = get_field('enable_feature_bar', 'option'); ?>
    <?php if ($has_feature_bar !== false && $has_feature_bar !== '0'): ?>
    <!-- Top Feature Bar -->
    <div class="w-full relative z-40 flex bg-gradient-review" data-aos="fade-down" data-aos-delay="100" style="color: <?php echo esc_attr(get_field('feature_bar_text_color', 'option') ?: '#ffffff'); ?>;">
        <div class="w-full px-4 sm:px-6 lg:px-[72px] py-2.5 grid grid-cols-2 place-items-start sm:flex sm:flex-wrap sm:items-center sm:justify-center gap-y-2 gap-x-2 sm:gap-4">
            <?php 
            $feature_items = get_field('feature_bar_items', 'option');
            if ($feature_items): 
                foreach ($feature_items as $item): 
            ?>
                <div class="flex items-center gap-2 sm:gap-4 text-[12px] sm:text-[15px] font-medium tracking-wide">
                    <?php if (!empty($item['icon'])): ?>
                        <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="w-5 h-5 sm:w-6 sm:h-6 object-contain shrink-0" />
                    <?php endif; ?>
                    <?php echo esc_html($item['text']); ?>
                </div>
            <?php 
                endforeach; 
            else: 
            ?>
                <!-- Default placeholders if repeater is empty -->
                <div class="flex items-center gap-2 sm:gap-2.5 text-[12px] sm:text-[15px] font-medium tracking-wide">
                    <!-- Fast Truck Icon -->
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 18.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM18 18.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 18.5H3V7h10v11.5h-1M13 7h4l3 4v7.5h-2M1 11h3M2 14h2M1 8h3"></path>
                    </svg>
                    7-10 Day Delivery
                </div>
                <div class="flex items-center gap-2 sm:gap-2.5 text-[12px] sm:text-[15px] font-medium tracking-wide">
                    <!-- Hero/Customer Icon -->
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a3 3 0 100-6 3 3 0 000 6z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 3-2.5 5.5-5.5 5.5h-4c-3 0-5.5-2.5-5.5-5.5V9l7-2 7 2v1.5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 16.5v5l3-2 3 2v-5"></path>
                        <circle cx="16" cy="6" r="3" fill="currentColor" stroke="none"></circle>
                        <path d="M16 4.5l.5 1 1.2.2-.8.8.2 1.2-1-.5-1 .5.2-1.2-.8-.8 1.2-.2z" fill="#fff"></path>
                    </svg>
                    5,000+ Australian Customers
                </div>
                <div class="flex items-center gap-2 sm:gap-2.5 text-[12px] sm:text-[15px] font-medium tracking-wide">
                    <!-- Thumbs up -->
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 shrink-0" fill="currentColor" viewBox="0 0 512 512">
                        <path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.1 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/>
                    </svg>
                    Genuine Brands
                </div>
                <div class="flex items-center gap-2 sm:gap-2.5 text-[12px] sm:text-[15px] font-medium tracking-wide">
                    <!-- Solid Star -->
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"></path>
                    </svg>
                    4.9/5 Customer Rating
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php
    // Automatically position the absolute header relative to the flow of the bars above it
    $header_absolute_class = 'absolute top-auto mt-2 left-0 right-0 z-40';
    $header_class = is_front_page() ? $header_absolute_class : 'bg-primary-light py-2 lg:py-4 relative z-40';
    ?>
    <!-- Mobile Top Bar (Cart) - Hidden on Desktop -->
    <div class="hidden bg-primary-light w-full px-10 sm:px-12 py-3 justify-between items-center relative z-50 lg:hidden" data-aos="fade-down" data-aos-delay="150">
        <div></div>
        <?php if (class_exists('WooCommerce')): ?>
            <div class="flex items-center">
                <?php 
                if (shortcode_exists('xoo_wsc_cart')) {
                    echo do_shortcode('[xoo_wsc_cart]');
                } else {
                    ?>
                    <a href="#" class="xoo-wsc-cart-trigger text-white hover:text-gray-200 transition-colors relative flex items-center" aria-label="Cart">
                        <svg class="w-8 h-8 lg:w-10 lg:h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <?php $count = WC()->cart->get_cart_contents_count();
                        if ($count > 0): ?>
                            <span class="xoo-wsc-items-count absolute -top-1 -right-2 bg-red-600 text-white text-[11px] w-5 h-5 rounded-full flex items-center justify-center font-bold"><?php echo $count; ?></span>
                        <?php endif; ?>
                    </a>
                    <?php
                }
                ?>
            </div>
        <?php else: ?>
            <div></div>
        <?php endif; ?>
    </div>

    <!-- Tailwind scanner hook: bg-primary-light py-2 lg:py-4 relative z-40 -->
    <header id="site-header" class="<?php echo esc_attr($header_class); ?>">
        <div class="w-full px-4 sm:px-6 lg:px-[72px]">
            <div data-aos="fade-down" data-aos-delay="200"
                class="flex items-center justify-between bg-white/55 border border-white/25 backdrop-blur-md rounded-full shadow-lg px-6 py-2.5 lg:px-12 xl:px-24 lg:py-1">

                <div class="flex-shrink-0">
                    <?php if (has_custom_logo()): ?>
                        <div class="[&_img]:h-14 [&_img]:w-auto lg:[&_img]:h-18">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"
                            class="text-lg lg:text-xl font-bold text-primary-dark no-underline hover:text-primary-dark/80">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <nav id="desktop-nav" class="hidden lg:flex items-center gap-1" aria-label="Primary navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex items-center gap-1',
                        'fallback_cb' => false,
                        'depth' => 2,
                    ));
                    ?>
                </nav>

                <div class="flex items-center gap-4">
                    <?php if (class_exists('WooCommerce')): ?>
                        <!-- Side Cart Plugin Trigger -->
                        <div class="hidden lg:flex items-center">
                            <?php 
                            // If the plugin provides its own shortcode, use it to get the exact matching icon with price
                            if (shortcode_exists('xoo_wsc_cart')) {
                                echo do_shortcode('[xoo_wsc_cart]');
                            } else {
                                // Fallback: custom cart icon that triggers the side cart drawer
                                ?>
                                <a href="#" class="xoo-wsc-cart-trigger text-red-500 hover:text-red-600 transition-colors relative flex items-center" aria-label="Cart">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                    <?php $count = WC()->cart->get_cart_contents_count();
                                    if ($count > 0): ?>
                                        <span class="xoo-wsc-items-count absolute -top-1 -right-2 bg-red-600 text-white text-[11px] w-5 h-5 rounded-full flex items-center justify-center font-bold"><?php echo $count; ?></span>
                                    <?php endif; ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <button id="mobile-menu-toggle" class="lg:hidden p-2 text-primary-dark" aria-expanded="false"
                        aria-controls="mobile-menu" aria-label="Menu">
                        <svg id="icon-hamburger" class="w-10 h-10" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg id="icon-close" class="w-10 h-10 hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden mx-4 mt-1">
            <div class="bg-white/90 backdrop-blur-md rounded-2xl px-4 py-2">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex flex-col',
                    'fallback_cb' => false,
                    'depth' => 2,
                ));
                ?>
            </div>
        </div>
    </header>


    <div id="page" class="min-h-screen flex flex-col min-w-0 overflow-hidden">
        <main id="main-content" class="flex-grow min-w-0 w-full">