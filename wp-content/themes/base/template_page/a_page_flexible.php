<?php
/*
Template Name: Page-Flexible simple
*/
get_header(); ?>

<?php if(have_rows('blst')){
	$wmns_flax_counter=0;
	while(have_rows('blst')){
		the_row();
		get_template_part('template_part/'.get_row_layout(), null, ['wmns_flax_counter'=>$wmns_flax_counter++]);
	}
}else{
	echo '<h1>'.__('This page does not contain flexible blocks!', 'base').'</h1>';
} ?>
	
<?php get_footer() ?>