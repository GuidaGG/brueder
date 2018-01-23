<?php
/**
 * Theme Functions
 *
 * @package Die_Brueder_Shop
 */


/* General */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function die_brueder_shop_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'die_brueder_shop_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function die_brueder_shop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}

add_action( 'wp_head', 'die_brueder_shop_pingback_header' );


/**
 * Call a shortcode function by tag name. - REVIEW THIS
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
 if ( ! function_exists( 'die_brueder_do_shortcode' ) ) {
 	
	function die_brueder_do_shortcode( $tag, array $atts = array(), $content = null ) {
		global $shortcode_tags;
	
		if ( ! isset( $shortcode_tags[ $tag ] ) ) {
			return false;
		}
	
		return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
	}
}

/* header*/

/**
 * Register menus
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_register_menus' ) ) {
	 
	function die_brueder_register_menus(){
	
		register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'die_brueder' ),
		'secondary' => __( 'Secondary Menu', 'die_brueder' ),
		'mainmenu-blog' => __( 'Blog Menu', 'die_brueder' ),
		'about' => __( 'About Menu', 'die_brueder' ),
		'shop' => __( 'Shop Menu', 'die_brueder' ),
		'cart' => __( 'Cart Menu', 'die_brueder' ),
		) );
	}

}

add_action( 'init', 'die_brueder_register_menus' );

/**
 * opengraph add
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'add_opengraph_doctype' ) ) {
	//Adding the Open Graph in the Language Attributes
	function add_opengraph_doctype( $output ) {
	        return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	    }
  }


add_filter('language_attributes', 'add_opengraph_doctype');

 if ( ! function_exists( 'insert_fb_in_head' ) ) {

	function insert_fb_in_head() {

     global $post;

       if($excerpt = $post->post_content) {
            $excerpt = strip_tags($post->post_content);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
    if(is_single() ) {
       
  
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
   
<?php
  if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
			$args = array( 
			    'post_type' => 'attachment', 
			    'post_mime_type' => 'image',
			    'numberposts' => -1, 
			    'post_status' => null, 
			    'post_parent' => $post->ID 
			); 
			$media= get_posts( $args );

	       //$media = get_attached_media( 'image' ,$post->ID );
	       foreach ($media as $image) {  
	       $pic = wp_get_attachment_image_src(  $image->ID);//replace this with a default image on your server or an image in your 
	       if($pic != false):
	        echo '<meta property="og:image" content="' . $pic[0]. '"/>';
	   		endif;
	        }
	   	 }
	    else{
	        $thumbnail_src = get_the_post_thumbnail_url();
	        echo '<meta property="og:image" content="' . esc_attr(  $thumbnail_src  ) . '"/>';

	    }

    } else {
    	
          
    	if(!is_search()):
?>	
   		<meta property="og:title" content="<?php echo the_title(); ?>"/>
		<?php  else:?>
		<meta property="og:title" content="Search"/>		
		<?php  endif;?>
    	<meta property="og:description" content="<?php echo $excerpt; ?>"/>
    	<meta property="og:type" content="article"/>
    	<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    	<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/> 
     	<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>"/>
    
<?php
    }

  }
}
add_action( 'wp_head', 'insert_fb_in_head', 5 );

/**
 * Display Site Search
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_site_search' ) ) {

	function die_brueder_site_search() {
		?>
		<div class="site-search">
			<?php get_search_form(); ?>
			<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
		</div>
		<?php
	}
}
if(!wp_is_mobile()):
add_action( 'die_brueder_header', 'die_brueder_site_search', 0);
endif;


/**
 * Display Page titles desktop
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_page_titles_desktop' ) ) {

	function die_brueder_page_titles_desktop() {
	?>
	<h1 class="page-title">
	<?php
	//if it is front page show blog title
		if(is_front_page()):
		bloginfo( 'name' ); 
		elseif(is_shop() || get_post_type()=="product" || is_product_category()):
		echo 'Shop';
		elseif(is_search()):
		echo 'Search';
		elseif(is_category()):
		echo 'Category';
		elseif(is_tag()):
		echo '#hashtag';
		elseif(get_post_type()=="post"):
		echo 'Blog';
		elseif(is_404()):
		echo 'Error';
		else:
		wp_title(''); 
		endif;
		
	?>
	</h1>
	<?php
	}
}

/**
 * Display Page titles mobile
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_page_titles_mobile' ) ) {

	function die_brueder_page_titles_mobile() {
		echo '<a class="page-title" href="'.get_site_url().'">Die Brueder</a>';
	}		
}

if(!wp_is_mobile()):
add_action('die_brueder_page_titles', 'die_brueder_page_titles_desktop');
else:
add_action('die_brueder_page_titles', 'die_brueder_page_titles_mobile');
endif;
/**
 * Display Primary Navigation
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_primary_navigation' ) ) {

	function die_brueder_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'die_brueder' ); ?>">
			<?php
			if(is_front_page()):
			$menu ='primary';
			elseif(is_home() || is_category() || (is_single() && !is_product())):
			$menu = 'mainmenu-blog';
			elseif(is_shop() || is_product_category() || is_product()):
			$menu = "shop";
			elseif(is_page(array('about','cart'))):
			$menu = sanitize_title( wp_title('', false));
			elseif(is_checkout()):
			$menu =  'cart';
			else:
			$menu ='primary';
			endif;

			wp_nav_menu(
				array(
					'theme_location'	=> $menu,
					'container_class'	=> 'primary-navigation',
					)
			);

		
			?>
	
	
		<?php
	}
}

/**
 * Display Primary Navigation
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_primary_navigation_mobile' ) ) {

	function die_brueder_primary_navigation_mobile() {
		
			wp_nav_menu(
				array(
					'theme_location'	=> 'primary',
					'container_class'	=> 'primary-navigation',
					)
			);

		
	}
}

if(!wp_is_mobile()):
add_action( 'die_brueder_header', 'die_brueder_primary_navigation', 10);
else:
add_action( 'die_brueder_header', 'die_brueder_primary_navigation_mobile', 10);
endif;

/**
 * Display Header Cart
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_header_cart' ) ) {

	function die_brueder_header_cart() {
	
		$class = 'current-menu-item';
		?>
		<div id="site-header-cart"class="menu-item menu-item-type-post_type menu-item-object-page site-header-cart menu">
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'die_brueder' ); ?>">
			<span class="<?php echo esc_attr( $class ); ?>"> Cart
				<span class="count">(<?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'die_brueder' ), WC()->cart->get_cart_contents_count() ) );?>)</span>
			</span>
			</a>
		</div>
		</nav><!-- #site-navigation -->
		
		<?php

		
	}
}

/**
 * Display Header Cart conditions
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_header_cart_conditionals' ) ) {

	function die_brueder_header_cart_conditionals() {
		if ( wp_is_mobile()): 

				die_brueder_header_cart();
			else:
				if( !is_cart() && !is_checkout()) :

					die_brueder_header_cart();
				endif;
			endif;
		
	}
}

add_action( 'die_brueder_header', 'die_brueder_header_cart_conditionals', 20);

/**
 * Display back to shop/blog
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_header_back' ) ) {

	function die_brueder_header_back() {
		$type;
		$utility_page = get_field('utility_page');
		
		if ( is_single() || $utility_page == 1 || is_category() || is_tag() || is_product_category() || is_checkout()) {

			if(get_post_type()== "post" || is_category() || is_tag() ) :
				$type = 'Blog';
			
		    elseif(get_post_type()== "product" ||  is_product_category()) :
		        $type = 'Shop';
		   	elseif(is_checkout()):
		   		 $type = 'Cart';
		    else:
		    	$type = 'Die Brueder';
	
		    endif;

		    if(is_product_category() || is_category() || is_tag() ) :

				$class = 'back-shop-1';
		    else:
		    	$class = 'back-shop-2';
		    endif;
				
				
		?>
	
		
		
		<span class="<?php echo $class;?> ">
		<a href=" <?php

		echo get_permalink(get_page_by_title($type));
		?>">
			<?php if( is_category() || is_tag() ||  is_product_category()):?>
			Back to All
			<?php elseif($utility_page == 1):?>
			Back to Home
			<?php else: ?>
			Back to <?php echo $type; 
			endif;
			?>
		</a>
		</span><!-- #site-navigation -->
		
		<?php
		}
		
	}
}

add_action( 'die_brueder_header_special', 'die_brueder_header_back', 30);
add_action( 'woocommerce_before_checkout_form', 'die_brueder_header_back', 0);


/* Homepage */

