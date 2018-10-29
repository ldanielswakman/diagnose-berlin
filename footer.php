<?php
/**
 * The template for displaying the footer
 *
 */

?>

			<?php 
				if ( 'off' == get_field('use_footer_cta')) {
					//do nothing
				} elseif ('on' == get_field('use_footer_cta')) { ?>

				<section id="call_to_action" class="content">
					<div class="row row--nopadding">
						<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-1 col-md-offset-2 col-lg-3 col-lg-offset-2 last-sm">
							<figure>
								<img src="<?php echo get_field('footer_cta_image'); ?>" />
							</figure>
						</div>

						<div class="col-xs-12 col-sm-7 col-md-6">

							<?php echo get_field('footer_cta_text'); ?>

							<br/>

							<a class="button button--dark button--outline button--large test-popup-link" href="#test-popup">
								<?php echo get_field('footer_cta_button_text'); ?>
							</a>
							<div id="test-popup" class="form">
								<?php echo get_field('footer_form'); ?>
							</div>
						</div>
					</div>
				</section>
			<?php }	?>


<footer>

	<div class="content">

		<div style="text-align: center; margin-bottom: 2rem;">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/logo-monogram.svg" alt="" style="height: 3rem;" />
    </div>

		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

	</div><!-- .content -->

	<div class="site-info content">
		<div class="row">
			<div class="col-xs-12 col-sm-7">
				<p id="footer-info">&copy;<?php echo date('Y'); ?> Diagnose Berlin</p>
			</div>
			<div class="col-xs-12 col-sm-5">
				<p id="footer-credits"><a href="ldaniel.eu" target="_blank">Website by ldaniel.eu</a></p>
			</div>
		</div>
	</div><!-- .site-info -->

</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
