<?php
/**
 *  * Template Name: How We Work
 */

get_header(); ?>

<section id="intro" class="load-fadein">
	<div class="col-xs-12 col-sm-6 col-md-5 col-sm-offset-1 content">
		<h1>
			<?php the_title(); ?>
		</h1>
        <blockquote class="blockquote--big">
			<?php the_field('opening_headline'); ?>
		</blockquote>
		<p><?php the_field('opening_text'); ?></p>
	</div>
</section>

<section id="usps" class="bg-greylightest content load-fadein load-delay-1s">
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<img src="<?php the_field('point_1_image'); ?>"/>
			<?php the_field('point_1'); ?>
		</div>
		<div class="col-xs-12 col-sm-4">
			<img src="<?php the_field('point_2_image'); ?>"/>
			<?php the_field('point_2'); ?>
		</div>
		<div class="col-xs-12 col-sm-4">
			<img src="<?php the_field('point_3_image'); ?>"/>
			<?php the_field('point_3'); ?>
		</div>
	</div>
</section>

<section id="for_athletes" style="margin-top: 10rem;">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6">
			<figure><img src="<?php the_field('persona_1_image'); ?>"</figure>
		</div>
        <div class="col-xs-12 col-sm-6" style="margin: 5rem 0 0 -5rem;">
			<div class="box">
				<?php the_field('persona_1_text'); ?>
				<a href="<?php the_field('persona_1_button_link'); ?>" class="button button--primary button--large"><?php the_field('persona_1_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section id="for_runners" style="margin-top: 10rem;">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6">
			<figure><img src="<?php the_field('persona_2_image'); ?>"</figure>
		</div>
        <div class="col-xs-12 col-sm-6" style="margin: 5rem 0 0 -5rem;">
			<div class="box">
				<?php the_field('persona_2_text'); ?>
				<a href="<?php the_field('persona_2_button_link'); ?>" class="button button--primary button--large"><?php the_field('persona_2_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section id="weight_watchers" style="margin-top: 10rem;">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6">
			<figure><img src="<?php the_field('persona_3_image'); ?>"</figure>
		</div>
        <div class="col-xs-12 col-sm-6" style="margin: 5rem 0 0 -5rem;">
			<div class="box">
				<?php the_field('persona_3_text'); ?>
				<a href="<?php the_field('persona_3_button_link'); ?>" class="button button--primary button--large"><?php the_field('persona_3_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>


<?php get_footer();
