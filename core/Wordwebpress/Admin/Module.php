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
 * Classe responsavel por criar modulos na pagina
 * de administracao, esses modulos sao itens do menu
 * da pagina de administracao, que pode conter um ou
 * mais campos de texto, imagens etc, onde os mesmos
 * sao gravados no banco para poder ser usado na 
 * criacao do seu theme, utilize modulos apenas para 
 * configuracoes que vc deseja dar permisao para que 
 * o cliente tenha a possibilidade de modificar, caso 
 * contrario use a classe Wordwebpress_Configuration 
 * para armazenar dados que podem ser utilizados no 
 * theme
 * 
 * @example 
 * $module2 = new Wordwebpress_Admin_Module( 'Social Midia' );<br>
 * $module2->addItem('linkFacebook')->setLabel('Link for page of facebook');<br>
 * $module2->addItem('linkTwitter')->setLabel('Link for page of Twitter');<br>
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Admin_Module
{
	/**
	 * Matriz com dados dos itens
	 * @var array
	 */
	protected $itens = array();
	/**
	 * Nome do modulo, este deve ser unico
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * Metodo construtor, apenas
	 * configura o nome do modulo
	 * conforme o valor enviado
	 * 
	 * @param string $name
	 */
	public function __construct( $name )
	{
		$this->setName($name);
	}
	/**
	 * Adiciona um item ao modulo, os itens
	 * sao objetos Wordwebpress_Admin_Module_Item
	 * quem contem as informacoes necessarias
	 * para criacao do campo correspondente
	 * 
	 * @param string|Wordwebpress_Admin_Module_Item $param
	 * 		Caso seja uma string enviada ele cria um novo 
	 * 		objeto, caso contrario simplesmente adiciona ao
	 * 		objeto de container
	 * @throws Exception
	 * 		Caso o valor enviado por paramentro nao seja
	 * 		valido, Ž estourado uma exception
	 * @return Wordwebpress_Admin_Module_Item
	 */
	public function addItem( $param )
	{
		if ( is_string($param) ) {
			$this->itens[$param] = new Wordwebpress_Admin_Module_Item( $param );
			return $this->itens[$param];
		}elseif ( $param instanceof Wordwebpress_Admin_Module_Item ) {
			$this->itens[$param->getName()] = $param;
			return $param;
		}
		throw new Exception( __("Incorrect value for the parameter.") );
	}
	/**
	 * Recupera o item atraves do nome enviado
	 * @param string $name
	 * @throws Exception
	 * 		Caso nao exista um objeto com o nome enviado
	 * 		Ž estourado uma exception
	 * @return Wordwebpress_Admin_Module_Item
	 */
	public function getItem( $name )
	{
		if ( key_exists($name, $this->itens) )
			return $this->itens[$name];
		throw new Exception( sprintf( __('Parameter "%s" of invalid item.'), $name ) );
	}
	/**
	 * Recupera o array completo de itens do modulo
	 * 
	 * @return array
	 */
	public function getItens( )
	{
		return $this->itens;
	}
	/**
	 * Recupara o nome atual do modulo
	 * 
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	/**
	 * Configuracao do nome de modulo
	 * 
	 * @param string $name
	 */
	public function setName( $name )
	{
		$this->name = $name;
		return $this;
	}
}