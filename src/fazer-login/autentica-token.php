<?php
	session_start();
	
	$codigo = htmlspecialchars($_POST['codigo']);
	$email = htmlspecialchars($_POST['email']);

	
	require "../../app/config/conecta.php";
	
	if( (empty($codigo)) || (empty($email)) ){
		
		echo "<script>window.location.href='../../home'</script>";
		exit();
		
	}
	else{
		
		$sql = "SELECT tk.codigo, tu.id,tu.nome,tu.email,tu.tipo 
		FROM t_token AS tk, t_usuario AS tu
		WHERE tk.codigo = '$codigo' 
		AND tk.email_usuario = '$email'
		AND tu.email = tk.email_usuario
		LIMIT 1";
		$result = mysqli_query($conexao, $sql);
		
		if(mysqli_num_rows($result) > 0){
			
			// cria sessao se email e token corretos 
			$row = mysqli_fetch_assoc($result);
			$idusuario = $_SESSION["id"] = $row["id"];
			$_SESSION["nome"] = $row["nome"];
			$_SESSION["email"] = $row["email"];
			$_SESSION["tipo"] = $row["tipo"];
			
			//destroi token
			$sql = "DELETE FROM t_token WHERE email_usuario = '$email' ";
			$qry1 = mysqli_query($conexao, $sql);
			//redireciona usuario para painel
			echo "<script>window.location.href='../../app/index.php'</script>";
			exit();
			
		}
		else{
			$sql = "DELETE FROM t_token WHERE email_usuario = '$email' ";
			$qry1 = mysqli_query($conexao, $sql);
			//Se ocorrer erro redireciona usuario para login
			echo "<script>window.location.href='../../page?p=login&erro=401'</script>";
			exit();
		
		}
	}
	
	
	mysqli_close($conexao);
?>