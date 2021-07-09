		<?php the_field('nswm_foot_w1_title', 'option') ?>
		<?php wp_nav_menu( array(
				'menu'                 => '',
				'container'            => '',
				'container_class'      => '',
				'container_id'         => '',
				'container_aria_label' => '',
				'menu_class'           => '',
				'menu_id'              => get_field('nswm_foot_w1_menu', 'option'),
				'echo'                 => true,
				'fallback_cb'          => 'wp_page_menu',
				'before'               => '',
				'after'                => '',
				'link_before'          => '',
				'link_after'           => '',
				'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'item_spacing'         => 'preserve',
				'depth'                => 0,
				'walker'               => new CWalker_Menu_Footer(),
				'theme_location'       => 'FooterMenu1',
			)
		) ?>

		<?php the_field('nswm_foot_w2_title', 'option') ?>
		<?php wp_nav_menu( array(
				'menu'                 => '',
				'container'            => '',
				'container_class'      => '',
				'container_id'         => '',
				'container_aria_label' => '',
				'menu_class'           => '',
				'menu_id'              => get_field('nswm_foot_w2_menu', 'option'),
				'echo'                 => true,
				'fallback_cb'          => 'wp_page_menu',
				'before'               => '',
				'after'                => '',
				'link_before'          => '',
				'link_after'           => '',
				'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'item_spacing'         => 'preserve',
				'depth'                => 0,
				'walker'               => new CWalker_Menu_Footer(),
				'theme_location'       => 'FooterMenu2',
			)
		) ?>


		<script>
			var WPThemeURL  = '<?php echo esc_url(get_template_directory_uri()) ?>/';
			var WPajaxURL   = '<?php echo admin_url('admin-ajax.php') ?>';
		</script>
		
		
		<?php if( get_field('wmns_sqookie_yn', 'option') && !isset($_COOKIE['wmns_sqookie_setup']) ){ ?>
			<div id="dialogbox">
				<div>
					<div id="dialogboxbody">
						<?php echo str_replace(array("\r", "\n"), '', apply_filters('the_content',  get_field('wmns_sqookie_content', 'option'))) ?>
					</div>
					<div id="dialogboxfoot">
						<button id="dialogAccept" type="button"><?php _e('Accept', 'base') ?></button>
						<button id="dialogDecline" type="button"><?php _e('Decline', 'base') ?></button>
					</div>
				</div>
			</div>
			<script>
				dialogAccept.onclick = function() {
					dialogbox.style.display = "none";
					document.cookie         = "wmns_sqookie_setup=1; max-age=<?php echo (int)get_field('wmns_sqookie_timesec', 'option') ?>;";
					acceptCookies           = true;
					console.log('Qookie setuping.');
				}
			</script><?php
		} ?>
		
		
		<?php wp_footer() ?>
		
	</body>
</html>