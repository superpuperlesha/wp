<?php


// hide default pyments list in admin menu
// function custom_menu_page_removing() {
    // remove_menu_page('edit.php?post_type=auth');
// }
// add_action('admin_menu', 'custom_menu_page_removing');

// Register a custom menu page for PAYMENTS.
// function adminpanel_list_payments(){
    // add_theme_page( 
        // __( 'Payments list', 'base' ),
        // 'Payments',
        // 'manage_options',
        // 'payments_list',
        // 'payments_menu_functions',
        // esc_url(get_template_directory_uri()).'/img/money.png',
        // 69
    // );
// }
// add_action('admin_menu', 'adminpanel_list_payments');
 
// Display a PAYMENTS menu page
// function payments_menu_functions(){
	// if( !isset($_GET['week']) ){
		// $_GET['week'] = '*';
	// }
	// $dates = array();

	// $str='<table width="100%">
			// <tr>
				// <td align="center"><h4>Date of Registration</h4></td>
				// <td align="center"><h4>Report Number</h4></td>
				// <td align="center"><h4>Picture</h4></td>
				// <td align="center"><h4>First Name</h4></td>
				// <td align="center"><h4>Last Name</h4></td>
				// <td align="center"><h4>Sport</h4></td>
				// <td align="center"><h4>Position(s)</h4></td>
				// <td align="center"><h4>Date of the Report</h4></td>
				// <td align="center"><h4>Total Price</h4></td>
				// <td align="center"><h4>Full Info</h4></td>
				// <td align="center"><h4>Payed</h4></td>
			// </tr>';
	// $args = array(
		// 'post_type'      => 'pyment',
		// 'posts_per_page' => 0,
		// 'orderby'        => 'date'
	// );
	// query_posts($args);
	// while(have_posts()){
		// the_post();
		// $userID  = get_post_field('post_author', get_the_id());
		// $udata   = get_userdata( $userID );
		// $img     = wp_get_attachment_image_src(get_user_meta( $userID, 'ava_id', true ), 'thumbnail_225x225');
		
		// $a       = unserialize(get_post_field('sport_pay_date', get_the_id()));
		// for($i=0;$i<count($a);$i++){
			// if(!in_array($a[$i], $dates)){
				// $dates[] = $a[$i];
			// }
		// }
		
		// if( $_GET['week']=='*' || in_array($_GET['week'], $a) ){
			// $str.='<tr>
					// <td align="center">'.get_the_date('m/d/Y').'</td>
					// <td align="center">'.get_the_id().'</td>
					// <td align="center"><img src="'.(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/sport_adminicon_nouser.png').'" height="50" width="50" alt="ava" /></td>
					// <td align="center">'.get_the_author_meta( 'first_name' ).'</td>
					// <td align="center">'.get_the_author_meta( 'last_name' ).'</td>
					// <td align="center">'.get_post_field( 'sport_pay_user_sport', get_the_id()).'</td>
					// <td align="center">'.get_post_field( 'sport_pay_user_sport_positions', get_the_id()).'/'.get_post_field( 'sport_pay_user_sport_positionssec', get_the_id()).'</td>
					// <td align="center">'.get_the_content().'</td>
					// <td align="center">$'.get_post_field('sport_pay_user_summ',   get_the_id()).'</td>
					// <td align="center"><a href="'.get_permalink(get_field('admin_download_sportsmen_order_information', 'option')).'/?postID='.get_the_id().'" target="_blank">Download</a></td>
					// <td align="center"><img src="'.esc_url(get_template_directory_uri()).'/img/'.( get_post_field('sport_pay_user_payyed', get_the_id())=='no' ?'no.png' :'yes.png' ).'" height="24" width="24" alt="yn" /></td>
				// </tr>';
		// }
	// }
	// $str.='</table>';
	// wp_reset_query();
	
	// echo'<label for="seldate"><b>Select week:</b></select>
		// <select name="seldate" id="seldate" onchange=" window.top.location=\''.esc_url(home_url()).'/wp-admin/admin.php?page=payments_list&week=\'+this.value; ">
			// <option value="*" '.($_GET['week']=='*' ?'selected' :'').'>*</option>';
	// for($i=0;$i<count($dates);$i++){
		// echo'<option value="'.urlencode($dates[$i]).'" '.($_GET['week']==$dates[$i] ?'selected' :'').'>'.$dates[$i].'</option>';
	// }
	// echo'</select>'.$str;
// }



