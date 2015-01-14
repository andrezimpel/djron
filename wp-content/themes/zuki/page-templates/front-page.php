<?php
/**
 * Template Name: Front Page
 *
 * Description: A page template for a Custom Front Page
 *
 * @package Zuki
 * @since Zuki 1.0
 */

get_header(); ?>

<div id="primary" class="site-content" role="main">

<?php
	if ( zuki_has_featured_posts() ) {
		// Include the featured content slider template.
		get_template_part( 'content-featured' );
	}
?>

<?php get_sidebar( 'fullwidth-top' ); ?>
<?php get_sidebar( 'content-one' ); ?>
<?php get_sidebar( 'front-one' ); ?>
<?php get_sidebar( 'fullwidth-center' ); ?>
<?php get_sidebar( 'content-two' ); ?>
<?php get_sidebar( 'front-two' ); ?>
<?php get_sidebar( 'fullwidth-bottom' ); ?>

</div><!-- end #primary -->

<?php get_footer(); ?>