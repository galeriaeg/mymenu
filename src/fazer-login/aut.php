<?php
	//session_start();
	include "../../app/config/conecta.php";
	
	date_default_timezone_set('America/Sao_Paulo');
	$hoje = date("d/m/Y H:i:s");	
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$email = htmlspecialchars($_POST['email']);
		$senha = htmlspecialchars($_POST['senha']);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		$email = strtolower($email);
		$senha = trim($senha);
		
		$senha = sha1($senha);
		
		if((empty($email)) || (empty($senha))){
			echo "<script>window.location.href='../../page?p=login&aut=false';</script>";
			exit();
		}
		else{
			
			$sql = "SELECT u.id,u.nome,u.email,u.tipo
			FROM t_usuario AS u, t_contrato AS c 
			WHERE u.email = '$email' 
			AND u.senha = '$senha' 
			AND c.id_usuario = u.id
			AND u.status = 1
			LIMIT 1";
			$result = mysqli_query($conexao, $sql);
			
			if(mysqli_num_rows($result) > 0){
			
				$row = mysqli_fetch_assoc($result);
				
				// cria token
				$token = rand(100001,999999);
				// verifica se o token ja existe na base
				$sql = "SELECT codigo FROM t_token WHERE codigo = '$token' AND email_usuario ='$email' ";
				$res = mysqli_query($conexao, $sql);
				$total_token = mysqli_num_rows($res);
				while ($row = mysqli_fetch_array($res)){
					$codigo	=	$row['codigo'];
				}
				if($total_token>0){
					//exclui token existente
					$sql = "DELETE FROM t_token WHERE codigo = '$token' AND email_usuario ='$email' ";
					$res = mysqli_query($conexao,$sql);
					//cria um novo token
					$token = rand(100001,999999);
				}
				
				//grava token de autenticacao de 2 fatores
				$sql="INSERT INTO t_token (codigo,data_criacao,email_usuario,status)
				VALUES('$token','$hoje','$email',0)";
				$conf = $conexao->query($sql)or die ($conexao->error);
				
				
				//Envia email com token
				//require_once "../notificar/envia.php";
				
				
				echo "<form name='myForm' action='../../page?p=autentica&act=201' method='POST'>
				<input type='hidden' value='$email' name='email' />
				</form>";
				echo "<script>document.myForm.submit();</script>";
				
			}
			else{
				//echo "usario não existe";
				echo "<script>window.location.href='../../page?p=login&aut=false';</script>";
				exit();
			}
			
		}		
		
	}
	else{
		echo "<script>window.location.href='../../home';</script>";
		exit();
	}
	
	mysqli_close($conexao);
?>
