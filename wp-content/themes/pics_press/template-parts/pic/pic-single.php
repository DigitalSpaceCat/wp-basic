<?php
/* image.php 본문 인클루드 파일 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<div class="single_container">
			<div class="single_image">
			<?php
                the_title();

                // 포토태그 리스트
			?>
			</div>
		</div>
	</div><!-- .entry-content -->

	<?php
		// 포토태그 리스트
	?>
</article><!-- #post-<?php the_ID(); ?> -->
