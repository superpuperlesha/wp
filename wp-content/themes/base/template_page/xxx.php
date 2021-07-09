<?php
/*
Template Name: xxx
*/
get_header(); ?>

<?php while(have_posts()){
	the_post(); ?>
	
	<?php the_content() ?>
	
	<?php //===acf repeater===
	if(have_rows('hom_slider_list')){
		while(have_rows('hom_slider_list')){
			the_row(); ?>
			<?php the_sub_field('hom_slider_list_name'); ?>
			<?php if(!wp_is_mobile()){
				$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_1920x1080');
			}else{
				$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_800x600');
			}
			$image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>
			<img src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg') ?>" alt="<?php echo($image_alt ?htmlspecialchars($image_alt) :htmlspecialchars(get_the_title())) ?>">
			<?php _e('', 'base') ?>
		<?php }
	} ?>
	
	<?php //===get posts in loop===
	$lastposts = get_posts(array('posts_per_page'=>3, 'post_type'=>'xxx'));
	foreach($lastposts as $post){
		setup_postdata($post); ?>
		<?php if(!wp_is_mobile()){
			$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_1920x1080');
		}else{
			$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_800x600');
		}
		$image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>
		<img src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg')) ?>" alt="<?php echo($image_alt ?htmlspecialchars($image_alt) :htmlspecialchars(get_the_title())) ?>">
		<?php _e('', 'base') ?><?php
	}
	wp_reset_postdata(); ?>
	
<?php } ?>


<?php //===custom loop===
query_posts(array('post_type'=>'xxx', 'posts_per_page'=>-1));
while(have_posts()){
	the_post();
	if(!wp_is_mobile()){
		$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_1920x1080');
	}else{
		$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_800x600');
	}
	$image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>
	<img src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg')) ?>" alt="<?php echo($image_alt ?htmlspecialchars($image_alt) :htmlspecialchars(get_the_title())) ?>">
	<?php _e('', 'base') ?><?php
}
wp_reset_query(); ?>


<?php
$arr = get_field('empsl_press_list');
foreach($arr as $arri){
	if(!wp_is_mobile()){
		$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_1920x1080');
	}else{
		$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_800x600');
	}
	$image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); ?>
	<a href="<?php echo get_permalink($arri) ?>">
		<img src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg')) ?>" alt="<?php echo($image_alt ?htmlspecialchars($image_alt) :htmlspecialchars(get_the_title())) ?>">
		<?php echo get_post_time(get_option('date_format'), true, $arri); ?>
		<?php echo get_the_title($arri) ?>
		<?php echo get_the_excerpt($arri) ?>
		<?php _e('', 'base') ?>
	</a><?php
} ?>


<?php //===template part===
get_template_part('template_part/xxx'); ?>
	
<?php get_footer(); ?>