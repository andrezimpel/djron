<div class="box-dates">
	<?php
		$dates_options = array(
			'limit' => 5,
			'scope' => 'upcoming',
			'show_tours' => 'no',
			'group_artists' => 'no',
			'artist_order' => 'alphabetical',
			'artist' => '1',
			'tour' => '',
			'venue' => '',
			'show_feeds' => 'no',
			'link_text' => ''
		);
	?>

	<?= gigpress_sidebar($dates_options); ?>

</div>












<div id="main-sidebar" class="widget-area hidden" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>
		<aside id="archives" class="widget widget_archive">
			<h3 class="widget-title"><?php _e( 'Archives', 'dw-minion' ); ?></h3>
			<ul>
				<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
			</ul>
		</aside>
		<aside id="meta" class="widget widget_meta">
			<h3 class="widget-title"><?php _e( 'Meta', 'dw-minion' ); ?></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</aside>
	<?php endif; ?>
</div>


sidebat
