<?php
/**
 * The template for displaying the footer.
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<?php get_sidebar( 'footer' ); ?>

<footer id="colophon" class="site-footer cf">
	<?php if ( '' != get_bloginfo('description') ) : ?>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
	<?php endif; ?>

	<?php if (has_nav_menu( 'footer-social' ) ) : ?>
		<div id="footer-social-nav">
			<?php if ( get_theme_mod( 'footer_socialmenu_title' ) ) : ?>
				<h3 class="social-nav-title"><?php echo wp_kses_post( get_theme_mod( 'footer_socialmenu_title' ) ); ?></h3>
			<?php else : ?>
				<h3 class="social-nav-title"><?php _e('Follow Us', 'zuki') ?></h3>
			<?php endif; ?>
			<?php wp_nav_menu( array('theme_location' => 'footer-social', 'container' => 'false', 'depth' => -1));  ?>
		</div><!-- end #footer-social -->
	<?php endif; ?>

	<div id="site-info">
		<ul class="credit" role="contentinfo">
			<?php if ( get_theme_mod( 'credit_text' ) ) : ?>
				<li><?php echo wp_kses_post( get_theme_mod( 'credit_text' ) ); ?></li>
			<?php else : ?>
			<li class="copyright"><?php _e('Copyright', 'zuki') ?> &copy; <?php echo date('Y'); ?> <a href="<?php echo home_url( '/' ); ?>"><?php bloginfo(); ?>.</a></li>
			<li class="wp-credit">
				<?php _e('Proudly powered by', 'zuki') ?> <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'zuki' ) ); ?>" ><?php _e('WordPress.', 'zuki') ?></a>
			</li>
			<li>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'zuki' ), 'Zuki', '<a href="http://www.elmastudio.de/en/" rel="designer">Elmastudio</a>' ); ?>
			</li>
			<?php endif; ?>
		</ul><!-- end .credit -->
	</div><!-- end #site-info -->

</footer><!-- end #colophon -->
</div><!-- end #main-wrap -->

</div><!-- end #container -->

<?php wp_footer(); ?>

</body>
</html>