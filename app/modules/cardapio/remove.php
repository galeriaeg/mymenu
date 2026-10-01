<?php
	include "session.php";
	
	$idUsuarioLogado = $_SESSION['id'];
	$idCardapio = htmlspecialchars($_GET['c']);
	$file = htmlspecialchars($_GET['f']);
	
	
	if(($idCardapio<1) || (empty($file))){
		echo "<script>location.assign('index.php?m=9);</script>";
		exit();
	}
	else{
		require_once "config/conecta.php";
		
		$sql = "SELECT tcus.codigo_path,tcar.logo
		FROM t_customiza AS tcus, t_cardapio AS tcar
		WHERE tcus.idUsuario = $idUsuarioLogado
		AND tcus.idUsuario = tcar.idUsuario";
		$res = mysqli_query($conexao, $sql);
		$totalPath = mysqli_num_rows($res);
		while ($row = mysqli_fetch_array($res)){
			$codigo_path	=	$row['codigo_path'];
			$logo	=	$row['logo'];
		}
		

		
		if($totalPath>0){
			
			$sql = "UPDATE t_cardapio SET logo ='' WHERE idUsuario = '$idUsuarioLogado' ";
			$update = mysqli_query($conexao, $sql);	
			
			if($update>0){
				$uploadpath = 'files/'.$idUsuarioLogado."-".$codigo_path;
				unlink($uploadpath."/$logo"); // exclui arquivo
				
				echo "<div class='alert-sucess'><h6><i class='fa fa-check icon-alert' aria-hidden='true'></i> Anexo excluído com sucesso!</h6></div>";
				echo "<img src='./img/barra-progresso.gif' class='barra-progresso' alt='progresso' />";
				echo "<script>setTimeout(function(){window.location='index.php?m=3'}, 2500);</script>";				
			}		
			
		}
		
		
		mysqli_close($conexao);
	
	}
	
?>
