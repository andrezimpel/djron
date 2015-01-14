<?php
/**
 * Template for displaying the standard search forms
 *
 * @package Zuki
 * @since Zuki 1.0
 */
?>

<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="screen-reader-text"><span><?php _e( 'Search', 'zuki' ); ?></span></label>
	<input type="text" class="search-field" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Type to search&hellip;', 'placeholder', 'zuki' ); ?>" />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'zuki' ); ?>" />
</form>