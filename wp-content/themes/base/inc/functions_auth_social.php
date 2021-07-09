<?php


//===AUTH GOOGLE all===
define('auth_google_app_secret',                     'wURzV5j-S0PSWyE3BkhUgBb6'); // APP secret
define('auth_google_app_id',                         '160988627479-mkd3ronj06rqqboaj54je18t9li6sai2.apps.googleusercontent.com');
define('auth_google_app_redirect',                   getSEFfile('login-page.php').'?auth_google=1'); // app redirect url after auth any roles in google
define('auth_google_url',                            'https://accounts.google.com/o/oauth2/auth?'.urldecode(http_build_query(array('redirect_uri'=>auth_google_app_redirect, 'response_type'=>'code', 'client_id'=>auth_google_app_id, 'scope'=>'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'))));
//===AUTH getting info GOOGLE===
define('auth_google_app_redirect_talent_getinfo',    getSEFfile('signup-page.php').'?reg_talent_google=1'); // app redirect url after getting info in google
define('auth_google_app_redirect_employer_getinfo',  getSEFfile('signup-page.php').'?reg_employer_google=1'); // app redirect url after getting info in google
define('auth_google_app_redirect_recruiter_getinfo', getSEFfile('signup-page.php').'?reg_recruiter_google=1'); // app redirect url after getting info in google
define('auth_google_reg_talent_url',                 'https://accounts.google.com/o/oauth2/auth?'.urldecode(http_build_query(array('redirect_uri'=>auth_google_app_redirect_talent_getinfo, 'response_type'=>'code', 'client_id'=>auth_google_app_id, 'scope'=>'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'))));
define('auth_google_reg_employer_url',               'https://accounts.google.com/o/oauth2/auth?'.urldecode(http_build_query(array('redirect_uri'=>auth_google_app_redirect_employer_getinfo, 'response_type'=>'code', 'client_id'=>auth_google_app_id, 'scope'=>'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'))));
define('auth_google_reg_recruiter_url',              'https://accounts.google.com/o/oauth2/auth?'.urldecode(http_build_query(array('redirect_uri'=>auth_google_app_redirect_recruiter_getinfo, 'response_type'=>'code', 'client_id'=>auth_google_app_id, 'scope'=>'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'))));
if(isset($_GET['reg_talent_google'])){
	define('auth_google_redirect', auth_google_app_redirect_talent_getinfo);
}elseif(isset($_GET['reg_employer_google'])){
	define('auth_google_redirect', auth_google_app_redirect_employer_getinfo);
}elseif(isset($_GET['reg_recruiter_google'])){
	define('auth_google_redirect', auth_google_app_redirect_recruiter_getinfo);
}else{
	define('auth_google_redirect', auth_google_app_redirect);
}


//===AUTH FACEBOOK all===
define('auth_fb_app_secret',                         '695b0398dd151738e5ffe5c9c3bdec67'); // APP secret
define('auth_fb_app_id',                             '2491560394416027'); // APP ID
define('auth_fb_app_redirect',                       getSEFfile('login-page.php').'?auth_fb=1'); // app redirect url after auth any roles in FB
define('auth_fb_url',                                'https://www.facebook.com/dialog/oauth?'.urldecode(http_build_query(array('client_id'=>auth_fb_app_id, 'redirect_uri'=>auth_fb_app_redirect, 'response_type'=>'code', 'scope'=>'email'))));
//===AUTH getting info FB===
define('auth_FB_app_redirect_talent_getinfo',        getSEFfile('signup-page.php').'?reg_talent_fb=1'); // app redirect url after getting info in fb
define('auth_FB_app_redirect_employer_getinfo',      getSEFfile('signup-page.php').'?reg_employer_fb=1'); // app redirect url after getting info in fb
define('auth_FB_app_redirect_recruiter_getinfo',     getSEFfile('signup-page.php').'?reg_recruiter_fb=1'); // app redirect url after getting info in fb
define('auth_fb_talent_url',                         'https://www.facebook.com/dialog/oauth?'.urldecode(http_build_query(array('client_id'=>auth_fb_app_id, 'redirect_uri'=>auth_FB_app_redirect_talent_getinfo, 'response_type'=>'code', 'scope'=>'email'))));
define('auth_fb_employer_url',                       'https://www.facebook.com/dialog/oauth?'.urldecode(http_build_query(array('client_id'=>auth_fb_app_id, 'redirect_uri'=>auth_FB_app_redirect_employer_getinfo, 'response_type'=>'code', 'scope'=>'email'))));
define('auth_fb_recruiter_url',                      'https://www.facebook.com/dialog/oauth?'.urldecode(http_build_query(array('client_id'=>auth_fb_app_id, 'redirect_uri'=>auth_FB_app_redirect_recruiter_getinfo, 'response_type'=>'code', 'scope'=>'email'))));
if(isset($_GET['reg_talent_fb'])){
	define('auth_fb_redirect', auth_FB_app_redirect_talent_getinfo);
}elseif(isset($_GET['reg_employer_fb'])){
	define('auth_fb_redirect', auth_FB_app_redirect_employer_getinfo);
}elseif(isset($_GET['reg_recruiter_fb'])){
	define('auth_fb_redirect', auth_FB_app_redirect_recruiter_getinfo);
}else{
	define('auth_fb_redirect', auth_fb_app_redirect);
}


//===AUTH linkedin all===
define('auth_li_app_secret',                         'PElGuAdzgTy99HAC'); // APP secret
define('auth_li_app_id',                             '866gtwf9we8yfl'); // APP ID
define('auth_li_app_redirect',                       getSEFfile('login-page.php').'?auth_li=1'); // app redirect url after auth any roles in LI
define('auth_li_app_redirect_talent_getinfo',        getSEFfile('signup-page.php').'?reg_talent_li=1'); // app redirect url after getting info in li
define('auth_li_app_redirect_employer_getinfo',      getSEFfile('signup-page.php').'?reg_employer_li=1'); // app redirect url after getting info in li
define('auth_li_app_redirect_recruiter_getinfo',     getSEFfile('signup-page.php').'?reg_recruiter_li=1'); // app redirect url after getting info in li
define('auth_li_url',                                'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.auth_li_app_id.'&redirect_uri='.urlencode(auth_li_app_redirect                  ).'&state=fooobar&scope=r_liteprofile+r_emailaddress+w_member_social');
define('auth_li_talent_url',                         'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.auth_li_app_id.'&redirect_uri='.urlencode(auth_li_app_redirect_talent_getinfo   ).'&state=fooobar&scope=r_liteprofile+r_emailaddress+w_member_social');
define('auth_li_employer_url',                       'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.auth_li_app_id.'&redirect_uri='.urlencode(auth_li_app_redirect_employer_getinfo ).'&state=fooobar&scope=r_liteprofile+r_emailaddress+w_member_social');
define('auth_li_recruiter_url',                      'https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id='.auth_li_app_id.'&redirect_uri='.urlencode(auth_li_app_redirect_recruiter_getinfo).'&state=fooobar&scope=r_liteprofile+r_emailaddress+w_member_social');
if(isset($_GET['reg_talent_li'])){
	define('auth_li_redirect', auth_li_app_redirect_talent_getinfo);
}elseif(isset($_GET['reg_employer_li'])){
	define('auth_li_redirect', auth_li_app_redirect_employer_getinfo);
}elseif(isset($_GET['reg_recruiter_li'])){
	define('auth_li_redirect', auth_li_app_redirect_recruiter_getinfo);
}else{
	define('auth_li_redirect', auth_li_app_redirect);
}


