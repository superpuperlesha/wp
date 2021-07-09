<?php get_header() ?>

	<?php while(have_posts()){
		the_post(); ?>
		<section class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1><?php the_title() ?></h1>
				</div>
				<div class="col-sm-12">
					<?php the_content() ?>
				</div>
			</div>
		</section>
	<?php } ?>

<?php get_footer() ?>