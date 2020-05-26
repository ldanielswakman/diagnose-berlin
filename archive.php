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

<?php get_template_part('partials/knowledge-categories-bar') ?>

<section id="featured" class="content load-movein-btm load-delay-03s">
    <div class="row">
        <?php
            $cat = get_queried_object();
            $cat = $cat->slug;
            $the_query = get_featured_or_recent_posts(array (246,248) , $cat, 3 );
            $ids = array();
        ?>
        <?php 

        if ( $the_query ) :

            while ( $the_query->have_posts() ) :

        $the_query->the_post();
        $ids[] = get_the_ID(); 

        ?>
        <div class="col-xs-12 col-sm-6 col-lg-4" style="padding-bottom: 1.5rem;">

            <?php
            // Featured image
            $featured_img_url = (has_post_thumbnail()) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0] : ''; 
            ?>

            <a href="<?php the_permalink(); ?>" class="box box--featured" style="background-image: url('<?= $featured_img_url ?>');">
            <div class="box__content">
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
            </div>
            </a>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
    <?php  wp_reset_postdata(); ?>
    </div>
</section>

<section id="articles" class="bg-greylightest content load-movein-btm load-delay-05s">
    <div class="row row--nopadding">
        <?php  
        $query2 = new WP_Query(array('category_name' => $cat, 'post__not_in' => $ids));
        while ( $query2->have_posts() ) : $query2->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="col-xs-12 col-lg-6 post-preview">
        <figure class="post-preview__figure"><?php the_post_thumbnail(); ?></figure>
        <div class="post-preview__text">
            <h3><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
        </div>
        </a>
    <?php endwhile; ?>
    <?php  wp_reset_postdata(); ?>
    </div>
</section>
<?php get_footer();
