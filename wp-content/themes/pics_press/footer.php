<?php
/**
 * The template for displaying the footer
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php
		echo '<span class="foot-site-name">&copy;' . date( 'Y ' ) . get_bloginfo( 'name' ) . '</span><a href="' . esc_url( home_url( '/blog' ) ) . '">BLOG</a>';
		?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
