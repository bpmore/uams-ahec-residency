<?php
/**
Template Name: Alt Home
 */

add_action( 'genesis_meta', 'education_homealt_genesis_meta' );
/**
 * Add widget support for homealtpage. If no widgets active, display the default loop.
 *
 */
function education_homealt_genesis_meta() {

	global $paged;
	
	if( $paged < 1 ) {

		if ( is_active_sidebar( 'homealt-featured' ) || is_active_sidebar( 'homealt-top' ) || is_active_sidebar( 'homealt-middle' ) ) {

			//* Add education-pro-homealt body class
			add_filter( 'body_class', 'education_body_class' );
			
			//* Remove breadcrumbs
			remove_action( 'genesis_before_content', 'genesis_do_breadcrumbs' );
			
			//* Add homealt top widgets
			add_action( 'genesis_after_header', 'education_homealt_top_widgets' );
			
			//* Remove .site-inner
		add_filter( 'genesis_markup_site-inner', '__return_null' );
		add_filter( 'genesis_markup_content-sidebar-wrap_output', '__return_false' );
		add_filter( 'genesis_markup_content', '__return_null' );

		}
		
	}
	
	if ( is_active_sidebar( 'homealt-bottom' ) ) {
	
		//* Add homealt bottom widgets
		add_action( 'genesis_before_footer', 'education_homealt_bottom_widgets', 1 );

	}

}

function education_body_class( $classes ) {

	$classes[] = 'education-pro-homealt';
	return $classes;
	
}

function education_homealt_top_widgets() {

	genesis_widget_area( 'homealt-featured', array(
		'before' => '<div class="homealt-featured widget-area">',
		'after'  => '</div>',
	) );
	
	
	genesis_widget_area( 'homealt-top', array(
		'before' => '<div class="homealt-top widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
	genesis_widget_area( 'homealt-bottom', array(
		'before' => '<div class="homealt-bottom-wrap homealt-bottom flexible-widgets.widgets-halves widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
	
	genesis_widget_area( 'homealt-middle', array(
		'before' => '<div class="homealt-middle flexible-widgets widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

function education_homealt_bottom_widgets() {
	
//	genesis_widget_area( 'homealt-bottom', array(
//		'before' => '<div class="homealt-bottom-wrap homealt-bottom flexible-widgets widget-area"><div class="wrap">',
//		'after'  => '</div></div>',
//	) );

}

/** Removing Blog Post From homealt Page */
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' ); 

genesis();
