<?php
/**
 *  * Template Name: Single Audience Page
 */

get_header() ?>

<?php while ( have_posts() ) : the_post() ?>

<?php $cover_url = (get_field('page_cover_image')) ? get_field('page_cover_image')['url'] : '' ?>

<section id="<?= $post->post_name ?>" class="section--intro load-fadein" style="background-image: url('<?= $cover_url?>');">
	<div class="section--intro__cover-bg" style="background-image: url('<?= $cover_url?>');"></div>
	<div class="col-xs-12 col-sm-6 col-md-6 content">
		<h1><?php the_title() ?></h1>
		<br />
		<blockquote class="blockquote--large"><?php the_field('page_headline') ?></blockquote>
		<br />
		<p><?php the_field('page_intro_blurb') ?></p>
	</div>
</section>

<section id="services" class="section--services content load-movein-btm load-delay-05s">
	<div class="row">

		<?php // List services as summary cards ?>
		<?php foreach(get_field('services') as $service) : ?>

			<div class="col-xs-12 col-sm-6 col-lg-4" style="display: flex;">
				<a href="<?= '#' . sanitize_title($service['service_title']) ?>" class="box box--package box--hoverable">
					<div class="box__header">
						<img src="<?= $service['service_icon']['url'] ?>" alt="<?= $service['service_title'] ?>" />
						<h2><?= $service['service_title'] ?></h2>
					</div>
					<p><?= $service['service_snippet'] ?></p>

					<?
					// Find lowest price of package and display
					$lowest = 1000000;
					foreach ($service['service_packages'] as $package) {
						$price = intval($package['package_price']);
						if($lowest > $price) {
							$lowest = $price;
						}
					}
					if($lowest < 1000000) : ?>
						<div class="price" style="margin-bottom: 1rem;">ab € <?= $lowest ?></div>
					<?php endif ?>
					<div class="box__footer">
						<button class="button button--transparent-reveal button--large button--arrowright">
							<?= pll__('See packages', 'diagberl') ?>		
						</button>
					</div>
				</a>
			</div>

		<?php endforeach ?>

	</div>
</section>

<?php // List services as full sections with packages ?>
<?php foreach(get_field('services') as $service) : ?>
	<section id="<?= sanitize_title($service['service_title']) ?>" class="section--audience-service load-movein-btm load-delay-1s">

		<div class="service-description content">
			<div class="row">

				<div class="col-xs-12 col-sm-7 col-lg-8 service-text">
					<div class="service-header">
						<h2><?= $service['service_title'] ?></h2>
						<figure><img src="<?= $service['service_icon']['url'] ?>" class="service-icon" alt="<?= $service['service_title'] ?>" /></figure>
					</div>
					<p><?= $service['service_description'] ?></p>
				</div>

				<div class="col-xs-12 col-sm-5 col-lg-4">
					<figure class="service-image"><img src="<?= $service['service_image']['url'] ?>" alt="<?= $service['service_title'] ?>" /></figure>
				</div>

			</div>
		</div>

		<div class="service-packages content">
			<div class="row">

				<?php foreach ($service['service_packages'] as $package) : ?>

					<?php $descr = str_replace(['✅', '❌'], ['<span class="icon-check"></span>', '<span class="icon-cross"></span>'], $package['package_description']); ?>

					<div class="col-xs-12 col-sm-6 col-lg-5" style="display: flex;">
						<div class="box box--package">
							<div class="box__header">
								<h4><?= $package['package_letter'] ?></h4>
								<h2><?= $package['package_title'] ?></h2>
							</div>
							<div class="package-description">
								<?= wpautop($descr) ?>

								<?php if(strlen($package['package_extra']) > 0): ?>
									<a class="box--package__descr-link" href="javascript:void(0)" onclick="openDialog('<?= sanitize_title($package['package_title']) ?>')"><?= pll__('More details', 'diagberl') ?></a>
								<?php endif ?>
							</div>
							<div class="box__footer">
	              <div class="price">€ <?= $package['package_price'] ?></div>
	              <a href="<?= $package['package_cta_link'] ?>"><button class="button button--blue button--large"><?= $package['package_cta_text'] ?></button></a>
							</div>
						</div>
					</div>

					<?php if(strlen($package['package_extra']) > 0): ?>
						<div class="dialog-wrapper" id="<?= sanitize_title($package['package_title']) ?>">
							<div onclick="closeDialog()" class="dialog-mask"></div>
							<div class="dialog box box--package">
								<div class="box__header">
									<div>
										<h4><?= $package['package_letter'] ?></h4>
										<h2><?= $package['package_title'] ?></h2>
									</div>
									<a href="javascript:void(0)" onclick="closeDialog()" class="dialog__close"></a>
								</div>
								<div class="package-description">
									<?= wpautop($package['package_extra']) ?>
								</div>
								<div class="box__footer">
		              <div class="price">€ <?= $package['package_price'] ?></div>
		              <a href="<?= $package['package_cta_link'] ?>"><button class="button button--blue button--large"><?= $package['package_cta_text'] ?></button></a>
								</div>
							</div>
						</div>
					<?php endif ?>

			<?php endforeach ?>

			</div>
		</div>

	</section>
