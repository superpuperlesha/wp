<?php

function theme_breadcrumbs(){
	/* === ОПЦИИ === */
	$text['home']     = __('Home', 'webmeridian'); // текст ссылки "Главная"
	$text['category'] = '%s'; // текст для страницы рубрики
	$text['search']   = __('Search results for the query "%s"', 'webmeridian'); // текст для страницы с результатами поиска
	$text['tag']      = __('Posts with tag %s', 'webmeridian'); // текст для страницы тега
	$text['author']   = __('Author posts %s', 'webmeridian'); // текст для страницы автора
	$text['404']      = __('ERROR 404', 'webmeridian'); // текст для страницы 404
	$text['page']     = __('Page %s', 'webmeridian'); // текст 'Страница N'
	$text['cpage']    = __('Page comments %s', 'webmeridian'); // текст 'Страница комментариев N'
	
	$wrap_before    = '<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
	$wrap_after     = '</ul>'; // закрывающий тег обертки
	$sep            = ''; // разделитель между "крошками"
	$before         = '<li><span class="breadcrumbs__current">'; // тег перед текущей "крошкой"
	$after          = '</span></li>'; // тег после текущей "крошки"
	
	$show_on_home   = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
	$show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
	$show_current   = 1; // 1 - показывать название текущей страницы, 0 - не показывать
	$show_last_sep  = 1; // 1 - показывать последний разделитель, когда название текущей страницы не отображается, 0 - не показывать
	/* === КОНЕЦ ОПЦИЙ === */
	
	global $post;
	$home_url       = esc_url(home_url('/'));
	$link           = '<li><span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
	$link          .= '<a class="breadcrumbs__link" href="%1$s" itemprop="item"><span itemprop="name">%2$s</span></a>';
	$link          .= '<meta itemprop="position" content="%3$s" />';
	$link          .= '</span></li>';
	$parent_id      = ($post) ?$post->post_parent :'';
	$home_link      = sprintf( $link, $home_url, $text['home'], 1 );
	
	if(get_queried_object_id() == get_option('page_for_posts')){
		echo $wrap_before.$before.$text['home'].$after.$before.__('Blog', 'webmeridian').$after.$wrap_after;
	}
	
	if(is_home() || is_front_page()){
		if ( $show_on_home ) echo $wrap_before . $home_link . $wrap_after;
	}else{
		$position = 0;
		echo $wrap_before;

		if ( $show_home_link ) {
			$position += 1;
			echo $home_link;
		}

		if ( is_category() ) {
			$parents = get_ancestors( get_query_var('cat'), 'category' );
			foreach ( array_reverse( $parents ) as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$cat = get_query_var('cat');
				echo $sep . sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_search() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $show_home_link ) echo $sep;
				echo sprintf( $link, $home_url . '?s=' . get_search_query(), sprintf( $text['search'], get_search_query() ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_current ) {
					if ( $position >= 1 ) echo $sep;
					echo $before . sprintf( $text['search'], get_search_query() ) . $after;
				} elseif ( $show_last_sep ) echo $sep;
			}

		} elseif ( is_year() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_time('Y') . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_month() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('F') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_day() ) {
			if ( $show_home_link ) echo $sep;
			$position += 1;
			echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y'), $position ) . $sep;
			$position += 1;
			echo sprintf( $link, get_month_link( get_the_time('Y'), get_the_time('m') ), get_the_time('F'), $position );
			if ( $show_current ) echo $sep . $before . get_the_time('d') . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$position += 1;
				$post_type = get_post_type_object( get_post_type() );
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->labels->name, $position );
				if ( $show_current ) echo $sep . $before . get_the_title() . $after;
				elseif ( $show_last_sep ) echo $sep;
			} else {
				$cat = get_the_category(); $catID = $cat[0]->cat_ID;
				$parents = get_ancestors( $catID, 'category' );
				$parents = array_reverse( $parents );
				$parents[] = $catID;
				foreach ( $parents as $cat ) {
					$position += 1;
					if ( $position > 1 ) echo $sep;
					echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
				}
				if ( get_query_var( 'cpage' ) ) {
					$position += 1;
					echo $sep . sprintf( $link, get_permalink(), get_the_title(), $position );
					echo $sep . $before . sprintf( $text['cpage'], get_query_var( 'cpage' ) ) . $after;
				} else {
					if ( $show_current ) echo $sep . $before . get_the_title() . $after;
					elseif ( $show_last_sep ) echo $sep;
				}
			}

		} elseif ( is_post_type_archive() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_post_type_archive_link( $post_type->name ), $post_type->label, $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . $post_type->label . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_attachment() ) {
			$parent = get_post( $parent_id );
			$cat = get_the_category( $parent->ID ); $catID = $cat[0]->cat_ID;
			$parents = get_ancestors( $catID, 'category' );
			$parents = array_reverse( $parents );
			$parents[] = $catID;
			foreach ( $parents as $cat ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_category_link( $cat ), get_cat_name( $cat ), $position );
			}
			$position += 1;
			echo $sep . sprintf( $link, get_permalink( $parent ), $parent->post_title, $position );
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_page() && ! $parent_id ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . get_the_title() . $after;
			elseif ( $show_home_link && $show_last_sep ) echo $sep;

		} elseif ( is_page() && $parent_id ) {
			$parents = get_post_ancestors( get_the_ID() );
			foreach ( array_reverse( $parents ) as $pageID ) {
				$position += 1;
				if ( $position > 1 ) echo $sep;
				echo sprintf( $link, get_page_link( $pageID ), get_the_title( $pageID ), $position );
			}
			if ( $show_current ) echo $sep . $before . get_the_title() . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( is_tag() ) {
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				$tagID = get_query_var( 'tag_id' );
				echo $sep . sprintf( $link, get_tag_link( $tagID ), single_tag_title( '', false ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_author() ) {
			$author = get_userdata( get_query_var( 'author' ) );
			if ( get_query_var( 'paged' ) ) {
				$position += 1;
				echo $sep . sprintf( $link, get_author_posts_url( $author->ID ), sprintf( $text['author'], $author->display_name ), $position );
				echo $sep . $before . sprintf( $text['page'], get_query_var( 'paged' ) ) . $after;
			} else {
				if ( $show_home_link && $show_current ) echo $sep;
				if ( $show_current ) echo $before . sprintf( $text['author'], $author->display_name ) . $after;
				elseif ( $show_home_link && $show_last_sep ) echo $sep;
			}

		} elseif ( is_404() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			if ( $show_current ) echo $before . $text['404'] . $after;
			elseif ( $show_last_sep ) echo $sep;

		} elseif ( has_post_format() && ! is_singular() ) {
			if ( $show_home_link && $show_current ) echo $sep;
			echo get_post_format_string( get_post_format() );
		}

		echo $wrap_after;

	}
}


//===getting category list===
// function getTList($arri){
	// $taxonomy = 'category';
	// $post_terms = wp_get_object_terms($arri, $taxonomy, array('fields'=>'ids'));
	// $separator = ', ';
	// if(!empty($post_terms) && !is_wp_error($post_terms)){
		// $term_ids = implode( ',' , $post_terms );
		// $terms = wp_list_categories( array(
			// 'title_li' => '',
			// 'style'    => 'none',
			// 'echo'     => false,
			// 'taxonomy' => $taxonomy,
			// 'include'  => $term_ids
		// ) );
		// return rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
	// }
// }



//===CLEAR STRING && ARRAY===
// function wm_clean_words_array($str){
	// $str = preg_replace('/[^\p{L}\- ]+/', '', $str);
	// $str = preg_replace('/-+/', '-', $str);
	// $str = preg_replace('/ +/', ' ', $str);
	// $str = strtolower($str);
	// $arr = explode(' ', $str);
	// $arr = array_unique($arr);
	// return json_encode($arr);
// }


//===SOCIAL MENU===
function nmssm_list($class=''){
	$res='<ul class="'.$class.'">';
	if(have_rows('social_list', 'option')){
		while(have_rows('social_list', 'option')){
			the_row();
			$res.='<li><a href="'.get_sub_field('social_list_url', 'option').'" target="_blank" rel="nofollow">'.get_sub_field('social_list_svg', 'option').'</a></ll>';
		}
	}
	$res.='</ul>';
	return $res;
}


//===SOCIAL SHARE MENU===
function nmssmshare_list($ulClass='', $pageTitle='', $pageURL='', $imgURL){
	//https://www.business.com/articles/create-share-buttons/
	$res='<ul class="'.$ulClass.'">';
	if(have_rows('socialsh_list', 'option')){
		while(have_rows('socialsh_list', 'option')){
			the_row();
			$pageTitle = urlencode($pageTitle);
			$pageURL   = urlencode($pageURL);
			$imgURL    = urlencode($imgURL);
			$snt = get_sub_field('socialsh_list_url', 'option');
			if($snt=='facebook'){
				$res .='<li>
							<a  href    = "#uID" 
								target  = "_blank" 
								rel     = "nofollow" 
								onClick = "window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]='.$pageTitle.'&amp;p[url]='.$pageURL.'&amp;&p[images][0]='.$imgURL.'\', \'sharer\', \'toolbar=0,status=0,width=548,height=325\');" target="_parent" href="javascript: void(0)">'.get_sub_field('socialsh_list_svg', 'option').'
							</a>
						</ll>';
			}elseif($snt=='twitter'){
				$res .='<li>
							<a  href    = "#uID" 
								target  = "_blank" 
								rel     = "nofollow" 
								onClick = "window.open(\'http://twitter.com/home?status=Currentlyreading '.$pageURL.'\', \'sharer\', \'toolbar=0,status=0,width=548,height=325\');" target="_parent" href="javascript: void(0)">'.get_sub_field('socialsh_list_svg', 'option').'
							</a>
						</ll>';
			}elseif($snt=='linkedin'){
				$res .='<li>
							<a  href    = "#uID" 
								target  = "_blank" 
								rel     = "nofollow" 
								onClick = "window.open(\'http://www.linkedin.com/shareArticle?mini=true&url='.$pageURL.'&title=$pageTitle&source='.$pageURL.'\', \'sharer\', \'toolbar=0,status=0,width=548,height=325\');" target="_parent" href="javascript: void(0)">'.get_sub_field('socialsh_list_svg', 'option').'
							</a>
						</ll>';
			}else{
				
			}
		}
	}
	$res.='</ul>';
	return $res;
}


//==Page Navigation===
function page_navicx($before = '', $after = ''){
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }
	
    echo $before.'<ul class="pagination pagination-sm">';
    if($paged > 1){
        echo '<li class="page-item prev 111">
				<a class="page-link" href="'.get_pagenum_link($paged-1).'">
					<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.427139 9.64095L9.682 0.407104C9.95719 0.142677 10.326 -0.00353527 10.7088 6.49439e-05C11.0916 0.00366516 11.4576 0.156788 11.7277 0.426344C11.9978 0.695899 12.1503 1.06024 12.1523 1.44063C12.1543 1.82102 12.0055 2.1869 11.7383 2.45922L4.96575 9.21551H30.54C30.9272 9.21551 31.2986 9.36836 31.5724 9.64044C31.8462 9.91253 32 10.2815 32 10.6663C32 11.0511 31.8462 11.4201 31.5724 11.6922C31.2986 11.9643 30.9272 12.1171 30.54 12.1171H4.96575L11.7383 18.8741C12.0055 19.1464 12.1543 19.5123 12.1523 19.8927C12.1503 20.2731 11.9978 20.6374 11.7277 20.907C11.4576 21.1765 11.0916 21.3297 10.7088 21.3333C10.326 21.3369 9.95719 21.1907 9.682 20.9262L0.425095 11.6931C0.152452 11.4202 -0.00038147 11.0511 0 10.6666C0.000383377 10.282 0.153954 9.9133 0.427139 9.64095Z" fill="#F26322"/>
					</svg>'.__('Prev', 'webmeridian').'</a>
			  </li>';
    }
	
    if(get_previous_posts_link()){
		// echo '<li class="page-item 222">
				// <a class="page-link btn btn-slick btn-prev" href="'.get_previous_posts_page_link().'">1</a>
			  // </li>'; 
	}else{
		echo '<li class="page-item disabled 333">
				<a class="page-link btn btn-slick btn-prev" href="#uID"><svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.427139 9.64095L9.682 0.407104C9.95719 0.142677 10.326 -0.00353527 10.7088 6.49439e-05C11.0916 0.00366516 11.4576 0.156788 11.7277 0.426344C11.9978 0.695899 12.1503 1.06024 12.1523 1.44063C12.1543 1.82102 12.0055 2.1869 11.7383 2.45922L4.96575 9.21551H30.54C30.9272 9.21551 31.2986 9.36836 31.5724 9.64044C31.8462 9.91253 32 10.2815 32 10.6663C32 11.0511 31.8462 11.4201 31.5724 11.6922C31.2986 11.9643 30.9272 12.1171 30.54 12.1171H4.96575L11.7383 18.8741C12.0055 19.1464 12.1543 19.5123 12.1523 19.8927C12.1503 20.2731 11.9978 20.6374 11.7277 20.907C11.4576 21.1765 11.0916 21.3297 10.7088 21.3333C10.326 21.3369 9.95719 21.1907 9.682 20.9262L0.425095 11.6931C0.152452 11.4202 -0.00038147 11.0511 0 10.6666C0.000383377 10.282 0.153954 9.9133 0.427139 9.64095Z" fill="#F26322"/>
					</svg>'.__('Prev', 'webmeridian').'</a>
			  </li>';
	}
     
    for($i = $start_page; $i <= $end_page; $i++){
        if($i == $paged){
            echo '<li class="page-item active">
					<a class="page-link" href="#uID">'.$i.'</a>
				  </li>';
        }else{
            echo '<li class="page-item">
					<a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a>
				  </li>';
        }
    }
	
    if(get_next_posts_link()){
		// echo '<li class="page-item">
				// <a class="page-link btn btn-slick btn-next" href="'.get_next_posts_page_link().'"></a>
			// </li>';
	}else{
		echo '<li class="page-item disabled">
				<a class="page-link btn btn-slick btn-next" href="#uID">
					'.__('Next', 'webmeridian').'
					<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M31.5729 9.64095L22.318 0.407104C22.0428 0.142677 21.674 -0.00353527 21.2912 6.49439e-05C20.9084 0.00366516 20.5424 0.156788 20.2723 0.426344C20.0022 0.695899 19.8497 1.06024 19.8477 1.44063C19.8457 1.82102 19.9945 2.1869 20.2617 2.45922L27.0343 9.21551H1.46C1.07279 9.21551 0.70143 9.36836 0.427626 9.64044C0.153822 9.91253 0 10.2815 0 10.6663C0 11.0511 0.153822 11.4201 0.427626 11.6922C0.70143 11.9643 1.07279 12.1171 1.46 12.1171H27.0343L20.2617 18.8741C19.9945 19.1464 19.8457 19.5123 19.8477 19.8927C19.8497 20.2731 20.0022 20.6374 20.2723 20.907C20.5424 21.1765 20.9084 21.3297 21.2912 21.3333C21.674 21.3369 22.0428 21.1907 22.318 20.9262L31.5749 11.6931C31.8475 11.4202 32.0004 11.0511 32 10.6666C31.9996 10.282 31.846 9.9133 31.5729 9.64095Z"/>
					</svg>
				</a>
			  </li>';
	}
	
    if($end_page < $max_page) {
        echo'<li class="page-item next">
				<a class="page-link" href="'.get_pagenum_link($paged+1).'">
					'.__('Next', 'webmeridian').'
					<svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M31.5729 9.64095L22.318 0.407104C22.0428 0.142677 21.674 -0.00353527 21.2912 6.49439e-05C20.9084 0.00366516 20.5424 0.156788 20.2723 0.426344C20.0022 0.695899 19.8497 1.06024 19.8477 1.44063C19.8457 1.82102 19.9945 2.1869 20.2617 2.45922L27.0343 9.21551H1.46C1.07279 9.21551 0.70143 9.36836 0.427626 9.64044C0.153822 9.91253 0 10.2815 0 10.6663C0 11.0511 0.153822 11.4201 0.427626 11.6922C0.70143 11.9643 1.07279 12.1171 1.46 12.1171H27.0343L20.2617 18.8741C19.9945 19.1464 19.8457 19.5123 19.8477 19.8927C19.8497 20.2731 20.0022 20.6374 20.2723 20.907C20.5424 21.1765 20.9084 21.3297 21.2912 21.3333C21.674 21.3369 22.0428 21.1907 22.318 20.9262L31.5749 11.6931C31.8475 11.4202 32.0004 11.0511 32 10.6666C31.9996 10.282 31.846 9.9133 31.5729 9.64095Z" fill="#F26322"/>
					</svg>
				</a>
			</li>';
    }
    echo '</ul>'.$after;
}


