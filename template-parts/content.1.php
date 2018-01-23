<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Die_Brueder_Shop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
	

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-thumbnail">
		<?php
		//post tumbnail
		die_brueder_post_thumbnail();
		?>
	</div>
		<?php
		endif; ?>
	<?php	
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<span class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span>' );
		endif;
	?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'die-brueder-shop' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'die-brueder-shop' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php die_brueder_shop_entry_footer(); ?>
		***** sharing button here *****
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
