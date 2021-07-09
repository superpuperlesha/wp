<?php

// //===add post view===
// add_action('wp_ajax_addViewPost',        'addViewPost');
// add_action('wp_ajax_nopriv_addViewPost', 'addViewPost');
// function addViewPost(){
	// update_post_meta((int)$_POST['addViewPost'], 'sp_view', (int)get_post_meta((int)$_POST['addViewPost'], 'sp_view', true)+1);
	// echo (int)get_post_meta((int)$_POST['addViewPost'], 'sp_view', true);
	// die();
// }


// add_action('wp_ajax_apfaddpost', 'apfaddpost');
// function apfaddpost($obj_id=0, $post_user='post'){
	// $res = ['msg'=>'1', 'url'=>'2', 'status'=>0, 'attachid'=>0];
	// $GLOBALS['site_message'] = $GLOBALS['site_message'] ?? '';
	// $obj_id    = $_POST['obj_id']   ?? $obj_id;
	// $obj_type  = $_POST['obj_type'] ?? $obj_type;
	
	// if( isset($_FILES['g_avatars']) ){
		// require_once(ABSPATH.'wp-admin/includes/image.php');
		// require_once(ABSPATH.'wp-admin/includes/file.php');
		// require_once(ABSPATH.'wp-admin/includes/media.php');
		// require_once(ABSPATH.'wp-admin/includes/admin.php');
		// $file_return = wp_handle_upload($_FILES['g_avatars'], array('test_form'=>false));
		// if(isset($file_return['error']) || isset($file_return['upload_error_handler'])){
			// $GLOBALS['site_message'] .= __('Ошибка при загрузке файла!', 'base').' ';
			// $res['status'] = 0;
		// }else{
			// $attachment = array(
				// 'post_mime_type' => $file_return['type'],
				// 'post_title'     => 'product image',
				// 'post_content'   => '',
				// 'post_status'    => 'inherit',
				// 'guid'           => $file_return['url'],
			// );
			// $attachment_id = wp_insert_attachment($attachment, $file_return['url']);
			// $attachment_data = wp_generate_attachment_metadata($attachment_id, $file_return['file']);
			// wp_update_attachment_metadata($attachment_id, $attachment_data);
			// if($obj_id){
				// if($obj_type == 'post' && (int)$obj_id>0){
					// set_post_thumbnail($obj_id, $attachment_id);
				// }
				// if($obj_type == 'user'){
					// update_user_meta($obj_id, 'usrup_ava_custom', $attachment_id);
				// }
				// $GLOBALS['site_message'] .= __('Картинка назначена.', 'base').' ';
			// }
			// $GLOBALS['site_message'] .= __('Картинка удачно изменена.', 'base').' ';
			// $img = wp_get_attachment_image_src($attachment_id, 'thumbnail_400x250');
			// $res['url'] = $img[0] ?? esc_url(get_template_directory_uri()).'/img/noimage.jpg';
			// $res['attachid'] = $attachment_id;
			// $res['status'] = 1;
		// }
	// }
	// if(wp_doing_ajax()){
		// $res['msg'] = $GLOBALS['site_message'];
		// echo json_encode($res);
		// die();
	// }
// }


// //===LOADMORE blog===
// add_action('wp_ajax_loadpostsmore',        'loadpostsmore');
// add_action('wp_ajax_nopriv_loadpostsmore', 'loadpostsmore');
// function loadpostsmore(){
	// $param = array(
		// 'post_type'       => $_POST['PostTypeLoaded'], 
		// 'posts_per_page'  => $_POST['CountLoadedInc'],
		// 'offset'          => $_POST['CountLoaded'],
	// );
	
	// if($_POST['bsort_order']=='date'){
		
	// }
	// if($_POST['bsort_order']=='view'){
		// $param = array(
			// 'post_type'       => $_POST['PostTypeLoaded'], 
			// 'posts_per_page'  => $_POST['CountLoadedInc'],
			// 'meta_key'		  => 'sp_view',
			// 'orderby'		  => 'meta_value_num',
			// 'order'			  => 'DESC',
			// 'offset'          => $_POST['CountLoaded'],
		// );
	// }
	
	// query_posts($param);
	// while(have_posts()){
		// the_post();
		// get_template_part('template_part/list_item');
	// }
	// die();
// }



//===LOAD MORE ACF===
// add_action('wp_ajax_reccocmmload',        'reccocmmload');
// add_action('wp_ajax_nopriv_reccocmmload', 'reccocmmload');
// function reccocmmload(){
	// global $post;
	// $i = 0;
	// $ii = 0;
	// if(have_rows('rcpst_list', 'option')){
		// while(have_rows('rcpst_list', 'option')){
			// the_row();
			// if(++$i > $_POST['loadPstart']){
				// $pID = get_sub_field('rcpst_list_item', 'option');
				// $post = get_post($pID);
				// setup_postdata($post);
				// get_template_part('template_part/list_item_reccommends');
				// if(++$ii==3){break;}
			// }
		// }
	// }
	// //wp_reset_postdata();
	// die();
// }