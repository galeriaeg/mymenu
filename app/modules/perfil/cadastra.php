<?php
	include "session.php";
	
	$idusuario	= $_POST['idusuario'];
	$nome 		= strtoupper($_POST['nome']);
	$email		= strtolower($_POST['email']);
	$telefone	= $_POST['telefone'];
	$senha		= $_POST['senha'];
	
	
	
	if((empty($idusuario))||(empty($nome))||(empty($email))||(empty($telefone)) ){
		echo "<script>location.assign('index.php?m=9');</script>";
		exit();
	}
	else{

		require_once "config/conecta.php";
		
		if(!empty($senha)){
			$senha = sha1($senha);
			$sql = "UPDATE t_usuario SET senha='$senha' WHERE id = '$idusuario' ";
			$update = mysqli_query($conexao, $sql);				
		}
		
		$sql = "UPDATE t_usuario 
		SET nome='$nome', email='$email', telefone='$telefone',data_cadastro ='$datahoje', tipo=2 ,status=1 
		WHERE id = '$idusuario' ";
		$res = mysqli_query($conexao, $sql);		
		
		
		if($res>0){
			echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro realizado com  sucesso!</h6></div>";
			echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
			echo "<script>setTimeout(function(){location.assign('index.php?m=2');}, 2500);</script>";
		}
	
	}
	
	mysqli_close($conexao);
?>
