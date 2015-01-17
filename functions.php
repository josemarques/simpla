<?php
/**
 * simpla functions and definitions
 *
 * @package simpla
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 10000; /* pixels */
}

if ( ! function_exists( 'simpla_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simpla_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on simpla, use a find and replace
	 * to change 'simpla' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'simpla', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'simpla' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'video', 'quote', 'link', 'gallery',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'simpla_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	//Add custom image sizes for different devices
	add_image_size( 'small', 800, 600 , false);
	add_image_size( 'medium', 1200, 1000 , false);
}
endif; // simpla_setup
add_action( 'after_setup_theme', 'simpla_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function simpla_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'simpla' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'simpla_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simpla_scripts() {
	wp_enqueue_style( 'simpla-style', get_stylesheet_uri() );

	wp_enqueue_script( 'simpla-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'simpla-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'simpla-data-img', get_template_directory_uri() . '/js/data-img.min.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'simpla-core', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), '1.0', true );
	
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'simpla_scripts' );


/**
 * Returns the different featured image files
 */
if ( ! function_exists( 'simpla_get_post_images' ) ) :
function simpla_get_post_images ( $post_id ){
	$post_images = "";
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	$post_images[ 'full' ] = wp_get_attachment_image_src( $post_thumbnail_id, 'full' )[0];
	$post_images[ 'medium' ] = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' )[0];
	$post_images[ 'small' ] = wp_get_attachment_image_src( $post_thumbnail_id, 'small' )[0];

	return $post_images;
}
endif;


/**
 * Returns the different featured image files
 */
if ( ! function_exists( 'simpla_set_featured_image_class' ) ) :
function simpla_set_featured_image_class($classes) {
	if ( has_post_thumbnail() )
		array_push($classes, 'has-featured-image');

	return $classes;
}
add_action('body_class', 'simpla_set_featured_image_class' );
endif;

/**
 * Removes wrapper paragraphs from images
 */
/*if ( ! function_exists( 'simpla_filter_ptags_on_images' ) ) :
function simpla_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'simpla_filter_ptags_on_images');
endif;


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
