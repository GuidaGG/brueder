<?php
/**
 * The template for displaying the homepage.
 *
 *
 * Template name: Homepage
 *
 * @package Die_Brueder_Shop
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/**
			 * Functions hooked in to homepage action
			 *
			 * @hooked die_brueder_featured_products     - 0
		
			 */
			do_action( 'homepage' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
