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
 * Classe responsavel por geracao de html e objetos
 * de visualizacao por usuarios finais
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1.1
 */
class Wordwebpress_Html
{
	
	/**
	 * Retorna a url da imagem solicitada, atravŽs
	 * da conven‹o que as imagens fiquem em
	 * %theme%/%assets_path%/images , caso n‹o exista
	 * retorna mensagem de erro
	 *
	 * @param $image String
	 * @since 1.0
	 * @return string
	 */
	public function get_image_url($image) {
		if (file_exists ( WORDWEBPRESS_INCLUDE . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'assets_path' ) . "/images/{$image}" )) {
			Wordwebpress::getInstance()->debug()->_debug_add_content ( "Image: {$image} added successfully" );
			return WORDWEBPRESS_URL . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'assets_path' ) . "/images/{$image}";
		}
		Wordwebpress::getInstance()->debug()->_debug_add_content ( "Error : Image {$image} not existent" );
		return 'image not existent: ' . WORDWEBPRESS_URL . Wordwebpress::getInstance()->configuration()->get_cfn_value ( 'assets_path' ) . "/images/{$image}";
	}
	/**
	 * Retorna script para adicionar swf ao site
	 *
	 * @param $div String
	 *       	 , id do DIV para sera mantido swf
	 * @param $movie String
	 *       	 , url do swf a ser adicionado
	 * @param $width Number
	 *       	 , largura do movie
	 * @param $height Number
	 *       	 , altura do movie
	 * @param $vars String
	 *       	 , querystring de variaveis a
	 *       	 passar para o objeto de movie swf send adicionado
	 * @param $install String
	 *       	 , nome do instalador do flash
	 * @since 1.2
	 * @return string
	 */
	public function get_swf($div, $movie, $width, $height, $vars, $install = 'expressInstall.swf') {
		Wordwebpress::getInstance()->configuration()->get_swfobject_script();
		return '<script type="text/javascript" language="javascript">
		var versao = "10";
		var flashvars = {' . $vars . '};
		var parametros = {wmode:"transparent",allowFullScreen:true,allowScriptAccess:"always",quality:"high"};
		var attributes = {id: "flash' . uniqid () . '",name: "flash' . uniqid () . '"};
		swfobject.embedSWF("' . $movie . '","' . $div . '",' . $width . ',' . $height . ',versao,"' . $install . '", flashvars, parametros, attributes);
		</script>
		';
	}
	
	/**
	 * Adiciona um menu
	 * @param String $nome
	 * @param String $link
	 * @param String $wrap
	 * @param Array $params
	 * @version 1.0
	 */
	public function link($nome,$link,$wrap_before = '<li>',$wrap_after = '</li>', $params=null)
	{	
		$url = get_bloginfo('url');
		echo $wrap_before ."<a href=\"".$url."/".$link."\" ".$params.">".$nome."</a>".$wrap_after;
	}
	
}