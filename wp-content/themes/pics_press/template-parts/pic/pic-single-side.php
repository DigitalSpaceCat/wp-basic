<?php
/* image.php 사이드 인클루드 파일 */
//echo '<pre>' . print_r( $post, true ) . '</pre>';

//$attach_id = $post->ID;
//$author_id = $post->post_author;
$attach_id = get_the_ID(); // 포스트 ID
$author_id = get_the_author_meta( 'ID' ); // post author
$meta = wp_get_attachment_metadata( $attach_id ); // _wp_attachment_metadata 필드 데이터
// 원본 이미지
$full_size_width = $meta['width']; // 원본 이미지 가로
$full_size_height = $meta['height']; // 원본 이미지 세로
$full_size_filename = $meta['file']; // 원본 이미지 파일 이름
?>
<div class="image_author">
	<div class="author_avatar">
		<?php echo get_avatar( $author_id, 55 ); ?>
	</div>
	<div class="author_detail">
		<div class="author_nick">
            <a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php the_author(); ?></a>
        </div>
		<?php echo '이미지, 추천, 다운로드'; ?>
	</div>
</div>
<?php // 등록자 정보 ?>

<?php
if ( function_exists( 'get_favorites_button' ) ) {
	echo '<div class="pics_favorites">';
		echo get_favorites_button( $attach_id );
	echo '</div>';
}
// 추천 버튼
?>

<div class="size_list">
	<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST">
		<table id="download_list" class="table">
    <?php
        // 원본 이미지의 데이터 배열
        $array_full = array(
            'file' => $full_size_filename,
            'width' => $full_size_width,
            'height' => $full_size_height,
        );
         // 원본 이미지를 추가한 이미지 사이즈별 데이터
        $sizes_names = $meta['sizes'];
        $sizes_names['full'] = $array_full; // full (원본 이미지) 이미지 사이즈 추가
        unset( $sizes_names['thumbnail'] ); // thumbnail 제외

        // 이미지 사이즈 루프
        foreach( $sizes_names as $size_name ) {
            // 이미지 가로, 세로 사이즈
            $_width = $size_name['width']; // 가로
            $_height = $size_name['height']; // 세로
            $wnh = join( ' x ', array( $_width, $_height ) ); // 가로 x 세로
            // 이미지 확장자와 용량 구하기, allow_url_fopen 제한 기준
            $filename = $size_name['file']; // 이미지 파일 이름
            $_upload_dir = wp_upload_dir(); // 워드프레스 사이트의 업로드 경로 관련 정보
            $_image_path = $_upload_dir['path'] . '/' . $filename; // 이미지의 절대 경로
            $_ext = pathinfo( $_image_path ); // 절대 경로로 얻은 파일 정보
            $extension = strtoupper( $_ext['extension'] ); // 파일 정보 중 확장자 정보를 대문자로
            $_filesize = filesize( $_image_path ); // 절대 경로로 얻은 파일의 용량
            $img_filesize = size_format( $_filesize, 2 ); // 용량을 쉽게 알 수 있도록 출력하는 워드프레스 함수, 소수 2자리까지 제한
    ?>

			<tr>
				<td class="choice_down"><input type="radio" name="img_name" value="<?php echo $filename; ?>" required></td>
				<td class="choice_size"><?php echo $wnh; ?></td>
				<td class="choice_ext"><?php echo $extension; ?></td>
				<td class="choice_filesize"><?php echo $img_filesize; ?></td>
			</tr>
        <?php } ?>
		</table>
        <input type="hidden" name="action" value="direct_download_files">
        <input type="hidden" name="attach_id" value="<?php echo $attach_id; ?>">
		<?php wp_nonce_field(); ?>
		<button type="submit" class="btn_download">이미지 무료 다운로드</button>
	</form>
</div>
<?php //이미지 사이즈별 다운로드 ?>
