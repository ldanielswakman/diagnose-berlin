<?php
/**
 * Template Name: Main Services Page
 */

get_header(); ?>

<?php
    while ( have_posts() ) : the_post();

    // check if the repeater field has rows of data
    if( have_rows('individual_service') ):

        // loop through the rows of data
        while ( have_rows('individual_service') ) : the_row(); ?>

					<!-- // display a sub field value -->
<section id="<?php echo strtolower(get_sub_field('service_name')); ?>" class="section--service load-movein-btm">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-sm-6 image">
				<figure>
					<img src="<?php the_sub_field('service_image'); ?>">
				</figure>
			</div>
			<div class="col-xs-12 col-sm-6 text">
				<div class="title content">
					<h2 class="c-highlight">
						<img src="<?php the_sub_field('service_icon'); ?>">
						<?php the_sub_field('service_name'); ?>
					</h2>
				</div>
          		<div class="box">
					<blockquote class="blockquote--big">
						<p><?php the_sub_field('service_title'); ?></p>
					</blockquote>
					<p><?php the_sub_field('service_description'); ?></p>
					<a href="<?php the_sub_field('service_cta_#1_link'); ?>" class="button button--primary button--large"><?php the_sub_field('service_cta_#1_text'); ?></a>
					<a href="<?php the_sub_field('service_cta_#2_link'); ?>" class="c-highlight"><?php the_sub_field('service_cta_#2_text'); ?></a>
				</div>
			</div>
		</div>
	</section>
<?php endwhile;

else :

    // no rows found

endif;
endwhile; // End of the loop.
?>

<?php get_footer();
