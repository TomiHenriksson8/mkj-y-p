<?php

add_action('init', 'start_my_session', 1);
function start_my_session() {
    if (!session_id()) {
        session_start();
    }
}

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


//

function add_custom_meta_box() {
    add_meta_box(
        'custom_meta_box',
        'Product Details',
        'show_custom_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_custom_meta_box');


function show_custom_meta_box($post) {
    wp_nonce_field(basename(__FILE__), 'custom_meta_box_nonce');

    $price = get_post_meta($post->ID, 'price', true);

    echo '<label for="price">Price:</label>';
    echo '<input type="text" id="price" name="price" value="' . esc_attr($price) . '" />';
}

function save_custom_meta_box_data($post_id) {
    if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if ('post' === $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    } else {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Sanitize user input.
    $new_price = (isset($_POST['price']) ? sanitize_text_field($_POST['price']) : '');

    // Update the meta field in the database.
    update_post_meta($post_id, 'price', $new_price);
}
add_action('save_post', 'save_custom_meta_box_data');

//

function handle_cart_actions() {
    if (!session_id()) {
        session_start();
    }


    function redirect_back() {
        wp_redirect($_SERVER['HTTP_REFERER'] ?? home_url());
        exit;
    }

    // Add to Cart
    if (isset($_POST['add_to_cart']) && !empty($_POST['product_id']) && isset($_POST['product_price'])) {
        $product_id = intval($_POST['product_id']);
        $product_price = floatval($_POST['product_price']);
        $_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] ?? ['quantity' => 0, 'price' => $product_price];
        $_SESSION['cart'][$product_id]['quantity'] += 1;
        redirect_back();
    }

    // Decrease Quantity or Remove Item
    if (isset($_GET['action']) && !empty($_GET['product_id'])) {
        $product_id = intval($_GET['product_id']);

        if ($_GET['action'] == 'decrease_quantity' && isset($_SESSION['cart'][$product_id])) {
            if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
                $_SESSION['cart'][$product_id]['quantity']--;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
            redirect_back();
        } elseif ($_GET['action'] == 'remove_item') {
            unset($_SESSION['cart'][$product_id]);
            redirect_back();
        }
    }

    // Clear Cart
    if (isset($_GET['action']) && $_GET['action'] == 'clear_cart') {
        $_SESSION['cart'] = [];
        wp_redirect(home_url('/thank-you'));  // Optionally redirect to a "Thank You" or confirmation page
        exit;
    }
}
add_action('init', 'handle_cart_actions');

function display_cart_contents() {
    if (!empty($_SESSION['cart'])) {
        echo '<ul class="cart-items-list">';  // Add a class to the list
        foreach ($_SESSION['cart'] as $id => $details) {
            echo '<li class="cart-item">';  // Add a class to each item
            echo get_the_title($id) . ' - Quantity: ' . $details['quantity'] . ' at $' . $details['price'] . ' each ';
            echo '<a href="?action=decrease_quantity&product_id=' . $id . '" class="cart-decrease">Decrease</a> ';
            echo '<a href="?action=remove_item&product_id=' . $id . '" class="cart-remove">Remove</a>';
            echo '</li>';
        }
        echo '</ul>';
    }
}




// load styles

function style_setup(): void {
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'style_setup' );






// load bootstrap

function mytheme_enqueue_bootstrap(): void {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/css/bootstrap.css');
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


function enqueue_custom_scripts() {
    wp_enqueue_script('custom-cart-actions', get_template_directory_uri() . '/js/custom-cart-actions.js', array('jquery'), null, true);
    wp_localize_script('custom-cart-actions', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


// custom functions
require_once(__DIR__ . '/inc/article-function.php');
require_once(__DIR__ . '/inc/random-image.php');
require_once(__DIR__ . '/ajax-functions/single-post-function.php');