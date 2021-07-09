<?php

//===Menu Walker MAIN MENU===
class CWalker_Menu_Main extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= '<ul class="menu_sub">';
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= '</ul>';
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="'.esc_attr($class_names).'" ';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li '.$id.$value.$class_names.'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) . '"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
		
		$item_output  = $args->before;
		$item_output .= '<a '.$attributes.'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}


//===Menu Walker FLOAT MENU===
class CWalker_Menu_Float extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= '<ul class="menu_sub">';
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= '</ul>';
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="'.esc_attr($class_names).'" ';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li '.$id.$value.$class_names.'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) . '"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
		
		$item_output  = $args->before;
		$item_output .= '<a '.$attributes.'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}



//===Menu Walker FOOTER MENU===
class CWalker_Menu_Footer extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= '<ul class="menu_sub">';
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= '</ul>';
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="'.esc_attr($class_names).'" ';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li '.$id.$value.$class_names.'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) . '"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) . '"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) . '"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a '.$attributes.'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}


/*
Plugin Name: WP SVG images
Plugin URI: https://kubiq.sk
Description: Full SVG Media support in WordPress
Author: KubiQ
Version: 3.2
Author URI: https://kubiq.sk
*/
class WPSVG{
	function __construct(){
		add_action( 'admin_init',                      array( $this, 'add_svg_support' ) );
		add_action( 'admin_footer',                    array( $this, 'fix_svg_thumbnail_size' ) );
		add_filter( 'upload_mimes',                    array( $this, 'add_svg_mime' ) );
		add_filter( 'wp_check_filetype_and_ext',       array( $this, 'wp_check_filetype_and_ext' ), 100, 4 );
		add_filter( 'wp_generate_attachment_metadata', array( $this, 'wp_generate_attachment_metadata' ), 10, 2 );
		add_filter( 'fl_module_upload_regex',          array( $this, 'fl_module_upload_regex' ), 10, 4 );
	}

	function fl_module_upload_regex( $regex, $type, $ext, $file ){
		if( $ext == "svg" || $ext == "svgz" ){
			$regex['photo'] = str_replace( '|png|', '|png|svgz?|', $regex['photo'] );
		}
		return $regex;
	}

	function fix_svg_thumbnail_size(){
		echo '<style>.attachment-info .thumbnail img[src$=".svg"],#postimagediv .inside img[src$=".svg"]{width:100%}</style>';
	}

	function wp_generate_attachment_metadata( $metadata, $attachment_id ){
		if( get_post_mime_type( $attachment_id ) == 'image/svg+xml' ){
			$svg_path = get_attached_file( $attachment_id );
			$dimensions = $this->svg_dimensions( $svg_path );
			$metadata['width'] = $dimensions->width;
			$metadata['height'] = $dimensions->height;
		}
		return $metadata;
	}

	function wp_check_filetype_and_ext( $filetype_ext_data, $file, $filename, $mimes ){
		if( substr( $filename, -4 ) == '.svg' ){
			$filetype_ext_data['ext'] = 'svg';
			$filetype_ext_data['type'] = 'image/svg+xml';
		}
		if( substr( $filename, -5 ) == '.svgz' ){
			$filetype_ext_data['ext'] = 'svgz';
			$filetype_ext_data['type'] = 'image/svg+xml';
		}
		return $filetype_ext_data;
	}

	public function add_svg_support(){

		function svg_thumbs( $content ){
			return apply_filters( 'final_output', $content );
		}

		ob_start( 'svg_thumbs' );

		add_filter( 'final_output', array( $this, 'final_output' ) );
		add_filter( 'wp_prepare_attachment_for_js', array( $this, 'wp_prepare_attachment_for_js' ), 10, 3 );
	}

	function final_output( $content ){
		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<img class="details-image" src="{{ data.url }}" draggable="false" />
			<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
			$content
		);

		$content = str_replace(
			'<# } else if ( \'image\' === data.type && data.sizes ) { #>',
			'<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<div class="centered">
					<img src="{{ data.url }}" class="thumbnail" draggable="false" />
				</div>
			<# } else if ( \'image\' === data.type && data.sizes ) { #>',
			$content
		);

		return $content;
	}

	public function add_svg_mime( $mimes = array() ){
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}

	function wp_prepare_attachment_for_js( $response, $attachment, $meta ){
		if( $response['mime'] == 'image/svg+xml' && empty( $response['sizes'] ) ){
			$svg_path = get_attached_file( $attachment->ID );
			if( ! file_exists( $svg_path ) ){
				$svg_path = $response['url'];
			}
			$dimensions = $this->svg_dimensions( $svg_path );
			$response['sizes'] = array(
				'full' => array(
					'url' => $response['url'],
					'width' => $dimensions->width,
					'height' => $dimensions->height,
					'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait'
				)
			);
		}
		return $response;
	}

	function svg_dimensions( $svg ){
		$svg = simplexml_load_file( $svg );
		$width = 0;
		$height = 0;
		if( $svg ){
			$attributes = $svg->attributes();
			if( isset( $attributes->width, $attributes->height ) ){
				$width = floatval( $attributes->width );
				$height = floatval( $attributes->height );
			}elseif( isset( $attributes->viewBox ) ){
				$sizes = explode( " ", $attributes->viewBox );
				if( isset( $sizes[2], $sizes[3] ) ){
					$width = floatval( $sizes[2] );
					$height = floatval( $sizes[3] );
				}
			}
		}
		return (object)array( 'width' => $width, 'height' => $height );
	}
}
new WPSVG();
