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
 * Classe responsavel por gerar modelos de metas
 * para os diversos tipos de posts e paginas, elas
 * contem informacoes adicionais as contidas nos 
 * sistemas convencionais, como: campos personalizados,
 * sistemas de envio de mensagens e mais... para melhor
 * conpreensao veja a documentacao oficial do wordpress
 * { @link http://codex.wordpress.org }
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Post_Metas
{
	/**
	 * Matriz contendo todos os itens
	 * para criacao dos campos personalizados
	 * 
	 * @var array
	 */
	protected $_itens = array();
	/**
	 * Nome do custom meta, este deve
	 * ser unico
	 * 
	 * @var string
	 */
	protected $name = null;
	/**
	 * Tipo do post que contera esta
	 * custom meta
	 * 
	 * @var string
	 */
	protected $type = null;
	
	/**
	 * Metodo construtor, configura o nome
	 * e o post_type do objeto
	 * 
	 * @param string $name
	 * @param string $post_type
	 */
	public function __construct( $name , $post_type )
	{
		$this->name = $name;
		$this->type = $post_type;
	}
	/**
	 * Create a new field in your post meta
	 * 
	 * @param string $name
	 * @param string $type
	 * 		Options: text, radio, textarea, image
	 * @param string $label
	 * @param string $defaultValue
	 * @param string $params
	 * @throws Exception
	 * 		Caso o tipo enviado nao seja valido
	 * @return Wordwebpress_Post_Metas
	 */
	public function addItem( $name, $type, $label, $defaultValue = '', $params = '' )
	{
		$options = array( 'text', 'textarea', 'radio', 'image' , 'select' );
		if ( in_array($type, $options) )
		{
			$this->_itens[$name]['name'] = $name;
			$this->_itens[$name]['type'] = $type;
			$this->_itens[$name]['label'] = $label;
			$this->_itens[$name]['defaultValue'] = $defaultValue;
			$this->_itens[$name]['params'] = $params;
			return $this;
		}
		throw new Exception( sprintf( __('Invalid type "%s" for %s.'), $type, 'item' ) );
	}
	/**
	 * Responsible for include the generate the post meta
	 */
	public function generate()
	{
		add_action ( "admin_init", array( &$this , "w2p_generate" ) );
		add_action ( 'save_post', array( &$this , "w2p_save_meta" ) );
	}
	/**
	 * Generated the form html
	 * @return boolean
	 */
	public function generateHtml()
	{
		// Styles
		wp_enqueue_style('thickbox');
		wp_register_style('my-style-w2p', W2P_ASSETS_PATH . 'css/style.css');
		wp_enqueue_style('my-style-w2p');
		
		// Scripts
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-js-w2p', W2P_ASSETS_PATH . 'javascripts/script.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-js-w2p');
		
		
		return include $this->getPath() . '_form.php';
	}
	/**
	 * Generate the post meta
	 */
	public function w2p_generate()
	{
		add_meta_box("{$this->name}_meta", $this->name, array( &$this, 'generateHtml' ), $this->type, "normal", "high");
	}
	/**
	 * Action responsavel por salvar os dados no banco
	 * @param integer $post_id
	 */
	public function w2p_save_meta( $post_id )
	{
		global $post;
		
		if (defined ( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
			return $post_id;
		
		if ( isset($_POST['custom-post']) )
		{
			if ( $_POST['custom-post'] == md5($this->name) )
			{
				$dados = array();
				
				foreach ( $this->_itens as $item )
				{
					$dados[ $item['name'] ]		= ( isset($_POST[ $item['name'] ])	? $_POST[ $item['name'] ]	: '' );
				}
				
				update_post_meta ( $post->ID, WORDWEBPRESS_APP_NAME . '_metas_' . $this->name , base64_encode( serialize($dados) ) );
			}
		}
	}
	/**
	 * Return the path children files
	 */
	private function getPath()
	{
		return WORDWEBPRESS_INCLUDE .
				Wordwebpress::getInstance()->configuration()->get_cfn_value('core_path') .
				DIRECTORY_SEPARATOR .
				'Wordwebpress' .
				DIRECTORY_SEPARATOR .
				'Post' .
				DIRECTORY_SEPARATOR .
				'Metas' .
				DIRECTORY_SEPARATOR;
	}
}