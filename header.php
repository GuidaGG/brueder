<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Die_Brueder_Shop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<!-- <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'die-brueder-shop' ); ?></a> -->

	<header id="masthead" class="site-header">
		<?php
		do_action("die_brueder_page_titles");
		?>

			
		
			<?php
			/**
			 * Functions hooked into die_brueder_header action
			 *
			 * @hooked die_brueder_site_search			           - 0
			 * @hooked die_brueder_primary_navigation              - 10
			 * @hooked die_brueder_header_cart			           - 20

			 */
		do_action( 'die_brueder_header' ); ?>
		
		<div id="site-navigation-trans"></div>

		<div id="up_mobile" class="arrow up_mobile">↓</div>
			
	</header><!-- #masthead -->

	<div id="content" class="site-content">