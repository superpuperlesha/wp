<?php

/**
 * Register a custom post type called "Services".
 *
 * @see get_post_type_labels() for label keys.
 */
// function wpdocs_codex_ourservices_init() {
    // $labels = array(
        // 'name'                  => _x( 'Services', 'Post type general name', 'base' ),
        // 'singular_name'         => _x( 'Services', 'Post type singular name', 'base' ),
        // 'menu_name'             => _x( 'Services', 'Admin Menu text', 'base' ),
        // 'name_admin_bar'        => _x( 'Services', 'Add New on Toolbar', 'base' ),
        // 'add_new'               => __( 'Add New', 'base' ),
        // 'add_new_item'          => __( 'Add New', 'base' ),
        // 'new_item'              => __( 'New Services', 'base' ),
        // 'edit_item'             => __( 'Edit Services', 'base' ),
        // 'view_item'             => __( 'View Services', 'base' ),
        // 'all_items'             => __( 'All Services', 'base' ),
        // 'search_items'          => __( 'Search Services', 'base' ),
        // 'parent_item_colon'     => __( 'Parent Services:', 'base' ),
        // 'not_found'             => __( 'No Services found.', 'base' ),
        // 'not_found_in_trash'    => __( 'No Services found in Trash.', 'base' ),
        // 'featured_image'        => _x( 'Cover image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'base' ),
        // 'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'base' ),
        // 'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'base' ),
        // 'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'base' ),
        // 'archives'              => _x( 'Services archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'base' ),
        // 'insert_into_item'      => _x( 'Insert into Services', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'base' ),
        // 'uploaded_to_this_item' => _x( 'Uploaded to this Services', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'base' ),
        // 'filter_items_list'     => _x( 'Filter Services list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'base' ),
        // 'items_list_navigation' => _x( 'Services list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'base' ),
        // 'items_list'            => _x( 'Services list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'base' ),
    // );
	
	// $args = array(
        // 'labels'             => $labels,
        // 'description'        => 'Services custom post type.',
        // 'public'             => true,
        // 'publicly_queryable' => true,
        // 'show_ui'            => true,
        // 'show_in_menu'       => false,
        // 'query_var'          => true,
        // 'rewrite'            => array( 'slug'=>'services' ), //ourservices
        // 'capability_type'    => 'post',
        // 'has_archive'        => false,
        // 'hierarchical'       => false,
        // 'menu_position'      => 20,
        // 'supports'           => array( 'title', 'editor', 'thumbnail' ), //, 'excerpt', 'comments', 'author',
        // 'taxonomies'         => array(),
        // 'show_in_rest'       => true
    // );
    // register_post_type( 'ourservices', $args );
	
	// $labels = array(
		// 'name'                       => _x( 'Service Category', 'Category General Name', 'base' ),
		// 'singular_name'              => _x( 'Service Category', 'Service Category Singular Name', 'base' ),
		// 'menu_name'                  => __( 'Service Category', 'base' ),
		// 'all_items'                  => __( 'All Items', 'base' ),
		// 'parent_item'                => __( 'Parent Item', 'base' ),
		// 'parent_item_colon'          => __( 'Parent Item:', 'base' ),
		// 'new_item_name'              => __( 'New Item Name', 'base' ),
		// 'add_new_item'               => __( 'Add New Item', 'base' ),
		// 'edit_item'                  => __( 'Edit Item', 'base' ),
		// 'update_item'                => __( 'Update Item', 'base' ),
		// 'view_item'                  => __( 'View Item', 'base' ),
		// 'separate_items_with_commas' => __( 'Separate items with commas', 'base' ),
		// 'add_or_remove_items'        => __( 'Add or remove items', 'base' ),
		// 'choose_from_most_used'      => __( 'Choose from the most used', 'base' ),
		// 'popular_items'              => __( 'Popular Items', 'base' ),
		// 'search_items'               => __( 'Search Items', 'base' ),
		// 'not_found'                  => __( 'Not Found', 'base' ),
		// 'no_terms'                   => __( 'No items', 'base' ),
		// 'items_list'                 => __( 'Items list', 'base' ),
		// 'items_list_navigation'      => __( 'Items list navigation', 'base' ),
	// );
	// $args = array(
		// 'labels'                     => $labels,
		// 'hierarchical'               => false,
		// 'public'                     => true,
		// 'show_ui'                    => true,
		// 'show_admin_column'          => true,
		// 'show_in_nav_menus'          => true,
		// 'show_tagcloud'              => true,
		// 'show_in_menu'               => true,
		// 'rewrite'                    => array('slug'=>'servcat', 'with_front'=>true),
	// );
	// register_taxonomy('servcat', array('ourservices'), $args);
	
// }
// add_action( 'init', 'wpdocs_codex_ourservices_init' );


