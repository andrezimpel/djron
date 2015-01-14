<?php
/**
 * The template for displaying featured posts in a slider on the front page
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<li id="post-<?php the_ID(); ?>" class="rp-big-one featured cf" ?>
	<div class="rp-big-one-content">

		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-fullwidth'); ?></a>
		</div><!-- end .entry-thumb -->
		<?php endif; ?>

		<div class="story">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<div class="entry-author">
			<?php
				printf( __( '<span>by</span> <a href="%1$s" title="%2$s">%3$s</a>', 'zuki' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'All posts by %s', 'zuki' ), get_the_author() ),
				get_the_author() );
			?>
			</div><!-- end .entry-author -->
			<p class="summary"><?php echo zuki_excerpt(65); ?></p>
			<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
			<?php if ( comments_open() ) : ?>
			<div class="entry-comments">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'comments 0', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
			</div><!-- end .entry-comments -->
			<?php endif; // comments_open() ?>
			<div class="entry-cats">
				<?php the_category(', '); ?>
			</div><!-- end .entry-cats -->
		</div><!--end .story -->

	</div><!--end .rp-big-one-content -->
</li><!--end .rp-big-one -->