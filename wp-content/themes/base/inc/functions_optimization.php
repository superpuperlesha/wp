<?php

// function defer_js($tag, $handle, $src){
	// if(!is_admin()){
		// $tag = str_replace( ' src=', ' defer src=', $tag );
	// }
	// return $tag;
// }
//add_filter('script_loader_tag', 'defer_js', 99, 3);


//===UPLOADED IMAGE QUALITY===
add_filter('jpeg_quality', function($arg){return 80;});


//===delete WP CSS block===
function wpse71503_init() {
    if (!is_admin()) {
        wp_deregister_style('thickbox');
        wp_deregister_script('thickbox');
    }
}
add_action('init', 'wpse71503_init');


//=====GOOGLE SPEED TEST=====
function remove_cssjs_ver( $src ){
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src',  'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


//===HTML VALIDATION===
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($src) {
	$src = str_replace("type='text/css'", '', $src);
	$src = str_replace('type="text/css"', '', $src);
    return $src;
}
add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src) {
	$src = str_replace("type='text/javascript'", '', $src);
	$src = str_replace('type="text/javascript"', '', $src);
    return $src;
}


//===CASH EXTERNAL LIBRARYES===
function prefix_add_footer_stylesCS(){
	$in_footer = true;
	
	//===GOOGLE JS TAGMANAGER ANALITIC===
	//delete_transient('googletagsData');
	$googletagsData = get_transient('googletagsData');
	if($googletagsData === false){
		$gtmid = 'UA-104189313-1';
		$googletagsData = file_get_contents('https://www.googletagmanager.com/gtag/js?id='.$gtmid);
		$googletagsData = $googletagsData.' window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag(\'js\', new Date()); gtag(\'config\', \''.$gtmid.'\'); ';
		$file = fopen(get_template_directory().'/_cash_external_libs/googletagsData.js', 'w');
		fputs($file, $googletagsData);
		fclose($file);
		set_transient('googletagsData', $googletagsData, 86400);
	}
	wp_enqueue_script('googletagsData', esc_url(get_template_directory_uri()).'/_cash_external_libs/googletagsData.js', array(), '', $in_footer);
	//===//GOOGLE JS TAGMANAGER ANALITIC===
	
};
//add_action('get_footer', 'prefix_add_footer_stylesCS');

