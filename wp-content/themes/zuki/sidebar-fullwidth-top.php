<?php
/**
 * The Top FullWidth Widget Area on the Custom Front Page Template
 *
 * @package Zuki
 * @since Zuki 1.0
 */

if ( ! is_active_sidebar( 'front-fullwidth-top' ) ) {
	return;
}
?>
<div id="front-fullwidth-top" class="front-fullwidth widget-area">
	<?php dynamic_sidebar( 'front-fullwidth-top' ); ?>
</div><!-- #front-fullwidth-top -->