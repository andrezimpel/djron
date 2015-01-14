<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Zuki
 * @since Zuki 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function zuki_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' 		=> 'primary',
		'footer_widgets' 	=> array( 'footer-one', 'footer-two', 'footer-three', 'footer-four', 'footer-five' ),
		'footer'    		=> 'main-wrap',
	) );
}
add_action( 'after_setup_theme', 'zuki_jetpack_setup' );


/**
 * Add support for the Featured Content Plugin
 */
function zuki_featured_content_init() {
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'zuki_get_featured_posts',
		'description'             => __( 'The featured content slider displays at the top of the Front Page template.', 'zuki' ),
		'max_posts'               => 10,
	) );
}
add_action( 'after_setup_theme', 'zuki_featured_content_init' );


/**
 * Featured Posts
 */
function zuki_has_multiple_featured_posts() {
	$featured_posts = apply_filters( 'zuki_get_featured_posts', array() );
	return ( is_array( $featured_posts ) && 1 < count( $featured_posts ) );
}

function zuki_get_featured_posts() {
	return apply_filters( 'zuki_get_featured_posts', false );
}