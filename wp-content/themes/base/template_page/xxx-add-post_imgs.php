<?php
/*
Template Name: Add post image
*/
get_header();

if(is_user_logged_in()){
	while(have_posts()){
		the_post();
		the_content();
	}
	
	//===add post===
	if( isset($_POST['g_fname']) ){
		
		$_POST['g_fname'] = htmlspecialchars($_POST['g_fname']);
		$postID = wp_insert_post(array(
			'post_title'    => $_POST['g_fname'],
			'post_content'  => '',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'hero',
		));
		
		if(is_wp_error($postID)){
			echo '<h4>'.$postID->get_error_message().'</h4>';
		}else{
			//===add avatars===
			if(isset($_FILES['g_avatars']) && isset($_POST['fileup_nonce']) && count($_FILES['g_avatars'])>0 && wp_verify_nonce($_POST['fileup_nonce'], 'g_avatars')){
				//foreach($_FILES['g_avatars'] as $file){
					$file = $_FILES['g_avatars'];
					require_once( ABSPATH . 'wp-admin/includes/admin.php' );
					$file_return = wp_handle_upload( $file, array('test_form' => false ) );
					if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
						_e('Ошибка при загрузке файла!', 'Avada');
					}else{
						$filename = $file_return['file'];
						$attachment = array(
							'post_mime_type' => $file_return['type'],
							'post_title'     => htmlspecialchars(basename($filename)),
							'post_content'   => '',
							'post_status'    => 'inherit',
							'guid'           => $file_return['url'],
						);
						$attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );
						require_once(ABSPATH . 'wp-admin/includes/image.php');
						$attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
						wp_update_attachment_metadata( $attachment_id, $attachment_data );
					}
				//}
			}
		}
	} ?>

	<form action="<?php echo getSelfURL() ?>" method="post" class="wpcf7-form" enctype="multipart/form-data">
		<input type="text" name="g_fname"    value="<?php echo(isset($_POST['g_fname']) ?htmlspecialchars($_POST['g_fname']) :'') ?>" placeholder="<?php _e('Имя', 'Avada') ?>">
		<?php wp_nonce_field('g_avatars', 'fileup_nonce') ?>
		<input type="file" name="g_avatars" accept="image/jpg, image/jpeg, image/png" multiple="multiple">
		<input type="submit" value="<?php _e('Добавить', 'Avada') ?>">
	</form>
<?php }else{ ?>
	<h4><?php _e('Вы не авторизованы!', 'Avada') ?></h4>
<?php } ?>

<?php get_footer(); ?>