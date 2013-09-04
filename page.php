<!DOCTYPE html>
<html>
<?php
get_header();
?>
<article id="single">
	<div class="topo"></div>
	<div class="content-single">
<?php
global $post;
the_post();
?>
		<div class="content">
			<h1><?php the_title() ?><?php edit_post_link('Editar Conteúdo','&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;') ?></h1>
			<p><?php the_content() ?></p>
		</div>
		<div class="clear"></div>
	</div>
	<div class="rodape"></div>
</article>
<?php 
get_footer();
?>
</html>