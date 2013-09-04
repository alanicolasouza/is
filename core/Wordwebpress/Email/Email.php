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
 */

require( ABSPATH . WPINC . '/class-smtp.php' );
require( ABSPATH . WPINC . '/class-phpmailer.php');

/**
 * Classe responsavel por objetos de email, que sao formulario  que
 * sao configurados e enviados por email. Existem a opcao de envio
 * usando ajax, previamente configurado atraves de um javascript
 * incluido na pasta do assets/javascripts, criado por Alan Nicolas
 * Souza { @link http://www.alanicolasouza.com }
 * 
 * @example 
 * $email = new Wordwebpress_Email_Email('contact');
 * $email->add_to('email@email.com')
 *       ->set_subject('Contato site - Pg. Contato')
 *       ->set_confirm_message( 'Mensagem enviada com sucesso, breve entraremos em contato.' );
 * $email->add_field_text('name', 'Nome', array('required'=>true))
 *       ->add_field_text( 'city', 'Cidade' )
 *       ->add_field_email( 'email', 'Email', array('required'=>true) )
 *       ->add_field_tel( 'phone', 'Telefone')
 *       ->add_field_textarea( 'message', 'Mensagem', array( 'required' => true ) );
 * $email->send_mail();
 * $email->print_form();
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Email_Email extends Wordwebpress_Email_Form
{
    /**
     * Objeto de envios de emails
     * @var PHPMailer
     */
    protected $_mail = null;
    /**
     * Nome para saudacao do cliente
     * @var string
     */
    protected $client = null;
    /**
     * Mensagem de confirmacao do envio do email
     * @var string
     */
    protected $confirm_message = null;
    /**
     * Data de envio
     * @var string
     */
    protected $datetime = null;
    /**
     * Link do desenvolverdor do sistema
     * @var string
     */
    protected $developer_link = null;
    /**
     * Url da logo de desenvolvedor do sistema
     * @var string
     */
    protected $developer_logo = null;
	/**
	 * Da onde parte o email
	 * @var string
	 */
    protected $from = null;
    /**
     * IP do usuario que envio o email
     * @var string
     */
    protected $ipaddress = null;
    /**
     * Conteudo da mensagem
     * @var string
     */
    protected $message = null;
    /**
     * Saudacao de comprimento
     * @var string
     */
    protected $salutation = null;
    /**
     * Assunto do email
     * @var string
     */
    protected $subject = null;
    /**
     * Email do cliente que ira receber
     * @var array
     */
    protected $to = array();
	/**
	 * Metodo construtor
	 * @param string $form_name, nome unico para o formulario
	 */
    public function __construct( $form_name )
    {
    	parent::__construct($form_name);
    	
    	// Configura obj PHPMailer
    	$this->_mail = new PHPMailer();
    	
    	// Configuracao
        $this->client	= Wordwebpress::getInstance()->configuration()->get_cfn_value('email_name');
		$this->from		= Wordwebpress::getInstance()->configuration()->get_cfn_value('email_from');
        
        // Saudacao
        $hora = @date("H");
        if($hora >= 12 && $hora<18)
        	$this->salutation = __('Good afternoon');
        else if ($hora >= 0 && $hora <12 )
        	$this->salutation = __('Good morning');
        else 
        	$this->salutation = __('Good night');
        
        // Dados de desenvolvedor
        $this->developer_link	= Wordwebpress::getInstance()->configuration()->get_cfn_value('developer_link');
        $this->developer_logo	= Wordwebpress::getInstance()->configuration()->get_cfn_value('developer_logo');
        
        // Dados do Cliente
        $this->ipaddress  = $_SERVER['REMOTE_ADDR'];  
        $this->datetime   = date( __('Y-m-d \a\t H:i:s') );
    }
    /**
     * Adiciona email a ser enviado
     * @since 1.0
     * @param string $to
     * @return Wordwebpress_Email $this
     */
    public function add_to( $to )
    {
    	$this->to[] = $to;
    	return $this;
    }
    /**
     * Return the message in really state
     * @since 1.0
     * @return string
     */
    public function get_message()
    {
    	return $this->mensagem;
    }
    /**
     * Retorna o metodo atual do objeto
     * @since 1.0
     * @return string
     */
    public function get_method()
    {
    	return $this->method;
    }
    /**
     * Enviar email simples
     * @param string $to
     * @since 1.0
     */
    public function send_mail()
    {
    	if ( $this->is_to_send() )
    	{
	    	if ( !$this->valid_all() )
	    	{
	    		$this->new_email();
	    		foreach ( $this->to as $to )
	    		{
	    			$this->send( $to );
	    		}
	    		$this->print_success();
	    	}else{
	    		if ( $this->is_ajax() )
	    		{
	    			echo json_encode( array( 'result' => 'error', 'error' => __('Fields filled invalid.') ) );
	    			exit();
	    		}
	    	}
    	}
    }
    /**
     * Configura a mensagem de confirmacao de envio que
     * seja mostrada ao usuario
     * @param string $message
     * @since 1.0
     * @return Wordwebpress_Email $this
     */
    public function set_confirm_message( $message )
    {
    	$this->confirm_message = $message;
    	return $this;
    }
    /**
     * Configura o assunto da mensagem
     * @param string $subject
     * @since 1.0
     * @return Wordwebpress_Email $this
     */
    public function set_subject( $subject )
    {
    	$this->subject = $subject;
    	return $this;
    }
    /**
     * Imprime mensagem de sucesso no envio, formato json caso
     * a requisicao seja em ajax ou informa o form a mensagem
     * de confirmacao de envio
     * @since 1.0
     */
    public function print_success()
    {
    	if ( $this->is_ajax() )
    	{
    		echo json_encode( array( 'result' => 'ok', 'message' => $this->confirm_message ) );
    		exit();
    	}else
    		$this->_confirm_message = $this->confirm_message;
    }

    /* PROTECTED */
    
    /**
     * Faz a verificacao se a requisicao � via ajax ou nao
     * @since 1.0
     * @return boolean
     */
    protected function is_ajax()
    {
		return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }


    
    /* PRIVATE FUNCTIONS */
    
    /**
     * Adiciona os campos do formulario no corpo da mensagem
     * @param string $var
     * @param string $label
     * @since 1.0
     * @return string
     */
    private function conteudo($var,$label)
    {
    	$value = $this->get_param_value($var);
    	if ( $value && !empty( $value ) )
    		return "<tr><td width=\"160\" class=\"label\">{$label}</td><td width=\"496\">{$value}</td></tr>";
		else
			return '';
    }
    /**
     * Configuracao de email simples
     * deve estar configurado previamente
     * os fields
	 * @see add_field
     * @since 1.0
     */
    private function new_email()
    {
		// Inicio da mensagem
		$this->set_msg_init();
		
		// Adiciona os campos no form
		foreach ( $this->_fields as $item )
			$this->message .= $this->conteudo($item['id'], $item['label']);
		
		// Final da mensagem
		$this->set_msg_final();
    }
	/**
     * Imprime mensagem de erro no formato json caso
     * a requisicao seja em ajax ou informa o form a mensagem
     * de erro no envio
	 * @param string $msg
     * @since 1.0
	 */
	private function print_error( $msg )
	{
		if ( $this->is_ajax() )
		{
			echo json_encode( array( 'result' => 'error', 'error' => $msg ) );
			exit();
		}else
			$this->_error_message = $msg;
	}
	/**
	 * Envia mensagem com/sem attachments
	 * @param string $to, email a ser enviado
     * @since 1.0
	 */
    private function send( $to )
    {
		try {
			$this->_mail->SetFrom ( $this->from, utf8_decode( __('Contact from site') ) );
			$this->_mail->Subject = utf8_decode ( $this->subject );
			$this->_mail->MsgHTML ( utf8_decode ( $this->message ) );
			$this->_mail->AddAddress ( $to , $this->client );
			
			// Configuracoes do Attachment
	    	if ( $this->_attachment )
	    	{
	    		foreach ( $this->attachments as $item )
	    		{
	    			if ( $item['type'] == 'file' )
	    				$this->_mail->AddAttachment ( $_FILES[ $item['id'] ]['tmp_name'], $_FILES[ $item['id'] ]['name'] );
	    		}
	    	}
		    	
			$this->_mail->send();
		} catch (phpmailerException $e) {
			$this->print_error($e->errorMessage());
		} catch (Exception $e){
			$this->print_error($e->getMessage());
		}
	}
    /**
     * Adiciona o rodap� ao conteudo da mensagem
     * com suas devidas configuracoes
     * @since 1.1
     */
    private function set_msg_final()
    {
    	$this->mensagem .= "
    					<tr><td colspan=\"2\" class=\"rodape\">
    					<a href=\"{$this->developer_link}\"><img src=\"{$this->developer_logo}\" border=\"0\" /></a></td></tr></table>
						      <br />".sprintf( __("This message was sent from IP: %s in %s") , $this->ipaddress , $this->datetime)."</td>
						</tr></table>";
    }
    /**
     * Seta o Inicio da mensagem com as devidas configuracoes
     * @since 1.1
     */
    private function set_msg_init()
    {
    	$this->message = " 
				<style type=\"text/css\">
				table {font-family:\"Courier New\", Courier, monospace;background: #ecf1f5;font-size: 12px;color: #444;}
				table table {font-family: \"Lucida Grande\", \"Lucida Sans Unicode\", sans-serif;border: none;font-size: 14px;}
				table table td{border-bottom:1px dashed; border-bottom-color:#d6dde4; background-color:#fff;vertical-align:top;font-size:12px;}
				table table td.topo,table table td.rodape {background-color: #aaa;color: white;font-weight:bold;border:none;font-size:15px;}
				table table td.rodape{background-color: #d6dde4;font-size: 12px;text-align:right;}
				table table td.label {background:#D6DDE4;color: #222;border-bottom:none !important;}
				</style>
				<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"15\"><tr><td align=\"center\" valign=\"middle\">
					<table width=\"680\" border=\"0\" cellspacing=\"0\" cellpadding=\"12\">
						<tr>
				        	<td colspan=\"2\" class=\"topo\">{$this->salutation} {$this->client}!<br />".__('You have received a new message from')." {$this->_name}.</td>
				        </tr>";
    }
}
