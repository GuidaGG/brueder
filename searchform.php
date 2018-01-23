<?php
/**
 * Template for displaying search forms in Die BRueder
 *
 * @package WordPress
 * @subpackage Die Brueder
 * @since Die Brueder 1.0
 */
?>
	<form method="get" id="search-form" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	
		<input type="text"  class="search-field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'diebrueder' ); ?>" autocomplete="off" />
		<input type="submit" class="search-submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'diebrueder' ); ?>" />
	</form>