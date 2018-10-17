<?php
/**
 * Template Name: _연습장
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		// 여기서

		echo '<style>table#_table thead td{color:#454545;font-weight:700}table#_table td{padding: 10px;border:1px solid #c4c4c4}table#_table .exc{background-color:#f3f3f3}table#_table .meta{background-color:#e5f2fe}</style>';
		$_attachments = get_posts( array( 'post_type' => 'attachment' ) );
		echo '<table id="_table"><thead>';
		echo '<tr>';
		echo '<td>I</td><td>post_title</td><td>post_type</td><td>post_content</td><td>post_excerpt</td><td class="meta">대체 텍스트(alt)</td><td>post_parent</td><td class="exc">첨부 포스트 제목</td><td class="exc">Parent 포스트 타입</td><td>post_status</td><td>post_mime_type</td>';
		echo '</tr></thead>';
		echo '<tbody>';
		foreach ( $_attachments as $post ) {
			echo '<tr>';
			echo '<td><img src="' . $post->guid . '" width="100px"></td>';
			echo '<td>' . $post->post_title . '</td>';
			echo '<td>' . $post->post_type . '</td>';
			echo '<td>' . $post->post_content . '</td>';
			echo '<td>' . $post->post_excerpt . '</td>';
			echo '<td class="meta">' . get_post_meta( $post->ID, '_wp_attachment_image_alt', true) . '</td>';
			echo '<td>' . $post->post_parent . '</td>';
			echo '<td class="exc">' . get_post_field('post_title', $post->post_parent) . '</td>';
			echo '<td class="exc">' . get_post_field('post_type', $post->post_parent) . '</td>';
			echo '<td>' . $post->post_status . '</td>';
			echo '<td>' . $post->post_mime_type . '</td>';
			echo '</tr>';
		}
		echo '</tbody></table>';

		// 여기 사이에
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();