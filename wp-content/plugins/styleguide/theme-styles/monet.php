<?php
/**
 * Theme: Monet
 * Theme Url: https://creativemarket.com/BinaryMoon/312560-Monet-WordPress-Portfolio-Theme?u=BinaryMoon
 *
 * @package: styleguide
 */

$css = <<<CSS
	/* sans */
	.main div.pd-rating h3.jp-relatedposts-headline,
	.main div#jp-relatedposts h3.jp-relatedposts-headline,
	.main div.sharedaddy h3.jp-relatedposts-headline,
	.main div.pd-rating h3.sd-title,
	.main div#jp-relatedposts h3.sd-title,
	.main div.sharedaddy h3.sd-title,
	.masthead .branding,
	.masthead .branding h1.site-title,
	.secondary-masthead h1.site-title,
	.main article .taxonomies,
	.post-meta-data,
	.content-comments ol.comment-list li.comment .comment-meta-data,
	.content-comments ol.comment-list li.trackback .comment-meta-data,
	.content-comments ol.comment-list li.pingback .comment-meta-data,
	.content-comments #respond p.comment-notes,
	.content-comments #respond p.logged-in-as,
	.no-results .entry-single,
	.single-attachment .entry-single,
	.error404 .entry-single,
	.singular .entry-single,
	.sidebar .widget,
	.sidebar .widget h3.widgettitle,
	.main .contributor p,
	.projects-terms,
	body {
		font-family: {{font-body}};
		font-weight: {{font-body-weight}};
	}
	/* serif */
	blockquote,
	.content-comments ol.comment-list li.comment #respond #cancel-comment-reply-link,
	.content-comments ol.comment-list li.trackback #respond #cancel-comment-reply-link,
	.content-comments ol.comment-list li.pingback #respond #cancel-comment-reply-link,
	h1, h2, h3, h4, h5, h6 {
		font-family: {{font-headers}};
		font-weight: {{font-headers-weight}};
	}
	a {
		color: {{color-link-bg-0}};
	}
	a:hover {
		color: {{color-link-bg-2}};
	}
	blockquote {
		border-color: {{color-key-bg-0}};
	}
	#minor-sidebar .sidebar-footer-toggle a:before {
		border-color:{{color-key-fg-0}};
		color: {{color-key-fg-0}};
	}
	#minor-sidebar,
	.masthead {
		background-color: {{color-key-bg-0}};
		color: {{color-key-fg-0}};
	}
	#minor-sidebar .menu-social-links a:before,
	.masthead .menu a {
		color: {{color-key-fg-0}};
		border-color:{{color-key-fg-0}};
	}
	.masthead .menu ul a.menu-back {
		color: {{color-key-fg-0}};
	}
	.masthead .menu ul a.menu-back:before {
		border-right-color: {{color-key-fg-0}};
	}
	.masthead .menu ul a.menu-expand:before {
		border-left-color: {{color-key-fg-0}};
	}
	.main .pagination span.current {
		background-color: {{color-theme-background-bg-2}};
		color: {{color-theme-background-fg-2}};
	}
CSS;

add_theme_support(
	'styleguide',
	array(
		'colors' => array(
			'key' => array(
				'label' => __( 'Key Color', 'styleguide' ),
				'default' => '#ffffff',
			),
			'link' => array(
				'label' => __( 'Link Color', 'styleguide' ),
				'default' => '#7f7f7f',
			),
		),
		'fonts' => array(
			'headers' => array(
				'label' => __( 'Header Font', 'styleguide' ),
				'default' => 'Amiri',
			),
			'body' => array(
				'label' => __( 'Body Font', 'styleguide' ),
				'default' => 'Open+Sans',
			),
		),
		'css' => $css,
		'dequeue' => array(
			'monet-fonts',
		),
	)
);
