<?php
/**
 *
 * @author      Welington Sampaio { @link http://welington.zaez.net/ }
 * @category    Wordwebpress
 * @package     Wordwebpress
 * @subpackage  Email
 * @version     1.0
 * @license	    http://w2p.zaez.net/license
 *
 * Mode of use:
 * 		
 * 	$form = new Wordwebpress_Form( 'form_name' );
 * 		
 *		Add fields:
 *
 ***** add_field_checkbox
 *		$form->add_field_checkbox( 'my_checkbox', 'My label',
 *			array(
 *				array( 'label'=>'Checkbox 1','value'=>'ck1' ),
 *				array( 'label'=>'Checkbox 2','value'=>'ck2' ),
 *				array( 'label'=>'Checkbox 3','value'=>'ck3' )
 *			),
 * 			array(
 * 				'value'=> array( 'ck1', 'ch3' ),
 * 				'required'=>true,
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_email
 *		$form->add_field_email( 'my_field_email', 'Your email',
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>255,
 * 				'value'=> 'mail@mail.com',
 * 				'required'=>true,
 * 				'placeholder'=>'your email',
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_file
 *		$form->add_field_file( 'my_file', 'Select the file',
 * 			array(
 * 				'value'=> '',
 * 				'required'=>true,
 * 				'placeholder'=>'Select the file',
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_number
 *		$form->add_field_number( 'my_field_number', 'This number?',
 *			0, 50, 5,
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>10,
 * 				'value'=> '25',
 * 				'required'=>true,
 * 				'placeholder'=>'This is number?',
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_password
 *		$form->add_field_password( 'my_field_password', 'Password', true,
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>10,
 * 				'value'=> '',
 * 				'required'=>true,
 * 				'placeholder'=>'Password',
 * 				'class'=>'',
 * 				'label_repeat' => 'Repeat password'
 * 				'placeholder_repeat' => 'Repeat password'
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_radio
 *		$form->add_field_radio( 'my_field_radio', 'Radio Label',
 *			array(
 *				array( 'label'=>'Radio 1','value'=>'rd1' ),
 *				array( 'label'=>'Radio 2','value'=>'rd2' ),
 *				array( 'label'=>'Radio 3','value'=>'rd3' )
 *			),
 * 			array(
 * 				'value'=> 'rd1',
 * 				'required'=>true,
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_range
 *		$form->add_field_range( 'my_field_range', 'Range Label',
 *			0, 50, 5,
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>10,
 * 				'value'=> '25',
 * 				'required'=>true,
 * 				'placeholder'=>'Range placeHolder',
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_search
 *		$form->add_field_search( 'my_field_search', 'Search Label',
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>150 ,
 * 				'value'=> 'search' ,
 * 				'required'=>true ,
 * 				'placeholder'=>'your email' ,
 * 				'class'=>'' ,
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_select
 *		$form->add_field_select( 'my_field_select', 'Select Label',
 *			array(
 *				array( 'label'=>'Label 1','value'=>'vl1' ),
 *				array( 'label'=>'Label 2','value'=>'vl2' ),
 *				array( 'label'=>'Label 3','value'=>'vl3' )
 *			),
 * 			array(
 * 				'value'=> 'vl2',
 * 				'required'=>true,
 * 				'class'=>'',
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_tel
 *		$form->add_field_tel( 'my_field_tel', 'Tel Label',
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>150 ,
 * 				'value'=> '99 9999-9999' ,
 * 				'required'=>true ,
 * 				'placeholder'=>'Tel format: (99) 9999-9999' ,
 * 				'class'=>'' ,
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_text
 *		$form->add_field_text( 'my_field_text', 'Text Label',
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>255 ,
 * 				'value'=> 'content' ,
 * 				'required'=>true ,
 * 				'placeholder'=>'My text' ,
 * 				'class'=>'' ,
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 *
 ***** add_field_url
 *		$form->add_field_url( 'my_field_url', 'Url Label',
 * 			array(
 * 				'minlength'=>1 ,
 * 				'maxlength'=>255 ,
 * 				'value'=> 'http://' ,
 * 				'required'=>true ,
 * 				'placeholder'=>'My text' ,
 * 				'class'=>'' ,
 * 				'attr'=> array(
 * 						array( 'name'=>'attribute_name_1','value'=>'value for attribute 1' ),
 * 						array( 'name'=>'attribute_name_2','value'=>'value for attribute 2' )
 * 					)
 * 				)
 * 			);
 * 
 */

