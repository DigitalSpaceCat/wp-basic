<?php
/**
 * Displays top navigation
 */

?>

<nav id="site-navigation" class="main-navigation">
	<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<span class="dashicons dashicons-editor-justify"></span>
	</button>
	<ul id="menu-mainmenu" class="primary-menu">
		<li class="menu-item"><a href="<?php echo esc_url( home_url( '/_note' ) ); ?>">연습장</a></li>
		<li class="menu-item" title="모든 자료를 순서대로 볼 수 있습니다."><a href="<?php echo esc_url( home_url( '/pics' ) ); ?>">둘러보기</a></li>
		<li class="menu-item" title="지도에서 촬영 위치를 한눈에 볼 수 있습니다."><a href="<?php echo esc_url( home_url( '/trace' ) ); ?>">발자국</a></li>
		<li class="menu-item" title="테마를 정해 특별하게 구성한 세트"><a href="<?php echo esc_url( home_url( '/album' ) ); ?>">앨범</a></li>
		<?php
			if ( is_user_logged_in() ) {
				echo '<li class="menu-item"><a href="' . esc_url( home_url( '/download-and-favorite' ) ) . '">활동</a></li>';
			} else {
				echo '<li class="menu-item">';
				wp_loginout( $_SERVER['REQUEST_URI'], true );
				echo '</li>';
			}
		?>
	</ul>
</nav><!-- #site-navigation -->