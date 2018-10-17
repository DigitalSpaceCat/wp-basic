<?php

// 로그인 로고 URL
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url() {
    return esc_url( home_url( '/' ) );
}
// 로그인 로고 URL Title
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
function my_login_logo_url_title() {
    return get_bloginfo ( 'name' ) ;
}
// 사용자가 이메일 변경 시 발송하는 메일 중지
add_filter( 'send_email_change_email', '__return_false' );
// xmlrpc 사용 중지 (예, 워드프레스 앱 사용할 수 없음)
add_filter('xmlrpc_enabled', '__return_false');

/* Emoji 사용 중지 */
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/* Dashboard metabox disable */
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
function remove_dashboard_widgets(){
	global $wp_meta_boxes;
	unset(
		$wp_meta_boxes['dashboard']['normal']['high']['dashboard_browser_nag'],
		$wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']
	);
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
	remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
	remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
	remove_action('welcome_panel','wp_welcome_panel'); // Welcome Panel
}

/* unregister all widgets (https://developer.wordpress.org/reference/functions/wp_widgets_init/#source) */
add_action('widgets_init', 'unregister_default_widgets', 11);
function unregister_default_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('WP_Widget_Media_Video');
	unregister_widget('WP_Widget_Media_Audio');
	unregister_widget('WP_Widget_Media_Image');
}

/* Tinymce 에디터 버튼 추가 */
add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );
function my_mce_buttons_2( $buttons ) {
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'fontselect';
	$buttons[] = 'backcolor'; //문자 배경색
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';
	return $buttons;
}
