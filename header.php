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
<?php gravity_form_enqueue_scripts( 1, true ); ?>	

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
					'menu_id' => 'top',
					'container' => false
				) ); ?>

			<?php endif; ?>
				

			<?php if ( has_nav_menu( 'header_full_menu' ) ) : ?>

				<button class="menu-toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>

				<?php wp_nav_menu( array(
					'menu_id' => 'header_full_menu',
					'menu_class' => 'full-menu',
					'container' => false
				) ); ?>

			<?php endif; ?>
			
		</nav>

	</section><!-- #hero -->

