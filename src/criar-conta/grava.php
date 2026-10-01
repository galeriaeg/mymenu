<?php
	
	if (isset($_POST['btnConta'])) {
		
		$nome	= htmlspecialchars($_POST['nome']);
		$nome	= strtoupper($nome);
		$email	= htmlspecialchars($_POST['email']);
		$email	= filter_var($email, FILTER_SANITIZE_EMAIL);
		$email	= strtolower($email);
		$cpf	= htmlspecialchars($_POST['cpf']);
		$telefone = htmlspecialchars($_POST['telefone']);
		$senha	= htmlspecialchars($_POST['senha']);
		$plano	= htmlspecialchars($_POST['plano']);
		
		if(
		(empty($nome))||
		(empty($email))||
		(empty($cpf))||
		(empty($telefone))||
		(empty($senha))||
		(empty($plano))
		){
			
			echo "<script>window.location.href='../../home'</script>";
			exit();
		
		}
		else{
			
			// funcao valida CPF
			//require_once "valida-cpf.php";
			
			// valida tamanho do nome
			if(strlen($nome)<8){
				echo "<script>window.location.href='../../page?p=criar-conta&erro=402'</script>";
				exit();			
			}
			// valida tamanho da senha
			if(strlen($senha)<8){
				echo "<script>window.location.href='../../page?p=criar-conta&erro=400'</script>";
				exit();			
			}
			
			require_once "../../app/config/conecta.php";
			
			//Verifica se cpf ou email ja existem na base
			$sql = "SELECT cpf,email FROM t_usuario WHERE cpf = '$cpf' OR email='$email' ";
			$res = mysqli_query($conexao, $sql);
			$total = mysqli_num_rows($res);
			while ($row = mysqli_fetch_array($res)){
				$cpf	=	$row['cpf'];
				$email	=	$row['email'];
			}
			// se existir retorna erro
			if($total > 0){
				echo "<script>window.location.href='../../page?p=criar-conta&erro=403'</script>";
				exit();
			}
			else{
				
				$senha = sha1($senha);
				
				
				date_default_timezone_set('America/Sao_Paulo');
				$hoje =  date("d/m/Y H:i:s");
				
				// cadastra usuario
				$sql="INSERT INTO t_usuario (nome,cpf,email,senha,telefone,data_cadastro,tipo,status)
				VALUES('$nome','$cpf','$email','$senha','$telefone','$hoje',2,0)";
				$conf = $conexao->query($sql)or die ($conexao->error);
				$ultimoUsuario = $conexao->insert_id;
				
				// cadastra contrato
				$sql="INSERT INTO t_contrato (data_cadastro,data_pagamento,id_usuario,id_plano,status)
				VALUES('$hoje','','$ultimoUsuario','$plano',0)";
				$conf = $conexao->query($sql)or die ($conexao->error);
				
				
				if($conf>0){
				
					//Envia email com token
					//require_once "../notificar/email_validacao.php";
					
					echo "<script>window.location.href='../../page?p=confirma-conta'</script>";
					exit();
				}
			}
			
		}
		
	}
	else{
		
		echo "<script>window.location.href='../../home'</script>";
		exit();
	}
	
	
	mysqli_close($conexao);
?>