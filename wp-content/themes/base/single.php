<?php get_header() ?>

<?php while(have_posts()){
	the_post(); ?>
	
	<h1><?php the_title() ?></h1>
	<?php echo nmssm_list('m_socials social_float') ?>	
	<?php echo nmssmshare_list('aricle__social', get_the_title(), get_the_permalink(), wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail_1920x1080')) ?>
	
	<?php the_content() ?>
	
	<?php // If comments are open or there is at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
} ?>

<?php get_footer() ?>