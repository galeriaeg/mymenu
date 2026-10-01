<?php
	session_start();
	set_time_limit(10);
	
	if (!isset($_SESSION["email_user"])) {
		header("Location:login.html"); // Redireciona para o login se não estiver logado
		exit();
	}
	else{
		$logado = $_SESSION['email_user'];
		//echo "sessão ativa";
	}	
?>