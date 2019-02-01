<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Global House
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- [if IE]><meta http-equiv="X-UA-Compatible" content="IE=Edge"/><! [endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 9]><p class="browsehappy alert alert-danger">최신 브라우저로 업데이트 하세요. 그렇지 않으면 이 알림이 계속 나옵니다. <a class="alert-link" href="http://browsehappy.com/">최신 브라우저 선택하기</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p><![endif]-->
<?php get_template_part( 'inc/menu', 'top' ); ?>
<div id="page" class="hfeed site container">

	<div id="content" class="site-content row">
	