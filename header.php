<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/scripts.js"></script>
	

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<section id="hero" class="load-fadein">

		<nav>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/logo-monogram.svg" alt="Diagnose Berlin" class="logo__monogram" />
			  <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/logo-wordmark.svg" alt="Diagnose Berlin" class="logo__wordmark" />
			</a>

			<?php if ( has_nav_menu( 'top' ) ) : ?>
				<?php wp_nav_menu( array(
					'theme_location' => 'top',
					'menu_id'        => 'top-menu',
				) ); ?>
				
				<button class="menu-toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>
			<?php endif; ?>
			
		</nav>

	</section><!-- #hero -->

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	 */
	if ( ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'twentyseventeen-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;
	?>