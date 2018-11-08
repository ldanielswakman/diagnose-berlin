<?php
/**
 *  * Template Name: How We Work
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
		<div class="col-xs-12 col-md-4 usp usp--1">
			<img src="<?php the_field('point_1_image'); ?>"/>
			<?php the_field('point_1'); ?>
		</div>
		<div class="col-xs-12 col-md-4 usp usp--2">
			<img src="<?php the_field('point_2_image'); ?>"/>
			<?php the_field('point_2'); ?>
		</div>
		<div class="col-xs-12 col-md-4 usp usp--3">
			<img src="<?php the_field('point_3_image'); ?>"/>
			<?php the_field('point_3'); ?>
		</div>
	</div>
</section>

<section id="for_athletes" class="section--service">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6 image">
			<figure><img src="<?php the_field('persona_1_image'); ?>" alt="" /></figure>
		</div>
        <div class="col-xs-12 col-sm-6 text">
			<div class="box">
				<?php the_field('persona_1_text'); ?>
				<a href="<?php the_field('persona_1_button_link'); ?>" class="button button--primary button--large"><?php the_field('persona_1_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section id="for_runners" class="section--service">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6 image">
			<figure><img src="<?php the_field('persona_2_image'); ?>" alt="" /></figure>
		</div>
        <div class="col-xs-12 col-sm-6 text">
			<div class="box">
				<?php the_field('persona_2_text'); ?>
				<a href="<?php the_field('persona_2_button_link'); ?>" class="button button--primary button--large"><?php the_field('persona_2_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>

<section id="weight_watchers" class="section--service">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6 image">
			<figure><img src="<?php the_field('persona_3_image'); ?>" alt="" /></figure>
		</div>
        <div class="col-xs-12 col-sm-6 text">
			<div class="box">
				<?php the_field('persona_3_text'); ?>
				<a href="<?php the_field('persona_3_button_link'); ?>" class="button button--primary button--large"><?php the_field('persona_3_button_text'); ?></a>
			</div>
		</div>
	</div>
</section>


<?php get_footer();
