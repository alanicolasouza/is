<?php
if (is_home ()) {
	echo '<meta content="' . get_bloginfo ( 'description' ) . '" name="description">
	<meta content="Home, Index, Principal" name="keywords">';
} else if (is_single ()) {
	if (have_posts ()) :
		while ( have_posts () ) :
			the_post ();
			$posttags = get_the_tags ();
			$tags = '';
			if ($posttags) {
				foreach ( $posttags as $tag ) {
					$tags .= $tag->name . ', ';
				}
			}
			echo '<meta content="' . get_the_excerpt () . '" name="description">
			<meta content="' . $tags . '" name="keywords">';
		endwhile;
	endif;
}	