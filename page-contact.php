<?php
/**
 *  * Template Name: Contact
 */

get_header(); ?>

<section class="bg-greylightest content">

	<h4 class="align-center" style="margin-bottom: 1.5rem;"><?php the_title(); ?></h4>

	<div class="row row--nopadding">
		<div class="col-xs-12 col-lg-5">
			<?php the_field('left_text'); ?>
			<?php the_field('right_text'); ?>
		</div>
		<div class="col-xs-12 col-lg-6 col-lg-offset-1">
			<?php the_field('form'); ?>
		</div>
	</div>

</section>

<section class="content">

	<div class="row row--nopadding">
		<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile; // End of the loop.
			?>
		</div>
	</div>
</section>

<?php get_footer();
