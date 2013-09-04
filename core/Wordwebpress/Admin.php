<?php
/**
 * 
 * @author    Welington Sampaio { @link http://welington.zaez.net/ }
 * @category  Wordwebpress
 * @package   Wordwebpress
 * @version	  1.0
 * @license	  http://w2p.zaez.net/license
 *
 */

/**
 * Classe responsavel por gerar area administrativa
 * 
 * @example $admin = $system->admin();<br>
 * $module1 = new Wordwebpress_Admin_Module( WORDWEBPRESS_APP_NAME );<br>
 * $module2 = new Wordwebpress_Admin_Module( 'Redes Sociais' );<br>
 * $module2->addItem('linkFacebook')->setLabel('Link for page of facebook');<br>
 * $module2->addItem('linkTwitter')->setLabel('Link for page of Twitter');<br>
 * $admin->addModule($module1);<br>
 * $admin->addModule($module2);<br>
 * $admin->addThemeAdmin();
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 *
 */
class Wordwebpress_Admin
{
	/**
	 * Contem se eh para gerar campo de
	 * manutencao ou nao
	 * @var boolean
	 */
	protected $_noUsedMaintenance = false;
	/**
	 * Contem se eh para gerar campo de
	 * Key Analytics ou nao
	 * @var unknown_type
	 */
	protected $_noUsedKeyAnlytics = false;
	/**
	 * Matriz de objetos Wordwebpress_Admin_Module
	 * @var array
	 */
	protected $_modules = array();
	/**
	 * Nome da pagina de administracao
	 * @var string 
	 */
	protected $name =  WORDWEBPRESS_APP_NAME;
	
