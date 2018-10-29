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

<?php
    the_archive_title( '<h1 class="page-title">', '</h1>' );
    the_archive_description( '<div class="taxonomy-description">', '</div>' );
?>
		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
				if ( is_single() ) {
					twentyseventeen_posted_on();
				} else {
					echo twentyseventeen_time_link();
					twentyseventeen_edit_link();
				};
			echo '</div><!-- .entry-meta -->';
		};

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
        <?php
		/* translators: %s: Name of current post */
		the_excerpt( sprintf(
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
	</div><!-- .entry-content -->

<?php endwhile;

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

<section id="categories" class="load-fadein">
<?php wp_list_categories( array(
        'orderby'    => 'name',
        'exclude'    => array( 239, 241 )
    ) ); ?> 
</section>

<section id="featured" class="content load-movein-btm load-delay-03s">
    <div class="row">
        <div class="col-xs-12 col-md-4">
            <?php
                query_posts('showposts=3&cat=239,241');
                $ids = array();
                while (have_posts()) : the_post();
                $ids[] = get_the_ID(); 
            ?>
            
                <a href="<?php the_permalink(); ?>" class="box box--featured" style="background-image: url('<?php 
                        if ( has_post_thumbnail() ) {
                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                        }
                        echo $large_image_url[0];?>');">
                <div class="box__content">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                </div>
                </a>
            <?php endwhile; ?>            
        </div>
    </div>
</section>

<section id="articles" class="bg-greylightest content load-movein-btm load-delay-05s">
    <div class="row row--nopadding">
        <?php
        query_posts(array('post__not_in' => $ids));
        while (have_posts()) : the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="col-xs-12 col-sm-6 post-preview">
        <figure class="post-preview__figure"><?php the_post_thumbnail(); ?></figure>
        <div class="post-preview__text">
            <h3><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
            <object class="categories"><?php
                $categories = get_the_category();
                $separator = ' ';
                $output = '';
                if ( ! empty( $categories ) ) {
                    foreach( $categories as $category ) {
                        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                    }
                    echo trim( $output, $separator );
                    
                } 
                
                ?></object>
        </div>  
       </a>   
        
    <?php endwhile; ?>
        
    <?php  wp_reset_query(); ?>
    </div>
</section>

<?php get_footer();
