<?php
/**
 * The template for displaying the footer
 *
 */

?>

<?php if (get_field('use_footer_cta') == 'on'): ?>
	<section id="call_to_action" class="content">
		<div class="row row--nopadding">
			<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-1 col-md-offset-2 col-lg-3 col-lg-offset-2 last-sm">
				<figure>
					<img src="<?= get_field('footer_cta_image'); ?>" />
				</figure>
			</div>

			<div class="col-xs-12 col-sm-7 col-md-6">

				<?= get_field('footer_cta_text'); ?>

				<br/>

				<?php if(strlen(get_field('footer_cta_button_text')) > 0): ?>
					<?php $link = (strlen(get_field('footer_cta_link')) > 0) ? get_field('footer_cta_link') : '#contact-form'; ?>
					<a class="button button--primary button--large" href="<?= $link ?>">
						<?= get_field('footer_cta_button_text'); ?>
					</a>
				<?php endif ?>

			</div>
		</div>
	</section>
<?php endif	?>

<?php if(strlen(get_field('footer_form')) < 20 and strpos(get_field('footer_form'), ',') !== false) : ?>

	<?php $form_ids = explode(',', get_field('footer_form')); ?>
	<?php foreach($form_ids as $form) : ?>
		<div class="popup" id="contact-form-<?= $form ?>">
			<a href="#" class="popup__close"><span>&times;</span></a>
			<div class="form">
				<?= do_shortcode( '[gravityform id="' . $form . '" title="false" description="false" ajax="true"]' ) ?>
			</div>
		</div>
	<?php endforeach ?>

<?php else : ?>

	<div class="popup" id="contact-form">
		<a href="#" class="popup__close"><span>&times;</span></a>
		<div class="form">
			<?= do_shortcode(get_field('footer_form')) ?>
		</div>
	</div>

<?php endif ?>

<footer>

	<div class="content">

		<div style="text-align: center; margin-bottom: 2rem;">
			<img src="<?= esc_url( get_stylesheet_directory_uri() ); ?>/images/logo-monogram.svg" alt="" style="height: 3rem;" />
    </div>

		<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

	</div><!-- .content -->

	<div class="site-info content">
		<div class="row">
			<div class="col-xs-12 col-sm-7">
				<p id="footer-info">&copy;<?= date('Y'); ?> Diagnose Berlin</p>
			</div>
			<div class="col-xs-12 col-sm-5">
				<p id="footer-credits"><a href="https://ldaniel.eu" target="_blank">Website by ldaniel.eu</a></p>
			</div>
		</div>
	</div><!-- .site-info -->

</footer>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
