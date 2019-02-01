	<nav class="navbar navbar-default main-navigation" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse navbar-ex2-collapse">
			<?php wp_nav_menu( array(
				'theme_location' => 'bottom',
				'depth'          => 1,
				'container'      => false,
				'menu_class'     => 'nav navbar-nav navbar-right',
				'walker'         => new wp_bootstrap_navwalker(),
				'fallback_cb'    => 'wp_bootstrap_navwalker::fallback'
				)
			);
			?>
		</div>
	</nav>