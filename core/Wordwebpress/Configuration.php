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
 * Classe para request de configuracoes do theme 
 * e da pagina administrativa
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.2.3
 */
class Wordwebpress_Configuration
{
	/**
	 * Cont�m as configura��os do sistema, caminhos de
	 * pastas, localiza��o de arquivos etc.
	 *
	 * @var Array
	 */
	protected $cfn_system = array ();
	
	/**
	 * Metodo construtor
	 * 
	 * @param array $cfn
	 */
	public function __construct()
	{
		$this->cfn_system = $this->get_default_cnf();
	}
	
	/**
	 * Retorna todos valores setados na configuracao
	 *
	 * @param $key String
	 * @since 1.0
	 * @return boolean | mixed
	 */
	public function get_cfn_values() {
		return $this->cfn_system;
	}
	
	/**
	 * Retorna o valor da configura��o requerida
	 *
	 * @param $key String
	 * @since 1.0
	 * @return boolean | mixed
	 */
	public function get_cfn_value($key) {
		if (! key_exists ( $key, $this->cfn_system )) {
			Wordwebpress::getInstance()->debug()->_debug_add_content ( "Error: {$key} not exist on system variable, for getting", true );
			return false;
		}
	
		return $this->cfn_system [$key];
	}
	/**
	 * Adiciona novas configura��es
	 * @param array $cfn
	 */
	public function set_cfn( $cfn )
	{
		if ( !is_array($cfn) )
			throw new Exception( __("The paramentro sent should be an array!") );
		
		foreach ( $cfn as $key=>$item)
			$this->cfn_system[$key] = $item;
		
		Wordwebpress::getInstance()->debug()->_debug_add_content( "Setting a new value of variable system" );
		
		$this->set_theme_configs();
		
		return true;
	}
	/**
	 * Retorna array com as configura��es defaults do sitema
	 * 
	 * @since 1.0
	 * @return array
	 */
	protected function get_default_cnf()
	{
		global $cfn_w2p_theme;
		if ( isset( $cfn_w2p_theme ) )
		{
			if ( !is_array($cfn_w2p_theme) )
				$cfn_w2p_theme = array();
		}else{
			$cfn_w2p_theme = array();
		}
		$default = array(
				'version'				=> '1.0',
				'system_author'			=> 'Welington Sampaio',
				'system_url'			=> 'http://w2p.zaez.net/',
				'core_path'				=> '/core',
				'assets_path'			=> '/assets',
				'helper_path'			=> '/helpers',
				'module_path'			=> '/modules',
				'widget_path'			=> '/widgets',
				'layout_path'			=> '/layouts',
				'cache_path'			=> '/cache',
				'lang_path'				=> '/lang',
				'debug'					=> 'false',
				'debug_path'			=> '/debug',
				'debug_name'			=> 'index.php',
				'debug_format'			=> 'html',
				'jquery_version'		=> '1.7.1',
				'jquery_online_version'	=> false,
				'compress_css_js'		=> false,
				'developer_link'		=> 'http://zaez.net',
				'developer_logo'		=> 'http://utilidades.zaez.net/logo.png'
				);
		return array_merge($default, $cfn_w2p_theme);
	}
	/**
	 * Configura o que o thema tera support
	 * 
	 * @since 1.0
	 */
	private function set_theme_configs()
	{
		if ( $this->cfn_system['used_thumbnails'] )
			add_theme_support( 'post-thumbnails' );
	}
	
}