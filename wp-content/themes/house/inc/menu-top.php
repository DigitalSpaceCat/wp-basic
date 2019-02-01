	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>

			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<?php wp_nav_menu( array(
					'theme_location' => 'top',
					'depth'          => 1,
					'container'      => false,
					'menu_class'     => 'nav navbar-nav',
					'walker'         => new wp_bootstrap_navwalker(),
					'fallback_cb'    => 'wp_bootstrap_navwalker::fallback'
					)
				); ?>
			</div>
		</div>
	</nav>