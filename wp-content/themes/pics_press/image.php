<?php
/**
 * 모든 싱글 이미지 첨부 페이지 템플릿 파일
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/pic/pic', 'single' );

		endwhile; // End of the loop.

		get_template_part( 'template-parts/pic/pic', 'related' );
		
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
	<aside id="secondary" class="widget-area">
		<?php get_template_part( 'template-parts/pic/pic', 'single-side' ); ?>
	</aside><!-- #secondary -->

<?php
get_footer();
