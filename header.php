<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="overflow-x-hidden">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased bg-white text-gray-900 overflow-x-hidden'); ?>>
    <?php wp_body_open(); ?>

    <?php
    // Top bar is approx 56px on mobile.
    $header_class = is_front_page() ? 'absolute top-[72px] lg:top-5 left-0 right-0 z-40' : 'bg-primary-light py-2 lg:py-4 relative z-40';
    ?>
    <!-- Mobile Top Bar (Cart & WhatsApp) - Hidden on Desktop -->
    <div class="bg-primary-light w-full px-10 sm:px-12 py-3 flex justify-between items-center relative z-50 lg:hidden">
        <?php if (class_exists('WooCommerce')): ?>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>"
                class="text-white hover:text-gray-200 transition-colors relative flex items-center" aria-label="Cart">
                <svg class="w-8 h-8 lg:w-10 lg:h-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <?php $count = WC()->cart->get_cart_contents_count();
                if ($count > 0): ?>
                    <span
                        class="absolute -top-1 -right-2 bg-red-600 text-white text-[11px] w-5 h-5 rounded-full flex items-center justify-center font-bold"><?php echo $count; ?></span>
                <?php endif; ?>
            </a>
        <?php else: ?>
            <div></div>
        <?php endif; ?>

        <a href="https://wa.me/61868660556" target="_blank" rel="noopener noreferrer"
            class="transition-opacity hover:opacity-80 flex items-center justify-center bg-[#25D366] rounded-xl p-1.5 lg:p-2"
            aria-label="WhatsApp">
            <svg class="w-7 h-7 lg:w-9 lg:h-9 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z" />
            </svg>
        </a>
    </div>

    <!-- Tailwind scanner hook: bg-primary-light py-2 lg:py-4 relative z-40 -->
    <header id="site-header" class="<?php echo esc_attr($header_class); ?>">
        <div class="w-full px-4 sm:px-6 lg:px-[72px] py-2">
            <div
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
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>"
                            class="hidden lg:flex text-red-500 hover:text-red-600 transition-colors relative items-center"
                            aria-label="Cart">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            <?php $count = WC()->cart->get_cart_contents_count();
                            if ($count > 0): ?>
                                <span
                                    class="absolute -top-1 -right-2 bg-red-600 text-white text-[11px] w-5 h-5 rounded-full flex items-center justify-center font-bold"><?php echo $count; ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>

                    <a href="https://wa.me/61868660556" target="_blank" rel="noopener noreferrer"
                        class="hidden lg:block transition-opacity hover:opacity-80" aria-label="WhatsApp">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/whatsapp-icon.png"
                            alt="WhatsApp" class="w-8 h-8 object-contain">
                    </a>

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
            <div class="bg-white/90 backdrop-blur-md rounded-2xl px-4 py-4 space-y-1">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'space-y-1',
                    'fallback_cb' => false,
                    'depth' => 2,
                ));
                ?>
            </div>
        </div>
    </header>


    <div id="page" class="min-h-screen flex flex-col min-w-0 overflow-hidden">
        <main id="main-content" class="flex-grow min-w-0 w-full">