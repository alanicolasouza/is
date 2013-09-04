<?php

/**
 * Helpers para o WP
 *
 *
 * @package		is
 * @author		Alan Nicolas Souza - alan@interative.cc
 * @since		Version 1.0
 */

Class Helpers_wp {

	function __construct()
	{
		
	}
	
	public function filters_wp()
	{
		//Adicionando classe com o nome do navegador e versao a tag body
		add_filter('body_class', array(&$this, 'browser_body_class') );
	}
	
	public function browser_body_class( $classes )
	{
		$browser = $_SERVER[ 'HTTP_USER_AGENT' ];
	
		// Mac, PC ...ou Linux
		if ( preg_match( "/Mac/", $browser ) ){
			$classes[] = 'mac';
	
		} elseif ( preg_match( "/Windows/", $browser ) ){
			$classes[] = 'windows';
	
		} elseif ( preg_match( "/Linux/", $browser ) ) {
			$classes[] = 'linux';
	
		} else {
			$classes[] = 'unknown-os';
		}
	
	
		// Checa na seguinte ordem: Chrome, Safari, Opera, MSIE, FF
		if ( preg_match( "/Chrome/", $browser ) ) {
			$classes[] = 'chrome';
	
			preg_match( "/Chrome\/(\d.\d)/si", $browser, $matches);
			$classesh_version = 'ch' . str_replace( '.', '-', $matches[1] );
			$classes[] = $classesh_version;
	
		} elseif ( preg_match( "/Safari/", $browser ) ) {
			$classes[] = 'safari';
	
			preg_match( "/Version\/(\d.\d)/si", $browser, $matches);
			$sf_version = 'sf' . str_replace( '.', '-', $matches[1] );
			$classes[] = $sf_version;
	
		} elseif ( preg_match( "/Opera/", $browser ) ) {
			$classes[] = 'opera';
	
			preg_match( "/Opera\/(\d.\d)/si", $browser, $matches);
			$op_version = 'op' . str_replace( '.', '-', $matches[1] );
			$classes[] = $op_version;
	
		} elseif ( preg_match( "/MSIE/", $browser ) ) {
			$classes[] = 'msie';
	
			if( preg_match( "/MSIE 6.0/", $browser ) ) {
				$classes[] = 'ie6';
			} elseif ( preg_match( "/MSIE 7.0/", $browser ) ){
				$classes[] = 'ie7';
			} elseif ( preg_match( "/MSIE 8.0/", $browser ) ){
				$classes[] = 'ie8';
			} elseif ( preg_match( "/MSIE 9.0/", $browser ) ){
				$classes[] = 'ie9';
			}
	
		} elseif ( preg_match( "/Firefox/", $browser ) && preg_match( "/Gecko/", $browser ) ) {
			$classes[] = 'gecko';
	
			preg_match( "/Firefox\/(\d)/si", $browser, $matches);
			$ff_version = 'ff' . str_replace( '.', '-', $matches[1] );
			$classes[] = $ff_version;
	
		} else {
			$classes[] = 'unknown';
		}
	
		return $classes;
	}
	
	
	/**
	 * Cria Resumo
	 * @version 1.0
	 *
	 * @param String $get
	 * @param Integer $limite
	 *  
	 * @return String $var_view
	 */
	function resumo($get, $limite)
	{
		$var_db = strip_tags($get);
		$var_view = substr($var_db, 0,$limite);
		$_n = strlen($var_db);
		($_n > $limite) ? $var_view = $var_view."..." : $var_view;
		
		echo $var_view;
	}
	
	
	
	/**
	 * Retorna o ID pelo post_name
	 * @version 1.0
	 *
	 * @param String $post_name
	 *  
	 * @return Integer id
	 */
	function get_id_by_post_name($post_name)
	{
		global $wpdb;
		$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$post_name."'");
		
		return $id;
	}
	
	/**
	 * Customiza Queries WP
	 * 
	 * Modo de imprimir:
	 * 
	 * global $wp_query;
	 * echo $wp_query->query_vars['variavel'];
	 * 
	 * @version 1.0
	 *
	 * @param Array $qvars
	 *  
	 * @return Array $query_vars
	 */
	function customquery_vars( $qvars )
	{
		if( is_array( $qvars ) ){
			foreach ( $qvars as $qvar){
				$query_vars[] = $qvar;
			}
		} else {
			$query_vars[] = $qvars;
		}
		
		
		return $query_vars;
	}
	
	function add_query_vars()
	{
		add_filter('query_vars', 'customquery_vars' );
	}
	
	
	/**
	 * Retorna o ID pelo post_name
	 * @version 1.0
	 *
	 * @param String $term
	 *  
	 * @return Array
	 */
	public function get_terms_join( $id, $taxonomy )
	{
		
		$terms = get_the_terms( $id, $taxonomy );
		
		if ( $terms && ! is_wp_error( $terms ) ) :
		
			$dados = array();
		
			foreach ( $terms as $term ) {

				$dados[] = $term->name;
			}
		
			$on_dados = join( ", ", $dados );

		endif;
		
		return $on_dados;
	}
	
	/**
	 * Retorna as metas em objeto
	 * 
	 * @version 1.0
	 * 
	 * @param Integer $id
	 * @param String $meta
	 *  
	 * @return Object
	 */
	public function get_metas( $id, $meta )
	{
		$data = get_post_meta( $id, WORDWEBPRESS_APP_NAME . $meta);
		return  (object) unserialize( base64_decode( $data[0] ) );
	}

	/**
	 * Retorna a imagem redimencionada e recortada
	 * 
	 * $size = width, height
	 * 
	 * $crop = 
	 * 
	 * c : position in the center (this is the default)
	 * t : align top
	 * tr : align top right
	 * tl : align top left
	 * b : align bottom
	 * br : align bottom right
	 * bl : align bottom left
	 * l : align left
	 * r : align right
	 *
	 * $zn ( Zoom & Crop ) = 
	 * 
	 * 0	Resize to Fit specified dimensions (no cropping)	
	 * 1	Crop and resize to best fit the dimensions (default)
	 * 2	Resize proportionally to fit entire image into specified dimensions, and add borders if required
	 * 3	Resize proportionally adjusting size of scaled image so there are no borders gaps
	 * 
	 * @version 1.0
	 *
	 * @param Integer 	$id
	 * @param Array  	$size 
	 * @param String  	$crop
	 * @param Integer  	$zc
	 *  
	 * @return Object
	 */
	public function get_image( $id, $size = array(), $crop = 't', $zc = 1 )
	{
		$src = wp_get_attachment_url( get_post_thumbnail_id( $id ) );
		
		if( !empty($src) )
			return  '<img src="'. get_bloginfo('template_directory') .'/is/images/resize.php?src='.$src.'&w='.$size[0].'&h='.$size[1].'&q=75&a='.$crop.'&zc='.$zc.'" title="'.get_bloginfo('name'). ' - ' .get_the_title($id).'" alt="'.get_bloginfo('name'). ' - '.get_the_title($id).'" />';
		else
			return '';
	}
	
	/**
	 * Imprime o Breadcump
	 *
	 * @version 0.1
	 *
	 * @param Integer $id
	 *  
	 * @return String
	 */
	public function breadcrumb( $id = null ){
		 
	
		//text link for the 'Home' page
		$main = 'Página Inicial';
		//Display only the first 30 characters of the post title.
		$maxLength= 30;
		 
		//variable for archived year
		$arc_year = get_the_time('Y');
		//variable for archived month
		$arc_month = get_the_time('F');
		//variables for archived day number + full
		$arc_day = get_the_time('d');
		$arc_day_full = get_the_time('l');
		 
		//variable for the URL for the Year
		$url_year = get_year_link($arc_year);
		//variable for the URL for the Month
		$url_month = get_month_link($arc_year,$arc_month);
	
		 
		if (!is_front_page()) {
	
			echo '<div id="breadcrumb"><ul id="breadcrumbList">';
	
			global $post, $cat, $wp_query;
	
			//Single
			if ( isset( $_GET['post_type'] )  )
			{
				$post_type = get_post_type_object( $_GET['post_type'] );
				echo '<li><a href="'.get_bloginfo('url') . '/?post_type=' . $post_type->query_var .'">' . $post_type->label . '</a></li>';
				
			} elseif ( is_single() ) {
		   
				$category = get_the_category();
	
				if( empty( $category ) )
				{
	
					$post_type = get_post_type_object( get_post_type( $id ) );
					
					if( $post_type ){
						echo '<li><a href="'.get_bloginfo('url') . '/?post_type=' . $post_type->query_var .'">' . $post_type->label . '</a></li>';
					}
						
					// Se houver taxonomies
					if( !empty( $post_type->taxonomies  ) ){
						
						
						foreach( $post_type->taxonomies as  $taxonomy ){
						
							$terms = get_the_terms( $id, $taxonomy);
						
							if( !empty(  $terms ) )
							{
						
								if( !empty( $term->parent )){
									// Create a list of all the term's parents
									$parent = $term->parent;
										
									while ($parent):
									$parents[] = $parent;
									$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
									$parent = $new_parent->parent;
									endwhile;
										
									if( !empty($parents) ):
									$parents = array_reverse($parents);
										
									// For each parent, create a breadcrumb item
									foreach ($parents as $parent):
									$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
									$url = get_bloginfo('url').'/?'.$item->taxonomy.'='.$item->slug;
									echo '<li><a href="'.$url.'">'.$item->name.'</a></li>';
									endforeach;
									endif;
								}
						
								foreach ($terms as $term)
									echo '<li><a href="'.get_bloginfo('url') . '/?' .$term->taxonomy.'='.$term->slug .'">' . $term->name . '</a></li>';
							}
						}
						
					}

					echo '<li><a>' . get_the_title() . '</a></li>';
				}
	
				//then the post is listed in more than 1 category.
				else {
					//Put bullets between categories, since they are at the same level in the hierarchy.
					echo the_category( '', multiple);
						
					echo ' ' .  get_the_title();
					 
				}
			} elseif( is_tax() ){
	
				$term = get_queried_object();
	
				if( !empty( $term->parent )){
					// Create a list of all the term's parents
					$parent = $term->parent;
						
					while ($parent):
					$parents[] = $parent;
					$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
					$parent = $new_parent->parent;
					endwhile;
						
					if( !empty($parents) ):
					$parents = array_reverse($parents);
	
					// For each parent, create a breadcrumb item
					foreach ($parents as $parent):
					$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
					$url = get_bloginfo('url').'/?'.$item->taxonomy.'='.$item->slug;
					echo '<li><a href="'.$url.'">'.$item->name.'</a></li>';
					endforeach;
					endif;
				}
	
	
				echo '<li><a href="'.get_bloginfo('url') . '/?' .$term->taxonomy.'='.$term->slug .'">' . $term->name . '</a></li>';
	
	
			} elseif (is_category()) { //Check if Category archive page is being displayed.
				//returns the category title for the current page.
				//If it is a subcategory, it will display the full path to the subcategory.
				//Returns the parent categories of the current category with links separated by '»'
				echo 'Archive Category: "' . get_category_parents($cat, true,' ' .  ' ') . '"' ;
			}
			//Display breadcrumb for tag archive
			elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
				//returns the current tag title for the current page.
				echo 'Posts Tagged: "' . single_tag_title("", false) . '"';
			}
			//Display breadcrumb for calendar (day, month, year) archive
			elseif ( is_day()) { //Check if the page is a date (day) based archive page.
				echo '<li><a href="' . $url_year . '">' . $arc_year . '</a></li> ';
				echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' .  $arc_day . ' (' . $arc_day_full . ')';
			}
			elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
				echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' .  $arc_month;
			}
			elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
				echo $arc_year;
			}
			//Display breadcrumb for search result page
			elseif ( is_search() ) {  //Check if search result page archive is being displayed.
				echo '<li><a>Procurando por: ' . get_search_query() . '</a><li>';
			}
			//Display breadcrumb for top-level pages (top-level menu)
			elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
				echo '<li><a>' . get_the_title() . '</a></li>';
			}
			//Display breadcrumb trail for multi-level subpages (multi-level submenus)
			elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
				//get the ancestor of the current page/post_id, with the numeric ID
				//of the current post as the argument.
				//get_post_ancestors() returns an indexed array containing the list of all the parent categories.
				$post_array = get_post_ancestors($post);
	
				//Sorts in descending order by key, since the array is from top category to bottom.
				krsort($post_array);
					
				//Loop through every post id which we pass as an argument to the get_post() function.
				//$post_ids contains a lot of info about the post, but we only need the title.
				foreach($post_array as $key=>$postid){
					//returns the object $post_ids
					$post_ids = get_post($postid);
					//returns the name of the currently created objects
					$title = $post_ids->post_title;
					//Create the permalink of $post_ids
					echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
				}
				the_title(); //returns the title of the current page.
			}
			//Display breadcrumb for author archive
			elseif ( is_author() ) {//Check if an Author archive page is being displayed.
				global $author;
				//returns the user's data, where it can be retrieved using member variables.
				$user_info = get_userdata($author);
				echo  'Archived Article(s) by Author: ' . $user_info->display_name ;
			}
			 
			//Mostra Erro 404
			elseif ( is_404() ) {
				echo '<li><a>Error 404 - Não encontrado.</a></li>';
			}
			else {
				echo '<li><a>Vai que é tua programador.</a></li>';
			}
			 
			echo '</ul>
			</div>';
		}
	}
}