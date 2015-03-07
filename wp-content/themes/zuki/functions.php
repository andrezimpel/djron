<?php

/**
 * Zuki functions and definitions
 *
 * @package Zuki
 * @since Zuki 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Sets up the content width value based on the theme's design.
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) )
    $content_width = 840;

/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers support for various WordPress features.
/*-----------------------------------------------------------------------------------*/

function zuki_setup() {

	// Make Zuki available for translation. Translations can be added to the /languages/ directory.
	load_theme_textdomain( 'zuki', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'editor-style.css' ) );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu().
	register_nav_menus( array (
		'primary' => __( 'Primary menu', 'zuki' ),
		'header-top' => __( 'Header Top menu', 'zuki' ),
		'footer-social' => __( 'Footer Social menu', 'zuki' ),
	) );

	// Implement the Custom Header feature
	require get_template_directory() . '/inc/custom-header.php';

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'zuki_custom_background_args', array(
		'default-color'	=> 'fff',
		'default-image'	=> '',
	) ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'zuki_get_featured_posts',
		'max_posts' => 10,
	) );

	// This theme uses post thumbnails.
	add_theme_support( 'post-thumbnails' );

	//  Adding several sizes for Post Thumbnails
	add_image_size( 'zuki-small-square', 120, 120, true ); // Small Square thumbnails (cropped)
	add_image_size( 'zuki-medium-portrait', 420, 560, true ); // Medium Portrait thumbnails (cropped)
	add_image_size( 'zuki-medium-landscape', 840, 560, true ); // Medium landscape thumbnails (cropped)
	add_image_size( 'zuki-fullwidth', 1200, 800, true ); // Big thumbnails (cropped)

  // This theme uses a custom image size for featured images, displayed on "standard" posts.
  // add_image_size( 'excerpt', 250, 175, true );
  // add_image_size( 'excerpt@2x', 500, 350, true );
  //
  // add_image_size( 'gallery_thumb', 172, 172, true );
  // add_image_size( 'gallery_thumb@2x', 344, 344, true );

  add_image_size( 'zuki-carousel', 1200, 675, true );
  #add_image_size( 'carousel2x', 1360, , true );

}
add_action( 'after_setup_theme', 'zuki_setup' );

/*-----------------------------------------------------------------------------------*/
/*  Returns the Google font stylesheet URL if available.
/*-----------------------------------------------------------------------------------*/

function zuki_font_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Libre Baskerville or Karla translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_baskerville = _x( 'on', 'Libre Baskerville: on or off', 'zuki' );

	$karla = _x( 'on', 'Karla font: on or off', 'zuki' );

	if ( 'off' !== $libre_baskerville || 'off' !== $karla ) {
		$font_families = array();

		if ( 'off' !== $libre_baskerville )
			$font_families[] = 'Libre Baskerville:400,700,400italic';

		if ( 'off' !== $karla )
			$font_families[] = 'Karla:400,400italic,700,700italic&subset=latin,latin-ext';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}


/*-----------------------------------------------------------------------------------*/
/*  Enqueue scripts and styles
/*-----------------------------------------------------------------------------------*/

