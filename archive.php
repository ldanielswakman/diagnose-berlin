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

<?php endif; ?>
<section id="categories" class="categories content load-fadein">
    <?php wp_list_categories( array(
        'title_li'   => '<div class="title">' . __('Categories') . '</div>',
        'orderby'    => 'name',
        'exclude'    => array( 239, 241 )
    ) ); ?> 
    <a href="<?php echo esc_url( home_url( '/knowledge/' ) ); ?>" title="All posts">ALL POSTS</a>
</section>
<section id="featured" class="content load-movein-btm load-delay-03s">
    <div class="row">
        <?php
        // Get the ID of a given category
        $cat_id = get_queried_object_id();
        ?>
        <?php
        $args = [
            'posts_per_page' => 3,
            'orderby'        => 'name',
            'category__in' => array( 239, 241 ),
            'cat' => $cat_id,
];
        $q = new WP_Query( $args );

        if( $q->have_posts() ) {
            while( $q->have_posts() ) {
                $q->the_post();
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
        
        <?php  
            }
        } ?>
        
        <?php   
            wp_reset_postdata();
        ?>

    </div>
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
