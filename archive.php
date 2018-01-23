<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Die_Brueder_Shop
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="filter">
		<?php
		 $current_category = single_cat_title("", false); 

		if($current_category):
			$main = $current_category;
		else:
			$main = All;
		endif;
		?>
		<?php 	 do_action('die_brueder_header_special'); ?>
		<span class="filter-title">Filter by: <?php echo $main ?></span><span class="filter_arrow">&#8595;</span>
<?php 



		if(is_category()):
		ob_start();
		dynamic_sidebar( 'sidebar-1' );
		$sidebar_output = ob_get_clean();
		echo apply_filters( 'my_sidebar_output', $sidebar_output );
		
		
		elseif(is_tag()):
	
		dynamic_sidebar( 'sidebar-tags');
		
				  
		endif;
		?>
		</div>
		
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
	</div><!-- #primary -->

<?php

get_footer();
