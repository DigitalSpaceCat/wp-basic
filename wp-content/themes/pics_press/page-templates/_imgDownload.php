<?php
/**
 * Template Name: _다운로드 페이지
 */

$_wp_http_referer = $_REQUEST['_wp_http_referer'];
$_wpnonce = $_REQUEST['_wpnonce'];
$img_name = sanitize_file_name( $_REQUEST['img_name'] );
$attach_id = absint( $_REQUEST['attach_id'] );

if ( ! ( wp_verify_nonce( $_wpnonce ) && $_wp_http_referer && $img_name && $attach_id ) ) {
    wp_die( '<span style="margin-bottom:1.5em;font-size: 1.5em; display: block">! 올바른 접근이 아닙니다.</span><a href="' . esc_url( home_url( '/') ) .'">첫 페이지로</a>' );
    exit;
}
// 로그인하지 않았다면 로그인 페이지로 이동. 로그인 후 이전 페이지로 리디렉트
if ( ! is_user_logged_in() ) {
    wp_safe_redirect( '/wp-login.php?redirect_to=' . esc_url( home_url( $_wp_http_referer ) ) );
    exit;
} else {
    do_action('pagetemplate_direct_download_files');
}
