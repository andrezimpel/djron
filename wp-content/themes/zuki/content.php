<?php
/**
 * The default template for displaying content
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail(); ?></a>
		</div><!-- end .entry-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<div class="entry-details">
				<div class="entry-author">
				<?php
					printf( __( 'Published by <a href="%1$s" title="%2$s">%3$s</a>', 'zuki' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					sprintf( esc_attr__( 'All posts by %s', 'zuki' ), get_the_author() ),
					get_the_author() );
				?>
				</div><!-- end .entry-author -->
		</div><!-- end .entry-details -->
	</header><!-- end .entry-header -->

		<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search results. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Read More', 'zuki' ) ); ?>
				<?php
					wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'zuki' ),
					'after'  => '</div>',
					) );
				?>
			</div><!-- end .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta cf">
			<div class="entry-date">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
			</div><!-- end .entry-date -->
			<?php if ( comments_open() ) : ?>
				<div class="entry-comments">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
				</div><!-- end .entry-comments -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'zuki' ), '<div class="entry-edit">', '</div>' ); ?>
			<div class="entry-cats">
				<?php the_category(' / '); ?>
			</div><!-- end .entry-cats -->
		</footer><!-- end .entry-meta -->

</article><!-- end post -<?php the_ID(); ?> -->