	/**
	 * Adiciona um modulo a pagina de administracao
	 * os modulos sao responsaveis por um item no meu da
	 * pagina de administracao, e cada modulo por conter
	 * campos personalizados que podera ser resgatado
	 * posteriormente pelo objeto Wordwebpress_Configuration
	 *
	 * @param Wordwebpress_Admin_Module|string $param
	 * @return Wordwebpress_Admin_Module
	 */
	public function addModule( $param )
	{
		if ( is_string($param) ) {
			$this->_modules[$param] = new Wordwebpress_Admin_Module($param);
			return $this->_modules[$param];
		} elseif ( $param instanceof Wordwebpress_Admin_Module ) {
			$this->_modules[ $param->getName() ] = $param;
			return $param;
		}
		throw new Exception( __("Incorrect value for the parameter.") );
	}
	/**
	 * Diz ao theme que ele tera suporte ao recurso
	 * de administracao gerado pelo w2p
	 */
	public function addThemeAdmin()
	{
		$defaultModule = $this->getModule( WORDWEBPRESS_APP_NAME , true );
		// Configura o modok manutencao caso exista no path de modulos
		if ( $this->_noUsedMaintenance !== true )
		{
			if ( Wordwebpress::getInstance()->modules()->exists_module('maintenance') === true )
			{
				$defaultModule->addItem('modeMaintenance')
								->setType( 'radio' )
								->setLabel( __('Mode maintenance ( active / deactive )') );
			}
		}
		
		if ( $this->_noUsedKeyAnlytics !== true )
		{
			$defaultModule->addItem('keyAnalytics')
							->setLabel( __('Enter the Google Key Analytics for integration in system') );
		}
			
		// Grava os dados padr�es no banco de dados
		$options = (get_option('w2p_theme_options_'.WORDWEBPRESS_APP_NAME) ? get_option('w2p_theme_options_'.WORDWEBPRESS_APP_NAME) : '');
		if (empty($options)){
			$ar = array();
			foreach ( $this->_modules as $module )
			{
				$module instanceof Wordwebpress_Admin_Module;
				foreach ( $module->getItens() as $item )
				{
					$item instanceof Wordwebpress_Admin_Module_Item;
					$dv = $item->getDefaultValue();
					if ( ( $item->getType() == 'text' ||
						 $item->getType() == 'textarea' ||
						 $item->getType() == 'image' ) &&
						!empty($dv) )
					{
						$ar[ $item->getName() ] = $item;
					}else{
						$ar[ $item->getName() ] = '';
					}
					
					$ar[ $item->getName() ] = ( $item->getType() == 'radio'		? 0 : $ar[ $item->getName() ] );
				}
			}
			$options = serialize($ar);
			add_option('w2p_theme_options_'.WORDWEBPRESS_APP_NAME, $options);
		}
			
		Wordwebpress::getInstance()->configuration()->set_cfn( unserialize( $options ) );
		$this->admin_head();
		
		add_action('admin_menu', array( &$this, 'admin_menu' ) );
		add_action('admin_init', array( &$this, 'save_data' ) );
	}
	/**
	 * Metodo responsavel por adicionar os stylesheet e
	 * javascripts no head da pagina de admin
	 * @see WP_Styles::add(), WP_Styles::enqueue()
	 * @see WP_Scripts::enqueue(), WP_Scripts::add()
	 */
	public function admin_head()
	{
		// Styles
		$a = W2P_ASSETS_PATH . 'css/style.css';
		wp_enqueue_style('thickbox');
		wp_register_style('my-style-w2p', W2P_ASSETS_PATH . 'css/style.css');
		wp_enqueue_style('my-style-w2p');
		
		// Scripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-js-w2p', W2P_ASSETS_PATH . 'javascripts/script.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-js-w2p');
	}
	/**
	 * Action responsavel por adicionar o suporte no
	 * admin { @link http://codex.wordpress.org/Function_Reference/add_theme_page }
	 */
	public function admin_menu()
	{
		add_theme_page ( $this->name, $this->name, 'edit_themes', basename ( __FILE__ ), array( &$this, 'w2p_theme_admin' ) );
	}
	/**
	 * Retona o array de modulos criados
	 * @return array
	 */
	public function getAllModules( )
	{
		return $this->_modules;
	}
	/**
	 * Recupera o modulo solicitado caso nao exista
	 * se habilitado o paramentro $forceCreate ele
	 * cria o modulo e o retorna
	 * 
	 * @see Wordwebpress_Admin::addModule()
	 * @param string $name
	 * @return Wordwebpress_Admin_Module
	 */
	public function getModule( $name, $forceCreate = false )
	{
		if ( key_exists($name, $this->_modules) )
			return $this->_modules[$name];
		if ( $forceCreate )
			return $this->addModule($name);
		throw new Exception( __("Name of invalid module.") );
	}
	/**
	 * Desabilita a opcao de Key Analytics na
	 * area administrativa do w2p
	 */
	public function noUsedKeyAnlytics()
	{
		$this->_noUsedKeyAnlytics = true;
	}
	/**
	 * Desabilita a opcao de modo manutencao na
	 * area administrativa do w2p
	 */
	public function noUsedMaintenance()
	{
		$this->_noUsedMaintenance = true;
	}
	/**
	 * Action responsavel por gravar os dados
	 * da pagina de administracao, esta action
	 * interfere os processos e imprime um JSON
	 * para informar o javascript a situacao final
	 * da gravacao 
	 */
	public function save_data()
	{
		if ( !isset ( $_REQUEST ['w2p_theme_gravar'] ))
			return false;
		
		$options = unserialize( get_option('w2p_theme_options_'.WORDWEBPRESS_APP_NAME) );
		$newOptions = $options;
		
		foreach ( $this->_modules as $module )
		{
			$module instanceof Wordwebpress_Admin_Module;
			if ( $_POST['w2p_theme_gravar'] == md5( $module->getName() ) )
			{
				foreach ( $module->getItens() as $item )
				{
					$item instanceof Wordwebpress_Admin_Module_Item;
					$newOptions[ $item->getName() ] = $_POST[ $item->getName() ];
				}
			}
		}
		
		if ( $newOptions != $options )
		{
			update_option ( 'w2p_theme_options_'.WORDWEBPRESS_APP_NAME , serialize ( $newOptions ) );
			$data = array('status'=>'ok', 'message'=>__('Updated options successfully!') );
		}else{
			$data = array('status'=>'info', 'message' => __('It brings up to date a content to bring up to date successfully.'), 'content' => $options );
		}
		
		header("Content-type: application/json");
		echo json_encode($data);
		
		exit();
	}
	/**
	 * Metodo responsavel por gerar o html da pagina
	 * de administracao
	 */
	public function w2p_theme_admin()
	{
		$html = new Wordwebpress_Admin_Html();
		$html->render();
	}
}