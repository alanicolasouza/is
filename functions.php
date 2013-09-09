<?php
	define('WORDWEBPRESS_APP_NAME', 'Digisom');
	define('WORDWEBPRESS_URL', get_bloginfo("template_url"));
	define('WORDWEBPRESS_INCLUDE', get_template_directory());

	global $cfn_w2p_theme;
	$cfn_w2p_theme = array(
			'debug'					=> false,
			'email_name'			=> 'Interative Studio',
			'email_from'			=> 'contato@interative.cc',
			'jquery_version'		=> '1.7.1',
			'jquery_online_version'	=> false,
			'used_thumbnails'		=> true,
			'compress_css_js'		=> false,
			'developer_link'		=> '',
			'developer_logo'		=> 'http://utilidades.zaez.net/logo.png'
			);
	
	require_once ( WORDWEBPRESS_INCLUDE . '/core/Wordwebpress.php');
	
	$system = Wordwebpress::getInstance();
	
	/*Custom Post*/
	$system->post()->addCustomPost('portfolio', 'Portfolio', 'Portfolio')->setArgument('supports', array ('title', 'thumbnail', 'excerpt', 'editor', 'revisions' ))->generate();
	$system->post()->addCustomMeta('Caracteristicas', 'portfolio')
	->addItem('link', 'text', 'Link do Trabalho')
	->addItem('thumb', 'image', 'Thumb')
	
	//Depoimento
	->addItem('dnome', 'text', 		'Nome')
	->addItem('dcargo', 'text', 	'Cargo')
	->addItem('dfoto', 	'image', 	'Foto')
	->addItem('dtexto', 'textarea', 'Depoimento')
	->generate();
	
	$system->post()->addCustomPost('servicos', 'Servi&ccedil;o', 'Sevi&ccedil;os')->setArgument('supports', array ('title', 'thumbnail', 'editor', 'revisions' ))->generate();
	
	/*Taxonamy*/
	register_taxonomy('trabalho','portfolio',array( 'hierarchical' => true, 'label' => 'Trabalhos Realizados','show_ui' => true,'query_var' => true,'rewrite' => false,'singular_label' => 'Trabalho Realizado') );
	
	/*Exemplo de Módulos
	$admin = $system->admin();
	$module1 = new Wordwebpress_Admin_Module( WORDWEBPRESS_APP_NAME );
	$admin->addModule($module1);
	$module2 = new Wordwebpress_Admin_Module( 'Configuracoes' );
	$module2->addItem('curso1')->setLabel('Curso 1 (Taxonomy)');
	$module2->addItem('curso1_title')->setLabel('Curso 1 (Title)');
	$module2->addItem('curso2')->setLabel('Curso 2 (Taxonomy)');
	$module2->addItem('curso2_title')->setLabel('Curso 2 (Title)');
	$module2->addItem('curso3')->setLabel('Curso 3 (Taxonomy)');
	$module2->addItem('curso3_title')->setLabel('Curso 3 (Title)');
	$module2->addItem('curso4')->setLabel('Curso 4 (Taxonomy)');
	$module2->addItem('curso4_title')->setLabel('Curso 4 (Title)');
	
	$admin->addModule($module2);
	
	*/