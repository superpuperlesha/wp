<?php get_header() ?>

<section class="blog__main">
    <div class="all-posts"><?php
		if(have_posts()){
			while(have_posts()){
				the_post();
				get_template_part('template_part/list_item');
			}
			get_template_part('template_part/block_pagination');
		}else{
			get_template_part('template_part/not_found');
		} ?>
    </div>
</section>

<?php get_footer() ?>