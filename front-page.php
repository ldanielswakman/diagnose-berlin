<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<h1 class="page-title"><?php the_title(); ?></h1>
		<div class="card left-align">
			<?php the_field('first_cta_box'); ?>
			<div class="mainCTA orange"><a href="<?php the_field('first_cta_link'); ?>"><?php the_field('first_cta_text'); ?></a></div>
		</div>

		<div class="whitebkg section">
            <?php the_content(); ?>
		</div>
	
		<div class="gradientbkg section">
			<div class="section-text left-align">
				<?php the_field('services_section_intro'); ?>
			</div>
			<div id="services-carousel">
				<?php the_field('services_carousel'); ?>
			</div>
			<div class="section-text center-align">
				<?php the_field('services_section_cta_text_before_button'); ?><a class="secondaryCTA blue" href="<?php the_field('services_cta_link'); ?>"><?php the_field('services_cta_text'); ?></a><?php the_field('services_cta_text_after_button'); ?>
			</div>
		</div>
		
		<div class="graybkg section">
			<div class="card right-align">
				<div class="section-text">
					<?php the_field('services_section_intro'); ?>
				</div>
				<div class="secondaryCTA orange">
					<a href="<?php the_field('knowledgebase_cta_link'); ?>"><?php the_field('knowledgebase_cta_text'); ?></a>
				</div>
			</div>
			<div id="knowledgebase">
				<a href="#">
					<div id="kb-categories">
						<?php $categories =  get_categories();
							echo '<ul>';
							foreach  ($categories as $category) {
							  echo '<li>'. $category->cat_name .'</li>';
							}
							echo '</ul>';
						?>
					</div>
					<div id="kb-posts">
						<?php 
						   // the query
						   $the_query = new WP_Query( array(
							  'posts_per_page' => 3,
						   )); 
						?>

						<?php if ( $the_query->have_posts() ) : ?>
						  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<?php the_title(); ?>
							<?php the_excerpt(); ?>

						  <?php endwhile; ?>
						  <?php wp_reset_postdata(); ?>

						<?php else : ?>
						  <p><?php __('No Articles'); ?></p>
						<?php endif; ?>
					</div>
				</a>
			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->

<?php endwhile; ?>
<?php else : ?>
<?php get_template_part('includes/template','error'); // WordPress template error message ?>
<?php endif; ?>

<?php get_footer();
