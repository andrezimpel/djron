<?php
/**
 * The Footer widget areas.
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<?php
	/* Check if any of the footer widget areas have widgets.
	 *
	 * If none of the footer widget areas have widgets, let's bail early.
	 */
	if (   ! is_active_sidebar( 'footer-one' )
		&& ! is_active_sidebar( 'footer-two' )
		&& ! is_active_sidebar( 'footer-three' )
		&& ! is_active_sidebar( 'footer-four' )
		&& ! is_active_sidebar( 'footer-five' )
		)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<div id="footerwidgets-wrap" class="cf">
	<?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
		<div id="footer-one" class="default-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-one' ); ?>
		</div><!-- end #footer-one -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
		<div id="footer-two" class="default-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-two' ); ?>
		</div><!-- end #footer-two -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-three' ) ) : ?>
		<div id="footer-three" class="default-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-three' ); ?>
		</div><!-- end #footer-three -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-four' ) ) : ?>
		<div id="footer-four" class="default-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-four' ); ?>
		</div><!-- end #footer-four -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-five' ) ) : ?>
		<div id="footer-five" class="default-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'footer-five' ); ?>
		</div><!-- end #footer-five -->
	<?php endif; ?>
</div><!-- end #footerwidgets-wrap -->