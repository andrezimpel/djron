<?php
/**
 * The template for displaying image attachments.
 *
 * @package Zuki
 * @since Zuki 1.0
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header();
?>

	<div id="primary" class="site-content cf" role="main">
	<h3 class="blog-title"><?php _e('Images', 'zuki') ?></h3>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="entry-header">
				<div class="entry-date">
					<a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_date() ); ?></a>
				</div><!-- end .entry-date -->
				<div class="full-size-link"><a href="<?php echo esc_url(wp_get_attachment_url()); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></div>
				<?php edit_post_link( __( 'Edit', 'zuki' ), '<div class="entry-edit">', '</div>' ); ?>
			<h1 class="entry-title"><?php the_title(); ?></a></h1>
		</header><!--end .entry-header -->

		<div class="entry-wrap">
		<div class="entry-content">
			<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php
							$attachment_size = apply_filters( 'theme_attachment_size', 1180 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 1180 ) ); // filterable image width with 1200px limit for image height.
						?></a>

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>

			</div><!-- .attachment -->
		</div><!-- .entry-content -->
	</div><!-- end .entry-wrap -->

	</article><!-- #post-<?php the_ID(); ?> -->

	<?php
	// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() )
		comments_template();
	?>

	<div class="nav-wrap cf">
		<nav id="nav-single" class="cf">
			<div class="nav-next"><?php next_image_link( '%link', ( '<span>' . __( 'Next Image', 'zuki' ) . '</span>' ) ); ?></div>
			<div class="nav-previous"><?php previous_image_link( '%link', ( '<span>' . __( 'Previous Image', 'zuki' ) . '</span>' ) ); ?></div>
		</nav><!-- #nav-single -->
	</div><!-- end .nav-wrap -->

</div><!-- end #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>