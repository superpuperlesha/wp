<?php
namespace WM_CF7USRTOHS_ns;

class WM_CF7USRTOHS{
	public static $suf = __CLASS__;
	
	public function __construct(){
		self::wm_cf7_start();
    }
	
	
	public static function wm_cf7_start(){
		add_filter('wpcf7_mail_sent', [self::$suf, 'wm_cf7_mail_sent'], 10, 3);
		//add_filter('wpcf7_before_send_mail', [self::$suf, 'wm_cf7_mail_sent'], 10, 3);
    }
	
	
	//===CF7 HOOK===
	public static function wm_cf7_mail_sent($contact_form){
		$wpcf7 = \WPCF7_ContactForm::get_current();
        $submission = \WPCF7_Submission::get_instance();
        $data = $submission->get_posted_data();
		
		if(isset($data['wm_addcontact_compid'])){
			$yn = true;
			
			if(isset($data['usr_mailing_yn'][0])){
				if(strlen($data['usr_mailing_yn'][0])>0){
					$yn = true;
				}else{
					$yn = false;
				}
			}
			
			if($yn){
				$compid = $data['wm_addcontact_compid'];
				$fname  = (isset($data['usr_fname']) ?$data['usr_fname'] :'');
				$lname  = (isset($data['usr_lname']) ?$data['usr_lname'] :'');
				$email  = (isset($data['usr_email']) ?$data['usr_email'] :'');
				$phone  = (isset($data['usr_phone']) ?$data['usr_phone'] :'');
				self::wm_create_user($compid, $email, $fname, $lname, $phone);
			}
		}
		
		return $contact_form;
	}
	
	
	//===add user to hubspot contact===
	public static function wm_create_user($compid='', $email='', $fname='', $lname='', $phone=''){
		$compid   = substr(esc_html($compid), 0, 100);
		$email    = substr(sanitize_email($email),  0, 100);
		$fname    = substr(sanitize_user($fname),   0, 100);
		$lname    = substr(sanitize_user($lname),   0, 100);
		$phone    = substr(esc_html($phone),  0, 100);
		$CompInfo = self::wm_company_name($compid);
		$CompanyName = substr(esc_html($CompInfo['name'] ?? ''), 0, 100);
		
		if(!is_email($email)){
			$email = '';
		}
		
		$body = [
			'properties'=>[
				[  "property"=>'email',
				   "value"=>$email
				],["property"=>'firstname',
				  "value"=> $fname
				],["property"=>'lastname',
				   "value"=>$lname
				],["property"=>'website',
				   "value"=>''
				],["property"=>'company',
				   "value"=>$CompanyName
				],["property"=>'phone',
				   "value"=>$phone
				],["property"=>'address',
				   "value"=>''
				],["property"=>'city',
				   "value"=>''
				],["property"=>'state',
				   "value"=>''
				],["property"=>'zip',
				   "value"=>''
				]
			]
		];
		$response = wp_remote_post('https://api.hubapi.com/contacts/v1/contact/?hapikey='.self::wm_get_key(), array(
				'method'      => 'POST',
				'data_format' => 'body',
				'headers'     => array('Content-Type'=>'application/json; charset=utf-8'),
				'body'        => json_encode($body),
			)
		);
		$response['body'] = json_decode($response['body']);
		return(isset($response['body']->vid) ?$response['body']->vid :0);
	}
	
	
	public static function wm_company_name($wm_addcontact_compid){
		$response = wp_remote_get('https://api.hubapi.com/companies/v2/companies/'.$wm_addcontact_compid.'?hapikey='.self::wm_get_key());
		$responseBody = wp_remote_retrieve_body($response);
		$result = json_decode($responseBody);
		$res['name'] = (isset($result->properties->name->value)                 ?$result->properties->name->value                :'');
		$res['owner'] = (isset($result->properties->hubspot_owner_id->sourceId) ?$result->properties->hubspot_owner_id->sourceId :'');
		return $res;
	}
	
	
	public static function wm_list_Contact(){
		$response = wp_remote_get('https://api.hubapi.com/contacts/v1/lists/all/contacts/all?hapikey='.self::wm_get_key().'&count=999');
		$responseBody = wp_remote_retrieve_body($response);
		return json_decode($responseBody);
	}


	public static function wm_list_Company(){
		$response = wp_remote_get('https://api.hubapi.com/companies/v2/companies/?hapikey='.self::wm_get_key().'&properties=name&properties=website');
		$responseBody = wp_remote_retrieve_body($response);
		return json_decode($responseBody);
	}
	
	
	public static function wm_user_to_company($compID, $userID){
		$response = wp_remote_post('https://api.hubapi.com/companies/v2/companies/'.$compID.'/contacts/'.$userID.'?hapikey='.self::wm_get_key(), array(
				'method'      => 'PUT',
				'data_format' => 'body',
				'headers'     => array('Content-Type'=>'application/json; charset=utf-8'),
				'body'        => json_encode([]),
			)
		);
		$response['body'] = json_decode($response['body']);
		return(isset($response['body']->createdate) ?true :false);
	}
	
	
	public static function wm_get_key(){
		return esc_html(get_option('hubspot_key'));
	}
	
	
	public static function wm_update_key($hubspot_key){
		update_option('hubspot_key', substr(esc_html($hubspot_key), 0, 100), false);
	}
}