<?php
/**
 * Die Brueder Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Die_Brueder_Shop
 */

if ( ! function_exists( 'die_brueder_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function die_brueder_shop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Die Brueder Shop, use a find and replace
		 * to change 'die-brueder-shop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'die-brueder-shop', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'die-brueder-shop' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'die_brueder_shop_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'die_brueder_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function die_brueder_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'die_brueder_shop_content_width', 640 );
}
add_action( 'after_setup_theme', 'die_brueder_shop_content_width', 0 );


@ini_set( 'upload_max_size' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'max_execution_time', '600' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function die_brueder_shop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Categories', 'die-brueder-shop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'die-brueder-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Tags', 'die-brueder-shop' ),
		'id'            => 'sidebar-tags',
		'description'   => esc_html__( 'Add widgets here.', 'die-brueder-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Shop', 'die-brueder-shop' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'die-brueder-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'die_brueder_shop_widgets_init' );


add_filter( 'widget_tag_cloud_args', 'filter_tag_cloud_widget' );

function filter_tag_cloud_widget() {
    $include = array( 58, 59 );
    $args = array(
        'smallest' =>4, 
        'largest' => 4, 
        'unit' => 'vw', 
        'format' => 'flat', 
        'separator' => "\n", 
        'orderby' => 'name', 
        'order' => 'ASC',
        'exclude' => '', 
        'include' => '', 
        'link' => 'view', 
        'post_type' => '', 
        'taxonomy' => 'post_tag',
        'echo' => false

    );
    return $args;
}


//remove title from widget
add_filter('widget_title','my_widget_title'); 

function my_widget_title($t)
{

    return '';
}

/*function add_isotope() {
    w
}
 
add_action( 'wp_enqueue_scripts', 'add_isotope' );*/

/**
 * Enqueue scripts and styles.
 */
function die_brueder_shop_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_style( 'die-brueder-shop-style', get_stylesheet_uri() );
	wp_enqueue_style( 'die-brueder-shop-style-mobile', get_template_directory_uri() . '/assets/css/mobile.css' );
	wp_enqueue_style( 'die-brueder-shop-style-mobile-david', get_template_directory_uri() . '/assets/css/mobile-david.css' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', array(), '20151215', true );
	
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', array(), '20151215', true );

	wp_enqueue_script( 'scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array(), '20151215', true );

	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/sticky.js', array(), '20151215', true );

	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.js', array(), '', true );
	
	wp_enqueue_script( 'okzoom', get_template_directory_uri() . '/js/okzoom.js', array(), '20151215', true );

	wp_enqueue_script( 'die-brueder-shop-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	

	wp_register_script( 'die-brueder-shop-html2canvas', get_template_directory_uri() . '/js/html2canvas.js', array(), '20151215', false );
	
	wp_register_script( 'die-brueder-shop-html2canvas-jquery', get_template_directory_uri() . '/js/jquery.plugin.html2canvas.js', array(), '20151215', false );
	wp_enqueue_script('die-brueder-shop-html2canvas');
	wp_enqueue_script('die-brueder-shop-html2canvas-jquery');


	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '', true );
	

  wp_enqueue_script('jquery-effects-core');
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	wp_register_script( 'isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'),  true );
    wp_register_script( 'isotope-init', get_template_directory_uri().'/js/isotope.pkgd.js', array('jquery', 'isotope'),  true );
    wp_register_style( 'isotope-css', get_stylesheet_directory_uri() . '/isotope.css' );
 
    wp_enqueue_script('isotope-init');
    wp_enqueue_style('isotope-css');

}
add_action( 'wp_enqueue_scripts', 'die_brueder_shop_scripts' );
 
 /**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-woocommerce-functions.php';


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


add_action('admin_init', 'my_general_section');  
function my_general_section() {  
    add_settings_section(  
        'my_settings_section', // Section ID 
        'Social Media Links', // Section Title
        '', // Callback
        'general' // What Page?  This makes the section show up on the General Settings Page
    );

    add_settings_field( // Option 1
        'facebook_link', // Option ID
        'Facebook', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed (General Settings)
        'my_settings_section', // Name of our section
        array( // The $args
            'facebook_link' // Should match Option ID
        )  
    ); 

    add_settings_field( // Option 2
        'twitter_link', // Option ID
        'Twitter ', // Label
        'my_textbox_callback', // !important - This is where the args go!
        'general', // Page it will be displayed
        'my_settings_section', // Name of our section (General Settings)
        array( // The $args
            'twitter_link' // Should match Option ID
        )  
    ); 

    register_setting('general','facebook_link', 'esc_attr');
    register_setting('general','twitter_link', 'esc_attr');
}



function my_textbox_callback($args) {  // Textbox Callback
    $option = get_option($args[0]);
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}


/*blog posts */


function die_brueder_shortcode_post_tags( $atts ){
	return '<div class="post-tags-date-author">
	<span class="post-date">'.
	get_the_date('d M, Y ')
	.'</span>
	<span class="post-tags">'.
	get_the_author()
	.'</span><span class="post-author">'.
	die_brueder_shop_entry_tags().
	'</span></div>';
}


add_shortcode( 'post_info', 'die_brueder_shortcode_post_tags' );

// remove p after and before
function shortcode_empty_paragraph_fix( $content ) {

    // define your shortcodes to filter, '' filters all shortcodes
    $shortcodes = array( 'post_info' );

    foreach ( $shortcodes as $shortcode ) {

        $array = array (
            '<p>[' . $shortcode => '[' .$shortcode,
            '<p>[/' . $shortcode => '[/' .$shortcode,
            $shortcode . ']</p>' => $shortcode . ']',
            $shortcode . ']<br />' => $shortcode . ']'
        );

        $content = strtr( $content, $array );
    }

    return $content;
}

//add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );



add_action( 'init', 'die_brueder_projects_init' );
/**
 * Register a Projec post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function die_brueder_projects_init() {
	$labels = array(
		'name'               => _x( 'Projects', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Project', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Projects', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'project', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Project', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Project', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Project', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Project', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Projects', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Projects', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Projects:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No projects found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No projects found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'project' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'project', $args );
}