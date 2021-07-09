<?php

//===generator passwords===
// function rand_string($length){
	// return substr(str_shuffle(AUTH_KEY), 0, $length);
// }


// add_filter('authenticate', 'myplugin_auth_signon', 30, 3);
// function myplugin_auth_signon($user, $username, $password){
	// if(isset($user->roles) && in_array($user->roles[0], getArrRols)){
		// $usr_pass_change_ts = (int)get_user_meta($user->ID, 'usr_pass_change_ts', true);
		// if( (time() - $usr_pass_change_ts) > 7776000 ){
			// $random_password = wp_generate_password(12, false);
			// $update_user = wp_update_user( array (
					// 'ID'        => $user->ID, 
					// 'user_pass' => $random_password
				// )
			// );
			// if($update_user){
				// update_user_meta($user->ID, 'usr_pass_change_ts', time());
				// $subject = __('Ваш новый пароль', 'base');
				// $sender = get_option('name');
				// $message = 'Смена пароля. Ваш новый пароль:'.$random_password;
				// $headers[] = 'MIME-Version: 1.0' . "\r\n";
				// $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// $headers[] = "X-Mailer: PHP \r\n";
				// $headers[] = 'From: Star Insurance < '.$user->user_email.'>' . "\r\n";
				// $mail = wp_mail($user->user_email, "=?utf-8?B?".base64_encode($subject)."?=", $message, $headers);
				// if($mail){
					// $GLOBALS['site_message'] .= __('На ваш адрес электронной почты, отправлен новый пароль.', 'base').' ';
				// }else{
					// $GLOBALS['site_message'] .= __('К сожалению, письмо с новым паролем не отправлено.', 'base').' ';
				// }
			// }else{
				// $GLOBALS['site_message'] .= __('К сожалению, что-то пошло не так, обновляя ваш аккаунт.', 'base').' ';
			// }
			 // header('Location: '.esc_url(get_home_url()).'/?site_message='.urlencode($GLOBALS['site_message']));
			 // exit();
		// }
	// }
	// return $user;
// }


//===register user===
// function usrReg(){
	// $user = get_user_by('email', $_POST['usr_mail']);
	// if(!$user){
		// $_POST['usr_mail'] = sanitize_email($_POST['usr_mail']);
		// $_POST['usr_pass'] = '1234567';//$_POST['usr_pass']; //(isset($_POST['usr_pass']) ?$_POST['usr_pass'] :'111');
		// $_POST['usr_type'] = sanitize_text_field($_POST['usr_type']);
		// $userdata = array(
			// 'user_pass'       => $_POST['usr_pass'], // обязательно
			// 'user_login'      => $_POST['usr_mail'], // обязательно
			// 'user_nicename'   => '',
			// 'user_email'      => $_POST['usr_mail'],
			// 'display_name'    => '',
			// 'nickname'        => '',
			// 'first_name'      => '',
			// 'last_name'       => '',
			// 'role'            => $_POST['usr_type'], // (строка) роль пользователя
		// );
		// $user_id = wp_insert_user($userdata);
		// usrAuth();
	// }else{
		// $GLOBALS['site_message'] = __('Такой E-Mail уже существует.', 'base');
	// }
// }
// if( isset($_POST['usr_x']) && $_POST['usr_x']=='register' && isset($_POST['usr_mail']) && isset($_POST['usr_pass']) && isset($_POST['usr_type']) ){
	// usrReg();
// }
//===


//===auth user===
// function usrAuth(){
	// $creds = array(
			// 'user_login'    => $_POST['usr_mail'],
			// 'user_password' => $_POST['usr_pass'],
			// 'remember'      => true
		// );
	// $user = wp_signon($creds, false);
	// if(!is_wp_error($user)){
		// $GLOBALS['site_message'] = '';
		// if(in_array('administrator', $user->roles)){
			// wp_redirect(  );
		// }
		// exit;
	// }else{
		// $GLOBALS['site_message'] = __('Ошибка при авторизации.', 'base');
	// }
// }
// if( isset($_POST['usr_x']) && $_POST['usr_x']=='login' && isset($_POST['usr_mail']) && isset($_POST['usr_pass']) ){
	// usrAuth();
// }
//===


//===logout user===
// add_action( 'init', 'action_function_name_11' );
// function action_function_name_11() {
	// if( isset($_POST['logoutmy']) ){
		// wp_logout();
		// wp_redirect(esc_url(home_url()));
		// exit;
	// }
// }
//===



//===RESET PASSWORD CUSTOM EMAIL===
// function codecanal_reset_password_message($message, $key){
	// if(strpos($_POST['user_login'], '@')){
		// $user_data = get_user_by('email', trim($_POST['user_login']));
	// }else{
		// $login = trim($_POST['user_login']);
		// $user_data = get_user_by('login', $login);
	// }
	// $user_login = $user_data->user_login;
	// $msg = 'Кто-то запросил сброс пароля для учётной записи на сайте ПЭОЖД АВАНТАЖ:'."\r\n\r\n";
	// //$msg .= network_site_url() . "\r\n\r\n";
	// //$msg .= sprintf(__('Username: %s', 'avantag'), $user_login) . "\r\n\r\n";
	// $msg .= 'Если произошла ошибка, просто проигнорируйте это письмо, и ничего не произойдёт.' . "\r\n\r\n";
	// $msg .= 'Чтобы сбросить пароль, перейдите по следующей ссылке: ';
	// $msg .= '<a href="'.network_site_url("wp-login.php?action=rp&key=$key&login=".rawurlencode($user_login), 'login').'">перейти</a>';
	// return $msg;
// }
// add_filter('retrieve_password_message', codecanal_reset_password_message, null, 2);



//===CHANGE EMAIL FROM===
// function wpb_sender_email( $original_email_address ) {
    // return get_option('admin_email');
// }
// function wpb_sender_name( $original_email_from ) {
    // return 'ПЭОЖД АВАНТАЖ ';
// }
// add_filter( 'wp_mail_from', 'wpb_sender_email' );
// add_filter( 'wp_mail_from_name', 'wpb_sender_name' );