function zuki_scripts() {
	global $wp_styles;

	// Loads JavaScript to pages with the comment form to support sites with threaded comments (when in use)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' );

	// FitVids for responsive videos
	wp_enqueue_script( 'zuki-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1' );

	// Loads Scripts for Featured Post Slider
	wp_enqueue_style( 'zuki-flex-slider-style', get_template_directory_uri() . '/js/flex-slider/flexslider.css' );
	wp_enqueue_script( 'zuki-flex-slider', get_template_directory_uri() . '/js/flex-slider/jquery.flexslider-min.js', array( 'jquery' ) );

	// Loads Custom Zuki JavaScript functionality
	wp_enqueue_script( 'zuki-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140426' );

	// Add Libre Baskerville font, used in the main stylesheet.
	wp_enqueue_style( 'zuki-fonts', zuki_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.0.3' );

	// Loads main stylesheet.
	wp_enqueue_style( 'zuki-style', get_stylesheet_uri(), array(), '20140630' );

}
add_action( 'wp_enqueue_scripts', 'zuki_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Enqueue Google fonts style to admin screen for custom header display.
/*-----------------------------------------------------------------------------------*/
function zuki_admin_fonts() {
	wp_enqueue_style( 'zuki-fonts', zuki_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'zuki_admin_fonts' );


/*-----------------------------------------------------------------------------------*/
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
/*-----------------------------------------------------------------------------------*/

function zuki_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'zuki_page_menu_args' );


/*-----------------------------------------------------------------------------------*/
/* Sets the authordata global when viewing an author archive.
/*-----------------------------------------------------------------------------------*/

function zuki_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'zuki_setup_author' );


/*-----------------------------------------------------------------------------------*/
/* Short Title.
/*-----------------------------------------------------------------------------------*/
function zuki_title_limit($length, $replacer = '...') {
 $string = the_title('','',FALSE);
 if(strlen($string) > $length)
 $string = (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
 echo $string;
}

/*-----------------------------------------------------------------------------------*/
/* Multiple Custom Excerpt Lengths
/*-----------------------------------------------------------------------------------*/

function zuki_excerpt($limit) {
 $excerpt = explode(' ', get_the_excerpt(), $limit);
 if (count($excerpt)>=$limit) {
 array_pop($excerpt);
 $excerpt = implode(" ",$excerpt).'...';
 } else {
 $excerpt = implode(" ",$excerpt);
 }
 $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
 return $excerpt;
}

function content($limit) {
 $content = explode(' ', get_the_content(), $limit);
 if (count($content)>=$limit) {
 array_pop($content);
 $content = implode(" ",$content).'...';
 } else {
 $content = implode(" ",$content);
 }
 $content = preg_replace('/[.+]/','', $content);
 $content = apply_filters('the_content', $content);
 $content = str_replace(']]>', ']]&gt;', $content);
 return $content;
}

/*-----------------------------------------------------------------------------------*/
/* Add custom max excerpt lengths.
/*-----------------------------------------------------------------------------------*/

function custom_excerpt_length( $length ) {
	return 175;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/*-----------------------------------------------------------------------------------*/
/* Replace "[...]" with an ellipsis in excerpts.
/*-----------------------------------------------------------------------------------*/

function zuki_auto_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'zuki_auto_excerpt_more' );


/*-----------------------------------------------------------------------------------*/
/* Add Theme Customizer CSS
/*-----------------------------------------------------------------------------------*/

function zuki_customize_css() {
    ?>
	<style type="text/css">
		.widget-area p.summary a,
		.entry-content p a,
		.entry-content li a,
		.page .entry-content p a,
		blockquote cite a,
		.textwidget a,
		#comments .comment-text a,
		.authorbox p.author-description a {color: <?php echo get_theme_mod('link_color'); ?>;}
		.widget_zuki_recentposts_color .bg-wrap {background: <?php echo get_theme_mod('widget_bg_color'); ?>;}
		.archive-menu-content {background: <?php echo get_theme_mod('headerarchive_bg_color'); ?>;}
	</style>
    <?php
}
add_action( 'wp_head', 'zuki_customize_css');


/*-----------------------------------------------------------------------------------*/
/* Remove inline styles printed when the gallery shortcode is used.
/*-----------------------------------------------------------------------------------*/

add_filter('use_default_gallery_style', '__return_false');


if ( ! function_exists( 'zuki_comment' ) ) :
/*-----------------------------------------------------------------------------------*/
/* Comments template zuki_comment
/*-----------------------------------------------------------------------------------*/
function zuki_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 40 ); ?>
			</div>

			<div class="comment-details cf">
				<div class="comment-author">
					<?php printf( __( '%s <span class="says">says</span>', 'zuki' ), wp_kses_post( sprintf( '%s', get_comment_author_link() ) ) ); ?>
				</div><!-- end .comment-author -->
				<ul class="comment-meta">
					<li class="comment-time"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php
						/* translators: 1: date */
							printf( __( '%1$s', 'zuki' ),
							get_comment_date());
						?></a>
					</li>
					<?php edit_comment_link();?>
				</ul><!-- end .comment-meta -->

			</div><!-- end .comment-details -->

			<div class="comment-text">
			<?php comment_text(); ?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'zuki' ); ?></p>
				<?php endif; ?>
			</div><!-- end .comment-text -->
			<?php if ( comments_open () ) : ?>
				<div class="comment-reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'zuki' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
			<?php endif; ?>

		</article><!-- end .comment -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><?php _e( '<span>Pingback:</span>', 'zuki' ); ?> <?php comment_author_link(); ?></p>
		<p class="pingback-edit"><?php edit_comment_link(); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/**
 * A helper conditional function that returns a boolean value.
 *
 * @since Zuki 1.0
 *
 * @return bool Whether there are featured posts.
 */
function zuki_has_featured_posts() {
	return ! is_paged() && (bool) zuki_get_featured_posts();
}


/*-----------------------------------------------------------------------------------*/
/* Register widgetized areas
/*-----------------------------------------------------------------------------------*/

