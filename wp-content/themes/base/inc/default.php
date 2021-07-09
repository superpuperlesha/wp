<?php

function seo_warning() {
	if( get_option( 'blog_public' ) ) return;
	$message = __( 'You are blocking access to robots. You must go to your <a href="%s">Reading</a> settings and uncheck the box for Search Engine Visibility.', 'base' );
	echo '<div class="error"><p>';
	printf( $message, admin_url( 'options-reading.php' ) );
	echo '</p></div>';
}
add_action( 'admin_notices', 'seo_warning' );


//===LOCALIZATION THEME===
function theme_localization(){
	load_theme_textdomain('base', get_template_directory() . '/language');
	add_theme_support( 'automatic-feed-links' );
}
add_action( 'after_setup_theme', 'theme_localization' );


//===acf theme functions placeholders===
if( !class_exists( 'acf' ) && !is_admin() ) {
	function get_field_reference( $field_name, $post_id ) { return ''; }
	function get_field_objects( $post_id = false, $options = array() ) { return false; }
	function get_fields( $post_id = false ) { return false; }
	function get_field( $field_key, $post_id = false, $format_value = true )  { return false; }
	function get_field_object( $field_key, $post_id = false, $options = array() ) { return false; }
	function the_field( $field_name, $post_id = false ) {}
	function have_rows( $field_name, $post_id = false ) { return false; }
	function the_row() {}
	function reset_rows( $hard_reset = false ) {}
	function has_sub_field( $field_name, $post_id = false ) { return false; }
	function get_sub_field( $field_name ) { return false; }
	function the_sub_field( $field_name ) {}
	function get_sub_field_object( $child_name ) { return false;}
	function acf_get_child_field_from_parent_field( $child_name, $parent ) { return false; }
	function register_field_group( $array ) {}
	function get_row_layout() { return false; }
	function acf_form_head() {}
	function acf_form( $options = array() ) {}
	function update_field( $field_key, $value, $post_id = false ) { return false; }
	function delete_field( $field_name, $post_id ) {}
	function create_field( $field ) {}
	function reset_the_repeater_field() {}
	function the_repeater_field( $field_name, $post_id = false ) { return false; }
	function the_flexible_field( $field_name, $post_id = false ) { return false; }
	function acf_filter_post_id( $post_id ) { return $post_id; }
}


add_shortcode('policy_page_url', 'wpdocs_ppu_func');
function wpdocs_ppu_func(){
	return get_privacy_policy_url();
}


//add_theme_support('title-tag');


//Replace standard wp menu classes
// function change_menu_classes( $css_classes ) {
	// return str_replace( array( 'current-menu-item', 'current-menu-parent', 'current-menu-ancestor' ), 'active', $css_classes );
// }
// add_filter( 'nav_menu_css_class', 'change_menu_classes' );


// function theme_disable_cheks() {
	// $disabled_checks = array( 'TagCheck', 'Plugin_Territory', 'CustomCheck', 'EditorStyleCheck' );
	// global $themechecks;
	// foreach ( $themechecks as $key => $check ) {
		// if ( is_object( $check ) && in_array( get_class( $check ), $disabled_checks ) ) {
			// unset( $themechecks[$key] );
		// }
	// }
// }
// add_action( 'themecheck_checks_loaded', 'theme_disable_cheks' );


//Allow tags in category description
// $filters = array( 'pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description' );
// foreach ( $filters as $filter ) {
	// remove_filter( $filter, 'wp_filter_kses' );
// }

// function clean_phone( $phone ){
    // return preg_replace( '/[^0-9]/', '', $phone );
// }


//===excerpt more===
// function my_theme_excerpt_more($more){
	// return ' ...';
// }
// add_filter( 'excerpt_more', 'my_theme_excerpt_more' );


// function basetheme_options_capability(){
	// $role = get_role( 'administrator' );
	// $role->add_cap( 'theme_options_view' );
	// $role2 = get_role( 'editor' );
	// $role2->add_cap( 'theme_options_view' );
// }
// add_action( 'admin_init', 'basetheme_options_capability' );