/**
 * Classe de geracao de formulario no padrao HTML5.
 * Esta classe visa auxiliar na elaboracao de 
 * formularios e padronizar a forma como o mesmo e
 * apresentado na tela do cliente.
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Email_Form
{
	const ENCTYPE_APPLICATION = 'application/x-www-form-urlencoded';
	const ENCTYPE_MULTIPART = 'multipart/form-data';
	const ENCTYPE_TEXT = 'text/plain';
	const VERSION = '1.0';
	
	/**
	 * Informa se o form possui anexo ou nao
	 * @var boolean
	 */
	protected $_attachment = false;
	/**
	 * Mensagem de confirmacao ao usuario
	 * @var string
	 */
	protected $_confirm_message = null;
	/**
	 * Mensagem de erro ao usuario
	 * @var string
	 */
	protected $_error_message = null;
	/**
	 * array contem a colecao de fields do formulario
	 * @var array
	 */
	protected $_fields = array();
	/**
	 * Nome do formulario
	 * @var string
	 */
	protected $_name = null;
	/**
	 * HTML que vem antes de cada campo
	 * @var string
	 */
	protected $after = null;
	/**
	 * URL da acao do formulario
	 * @var string
	 */
	protected $action = null;
	/**
	 * HTML que vem depois de cada campo
	 * @var string
	 */
	protected $before = null;
	/**
	 * Encoding de envio do formulario
	 * @var string
	 */
	protected $enctype = null;
	/**
	 * Metodo de envio do formulario
	 * @var string
	 */
	protected $method = 'post';
	
	public function __construct( $name )
	{
		$this->_name = $name;
	}
	
	/**
	 * Adicionar field a base de dados para envio do email
	 * @since 1.2
	 * @param string $id
	 * @param string $label
	 * @param string $type
	 * @param array $params
	 * @return $this
	 */
	public function add_field( $id, $label, $type = 'text', $params = null )
	{
		$this->_fields[] = array('id'=>$id, 'label'=>$label, 'type'=>$type, 'params'=>$params);
		return $this;
	}
	/**
	 * Adiciona campo checkbox a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $options
	 * label, value
	 * @param array $params ,
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_checkbox ( $id, $label, $options, $params=null ) {
		$params['options'] = $options;
		$this->add_field($id, $label, 'checkbox', $params);
		return $this;
	}
	/**
	 * Adiciona campo email a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_email ( $id, $label, $params=null ) {
		$this->add_field($id, $label, 'email', $params);
		return $this;
	}
	/**
	 * Adiciona campo search a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_file ( $id, $label, $params=null ) {
		$this->method = 'post';
		$this->enctype = self::ENCTYPE_MULTIPART;
		$this->add_field($id, $label, 'file', $params);
		return $this;
	}
	/**
	 * Adiciona campo number a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param Number $min
	 * @param Number $max
	 * @param Number $step
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_number ( $id, $label, $min, $max, $step=null, $params=null ) {
		$params['min'] = $min;
		$params['max'] = $max;
		$params['step'] = $step;
		$this->add_field($id, $label, 'number', $params);
		return $this;
	}
	/**
	 * Adiciona campo password a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param boolean $repeat , 
	 * repetir configuracao do campo para criacao de senhas,
	 * ativacao deste torna o campo requerido assim como sua copia
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr,
	 * label_repeat, placeholder_repeat
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_password ( $id, $label, $repeat = false , $params=null) {
		if ( $repeat )
			$params['required'] = true;
		$this->add_field($id, $label, 'password', $params);
		if ( $repeat )
		{
			$r_l = ( key_exists('label_repeat', $params) ? $params['label_repeat'] : $label );
			$params['placeholder'] = ( key_exists('placeholder_repeat', $params) ? $params['placeholder_repeat'] : $params['placeholder'] );
			$this->add_field($id.'_repeat', $r_l, $params );
		}
		return $this;
	}
	/**
	 * Adiciona campo radio a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $options
	 * label, value
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_radio ( $id, $label, $options, $params=null ) {
		$params['options'] = $options;
		$this->add_field($id, $label, 'radio', $params);
		return $this;
	}
	/**
	 * Adiciona campo range a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param Number $min
	 * @param Number $max
	 * @param Number $step
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_range ( $id, $label, $min, $max, $step=null, $params=null ) {
		$params['min'] = $min;
		$params['max'] = $max;
		$params['step'] = $step;
		$this->add_field($id, $label, 'range', $params);
		return $this;
	}
	/**
	 * Adiciona campo search a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_search ( $id, $label, $params=null ) {
		$this->add_field($id, $label, 'search', $params);
		return $this;
	}
	/**
	 * Adiciona campo select a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $options
	 * label, value
	 * @param array $params , 
	 * value, required, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_select ( $id, $label, $options, $params=null ) {
		$params['options'] = $options;
		$this->add_field($id, $label, 'select', $params);
		return $this;
	}
	/**
	 * Adiciona campo tel a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_tel ( $id, $label, $params=null ) {
		$this->add_field($id, $label, 'tel', $params);
		return $this;
	}
	/**
	 * Adiciona campo de text convencional a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params ,
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_text ( $id, $label, $params=null ) {
		$this->add_field($id, $label, 'text', $params);
		return $this;
	}
	/**
	 * Adiciona campo textarea a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params ,
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_textarea ( $id, $label, $params=null ) {
		$this->add_field($id, $label, 'textarea', $params);
		return $this;
	}
	/**
	 * Adiciona campo url a colecao de campos
	 * @param string $id
	 * @param string $label
	 * @param array $params , 
	 * minlength, maxlength, value, required, placeholder, class, attr
	 * @since 1.0
	 * @return $this
	 */
	public function add_field_url ( $id, $label, $params=null ) {
		$this->add_field($id, $label, 'url', $params);
		return $this;
	}
    /**
     * Recupera o formulario com suas mensagens
     * @return string
     */
	public function print_form()
	{
		$name = $this->_name;
		$form = '';
		$form .= '<div id="form">';
		if ( $this->is_to_send() )
		{
			$form .= $this->get_confirm_message();
			$form .= $this->get_errors_message();
		}
		$form .= '<form action="" method="'.$this->method.'"  enctype="'.( $this->enctype ? $this->enctype : self::ENCTYPE_APPLICATION ).'">';
		foreach ( $this->_fields as $field )
			$form .= $this->get_field($field);
		$form .= $this->get_field( array( 'id'=>'required_name', 'type'=>'hidden' ) );
		$form .= $this->get_field( array( 'id'=>'wordwebpress_'.$this->_name, 'type'=>'hidden', 'params'=>array( 'value'=>$this->_name, 'required'=>true ) ) );
		$form .= '<span id="loading"></span>';
		$form .= '<input class="button" type="submit" value="Enviar" />';
		$form .= '</form>';
		$form .= '</div>';
		return $form;
	}
	/**
	 * Configura oque vem antes de cada campo do formulario
	 * @param string $after
	 * @since 1.0
	 */
	public function set_field_after ( $after )
	{
		$this->after = $after;
	}
	/**
	 * Configura oque vem depois de cada campo do formulario
	 * @param string $before
	 * @since 1.0
	 */
	public function set_field_before ( $before )
	{
		$this->before = $before;
	}
	/**
	 * Configura o metodo de envio do formulario
	 * @param string $method , post ou get
	 * @since 1.0
	 */
	public function set_method ( $method )
	{
		$this->method = $method;
	}
	
	/* PROTECTED */
	
	/**
	 * Retorna uma div com o conteudo da mensagem de confirmacao
	 * @since 1.0
	 * @return string
	 */
	protected function get_confirm_message()
	{
		if ( $this->_confirm_message )
			return '<div class="confirm">' . $this->_confirm_message . "</div>\n";
		return '';
	}
	/**
	 * Retorna uma lista com os erros encontrados no formulario
	 * @since 1.0
	 * @return string
	 */
	protected function get_errors_message()
	{
		$error = array();
		if ( $this->_error_message )
			$error[] = '<li>' . $this->_error_message . '</li>';
		foreach ( $this->_fields as $field )
			if ( $this->valid($field) )
				$error[] = '<li>' . $this->valid($field) . '</li>';
		return '<ul class="error">'.implode('', $error).'</ul>';
	}
	/**
	 * Verifica se o conteudo do campo esta enviado ou  ou
	 * conforme o metodo setado no form
	 * @param string $name
	 * @since 1.0
	 * @return boolean|string
	 */
	protected function get_param_value( $name )
	{
		if( $this->method == post )
		{
			if ( !isset( $_POST[$name] ) )
				return false;
			if ( empty( $_POST[$name] ) )
				return false;
			return $_POST[$name];
		}else{
			if ( !isset( $_GET[$name] ) )
				return false;
			if ( empty( $_GET[$name] ) )
				return false;
			return $_GET[$name];
		}
	}
	/**
	 * Verifica se esta permitido o envio deste formulario
	 * @since 1.0
	 * @return boolean
	 */
	protected function is_to_send()
	{
		$value = $this->get_param_value('wordwebpress_'.$this->_name);
		if ( $value == $this->_name )
			return true;
		return false;
	}
	/**
	 * Verifica se todos os campos do formulario esta validos
	 * @since 1.0
	 * @return boolean|string
	 */
	protected function valid_all()
	{
		foreach ( $this->_fields as $field )
			if ( $this->valid($field) )
				return $this->valid($field);
		return false;
	}
	/**
	 * Verifica determinado campo do formulario esta valido
	 * caso nao esteja tras a mensagem de erro apropriada
	 * @param string $field
	 * @since 1.0
	 * @return boolean|string
	 */
	protected function valid( $field )
	{
		$value = $this->get_param_value($field['id']);
		if ( isset($field['params']['required']) )
			if ( $field['params']['required'] )
				if ( !$value )
					return sprintf( __("The field \"%s\" is required.") , $field['label']);
		if ( isset($field['params']['minlength']) && isset( $field['params']['required'] ) )
		{
			if ( $field['params']['required'] )
			{
				if ( strlen($value) < $field['params']['minlength'] )
					return sprintf( __("Minimum size allowed for the field \"%s\" is %s characters.") , $field['label'], $field['params']['minlength']);
			}
		}
		if( isset( $field['params']['minlength'] ) )
		{
			if ( !empty($value) )
			{
				if ( strlen($value) < $field['params']['minlength'] )
					return sprintf( __("Minimum size allowed for the field \"%s\" is %s characters.") , $field['label'], $field['params']['minlength']);
			}
		}
		if( isset( $field['params']['maxlength'] ) )
		{
			if ( !empty($value) )
			{
				if ( strlen($value) > $field['params']['maxlength'] )
					return sprintf( __("Maximum size allowed for the field \"%s\" is %s characters.") , $field['label'], $field['params']['maxlength']);
			}
		}
		return false;
	}
	
	
	
	/**
	 * Gera HTML do field selecionado
	 * @param array $filed
	 * @since 1.0
	 * @return string
	 */
	private function get_field ( $field )
	{
		$return = '';
		$id				= ( key_exists('id', $field)			? $field['id']				: '' );
		$label			= ( key_exists('label', $field)			? $field['label']			: '' );
		$params			= ( key_exists('params', $field)		? $field['params']			: array() );
		$required		= ( key_exists('required', $params)		? $params['required']		: false );
		$class			= ( key_exists('class', $params)		? $params['class']			: false );
		$placeHolder	= ( key_exists('placeholder', $params)	? $params['placeholder']	: false );
		$minlength		= ( key_exists('minlength', $params)	? $params['minlength']		: false );
		$maxlength		= ( key_exists('$maxlength', $params)	? $params['maxlength']		: false );
		$min			= ( key_exists('min', $params)			? $params['min']			: false );
		$max			= ( key_exists('max', $params)			? $params['max']			: false );
		$step			= ( key_exists('step', $params)			? $params['step']			: false );
		$options		= ( key_exists('options', $params)		? $params['options']		: array() );
		 
		$value	= ( key_exists('value', $params)		? $params['value']		: '' );
		$value	= ( isset($_POST[$id])	? $_POST[$id]	: $value);
		$value	= ( isset($_GET[$id])	? $_GET[$id]	: $value);
		 
		$attribute = '';
		if ( key_exists('attr', $params) )
		{
			for( $i=0; $i<count($params['attr']); $i++) :
				$attribute .= ' ';
				$attribute .= $params['attr'][$i]['name'].'="'.$params['attr'][$i]['value'].'"';
			endfor;
		}
		
		$return .= ( $this->after ? $this->after : '' );
		 
		switch ( $field['type'] )
		{
			case 'textarea' :
				$return .= '<textarea id="'.$id.'" name="'.$id.'"';
				$return .= ( $class !== false ? ' class="'.$class.'"' : '' );
				$return .= ' placeholder="'.( $placeHolder !== false ? $placeHolder : $label ) . '"';
				$return .= ( $required !== false ? ' required="required"' : '' );
				$return .= ( $minlength !== false ? ' minlength="'.$minlength.'"' : '' );
				$return .= ( $maxlength !== false ? ' maxlength="'.$maxlength.'"' : '' );
				$return .= $attribute;
				$return .= '>';
				$return .= $value;
				$return .= "</textarea>\n";
				break;
			case 'number' :
			case 'range'  :
				$return .= '<input type="'.$field['type'].'" id="'.$id.'" name="'.$id.'" value="'.$value.'"';
				$return .= ( $class !== false ? ' class="'.$class.'"' : '' );
				$return .= ' placeholder="'.( $placeHolder !== false ? $placeHolder : $label ) . '"';
				$return .= ( $required !== false ? ' required="required"' : '' );
				$return .= ( $minlength !== false ? ' minlength="'.$minlength.'"' : '' );
				$return .= ( $maxlength !== false ? ' maxlength="'.$maxlength.'"' : '' );
				$return .= ( $min !== false ? ' min="'.$min.'"' : '' );
				$return .= ( $max !== false ? ' max="'.$max.'"' : '' );
				$return .= ( $step !== false ? ' step="'.$step.'"' : '' );
				$return .= $attribute;
				$return .= " />\n";
				break;
			case 'select' :
				$return .= '<select id="'.$id.'" name="'.$id.'"';
				$return .= ( $class !== false ? ' class="'.$class.'"' : '' );
				$return .= ( $required !== false ? ' required="required"' : '' );
				$return .= $attribute;
				$return .= ">\n";
				$return .= '<option>'.$label."</option>\n";
				foreach ( $options as $op )
					$return .= '<option value="'.$op['value'].'"'. ( $op['value'] == $value ? ' selected="selected"' :'' ).'>'.$op['label']."</option>\n";
				$return .= "</select>\n";
				break;
			case 'radio' :
				foreach ( $options as $key=>$op ) :
					$return .= '<input type="'.$field['type'].'" id="'.$id.'-'.$key.'" name="'.$id.'"';
					$return .= ' value="'.$op['value'].'"';
					$return .= ( $op['value'] == $value ? ' checked="checked"' : '');
					$return .= "/>\n";
					$return .= '<label for="'.$id.'-'.$key.'">'.$op['label']."</label>\n";
				endforeach;
				break;
			case 'checkbox' :
				foreach ( $options as $key=>$op ) :
					$return .= '<input type="'.$field['type'].'" id="'.$id.'-'.$key.'" name="'.$id.'[]"';
					$return .= ' value="'.$op['value'].'"';
					if ( is_array($value) )
						foreach ( $value as $v )
							$return .= ( $op['value'] == $v ? ' checked="checked"' : '');
					$return .= "/>\n";
					$return .= '<label for="'.$id.'-'.$key.'">'.$op['label']."</label>\n";
				endforeach;
				break;
			case 'password' :
				$value = '';
			default :
				$return .= '<input type="'.$field['type'].'" id="'.$id.'" name="'.$id.'" value="'.$value.'"';
				$return .= ( $class !== false ? ' class="'.$class.'"' : '' );
				$return .= ' placeholder="'.( $placeHolder !== false ? $placeHolder : $label ) . '"';
				$return .= ( $required !== false ? ' required="required" ' : '' );
				$return .= ( $minlength !== false ? ' minlength="'.$minlength.'"' : '' );
				$return .= ( $maxlength !== false ? ' maxlength="'.$maxlength.'"' : '' );
				$return .= $attribute;
				$return .= " />\n";
				break;
		}
		$return .= ( $this->before ? $this->before : '' );
		return $return;
	}
}