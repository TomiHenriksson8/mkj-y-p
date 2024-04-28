<?php

// filters
function search_filter( $query ) {
	if ( $query->is_search ) {
		$query->set( 'category_name', 'products' );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'search_filter' );

function my_breadcrumb_title_swapper( $title, $type, $id ) {
	if ( in_array( 'home', $type ) ) {
		$title = __( 'Home' );
	}

	return $title;
}

add_filter( 'bcn_breadcrumb_title', 'my_breadcrumb_title_swapper', 3, 10 );


// actions
function theme_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'custom-logo', [
		'height'      => 100,
		'width'       => 200,
		'flex-height' => true,
	] );
	add_theme_support( 'html5', array( 'search-form' ) );

	// Set the default Post Thumbnail size
	set_post_thumbnail_size( 200, 200, true ); // 200px wide by 200px high, hard crop mode

	// Add custom image sizes
	add_image_size( 'custom-header', 1200, 400, true ); // Custom header size

	// Add menu
	register_nav_menu( 'main-menu', __( 'Main Menu' ) );
}

add_action( 'after_setup_theme', 'theme_setup' );

// greeting message

function custom_greeting() {
    $hour = date('H');
    if ($hour < 12) {
        return "Good morning!";
    } elseif ($hour < 17) {
        return "Good afternoon!";
    } else {
        return "Good evening!";
    }
}

function add_greeting() {
    echo "<p class='greeting'>" . custom_greeting() . "</p>";
}


// load styles

function style_setup(): void {
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'style_setup' );






// load bootstrap

function mytheme_enqueue_bootstrap(): void {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.css' );
    // Enqueue Bootstrap JavaScript
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.js', array('jquery'), null, true );
}

require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

add_action('wp_enqueue_scripts', 'mytheme_enqueue_bootstrap');





// load javascript

function script_setup(): void {
	wp_enqueue_script( 'single-post', get_template_directory_uri() . '/js/singlePost.js', [], '1.0', true );
	$script_data = [
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	];
	wp_localize_script( 'single-post', 'singlePost', $script_data );
}

add_action( 'wp_enqueue_scripts', 'script_setup' );

function my_theme_enqueue_scripts() {
    // Register the script like this for a theme:
    wp_register_script( 'category-filter', get_template_directory_uri() . '/js/category-filter.js', array( 'jquery' ), null, true );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'category-filter' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );


// custom functions
require_once( __DIR__ . '/inc/article-function.php' );
require_once( __DIR__ . '/inc/random-image.php' );
require_once( __DIR__ . '/ajax-functions/single-post-function.php' );