<?php endforeach ?>

<section id="packages2" class="section--packages content load-movein-btm load-delay-1s isHidden">
	<div class="row">
		<?php if( have_rows('group_2_packages') ): 
		while( have_rows('group_2_packages') ): the_row(); 

		// vars
		$letter = get_sub_field('g2_package_letter');
		$title = get_sub_field('g2_package_title');
		$description = get_sub_field('g2_package_description');
		$price = get_sub_field('g2_package_price');
		$cta_text = get_sub_field('g2_package_cta_text');
		$cta_link = get_sub_field('g2_package_cta_link');
		?>
		<div class="col-xs-12 col-sm-6 col-lg-4" style="display: flex;">
			<div class="box box--package">
				<div class="box__header">
					<h4><?= $letter ?></h4>
					<h2><?= $title ?></h2>
				</div>
				<p><?= $description ?></p>
				<div class="box__footer">
					<div class="price"><?= $price ?></div>
					<a href="<?= $cta_link ?>"><button class="button button--primary button--large"><?= $cta_text ?></button></a>
				</div>
			</div>
		</div>
	<?php endwhile ?>

	<?php endif ?>

	<?php if( get_field('group_2_table') ): ?>

		<div class="col-xs-12 package-actions">
			<button onclick="toggleComparison($(this))" class="button button--medium button--outline button--arrowright"><?= pll__('Compare', 'diagberl') ?></button>
			<a href="#contact-form" class="button button--medium button--blue" style="margin-left: 0.5rem;"><?= pll__('Contact us for options', 'diagberl') ?></a>
		</div>

	</div>

	<?php
	if(get_field('package_groups') == 'two'):
		$table_no = 2;
		include(locate_template('partials/service-comparison-table.php'));
	endif;
	?>
	<?php endif ?>
	</div>
</section>
<?php

// check if the repeater field has rows of data
if( have_rows('other_services') ):

	// loop through the rows of data
	while ( have_rows('other_services') ) : the_row() ?>

	<!-- // display a sub field value -->
	<section class="section--service load-movein-btm load-delay-1s">
		<div class="row row--nopadding" style="align-items: center;">
			<div class="col-xs-12 col-sm-6 image">
				<figure>
					<img src="<?php the_sub_field('service_image') ?>">
				</figure>
			</div>
			<div class="col-xs-12 col-sm-6 text">
				<div class="box">
					<blockquote class="blockquote--big">
						<p><?php the_sub_field('service_title') ?></p>
					</blockquote>
					<p><?php the_sub_field('service_description') ?></p>
					<?php if(strlen(get_sub_field('service_button_text')) > 0): ?>
						<a href="<?php the_sub_field('service_button_link') ?>" class="button button--primary button--large"><?php the_sub_field('service_button_text') ?></a>
					<?php endif ?>

				</div>
			</div>
		</div>
	</section>
<?php endwhile;

else :

	// no rows found

endif;
?>


<?php endwhile; // end of the loop. ?>
<?php get_footer();
