<?php
/**
 * Plugin Name: Custom Login Form
 * Description: 로그인 로고, 로고 URL, 로고 Title 등 로그인 폼에 관한 정의
 */

/** 로그인 로고 */
function house_login_logo_image() { 
	if ( get_option('house_login_logo') ) {
?>
		<style type="text/css">
			.login h1 a {
				background-image: url(<?php echo get_option('house_login_logo'); ?>);
				width:324px;
				background-size:auto;
			}
		</style>
<?php
	}
}
add_action( 'login_enqueue_scripts', 'house_login_logo_image' );

/** 로그인 로고 URL */
function house_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'house_login_logo_url' );

/** 로그인 로고 URL Title */
function house_login_logo_url_title() {
    return get_bloginfo ( 'name' ) ;
}
add_filter( 'login_headertitle', 'house_login_logo_url_title' );
