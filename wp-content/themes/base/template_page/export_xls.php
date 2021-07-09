<?php
/*
Template Name: Export-XLS
*/

require dirname(dirname(__FILE__)).'/inc/xls/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(is_user_logged_in()){
	$nd_dog_status = $_GET['nd_dog_status'] ?? 0;
	
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();
	
	
	$query1 = new WP_Query(array(
			'posts_per_page' => 999999,
			'offset'         => 0,
			'post_type'      => 'sdods',
			'post_status'    => 'publish',
			'meta_query'     => array(
				array(
					'key'    => 'nd_dog_status',
					'value'  => $nd_dog_status,
				),
			),
	));
	$i = 1;
	$sheet->setCellValue('A'.$i, 'Дата заключения ДС');
	$sheet->setCellValue('B'.$i, 'Программа');
	$sheet->setCellValue('C'.$i, 'Серия ДС');
	$sheet->setCellValue('D'.$i, 'Номер ДС');
	$sheet->setCellValue('E'.$i, 'ФИО Страхователя');
	$sheet->setCellValue('F'.$i, 'Дата рождения');
	$sheet->setCellValue('G'.$i, 'Гражданство');
	$sheet->setCellValue('H'.$i, 'Дата начала действия ДС');
	$sheet->setCellValue('I'.$i, 'Дата окончания действия ДС');
	$sheet->setCellValue('J'.$i, 'Страховой платеж, грн.');
	$sheet->setCellValue('K'.$i, 'Вид страхования');
	$sheet->setCellValue('L'.$i, 'Страховая сумма');
	$sheet->setCellValue('M'.$i, 'Агентство');
	$sheet->setCellValue('N'.$i, 'Валидность полиса');
	$sheet->setCellValue('O'.$i, 'Ремарка');
	$sheet->setCellValue('P'.$i, 'Оплата');
	$sheet->setCellValue('Q'.$i, 'Дата оплаты');
	while($query1->have_posts()){
		$query1->the_post();
		$i++;
		$sheet->setCellValue('A'.$i, get_the_date('d.m.Y'));
		$sheet->setCellValue('B'.$i, get_post_meta(get_the_id(), 'nd_program',       true));
		$sheet->setCellValue('C'.$i, get_post_meta(get_the_id(), 'nd_dog_sds',       true));
		$sheet->setCellValue('D'.$i, get_post_meta(get_the_id(), 'nd_dog_nds',       true));
		$sheet->setCellValue('E'.$i, get_the_author_meta('first_name').' '.get_the_author_meta('last_name').' '.get_post_meta(get_the_id(), 'usrup_patronom', true));
		$sheet->setCellValue('F'.$i, get_post_meta(get_the_id(), 'nd_bith_date',     true));
		$sheet->setCellValue('G'.$i, getCountryName(get_post_meta(get_the_id(), 'nd_gragdanstvo', true)));
		$sheet->setCellValue('H'.$i, get_post_meta(get_the_id(), 'nd_dog_ds',        true));
		$sheet->setCellValue('I'.$i, get_post_meta(get_the_id(), 'nd_dog_dpo',       true));
		$sheet->setCellValue('J'.$i, get_post_meta(get_the_id(), 'nd_summ',          true));
		$sheet->setCellValue('K'.$i, get_post_meta(get_the_id(), 'nd_vid_strahovki', true));
		$sheet->setCellValue('L'.$i, get_post_meta(get_the_id(), 'nd_summ', true).'/'.get_post_meta(get_the_id(), 'nd_dopsumm', true));
		$sheet->setCellValue('M'.$i, get_post_meta(get_the_id(), 'nd_agency',        true));
		$sheet->setCellValue('N'.$i, (get_post_meta(get_the_id(), 'admin_nulled', true)==1 ?__('нет', 'base') :__('да', 'base')));
		$sheet->setCellValue('O'.$i, get_post_meta(get_the_id(), 'nd_remarka',       true));
		$sheet->setCellValue('P'.$i, ((int)get_post_meta(get_the_id(), 'nd_oplata_txt', true) ?__('да', 'base') :__('нет', 'base')));
		$sheet->setCellValue('Q'.$i, get_post_meta(get_the_id(), 'nd_pay_date',      true));
	}
	
	$file = dirname(dirname(__FILE__)).'/tmp/'.($nd_dog_status ?'finished' :'drafted').'_list.xlsx';
	$writer = new Xlsx($spreadsheet);
	$writer->save($file);
	//$writer->save('php://output');
	
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
	
}else{
	get_header();
	get_template_part('template_part/block_noauth');
	get_footer();
} ?>