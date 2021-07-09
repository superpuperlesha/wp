<?php get_header() ?>

	<?php if(have_posts()){ ?>
		<section>
			<div class="row">
				<?php while(have_posts()){
					the_post(); ?>
					<?php get_template_part('template_part/list_item') ?>
				<?php } ?>
			</div>
			<?php get_template_part('template_part/block_pagination') ?>
		</section>
	<?php }else{ ?>
		<?php get_template_part('template_part/not_found') ?>
	<?php } ?>

<?php get_footer() ?>