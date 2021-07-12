<?php
/**
 * @link              
 * @since             1.0.0
 * @package           wm_cf7_userto_hubspot
 *
 * @wordpress-plugin
 * Plugin Name:       Contact Form user to HubSpot Contacts
 * Plugin URI:        
 * Description:       Transfer of users from Contact Form 7 to HubSpot - Contacts.
 * Version:           1.0.0
 * Author:            superpuperlesha@gmail.com
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wm_cf7_userto_hubspot
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


define( 'wm_cf7_userto_hubspot_VERSION', '1.0.0' );


function WMufn_USRTOHS_i18n_init(){
    $loaded = load_plugin_textdomain('wm_cf7_userto_hubspot', false, dirname(__FILE__).'/languages/');

    if(!$loaded){
       $loaded = load_muplugin_textdomain('wm_cf7_userto_hubspot', '/languages/');
    }

    if(!$loaded){
        $loaded = load_theme_textdomain('wm_cf7_userto_hubspot', get_stylesheet_directory().'/languages/');
    }

    if(!$loaded){
        $locale = apply_filters('plugin_locale', function_exists('determine_locale') ?determine_locale() :get_locale(), 'wm_cf7_userto_hubspot');
        $mofile = dirname( __FILE__ ).'/languages/wm_cf7_userto_hubspot-'.$locale.'.mo';
        load_textdomain('wm_cf7_userto_hubspot', $mofile);
    }
}
add_action('plugins_loaded','WMufn_USRTOHS_i18n_init');


include_once(dirname(__FILE__).'/functions_api_hubspot.php');


//===add link to setup plugin===
function WMufn_plugin_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page='.\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf.'">'.__('Settings', 'wm_cf7_userto_hubspot').'</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'WMufn_plugin_settings_link' );


//===main admin menu===
add_action('admin_menu', 'WMufn_reg_menu');
function WMufn_reg_menu(){
	add_submenu_page('options-general.php', 'HubSpot', 'HubSpot', 'administrator', \WM_CF7USRTOHS_ns\WM_CF7USRTOHS::$suf, 'WMufn_wm_out_menu');
}


function WMufn_wm_out_menu(){
	include_once(dirname(__FILE__).'/admin_menu.php');
}

\WM_CF7USRTOHS_ns\WM_CF7USRTOHS::wm_cf7_start();