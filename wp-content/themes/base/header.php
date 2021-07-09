<!DOCTYPE html>
<html <?php language_attributes() ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="<?php bloginfo('charset') ?>">
		<?php wp_head() ?>
	</head>
	<body <?php body_class() ?>>
		<?php wp_body_open() ?>
		
		<a href="<?php echo esc_url(home_url()) ?>"></a>
		<nav>
			<?php wp_nav_menu( array(
					'menu'                 => '',
					'container'            => '',
					'container_class'      => '',
					'container_id'         => '',
					'container_aria_label' => '',
					'menu_class'           => '',
					'menu_id'              => 'HeaderMenuID',
					'echo'                 => true,
					'fallback_cb'          => 'wp_page_menu',
					'before'               => '',
					'after'                => '',
					'link_before'          => '',
					'link_after'           => '',
					'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'item_spacing'         => 'preserve',
					'depth'                => 0,
					'walker'               => new CWalker_Menu_Main(),
					'theme_location'       => 'HeaderMenu',
				)
			) ?>
		</nav>