<?php
/**
 * This file adds the Home Page to the UAMS Pro Theme.
 *
 * @author StudioPress
 * @package Education Pro
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'education_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function education_home_genesis_meta() {

	global $paged;
	
	if( $paged < 1 ) {

		if ( is_active_sidebar( 'home-featured' ) || is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) ) {

			//* Add education-pro-home body class
			add_filter( 'body_class', 'education_body_class' );
			
			//* Remove breadcrumbs
			remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
			
			//* Add home top widgets
			add_action( 'genesis_after_header', 'education_home_top_widgets' );

		}
		
	}
	
	if ( is_active_sidebar( 'home-bottom' ) ) {
	
		//* Add home bottom widgets
		add_action( 'genesis_before_footer', 'education_home_bottom_widgets', 1 );

	}

}

function education_body_class( $classes ) {

	$classes[] = 'education-pro-home';
	return $classes;
	
}

function education_home_top_widgets() {

	genesis_widget_area( 'home-featured', array(
		'before' => '<div class="home-featured widget-area">',
		'after'  => '</div>',
	) );
	
	
	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
	genesis_widget_area( 'home-bottom', array(
		'before' => '<div class="home-bottom-wrap home-bottom flexible-widgets.widgets-halves widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="home-middle flexible-widgets widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

function education_home_bottom_widgets() {
	
//	genesis_widget_area( 'home-bottom', array(
//		'before' => '<div class="home-bottom-wrap home-bottom flexible-widgets widget-area"><div class="wrap">',
//		'after'  => '</div></div>',
//	) );

}

/** Removing Blog Post From Home Page */
remove_action( 'genesis_loop', 'genesis_do_loop' );add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' ); 

genesis();
