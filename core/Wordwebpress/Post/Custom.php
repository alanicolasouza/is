<?php
/**
 * 
 * @author      Welington Sampaio { @link http://welington.zaez.net/ }
 * @category    Wordwebpress
 * @package     Wordwebpress
 * @subpackage  Post
 * @version	    1.0
 * @license	    http://w2p.zaez.net/license
 *
 */

/**
 * Classe responsavel por geracao custom post.
 * Custom post sao modelos de posts com nomes,
 * criacao e forma de renderizacao customizadas
 * para melhor conpreensao veja a documentacao
 * oficial do wordpress { @link http://codex.wordpress.org }
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Post_Custom
{
	/**
	 * Nome do novo tipo de post
	 * 
	 * @var string
	 */
	protected $name = null;
	/**
	 * Ojetos para a criacao dos 
	 * labels do Cutom post 
	 * 
	 * @var array
	 */
	protected $labels = array();
	/**
	 * Objeto para a configuracao do
	 * Custom post
	 * 
	 * @var array
	 */
	protected $args = array();
	
	/**
	 * The construct method
	 * 
	 * @param string $name
	 * 		Name of the custom post
	 * @param string $title
	 * 		Name of the Custom post, that will 
	 * 		appear in display menu
	 * @param string $titlePluralize
	 * 		Name of the Custom post, that will
	 * 		appear in the local pluralized 
	 * @param Array $taxonomies
	 * 		Taxonomies
	 * @param string $menu_icon
	 * 		Menu Icon
	 */
	public function __construct( $name = 'custom_post', $title = 'Custom Post', $titlePluralize = 'Custom Posts', $taxonomies = array(), $menu_icon = null )
	{	
		$this->name = $name;
		
		$this->labels['name']				= sprintf('%s' , $titlePluralize);
		$this->labels['singular_name']	 	= sprintf('%s' , $title);
		$this->labels['add_new'] 			= sprintf( __('Adicionar %s') , $title);
		$this->labels['add_new_item']		= sprintf( __('Adicionar um novo %s') , $title);
		$this->labels['edit_item']			= sprintf( __('Editar %s') , $title);
		$this->labels['new_item']			= sprintf( __('Novo %s') , $title);
		$this->labels['view_item']			= sprintf( 'Ver %s' , $title);
		$this->labels['search_items']		= sprintf( __('Procurando por %s') , $titlePluralize);
		$this->labels['not_found']			= sprintf( __('%s não encontrado' ) , $title);
		$this->labels['not_found_in_trash']	= sprintf( __('%s não encontrado na lixeira' ) , $title);
		$this->labels['parent_item_colon']	= '';
		
		$this->args['taxonomies']			= $taxonomies;
		$this->args['menu_icon']			= $menu_icon;
		$this->args['public']				= true;
		$this->args['publicly_queryable']	= true;
		$this->args['show_ui']				= true;
		$this->args['query_var']			= true;
		$this->args['rewrite']				= true;
		$this->args['capability_type']		= 'post';
		$this->args['hierarchical']			= false;
		$this->args['menu_position']		= 5;
		$this->args['supports']				= array ('title', 'editor', 'thumbnail', 'revisions', 'excerpt' );
		$this->args['has_archive']			= true;
		
	}
	/**
	 * Setting a value of label
	 * see the documentation @link http://codex.wordpress.org/Function_Reference/register_post_type
	 * 
	 * @param string $name
	 * 				Options: name, singular_name, add_new, add_new_item, edit_item, new_item, 
						view_item, search_items, not_found, not_found_in_trash, parent_item_colon
	 * @param string $value
	 * @return Wordwebpress_Post_Custom
	 * @throws Exception
	 */
	public function setLabel( $name , $value )
	{
		$array = array('name','singular_name','add_new','add_new_item','edit_item','new_item',
						'view_item','search_items','not_found','not_found_in_trash','parent_item_colon');
		if ( in_array($name, $array) )
		{
			$this->labels[$name] = $value;
			return $this;
		}
		throw new Exception( sprintf( __('Invalid name "%s" for %s.'), $name, 'the label' ) );
	}
	/**
	 * Setting the argument for create a new custom post
	 * see the documentation @link http://codex.wordpress.org/Function_Reference/register_post_type
	 * 
	 * @param string $name
	 * 				Options: public, publicly_queryable, show_ui, query_var, rewrite, 
						capability_type, hierarchical, menu_position, supports
	 * @param mixed $value
	 * @return Wordwebpress_Post_Custom
	 * @throws Exception
	 */
	public function setArgument( $name , $value )
	{
		$array = array('public','publicly_queryable','show_ui','query_var','rewrite','has_archive',
						'capability_type','hierarchical','menu_position','supports', 'taxonomies', 'menu_icon');
		if ( in_array($name, $array) )
		{
			$this->args[$name] = $value;
			return $this;
		}else { echo 'eita nois'; exit(); }
		throw new Exception( sprintf( __('Invalid name "%s" for %s.'), $name, 'argument' ) );
	}
	
	/**
	 * Genarate custom post
	 */
	public function generate()
	{
		$this->args['labels'] = $this->labels;
	
		register_post_type ( $this->name, $this->args );
	}
}