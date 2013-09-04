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
 * Classe responsavel por manutencao, inclusao e
 * gerenciamento das helpers
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.2
 */
class Wordwebpress_Helper
{
	/**
	 * Matriz com nomes das extensoes para
	 * a inportacao das helpers
	 * @var array
	 */
	protected $exts = array ('.php', '.phtml', '.html' );
	/**
	 * Inclui arquivo de helpers para auxiliar em tarefas comuns
	 * captura os arquivos a partir da pasta
	 * %layout_path%/%helper_path%, com as extens›es previamente
	 * definidas dentro do metodo
	 *
	 * @param $helper String
	 * @return boolean
	 */
	public function helper($helper) {
		foreach ( $this->exts as $ext ) {
			if (file_exists ( WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'layout_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'helper_path' ) . '/' . $helper . $ext )) {
				include WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'layout_path' ) . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'helper_path' ) . '/' . $helper . $ext;
	
				Wordwebpress::getInstance()->debug()->_debug_add_content ( "File {$helper} successfully started, helpers path" );
				return true;
			}
		}
		$this->_debug_add_content ( "Error: File {$helper} not exist on helpers path", true );
		return false;
	}
}