<?php get_header(); ?>

<section class="bg-greylightest content">

	<h4 class="align-center"><?php the_title(); ?></h4>

</section>

<section class="content">

	<div class="row row--nopadding">
		<div class="col-xs-12 col-lg-8 col-lg-offset-2">
			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile; // End of the loop.
			?>
		</div>
	</div>
</section>

<?php get_footer();
