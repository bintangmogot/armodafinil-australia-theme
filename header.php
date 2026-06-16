<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased bg-white text-gray-900'); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="absolute top-6 lg:top-9 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex items-center justify-between bg-white/55 border border-white/25 backdrop-blur-md rounded-full shadow-lg px-6 py-2.5 lg:px-10 lg:py-3">

            <div class="flex-shrink-0">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="[&_img]:h-10 [&_img]:w-auto lg:[&_img]:h-12">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url('/') ); ?>" class="text-lg lg:text-xl font-bold text-[#0a1045] no-underline hover:text-[#0a1045]/80">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <nav id="desktop-nav" class="hidden lg:flex items-center gap-1" aria-label="Primary navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-1',
                    'fallback_cb'    => false,
                    'depth'          => 2,
                ));
                ?>
            </nav>

            <div class="flex items-center gap-4">
                <?php if ( class_exists('WooCommerce') ) : ?>
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-red-500 hover:text-red-600 transition-colors relative" aria-label="Cart">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                        </svg>
                        <?php $count = WC()->cart->get_cart_contents_count(); if ($count > 0) : ?>
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold"><?php echo $count; ?></span>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>

                <a href="https://wa.me/61868660556" target="_blank" rel="noopener noreferrer" class="transition-opacity hover:opacity-80" aria-label="WhatsApp">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/whatsapp-icon.png" alt="WhatsApp" class="w-6 h-6 object-contain">
                </a>

                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-[#0a1045]" aria-expanded="false" aria-controls="mobile-menu" aria-label="Menu">
                    <svg id="icon-hamburger" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
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
                'container'      => false,
                'menu_class'     => 'space-y-1',
                'fallback_cb'    => false,
                'depth'          => 2,
            ));
            ?>
        </div>
    </div>
</header>


<div id="page" class="min-h-screen flex flex-col">
    <main id="main-content" class="flex-grow">
