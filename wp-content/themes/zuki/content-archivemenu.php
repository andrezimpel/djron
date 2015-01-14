<?php
/**
 * The template for displaying the header archive menu area
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<div class="archive-menu-wrap cf">
	<?php if ( get_theme_mod( 'headerarchive_title' ) ) : ?>
		<a href="#contents" class="archive-menu-toggle"><span><?php echo wp_kses_post( get_theme_mod( 'headerarchive_title' ) ); ?></span></a>
	<?php else : ?>
		<a href="#contents" class="archive-menu-toggle"><span><?php _e('Filter Contents', 'zuki') ?></span></a>
	<?php endif; ?>

	<div class="archive-menu-content cf">
		<a href="#closecontents" class="archive-menu-close"><span><?php _e('Close Contents', 'zuki') ?></span></a>

		<div class="list-years">
			<h3 class="archive-menu-title"><?php _e('Years', 'zuki') ?></h3>
			<ul class="yearly">
				<?php wp_get_archives( array (
					'type' => 'yearly'
					)
				); ?>
			</ul>
		</div><!-- end .list-years -->

		<div class="list-authors">
		<h3 class="archive-menu-title"><?php _e('Authors', 'zuki') ?></h3>
		<ul class="authors">
		<?php
			$blogusers = get_users( 'who=authors' );
			// Array of WP_User objects.
			foreach ( $blogusers as $user ) {
				echo '<li><a href=' . get_author_posts_url( $user->ID ) .  '><span class="author-avatar">'  . get_avatar( $user->user_email, '50' ) . '</span>';
				echo '<span class="author-name">'  . esc_html( $user->display_name ) . '</span></a></li>';
			}
			 ?>
		</ul>
		</div><!-- end .list-authors -->

		<div class="list-months-cats-tags">
			<h3 class="archive-menu-title"><?php _e('Filter by Month', 'zuki') ?></h3>
			<ul class="monthly">
				<?php wp_get_archives( array (
					'type' => 'monthly' )
				); ?>
			</ul>

			<h3 class="archive-menu-title"><?php _e('Filter by Categories', 'zuki') ?></h3>
			<ul>
				<?php wp_list_categories( array (
					'title_li' => '',
					'depth' => -1 )
				); ?>
			</ul>

			<h3 class="archive-menu-title"><?php _e('Filter by Tags', 'zuki') ?></h3>
			<div class="archive-menu-tags">
				<?php wp_tag_cloud( array (
					'separator' => ' / '
					)
				); ?>
			</div>
		</div><!-- end .list-months-cats-tags -->

	</div><!-- end .archive-menu-content -->
</div><!-- end #archive-menu-wrap -->