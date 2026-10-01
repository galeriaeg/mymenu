<?php
    
	$email_destinatario = $email;
	$nome_destinatario = $email;
    $destinoCopia = "galeriaeg@gmail.com";


	$message="
	<table width='598' border='0' style='padding:10px;margin:8px;border-collapse:0;border-collapse:collapse;'>
    	<tr>
    	   <td><img  src='https://www.mymenu.app.br/img/topo-token.png' alt='topo'/></td>
    	</tr>
	<tr>
	   <td style='color:#FF8533;vertical-align:bottom;height:35px;'><strong>AUTENTICAÇÃO</strong></td>
	</tr>
	<tr>
	<td style='height:40px;color:#555;font:normal 18px calibri,verdana'>
	<strong><br />Chegou seu código de autenticação do MyMenu!<br /></strong>
	Para concluir o login na sua conta do <strong>MyMenu</strong>, informe o seguinte código:<br /><br />
	
	<div style='background:#eee; padding:6px 12px;font:bold 20px arial;display:table'>$token</div>
	
	<br />Não compartilhe esse código com ninguém. <br /><br />
	</td>
	</tr>
	<tr>
	<td style='height:30px;color:#555;background:#f5f5f5;font:normal 14px calibri,verdana;'>
	&nbsp;&nbsp;2025 &copy; MyMenu  - <a href='https://www.mymenu.app.br/' target='_blank'>www.mymenu.app.br/</a>
	</td>
	</tr>
	</table>";
	
	include "phpMailerAutoload/PHPMailerAutoload.php";
	
	$msg = new PHPMailer();
	$msg->CharSet = "UTF-8";
	$msg->isSMTP(); 
	$msg->Host = 'mail.mymenu.app.br'; 
	$msg->SMTPAuth = true; 
	$msg->SMTPSecure = '';
	$msg->Username = 'suporte@mymenu.app.br'; 
	$msg->Password = '281006-25G'; 
	$msg->Port = 587; //465
    $msg->setFrom('suporte@mymenu.app.br','MyMenu');
	$msg->SMTPAutoTLS = false;
    $msg->IsHTML(true);
	$msg->CharSet = 'UTF-8';
    $msg->Subject  = "MyMenu | Autenticação";
	$msg->addReplyTo('suporte@mymenu.app.br', 'MyMenu');
    $msg->AddAddress($email_destinatario, $nome_destinatario); //destino
	$msg->AddCC($destinoCopia, 'Galeria Gmail'); // Copia
    $msg->Body = $message;
	
	$enviado = $msg->Send();
	
	// Limpo todos os registros de destinatários e arquivos 
	//$msg->ClearAllRecipients();
	
	if ($enviado){
    // enviado
  	//echo "<script>alert('enviado');</script>"; //"<script>this.location='token.php';</script>";
  	//exit(); 
	}
	else {
		echo "Não foi possível enviar o e-mail.";
		echo "<b>Informações do erro:</b> " . $msg->ErrorInfo;
	}
?>