/**
 * Display Featured Products
 * Hooked into the `homepage` action in the homepage template
 *
 * @since  1.0.0
 * @param array $args the product section args.
 * @return void
 */
if ( ! function_exists( 'die_brueder_featured_products' ) ) {

	function die_brueder_featured_products( $args ) {

		$args = apply_filters( 'die_brueder_featured_products_args', array(
			'limit'   => 6,
			'columns' => 2,
			'orderby' => 'date',
			'order'   => 'desc',
	
		) );

		$shortcode_content = die_brueder_do_shortcode( 'featured_products', apply_filters( 'die_brueder_featured_products_shortcode_args', array(
			'per_page' => intval( $args['limit'] ),
			'columns'  => intval( $args['columns'] ),
			'orderby'  => esc_attr( $args['orderby'] ),
			'order'    => esc_attr( $args['order'] ),
		) ) );

		/**
		 * Only display the section if the shortcode returns products
		 */
		if ( false !== strpos( $shortcode_content, 'product' ) ) {

			echo '<section class="die_brueder-product-section die_brueder-featured-products" aria-label="' . esc_attr__( 'Featured Products', 'die_brueder' ) . '">';
			echo '<h2 class="section-title">' . wp_kses_post( $args['title'] ) . '</h2>';
			echo $shortcode_content;
			echo '</section>';

		}
		else{
			echo esc_attr__('There are no featured products', 'die_brueder');
		}
		
	}
}

