<?php
/*
Template Name: Export-CSV
*/

if(is_user_logged_in()){
	$dog_id = $_GET['nd_dog_status'] ?? 0;
	//header('Content-Encoding: UTF-8');
	//header( 'Content-Type: text/csv; charset=utf-8' );
    //header( 'Content-Disposition: attachment;filename=csv_'.($dog_id ?'finish' :'draft').'.csv');
    //header("Pragma: no-cache");
    //header("Expires: 0");
    //echo "\xEF\xBB\xBF";
    
    
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header( 'Content-Disposition: attachment;filename=csv_'.($dog_id ?'finish' :'draft').'.csv');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
    
    
	$fp = fopen('php://output', 'x');
	$query1 = new WP_Query(array(
			'posts_per_page' => 999999,
			'offset'         => 0,
			'post_type'      => 'sdods',
			'post_status'    => 'publish',
			'meta_query'     => array(
				array(
					'key'    => 'nd_dog_status',
					'value'  => $dog_id,
				),
			),
	));
	while($query1->have_posts()){
		$query1->the_post();
		$fields = [get_the_date('d.m.Y'),
		get_post_meta(get_the_id(), 'nd_program',       true),
		get_post_meta(get_the_id(), 'nd_dog_sn',        true),
		get_post_meta(get_the_id(), 'nd_dog_tsost',     true),
		get_post_meta(get_the_id(), 'nd_dog_tsost_per', true),
		get_post_meta(get_the_id(), 'nd_last_name',     true),
		get_post_meta(get_the_id(), 'nd_dog_ds',        true), 
		get_post_meta(get_the_id(), 'nd_dog_dpo',       true),
		get_post_meta(get_the_id(), 'nd_dog_days',      true),
		get_post_meta(get_the_id(), 'nd_dog_multi',     true),
		get_post_meta(get_the_id(), 'nd_yn_strahovka',  true),
		get_post_meta(get_the_id(), 'nd_prod',          true),
		get_post_meta(get_the_id(), 'nd_dog_kanal',     true),
		get_post_meta(get_the_id(), 'nd_signin',        true),
		get_post_meta(get_the_id(), 'nd_terminal',      true),
		get_post_meta(get_the_id(), 'nd_addr_office',   true),
		get_post_meta(get_the_id(), 'nd_addr',          true),
		get_post_meta(get_the_id(), 'nd_codebron',      true),
		get_post_meta(get_the_id(), 'nd_summ',          true),
		get_post_meta(get_the_id(), 'nd_dopsumm',       true),
		get_post_meta(get_the_id(), 'nd_valute',        true)];
		fputcsv($fp, $fields);
	}
	
	fclose($fp);
	
}else{
	get_header();
	get_template_part('template_part/block_noauth');
	get_footer();
} ?>