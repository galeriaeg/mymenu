<?php
	session_start();
	
	$email = htmlspecialchars($_POST['email']);
	$senha = htmlspecialchars($_POST['senha']);
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$email = strtolower($email);
	$senha = trim($senha);
	
	$senha = sha1($senha);
	//exit();
	$email_bd = "galeriaeg@gmail.com";
	$pass_bd = "7c222fb2927d828af22f592134e8932480637c0d";
	
	
	if(($email==$email_bd )&&($senha==$pass_bd)){
		
		$_SESSION["email_user"] = $email;
		//echo "entrou";
		header("location: index.php");
		exit();
	}
	else{
		echo "dados incorretos";
		header("location: login.html"); 
		exit();
	}
?>