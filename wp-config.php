<?php
define('DB_NAME',           'c0wp');
define('DB_USER',           'c0wp');
define('DB_PASSWORD',       'SuperPass2000');
define('DB_HOST',           'localhost');
define('DB_CHARSET',        'utf8mb4');
define('DB_COLLATE',        '');

define('WP_DEBUG',          true);
define('WPCF7_AUTOP',       false);
define('WP_HOME',          'http://'.$_SERVER['HTTP_HOST']);
define('WP_SITEURL',       'http://'.$_SERVER['HTTP_HOST']);
define('WP_POST_REVISIONS', false);
//define('AUTOSAVE_INTERVAL', 120);
//define('FS_METHOD',         'direct');
//define('EMPTY_TRASH_DAYS',  7);
//define('WP_POST_REVISIONS', 5);
//define('WP_MEMORY_LIMIT',   '128M');
//define('WP_CONTENT_URL',    'https://cdn.apri-code.com');
//define('COOKIE_DOMAIN',     'apricode.com.ua');
//define('WP_DEBUG_LOG',      'wp-errors-wmn1.log');

define( 'AUTH_KEY',         'u9WN;t,v?6M9/@Z(8oH:iuB0CR5}snv,W1i)yhR|6jLUy,)Ox!|JeXH#k/>&EX=5' );
define( 'SECURE_AUTH_KEY',  '+dr8;<7k-Sls46|oJpihq*L4[u+nsa?Z z~00Q+IGPb&3T52n3a=6.,t _-}w?nl' );
define( 'LOGGED_IN_KEY',    'T@WTkujjKMSQg]{21OU20]I3M?a]5I2(tXKU6w6nHBcBt=%gL}tq!)Y7d]q@Mn9P' );
define( 'NONCE_KEY',        'NQ6#-i{k)TAHYHEo6~]LWLgs=c/CNsURBtWF& r2:n3)^E7=3VE!dQbY!_<wY^V=' );
define( 'AUTH_SALT',        'h6EX~D>QB|1OM?i_8P,EG(SSl5GMF%6mh%2STk=;fBzK|m`?X!S7*zE6FLO5I&vN' );
define( 'SECURE_AUTH_SALT', 'ioiJkMPD1I4U7p97,@$RzU;ByGWL1;<;9tgo+e;y(,BT?U*g)(Nd9c7W_y-1M89 ' );
define( 'LOGGED_IN_SALT',   'JAeISke/Ajq6>k)Ud^q]}~Wo/1W.D[ru=!:l(T5M}&o7{BEbV{9l<PS>Eq<#c<Yi' );
define( 'NONCE_SALT',       'pAG-zar5[Nrl%hd1#!W(@JMijpxVH4$8t+ ]eWBlwXd[P&/6+D+@]oV-+0y14te[' );

$table_prefix = 'webmn2_';

if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', __DIR__ . '/' );

require_once ABSPATH . 'wp-settings.php';