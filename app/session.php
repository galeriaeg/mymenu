<?php
	session_start();
	set_time_limit(20);
	
	if (!isset($_SESSION["email"])) {
		header("Location:../index.php"); // Redireciona para o login se não estiver logado
		exit();
	}
	else{
		$logado = $_SESSION['email'];
		//echo "sessão ativa";
	}	
?>