<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class='container'>
			<div class='row'>
				<div class='col-md-5'>	
					<div class='footer-text'><?php the_field('footer_text','options')?></div>
					<div class='footer-contact'>
						<h3>Get in Touch with Us</h3>	
						<li><a>Operating Hours: Mon-Sun: 9am – 10pm AEST</a></li>						
						<li><a class='address'>50 Holt St, Surry Hills, Sydney NSW 2010</a><a>Serving: Sydney, Melbourne, Adelaide, Darwin, Perth, Brisbane, Gold Coast, ACT and Hobart</a></li>
						<li><a class='phone' href='https://wa.me/61868660556'>WhatsApp: +61 8 6866 0556</a></li>		
						<li><a class='email' href='mailto:orders@modafinilaustraliaxpress.com'>orders@modafinilaustraliaxpress.com</a></li>
						
					</div>
					<div class='footer-text'>
						<h4>Payments Accepted</h4>
						<img width='350' src='<?php bloginfo('template_directory'); ?>/images/bank-logo.png'/>
						<h4>Shipping Partner</h4>
						<img width='120' src='<?php bloginfo('template_directory'); ?>/images/aus-post.png'/>
					</div>
				</div>
				<div class='col-md-7'>	
					<div class='row'>
						<div class='col-md-4'>
							<div class='footer-menu'><?php the_field('footer_menu','options')?></div>
						</div>
						<div class='col-md-4'>
							<div class='footer-menu'><?php the_field('footer_menu_2','options')?></div>
						</div>
						<div class='col-md-4'>
							<div class='footer-menu'><?php the_field('footer_menu_3','options')?></div>
						</div>				
					</div>				
				</div>				
			</div>
		</div>
		<div class='container site-info'>
			<div class='row'>
				<div class='col-md-8'>
					<div id="copyright">
						&copy <?php echo esc_attr( date( 'Y' ) )?> Modafinil Australia Xpress. All rights reserved.
					</div>
				</div>  
				<div class='col-md-4'>
					<div id='footer-social' class='social'>
						
						<a href='https://www.tiktok.com/@modafinilaustraliaxpress' target='_blank'>
							<img src='<?php bloginfo('template_directory'); ?>/images/icon-tiktok.svg'/>
						</a>
						<a href='https://www.linkedin.com/company/modafinil-australia-xpress/about/?viewAsMember=true' target='_blank'>
							<img src='<?php bloginfo('template_directory'); ?>/images/icon-linkedin.svg'/>
						</a>
						<a href='https://www.facebook.com/profile.php?id=61588498042615' target='_blank'>
							<img src='<?php bloginfo('template_directory'); ?>/images/icon-facebook.png'/>
						</a>								
					</div>
				</div>
			</div>
		</div>
	</footer><!-- .site-footer -->
	
	<script type="application/json">
		{
		  "@context": "https://schema.org",
		  "@type": "Organization",
		  "name": "Modafinil Australia Xpress",
		  "url": "https://modafinilaustraliaxpress.com/",
		  "logo": "https://modafinilaustraliaxpress.com/logo.png",
		  "contactPoint": {
			"@type": "ContactPoint",
			"telephone": "+61868660556",
			"contactType": "customer service",
			"areaServed": "AU",
			"availableLanguage": "en"
		  },
		  "address": {
			"@type": "PostalAddress",
			"streetAddress": "50 Holt St",
			"addressLocality": "Surry Hills",
			"addressRegion": "NSW",
			"postalCode": "2010",
			"addressCountry": "AU"
		  }
		}
	</script>

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
