<?php
/**
 * The Blog Template File
 *

 *
 * @package Die_Brueder_Shop
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="filter">
		<span class="filter-title">Filter by: <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">All</a></span><span class="filter_arrow">&#8595;</span>

		<?php
		get_sidebar();
		?>
		</div>
		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<!-- <header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header> -->

			<?php
			endif;
			if(!wp_is_mobile()):
			?>
			<ul id="isotope">
			<?php

			/* Start the Loop */
			while ( have_posts() ) : the_post();
		
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'blog' );

			endwhile;

			the_posts_navigation();
			?> 
			</ul>
			<?php
		
			else:

			/* Start the Loop */
			while ( have_posts() ) : the_post();
		
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

				get_template_part( 'template-parts/content', 'blogmobile' );

			endwhile;

			the_posts_navigation();

			endif;	
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
