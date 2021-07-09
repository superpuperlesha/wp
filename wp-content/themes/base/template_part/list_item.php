<div id="post-<?php the_ID() ?>" <?php post_class('post') ?>>
	<div class="post__image"><?php
		$img = get_field('spst_img_svg');
		if($img){
			echo $img;
		}else{
			$img = get_field('spst_img_rastr');
			$img = wp_get_attachment_image_src($img, 'thumbnail_374x222');
			$image_alt = get_post_meta($img, '_wp_attachment_image_alt', true); ?>
			<img src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg') ?>" alt="<?php echo($image_alt ?htmlspecialchars($image_alt) :htmlspecialchars(get_the_title())) ?>"><?php
		} ?>
	</div>
	<div class="post__text">
		<div class="post__header">
			<span class="post__date"><?php echo get_post_time(get_option('date_format'), true, get_the_id()) ?></span>
		</div>
		<a class="post__title" href="<?php the_permalink() ?>">
			<span><?php the_title() ?></span>
		</a>
	</div>
</div>