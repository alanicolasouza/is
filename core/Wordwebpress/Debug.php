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
 * Classe para request de configuracoes do theme 
 * e da pagina administrativa
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.1
 */
class Wordwebpress_Debug
{
	/**
	 * Variavel para verificacao de
	 * Ativacao do sistema de debug
	 * @var boolean
	 */
	protected $_debug = null;
	/**
	 * Contem as linhas a serem geradas no
	 * arquivo de debug
	 * @var array
	 */
	private $content = array();
	/**
	 * Conteudo final renderizado
	 * @var string
	 */
	private $content_render = '';
	/**
	 * Nome do arquivo de debug a ser gerado
	 * @var string
	 */
	private $debug_file = null;
	/**
	 * Pasta para armazenamento do debug
	 * @var string
	 */
	private $debug_path = null;
	/**
	 * Contem o timestamp final, apos
	 * a renderizacao do sistema
	 * @var string
	 */
	private $time_end = null;
	/**
	 * Contem o timestamp inicial do
	 * sistema
	 * @var string
	 */
	private $time_start = null;
	
	public function __construct( )
	{
		$this->debug_file = Wordwebpress::getInstance()->configuration()->get_cfn_value('debug_name');
		$this->debug_path = Wordwebpress::getInstance()->configuration()->get_cfn_value('debug_path');
		$this->time_start = microtime();
		$this->debug();
	}
	/**
	 * Adiciona caso a variavel _debug tenha sido instanciada
	 *
	 * @param $msg String       	
	 * @param $error Bool       	
	 * @since 1.0
	 */
	public function _debug_add_content($msg, $error = false) {
		if ($this->_debug)
			$this->add_content ( $msg, $error );
	}
	/**
	 * Gera o arquivo de debug e salva o mesmo.
	 */
	public function save_debug ()
	{
		$this->time_end = microtime();
		if ( Wordwebpress::getInstance()->configuration()->get_cfn_value('debug_format') == 'html' )
			$this->render_html();
		else
			$this->render_txt();
			
		$handle = fopen(WORDWEBPRESS_INCLUDE . 
					Wordwebpress::getInstance()->configuration()->get_cfn_value('core_path') . 
					$this->debug_path . '/' . $this->debug_file,"w");
		fwrite($handle,$this->content_render);
		fclose($handle);
		echo '<a href="'.WORDWEBPRESS_URL.
		Wordwebpress::getInstance()->configuration()->get_cfn_value('core_path').
		Wordwebpress::getInstance()->configuration()->get_cfn_value('debug_path').
		'/'.
		Wordwebpress::getInstance()->configuration()->get_cfn_value('debug_file').'">link debug</a>';
	}
	/**
	 * Adiciona uma linha de conteudo
	 * @param string $line
	 * @param boolean $error
	 */
	protected function add_content( $line, $error = false )
	{
		$this->content[] = array('content'=> "{$line}\n", 'time'=>microtime(), 'error' => $error );
	}
	/**
	 * Verifica se o sistema deve gerar
	 * relatorio de debug ou n‹o
	 *
	 * @since 1.0
	 */
	private function debug() {
		if ( Wordwebpress::getInstance()->configuration()->get_cfn_value( 'debug' ) )
			$this->_debug = true;
	}
	/**
	 * Gera html com o conteudo das linhas e adiciona
	 * a variavel $content_render, para a gravacao
	 */
	private function render_html()
	{
		$this->content_render .= '<html><head><title>Debug - '.@date('Y-m-d \a\t H:i:s').'</title></head><body>';
		$this->content_render .= '<table border="1" cellpadding="12">';
		$this->content_render .= '<tr><td align="center">Time for exec</td><td align="center">Mensage</td></tr>';
		
		foreach ( $this->content as $line )
			$this->content_render .= "<tr  style=\"background-color:".($line['error']?'#f3e1e1':'#d6f0d6')."\"><td>".( $this->time_end - $line['time'] ) . '</td><td>' . $line['content'] . '</td></tr>';
		$this->content_render .= '</table></body></html>';
	}
	/**
	 * Gera txt com o conteudo das linhas e adiciona
	 * a variavel $content_render, para a gravacao
	 */
	private function render_txt()
	{
		$this->content_render .= "<?php\nheader(\"Content-type: text/plain\");\n?>\n";
		foreach ( $this->content as $line )
			$this->content_render .= ( $this->time_end - $line['time'] ) . ' - ' . $line['content'];
	}
}