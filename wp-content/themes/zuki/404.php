<?php
/**
 * The template for displaying 404 error pages.
 *
 * @package Zuki
 * @since Zuki 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content cf" role="main">

		<article id="post-0" class="page no-results not-found cf">

				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'zuki' ); ?></h1>
				</header><!--end .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try another search term?', 'zuki' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- end .entry-content -->
		</article><!-- end #post-0 -->

</div><!-- end #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>