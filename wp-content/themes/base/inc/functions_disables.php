<?php
	
	
	//===Remove tags support from posts===
	function myprefix_unregister_tags(){
		unregister_taxonomy_for_object_type('post_tag', 'post');
	}
	add_action('init', 'myprefix_unregister_tags');
	
	
	//===Disable embeds on init===
	/*add_action('init', function(){
		remove_action('wp_head',             'wp_oembed_add_discovery_links');
		remove_action('wp_head',             'wp_oembed_add_host_js');
		remove_action('wp_head',             'wp_generator');
		remove_action('wp_head',             'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles',     'print_emoji_styles');
		remove_action('admin_print_styles',  'print_emoji_styles');
		remove_filter('the_content_feed',    'wp_staticize_emoji');
		remove_filter('comment_text_rss',    'wp_staticize_emoji');
		remove_filter('wp_mail',             'wp_staticize_emoji_for_email');
	}, PHP_INT_MAX - 1);*/
	
	
	//===disable GUTTENBERG for posts===
	add_filter('use_block_editor_for_post', '__return_false', 10);
	//===disable GUTTENBERG for post types===
	add_filter('use_block_editor_for_post_type', '__return_false', 10);
	
	
	//===disable color sheme==
	remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
	//===disable QTRANSLATE GENERATOR PLUGIN NAME===
	remove_action('wp_head','qtranxf_wp_head_meta_generator');
	
	
	//===remove defoult editor from pages===
	add_action('admin_init', 'hide_editor');
	function hide_editor(){
		if(isset($_POST['post_ID'])){$post_id = $_POST['post_ID']; }
		if(isset($_GET['post'])    ){$post_id = $_GET['post'];     }
		if(!isset($post_id))return;
		$tpn = get_page_template_slug($post_id);
		if(in_array($tpn, ['template_page/a_page_flexible.php', 'template_page/a_page_home.php'])){
			remove_post_type_support('page', 'editor');
		}
	}
	
	//===remove defoult image to post===
	/*add_action('admin_init', 'hide_thumbnail');
	function hide_thumbnail(){
		if(isset($_POST['post_ID'])){$post_id = $_POST['post_ID']; }
		if(isset($_GET['post'])    ){$post_id = $_GET['post'];     }
		if(!isset($post_id))return;
		if(get_post_type($post_id)=='post'){
			remove_post_type_support('post', 'thumbnail');
			remove_post_type_support('post', 'editor', 'excerpt');
		}
	}*/
	
	//===USER PROFILE - my-description HIDE===
	/*function remove_website_row_wpse_94963_css(){
		echo'<style>
				tr.user-description-wrap, .user-url-wrap{display:none;}
			</style>';
	}
	add_action( 'admin_head-user-edit.php', 'remove_website_row_wpse_94963_css' );
	add_action( 'admin_head-profile.php',   'remove_website_row_wpse_94963_css' );*/
	
	
	//===hide file editors===
	function disable_mytheme_action() {
		define('DISALLOW_FILE_EDIT', TRUE);
		//define('DISALLOW_FILE_MODS', TRUE);
    }
    add_action('init','disable_mytheme_action');
	
?>