function zuki_widgets_init() {

	register_sidebar( array (
		'name' => __( 'Blog - Sidebar', 'zuki' ),
		'id' => 'blog-sidebar',
		'description' => __( 'Widgets appear in a right-aligned sidebar on the default blog and on single posts.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - FullWidth Top', 'zuki' ),
		'id' => 'front-fullwidth-top',
		'description' => __( 'Widgets appear in a single-column widget area on the top of the Front Page (and above the Featured Content slider, if active).', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - Post Content 1', 'zuki' ),
		'id' => 'front-content-1',
		'description' => __( 'Widgets appear left of Sidebar 1 and below the FullWidth Top widget area. This widget area is especially designed for the custom Zuki Posts by Category widgets.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - Sidebar 1', 'zuki' ),
		'id' => 'front-sidebar-1',
		'description' => __( 'Widgets appear in a right-aligned sidebar area next to the Post Content 1 widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - FullWidth Center', 'zuki' ),
		'id' => 'front-fullwidth-center',
		'description' => __( 'Widgets will appear in a single-column widget area below the Post Content 1 and Sidebar 1 widget areas.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - Post Content 2', 'zuki' ),
		'id' => 'front-content-2',
		'description' => __( 'Widgets appear left of Sidebar 2 and below the FullWidth Center widget area. This widget area is especially designed for the custom Zuki Posts by Category widgets.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - Sidebar 2', 'zuki' ),
		'id' => 'front-sidebar-2',
		'description' => __( 'Widgets appear in a right-aligned sidebar area next to the Post Content 2 widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Front Page - FullWidth Bottom', 'zuki' ),
		'id' => 'front-fullwidth-bottom',
		'description' => __( 'Widgets will appear in a single-column widget area at the bottom of your Front Page above the footer.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer - 1', 'zuki' ),
		'id' => 'footer-one',
		'description' => __( 'First widget area of the 5-column Footer widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer - 2', 'zuki' ),
		'id' => 'footer-two',
		'description' => __( 'Second widget area of the 5-column Footer widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer - 3', 'zuki' ),
		'id' => 'footer-three',
		'description' => __( 'Third widget area of the 5-column Footer widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer - 4', 'zuki' ),
		'id' => 'footer-four',
		'description' => __( 'Fourth widget area of the 5-column Footer widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array (
		'name' => __( 'Footer - 5', 'zuki' ),
		'id' => 'footer-five',
		'description' => __( 'Fifth widget area of the 5-column Footer widget area.', 'zuki' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'zuki_widgets_init' );


if ( ! function_exists( 'zuki_content_nav' ) ) :


/*-----------------------------------------------------------------------------------*/
/* Display navigation to next/previous pages when applicable.
/*-----------------------------------------------------------------------------------*/

function zuki_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="nav-wrap cf">
			<nav id="<?php echo $nav_id; ?>">
				<div class="nav-previous"><?php next_posts_link( __( '<span>Previous Posts</span>', 'zuki'  ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( '<span>Next Posts</span>', 'zuki' ) ); ?></div>
			</nav>
		</div><!-- end .nav-wrap -->
	<?php endif;
}

endif; // zuki_content_nav


/*-----------------------------------------------------------------------------------*/
/* Display navigation to next/previous post when applicable.
/*-----------------------------------------------------------------------------------*/

function zuki_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<div class="nav-wrap cf">
		<nav id="nav-single">
			<div class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', 'zuki' ) ); ?></div>
			<div class="nav-next"><?php next_post_link('%link', __( '<span class="meta-nav">Next Post</span>%title', 'zuki' ) ); ?></div>
		</nav><!-- #nav-single -->
	</div><!-- end .nav-wrap -->
	<?php
}


/*-----------------------------------------------------------------------------------*/
/* Extends the default WordPress body classes
/*-----------------------------------------------------------------------------------*/
function zuki_body_class( $classes ) {

	if ( is_page_template( 'page-templates/front-page.php' ) )
		$classes[] = 'template-front';

	if ( is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'template-fullwidth';

	return $classes;
}
add_filter( 'body_class', 'zuki_body_class' );


/*-----------------------------------------------------------------------------------*/
/* Customizer additions
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/customizer.php';

/*-----------------------------------------------------------------------------------*/
/* Load Jetpack compatibility file.
/*-----------------------------------------------------------------------------------*/
require get_template_directory() . '/inc/jetpack.php';

/*-----------------------------------------------------------------------------------*/
/* Grab the Zuki Custom widgets.
/*-----------------------------------------------------------------------------------*/
require( get_template_directory() . '/inc/widgets.php' );

/*-----------------------------------------------------------------------------------*/
/* Grab the Zuki Custom shortcodes.
/*-----------------------------------------------------------------------------------*/
require( get_template_directory() . '/inc/shortcodes.php' );
