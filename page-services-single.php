<?php
/**
 *  * Template Name: Single Service Page
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php $table_id = 1;

				$table = tablepress_get_table([
				'id' => $table_id,
				'use_datatables' => false,
				'print_name' => false,
				'alternating_row_colors' => false,
				'first_column_th' => true,
			]); ?>

			<?php echo parseTablePressTable($table) ?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
