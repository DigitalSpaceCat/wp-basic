<?php
/**
 * Plugin Name: House Content Type
 * Description: 매물 콘텐츠 등록을 위한 커스텀 콘텐츠 타입 'house'와 이 콘텐츠 타입에 사용할 분류(taxonomy) 'site' 정의
 */

 
/**
 * Custom Post Type, 'house'
 */
function register_house_cpt() {
	$labels = array(
		'name' => '매물목록',
		'singular_name' => '매물',
		'menu_name' => '매물 관리',
		'all_items' => '매물 목록',
		'add_new' => '매물 등록',
		'add_new_item' => '신규 매물 등록',
		'edit' => '매물 수정',
		'edit_item' => '매물 수정',
		'new_item' => '매물추가',
		'view' => '매물 정보 보기',
		'view_item' => '프런트에서 정보 보기',
		'search_items' => '매물 검색',
		'not_found' => '매물 정보가 없습니다.',
		'not_found_in_trash' => '매물 정보가 없습니다.',
	);

	//$capabilities = array()

	$args = array(
		'labels' => $labels,
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'capability_type' => 'house',
		//'capabilities' => $capabilities,
		'map_meta_cap' => true,
		'menu_icon'   => 'dashicons-groups',
		'menu_position' => 6,
		'supports' => array( 'title' ),
	);
	register_post_type( 'house', $args );
}
add_action( 'init', 'register_house_cpt' );

/**
 * Custom Taxonomy, 'site'
 */
function register_site_tax() {

	$labels = array(
		'name' => '지역',
		'label' => '지역',
		'menu_name' => '지역',
		'all_items' => '모든 지역',
		'edit_item' => '지역 수정',
		'view_item' => '지역별 목록',
		'update_item' => '지역명 수정',
		'add_new_item' => '지역 추가',
		'new_item_name' => '새로운 지역명',
		'parent_item' => '상위 지역명',
		'parent_item_colon' => '상위 지역',
		'search_items' => '지역명 찾기',
		'popular_items' => '콘텐츠가 많은 지역명',
		'choose_from_most_used' => '콘텐츠가 많은 지역',
		'not_found' => '등록된 지역이 없습니다.',
		);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false, // Default: false
		'show_admin_column' => true, // Default: false
	);
	register_taxonomy( 'site', array( 'house' ), $args );
}
add_action( 'init', 'register_site_tax');
