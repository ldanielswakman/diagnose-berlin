<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
/**
 *  * Template Name: Blog
 */

get_header(); ?>

<section id="featured" class="content load-movein-btm load-delay-03s">
	<div class="row">
		<!-- Featured posts -->
  </div>
</section>

<section id="articles" class="bg-greylightest content load-movein-btm load-delay-05s">
  <div class="row row--nopadding">

		<?php if ( have_posts() ) : ?>

			<? while ( have_posts() ) : the_post(); ?>

        <a href="<?php echo get_post_permalink() ?>" class="col-xs-12 col-sm-6 post-preview">
          <figure class="post-preview__figure"><img src="https://picsum.photos/458/352" alt="" /></figure>
          <div class="post-preview__text">
            <h3><?php echo get_the_title() ?></h3>
            <?php the_excerpt() ?>
          </div>
        </a>

			<?php endwhile; ?>

		<? endif ?>

	</div>
</section>

<?php get_footer();
