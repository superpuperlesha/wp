<?php
function base_scripts_styles() {
	$in_footer = true;
	
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery',             esc_url(get_template_directory_uri()).'/_slicing/data/js/jquery-3.3.1.min.js',          array(),         '', $in_footer);
	
	wp_enqueue_style('reboot',              esc_url(get_template_directory_uri()).'/_slicing/data/css/bootstrap-reboot.min.css',    array());
	wp_enqueue_style('bootstrap-grid',      esc_url(get_template_directory_uri()).'/_slicing/data/css/bootstrap-grid.min.css',      array());
	wp_enqueue_style('bootstrap',           esc_url(get_template_directory_uri()).'/_slicing/data/css/bootstrap.min_13.css',        array());
	wp_enqueue_style('font-awesome',        esc_url(get_template_directory_uri()).'/_slicing/data/css/font-awesome.min.css',        array());
	wp_enqueue_style('main',                esc_url(get_template_directory_uri()).'/_slicing/data/css/main.css',                    array());
	//wp_enqueue_style('datepicker',          esc_url(get_template_directory_uri()).'/_slicing/data/css/datepicker.min.css',          array());
	wp_enqueue_style('theme',               get_stylesheet_uri(),                                                          array());
	
	wp_enqueue_script('bundle',             esc_url(get_template_directory_uri()).'/_slicing/data/js/bootstrap.bundle.min.js',      array('jquery'), '', $in_footer);
	wp_enqueue_script('bootstrap',          esc_url(get_template_directory_uri()).'/_slicing/data/js/bootstrap.min.js',             array('jquery'), '', $in_footer);
	//wp_enqueue_script('datepicker',         esc_url(get_template_directory_uri()).'/_slicing/data/js/datepicker.min.js',            array('jquery'), '', $in_footer);
	wp_enqueue_script('impl',               esc_url(get_template_directory_uri()).'/impl.js',                                       array('jquery'), '', $in_footer);
	//wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'base_scripts_styles');


