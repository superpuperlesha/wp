<?php $sq = get_search_query() ? get_search_query() : __( 'Enter word for search', 'base' ); ?>
<form method="get" class="search-form" action="<?php echo esc_url(home_url()); ?>" >
	<fieldset>
		<div class="form-group">
			<input type="search" name="s" placeholder="<?php echo $sq; ?>" value="<?php echo get_search_query(); ?>" class="form-control" />
		</div>
		<div class="form-group">
			<input type="submit" value="<?php _e( 'Search', 'base' ); ?>" class="btn btn-success" />
		</div>
	</fieldset>
</form>