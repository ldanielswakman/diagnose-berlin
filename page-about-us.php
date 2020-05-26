<?php
/**
 *  * Template Name: About us
 */
get_header(); ?>

<section id="intro" class="load-fadein">
	<div class="col-xs-12 col-md-8 col-lg-6 content">
		<br />
		<blockquote class="blockquote--big">
			<?php the_field('opening_headline'); ?>
		</blockquote>
		<br />
		<p><?php the_field('opening_text'); ?></p>
	</div>
</section>

<section id="usps" class="bg-greylightest content load-fadein load-delay-1s">
	<div class="row">
		<?php foreach(get_field('opening_usps') as $key => $usp) : ?>
			<div class="col-xs-12 col-md-4 usp usp--<?= $key+1 ?>">
				<img src="<?= $usp['item_image'] ?>" />
				<h3><?= $usp['item_title'] ?></h3>
				<?= wpautop($usp['item_text']) ?>
			</div>
		<?php endforeach ?>
	</div>
</section>




<?php
// check if the repeater field has rows of data
if( have_rows('variable_content_section') ):

  // loop through the rows of data
  while ( have_rows('variable_content_section') ) : the_row() ?>

    <!-- // display a sub field value -->
    <section class="section--service load-movein-btm load-delay-1s">
       <div class="row row--nopadding" style="align-items: center;">

        <div class="col-xs-12 col-sm-6 image">
					<figure>
						<img src="<?php the_sub_field('section_image') ?>">
					</figure>
				</div>

				<div class="col-xs-12 col-sm-6 text">
      		<div class="box">
						<blockquote class="blockquote--big">
							<p><?php the_sub_field('section_title') ?></p>
						</blockquote>
						<p><?php the_sub_field('section_description') ?></p>
            <?php if(strlen(get_sub_field('section_button_text')) > 0): ?>
    					<a href="<?php the_sub_field('section_button_link') ?>" class="button button--primary button--large"><?php the_sub_field('section_button_text') ?></a>
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



<section id="team" class="bg-greylightest load-fadein">
	<div class="row row--nopadding" style="justify-content: center;">
		<div class="col-xs-12 content align-center">
			<h1><?php the_title(); ?></h1>
		</div>
		<?php
		
			// check if the repeater field has rows of data
			if( have_rows('team_member') ):

				// loop through the rows of data
				while ( have_rows('team_member') ) : the_row(); ?>

					<!-- // display a sub field value -->

					<div class="col-xs-12 col-sm-6 col-xl-4 content member">

						<figure>
							<img src="<?php the_sub_field('member_headshot'); ?>" />
						</figure>

						<h2><?php the_sub_field('member_name'); ?></h2>
						<br />

						<div class="small more"><?php the_sub_field('member_description'); ?></div>

						<br />

						<button onclick="toggleMemberDescription($(this))" class="button button--small button--grey button--more"><?= __('Mehr info', 'Team') ?></button>
						<button onclick="toggleMemberDescription($(this))" class="button button--small button--grey button--less"><?= __('Weniger info', 'Team') ?></button>

					</div>

		<?php endwhile;

		else :

			// no rows found

		endif;
		?>
	</div>
</section>

<?php while (have_posts()) : the_post(); ?>
<section id="about" class="load-movein-btm" style="margin-top: -5rem;">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
			<div class="box">
				<div class="row">
					<div class="col-xs-12 col-xl-4">
						<blockquote class="blockquote--big">
							<p><?php the_field('middle_headline'); ?></p>
						</blockquote>
					</div>
					<div class="col-xs-12 col-xl-8">
						<?php the_field('middle_description'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile; ?>

<section id="partners" class="content">
	<h4 class="content align-center"><?php the_field('partner_section_title'); ?></h4>
		<div class="row row--nopadding partners-grid align-center">
			<?php
			if( have_rows('partners') ):
				while ( have_rows('partners') ) : the_row(); ?>

					<?php $extra = (strlen(get_sub_field('partner_description')) == 0 && strlen(get_sub_field('partner_logo')) == 0) ? ' spacer' : '';
					?>

					<div class="col-xs-6 col-sm-4 partner<?= $extra ?>">

						<?php if (strlen(get_sub_field('partner_description')) > 0) : ?>
							<div class="box box--circle" onclick="toggleTooltip($(this))">
								
								<figure>
									<img src="<?php the_sub_field('partner_logo'); ?>" />
								</figure>

							</div>

							<div class="box box--info-tooltip">
								<?php the_sub_field('partner_description'); ?>
								<?php if (strlen(get_sub_field('partner_link')) > 0) : ?>
									<a href="<?php the_sub_field('partner_link'); ?>" target="_blank" class="button button--small"><?= pll__('Visit site', 'Team') ?></a>
								<?php endif ?>
							</div>

						<?php elseif(strlen(get_sub_field('partner_logo')) > 0) : ?>

							<div class="box box--circle">
								<figure><img src="<?php the_sub_field('partner_logo'); ?>" /></figure>
							</div>

						<?php endif ?>

					</div>

			<?php endwhile; endif; ?>
		</div>
</section>

<section id="partners" class="bg-greylightest content">
	<h4 class="content align-center"><?php the_field('ff_section_title'); ?></h4>
		<div class="row row--nopadding partners-grid align-center">
		<?php
		
			// check if the repeater field has rows of data
			if( have_rows('friends_and_family') ):

				// loop through the rows of data
				while ( have_rows('friends_and_family') ) : the_row(); ?>

					<!-- // display a sub field value -->

						<div class="col-xs-6 col-sm-3 partner">
							<a href="<?php the_sub_field('friends_and_family_link'); ?>" target="_blank" class="box box--circle box--circle-small">
								<figure>
									<img src="<?php the_sub_field('friends_and_family_logo'); ?>" />
								</figure>
							</a>
						</div>

		<?php endwhile;

		else :

			// no rows found

		endif;
		?>
	</div>

</section>


<?php get_footer();
