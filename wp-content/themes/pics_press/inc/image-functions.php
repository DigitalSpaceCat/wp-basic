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

/* 이미지 올릴 때 EXIF GPS 정보가 있다면 추가 */
add_filter( 'wp_read_image_metadata', 'add_photo_exif_geotags', 10, 3 );
function add_photo_exif_geotags( $meta, $file, $sourceImageType ) {
	$exif = @exif_read_data( $file );
    // 위도
    if ( !empty( $exif['GPSLatitude'] ) ) {
        $meta_array['latitude_array'] = $exif['GPSLatitude'];
        $meta['latitude'] = wp_exif_frac2dec( $meta_array['latitude_array'][0] ) +
                            wp_exif_frac2dec( $meta_array['latitude_array'][1] ) / 60 +
                            wp_exif_frac2dec( $meta_array['latitude_array'][2] ) / 3600;
	}
	if ( !empty( $exif['GPSLatitudeRef'] ) ) {
		$meta['latitude_ref'] = trim( $exif['GPSLatitudeRef'] );
	}
    // 경도
    if (!empty( $exif['GPSLongitude']) ) {
        $meta_array['longitude_array'] = $exif['GPSLongitude'];
        $meta['longitude'] = wp_exif_frac2dec( $meta_array['longitude_array'][0] ) +
                            wp_exif_frac2dec( $meta_array['longitude_array'][1] ) / 60 +
                            wp_exif_frac2dec( $meta_array['longitude_array'][2] ) / 3600;
	}
	if ( !empty( $exif['GPSLongitudeRef'] ) ) {
		$meta['longitude_ref'] = trim( $exif['GPSLongitudeRef'] );
	}

	return $meta;
}

/**
 * 위도, 경도, 섬네일 이미지 경로, 이미지 포스트 URL 데이터를 배열로 저장
 * 원본 이미지의 가로, 세로 및 긴 축 데이터를 각 커스텀 필드를 생성하여 저장
 */
add_filter( 'wp_generate_attachment_metadata', 'add_custom_image_metadata_fields', 10, 2 );
function add_custom_image_metadata_fields( $metadata, $attachment_id ) {

	// 위도, 경도 데이터를 조건에 따라 음의 기호를 추가
	if ( array_key_exists( 'latitude', $metadata['image_meta'] ) ) {
		$latitude = $metadata['image_meta']['latitude']; // 위도
		$latitude_ref = $metadata['image_meta']['latitude_ref']; // 위도의 북위 또는 남위
		$longitude = $metadata['image_meta']['longitude']; // 경도
		$longitude_ref = $metadata['image_meta']['longitude_ref']; // 경도의 동경 또는 서경
		( $latitude_ref == 'S') ? $lat = -$latitude : $lat = $latitude; // 남위일 때 음의 기호 추가
		( $longitude_ref == 'W') ? $lng = -$longitude : $lng = $longitude; // 서경일 때 음의 기호 추가

		$post_url = get_permalink( $attachment_id ); // 싱글 이미지 포스트 페이지 퍼머링크
        $file_name = $metadata['sizes']['thumbnail']['file']; // 'thumbnail' 이미지 사이즈 파일 이름
		$upload_dir = wp_upload_dir(); // 워드프레스 업로드 경로
		$img_url = $upload_dir['baseurl'] . '/' . $file_name; // 섬네일 이미지 URL

		$location = array(
			'lat' => $lat,
			'lng' => $lng,
			'post_url' => $post_url,
			'img_url' => $img_url
		);
		add_post_meta( $attachment_id, '_location', $location ); // 이미지는 한 번의 업로드 과정만 존재하므로 add_post_meta 함수로 충분
	}
	// 가로, 세로 값 및 긴 축
	$pic_width = $metadata['width'];
	$pic_height = $metadata['height'];
	$pic_axis = ( $pic_width >= $pic_height ) ? '가로' : '세로';

	add_post_meta( $attachment_id, 'pic_width', $pic_width );
	add_post_meta( $attachment_id, 'pic_height', $pic_height );
	add_post_meta( $attachment_id, 'pic_axis', $pic_axis );

	return $metadata; // 반드시 추가
}

/** 분류와 포스트 필드 데이터 제어
 * 이미지 메타 데이터의 caption 데이터를 워드프레스에 이미지를 업로드할 때 지정한 분류의 term에 연결
 * wp_set_object_terms 함수를 사용하여 term이 존재하면 연결만, 존재하지 않는다면 추가하고 연결
 * post_excerpt, post_content 필드의 데이터 업데이트
 */
