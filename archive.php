<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>

<?php
    the_archive_title( '<h1 class="page-title">', '</h1>' );
?>
<?php endif; ?>
<section id="categories" class="load-fadein">
<?php wp_list_categories( array(
        'orderby'    => 'name',
        'exclude'    => array( 239, 241 )
    ) ); ?> 
</section>
<?php
if ( have_posts() ) : ?>
    <?php
    /* Start the Loop */
    while ( have_posts() ) : the_post(); ?>

<section id="articles" class="bg-greylightest content load-movein-btm load-delay-05s">
    <div class="row row--nopadding">
        <a href="<?php the_permalink(); ?>" class="col-xs-12 col-sm-6 post-preview">
            <figure class="post-preview__figure"><?php the_post_thumbnail(); ?></figure>
            <div class="post-preview__text">
                <?php
                    the_title( '<h3>', '</h3>' );
                ?>
                <p><?php the_excerpt(); ?></p>
            </div>
        </a>
    </div>
</section>
<?php endwhile;

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

<?php get_footer();
