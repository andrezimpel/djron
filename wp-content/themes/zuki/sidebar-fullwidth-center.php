<?php
/**
 * The Middle FullWidth Widget Area on the Custom Front Page Template
 *
 * @package Zuki
 * @since Zuki 1.0
 */

if ( ! is_active_sidebar( 'front-fullwidth-center' ) ) {
	return;
}
?>
<div id="front-fullwidth-center" class="front-fullwidth widget-area">
	<?php dynamic_sidebar( 'front-fullwidth-center' ); ?>
</div><!-- #front-fullwidth-center -->