add_filter( 'wp_update_attachment_metadata', 'image_meta_update', 10, 2 );
function image_meta_update( $metadata, $attachment_id ) {
    $title = $metadata['image_meta']['title'];
    // mediacat, photocat
    $caption = $metadata['image_meta']['caption'];
    if ( $caption ) {
        $_caption_arr = explode( ',', $caption );
        $key_first = $_caption_arr[0]; // mediacat
        $key_second = $_caption_arr[1]; // photocat
        wp_set_object_terms( $attachment_id, $key_first, 'mediacat' );
        wp_set_object_terms( $attachment_id, $key_second, 'photocat' );
        // 이미지 메타 데이터의 caption 데이터를 분류 term으로 활용한 후 이미지 포스트의 캡션(post_excerpt) 필드 데이터를 이미지 제목으로 업데이트
        wp_update_post( array( 'ID' => $attachment_id, 'post_excerpt' => $title ) );
    }
    // cameracat
    $camera = $metadata['image_meta']['camera'];
    if ( $camera ) {
        wp_set_object_terms( $attachment_id, $camera, 'cameracat' );
    }
    // phototag
    $phototags = $metadata['image_meta']['keywords'];
    if ( $phototags ) {
        wp_set_object_terms( $attachment_id, $phototags, 'phototag' );
        // 대체 텍스트(alt) 데이터를 phototag term을 텍스트 형식으로 추가하여 업데이트
		$image_alt = implode( ', ', $phototags );
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $image_alt );
        // 검색을 위해 post_content 필드에 텍스트 형식의 대체 텍스트(alt) 추가
        wp_update_post( array( 'ID' => $attachment_id, 'post_content' => $image_alt ) );
    }

    return $metadata;
}

/** 미디어 편집 화면에서 포스트 업데이트할 때
 * 분류(phototag) term 데이터를 '_wp_attachment_image_alt' (대체 텍스트)와 '설명' (post_content) 필드에 저장
 * 제목(post_title)을 캡션(post_excerpt)에 저장
 */
add_filter( 'edit_attachment', 'insert_alt_caption_field' );
function insert_alt_caption_field( $post_id ) {
	if ( is_admin() && get_post_type() == 'attachment' ) { // 생략가능
		remove_action( 'edit_attachment', 'insert_alt_caption_field' );
		$title = get_the_title( $post_id );
		$ptags = array();
		$terms = get_the_terms( $post_id , 'phototag' );
		if( $terms ) {
			foreach( $terms as $term ) {
				$ptags[] = $term->name;
			}
			$phototag = implode( ', ', $ptags );
		}
		update_post_meta( $post_id, '_wp_attachment_image_alt', $phototag );
		wp_update_post( array( 'ID' => $post_id, 'post_content' => $phototag, 'post_excerpt' => $title ) ); // 검색을 위해
	} // 생략가능
}

/**
 * 이미지 다운로드 처리
 */
add_action( 'admin_post_nopriv_direct_download_files', 'func_direct_download_files' );
add_action( 'admin_post_direct_download_files', 'func_direct_download_files' );
function func_direct_download_files() {
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
    }

    /* 다운로드 수 커스텀 필드와 회원 메타 데이터에 다운로드 이미지 포스트 ID 추가 */
    $dcount = get_post_meta( $attach_id, 'download_count', true ); // 다운로드 수 저장 커스텀 필드
    if ( $dcount == '' ) {
    	add_post_meta( $attach_id, 'download_count', 1 ); // 해당 이미지 포스트의 최초 커스텀 필드 생성 및 추가
    }

    // 다운로드 수 및 다운로드 이미지 포스트 ID를 usermeta에 저장
    $current_user_id = get_current_user_id(); // 로그인한 회원 ID
    $current_user_download_image_ids = get_user_meta( $current_user_id, 'download_image_ids', true ); // 다운로드 이미지 포스트 ID 메타 데이터 필드

    // 회원의 메타 데이터 필드에 다운로드하는 이미지 포스트 ID가 없을 때
    if ( ! in_array( $attach_id, $current_user_download_image_ids ) ) {
    	// 다운로드 수 더하기
    	$dcount++;
    	update_post_meta( $attach_id, 'download_count', $dcount );
    	// 다운로드한 회원의 메타 데이터 필드에 이미지 ID 추가
    	array_push( $current_user_download_image_ids, $attach_id );
    	update_user_meta( $current_user_id, 'download_image_ids', $current_user_download_image_ids );
    }

    // 회원 메타데이터에 다운로드 포스트 ID 최초 추가
    if ( empty( $current_user_download_image_ids ) ) {
    	$first_download_image_id = array( $attach_id );
    	update_user_meta( $current_user_id, 'download_image_ids', $first_download_image_id );
    }

    // 이미지 다운로드
    $upload_dir = wp_upload_dir();
    $download_image = $upload_dir['basedir'] . '/' . $img_name;
    header('Content-Description: File Transfer');
    header('content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . wp_basename( $download_image ) );
    header('Expires: 0');
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: public');
    header('Content-Transfer-Encoding: binary');
    readfile( $download_image );
    exit;
}
