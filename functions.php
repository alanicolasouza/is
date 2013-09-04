<?php
	define('WORDWEBPRESS_APP_NAME', 'W2P-IS');
	define('WORDWEBPRESS_URL', get_bloginfo("template_url"));
	define('WORDWEBPRESS_INCLUDE', get_template_directory());

	global $cfn_w2p_theme;
	$cfn_w2p_theme = array(
			'debug'					=> false,
			'email_name'			=> 'Person Name',
			'email_from'			=> 'contato@w2p.com.br',
			'jquery_version'		=> '1.9.1',
			'jquery_online_version'	=> false,
			'used_thumbnails'		=> true,
			'compress_css_js'		=> false,
			'developer_link'		=> '',
			'mobile_test'			=> false,
			'developer_logo'		=> 'http://utilidades.zaez.net/logo.png'
	);

	require_once ( WORDWEBPRESS_INCLUDE . '/core/Wordwebpress.php');

	$system = Wordwebpress::getInstance();

	/*Módulo Banners rotativos*/
	$system->post()->addCustomPost('banners', 'Banners', 'Banners rotativos')->setArgument('supports', array ('title','revisions'))->generate();
	$system->post()->addCustomMeta('Informações do Banner', 'banners')
					->addItem('foto', 'image', 'Imagem do banner: ( dimensoes da imagem : 700×250 pixels )')
					->addItem('link', 'text', 'Link do banner ( caso nao precise deixe em branco )')
					->addItem('newwindow', 'radio', 'Abrir em nova pagina?')
					->generate();

	/*register taxonami
	register_taxonomy('categoria', array('produtos'),array( 'hierarchical' => true, 'label' => 'Categorias','show_ui' => true,'query_var' => true,'rewrite' => false,'singular_label' => 'Categoria') );


	// GET ID page
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;

	//sobre
	if ($post_id == '15'){
		$system->post()->addCustomMeta('Info', 'page' )
		->addItem('youtube', 		'text', 	'Apenas ID do vídeo ex: l47iROCGSDI')
		->generate();
	}

	$system->post()->addCustomPost('fornecedor', 'Fornecedor', 'Fornecedores')->setArgument('supports', array ('title','thumbnail', 'excerpt','revisions'))->generate();
	$system->post()->addCustomMeta('Fornecedor', 'fornecedor')
					->addItem('url', 		'text', 	'URL do site do cliente ')
					->addItem('site', 		'text', 	'Site do cliente ')
					->generate();
	*/


	//Destaque
	$module2 = new Wordwebpress_Admin_Module( 'Informações' );
	$module2->addItem('telefone')->setLabel('Telefone');
	$module2->addItem('email')->setLabel('Email');	

	$admin = $system->admin();
	$admin->addModule($module2);

	// Variáveis de Configuração Interative
	global 	$is, $helpers;

	$is['mensalidade'] = true;

	$is['guia_manual'] 	= '16470315';

	// Inclui as customizações da Interative
	include_once 'is/dashboard.php';
	include_once 'is/paginas.php';
	include_once 'is/helpers.php';

	$helpers = new Helpers_wp;

	function searchfilter($query){

		if ($query->is_search) {
	  		$query->set('post_type',array('produtos'));
	 	}

		return $query;
	}


	add_filter('pre_get_posts','searchfilter');