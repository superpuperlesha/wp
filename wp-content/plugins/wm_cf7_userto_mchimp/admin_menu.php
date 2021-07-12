<?php
$tab=0;
if(count($_GET)==1 || isset($_GET['wm_mchp_audiences'])){
	$tab=1;
}elseif(isset($_GET['wm_mchp_addaudience'])){
	$tab=2;
}elseif(isset($_GET['wm_mchp_audienceadusr'])){
	$tab=3;
}elseif(isset($_GET['wm_mchp_cf7'])){
	$tab=4;
}elseif(isset($_GET['wm_mchp_credapi'])){
	$tab=5;
}


echo'<table class="form-table">
		<tr>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_USRTOMC_ns\WM_USRTOMC::$suf.'&wm_mchp_audiences"     ><b>'.__('Audience list', 'wm_cf7_userto_mchimp').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_USRTOMC_ns\WM_USRTOMC::$suf.'&wm_mchp_addaudience"   ><b>'.__('Add new Audience', 'wm_cf7_userto_mchimp').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_USRTOMC_ns\WM_USRTOMC::$suf.'&wm_mchp_audienceadusr" ><b>'.__('Add new Subscriber to Audience', 'wm_cf7_userto_mchimp').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_USRTOMC_ns\WM_USRTOMC::$suf.'&wm_mchp_cf7"           ><b>'.__('CF7 Integration', 'wm_cf7_userto_mchimp').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_USRTOMC_ns\WM_USRTOMC::$suf.'&wm_mchp_credapi"       ><b>'.__('Credentials to API MailChimp', 'wm_cf7_userto_mchimp').'</b></a></td>
		<tr>
	</table>
	<div class="wrap">';


if($tab==1){
	$res = \WM_USRTOMC_ns\WM_USRTOMC::wm_list_audience();
	echo'<h1>'.__('Audience list', 'wm_cf7_userto_mchimp').'</h1>
		<table class="wp-list-table widefat fixed striped table-view-list">
			<thead>
				<tr>
					<th align="center"><b>'.__('Name', 'wm_cf7_userto_mchimp').'</b></th>
					<th align="center"><b>'.__('Count', 'wm_cf7_userto_mchimp').'</b></th>
					<th align="center"><b>'.__('id', 'wm_cf7_userto_mchimp').'</b></th>
					<th align="center"><b>'.__('Subject', 'wm_cf7_userto_mchimp').'</b></th>
					<th align="center"><b>'.__('Perm. reminder', 'wm_cf7_userto_mchimp').'</b></th>
					<th align="center"><b>'.__('CF7 Field', 'wm_cf7_userto_mchimp').'</b></th>
				<tr>
			</thead>
			<tbody>';
			if(isset($res->lists) && is_array($res->lists)){
				foreach($res->lists as $resi){
					echo'<tr>
							<td class="title column-title has-row-actions column-primary page-title">'.esc_html($resi->name).'</td>
							<td class="title column-title has-row-actions column-primary page-title">'.esc_html($resi->stats->member_count).'</td>
							<td class="title column-title has-row-actions column-primary page-title">'.esc_html($resi->id).'</td>
							<td class="title column-title has-row-actions column-primary page-title">'.esc_html($resi->campaign_defaults->subject).'</td>
							<td class="title column-title has-row-actions column-primary page-title">'.esc_html($resi->permission_reminder).'</td>
							<td class="title column-title has-row-actions column-primary page-title">[hidden wm_mchp_cf7_audience_id default:"'.esc_html($resi->id).'"]</td>
						</tr>';
				}
			}
	echo'</tbody>
		</table>';
}


