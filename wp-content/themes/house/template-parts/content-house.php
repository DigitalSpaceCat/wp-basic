<?php
/**
 * 싱글 매물 콘텐츠의 메타데이터 표현하기.
 *
 */

?>

<?php the_title( '<h3>', '</h3>' ); ?>

<div>
	<h4>the_meta()</h4>
	<?php the_meta(); ?>
</div><!-- the_meta() -->

<div>
	<h4>the_field()</h4>
	<ul>
		<li>등록구분 : <?php the_field( 'house_agent' ); ?></li>
		<li>빌트인 : <?php the_field( 'house_builtin' ); ?></li>
		<li>주소 : <?php the_field( 'house_location' ); ?></li>
	</ul>	
</div><!-- the_field() // ACF 플러그인 -->

<div>
	<h4>get_post_meta()</h4>
	<ul>
		<li>등록구분 : <?php echo get_post_meta($post->ID, 'house_agent', true); ?></li>
		<li>빌트인 : 
			<?php
				$builtins = get_post_meta($post->ID, 'house_builtin', true);
				foreach ( $builtins as $builtin ) {
					echo $builtin . ", ";
				}
			?>
		</li>
		<li>주소 : 
			<?php
				$location = get_post_meta($post->ID, 'house_location', true);  
				echo $location[ 'address' ] . "<br>";
				echo $location[ 'lat' ] . "<br>";
				echo $location[ 'lng' ];
			?>
		</li>
	</ul>		
</div><!-- get_post_meta() -->
