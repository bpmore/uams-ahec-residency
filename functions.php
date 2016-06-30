<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'education', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'education' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Education Pro Theme', 'education' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/education/' );
define( 'CHILD_THEME_VERSION', '3.0.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'education_load_scripts' );
function education_load_scripts() {

	wp_enqueue_script( 'education-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script('search', CHILD_URL.'/js/search.js', array('jquery'), '2', TRUE);
	//wp_enqueue_script( 'search', get_bloginfo( 'stylesheet_directory' ) . '/js/search.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'ionicons', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,700', array(), CHILD_THEME_VERSION );
	
}

//* Add new image sizes
add_image_size( 'slider', 1600, 800, TRUE );
add_image_size( 'sidebar', 280, 150, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 300,
	'height'          => 100,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'education-pro-blue'   => __( 'Education Pro Blue', 'education' ),
	'education-pro-green'  => __( 'Education Pro Green', 'education' ),
	'education-pro-red'    => __( 'Education Pro Red', 'education' ),
	'education-pro-purple' => __( 'Education Pro Purple', 'education' ),
) );

//* Add support for 5-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'education_secondary_menu_args' );
function education_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Reposition the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Customize the entry meta in the entry header
add_filter( 'genesis_post_info', 'education_post_info_filter' );
function education_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}

//* Customize the entry meta in the entry footer
add_filter( 'genesis_post_meta', 'education_post_meta_filter' );
function education_post_meta_filter($post_meta) {
	$post_meta = 'Article by [post_author_posts_link] [post_categories before=" &#47; "] [post_tags before=" &#47; "] [post_comments] [post_edit]';
	return $post_meta;
}

//* Relocate after post widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 96;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'education_remove_comment_form_allowed_tags' );
function education_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-featured',
	'name'        => __( 'Home - Featured', 'education' ),
	'description' => __( 'This is the featured section of the Home page.', 'education' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'education' ),
	'description' => __( 'This is the top section of the Home page.', 'education' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home - Middle', 'education' ),
	'description' => __( 'This is the middle section of the Home page.', 'education' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'education' ),
	'description' => __( 'This is the bottom section of the Home page.', 'education' ),
) );

//* Register Alt Home widget areas
genesis_register_sidebar( array(
	'id'          => 'homealt-featured',
	'name'        => __( 'Home Alt - Featured', 'education' ),
	'description' => __( 'This is the featured section of the homealt page.', 'education' ),
) );
genesis_register_sidebar( array(
	'id'          => 'homealt-top',
	'name'        => __( 'Home Alt - Top', 'education' ),
	'description' => __( 'This is the top section of the homealt page.', 'education' ),
) );
genesis_register_sidebar( array(
	'id'          => 'homealt-middle',
	'name'        => __( 'Home Alt - Middle', 'education' ),
	'description' => __( 'This is the middle section of the homealt page.', 'education' ),
) );
genesis_register_sidebar( array(
	'id'          => 'homealt-bottom',
	'name'        => __( 'Home Alt - Bottom', 'education' ),
	'description' => __( 'This is the bottom section of the homealt page.', 'education' ),
) );

// Show Footer Widget Areas only on homepage
//add_action( 'genesis_after_content_sidebar_wrap', 'sk_footer_widget_areas' );
//function sk_footer_widget_areas() {
//
//	if ( is_home() || is_front_page() )
//		return;
//
//	remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
//
//}

/** Register Utility Bar Widget Areas. */

genesis_register_sidebar( array(
	'id' => 'utility-bar-left',
	'name' => __( 'Utility Bar Left', 'theme-prefix' ),
	'description' => __( 'This is the left utility bar above the header.', 'theme-prefix' ),
	) );

genesis_register_sidebar( array(
	'id' => 'utility-bar-right',
	'name' => __( 'Utility Bar Right', 'theme-prefix' ),
	'description' => __( 'This is the right utility bar above the header.', 'theme-prefix' ),
) );

add_action( 'genesis_before_header', 'utility_bar' );
/**
* Add utility bar above header.
*
* @author Carrie Dils
* @copyright Copyright (c) 2013, Carrie Dils
* @license GPL-2.0+
*/
function utility_bar() {
 
	echo '<div class="utility-bar"><div class="wrap">';
 
	genesis_widget_area( 'utility-bar-left', array(
		'before' => '<div class="utility-bar-left">',
		'after' => '</div>',
	) );
 
	genesis_widget_area( 'utility-bar-right', array(
		'before' => '<div class="utility-bar-right">',
		'after' => '</div>',
	) );
 
	echo '</div></div>';
 
}

add_action( 'genesis_before_header', 'utility_bar' );

//* Adding search form
add_action('genesis_after_header', 'bears_toggle_search');
function bears_toggle_search(){
  echo '<div class="search-wrap hide" id="toggle-search">' . "\n";

  echo get_search_form();
  
  echo '</div>' . "\n";
}

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Register and Hook Footer Navigation Menu
add_action( 'genesis_before_footer', 'sample_footer_menu', 10 );
	function sample_footer_menu() {

	register_nav_menu( 'footer', 'Footer Navigation Menu' );
	
	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'menu_class'     => 'menu genesis-nav-menu menu-footer',
	) );
}

// Add Theme Support for Genesis Menus
add_theme_support( 'genesis-menus', array( 
	'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
	'secondary' => __( 'Secondary Navigation Menu', 'genesis' ),
	'footer'    => __( 'Footer Navigation Menu', 'genesis' ),
) );

// Add Structural Wraps
add_theme_support( 'genesis-structural-wraps', array(
	'menu-footer',
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer'
) );

