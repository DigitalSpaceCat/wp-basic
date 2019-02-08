<?php
/**
 * Plugin Name: Custom Option Page with Multi Section
 * Description: 다중 섹션으로 옵션 필드 구성이 가능한 단순 구조로 정의. 추가할 섹션, 필드가 있을 때 패턴을 읽고 나면 쉽게 처리할 수 있습니다. 다른 사이트에서 사용할 때 'house' 단어만 원하는 텍스트로 일괄 치환하여 사용하면 됩니다.
 */

delete_option( 'wp5_ga_code' ); // 이 줄은 지난 과정에서 추가한 옵션 필드를 지우는 코드입니다.
 
function register_house_options_page() {
	add_options_page( 'House Options Page', 'House Options', 'manage_options', 'housepage', 'house_options' );
}
add_action( 'admin_menu', 'register_house_options_page' );

function house_options() {
?>
	<div class="wrap">
	<h1>House Options Page</h1>
	<form method="post" action="options.php">
<?php
		do_settings_sections( 'housepage' );
		settings_fields( 'house_option_section' );
		submit_button();
?>          
	</form>
	</div>
<?php
}

////////////////////////////////////////// section01 ///////////////////////////////////////////

function house_options_01_settings() {

	add_settings_section( 'house_option_section01', 'House Image', 'house_section_desc01', 'housepage' );
	
	add_settings_field( 'house_login_logo', '로그인 페이지 로고 URL', 'house_login_logo_field_desc', 'housepage', 'house_option_section01' );
	register_setting( 'house_option_section', 'house_login_logo' );
	
	add_settings_field( 'house_site_logo', '사이트 로고 URL', 'house_site_logo_field_desc', 'housepage', 'house_option_section01' );
	register_setting( 'house_option_section', 'house_site_logo' );

} 
add_action( 'admin_init', 'house_options_01_settings' );

function house_section_desc01() {
	echo '<p>사이트 로고, 로그인 로고 등의 이미지 정보</p>';
}

function house_login_logo_field_desc() {
?>
	<input type="text" name="house_login_logo" id="house_login_logo" size="60" value="<?php echo get_option( 'house_login_logo' ); ?>" />
	<p><em>로그인 페이지 로고 전체 URL을 입력하세요.</em></p>
	<p><em>예) http://yourdoamin/wp-content/uploads/login-logo.png</em></p>
<?php
}

function house_site_logo_field_desc() {
?>
	<input type="text" name="house_site_logo" id="house_site_logo" size="60" value="<?php echo get_option( 'house_site_logo' ); ?>" />
	<p><em>사이트 로고 전체 URL을 입력하세요.</em></p>
	<p><em>예) http://yourdoamin/wp-content/uploads/site-logo.png</em></p>
<?php
}

////////////////////////////////////////// section02 ///////////////////////////////////////

function house_options_02_settings() {

	add_settings_section( 'house_option_section02', 'House Code', 'house_section_desc02', 'housepage' );

	add_settings_field( 'house_ga_code', 'Google 웹로그 분석 코드', 'house_ga_field_desc', 'housepage', 'house_option_section02' );
	register_setting( 'house_option_section', 'house_ga_code' );
	
	add_settings_field( 'house_twitter_code', '트위터 아이디', 'house_twitter_field_desc', 'housepage', 'house_option_section02' );
	register_setting( 'house_option_section', 'house_twitter_code' );

}
add_action( 'admin_init', 'house_options_02_settings' );

function house_section_desc02() {
	echo '<p>Google 웹로그 분석 코드, 트위터, 페이스북, 구글 플러스 등의 코드</p>';
}

function house_ga_field_desc() {
?>
	<input type="text" name="house_ga_code" id="house_ga_code" value="<?php echo get_option( 'house_ga_code' ); ?>" />
	<p><em>UA-XXXXX-X 형식의 코드를 입력하세요.</em></p>
<?php
}

function house_twitter_field_desc() {
?>
	<input type="text" name="house_twitter_code" id="house_twitter_code" value="<?php echo get_option( 'house_twitter_code' ); ?>" />
	<p><em>트위터 아이디를 입력하세요.</em></p>
<?php
}

////////////////////////////////////////// section03 ///////////////////////////////////////////////////////////////////////////////////////

function house_options_03_settings() {

	add_settings_section( 'house_option_section03', 'House Locations', 'house_section_desc03', 'housepage' );

	add_settings_field( 'house_location_field', '위도, 경도, 주소', 'house_location_field_desc', 'housepage', 'house_option_section03' );
	register_setting( 'house_option_section', 'house_location_field' );

} 
add_action( 'admin_init', 'house_options_03_settings' );

function house_section_desc03() {
	echo '<p>회사 위치를 구글 지도에 표시할 때 위도, 경도, 주소를 등록하여 사용하세요.</p>';
}

function house_location_field_desc() {
	$house_locations = get_option( 'house_location_field' );
?>
	<input type="text" name="house_location_field[lat]" value="<?php echo $house_locations['lat']; ?>" /><input type="text" name="house_location_field[lng]" value="<?php echo $house_locations['lng']; ?>" />
	<p><em>예) 37.586876, 126.974790</em></p>
	<input type="text" name="house_location_field[address]" size="60" value="<?php echo $house_locations['address']; ?>" />
	<p><em>예) 서울특별시 종로구 종로동 123-12번지</em></p>
<?php
}

/***************************************************************************************************/

/** Google 웹사이트 분석 스크립트 */
function ga_code() {
	if ( get_option( 'house_ga_code' ) ) {
?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo get_option( 'house_ga_code' ); ?>']);
			_gaq.push(['_setDomainName', '<?php echo str_replace( 'http://', '', get_option( 'siteurl' ) ); ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
<?php
	}
}
add_action( 'wp_footer', 'ga_code', 100 );
