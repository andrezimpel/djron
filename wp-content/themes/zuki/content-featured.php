<?php
/**
 * The template for displaying featured content slider
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<div id="featured-content" class="flexslider">
	<ul class="featured-posts slides">
	<?php
		do_action( 'zuki_featured_posts_before' );

		$featured_posts = zuki_get_featured_posts();
		foreach ( (array) $featured_posts as $order => $post ) :
			setup_postdata( $post );

			// Include the featured content template.
			get_template_part( 'content', 'featured-post' );

		endforeach;

		do_action( 'zuki_featured_posts_after' );

		wp_reset_postdata();
	?>
	</ul><!-- .featured-content-inner -->
</div><!-- #featured-content .featured-content -->
