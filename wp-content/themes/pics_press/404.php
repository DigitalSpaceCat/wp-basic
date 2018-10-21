<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( '404 Error', 'pics_press' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p style="margin:2em 0;font-size:1.2em">죄송합니다. 없습니다.</p>
					<ul>
						<li>부호나 기호가 있는지 확인해보세요.</li>
						<li>CapsLock이 켜져 있는지 확인해보세요.</li>
						<li>잠시 쉬었다가 다시 시도해보세요.</li>
					</ul>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
