<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<section id="call_to_action" class="content">
	<div class="row row--nopadding">
		<div class="col-xs-8 col-xs-offset-2 col-sm-3 col-sm-offset-2 last-sm">
			<?php 
				if ( 'off' == get_field('use_footer_cta')) {
					//do nothing
				} elseif ('on' == get_field('use_footer_cta')) { ?>

					<figure>
						<?php echo get_field('footer_cta_image'); ?>
					</figure>

			        <div class="col-xs-12 col-sm-5 col-sm-offset-1">

						<?php echo get_field('footer_cta_text'); ?>

						<a class="button button--dark button--outline button--large" href="<?php echo get_field('footer_cta_link'); ?>">
							<?php echo get_field('footer_cta_button_text'); ?>
						</a>
					</div>
			<?php }	?>
		</div>
	</div>
</section>

<footer>
	<div class="row">
		<div class="col-xs-12" style="text-align: center; margin-bottom: 2rem;">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/logo-monogram.svg" alt="" style="height: 3rem;" />
        </div>
		
		<?php
		get_template_part( 'template-parts/footer/footer', 'widgets' );
		?>
		<div class="site-info">
			<p id="footer-info">&copy;<?php echo date('Y'); ?> Diagnose Berlin</p>
			<p id="footer-credits">Website by <a href="ldaniel.eu" target="_blank">ldaniel.eu</a></p>
		</div><!-- .site-info -->
	</div><!-- .row -->
</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
