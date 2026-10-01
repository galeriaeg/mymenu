<?php
	include "session.php";
	

	
	$idUsuarioLogado = htmlspecialchars($_SESSION['id']); 
	$status = htmlspecialchars($_GET['s']);
	
	if($status<1)
		$status = 1;
	else
		$status = 0;
	
	require_once "config/conecta.php";
	$sql = "UPDATE t_cardapio SET status='$status' WHERE idUsuario = '$idUsuarioLogado' ";
	$update = mysqli_query($conexao, $sql);
	
	if($update>0){
		echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Cadastro atualizado com sucesso!</h6></div>";
		echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
		echo "<script>setTimeout(function(){location.assign('index.php?m=3');}, 2500);</script>";
		exit();
	}
	
	mysqli_close($conexao);
?>
