<?php
/**
 * The Top Right Sidebar on the Custom Front Page Template
 *
 * @package Zuki
 * @since Zuki 1.0
 */

if ( ! is_active_sidebar( 'front-sidebar-1' ) ) {
	return;
}
?>
<div id="front-sidebar-one" class="front-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'front-sidebar-1' ); ?>
</div><!-- #front-sidebar-one -->