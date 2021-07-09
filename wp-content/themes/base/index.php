<?php get_header() ?>

<section class="blog__main"><?php
	if(have_posts()){ ?>
		<div class="all-posts"><?php
			while(have_posts()){
				the_post();
				get_template_part('template_part/list_item');
			} ?>
		</div><?php
		get_template_part('template_part/block_pagination');
	}else{
		get_template_part('template_part/not_found');
	} ?>
</section>

<?php get_footer() ?>