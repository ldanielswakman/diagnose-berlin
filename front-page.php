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

<?php if (have_posts())  : while (have_posts()) : the_post(); ?>

<section class="section--post-hero">
	<div class="row row--nopadding content">
		<div class="col-xs-10 col-sm-6 col-md-7 col-lg-5">
			<blockquote class="blockquote--huge">
				<?php the_field('home_headline'); ?>
			</blockquote>
		</div>
	</div>
</section>

<section id="audiences">
	<div class="row content">

		<?php $audience_query = new WP_Query([
			'post_type' => 'page',
			'post_status' => 'publish',
			'meta_key' => '_wp_page_template',
			'meta_value' => 'page-audiences-single.php',
			'posts_per_page' => 4
		])
		?>

		<?php while ( $audience_query->have_posts() ) : $audience_query->the_post(); ?>
		
			<div class="col-xs-6 col-lg-3">
				<a href="<?php the_permalink() ?>" class="audience-tile">
					<figure class="audience-tile__bubble">
						<?php the_post_thumbnail(); ?>	
					</figure>
					<h3><?php the_title(); ?></h3>
				</a>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

	</div>
</section>


<section id="intro">
	<div class="row row--nopadding">
		<div class="col-xs-12 col-lg-8 col-lg-offset-2 content">
			<blockquote class="blockquote--large"><p><?php the_field('second_home_headline'); ?></p></blockquote>
			<br/>
			<?php the_field('first_home_blurb'); ?>
		</div>
	</div>
</section>

<section id="knowledge_preview">
	<div class="row row--nopadding">

		<div class="col-xs-12 col-sm-6 last-sm">
			<div class="box">
				<blockquote class="blockquote--big">
					<p><?php the_field('knowledgebase_section_headline'); ?></p>
				</blockquote>
				<br/>
				<?php the_field('knowledgebase_section_text'); ?>
				<br/>
				<a href="<?php the_field('knowledgebase_cta_link'); ?>" class="button button--primary button--outline button--large">
					<?php the_field('knowledgebase_cta_text'); ?>
				</a>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6 content">

			<?php $the_query = new WP_Query(['posts_per_page' => 3]); ?>

			<?php if ( $the_query->have_posts() ) : ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				
					<a href="<?php the_permalink() ?>" class="post-preview">

						<figure class="post-preview__figure">
							<?php the_post_thumbnail(); ?>	
						</figure>

						<div class="post-preview__text">
							<h3><?php the_title(); ?></h3>
						</div>

					</a>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

			<?php else : ?>
				<p><?php __('No Articles'); ?></p>
			<?php endif; ?>

		</div>

	</div>
</section>

<?php endwhile; ?>
<?php else : ?>
<?php get_template_part('includes/template','error'); // WordPress template error message ?>
<?php endif; ?>

<?php get_footer();
