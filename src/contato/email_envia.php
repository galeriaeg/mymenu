<?php
    
	$nome	= htmlspecialchars($_POST['nome']);
	$nome	= strtoupper($nome);
	$email	= htmlspecialchars($_POST['email']);
	$email	= filter_var($email, FILTER_SANITIZE_EMAIL);
	$email	= strtolower($email);
	$mensagem	= htmlspecialchars($_POST['mensagem']);
	$tipo_usuario	= htmlspecialchars($_POST['tipo-usuario']);
	
	$randCaptcha	= htmlspecialchars($_POST['randCaptcha']);
	$meuCaptcha	= htmlspecialchars($_POST['meuCaptcha']);
	
	
	if($randCaptcha != $meuCaptcha){
		echo "<script>window.location='../../page?p=contato&send=false'</script>";
		exit();
	}
	
	
	if(
	(empty($nome))||
	(empty($email))||
	(empty($mensagem))||
	(empty($tipo_usuario))
	){
		echo "<script>window.location='../../page?p=contato&send=false'</script>";
		exit();
	}
	else{
	
	
	}
	
	
	$to	= 'suporte@mymenu.app.br';
	$subject = 'MyMenu | Contato via site';
	
	
	$message="
	<table width='598' border='0' style='padding:10px;margin:8px;border-collapse:0;border-collapse:collapse;'>
	<tr>
	<td><img  src='https://www.mymenu.app.br/img/topo-contato.png' alt='topo'/></td>
	</tr>
	<tr>
	<td style='color:#FF8533;vertical-align:bottom;height:35px;'><strong>CONTATO</strong></td>
	</tr>
	<tr>
		<td style='height:40px;color:#555;font:normal 18px calibri,verdana'>
			<br />
			<strong>Nome:</strong> $nome<br />
			<strong>Email:</strong> $email<br />
			<strong>Tipo de usuário:</strong> $tipo_usuario<br />
			<strong>Mensagem:</strong> $mensagem<br />
			<br />
		</td>
	</tr>
	<tr>
	<td style='height:30px;color:#555;background:#f5f5f5;font:normal 14px calibri,verdana;'>
	&nbsp;&nbsp;2025 &copy; MyMenu  - <a href='https://www.mymenu.app.br/' target='_blank'>www.mymenu.app.br/</a>
	</td>
	</tr>
	</table>";
	

	
	// To send HTML mail, the Content-type header must be set
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=UTF-8';
	
	// Additional headers
	$headers[] = 'To:<suporte@mymenu.app.br>';
	$headers[] = 'From:<suporte@mymenu.app.br>';
	$headers[] = 'Reply-To:'.$email;
	//$headers[] = 'Cc: birthdayarchive@example.com';
	//$headers[] = 'Bcc: birthdaycheck@example.com';    
	
	$envio = mail($to, $subject, $message, implode("\r\n", $headers));
	
	if($envio){
		echo "<script>window.location='../../page?p=contato&send=true'</script>";
		exit();
	}
	else{
		echo "Erro! A mensagem não pode ser enviada";
		exit();
	} 
?>
