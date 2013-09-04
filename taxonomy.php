<?php

$term = get_queried_object();



if( !empty( $term->parent )){
	
	$parent = get_term_by( 'id', $term->parent, get_query_var( 'taxonomy' ));
	
	if( $parent->slug == 'segmentos'){
		Wordwebpress::getInstance()->setLayout('default')->setView('taxonomy_segmentos')->render();
		exit();
	}
}

Wordwebpress::getInstance()->setLayout('default')->setView('taxonomy')->render();