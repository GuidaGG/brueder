<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Die_Brueder_Shop
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked die_brueder_secondary_navigation - 0
			 */
			do_action( 'die_brueder_footer' ); ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
