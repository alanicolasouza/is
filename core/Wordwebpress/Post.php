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
 * Classe responsavel por geracao e configuracoes
 * de tudo relacionado a posts
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Post
{
	/**
	 * Add a new Custom post in your theme
	 *
	 * @param string $name
	 * 				Name of the custom post
	 * @param string $title
	 * 				Name of the Custom post, that will
	 * 				appear in display menu
	 * @param string $titlePluralize
	 * 				Name of the Custom post, that will
	 * 				appear in the local pluralized
	 */
	public function addCustomPost( $name, $title, $titlePluralize )
	{
		return new Wordwebpress_Post_Custom( $name, $title, $titlePluralize );
	}
	/**
	 * 
	 * @param unknown_type $name
	 * @param unknown_type $post_type
	 * @return Wordwebpress_Post_Metas
	 */
	public function addCustomMeta( $name, $post_type )
	{
		return new Wordwebpress_Post_Metas($name, $post_type);
	}
}