<?php
/**
 * Template Name: _연습장
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		// 여기서
		$arg = array(
    'post_type' => 'attachment',
    'posts_per_page' => 1,
);
$img_query = get_posts( $arg );
foreach( $img_query as $img ) {
    $attach_id = $img->ID;
    $meta = wp_get_attachment_metadata( $attach_id );
    echo '<pre>' . print_r( $meta, true ) . '</pre>';
}
//
$arg = array(
	'post_type' => 'attachment',
	'posts_per_page' => 1,
);
$img_query = get_posts( $arg );
foreach( $img_query as $img ) {
	$attach_id = $img->ID;
	$meta = wp_get_attachment_metadata( $attach_id );
	$full_size_width = $meta['width'];
	$full_size_height = $meta['height'];
	$full_size_filename = $meta['file'];
	$array_full = array(
		'file' => $full_size_filename,
		'width' => $full_size_width,
		'height' => $full_size_height,
	);
	 // 원본 이미지를 추가한 이미지 사이즈별 데이터
	$sizes_names = $meta['sizes'];
	$sizes_names['full'] = $array_full; // full (원본 이미지) 이미지 사이즈 추가
	unset( $sizes_names['thumbnail'] ); // thumbnail 제외
	echo '<pre>' . print_r( $sizes_names, true ) . '</pre>';
}

		// 여기 사이에
		
		
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();