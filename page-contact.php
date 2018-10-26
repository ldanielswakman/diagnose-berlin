<?php
/**
 *  * Template Name: Contact
 */

get_header(); ?>

<section class="bg-greylightest content">

	<h4 class="align-center"><?php the_title(); ?></h4>

	<div class="row row--nopadding">
		<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
			<?php the_field('left_text'); ?>
			<?php the_field('right_text'); ?>
		</div>
		<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
			<?php the_field('form'); ?>
		</div>
	</div>

</section>

<section class="content">

	<div class="row row--nopadding">
		<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-2">
			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile; // End of the loop.
			?>
		</div>
	</div>
</section>

<?php get_footer();
