<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<?php
/* Start the Loop */
while ( have_posts() ) : the_post(); ?>

    <?php
    // Featured image
    $featured_img_url = (has_post_thumbnail()) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' )[0] : ''; 
    ?>
    <section id="hero" class="section--hero load-fadein" style="background-image: url('<?= $featured_img_url ?>');">
      <div class="row row--nopadding">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 content align-center">
            <?php the_title( '<h1>', '</h1>' ); ?>
        </div>
      </div>
    </section>

    <section id="meta" class="section--meta bg-greylightest content load-movein-btm load-delay-05s">
      <div class="row row--nopadding">
        <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 meta">

            <div class="meta__date">
                <?php the_date(); ?>
            </div>

            <div class="meta__reading-time">
                <?= do_shortcode('<strong>[rt_reading_time]</strong> min read'); ?>
            </div>

            <div class="meta__categories">
                <object class="categories">
                    <?php
                    $categories = get_the_category();
                    $separator = ' ';
                    $output = '';
                    if ( ! empty( $categories ) ) {
                        foreach( $categories as $category ) {
                            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                        }
                        echo trim( $output, $separator );
                        
                    }
                    ?>
                </object>
            </div>
                
        </div>
      </div>
    </section>

    <section id="article" class="section--article content load-movein-btm load-delay-1s">
      <div class="row row--nopadding">
        <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
			get_the_title()
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
        </div>
    </div>
</section>


<?php endwhile; // End of the loop.
?>


<?php get_footer();
