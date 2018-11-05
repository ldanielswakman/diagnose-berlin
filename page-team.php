<?php
/**
 *  * Template Name: Team
 */

get_header(); ?>

<section id="team" class="bg-greylightest load-fadein">
	<div class="row row--nopadding">
		<div class="col-xs-12 content align-center">
			<h1><?php the_title(); ?></h1>
		</div>
		<?php
		
			// check if the repeater field has rows of data
			if( have_rows('team_member') ):

				// loop through the rows of data
				while ( have_rows('team_member') ) : the_row(); ?>

					<!-- // display a sub field value -->

					<div class="col-xs-12 col-sm-6 col-lg-4 content">

						<figure>
							<img src="<?php the_sub_field('member_headshot'); ?>" />
						</figure>

						<h2><?php the_sub_field('member_name'); ?></h2>
						<br />

						<div class="small"><?php the_sub_field('member_description'); ?></div>

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
					<div class="col-xs-12 col-sm-4">
						<blockquote class="blockquote--big">
							<p><?php the_field('middle_headline'); ?></p>
						</blockquote>
					</div>
					<div class="col-xs-12 col-sm-8">
						<?php the_field('middle_description'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endwhile; ?>

<section id="partners" class="content">
	<h4 class="content align-center">OUR PARTNERS</h4>
		<div class="row row--nopadding partners-grid align-center">
		<?php
		
			// check if the repeater field has rows of data
			if( have_rows('partners') ):

				// loop through the rows of data
				while ( have_rows('partners') ) : the_row(); ?>

					<!-- // display a sub field value -->

						<div class="col-xs-6 col-sm-3">
							<a href="<?php the_sub_field('partner_link'); ?>" target="_blank" class="box box--circle">

								<figure>
									<img src="<?php the_sub_field('partner_logo'); ?>" />
								</figure>

								<div class="box box--info-tooltip" onclick="toggleTooltip($(this))">
									<?php the_sub_field('partner_description'); ?>
								</div>

							</a>
						</div>

		<?php endwhile;

		else :

			// no rows found

		endif;
		?>
		</div>
</section>

<section id="partners" class="bg-greylightest content">
	<h4 class="content align-center">FRIENDS & FAMILY</h4>
		<div class="row row--nopadding partners-grid align-center">
		<?php
		
			// check if the repeater field has rows of data
			if( have_rows('friends_and_family') ):

				// loop through the rows of data
				while ( have_rows('friends_and_family') ) : the_row(); ?>

					<!-- // display a sub field value -->

						<div class="col-xs-6 col-sm-3">
							<a href="<?php the_sub_field('friends_and_family_link'); ?>" target="_blank" class="box box--circle">
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
