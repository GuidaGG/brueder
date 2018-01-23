<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Die_Brueder_Shop
 */

?>

<li class="p-scroll">
		<?php
		//post tumbnail
	
	 woocommerce_template_loop_product_thumbnail();
		
		?>



</li><!-- #post-<?php the_ID(); ?> -->