//sitePaging(get_page_link(get_queried_object_id()).'/?'.(isset($_GET['read']) ?'read=1' :'unread=1'), count($posts), $pg, $ppg)
//===custom paging===
function sitePaging($baseURL, $numposts, $paged, $postonpage){
	$res = '';
    $posts_per_page = $postonpage;//get_option('posts_per_page');
    $paged    = (int)$paged;
    $numposts = (int)$numposts;
    $max_page = ceil($numposts / $postonpage);;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 7;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }
	
    $res .= '<div class="row mt-3">
					<div class="col-md-12">
						<nav class="nav text-center">
    						<ul class="pagination pagination-sm">';
    if($paged > 1){
        $res .= '<li class="page-item prev">
					<a class="page-link" href="'.$baseURL.'&pg='.($paged-1).'">'.__('Prev', 'webmeridian').'</a>
				 </li>';
    }
	
    if(1==1){
		// echo '<li class="page-item 222">
				// <a class="page-link btn btn-slick btn-prev" href="'.get_previous_posts_page_link().'">1</a>
			  // </li>'; 
	}else{
		$res .= '<li class="page-item disabled">
					<a class="page-link btn btn-slick btn-prev" href="#uID">'.__('Prev', 'webmeridian').'</a>
				 </li>';
	}
     
    for($i = $start_page; $i <= $end_page; $i++){
        if($i == $paged){
            $res .= '<li class="page-item active">
						<a class="page-link" href="#uID">'.$i.'</a>
					 </li>';
        }else{
            $res .=  '<li class="page-item">
						<a class="page-link" href="'.$baseURL.'&pg='.$i.'">'.$i.'</a>
					  </li>';
        }
    }
	
    if(1==1){
		// echo '<li class="page-item">
				// <a class="page-link btn btn-slick btn-next" href="'.get_next_posts_page_link().'"></a>
			// </li>';
	}else{
		$res .=  '<li class="page-item disabled">
					<a class="page-link btn btn-slick btn-next" href="#uID">'.__('Next', 'webmeridian').'</a>
				  </li>';
	}
	
    if($end_page < $max_page) {
        $res .= '<li class="page-item next">
					<a class="page-link" href="'.$baseURL.'&pg='.($paged+1).'">'.__('Next', 'webmeridian').'</a>
				 </li>';
    }
    $res .= 		'</ul>
    			</nav>
			</div>
		</div>';
    return $res;
}



add_action( 'after_setup_theme', 'wpse_theme_setup' );
function wpse_theme_setup() {
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
}



//===site mail===
// function siteMail($to, $message, $file=[]){
	// $subject = __('Message from site.', 'base');
	// $headers = array(
		// 'from: '.htmlspecialchars(get_bloginfo('name')).' <'.get_bloginfo('admin_email').'>',
		// 'content-type: text/html',
	// );
	// return wp_mail($to, $subject, $message, $headers, $file);
// }


//===self url===
// function getSelfURL(){
	// return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?"https" : "http")."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// }

//===home url===
// function getHomeURL(){
	// return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?"https" : "http")."://".$_SERVER['HTTP_HOST'];
// }



