<?php
	
	$email = 'contato@zipath.net';
    $nome = 'ze teste';
    $cpf = '12345688744';
    $titEvento = 'teste envio';
    $descricao = 'descricao de texto';
    $fly = '764-excedeu limite kav.png';
	
    $dataAtual = date('d/m/Y'); 
    $destino = $email; // email recebido pelo formulaio
    $destinoCopia = "galeriaeg@gmail.com";    
    
	// Carrego a classe PHPMailer através do Autoload
	include "PHPMailerAutoload.php";
	
	// Instancio a classe PHPMailer
	$msg = new PHPMailer();
	
	// Faço todas as configurações de SMTP para o envio da mensagem
	$msg->CharSet = "UTF-8";
	$msg->isSMTP(); 
	$msg->Host = 'mail.zipath.net'; 
	$msg->SMTPAuth = true; 
	$msg->Username = 'awe@zipath.net'; 
	$msg->Password = 'sis*Eventos_22'; 
	$msg->Port = 587; 
    $msg->setFrom('awe@zipath.net','Contato AWE');
	$msg->SMTPAutoTLS = false;
    $msg->IsHTML(true); // Define que o e-mail será enviado como HTML
	$msg->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
    $msg->Subject  = "AWE | Inscrição confirmada"; // Assunto da mensagem
	$msg->addReplyTo($email, $nome);
    $msg->AddAddress($destino, $nome); //destino
	$msg->AddCC($destinoCopia, 'Galeria'); // Copia
    $msg->Body = "
    
	<html>
	<head>
	<title>AWE</title>
	</head>
	<body style='color:#333;font-size:15px;'>
	
	<table border='0' width='680'>
	<tr>
	<td>
	
	<img src='https://www.zipath.net/awe/imgs/logo.png' />
	<img src='http://www.multprivate.com.br/evento/imgs/fio-email.gif' alt='fio' />
	$dataAtual 
	<br /><br />
	Oi $nome, sua inscrição está confirmada no evento<br />
	<strong>$titEvento.</strong><br /><br />
	$descricao<br /><br />
	Esperamos por você!<br /><br />
	<img src='https://www.zipath.net/awe/painel/files/$fly' width='680' border='1' /><br /><br />
	Caso não consiga visualizar a imagem do convite <a href='https://www.zipath.net/awe/painel/files/$fly'>clique aqui</a> para abrí-la.
	
	<div style='margin-top:20px;font-size:14px;width:96%;float:left'>
	<strong>AWE - Aplicação Web para Eventos</strong><br />
	Fortaleza-CE<br />      
	Telefone: +55 85 3032.3232 <br />
	<a href='https://www.zipath.net'>www.zipath.net</a>
	</div>
	
	</td>
	</tr>
	</table>        
	
	</body>
    </html>
    
    ";
	
	

	

	

	
	// Faço o envio da mensagem
	$enviado = $msg->Send();
	
	// Limpo todos os registros de destinatários e arquivos 
	$msg->ClearAllRecipients();
	
	// Caso a mensagem seja enviada com sucesso ela retornará sucesso
	// senão, ela retornará o erro ocorrido 
	if ($enviado){
		echo "E-mail enviado com sucesso!";
	}
	else {
		echo "Não foi possível enviar o e-mail.";
		echo "<b>Informações do erro:</b> " . $msg->ErrorInfo;
	}
	
	

	
	
?>