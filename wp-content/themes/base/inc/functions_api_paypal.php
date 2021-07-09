<?php
/**
 * bd_theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bd_theme
 */

// paypal request
if( isset($_POST['sport_date_msg']) ){
	$title   = 'Payment from: ';
	$content = 'Post content';
	$summ    = 123;
	
	$args = array(
		'post_title'   => $title,
		'post_type'    => 'pyment',
		'post_author'  => get_current_user_id(),
		'post_content' => $content,
		'post_status'  => 'publish');
	$postID = wp_insert_post($args);
	
	update_post_meta( $postID, 'sport_pay_user_payyed',            'no' );
	update_post_meta( $postID, 'sport_pay_user_summ',              $summ );
	
	$form='<center>
			<br/><br/>
			Total price:'.$summ.'$
			<br/><br/>
			Redirect to PayPal...
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="gotopaypal">
				<input type="hidden" name="business"      value="athletesincubator@gmail.com">
				<input type="hidden" name="cmd"           value="_xclick">
				<input type="hidden" name="item_name"     value="Payed for...">
				<input type="hidden" name="amount"        value="'.$summ.'">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="notify_url"    value="'.get_permalink(esc_url(home_url())).'/?sportitem='.$postID.'&sportkey='.md5($postID).'">
				<input type="hidden" name="return"        value="'.esc_url(home_url()).'">
				<input type="hidden" name="cancel_return" value="'.esc_url(home_url()).'">
			</form>
		</center>
		<script>
			document.getElementById("gotopaypal").submit();
		</script>';
	echo $form;
}

// paypal ansver
if( (isset($_POST['sportitem']) && isset($_POST['sportkey'])) || (isset($_GET['sportitem']) && isset($_GET['sportkey'])) ){
	if(isset($_POST['sportitem'])){$sportitem=$_POST['sportitem'];}
	if(isset($_POST['sportkey'] )){$sportkey =$_POST['sportkey']; }
	if(isset($_GET['sportitem'] )){$sportitem=$_GET['sportitem']; }
	if(isset($_GET['sportkey']  )){$sportkey =$_GET['sportkey'];  }
	if(md5($sportitem)==$sportkey){
		update_post_meta($sportitem, 'sport_pay_user_payyed', 'yes');
		$headers[] = 'From: Me Myself <'.get_option('admin_email').'>';
		$headers[] = 'Cc: John Q Codex <'.get_option('admin_email').'>';
		$headers[] = 'Cc: '.get_option('admin_email').'';
		//wp_mail( get_option('admin_email'), 'Order from site.', 'You have order from site.', $headers );
	}
}



// access:
//https://www.sandbox.paypal.com
//Email: 
//Password: 

//https://developer.paypal.com/developer/accounts/



