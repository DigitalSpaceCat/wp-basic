<?php
/* image.php 본문 인클루드 파일 */

$cpid = get_the_ID();// 현재 포스트 ID (이미지 ID)
$taglist = get_the_term_list( $cpid, 'phototag', '', ' ',' ' ); // 현재 포스트에 연결된 phototag 분류의 term
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="single_container">
			<div class="single_image">
			<?php
 				// medium_large size 이미지 출력
				echo wp_get_attachment_image( get_the_ID(), 'medium_large' );

                // 포토태그 리스트
				if ( $taglist ) {
					echo '<div class="phototag">' . $taglist . '</div>';
				}
			?>
			</div>
		</div>
	</div><!-- .entry-content -->

	<?php
		// 포토태그 리스트
		if ( $taglist ) {
			echo '<footer class="entry-footer">';
				echo '<div class="taglist">' . $taglist . '</div>';
			echo '</footer><!-- .entry-footer -->';
		}
	?>
</article><!-- #post-<?php the_ID(); ?> -->
