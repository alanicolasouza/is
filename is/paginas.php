<?php
	// Página Guia
	add_action('admin_menu', 't_guide');
	
	function t_guide() {
		add_theme_page('Como administrar o seu site.', 'Guia do Usuário', 8, 'user_guide', 't_guide_options');
	}
	
	function t_guide_options() {
		global $is;
?>

<div class="wrap">
	<div class="opwrap" style="background:#fff; margin:20px auto; width:80%; padding:30px; border:1px solid #ddd;" >
	
		<div id="wrapr">
		
			<div class="headsection">
				<h2 style="clear:both; padding:20px 10px; color:#444; font-size:32px; background:#eee">Guia do Usuário</h2>
			</div>
		
			<div class="gblock">
			
			  <h2>Manual de Administração</h2>
			
			  
			  
			  <p><?=( empty( $is['guia_manual'] ) ) ? 'Aguardando Postagem' : '<iframe src="http://www.slideshare.net/slideshow/embed_code/'.$is['guia_manual'].'" width="800" height="600" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>'?></p>
					
			
			  <h2>Tutorial em Vídeo</h2>
			  
				<div class="gblock">  
				
					<p><?=$is['guia_video']?></p>
					
				</div>
				
				<h2>Manual Wordpress</h2>
				<div class="gblock"> 
					<iframe src="http://www.slideshare.net/slideshow/embed_code/3077427" width="800" height="600" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" allowfullscreen webkitallowfullscreen mozallowfullscreen> </iframe>
				</div>
				
				<h2>Termos de Uso</h2>

				<p> Não é permitido alterações no código fonte do projeto, etc. </p>  
				
				<h2>Suporte</h2>
				
				<p> O suporte é prestado por telefone ( 51 3463.3505), email ( <a href="mailto:suporte@interative.cc">suporte@interative.cc</a> ) ou chat ( skype ) das 10:00 às 17hs de segunda à sexta. </p>
				<p> Solicitamos que só entre em contato após tentar tirar as dúvidas pelos manual e tutoriais acima. </p>  
				
			</div>
		
		
		
		</div>
	
	</div>
	
</div>

<?php
	};
	
	// Página Webmail
	add_action('admin_menu', 't_webmail');
	
	function t_webmail() {
		add_theme_page('Webmail.', 'Webmail', 8, 'webmail', 't_webmail_options');
	}
	
	function t_webmail_options() { ?>
	
	<iframe src="http://webmail.<?=str_replace( 'http://', '', get_bloginfo('url') )?>" width="100%" height="800px;"></iframe>
	
<?php } ?>