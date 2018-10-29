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


<section id="hero-post">
	<div class="row row--nopadding">
		<div class="col-xs-10 col-sm-6 col-md-7 col-lg-5">
			<div class="box load-movein-btm load-delay-07s">
            	<blockquote class="blockquote--huge">
					<?php the_field('home_headline'); ?>
	            </blockquote>
				<a href="<?php the_field('first_cta_link'); ?>" class="button button--circle button--large button--primary button--outline"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow-down.svg" alt="" /></a>
			</div>
        </div>
	</div>
</section>


<section id="intro">
  <div class="row row--nopadding">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 content">
			<blockquote><p><?php the_field('second_home_headline'); ?></p></blockquote>
			<br/>
			<?php the_field('first_home_blurb'); ?>
		</div>
	</div>
</section>


<section id="services_preview">
	<div class="content">
		<?php the_field('services_section_intro'); ?>
	</div>
			<?php the_field('services_carousel'); ?>
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

    <a href="<?php the_field('knowledgebase_cta_link'); ?>" class="col-xs-12 col-sm-6 content">

			<? $the_query = new WP_Query(['posts_per_page' => 3]); ?>

			<?php if ( $the_query->have_posts() ) : ?>
			  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				
					<div class="post-preview">

						<figure class="post-preview__figure">
							<img src="https://picsum.photos/458/352" alt="" />	
						</figure>

						<div class="post-preview__text">
							<h3><?php the_title(); ?></h3>
						</div>

					</div>

			  <?php endwhile; ?>
			  <?php wp_reset_postdata(); ?>

			<?php else : ?>
			  <p><?php __('No Articles'); ?></p>
			<?php endif; ?>

    </a>

	</div>
</section>

<?php endwhile; ?>
<?php else : ?>
<?php get_template_part('includes/template','error'); // WordPress template error message ?>
<?php endif; ?>

<?php get_footer();
