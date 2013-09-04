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
 * Classe responsavel por definicoes de view e layout
 * alem de imprimir o conteudo renderizado
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1.1
 */

class Wordwebpress_Core
{
	/**
	 * Conteudo gerado para aview
	 *
	 * @var String | PHP
	 */
	protected $content = null;
	/**
	 * Cont�m o nome do layout e ser renderizado
	 *
	 * @var String
	 */
	protected $layout = null;
	/**
	 * Cont�m a view a ser renderizada pelo sistema
	 *
	 * @var String
	 */
	protected $view = null;
	
	/**
	 * Retorna verdadeiro se o dispositivo acessado for mobile
	 *
	 * @since 0.2
	 */
	public function is_mobile(){
		if( mobile_device_detect(true, false, true, true, true, true, false, false )){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Renderiza a página final
	 *
	 * @since 2.0
	 */
	public function render() {
			
		$views	= 'views';
		$layout	= $this->layout;
		
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Executing all modules methods." );
		Wordwebpress::getInstance()->modules()->exec_all_functions();
		
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Generating rendering of the view: {$this->view}" );
		
		ob_start ();
		include_once (WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'layout_path' ) . '/'.$views.'/' . $this->view  . '.phtml');
		$this->content = ob_get_clean ();
		
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Content of the rendered view" );
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Adding to the project layout" );
		
		include (WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'layout_path' ) . '/' . $layout . '.phtml');
		
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Layout successfully mastered" );
		
		if (Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'debug' ))
			Wordwebpress::getInstance()->debug()->save_debug ( Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'debug_format' ) );
	}
	/**
	 * Configura o layout da p�gina
	 *
	 * @param $layout String
	 *       	 Cont�m o nome do arquivo de layout para
	 *       	 rederiza��o da p�gina
	 * @since 1.0
	 * @return Wordwebpress_Core
	 */
	public function setLayout($layout) {
		$this->layout = $layout;
		return $this;
	}
	/**
	 * Configura a view de dados e configura��es
	 * para a renderiza��o do layout
	 *
	 * @param $view String
	 *       	 Nome do arquivo view para o rederizamento
	 * @since 1.0
	 * @return Wordwebpress_Core
	 */
	public function setView($view) {
		$this->view = $view;
		return $this;
	}
}