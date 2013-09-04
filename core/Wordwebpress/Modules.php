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
 * Classe responsavel por manutencao e gerenciamento
 * dosmodulos do w2p
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1.2
 */
class Wordwebpress_Modules
{
	public function __construct()
	{
		$this->require_modules();
	}
	/**
	 * Retorna a pasta do modulo pedido
	 * 
	 * @param string $name      	
	 * @since 1.0
	 * @return string
	 */
	public function get_module_path($name)
	{
		if (is_dir ( WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'core_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'module_path' ) . '/' . $name )) {
			return WORDWEBPRESS_URL . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'core_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'module_path' ) . '/' . $name;
		} else {
			Wordwebpress::getInstance()->debug()->_debug_add_content ( "Error: Path {$name} not existent on module_path, get_module_path", true );
			return false;
		}
	}
	/**
	 * Retorna a pasta de inclus‹o do modulo pedido
	 *
	 * @param string $name
	 * @since 1.0
	 * @return string
	 */
	public function get_module_include_path($name)
	{
		$dir = WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'core_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'module_path' ) . '/' . $name;
		if (is_dir ( $dir ))
			return $dir;
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Error: Path {$name} not existent on module_path, get_module_include_path", true );
		return false;
	}
	/**
	 * Verifica se existe um determinado modulo
	 * @param string $name
	 * @return boolean
	 */
	public function exists_module( $name )
	{
		$dir = WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'core_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'module_path' );
		if ( file_exists( $dir . DIRECTORY_SEPARATOR . $name . '.php' ) )
			return true;
		return false;
	}
	/**
	 * Return all name of the modules existents
	 * @return array
	 */
	public function get_all_modules()
	{
		$dir = WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'core_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'module_path' );
		$ar = array();
		if (is_dir ( $dir )) {
			$objects = scandir ( $dir );
			foreach ( $objects as $object ) {
				if ($object != "." && $object != "..") {
					if (filetype ( $dir . "/" . $object ) != "dir")
					{
						$ar[] = str_replace('.php', '', $object);
					}
				}
			}
		}
		return $ar;
	}
	/**
	 * Executa as funcoes dos modulos
	 */
	public function exec_all_functions()
	{
		foreach ( $this->get_all_modules() as $module )
		{
			if ( function_exists($module) )
			{
				call_user_func($module);
			}
		}
	}
	/**
	 * Adiciona os modulos no sistema
	 *
	 * @since 1.0
	 */
	private function require_modules() {
		$dir = WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'core_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'module_path' );
		if (is_dir ( $dir )) {
			$objects = scandir ( $dir );
			foreach ( $objects as $object ) {
				if ($object != "." && $object != "..") {
					if (filetype ( $dir . "/" . $object ) != "dir")
					{
						require_once ($dir . "/" . $object);
					}
				}
			}
			Wordwebpress::getInstance()->debug()->_debug_add_content ( "Modules loaded successfully" );
			return true;
		} else
			return false;
	}
}