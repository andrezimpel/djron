<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="entry-cats">
			<?php the_category(', '); ?>
		</div><!-- end .entry-cats -->

		<div class="entry-date">
			<?php _e('', 'zuki') ?><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
		</div><!-- end .entry-date -->
		<?php if ( comments_open() ) : ?>
			<div class="entry-comments">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
			</div><!-- end .entry-comments -->
		<?php endif; // comments_open() ?>
		<?php edit_post_link( __( 'Edit', 'zuki' ), '<div class="entry-edit">', '</div>' ); ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- end .entry-header -->

	<?php if ( '' != get_the_post_thumbnail() && ! post_password_required()  &&  ! get_theme_mod('hide_singlethumb') ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail(); ?></a>
		</div><!-- end .entry-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'zuki' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- end .entry-content -->

	<footer class="entry-meta">
		<div class="entry-cats">
			<span><?php _e('Filed under: ', 'zuki') ?></span><?php the_category(', '); ?>
		</div><!-- end .entry-cats -->
		<?php $tags_list = get_the_tag_list();
			if ( $tags_list ): ?>
				<div class="entry-tags"><span><?php _e('Tagged with: ', 'zuki') ?></span><?php the_tags('', ', ', ''); ?></div>
		<?php endif; // get_the_tag_list() ?>

		<?php if ( get_the_author_meta( 'description' ) ): ?>
			<div class="authorbox cf">
				<div class="author-info">
					<h3 class="author-name"><span><?php _e('by ', 'zuki') ?></span><?php printf( "<a href='" .  esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) . "' rel='author'>" . get_the_author() . "</a>" ); ?></h3>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'zuki_author_bio_avatar_size', 120 ) ); ?>
					<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
				</div><!-- end .author-info -->
			</div><!-- end .author-wrap -->
		<?php endif; ?>
	</footer><!-- end .entry-meta -->
</article><!-- end .post-<?php the_ID(); ?> -->
