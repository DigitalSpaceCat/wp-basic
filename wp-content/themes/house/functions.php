<?php
/**
 * Global House functions and definitions.
 */

if ( ! function_exists( 'house_setup' ) ) :

function house_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	locate_template( 'inc/menu.php', true );
	locate_template( 'inc/wp_bootstrap_navwalker.php', true );
}
endif; // house_setup
add_action( 'after_setup_theme', 'house_setup' );

/**
 * Enqueue scripts and styles.
 */
function house_scripts() {
	wp_enqueue_style( 'house-style', get_stylesheet_uri() );
	wp_enqueue_style( 'house-custom-style', get_template_directory_uri() . '/assets/css/house.css' );
	wp_enqueue_script( 'house-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', false );
}
add_action( 'wp_enqueue_scripts', 'house_scripts' );

require get_template_directory() . '/inc/template-tags.php';
locate_template('inc/template-tags.php', true);
