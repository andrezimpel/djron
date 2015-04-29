<?php
/**
 * The default template for displaying content
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" class="rp-medium-two">
  <div class="rp-medium-two-content">
		<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="entry-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail("zuki-medium-landscape"); ?></a>
			</div><!-- end .entry-thumbnail -->
		<?php endif; ?>

		<div class="story">
			<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			<div class="entry-author">
				<div class="entry-date">
					<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
				</div>
			</div><!-- end .entry-author -->
			<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search results. ?>
				<p class="summary">
					<?php echo zuki_excerpt(30); ?>
				</p><!-- .summary -->
			<?php endif; ?>
			<div style="display: none">
				<div class="entry-date"><a href="http://djron.dev/2014/07/10/splash-festival-2014/" class="entry-date">Juli 10, 2014</a></div>
									<div class="entry-comments">
					<a href="http://djron.dev/2014/07/10/splash-festival-2014/#respond"><span class="leave-reply">Kommentare 0</span></a>					</div><!-- end .entry-comments -->
									<div class="entry-cats">
					<a href="http://djron.dev/category/allgemein/" rel="category tag">Allgemein</a>					</div><!-- end .entry-cats -->
			</div>
		</div><!--end .story -->
	</div><!--end .rp-medium-two-content -->
</article>
