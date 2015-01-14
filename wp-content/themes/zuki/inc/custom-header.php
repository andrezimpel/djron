<?php
/**
 * Implement a custom logo for Zuki
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package Zuki
 * @since Zuki 1.0
 */

function zuki_custom_header_setup() {
	$args = array(
		'default-image'          => '',
		'default-text-color'     => '000',
		'width'                  => 400,
		'height'                 => 100,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'zuki_header_style',
		'admin-head-callback'    => 'zuki_admin_header_style',
		'admin-preview-callback' => 'zuki_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );

}
add_action( 'after_setup_theme', 'zuki_custom_header_setup', 11 );


/**
 * Style the header text displayed on the blog.
 *
 * @since Zuki 1.0
 *
 * @return void
 */
function zuki_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="zuki-header-css">
	<?php
		if ( ! empty( $header_image ) and  display_header_text()) :
	?>
		#site-title h1 {

		}
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		#site-title h1,
		#site-title h2.site-description {
			display: none;
		}

	<?php

		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		#site-title h1 a {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
		#site-title h2.site-description {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Style the header image displayed on the Appearance > Header admin panel.
 *
 * @since Zuki 1.0
 *
 * @return void
 */
function zuki_admin_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();
?>
	<style type="text/css" id="zuki-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url(' . esc_url( $header_image ) . ') 0 0 no-repeat;';
		} ?>
	}
	#headimg img {

	}
	<?php if ( ! display_header_text() ) : ?>
	#headimg h1,
	#headimg h2 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	#headimg h1 {
		position: absolute !important;
		clip: rect(1px 1px 1px 1px); /* IE7 */
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php endif; ?>

	#headimg h1  {
		display: inline;
		margin: 0;
		padding: 0;
		font-family: 'Karla', Verdana, Arial, sans-serif;
		font-size: 20px;
		line-height: 1.2;
	 }
	#headimg h1 a {
		display: inline;
		text-decoration: none;
	}
	#headimg h2 {
		font-family: 'Libre Baskerville', Georgia, serif;
		margin: 0;
		text-shadow: none;
		padding: 0;
		font-size: 12px;
		font-weight: normal;
		font-style: italic;
		display: inline;
		line-height: 1.15;
	}
	#headimg h2:before {
	content: '\2014';
	display: inline;
	padding: 0 15px 0 13px;
	-webkit-font-smoothing: antialiased;
}
	</style>
<?php
}

/**
 * Output markup to be displayed on the Appearance > Header admin panel.
 *
 * @since Zuki 1.0
 *
 * @return void
 */
function zuki_admin_header_image() {
	?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="#"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc" <?php echo $style; ?> class="displaying-header-text"><?php bloginfo( 'description' ); ?></h2>
	</div>
<?php }
