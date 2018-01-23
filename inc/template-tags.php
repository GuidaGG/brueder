<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Die_Brueder_Shop
 */

if ( ! function_exists( 'die_brueder_shop_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function die_brueder_shop_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'die-brueder-shop' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'die-brueder-shop' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'die_brueder_shop_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function die_brueder_shop_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
		/*	$categories_list = get_the_category_list( esc_html__( ', ', 'die-brueder-shop' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
			/*	printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'die-brueder-shop' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}*/

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'die-brueder-shop' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tags %1$s', 'die-brueder-shop' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

	/*	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
					/*	__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'die-brueder-shop' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
		*/
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'die-brueder-shop' ),
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
		
		<span class="sharing">
		<?php
			//integration of the facebook share plug in
		//	echo do_shortcode('[Sassy_Social_Share style="background-color:#fff;"]')
		?>
		<span>
		
	<?php		
	}
endif;

//display tags on post
if ( ! function_exists( 'die_brueder_shop_entry_tags' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function die_brueder_shop_entry_tags() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
		/*	$categories_list = get_the_category_list( esc_html__( ', ', 'die-brueder-shop' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
			/*	printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'die-brueder-shop' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}*/

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'die-brueder-shop' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				return $tags_list; // WPCS: XSS OK.
			}
		}

	}
endif;

/*
if ( ! function_exists( 'die_brueder_shop_posts_related' ) ) :
		/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	/*function die_brueder_shop_posts_related() {
		
		$orig_post = $post;
		  global $post;
		  $tags = wp_get_post_tags($post->ID);
		   
		  if ($tags) {
			  $tag_ids = array();
			  foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			  $args=array(
			  'tag__in' => $tag_ids,
			  'post__not_in' => array($post->ID),
			  'posts_per_page'=>6, // Number of related posts to display.
			  'caller_get_posts'=>1
			  );
			   
			  $my_query = new wp_query( $args );
			  if( $my_query->have_posts() ) {
			 ?>

			 <section class="related related-posts">
				<h2>Related Content</h2>
				<ul id="isotope">
			 <?php
			  while( $my_query->have_posts() ) {
				  $my_query->the_post();
				  ?>
				  <li>
				  <?php
				  woocommerce_template_loop_product_thumbnail();
				  ?>
				  </li>
				 <?php
			  }
		  }
			?>
				</ul>
			</section>
		<?php
		}
		  $post = $orig_post;
		  wp_reset_query();
	}
endif;

*/

/**
	 * Get related content from posts and products
	 */

if ( ! function_exists( 'die_brueder_shop_posts_related' ) ) :
		
	function die_brueder_shop_posts_related() {
		
		$orig_post = $post;
		  global $post;
		
		$posts = get_field('related-p-custom');


	if(is_product()):?>
	<section class="related related-products">
  	<?php else: ?>
     <section class="related related-posts">
    <?php endif; ?>
	
	<?php if( $posts ): ?>
	<h2>Related Content</h2>

		<ul id="isotope">
	    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>
	        <li>
	              <?php
					

					 	 woocommerce_template_loop_product_thumbnail();

					  ?>
	        </li>
	    <?php endforeach; ?>
	   		</ul>
   	<?php endif; ?>

	</section>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php }
endif;


/**
	 * Get related content from posts and products
	 */

if ( ! function_exists( 'die_brueder_shop_posts_related_mobile' ) ) :
		
	function die_brueder_shop_posts_related_mobile() {
		
		$orig_post = $post;
		  global $post;
		
		$posts = get_field('related-p-custom');


	if(is_product()):?>
	<section class="related related-products">
  	<?php else: ?>
     <section class="related related-posts">
    <?php endif; ?>
	
	<?php if( $posts ): ?>
	<h2>Discover More</h2>
	    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>
	      
	              <?php
					
					if($type == "product"):
			     	wc_get_template_part( 'content', 'product' ); 
			     	else:
			     	wc_get_template_part( 'template-parts/content', 'blogmobile' ); 
					endif;
					  ?>
	    
	    <?php endforeach; ?>

	<?php endif; ?>

	</section>
    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php }
endif;