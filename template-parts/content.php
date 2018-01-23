<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Die_Brueder_Shop
 */

?>
	<?php 	 do_action('die_brueder_header_special'); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="entry-content">
		<?php
		
			//print the content from laygrid
	
			the_laygrid();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'die-brueder-shop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php 
	if(!wp_is_mobile()):
		die_brueder_shop_posts_related(); 
	else:
		die_brueder_shop_posts_related_mobile(); 
	endif;?>
	
</article><!-- #post-<?php the_ID(); ?> -->
