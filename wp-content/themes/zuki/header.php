<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main-wrap">
 *
 * @package Zuki
 * @since Zuki 1.0
 */
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="container">

		<header id="masthead" class="cf" role="banner">

			<?php if (has_nav_menu( 'header-top' ) ) : ?>
				<nav id="header-top-nav">
					<?php wp_nav_menu( array('theme_location' => 'header-top', 'container' => 'false', 'depth' => -1 ));  ?>
				</nav><!-- end #header-top -->
			<?php endif; ?>

			<div id="site-title">
			<?php if ( get_header_image() ) : ?>
				<div id="site-header">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt=""></a>
				</div><!-- end #site-header -->
			<?php endif; ?>
				<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( '' != get_bloginfo('description') ) : ?>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
			</div><!-- end #site-title -->

			<a href="#menuopen" id="mobile-menu-toggle"><span><?php _e( 'Menu', 'zuki' ); ?></span></a>

			<div id="mobile-menu-wrap" class="cf">
				<?php if ( get_theme_mod( 'show_headersearch' ) ) : ?>
					<div class="search-box">
						<a href="#" id="search-toggle"><span><?php _e( 'Search', 'zuki' ); ?></span></a>
						<?php get_search_form(); ?>
					</div><!-- end .search-box -->
				<?php endif; ?>
				<nav id="site-nav" class="cf">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'container' => 'false') ); ?>
				</nav><!-- end #site-nav -->
				<a href="#menuclose" id="mobile-menu-close"><span><?php _e( 'Close Menu', 'zuki' ); ?></span></a>
			</div><!-- end #mobile-menu-wrap -->

			<?php if ( get_theme_mod( 'show_headerarchive' ) ) : ?>
				<?php get_template_part( 'content-archivemenu' ); ?>
			<?php endif; ?>

		</header><!-- end #masthead -->

<div id="main-wrap">