// Add Attributes for Navigation Elements
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );

// Remove div.site-inner's div.wrap
//add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );

// Remove 'site-inner' from structural wrap
//add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

// Reposition Primary Navigation and Move Primary Navigation, Footer widgets and Footer outside Site Container

// Reposition the footer widgets
//remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
//add_action( 'genesis_after', 'genesis_footer_widget_areas' );

//* Reposition the primary navigation menu
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_after', 'genesis_do_nav', 7 );

//* Unregister primary navigation menu
add_theme_support( 'genesis-menus', array( 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ) ) );

// Reposition the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
add_action( 'genesis_after', 'genesis_do_footer', 12 );
add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'sk_sticky_footer' );
function sk_sticky_footer() {

	wp_enqueue_script( 'sticky-footer', get_stylesheet_directory_uri() . '/js/sticky-footer.js', array( 'jquery' ), '1.0.0' );

}

/* Code to Display Featured Image on top of the post */
//add_action( 'genesis_entry_content', 'featured_post_image', 8 );
//function featured_post_image() {
//  if ( ! is_singular( 'post' ) )  return;
//	the_post_thumbnail('post-image');
//}

/* Code to Display Featured Image on top of the post */
//add_action( 'genesis_entry_content', 'featured_page_image', 8 );
//function featured_page_image() {
//  if ( ! is_singular( 'page' ) )  return;
//	the_post_thumbnail('post-image');
//}

//* Customize search form input button text
add_filter( 'genesis_search_button_text', 'sp_search_button_text' );
function sp_search_button_text( $text ) {
	return esc_attr( 'Go' );
}

//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">Learn More</a>';
}

# Reposition the breadcrumb
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs', 7 );

//* Reposition custom headline and / or description to category / tag / taxonomy archive pages.
//		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
//		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
//		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
//		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
//		add_action( 'genesis_before_content', 'genesis_do_post_title', 9 );
//		add_action( 'genesis_before_content', 'genesis_post_info', 9 );
//add_action( 'genesis_before_content', 'genesis_post', 15 );

# Allow multiple instances of Genesis Responsive Slider
add_action ('wp', 'lit_custom_slide_show');

function lit_custom_slide_show() {
	if(is_home()){
		$category_prefix = ""; // Home page needs no prefix
	} else {
		$category_prefix = basename(get_permalink()).'-' ; // this results in ‘about-‘ for a page called “about”
		}
		$my_posts_term = 'category_name,'.$category_prefix.'featured'; // Prefix matches category used for home page
			$slide_show_vars = array(
				'post_type' => 'post',
				'posts_term' => $my_posts_term
				);
foreach ($slide_show_vars as $option => $value)
        add_filter ("genesis_pre_get_option_{$option}", create_function ('', "return '{$value}';"));
}

//* Display Parent and Child Page Titles on Page
//add_filter( 'genesis_post_title_output', 'lit_post_title_output', 15 );
//function lit_post_title_output( $title ) {
 
//    global $post;
	
//    if ( is_page() && $post->post_parent > 0 ) {
	
//        $parent_title = get_the_title( $post->post_parent );
//        $page_title = get_the_title();
//        $title = sprintf( '<h1 class="parent-title">%s</h1><h2 class="entry-title">%s</h2>', $parent_title, $page_title );
//    }
//    return $title;
//}

//* Display Parent and Child Page Titles on Page
//add_filter( 'genesis_post_title_output', 'lit_post_title_output', 13 );
//function lit_post_title_output( $title ) {
 
//    global $post;
			
//if ( is_page( array ('northeast', 'northwest', 'south-central', 'south', 'southwest', 'west' ))) { 
//	        $parent_title = get_the_title( $post->post_parent );
//	        $page_title = get_the_title();
//	        $title = sprintf( '<h1 class="parent-title">%s</h1>', $page_title );
	
//    }
//    return $title;	    
//}

//* Display Parent and Child Page Titles on Page
add_filter( 'genesis_post_title_output', 'lit_post_title_output', 13 );
function lit_post_title_output( $title ) {
 
    global $post;
			
if($post->ancestors)
	{
		$ancestors = end($post->ancestors);
		$parent_title = get_the_title( $post->post_parent );
	    $page_title = get_the_title();
	    $title = sprintf( '<h1 class="parent-title">%s</h1><h2 class="entry-title">%s</h2>', $parent_title, $page_title );
		
	}	
    return $title;	    
}

//* Customize the post info function
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
if ( !is_page() ) {
	$post_info = '';
	return $post_info;
}}

add_action( 'init', 'sample_remove_entry_meta', 11 );
/**
 * Remove entry meta for post types
 * 
 * @link https://gist.github.com/nathanrice/03a5871e5e5a27f22747
 */
function sample_remove_entry_meta() {
	remove_post_type_support( 'post', 'genesis-entry-meta-before-content' );
	remove_post_type_support( 'post', 'genesis-entry-meta-after-content' );
}

//* Display Parent and Child Page Titles on Page
//add_filter( 'genesis_post_title_output', 'lit_post_title_output2', 15 );
//function lit_post_title_output2( $title ) {
 
//    global $post;
			
//if ( is_page( 'residencies' ) || '19' == $post->post_parent > 0 ) { 
//	        $parent_title = get_the_title( $post->post_parent );
//	        $page_title = get_the_title();
//	        $title = sprintf( '<h1 class="parent-title">%s</h1><h2 class="entry-title">%s</h2>', $parent_title, $page_title );
	
//    }
//    return $title;	    
//}

//if ( is_page('americas') || $post->post_parent == '2348' || ($post->ancestors && in_array( '2348', $post->ancestors) ) ) {