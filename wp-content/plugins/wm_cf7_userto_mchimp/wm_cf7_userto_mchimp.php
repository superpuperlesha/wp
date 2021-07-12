<?php
/**
 * @link              
 * @since             1.0.0
 * @package           wm_cf7_userto_mchimp
 *
 * @wordpress-plugin
 * Plugin Name:       Contact Form user to Mailchimp Audience
 * Plugin URI:        
 * Description:       Transfer of users from Contact Form 7 to Mailchimp Audience.
 * Version:           1.0.0
 * Author:            superpuperlesha@gmail.com
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wm_cf7_userto_mchimp
 */


// Exit if accessed directly
if(!defined('ABSPATH'))exit;


define( 'wm_cf7_userto_mchimp_VERSION', '1.0.0' );


function WMufn_USRTOMC_i18n_init() {
    $loaded = load_plugin_textdomain('wm_cf7_userto_mchimp', false, dirname(__FILE__).'/languages/');

    if(!$loaded){
       $loaded = load_muplugin_textdomain('wm_cf7_userto_mchimp', '/languages/');
    }

    if(!$loaded){
        $loaded = load_theme_textdomain('wm_cf7_userto_mchimp', get_stylesheet_directory().'/languages/');
    }

    if(!$loaded){
        $locale = apply_filters('plugin_locale', function_exists('determine_locale') ?determine_locale() :get_locale(), 'wm_cf7_userto_mchimp');
        $mofile = dirname( __FILE__ ).'/languages/wm_cf7_userto_mchimp-'.$locale.'.mo';
        load_textdomain('wm_cf7_userto_mchimp', $mofile);
    }
}
add_action('plugins_loaded','WMufn_USRTOMC_i18n_init');


include_once(dirname(__FILE__).'/functions_api_mailchimp.php');


//===add link to setup plugin===
function WMufn2_plugin_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page='.\WM_USRTOMC_ns\WM_USRTOMC::$suf.'">'.__('Settings', 'wm_cf7_userto_mchimp').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'WMufn2_plugin_settings_link' );


//===main admin menu===
add_action('admin_menu', 'WMufn_wmcf7tomch_menu');
function WMufn_wmcf7tomch_menu(){
	add_submenu_page('options-general.php', __('Mail Chimp', 'wm_cf7_userto_mchimp'), __('Mail Chimp', 'wm_cf7_userto_mchimp'), 'administrator', \WM_USRTOMC_ns\WM_USRTOMC::$suf, 'WMufn_submenuPlug');
}


function WMufn_submenuPlug(){
	include_once(dirname(__FILE__).'/admin_menu.php');
}

\WM_USRTOMC_ns\WM_USRTOMC::wm_cf7_start();