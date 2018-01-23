<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Die_Brueder_Shop
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1><?php esc_html_e( 'Nothing Found', 'die-brueder-shop' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'die-brueder-shop' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>
		<?php

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
