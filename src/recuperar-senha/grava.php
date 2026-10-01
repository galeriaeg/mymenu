<?php
	$cpf = htmlspecialchars($_POST['cpf']);	
	
	if(empty($cpf)){
	
		echo "<script>window.location.href='../../home'</script>";
		exit();
		
	}
	else{
		
		require_once "../../app/config/conecta.php";
		
		$sql = "SELECT email FROM t_usuario WHERE cpf ='$cpf' LIMIT 1 ";
		$res = mysqli_query($conexao, $sql);
		$total = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$email	=	$row['email'];
		}	
		if($total>0){
		
			$pre = rand(1,5);
			
			if($pre==1)
				$char = "Fg@";
			else if($pre==2)
				$char = "H&a";
			else if($pre==3)
				$char = "Tp*";
			else if($pre==4)
				$char = "pKw";
			else
				$char = "Zq!";
			
			
			$novaSenhaRand = rand(10001,99999);
			$tamSenha = strlen($novaSenhaRand);
			
			if((!empty($novaSenhaRand)) && ($tamSenha==5)){
				$novaSenha = $char.$novaSenhaRand;
				$novaSenhaCrip = sha1($novaSenha);
				
				$sql = "UPDATE t_usuario SET senha = '$novaSenhaCrip' WHERE cpf = '$cpf' ";
				$update = mysqli_query($conexao, $sql);
				
				if($update>0){
					//Envia email com token
					//require_once "../notificar/email_nova_senha.php";
					
					echo "<script>window.location.href='../../page?p=login&act=201'</script>";
					exit();
				}				
				
			}
			else{
				echo "Erro ao tentar recuperar senha!";
				exit();
			}
			
		}
		else{
			echo "<script>window.location.href='../../page?p=recuperar-senha&erro=401'</script>";
			exit();
		}
		
	}
	
?>