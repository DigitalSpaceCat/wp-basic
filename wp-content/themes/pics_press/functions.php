<?php
/**
 * Pics Press functions and definitions
 * @package Pics_Press
 */

if ( ! function_exists( 'pics_press_setup' ) ) :
function pics_press_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	add_editor_style( 'assets/css/editor-style.css' ); // Tinymce editor

	/*
	// medium_large_size_w, medium_large_size_h 값 업데이트, 싱글 첨부페이지 이미지에 사용.
	update_option('medium_large_size_w', 965);
	update_option('medium_large_size_h', 965);
	*/
	add_image_size( 'large_second', 1920, 0, false ); // (크롭하지 않음)
}
endif;
add_action( 'after_setup_theme', 'pics_press_setup' );

/**
 * Enqueue front-end styles.
 */
function pics_press_scripts() {
	$pics_style_ver = md5( filemtime( get_template_directory() . '/style.css' ) );
	$add_css_ver = md5( filemtime( get_template_directory() . '/assets/css/add-style.css' ) );
	wp_enqueue_style( 'pics_press-style', get_stylesheet_uri(), array(), $pics_style_ver );
	wp_enqueue_style( 'pics_add-style', get_theme_file_uri( '/assets/css/add-style.css' ), array(), $add_css_ver );
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'pics_press_scripts' );

/**
 * Enqueue back-end scripts and styles.
 */
function load_custom_wp_admin_style() {
	if ( !current_user_can( 'manage_options' ) ) {
		wp_register_style( 'add_wp_admin_css', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '1.0.0' );
		wp_enqueue_style( 'add_wp_admin_css' );
	}
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/**
 * Enqueue Login scripts and styles.
 */
function custom_loginpage_enqueue_style() {
	wp_enqueue_style( 'pics_press_loginpage', get_theme_file_uri( '/assets/css/login-style.css' ), false );
}
add_action( 'login_enqueue_scripts', 'custom_loginpage_enqueue_style', 10 );

/**
 * 인클루드
 */
require get_parent_theme_file_path( '/inc/enqueue-script.php' );
require get_parent_theme_file_path( '/inc/default-functions.php' );
require get_parent_theme_file_path( '/inc/template-tags.php' );
require get_parent_theme_file_path( '/inc/template-functions.php' );
require get_parent_theme_file_path( '/inc/image-functions.php' );
