<?php
/**
 * The template for displaying the header
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg hidden-c">
<head>
	<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N5BW102J2S"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-N5BW102J2S');
    </script>
    
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"> 
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<!--<div class='t1-wrapper'>
		<div class='container'>
			<div class='t1'>
			
				<li>Express Delivery 7 Days</li>
			</div>
		</div>
	</div>-->
	<div class='top-header'>
		<div class='container'>
			<li class="fast-delivery">Fast shipping Australia Wide</li>
			<div class='mobile mobile-cart-phone-wrapper'>
				<a class='header-phone' href='https://wa.me/61868660556'></a>
				<?php if( is_active_sidebar( 'header-widget' ) ) : ?>
					<div class="header-widget">
						<?php dynamic_sidebar( 'header-widget' ); ?>
					</div>
				<?php endif; ?>		
				
			</div>
			
		</div>
	</div>
	<header id="masthead" class="site-header" role="banner">
		<div class='container'>			
			<a class="site-branding " href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title='<?php bloginfo('name') ?>'>
				<img src='<?php bloginfo('template_directory'); ?>/images/logo.png?v2' alt='<?php bloginfo('name') ?>' title='<?php bloginfo('name') ?>'/>
			</a>
			
			<div class='header-right '>
				
				<div id='desktop-menu'>
					<?php wp_nav_menu( array( 'theme_location' => 'primary') );?>
				</div>
				<?php if( is_active_sidebar( 'header-widget' ) ) : ?>
					<div class="header-widget">
						<?php dynamic_sidebar( 'header-widget' ); ?>
					</div>
				<?php endif; ?>
				<a class='header-phone' href='https://wa.me/61868660556'>+61 8 6866 0556</a>
				
				<div id='open-mobile-menu' class='mobile'><i class="icon ion-navicon"></i></div>
			</div>
		</div>
		<div class='mobile-menu-wrapper mobile'>
			<div class='container'>			
				<div class='mobile-menu'>
					<?php wp_nav_menu( array( 'theme_location' => 'mobile','walker' => new Child_Wrap()) );?> 
				</div>		
			</div>	
		</div>	
	</header><!-- .site-header -->		

	<div id="content" class="site-content">
