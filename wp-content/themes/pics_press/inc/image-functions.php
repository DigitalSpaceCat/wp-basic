<?php
/**
 * 이미지 함수 모음
 */

/* 미디어 삽입 화면에서 이미지 사이즈 선택 항목 추가 */
add_filter( 'image_size_names_choose', 'pic_add_custom_sizes' );
function pic_add_custom_sizes( $sizes ) {
 return array_merge( $sizes, array(
     'large_second' => '좀 더 큰',
     'medium_large' => '보통보다 큰',
 ) );
}

/* 파일 확장자 필터 */
add_filter( 'upload_mimes','allow_upload_mimes' );
function allow_upload_mimes() {
	$allow_mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'png' => 'image/png',
		'gif' => 'image/gif',
	);
	return $allow_mimes;
}

/* 기준을 충족하는 이미지만 업로드 가능하도록 제한 */
add_filter( 'wp_handle_upload_prefilter', 'pic_limit_resolution' );
function pic_limit_resolution( $file ) {
    //echo '<pre>' . print_r( $_FILES, true ) . '</pre>';
    $tmp_name = $file['tmp_name'];
    $type = $file['type'];
    $mime = strpos( $type, 'image' );
    list( $width, $height ) = getimagesize( $tmp_name );
    $limit_w = 1999;
    $limit_h = 500;
    if ( $width <= $limit_w || $height < $limit_h ) {
		$file['error'] = '이 이미지는 가로가 ' . $width . 'px, 세로가 ' . $height .'px 입니다. 이미지는 가로 ' . $limit_w . 'px 보다 크고, 세로 ' . $limit_h . 'px 보다 커야 합니다.';
	}
    return $file;
}
