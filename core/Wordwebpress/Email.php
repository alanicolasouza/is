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
 * Classe responsavel por criar novos objetos de Email/Form
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.2
 */
class Wordwebpress_Email
{
	/**
	 * Create a new email form
	 * 
	 * @param string $formName
	 * @return Wordwebpress_Email_Email
	 */
	public function create( $formName )
	{
		return new Wordwebpress_Email_Email( $formName );
	}
}
