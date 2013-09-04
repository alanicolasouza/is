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
 * Classe responsavel por configurar a linguagem atual
 * do w2p
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Language
{
	public function __construct()
	{
		load_theme_textdomain ( 'w2p', WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'lang_path' ) );
		$locale = get_locale ();
		$locale_file = WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'lang_path' ) . "/{$locale}.php";
		if (is_readable ( $locale_file ))
			require_once ($locale_file);
	}
}