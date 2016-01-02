<?php
/**
 * Bare minimum Stencil theme functions.php
 *
 * @package Stencil
 * @subpackage Theme
 */

// Make sure WordPress is loaded.
if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden', true, 403 );
	exit();
}

// Load Stencil framework.
require_once 'stencil/stencil-loader.php';

// Optionally include WordPress Objects.
require_once 'functions/wordpress-objects.php';

// All requests are handled by index.php.
add_filter( 'stencil:template_index_only', '__return_true' );

// Hook into the require filter to tell Stencil what Implementation we need.
add_filter( 'stencil:require', 'mustache_theme_implementation' );

// Load the router, which handles running controllers.
add_action( 'after_setup_theme', 'mustache_theme_router' );

/**
 * Tell Stencil what implementation this theme needs
 *
 * @return string
 */
function mustache_theme_implementation() {
	return 'Mustache';
}

/**
 * Load the router script that calls specific controllers
 */
function mustache_theme_router() {
	if ( ! is_admin() ) {
		include( 'router/router.php' );
	}
}