//add_action('homepage','die_brueder_featured_products', 0 );

/**
 * Remove default woocommerce featured products from admin bar
 *
 * @since  1.0.0
 * @param array $args the product section args.
 * @return void
 */
if ( ! function_exists( 'unset_some_columns_in_product_list' ) ) {
	
	function unset_some_columns_in_product_list( $column_headers ) { 
	        unset($column_headers['featured']);
	
	
	        return $column_headers;
	}
}
add_filter( 'manage_edit-product_columns', 'unset_some_columns_in_product_list' );

/**
 * Display Featured Products and Posts
 * Hooked into the `homepage` action in the homepage template
 *
 * @since  1.0.0
 * @param array $args the product section args.
 * @return void
 */
if ( ! function_exists( 'die_brueder_featured_homepage' ) ) {

	function die_brueder_featured_homepage( $args ) {
		
			//get featured products

			$args = array(
				 'post_type' => array('post', 'product'), 
				 'meta_key' => 'highlight_in_homepage', //setting the meta_key which will be used to order
			     'orderby' => array('meta_value_num' 	=> 'DESC' , 'data_post' 	=> 'ASC'), //if the meta_key (population) is numeric use meta_value_num instead

				 'posts_per_page' => -1,
				  'meta_query' => array(
				    array(
				      'key' => 'featured_in_homepage',
				      'value' => '1',
				      'compare' => '==' // not really needed, this is the default
				    )
				  )
			);

			  
			$featured_query = new WP_Query( $args );  

			if ($featured_query->have_posts()) :  
			?>
			<ul id="isotope">
			<?php
			    while ($featured_query->have_posts()) :  
			    ?>
			    <li>	
			    <?php
				$featured_query->the_post();
			     woocommerce_template_loop_product_thumbnail();
			    ?>
			
				</li>
			   <?php 
			    endwhile;  
			 ?>
			 </ul>
			 <?php
			endif;  
			  
			wp_reset_query(); // Remember to reset  
	}
}


/**
 * Display Featured Products and Posts
 * Hooked into the `homepage` action in the homepage template
 *
 * @since  1.0.0
 * @param array $args the product section args.
 * @return void
 */
if ( ! function_exists( 'die_brueder_featured_homepage_mobile' ) ) {

	function die_brueder_featured_homepage_mobile( $args ) {
		
			//get featuwred products

			$args = array(
				 'post_type' => array('post', 'product'), 
				 'meta_key' => 'highlight_in_homepage', //setting the meta_key which will be used to order
			     'orderby' => array('meta_value_num' 	=> 'DESC' , 'data_post' 	=> 'ASC'), //if the meta_key (population) is numeric use meta_value_num instead

				 'posts_per_page' => -1,
				  'meta_query' => array(
				    array(
				      'key' => 'featured_in_homepage',
				      'value' => '1',
				      'compare' => '==' // not really needed, this is the default
				    )
				  )
			);

			
			$featured_query = new WP_Query( $args );  

			if ($featured_query->have_posts()) :  
			?>
			<?php
			    while ($featured_query->have_posts()) :  
			    ?>
		
			    <?php
				$featured_query->the_post();
					$type = get_post_type();
					if($type == "product"):
			     	wc_get_template_part( 'content', 'product' ); 
			     	else:
			     	wc_get_template_part( 'template-parts/content', 'blogmobile' ); 
			     	endif;
			    ?>
			
				
			   <?php 
			    endwhile;  
			 ?>
			 <?php
			endif;  
			  
			wp_reset_query(); // Remember to reset  
	}
}

