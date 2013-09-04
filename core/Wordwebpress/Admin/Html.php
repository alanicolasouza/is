<?php
/**
 * 
 * @author      Welington Sampaio { @link http://welington.zaez.net/ }
 * @category    Wordwebpress
 * @package     Wordwebpress
 * @subpackage  Admin
 * @version     1.0
 * @license	    http://w2p.zaez.net/license
 *
 */

/**
 * Classe responsavel por gerar o html da
 * pagina de administracao
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Admin_Html
{
	public function __construct()
	{}
	/**
	 * Renderiza a pagina
	 */
	public function render()
	{
		include $this->getPath() . '_loading.php';
		include $this->getPath() . '_notices.php';
		include $this->getPath() . '_form.php';
	}
	/**
	 * Retorna o caminho da subpasta Html
	 * onde se encontram os arquivos
	 * @return string
	 */
	private function getPath()
	{
		return WORDWEBPRESS_INCLUDE . 
				Wordwebpress::getInstance()->configuration()->get_cfn_value('core_path') .
				DIRECTORY_SEPARATOR .
				'Wordwebpress' .
				DIRECTORY_SEPARATOR .
				'Admin' .
				DIRECTORY_SEPARATOR .
				'Html' .
				DIRECTORY_SEPARATOR;
	}
}