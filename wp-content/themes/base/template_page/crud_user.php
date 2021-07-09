<?php
/*
Template Name: CRUD USER
*/
get_header();

while(have_posts()){
	the_post();
	$content = get_the_content();
}

if(is_user_logged_in()){
	$user_id  = (int)($_POST['update_usr'] ?? $_GET['user_id'] ?? 0);
	$GLOBALS['site_message'] = $GLOBALS['site_message'] ?? '';
	$curr_user_meta = get_userdata(get_current_user_id());
	
	//===DELETE USER===
	if(isset($_GET['deleluser'])){
		$user_del_meta = get_userdata($user_id);
		if( isset($user_del_meta->roles[0]) && in_array($user_del_meta->roles[0], getArrRols) ){
			if( in_array('administrator', $curr_user_meta->roles) ){
				require_once(ABSPATH.'wp-admin/includes/user.php');
				wp_delete_user($user_id, 1);
				$user_id = 0;
				$_POST['update_usr'] = 0;
				$GLOBALS['site_message'] .= __('Пользователь удален!', 'base').' ';
			}else{
				$GLOBALS['site_message'] .= __('Удалять пользователей может только администратор!', 'base').' ';
			}
		}else{
			$GLOBALS['site_message'] .= __('Не всех пользователей можно удалять!', 'base').' ';
		}
	}
	
	//===INSERT user===
	if(isset($_POST['insert_usr'])){
		$userdata = array(
			'user_pass'       => $_POST['usrup_pswd'],
			'user_login'      => $_POST['usrup_email'],
			'user_email'      => $_POST['usrup_email'],
			'role'            => 'usrfiz',
		);
		$new_user_id = wp_insert_user($userdata);
		if(!is_wp_error($new_user_id)){
			$user_id = $new_user_id;
			update_user_meta($user_id, 'usrup_ava_def', 0);
		}else{
			$GLOBALS['site_message'] .= $new_user_id->get_error_message().' ';
			$user_id = 0;
		}
	}
	
	//===UPDATE user===
	if(isset($_POST['update_usr'])){
		$user     = get_user_by('ID', $user_id);
		$usr_type = (isset($user->roles[0]) ?$user->roles[0] :'');
		if( ($user && $user_id == get_current_user_id()) || ($user && in_array('administrator', $curr_user_meta->roles)) ){
			if(isset($_POST['usrup_ava_def'])){
				update_user_meta($user_id, 'usrup_ava_def', $_POST['usrup_ava_def']);
			}
			if(isset($_POST['last_name'])){
				update_user_meta($user_id, 'last_name', $_POST['last_name']);
			}
			if(isset($_POST['first_name'])){
				update_user_meta($user_id, 'first_name', $_POST['first_name']);
			}
			
			$GLOBALS['site_message'] .= __('Пользователь изменен.', 'base').' ';
		}else{
			$GLOBALS['site_message'] .= __('Редактировать можно не всех пользователдей!', 'base').' ';
		}
	}
	
	$usr_type              = '';
	$first_name            = '';
	$last_name             = '';
	$usrup_ava_custom      = '';
	
	$user = get_user_by('ID', $user_id);
	if($user){
		$usrup_email            = $user->user_email;
		$usr_type               = (isset($user->roles[0]) ?$user->roles[0] :'');
		$last_name              = get_user_meta($user_id, 'last_name',             true);
		$first_name             = get_user_meta($user_id, 'first_name',            true);
		$usrup_ava_custom       = get_user_meta($user_id, 'usrup_ava_custom',      true);
	}else{
		$user_id = 0;
	} ?>
	
	<div class="row">
		<div class="col-md-10 pb-3">
			<?php if($user){ ?>
				<?php echo $content ?>
				<?php echo(isset($GLOBALS['site_message']) && $GLOBALS['site_message'] ?getSiteMSG($GLOBALS['site_message']) :'') ?>
				<form action="<?php echo get_the_permalink(get_field('private_myaccount_page_add_user',  'option')).'?user_id='.$user_id ?>" method="post">
					<div class="row">
						<div class="col-4 text-center"><?php
							$img = wp_get_attachment_image_src($usrup_ava_custom, 'thumbnail_400x250'); ?>
							<img id="g_avatars_img" src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg') ?>" alt="custom ava" class="img-fluid">
							<?php wp_nonce_field('g_avatars', 'fileup_nonce') ?>
							<input type="file" id="g_avatars" name="g_avatars" class="invisible" accept="image/jpg, image/jpeg, image/png" data-obj_id="<?php echo $user_id ?>" data-obj_type="user">
							<a href="#uID" id="g_avatars_ch"><?php _e('Изменить картинку', 'base') ?></a>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-12">
							<h2><?php _e('Личные данные', 'base') ?></h2>
						</div>
						
						<div class="col-3">
							<?php _e('Фамилия', 'base') ?>
						</div>
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control"  id="last_name"        name="last_name"           value="<?php echo $last_name ?>"       placeholder="<?php _e('Фамилия', 'base') ?>">
							</div>
						</div>
						
						<div class="col-3">
							<?php _e('Имя', 'base') ?>
						</div>
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control"  id="first_name"       name="first_name"          value="<?php echo $first_name ?>"       placeholder="<?php _e('Имя', 'base') ?>">
							</div>
						</div>
						
						<div class="col-3">
							<?php _e('Email', 'base') ?>
						</div>
						<div class="col-9">
							<div class="form-group">
								<input type="email" class="form-control"  id="usrup_email"         name="usrup_email"         value="<?php echo $usrup_email ?>"       placeholder="<?php _e('Email', 'base') ?>">
							</div>
						</div>
						
						<div class="col-3">
							<?php _e('Роль', 'base') ?>
						</div>
						<div class="col-9">
							<div class="form-group">
								<select class="form-control" id="usr_type" name="usr_type">
									<?php echo getListRoles($usr_type) ?>
								</select>
							</div>
						</div>
						
						<div class="col-3">
							<input type="hidden" name="update_usr" value="<?php echo $user_id ?>">
							<button type="submit" class="btn btn-success w-100"><?php _e('Сохранить', 'base') ?></button>
						</div>
						<div class="col-9">
							
						</div>
					</div>
					
					<?php if($user_id && in_array('administrator', $curr_user_meta->roles) ){ ?>
						<div class="row">
							<div class="col-9">
								
							</div>
							<div class="col-3">
								<a href="<?php echo get_the_permalink(get_field('private_myaccount_page_add_user',  'option')).'?deleluser=1&user_id='.$user_id ?>" class="btn btn-danger"><?php _e('Удалить пользователя', 'base') ?></a>
							</div>
						</div>
					<?php } ?>
					
				</form>
			<?php }else{ ?>
				<div class="row">
					<div class="col-12">
						<h1><?php echo __('Добавить пользователя', 'base') ?></h1>
						<?php echo(isset($GLOBALS['site_message']) && $GLOBALS['site_message'] ?getSiteMSG($GLOBALS['site_message']) :'') ?>
					</div>
				</div>
				<form action="<?php echo get_the_permalink(get_field('private_myaccount_page_add_user',  'option')) ?>" method="post">
					<div class="row">
						<div class="col-3">
							<?php _e('Email', 'base') ?>
						</div>
						<div class="col-9">
							<div class="form-group">
								<input type="email"    class="form-control"  id="usrup_email"         name="usrup_email"         value="<?php echo $usrup_email ?>"       placeholder="<?php _e('Email', 'base') ?>">
							</div>
						</div>
						
						<div class="col-3">
							<?php _e('Password', 'base') ?>
						</div>
						<div class="col-9">
							<div class="form-group">
								<input type="password" class="form-control"  id="usrup_pswd"           name="usrup_pswd"         value=""                                 placeholder="<?php _e('Пароль', 'base') ?>">
							</div>
						</div>
						
						<div class="col-12">
							<input type="hidden" name="insert_usr" value="<?php echo $user_id ?>">
							<button type="submit" class="btn btn-primary"><?php _e('Добавить', 'base') ?></button>
						</div>
					</div>
				</form>
			<?php } ?>
		</div>
	</div>
<?php }else{
	get_template_part('template_part/block_noauth');
} ?>

<?php get_footer(); ?>