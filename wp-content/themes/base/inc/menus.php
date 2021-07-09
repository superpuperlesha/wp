<?php

//===Theme main front menus===
register_nav_menus( array(
	'HeaderMenu'   => __( 'Header menu',   'base' ),
	'FloatMenu'    => __( 'Float menu',    'base' ),
	'FooterMenu1'  => __( 'Footer menu 1', 'base' ),
	'FooterMenu2'  => __( 'Footer menu 2', 'base' ),
) );


//===main admin menu===
add_action('admin_menu', 'our_menu');
function our_menu(){
	add_menu_page('MEGA MENU', 'MEGA MENU', 'administrator', 'megamenu_main', 'callback_our_menu', '', 2);
	
	// $link_our_new_CPT = 'edit.php?post_type=ourservices';
	// add_submenu_page('megamenu_main', ' MEGA MENU 1',    'MEGA MENU 1',        'administrator', $link_our_new_CPT);
	// add_submenu_page('megamenu_main', '---Categoryes',   '---Categoryes',       'administrator', 'edit-tags.php?taxonomy=servcat');
}
function callback_our_menu(){
	echo '<h1>Hello!</h1><p>This is main page for WP theme "BASE"</p>';
}

function callback_MCmp_submenu(){
	return WM_USRTOMCmp1::callback_MCmp_submenu();
}

function callback_HSmp_submenu(){
	cf7hsfrt();
}



//===ACF options admin menu===
if( function_exists( 'acf_add_options_sub_page' ) && current_user_can( 'theme_options_view' ) ) {
	acf_add_options_sub_page( array(
		'title'  => __('Social networks', 'base'),
		'parent' => 'megamenu_main',
	) );
	
	acf_add_options_sub_page( array(
		'title'  => __('Footer', 'base'),
		'parent' => 'megamenu_main',
	) );
	
	acf_add_options_sub_page( array(
		'title'  => __('Set Qookie', 'base'),
		'parent' => 'megamenu_main',
	) );
}