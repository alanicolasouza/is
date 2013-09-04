<?php
/**
 * 
 * @author      Welington Sampaio { @link http://welington.zaez.net/ }
 * @category    Wordwebpress
 * @version	    1.0
 * @license	    http://w2p.zaez.net/license
 *
 */


defined( 'WORDWEBPRESS_APP_NAME' )
	|| define( 'WORDWEBPRESS_APP_NAME' , 'W2P_my_theme' );

defined ( 'W2P_ASSETS_PATH' )
	|| define( 'W2P_ASSETS_PATH' , WORDWEBPRESS_URL.DIRECTORY_SEPARATOR.'/core/assets/' );

define( 'W2P_CORE_PATH' , realpath(dirname(__FILE__) . '/') );

require_once dirname(__FILE__) . '/Wordwebpress/Autoloader.php';
require_once dirname(__FILE__) . '/Wordwebpress/Core.php';

/**
 * Classe responsavel por recuperar todos os modulos
 * do sistema w2p.
 * 
 * @example
 * $system = Wordwebpress::getInstance();
 * $system->html()->image('name.ext');
 * $system->configuration()->get_cfn_value('version');
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress extends Wordwebpress_Core
{
	/**
	 * Instancia unica do objeto
	 * 
	 * @var Wordwebpress
	 */
	public static $_w2p = null;
	/**#@+
	 * Referencias dos objetos
	 * 
	 * @var mixed
	 */
	protected $__admin = null;
	protected $__configuration = null;
	protected $__debug = null;
	protected $__email = null;
	protected $__helper = null;
	protected $__html = null;
	protected $__javascript = null;
	protected $__language = null;
	protected $__modules = null;
	protected $__post = null;
	protected $__stylesheet = null;
	/**#@-*/
	
	public function __construct()
	{
		new Wordwebpress_Autoloader();
	}
	/**
	 * Retorna o objeto propriamente dito
	 *
	 * @version 1.0
	 * @return Wordwebpress
	 */
	public static function getInstance() {
		if (Wordwebpress::$_w2p instanceof Wordwebpress)
			return Wordwebpress::$_w2p;
		Wordwebpress::$_w2p = new Wordwebpress ();
		
		Wordwebpress::$_w2p->configuration();
		Wordwebpress::$_w2p->admin()->addThemeAdmin();
		Wordwebpress::$_w2p->modules();
		Wordwebpress::$_w2p->language();
		Wordwebpress::$_w2p->debug();
		return Wordwebpress::$_w2p;
	}
	/**
	 * Retorna o objeto admin
	 * @version 1.0
	 * @see Wordwebpress_Admin()
	 * @return Wordwebpress_Admin
	 */
	public function admin()
	{
		if ( !$this->__admin )
			$this->__admin = new Wordwebpress_Admin();
		return $this->__admin;
	}
	/**
	 * Retorna o objeto configuration
	 * @version 1.0
	 * @return Wordwebpress_Configuration
	 */
	public function configuration()
	{
		if ( !$this->__configuration )
			$this->__configuration = new Wordwebpress_Configuration();
		return $this->__configuration;
	}
	/**
	 * Retorna o objeto debug
	 * @version 1.0
	 * @return Wordwebpress_Debug
	 */
	public function debug()
	{
		if ( !$this->__debug )
			$this->__debug = new Wordwebpress_Debug();
		return $this->__debug;
	}
	/**
	 * Retorna o objeto email
	 * @version 1.0
	 * @return Wordwebpress_Email
	 */
	public function email()
	{
		if ( !$this->__email )
			$this->__email = new Wordwebpress_Email();
		return $this->__email;
	}
	/**
	 * Retorna o objeto helper
	 * @version 1.0
	 * @return Wordwebpress_Helper
	 */
	public function helper()
	{
		if ( !$this->__helper )
			$this->__helper = new Wordwebpress_Helper();
		return $this->__helper;
	}
	/**
	 * Retorna o objeto html
	 * @version 1.0
	 * @return Wordwebpress_Html
	 */
	public function html()
	{
		if ( !$this->__html )
			$this->__html = new Wordwebpress_Html();
		return $this->__html;
	}
	/**
	 * Retorna o objeto javascript
	 * @version 1.0
	 * @return Wordwebpress_Javascript
	 */
	public function javascript()
	{
		if ( !$this->__javascript)
			$this->__javascript = new Wordwebpress_Javascript();
		return $this->__javascript;
	}
	/**
	 * Retorna o objeto language
	 * @version 1.0
	 * @return Wordwebpress_Language
	 */
	public function language()
	{
		if ( !$this->__language )
			$this->__language = new Wordwebpress_Language();
		return $this->__language;
	}
	/**
	 * Retorna o objeto modules
	 * @version 1.0
	 * @return Wordwebpress_Modules
	 */
	public function modules()
	{
		if ( !$this->__modules )
			$this->__modules = new Wordwebpress_Modules();
		return $this->__modules;
	}
	/**
	 * Retorna o objeto post
	 * @version 1.0
	 * @return Wordwebpress_Post
	 */
	public function post()
	{
		if ( !$this->__post )
			$this->__post = new Wordwebpress_Post();
		return $this->__post;
	}
	/**
	 * Retorna o objeto stylesheet
	 * @version 1.0
	 * @return Wordwebpress_Stylesheet
	 */
	public function stylesheet()
	{
		if ( !$this->__stylesheet )
			$this->__stylesheet = new Wordwebpress_Stylesheet();
		return $this->__stylesheet;
	}
}