if($tab==2){
	if(isset($_POST['wm_mchp_add_audience_submit'])){
		\WM_USRTOMC_ns\WM_USRTOMC::wm_create_audience(  substr($_POST['wm_mchp_add_audience_name'],      0, 100),
														substr($_POST['wm_mchp_add_audience_email'],     0, 100),
														substr($_POST['wm_mchp_add_audience_city'],      0, 100),
														substr($_POST['wm_mchp_add_audience_state'],     0, 100),
														substr($_POST['wm_mchp_add_audience_zip'],       0, 100),
														substr($_POST['wm_mchp_add_audience_country'],   0, 100),
														substr($_POST['wm_mchp_add_audience_from_name'], 0, 100),
														substr($_POST['wm_mchp_add_audience_subject'],   0, 300),
														substr($_POST['wm_mchp_add_audience_language'],  0, 2),
														substr($_POST['wm_mchp_add_audience_permission_reminder'], 0, 500)
													);
	}
	echo'<h1>'.__('Add new Audience', 'wm_cf7_userto_mchimp').'</h1>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
			<table>
				<tbody>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_name"                 placeholder="'.__('Name',                    'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="email"  name="wm_mchp_add_audience_email"                placeholder="'.__('E-Mail',                  'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_city"                 placeholder="'.__('City',                    'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_state"                placeholder="'.__('State',                   'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_zip"                  placeholder="'.__('Zip',                     'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_country"              placeholder="'.__('Country',                 'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_from_name"            placeholder="'.__('From Name',               'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_subject"              placeholder="'.__('Subject',                 'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_language"             placeholder="'.__('Language (RU,EN,...)',    'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text"   name="wm_mchp_add_audience_permission_reminder"  placeholder="'.__('Permis. reminder (text)', 'wm_cf7_userto_mchimp').'" title="'.__('Why did you receive this letter.', 'wm_cf7_userto_mchimp').'">
						</td>
					</tr>
					<tr>
						<td>
							<p class="submit">
								<input type="submit"  name="wm_mchp_add_audience_submit" value="'.__('Add', 'wm_cf7_userto_mchimp').'" class="button button-primary">
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</form>';
}


if($tab==3){
	if(isset($_POST['wm_mchp_add_subscriber_submit'])){
		$userID = \WM_USRTOMC_ns\WM_USRTOMC::wm_create_subscriber(  substr($_POST['wm_subscriber_fname'], 0, 100),
																	substr($_POST['wm_subscriber_lname'], 0, 100),
																	substr($_POST['wm_subscriber_email'], 0, 100),
																	substr($_POST['wm_audience_id'],      0, 100)
																);
	}
	echo'<h1>'.__('Add new Subscriber to Audience', 'wm_cf7_userto_mchimp').'</h1>
		'.(isset($userID) && $userID>0 ?'<p>'.__('User Added!', 'wm_cf7_userto_mchimp').'</p>' :'').'
		<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
			<table>
				<tbody>
					<tr>
						<td>
							<select name="wm_audience_id">';
								$res = \WM_USRTOMC_ns\WM_USRTOMC::wm_list_audience();
								if(isset($res->lists) && is_array($res->lists)){
									foreach($res->lists as $resi){
										echo'<option value="'.esc_html($resi->id).'">'.esc_html($resi->name).'</option>';
									}
								}
						echo'</select>
						</td>
					</tr>
					<tr>
						<td><input type="text" name="wm_subscriber_fname" placeholder="'.__('First Name', 'wm_cf7_userto_mchimp').'"></td>
					</tr>
					<tr>
						<td><input type="text" name="wm_subscriber_lname" placeholder="'.__('Last Name',  'wm_cf7_userto_mchimp').'"></td>
					</tr>
					<tr>
						<td><input type="text" name="wm_subscriber_email" placeholder="'.__('E-Mail',     'wm_cf7_userto_mchimp').'"></td>
					</tr>
					<tr>
						<td>
							<p class="submit">
								<input type="submit" name="wm_mchp_add_subscriber_submit" value="'.__('Add', 'wm_cf7_userto_mchimp').'" class="button button-primary">
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</form>';
}


if($tab==4){
	echo'<div>
			<h1>'.__('CF7 Integration', 'wm_cf7_userto_mchimp').'</h1>
			<p>'.__('CF7 short code, with audience id', 'wm_cf7_userto_mchimp').': <code>[hidden wm_mchp_cf7_audience_id default:"1234567"]</code></p>
			<p>'.__('CF7 fields can be', 'wm_cf7_userto_mchimp').': <code>[usr_email*] [usr_fname] [usr_lname] [usr_mailing_yn]</code></p>
		</div>';
}


if($tab==5){
	if(isset($_POST['wm_mchp_acces_submit'])){
		\WM_USRTOMC_ns\WM_USRTOMC::wm_update_key(substr($_POST['mailchimp_key'], 0, 100));
	}
	echo'<h1>'.__('MailChimp Credentials to API', 'wm_cf7_userto_mchimp').'</h1>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
			<table>
				<tr>
					<td>
						<input type="text"        name="mailchimp_key"         value="'.esc_html(\WM_USRTOMC_ns\WM_USRTOMC::wm_get_key()).'" placeholder="'.__('MailChimp API KEY', 'wm_cf7_userto_mchimp').'">
					</td>
				</tr>
				<tr>
					<td>
						<p class="submit">
							<input type="submit"  name="wm_mchp_acces_submit"  value="'.__('Save', 'wm_cf7_userto_mchimp').'" class="button button-primary">
						</p>
					</td>
				</tr>
			</table>
		</form>';
}

echo'</div>'; ?>