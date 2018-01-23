<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Die_Brueder_Shop
 */

get_header(); ?>
	<?php 	 do_action('die_brueder_header_special'); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">
		<h3 ><?php printf( __( 'Searched for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
	<?php
		if ( have_posts() ) : ?>

		<ul id="isotope">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

			the_posts_navigation();
		?>
		</ul>
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->

	</section><!-- #primary -->

<?php

get_footer();
