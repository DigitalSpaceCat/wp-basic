<?php
/**
 * Custom Enqueue front-end scripts.
 */
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
function custom_scripts() {
	$pics_js_ver = md5( filemtime( get_template_directory() . '/assets/js/pics.js' ) );
	wp_enqueue_script( 'pics_press-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array('jquery'), '', true );
	//wp_enqueue_script( 'flex-js', get_theme_file_uri( '/assets/js/jquery.flex-images.min.js' ) );
	//wp_enqueue_script( 'lazyload-js', get_theme_file_uri( '/assets/js/jquery.lazyload.min.js' ) );
	wp_enqueue_script( 'pics-js', get_theme_file_uri( '/assets/js/pics.js' ), array(), $pics_js_ver );
	//wp_enqueue_script( 'wp-util' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
