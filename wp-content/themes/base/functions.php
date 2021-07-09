<?php

// Disable actions in core
include( get_template_directory() . '/inc/functions_disables.php' );

// Default settings
include( get_template_directory() . '/inc/default.php' );

// Theme functions
include( get_template_directory() . '/inc/functions_theme.php' );

// Custom Post Types
include( get_template_directory() . '/inc/cpt.php' );

// Custom Menu Walker
include( get_template_directory() . '/inc/classes.php' );

// Theme thumbnails
include( get_template_directory() . '/inc/thumbnails.php' );

// Theme menus
include( get_template_directory() . '/inc/menus.php' );

// Theme css & js
include( get_template_directory() . '/inc/scripts.php' );

// Theme JAX
include( get_template_directory() . '/inc/ajax.php' );

// Theme Customizer
include( get_template_directory() . '/inc/functions_customizer.php' );

// Theme SPEED OPTIMIZATION
include( get_template_directory() . '/inc/functions_optimization.php' );

// Theme Authorize
//include( get_template_directory() . '/inc/functions_auth.php' );

// Admin functions
//include( get_template_directory() . '/inc/functions_admin.php' );

// PayPal functions
//include( get_template_directory() . '/inc/functions_paypal.php' );

// woocommerce functions
include( get_template_directory() . '/inc/functions_woo.php' );

// fix image orientation after uploading
//include( get_template_directory() . '/inc/fix-image-orientation.php' );




