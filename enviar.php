<?php
/**
 * Enviar Formuário com Ajax
 * @author Alan Nicolas Souza
 * @version 1.3
 *
 */

if ( isset($_POST) && empty( $_POST['name'] ) &&  empty( $_POST['nome'] )){

	unset( $_POST['name']);
	unset( $_POST['nome']);

	date_default_timezone_set( "America/Sao_Paulo" );
   
        $para  = 'alan@interative.cc';
	$emailoculto = 'robson.junior@interative.cc';
        
		//email do cliente
		$ec_default = 'alan@interative.cc';
        
        $assunto_mail = "Interative Studio";
        $cliente      = "Studio";
		$site_cliente = "http://interative.cc";
		$cliente_telefone = '';
        
        //Variáveis para validação  
        $valida     = true;  
        $erros     = array();  

        //Dados do Envio  
        $ipaddress  = $_SERVER['REMOTE_ADDR'];  
        $datetime   = date('d/m/Y H:i:s');
        
        $hora = date(" H ");

        if($hora >= 12 && $hora<18){
        	$saudacao = "Boa tarde";
    	
    	}else if ($hora >= 0 && $hora <12 ){
        	$saudacao = "Bom dia";
    	
    	}else{
        	$saudacao = "Boa noite";
    	}

        //Dados Fornecidos pelo formulário
        $nome       = $_POST["quem"];
		$email      = $_POST["email"];
        $mensagem   = $_POST['mensagem'];
        $form_name  = $_POST['fn'];
        
        //valida se post nome está vazio
		if(empty($nome)){
			$valida   = false;
			$erros[] = "Você não digitou seu nome";
		}
	
		//Testa se post email está vazio
		if(empty($email)){
			$valida   = false;
			$erros[] = "Você não digitou seu email";
		//Testa email
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$valida   = false;
			$erros[] = "Você digitou um email inválido";
		}
		
		//Testa se post mensagem está vazio
		if(empty($mensagem)){
			$valida = false;
			$erros[] = "Você não preencheu a menssagem";
		}
		//Testa se a mensagem é maior que 20  caracteres
		elseif(strlen($mensagem) < 2){
			$valida = false;
			$erros[] = "Sua mensagem deve possuir 2 caracteres no mínimo";
		}
                
        /*Variaveis de Class CSS */
        $lastchild = 'style="margin-left:10px; background: none repeat scroll 0 0 #FAFAFA; padding:5px 10px;"';
        $rodape = 'style="border:0;display:block; margin-top:10px; height:49px; width:710px;"';
          
        global $corpo_do_email, $lastchild;
        $corpo_do_email = '';
        /**
         * Gera e adiciona o conteudo ao corpo do email
         * @param String $var
         * @param String $label
         */
        function conteudo($var,$label){
          global $corpo_do_email, $lastchild;
          if (isset($_POST[$var]) && !empty($_POST[$var])){$corpo_do_email .= "<tr><td><strong>{$label}</strong></td><td {$lastchild}>{$_POST[$var]}</td></tr> ";}
        }  
		   
 
        //Se tudo está ok envia email
	if($valida){

          $headers .= 'From: '.$name.' <noreply@interative.cc>' . "\r\n";
          $headers .= "Bcc: $emailoculto \r\n"; 
          $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    
          $corpo_do_email = " 
              <style type=\"text/css\">
                table{font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:14px;color:#333; text-shadow:0 1px 0 #FFFFFF; padding:0 10px;
                background-color: #FAFAFA; background-image: -webkit-gradient(linear, left top, left bottom, from(#FAFAFA), to(#FFFFFF));background-image: -webkit-linear-gradient(top, #FAFAFA, #FFFFFF); background-image: -moz-linear-gradient(top, #FAFAFA, #FFFFFF);
          background-image:     -ms-linear-gradient(top, #FAFAFA, #FFFFFF);background-image:      -o-linear-gradient(top, #FAFAFA, #FFFFFF);background-image:         linear-gradient(top, #FAFAFA, #FFFFFF);filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#FAFAFA', EndColorStr='#FFFFFF'); }      
                table table{-webkit-border-radius:8px; -moz-border-radius:8px; border-radius:8px; background:#FFFFFF; border: 1px solid #61BCF1; padding: 10px; margin: 15px auto;}
                table table tr td{padding:5px 10px 5px 0; border-bottom:1px solid #eee;}}
                table table tr:last-child td{border:none;}
              </style>
             <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"710\">
              <tbody>
                <tr>
                  <td><p>{$saudacao} {$cliente}!<br />Você recebeu uma mensagem do formulário {$form_name}.</p></td>
                </tr>
                <tr>
                    <td>
                    <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\">
                      <tr><td><strong>Nome </strong> </td><td {$lastchild}>{$nome}</td></tr>
                      <tr><td><strong>Email </strong> </td><td {$lastchild}>{$email}</td></tr>";

                        conteudo('tel','Telefone');
                        conteudo('cidade','Cidade');
                        conteudo('empresa','Empresa');
                        conteudo('assunto','Assunto');


        $corpo_do_email .="<tr><td><strong>Mensagem</strong> </td><td {$lastchild}>{$mensagem}</td></tr>
                     </table>
                   </td>
                </tr>
                <tr>
                    <td style=\"margin-top:10px\"><p>Esta mensagem foi enviada do IP: {$ipaddress} em {$datetime}<p></td>
                </tr>
                <tr>
                  <td {$rodape}>
                    <a href=\"http://www.interativestudio.com.br/web/\" target=\"_blank\"><img src=\"http://interativestudio.com.br/email/email_footer_710.jpg\" /></a>  
                  </td>
                </tr>
              </tbody>
             </table>";
          
		   
          		  if( mail($para,$assunto_mail,$corpo_do_email,$headers) ){
					  

				  $headers_agredecimento.= 'From: '.$cliente.' <'.$ec_default.'>' . "\r\n";
				  $headers_agredecimento .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				  $corpo_do_email_agredecimento = "
				  <p>{$saudacao} {$nome}!</p>
				  
				  <p>Muito obrigado por entrar em contato conosco.<br>
				  Iremos lhe responder o mais rápido possível, mas se você precisa de uma resposta ainda mais rápida não exite em ligar para: (51) {$cliente_telefone}.</p>
		
				  <p>{$cliente}<br>
				  <a href=\"mailto:{$ec_default}\">{$ec_default}</a><br>
				  <a href=\"http://{$site_cliente}\">{$site_cliente}</a></p>";
				  mail($email,$assunto_mail,$corpo_do_email_agredecimento,$headers_agredecimento);
				  
				   //o que precisa retornar para o formulário
			

			}
			
	}
	
	//se não for uma requisição via ajax
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest')
	{
		if( $valida ){

			//redireciona de volta ao formulário
			header('location: ' . $_SERVER['HTTP_REFERER'].'?m=sucesso');
			
		} else {
			
			$returndata = array(
					'posted_form_data' => array(
							'nome' 		=> $nome,
							'email' 	=> $email,
							'mensagem' 	=> $mensagem
					),
					'erros' 	=> $erros
			);
			
			session_start();
			$_SESSION['cf_returndata'] = $returndata;
			
			echo '<p style="text-align:center; margin:200px auto">Ocorreu um erro contate o suporte: suporte@interativestudio.com.br</p>';
			header('location: ' . $_SERVER['HTTP_REFERER'].'?m=erro');
			
		}
		
	} else {
			
		if( $valida ){
				
			$dados = array(
					'type' => '',
					'message' => 'Sua mensagem foi enviada com sucesso!'
			);
	
		} else {
	
			$dados = array(
					'type' => 'erro',
					'message' => 'Ocorreu algum erro ao enviar os dados!'
			);
	
		}
			
		echo json_encode($dados);
	}
       
        
  }  

?>