if(!wp_is_mobile()):
add_action('homepage','die_brueder_featured_homepage', 0 );
else:
add_action('homepage','die_brueder_featured_homepage_mobile', 0 );
endif;

/* Footer */



if ( ! function_exists( 'die_brueder_newsletter' ) ) {

	function die_brueder_newsletter() {

 ?>
		
		    			<!--
		    			<form action="//diebrueder.us16.list-manage.com/subscribe/post?u=bbc57e6beeeb83d24e84ccc64&amp;id=2a997fa691" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
		    				<input id="mail" type="email" placeholder="E-Mail"></input>
		    				<input id="mail" type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="E-Mail">
		    				<button id="mailsubmit" type="button">Anmelden</button>
		    			</form>
		    			-->
		    			<!-- Begin MailChimp Signup Form -->
						<div id="mc_embed_signup">
							<form action="//diebrueder.us16.list-manage.com/subscribe/post?u=bbc57e6beeeb83d24e84ccc64&amp;id=2a997fa691" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							<div id="mc_embed_signup_scroll">
								<div class="mc-field-group">
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="E-Mail">
								</div>
								<div id="mce-responses" class="clear">
									<div class="response" id="mce-error-response" style="display:none"></div>
									<div class="response" id="mce-success-response" style="display:none"></div>
								</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bbc57e6beeeb83d24e84ccc64_2a997fa691" tabindex="-1" value=""></div>
							    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</div>
							</form>
						</div>
						<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='BIRTHDAY';ftypes[3]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
		    		
	<?php
	}
}	

/**
 * Display contact, newsletter and media links
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_bruede_contact_newsletter_media' ) ) {

	function die_bruede_contact_newsletter_media() {
	$page = get_page_by_title('contact');

		    ?>
		    <nav class="footer-navigation">
		    	<ul>
		    		<li><a href="<?php echo get_permalink(get_page_by_title( 'About' )); ?>">Contact</a></li>
		    		<li id="newsletter">
		    			<a id="newslettercta">Newsletter</a>
		    		<?php
		    		die_brueder_newsletter();
		    		?>
		    		</li>
		    		<li><a href="http://<?php echo get_option('facebook_link'); ?>">Facebook</a></li>
		    		<li><a href="http://<?php echo get_option('twitter_link'); ?>">Twitter</a></li>
		   	
		    		<li id="up" class="arrow"><a>&#8593;</li>
		    	</ul>
		    </nav>
			  	<!--put here static html
		    </nav><!-- #site-navigation -->
		    <?php
		
	}
}

add_action( 'die_brueder_footer', 'die_bruede_contact_newsletter_media', 0);


add_action('die_brueder_checkout_newsletter', 'die_brueder_newsletter', 0);
/**
 * Display Secondary Navigation
 *
 * @since  1.0.0
 * @return void
 */
if ( ! function_exists( 'die_brueder_secondary_navigation' ) ) {

	function die_brueder_secondary_navigation() {
	    if ( has_nav_menu( 'secondary' ) ) {
		    ?>
		    <nav class="footer-navigation" role="navigation" aria-label="<?php esc_html_e( 'Secondary Navigation', 'die_brueder' ); ?>">
			   
			    <?php
				    wp_nav_menu(
					    array(
						    'theme_location'	=> 'secondary',
						    'container_class'	=> 'secondary-navigation',
						    'items_wrap'      => '<ul class="footer-menu">%3$s</ul>',
						    
					    )
				    );
			    ?>
		    </nav><!-- #site-navigation -->
		    <?php
		}
	}
}


add_action( 'die_brueder_footer', 'die_brueder_secondary_navigation', 10);

/* Posts page */
/**
 * Display post thumbnail
 *
 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
 * @uses has_post_thumbnail()
 * @uses the_post_thumbnail
 * @param string $size the post thumbnail size.
 * @since 1.0.0
 */
	 
