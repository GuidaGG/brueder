<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Shop
 */

?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     <a href="<?php echo get_permalink()?>">

		<?php
		//post tumbnail
		die_brueder_post_thumbnail();
		?>

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<!-- .entry-header -->


		<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shop' ),
				'after'  => '</div>',
			) );
		?>
	<!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'shop' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
	</a>
</li><!-- #post-<?php the_ID(); ?> -->
