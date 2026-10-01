<?php

    $tokenHash = $_GET['tkn'];
    $tokenString = base64_decode($tokenHash);
	$tokenParte = explode("?", $tokenString);
	$email = (string) trim($tokenParte[0]);
	$email_tam = $tokenParte[1];
	
	if((empty($email)) || ($email_tam<5)){
		echo "<script>window.location.href='../../home'</script>";
		exit();
	}
	else{
		
		require_once "../../app/config/conecta.php";
		
		$sql = "SELECT email,status FROM t_usuario WHERE email = '$email' AND status = '0' ";
		$res = mysqli_query($conexao, $sql);
		$qtde = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$email_base		=	$row['email'];
			$status_base	=	$row['status'];
		}
		
		if($qtde > 0){
        
            if($email_tam != strlen($email_base)){
			     echo "<script>window.location.href='../../home'</script>";
			     exit();
		      }
			
			$sql = "UPDATE t_usuario SET status= '1' WHERE email = '$email' ";
			$update = mysqli_query($conexao, $sql);
			
			if($update>0){
				
				echo "<script>window.location.href='../../page?p=login&aut=true'</script>";
				exit();
			}
			else{
				echo "501 - Erro! Não foi possivel validar!";
			}
			
		}
		else{
			echo "Erro! Ação inválida!<br />";
            echo "Aguarde...";
            echo "<script>
            setTimeout(() => {
              window.location.href='../../home';
            }, 2000);
            </script>";
			exit();
		}
		
	}
?>