<?php
$tab=0;
if(count($_GET)==1 || isset($_GET['wm_mchp_companies'])){
	$tab=1;
}elseif(isset($_GET['wm_mchp_contacts'])){
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
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf.'&wm_mchp_companies"     ><b>'.__('Company list', 'wm_cf7_userto_hubspot').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf.'&wm_mchp_contacts"      ><b>'.__('Contact list', 'wm_cf7_userto_hubspot').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf.'&wm_mchp_audienceadusr" ><b>'.__('Add new Contact to Company', 'wm_cf7_userto_hubspot').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf.'&wm_mchp_cf7"           ><b>'.__('CF7 Integration', 'wm_cf7_userto_hubspot').'</b></a></td>
			<td align="center"><a href="'.admin_url().'/options-general.php?page='.\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf.'&wm_mchp_credapi"       ><b>'.__('Credentials to API HubSpot', 'wm_cf7_userto_hubspot').'</b></a></td>
		<tr>
	</table>
	<div class="wrap">';


if($tab==1){
	$res = \WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_list_Company();
	echo'<h1 class="wp-heading-inline">'.__('Company list', 'wm_cf7_userto_hubspot').'</h1>
		<table class="wp-list-table widefat fixed striped table-view-list">
			<thead>
				<tr>
					<th align="center" class="manage-column column-title column-primary"><b>'.__('Company name', 'wm_cf7_userto_hubspot').'</b></th>
					<th align="center" class="manage-column column-title column-primary"><b>'.__('Site',         'wm_cf7_userto_hubspot').'</b></th>
					<th align="center" class="manage-column column-title column-primary"><b>'.__('CF7 Field',    'wm_cf7_userto_hubspot').'</b></th>
					<th align="center" class="manage-column column-title column-primary"><b>'.__('Deleted',      'wm_cf7_userto_hubspot').'</b></th>
				<tr>
			<thead>
			<tbody>';
			if(isset($res->companies) && is_array($res->companies)){
				foreach($res->companies as $resi){
					echo'<tr>
							<td class="title column-title has-row-actions column-primary page-title" data-colname="'.__('Company name', 'wm_cf7_userto_hubspot').'">
								<strong>
									'.esc_html((isset($resi->properties->name->value)    ?$resi->properties->name->value    :'')).'
								</strong>
							</td>
							<td class="title column-title has-row-actions column-primary page-title" data-colname="'.__('Site', 'wm_cf7_userto_hubspot').'">
								<strong>
									<a class="row-title" href="https://'.esc_html((isset($resi->properties->website->value) ?$resi->properties->website->value :'')).'" target="_blank">
										'.esc_html((isset($resi->properties->website->value) ?$resi->properties->website->value :'')).'
									</a>
								</strong>
							</td>
							<td class="title column-title has-row-actions column-primary page-title" data-colname="'.__('CF7 Field', 'wm_cf7_userto_hubspot').'">
								[hidden wm_addcontact_compid default:"'.esc_html($resi->companyId).'"]
							</td>
							<td class="title column-title has-row-actions column-primary" data-colname="'.__('Deleted', 'wm_cf7_userto_hubspot').'">
								'.($resi->isDeleted ?'DELETED' :'').'
							</td>
						</tr>';
				}
			}
	echo'</tbody>
		</table>';
}


if(($tab==2)){
	$res = \WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_list_Contact();
	echo'<h1 class="wp-heading-inline">'.__('Contact list', 'wm_cf7_userto_hubspot').'</h1>
		<table class="wp-list-table widefat fixed striped table-view-list">
			<thead>
				<tr>
					<th align="center"><b>'.__('First Name', 'wm_cf7_userto_hubspot').'</b></th>
					<th align="center"><b>'.__('Last Name',  'wm_cf7_userto_hubspot').'</b></th>
					<th align="center"><b>'.__('Company',    'wm_cf7_userto_hubspot').'</b></th>
					<th align="center"><b>'.__('E-Mail',     'wm_cf7_userto_hubspot').'</b></th>
				<tr>
			</thead>
			<tbody>';
				if(isset($res->contacts) && is_array($res->contacts)){
					foreach($res->contacts as $resi){
						$email = '';
						
						foreach($resi->{'identity-profiles'} as $resii){
							foreach($resii->identities as $resiii){
								if($resiii->type == 'EMAIL'){
									$email = $resiii->value;
								}
							}
						}
						
						echo'<tr>
								<td class="title column-title has-row-actions column-primary page-title">
									<strong>
										'.esc_html((isset($resi->properties->firstname->value) ?$resi->properties->firstname->value :'')).'
									</strong>
								</td>
								<td class="title column-title has-row-actions column-primary page-title">
									<strong>
										'.esc_html((isset($resi->properties->lastname->value)  ?$resi->properties->lastname->value  :'')).'
									</strong>
								</td>
								<td class="title column-title has-row-actions column-primary page-title">
									<strong>
										'.(isset($resi->properties->company->value) ?esc_html($resi->properties->company->value) :'').'
									</strong>
								</td>
								<td class="title column-title has-row-actions column-primary page-title">
									'.esc_html($email).'
								</td>
							</tr>';
					}
				}
		echo'</tbody>
		</table>';
}


if($tab==3){
	if(isset($_POST['wm_addcontact_compid_submit'])){
		$userID = \WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_create_user(  substr($_POST['wm_addcontact_compid'], 0, 100),
																	substr($_POST['wm_addcontact_compid_user_email'], 0, 100),
																	substr($_POST['wm_addcontact_compid_user_fname'], 0, 100),
																	substr($_POST['wm_addcontact_compid_user_lname'], 0, 100)
																);
		if($userID > 0){
			echo'<p>'.__('Contact created.', 'wm_cf7_userto_hubspot').'</p>';
		}else{
			echo'<p>'.__('Contact NOT created!!!', 'wm_cf7_userto_hubspot').'</p>';
		}
		
		\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_user_to_company(substr($_POST['wm_addcontact_compid'], 0, 100), $userID);
		if($userID > 0){
			echo'<p>'.__('Contact added to company.', 'wm_cf7_userto_hubspot').'</p>';
		}else{
			echo'<p>'.__('Contact NOT added to company!!!', 'wm_cf7_userto_hubspot').'</p>';
		}
	}
	echo'<h1 class="wp-heading-inline">'.__('Add new Contact to Company', 'wm_cf7_userto_hubspot').'</h1>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="POST" class="search-box">
			<table>
				<tbody>
					<tr>
						<td>
							<select name="wm_addcontact_compid">';
								$res = \WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_list_Company();
								if(isset($res->companies) && is_array($res->companies)){
									foreach($res->companies as $resi){
										if($resi->isDeleted == ''){
											echo'<option value="'.esc_html($resi->companyId).'">'.esc_html($resi->properties->name->value).' ('.esc_html($resi->properties->website->value).')</option>';
										}
									}
								}
						echo'</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="wm_addcontact_compid_user_fname" placeholder="'.__('First Name', 'wm_cf7_userto_hubspot').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="wm_addcontact_compid_user_lname" placeholder="'.__('Last Name', 'wm_cf7_userto_hubspot').'">
						</td>
					</tr>
					<tr>
						<td>
							<input type="email" name="wm_addcontact_compid_user_email" placeholder="'.__('E-Mail', 'wm_cf7_userto_hubspot').'">
						</td>
					</tr>
					<tr>
						<td>
							<p class="submit">
								<input type="submit" name="wm_addcontact_compid_submit" value="'.__('Add', 'wm_cf7_userto_hubspot').'" class="button button-primary">
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</form>';
}


if($tab==4){
	echo'<div>
			<h1 class="wp-heading-inline">'.__('CF7 Integration', 'wm_cf7_userto_hubspot').'</h1>
			<p>'.__('CF7 short code, with company id', 'wm_cf7_userto_hubspot').': <code>[hidden wm_addcontact_compid default:"1234567"]</code></p>
			<p>'.__('CF7 fields can be', 'wm_cf7_userto_hubspot').': <code>[usr_email*] [usr_fname] [usr_lname] [usr_phone] [usr_mailing_yn]</code></p>
		</div>';
}


if($tab==5){
	if(isset($_POST['wm_hs_acces_submit'])){
		\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_update_key(substr($_POST['hubspot_key'], 0, 100));
	}
	echo'<h1 class="wp-heading-inline">'.__('Credentials to API HubSpot', 'wm_cf7_userto_hubspot').'</h1>
		<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
			<table>
				<tbody>
					<tr>
						<td>
							<input type="text"        name="hubspot_key"         value="'.esc_html(\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_get_key()).'" placeholder="'.__('HubSpot API KEY', 'wm_cf7_userto_hubspot').'">
						</td>
					</tr>
					<tr>
						<td>
							<p class="submit">
								<input type="submit"  name="wm_hs_acces_submit"  value="'.__('Save', 'wm_cf7_userto_hubspot').'" class="button button-primary">
							</p>
						</td>
					</tr>
				</tbody>
			</table>
		</form>';
}

echo'</div>'; ?>