if ( ! function_exists( 'die_brueder_post_thumbnail' ) ) {
	
	function die_brueder_post_thumbnail(  ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $size );
		}


		

	
	}
}


/* Thumbnails creation */

add_theme_support( 'post-thumbnails' );
add_image_size( 'homepage-thumb', 220, 180 ); // Soft Crop Mode

/**
 * Function after creating or updating post
 *
 * @since 1.0.0
 */

add_action( 'thumbnail_creation', 'my_save_post_function', 10, 3 );

function my_save_post_function() {
	$post = get_post($_GET['id']);
	
	if($post->post_type == 'post' || $post->post_type == 'product'):
		
		if($post->post_status=="publish"):
			if($post->post_type == 'post'):
				//content to be turned into image
				$content = 'article';
			else:
				$content = "#shop-thumbnail";
			endif;
		?>
		<div id="spinner-container"	>	</div>
				<div id="spinner-content">saving image...
						<div class="spinner"></div>
				</div>
	
		<?php
		$url= admin_url().'post.php';

		?>
		<div id="generation-content">
		<form  method="GET" action="<?php echo $url; ?>"  >	
		<input type="hidden" name="post" id="post" value="<?php echo $post->ID; ?>"/>
		<input type="hidden" name="action" id="action" value="edit"/>
    	<button class="button button-primary button-large" id="back-button" type="submit" >Back</button>
		</form>
  		<form method="POST" enctype="multipart/form-data" id="thumbnail-form" >
			<input type="hidden" name="img_val" id="img_val" value="wwww" />

		<input type="hidden" name="post_id" id="post_id" value="<?php echo $post->ID; ?>"/>

		<button name="save_thumbnail" type="submit" class="button button-primary button-large" id="save_thumbnail">Save Thumbnail</button>
		
		</form>
		<div class="results"><?php echo wp_remote_retrieve_body( wp_remote_get( get_permalink($post->ID) ) ); ?></div>
	
		<div id="contentthumbnail" style="background-color:#fff;"></div>
			
		</div>
	
		<script>
	
		jQuery( document ).ready(function() {
			jQuery("#contentthumbnail").html(jQuery("<?php echo $content; ?>").html());
			jQuery(".related").css("margin-top", "0px");
			jQuery(".related").html('');
			jQuery('.back-shop-2').hide();
			jQuery('.back-shop-1').hide();
			jQuery('.results').hide();
			jQuery("#contentthumbnail").html2canvas({
				onrendered: function (canvas) {
					jQuery("#contentthumbnail").hide();
					
					/*var resizedCanvas = document.createElement("canvas");
					var resizedContext = resizedCanvas.getContext("2d");
		
					resizedCanvas.width=canvas.width*0.7;
					resizedCanvas.height=canvas.height*0.7;
					resizedContext.drawImage(canvas, 0, 0,canvas.width*0.7,canvas.height*0.7);*/
					

					var ImageURL = canvas.toDataURL("image/png");
					jQuery("#img_val").val(ImageURL);
					console.log(ImageURL);
					jQuery("#contentthumbnail").html(canvas);
					jQuery("#contentthumbnail").show();
				
				
				
				}
			});

		
		});
		
		jQuery("#thumbnail-form").submit(function (e) {
		e.preventDefault();
	
		jQuery("#spinner-container").show();
		jQuery("#spinner-content").show();
		var data = jQuery("#img_val").val();

		var post_id = jQuery("#post_id").val();
			jQuery.ajax({
        	type: "POST",
        	url: "<?php echo admin_url("admin-ajax.php"); ?>",
        	timeout:300000,
       	 	data: {
        		"img": data,
        		"post": post_id,
        		"action": "die_brueder_save_thumbnail"
        	},

         success: function (result) {
      	
        	jQuery("#spinner-container").hide();	
          	jQuery("#spinner-content").hide();	

          	if(result!=0){
          			alert("Image saved!");
          	}
          	else{
          			alert("There was an error creating the image. To fix this remove some of the big pictures from the post before 		creating the thumbnail. After the thumbnail is created you can add the pictures back and when prompt to create a new thumbnail just press the back button.")
          	}
          	window.location.href = "<?php echo admin_url().'post.php?post='.$post->ID.'&action=edit'; ?>";
        	},
        	error: function (result) {
     
            jQuery("#spinner-container").hide();
             jQuery("#spinner-content").hide();
        	}
   		 });
	
		});

		</script>
<?php
		endif;
  endif;
}

	
add_action( 'wp_ajax_die_brueder_save_thumbnail', 'die_brueder_save_thumbnail_callback' );
add_action( 'wp_ajax_nopriv_die_brueder_save_thumbnail', 'die_brueder_save_thumbnail_callback' );
function die_brueder_save_thumbnail_callback() {
	

	//Get the base-64 string from data
	$filteredData=substr($_POST['img'], strpos($_POST['img'], ",")+1);

	//Decode the string
	$unencodedData=base64_decode($filteredData);

		//Save the image
	$file = 'thumbnail'.$_POST['post'].'.png';
	$post_id = $_POST['post'];

	$oldcustom_thumbnail = get_post_meta($post_id, 'custom-thumbnail');
	if($oldcustom_thumbnail){
	wp_delete_attachment($oldcustom_thumbnail);
	delete_post_meta($post_id, 'custom-thumbnail');
	}
	$upload  = wp_upload_bits($file, null, $unencodedData);
	$wp_filetype = wp_check_filetype($upload['url'], null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => 'thumbnail'.$_POST['post'],
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    
    $attach_id = wp_insert_attachment( $attachment, $upload['url'], $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['url'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );
   
 	//image_resize( $upload ['file'], 50,1000, false, '-t' );
	
    add_post_meta($post_id, 'custom-thumbnail',$attach_id, $unique);
    

   wp_die();
 
}
	//set_post_thumbnail( $post_id, $attach_id );
	
add_action( 'wp_ajax_die_brueder_thumbnail', 'die_brueder_thumbnail_callback' );
add_action( 'wp_ajax_nopriv_die_brueder_thumbnail', 'die_brueder_thumbnail_callback' );
function die_brueder_thumbnail_callback() {

 	$post_id = $_POST['post_id'];
 	$post = get_post( $post_id );
 	$title = $post->post_title;
	$oldcustom_thumbnail = get_post_meta($post_id, 'custom-thumbnail');
	
	echo $oldcustom_thumbnail[0];
	wp_delete_attachment($oldcustom_thumbnail[0], true);

	delete_post_meta($post_id, 'custom-thumbnail');
			

  	$upload = wp_upload_bits( $_FILES['file']['name'], null, @file_get_contents( $_FILES['file']['tmp_name'] ) );

  	$wp_filetype = wp_check_filetype($upload['url'], null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' =>  $title.'-thumbnail',
        'post_content' => '',
        'post_status' => 'inherit'
    );
    
    
    $attach_id = wp_insert_attachment( $attachment, $upload['url'], $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['url'] );
    wp_update_attachment_metadata( $attach_id, $attach_data );
   
 	//image_resize( $upload ['file'], 50,1000, false, '-t' );
	
    add_post_meta($post_id, 'custom-thumbnail',$attach_id, $unique);
    

   wp_die();

  
 
}


/*add_filter('redirect_post_location', function($location)
{
    global $post;
    if (
        (isset($_POST['publish']) || isset($_POST['save'])) &&
        preg_match("/post=([0-9]*)/", $location, $match) &&
        $post &&
        $post->ID == $match[1] &&
        (isset($_POST['publish']) || $post->post_status == 'publish') && // Publishing draft or updating published post
        $pl = get_permalink($post->ID) && 
        ($post->post_type == 'post' || $post->post_type == 'product')
    ) {
        // Always redirect to the post 
        $location = get_site_url().'/thumbnail-creation/?id='.$post->ID;
    }
    return $location;
});*/

function rkv_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'rkv_imagelink_setup', 10);

function add_classes_on_li($classes, $item, $args) {
  $classes[] = 'footer-li-class';
  return $classes;
}
add_filter('nav_menu_css_class','add_classes_on_li',1,3);


add_action( 'post_submitbox_misc_actions', 'myprefix_edit_form_advanced' , 40);
function myprefix_edit_form_advanced() {
	$screen = get_current_screen();
	if($screen->post_type=='post' || $screen->post_type=='product') {
		if($screen->action!="add"){
		 global $post;
        $id = $post->ID;

   echo '
    		<a class="button button-primary button-large" type="submit" href="'.get_site_url().'/thumbnail-creation/?id='.$post->ID.'"style="float:right;margin:10px;display:block;">Generate Thumbnail</a>
    		';
    		}
	}	
}

