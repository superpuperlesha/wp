<?php
/*
Template Name: Export-PDF
*/

if(is_user_logged_in()){
	$dog_id = $_GET['dog_id'] ?? 0;
	if($dog_id){
		$file = $dog_id.'.pdf';
		getSitePDF($dog_id, $file, 'I');
	}
}else{
	get_header();
	get_template_part('template_part/block_noauth');
	get_footer();
} ?>