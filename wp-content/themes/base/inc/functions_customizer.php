<?php

//===admin POST column adding thumbnail===
function ST4_columns_headp($columns){
	//unset($columns['categories']);
	$my_columns = ['ft_img' => __('Image', 'base'),];
	return array_slice($columns, 0, 1) + $my_columns + $columns;
};
function ST4_columns_contentp($column_name, $post_ID){
	if($column_name == 'ft_img'){
		/*$img = get_field('spst_img_svg', $post_ID);
		if($img){
			echo '<div class="">'.$img.'</div>';
		}else{
			$img = get_field('spst_img_rastr', $post_ID);
			$img = wp_get_attachment_image_src($img, 'thumbnail_200x130');
			$image_alt = get_post_meta($img, '_wp_attachment_image_alt', true); ?>
			<img src="<?php echo(isset($img[0]) ?$img[0] :esc_url(get_template_directory_uri()).'/img/noimage.jpg') ?>" alt="thumb" width="100"><?php
		}*/
	}
}
add_filter('manage_post_posts_columns', 'ST4_columns_headp');
add_action('manage_post_posts_custom_column', 'ST4_columns_contentp', 10, 2);


//===small margin admin tables===
add_action('admin_head', 'insert_header_wpse_51023');
function insert_header_wpse_51023(){
	echo'<style>
			.form-table td, .form-table th{
				padding: 3px 10px 3px 0;
			}
			.qtranxs-lang-switch {
				cursor: pointer;
			}
			.qtranxs-lang-switch-wrap li.qtranxs-lang-switch.active, .qtranxs-lang-switch-wrap li.qtranxs-lang-switch.active:focus, .qtranxs-lang-switch-wrap li.qtranxs-lang-switch.active:hover {
				background-color: #ffffff;
			}
			.column-ft_img svg{
				max-width: 300px;
				max-height: 300px;
			}
		</style>';
}


//===ADD customizer field (WP-SETTINGS-DEFAULT)===
// function mytheme_customize_register( $wp_customize ) {
    // $wp_customize->add_section( 'mytheme_company_section' , array(
        // 'title'      => __( 'Additional Company Info', 'mytheme' ),
        // 'priority'   => 30,
    // ));

    // $wp_customize->add_setting('mytheme_company', array());
    // $wp_customize->add_control(new WP_Customize_Control(
        // $wp_customize,
        // 'mytheme_company_control',
            // array(
                // 'label'      => __( 'Company Name', 'mytheme' ),
                // 'section'    => 'mytheme_company_section',
                // 'settings'   => 'mytheme_company-name',
                // 'priority'   => 1
            // )
        // )
    // );
	
// }
// add_action('customize_register', 'mytheme_customize_register');


//===ACF QTANSLATE admin styles===
// add_action('admin_head', 'my_custom_fonts');
// function my_custom_fonts(){
	// echo'<style>
		// .multi-language-field{
			// margin-top: -20px;
		// }
	// </style>';
// }

