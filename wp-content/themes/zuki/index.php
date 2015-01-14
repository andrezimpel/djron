<?php
/**
 * The main template file.
 *
 * @package Zuki
 * @since Zuki 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content cf" role="main">
		<h3 class="blog-title"><?php _e('Latest Posts', 'zuki') ?></h3>
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'content' );

				endwhile;
		?>

		<?php
		// Previous/next post navigation.
		zuki_content_nav( 'nav-below' ); ?>

	</div><!-- end #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>